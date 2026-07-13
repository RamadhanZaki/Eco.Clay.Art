<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $settings = Setting::pluck('value', 'key')->toArray();
        $products = Product::where('is_active', true)
                          ->orderBy('display_order')
                          ->get();
        $testimonials = Testimonial::where('is_active', true)->get();

        // Data features (bisa dari settings nanti)
        $features = [
            ['icon' => 'fas fa-hand-sparkles', 'title' => 'Handmade Original', 'description' => '100% buatan tangan, bukan produksi massal.'],
            ['icon' => 'fas fa-palette', 'title' => 'Custom Nama/Desain', 'description' => 'Sesuai keinginan kamu sepenuhnya.'],
            ['icon' => 'fas fa-tag', 'title' => 'Harga Terjangkau', 'description' => 'Mulai Rp20.000 - kualitas premium.'],
            ['icon' => 'fas fa-gift', 'title' => 'Cocok untuk Gift', 'description' => 'Hadiah unik dan berkesan untuk orang tersayang.']
        ];

        return view('landing', compact('settings', 'products', 'testimonials', 'features'));
    }
}
