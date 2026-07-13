<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $products = Product::where('is_active', true)
                          ->orderBy('display_order')
                          ->get();
        $testimonials = Testimonial::where('is_active', true)->get();

        $orderStatusFilter = $request->query('status');
        $orders = Order::when($orderStatusFilter, function ($query) use ($orderStatusFilter) {
                        $query->where('status', $orderStatusFilter);
                    })
                    ->latest()
                    ->get();

        $orderCounts = [
            'semua' => Order::count(),
            'menunggu' => Order::where('status', 'menunggu')->count(),
            'dikonfirmasi' => Order::where('status', 'dikonfirmasi')->count(),
            'diproduksi' => Order::where('status', 'diproduksi')->count(),
            'dikirim' => Order::where('status', 'dikirim')->count(),
            'selesai' => Order::where('status', 'selesai')->count(),
        ];

        return view('admin', compact('settings', 'products', 'testimonials', 'orders', 'orderStatusFilter', 'orderCounts'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,bmp|max:5120',
            'font_heading' => 'nullable|string|in:kalam,playfair,pacifico,dancing_script,caveat,inter',
            'font_body' => 'nullable|string|in:inter,poppins,nunito,montserrat,quicksand,lato,roboto',
            'color_primary' => 'nullable|string|max:20',
            'color_primary_light' => 'nullable|string|max:20',
            'color_bg' => 'nullable|string|max:20',
            'color_text' => 'nullable|string|max:20',
            'color_text_light' => 'nullable|string|max:20',
            'color_button_bg' => 'nullable|string|max:20',
            'color_button_text' => 'nullable|string|max:20',
        ], [
            'hero_image.image' => 'File yang diunggah harus berupa gambar.',
            'hero_image.mimes' => 'Format gambar harus jpg, jpeg, png, gif, webp, atau bmp.',
            'hero_image.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        // Ambil semua input kecuali field kontrol/khusus yang ditangani terpisah
        $data = $request->except(['_token', 'products', 'testimonials', 'hero_image', 'hero_image_existing']);

        // Gambar Hero: upload baru dikonversi ke WebP, jika tidak ada upload pertahankan gambar lama
        if ($request->hasFile('hero_image')) {
            $storedPath = $this->convertImageToWebp($request->file('hero_image'), 'hero');
            $data['hero_image'] = $storedPath ? \Illuminate\Support\Facades\Storage::url($storedPath) : Setting::get('hero_image', '');
        } else {
            $data['hero_image'] = $request->input('hero_image_existing', Setting::get('hero_image', ''));
        }

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
    }

    public function updateProducts(Request $request)
    {
        $request->validate([
            'products' => 'array',
            'products.*.title' => 'nullable|string|max:255',
            'products.*.description' => 'nullable|string',
            'products.*.price' => 'nullable|string|max:100',
            'products.*.shopee_url' => 'nullable|string|max:500',
            'products.*.existing_image' => 'nullable|string',
            // Maksimal 5MB (dalam KB), hanya file gambar
            'products.*.image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,bmp|max:5120',
        ], [
            'products.*.image.image' => 'File yang diunggah harus berupa gambar.',
            'products.*.image.mimes' => 'Format gambar harus jpg, jpeg, png, gif, webp, atau bmp.',
            'products.*.image.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        $products = $request->input('products', []);

        // Nonaktifkan semua produk lama
        Product::query()->update(['is_active' => false]);

        // Buat produk baru
        $order = 0;
        foreach ($products as $key => $data) {
            $imageUrl = $data['existing_image'] ?? '';

            if ($request->hasFile("products.$key.image")) {
                $uploadedFile = $request->file("products.$key.image");
                $storedPath = $this->convertImageToWebp($uploadedFile, 'products');

                if ($storedPath) {
                    $imageUrl = \Illuminate\Support\Facades\Storage::url($storedPath);
                }
            }

            Product::create([
                'title' => $data['title'] ?? 'Product',
                'description' => $data['description'] ?? '',
                'price' => $data['price'] ?? '',
                'image_url' => $imageUrl,
                'shopee_url' => $data['shopee_url'] ?? '',
                'display_order' => $order,
                'is_active' => true
            ]);
            $order++;
        }

        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Konversi file gambar yang diupload menjadi format WebP dan simpan ke disk 'public'.
     * Mengembalikan path relatif (mis. 'products/img_xxx.webp') atau null jika gagal.
     */
    private function convertImageToWebp($file, string $directory): ?string
    {
        // Jika ekstensi GD WebP tidak tersedia di server, simpan file asli apa adanya.
        if (! function_exists('imagewebp')) {
            return $file->store($directory, 'public');
        }

        $mime = $file->getMimeType();

        $sourceImage = match (true) {
            in_array($mime, ['image/jpeg', 'image/jpg']) => @imagecreatefromjpeg($file->getRealPath()),
            $mime === 'image/png' => @imagecreatefrompng($file->getRealPath()),
            $mime === 'image/gif' => @imagecreatefromgif($file->getRealPath()),
            in_array($mime, ['image/bmp', 'image/x-ms-bmp']) && function_exists('imagecreatefrombmp') => @imagecreatefrombmp($file->getRealPath()),
            $mime === 'image/webp' => @imagecreatefromwebp($file->getRealPath()),
            default => null,
        };

        // Jika gagal dibaca (format tidak didukung GD), simpan file asli sebagai fallback.
        if (! $sourceImage) {
            return $file->store($directory, 'public');
        }

        // Jaga transparansi untuk PNG/GIF
        imagepalettetotruecolor($sourceImage);
        imagealphablending($sourceImage, true);
        imagesavealpha($sourceImage, true);

        $relativePath = trim($directory, '/').'/'.uniqid('img_', true).'.webp';
        $fullPath = storage_path('app/public/'.$relativePath);

        if (! is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }

        // Kualitas 82 = kompromi baik antara ukuran file dan kualitas visual
        imagewebp($sourceImage, $fullPath, 82);
        imagedestroy($sourceImage);

        return $relativePath;
    }

    public function updateTestimonials(Request $request)
    {
        $request->validate([
            'testimonials' => 'required|json'
        ]);

        $testimonials = json_decode($request->testimonials, true);

        // Hapus semua testimonial lama
        Testimonial::truncate();

        // Buat testimonial baru
        foreach ($testimonials as $data) {
            Testimonial::create([
                'quote' => $data['quote'] ?? '',
                'author' => $data['author'] ?? 'Anonymous',
                'is_active' => true
            ]);
        }

        return redirect()->back()->with('success', 'Testimoni berhasil diperbarui!');
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,dikonfirmasi,diproduksi,dikirim,selesai',
        ]);

        $order = Order::find($id);

        if ($order) {
            $order->update(['status' => $request->status]);
            return redirect()->back()->with('success', 'Status pesanan '.$order->order_id.' diperbarui menjadi '.ucfirst($request->status).'.');
        }

        return redirect()->back()->with('success', 'Pesanan tidak ditemukan.');
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
        }
        return redirect()->back()->with('success', 'Pesanan dihapus!');
    }
}