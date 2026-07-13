<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin eco.clayart</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * { box-sizing: border-box; }
        body { font-family: Inter, sans-serif; background: #f7f2ec; color: #332f2d; margin: 0; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 24px; }
        .card { background: #fff; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
        .card h2 { margin: 0 0 16px; font-size: 1.1rem; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .field { margin-bottom: 16px; }
        .field label { display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 4px; }
        .field input, .field textarea, .field select { width: 100%; padding: 10px 14px; border: 1px solid #decfc6; border-radius: 8px; font-family: inherit; }
        .field textarea { min-height: 80px; resize: vertical; }
        .btn { padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; }
        .btn-primary { background: #332f2d; color: #fff; }
        .btn-secondary { background: #f0ebe7; color: #332f2d; }
        .btn-danger { background: #b13b2e; color: #fff; }
        .btn-success { background: #2f6f43; color: #fff; }
        .tabs { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 24px; }
        .tabs button { padding: 10px 20px; border: none; border-radius: 8px; background: #f0ebe7; cursor: pointer; font-weight: 500; }
        .tabs button.active { background: #332f2d; color: #fff; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .order-row { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr auto; gap: 12px; align-items: center; padding: 12px 0; border-bottom: 1px solid #eee; }
        @media (max-width: 768px) { .grid-2 { grid-template-columns: 1fr; } .order-row { grid-template-columns: 1fr; gap: 6px; } }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; }
        .alert-success { background: #e8f5e9; color: #1b5e20; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; }
        .badge-menunggu { background: #fff3e0; color: #e65100; }
        .badge-dikonfirmasi { background: #e3f2fd; color: #0d47a1; }
        .badge-diproduksi { background: #f3e5f5; color: #4a148c; }
        .badge-dikirim { background: #e8f5e9; color: #1b5e20; }
        .badge-selesai { background: #f5f5f5; color: #424242; }
        .item-card { border: 1px solid #ece3db; border-radius: 12px; padding: 20px; margin-bottom: 16px; position: relative; background: #fcfaf7; }
        .item-card .remove-item-btn { position: absolute; top: 14px; right: 14px; width: 30px; height: 30px; border: none; border-radius: 50%; background: #f0ebe7; color: #b13b2e; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; }
        .item-card .remove-item-btn:hover { background: #fdecea; }
        .item-card .item-number { font-size: 0.8rem; font-weight: 700; color: #a89b93; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; }
        .preview-img { max-width: 110px; max-height: 110px; border-radius: 8px; margin-top: 4px; object-fit: cover; border: 1px solid #eee; display: block; }
        .add-item-btn { margin-bottom: 20px; }
        .empty-hint { color: #a89b93; font-size: 0.9rem; padding: 20px; text-align: center; border: 1px dashed #decfc6; border-radius: 12px; margin-bottom: 20px; }
        .file-hint { font-size: 0.8rem; color: #7d716c; margin: 6px 0 0; }
        .file-error { font-size: 0.8rem; color: #b13b2e; margin: 6px 0 0; display: none; }
        .order-filters { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 20px; }
        .order-filters a { padding: 8px 16px; border-radius: 20px; background: #f0ebe7; color: #332f2d; font-size: 0.85rem; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; }
        .order-filters a.active { background: #332f2d; color: #fff; }
        .order-filters a .count { background: rgba(0,0,0,0.15); padding: 1px 7px; border-radius: 10px; font-size: 0.75rem; }
        .order-filters a.active .count { background: rgba(255,255,255,0.2); }
        .order-card { border: 1px solid #ece3db; border-radius: 12px; padding: 18px 20px; margin-bottom: 14px; background: #fcfaf7; }
        .order-card-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; flex-wrap: wrap; gap: 8px; }
        .order-card-header .order-id { font-size: 1.05rem; font-weight: 700; }
        .order-card-header .order-date { display: block; font-size: 0.8rem; color: #a89b93; margin-top: 2px; }
        .order-card-body { display: flex; flex-direction: column; gap: 6px; margin-bottom: 14px; font-size: 0.92rem; }
        .order-card-body i { width: 18px; color: #a89b93; margin-right: 6px; }
        .order-card-body a { color: #2f6f43; font-weight: 500; }
        .order-desc { background: #f7f2ec; border-radius: 8px; padding: 10px 12px; margin-top: 4px; color: #5c534f; }
        .order-card-footer { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; padding-top: 12px; border-top: 1px solid #ece3db; }
        .status-select { border: none; font-weight: 600; padding: 8px 14px; border-radius: 20px; cursor: pointer; font-family: inherit; }
        .color-field { display: flex; align-items: center; gap: 10px; }
        .color-field input[type="color"] { width: 52px; height: 40px; padding: 2px; border: 1px solid #decfc6; border-radius: 8px; cursor: pointer; }
        .color-field .color-code { font-family: monospace; font-size: 0.85rem; color: #7d716c; text-transform: uppercase; }
        .color-grid { margin-bottom: 8px; }

        /* Toast notification (pop-up) */
        .toast-container {
            position: fixed; top: 20px; right: 20px; z-index: 2000;
            display: flex; flex-direction: column; gap: 10px; max-width: 360px;
        }
        .toast {
            display: flex; align-items: flex-start; gap: 10px;
            background: #fff; color: #332f2d; padding: 14px 16px; border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15); font-size: 0.92rem;
            border-left: 4px solid #332f2d; opacity: 0; transform: translateX(30px);
            transition: opacity .25s, transform .25s;
        }
        .toast.show { opacity: 1; transform: translateX(0); }
        .toast.toast-success { border-left-color: #2f6f43; }
        .toast.toast-error { border-left-color: #b13b2e; }
        .toast i.toast-icon { margin-top: 2px; }
        .toast.toast-success i.toast-icon { color: #2f6f43; }
        .toast.toast-error i.toast-icon { color: #b13b2e; }
        .toast .toast-msg { flex: 1; line-height: 1.4; }
        .toast .toast-close { background: none; border: none; cursor: pointer; color: #a89b93; font-size: 0.85rem; padding: 0; }
        @media (max-width: 480px) {
            .toast-container { left: 12px; right: 12px; max-width: none; }
        }
    </style>
</head>
<body>
<div class="toast-container" id="toastContainer"></div>
<div class="container">
    <div class="header">
        <div><h1>⚙️ Admin eco.clayart</h1></div>
        <div>
            <a href="/" target="_blank" class="btn btn-secondary"><i class="fas fa-eye"></i> Lihat Web</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-secondary"><i class="fas fa-sign-out-alt"></i> Keluar</button>
            </form>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success" style="display:none;" id="serverSuccessMsg" data-msg="{{ session('success') }}"></div>
    @endif
    @if ($errors->any())
    <div id="serverErrorMsgs" style="display:none;">
        @foreach ($errors->all() as $error)
        <span class="server-error-item" data-msg="{{ $error }}"></span>
        @endforeach
    </div>
    @endif

    <div class="tabs">
        <button class="active" data-tab="general">Umum</button>
        <button data-tab="products">Produk</button>
        <button data-tab="testimonials">Testimoni</button>
        <button data-tab="orders">Pesanan</button>
    </div>

    <!-- Tab Umum -->
    <div class="tab-content active" id="tab-general">
        <div class="card">
            <h2>Pengaturan Umum</h2>
            <form method="POST" action="{{ route('admin.settings') }}" enctype="multipart/form-data" id="generalForm">
                @csrf
                <div class="grid-2">
                    <div class="field">
                        <label>Nama Brand Depan</label>
                        <input name="logo_prefix" value="{{ $settings['logo_prefix'] ?? 'eco.' }}">
                    </div>
                    <div class="field">
                        <label>Nama Brand Belakang</label>
                        <input name="logo_suffix" value="{{ $settings['logo_suffix'] ?? 'clayart' }}">
                    </div>
                    <div class="field">
                        <label>Judul Hero</label>
                        <input name="hero_title" value="{{ $settings['hero_title'] ?? 'Clay Art Custom Unik,' }}">
                    </div>
                    <div class="field">
                        <label>Highlight Hero</label>
                        <input name="hero_highlight" value="{{ $settings['hero_highlight'] ?? 'Sesuai Karaktermu' }}">
                    </div>
                    <div class="field">
                        <label>Tombol Hero</label>
                        <input name="hero_button" value="{{ $settings['hero_button'] ?? 'Custom Sekarang' }}">
                    </div>
                    <div class="field">
                        <label>Gambar Hero</label>
                        <input type="hidden" name="hero_image_existing" id="heroImageExisting" value="{{ $settings['hero_image'] ?? '' }}">
                        <input type="file" name="hero_image" id="heroImageInput" accept="image/jpeg,image/png,image/gif,image/webp,image/bmp">
                        <p class="file-hint">Maks 5MB. Otomatis dikonversi ke format WebP agar ringan. Kosongkan jika tidak ingin mengganti gambar.</p>
                        <p class="file-error" id="heroImageError"></p>
                        <img class="preview-img" id="heroImagePreview" src="{{ $settings['hero_image'] ?? '' }}" alt="preview" style="{{ ($settings['hero_image'] ?? '') ? '' : 'display:none;' }}">
                    </div>
                    <div class="field" style="grid-column: 1/-1;">
                        <label>Deskripsi Hero</label>
                        <textarea name="hero_description" rows="2">{{ $settings['hero_description'] ?? '' }}</textarea>
                    </div>
                    <div class="field">
                        <label>Shopee URL</label>
                        <input name="shopee_url" value="{{ $settings['shopee_url'] ?? 'https://shopee.co.id/ndouu' }}">
                    </div>
                    <div class="field">
                        <label>TikTok URL</label>
                        <input name="tiktok_url" value="{{ $settings['tiktok_url'] ?? '' }}">
                    </div>
                    <div class="field">
                        <label>WhatsApp Number</label>
                        <input name="whatsapp_number" value="{{ $settings['whatsapp_number'] ?? '6287745275007' }}">
                    </div>
                    <div class="field">
                        <label>WhatsApp Text</label>
                        <input name="whatsapp_text" value="{{ $settings['whatsapp_text'] ?? 'Halo eco.clayart' }}">
                    </div>
                    <div class="field" style="grid-column: 1/-1;">
                        <label>Footer (pisahkan dengan baris baru)</label>
                        <textarea name="footer_lines" rows="3">{{ $settings['footer_lines'] ?? "© 2026 eco.clayart - Handmade Clay Art from Yogyakarta\nKarangsari, Wedomartani, Ngemplak, Sleman, DIY 55584\nSetiap produk dibuat dengan cinta dan estetika" }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </form>
        </div>

        <div class="card">
            <h2>Warna &amp; Font</h2>
            <form method="POST" action="{{ route('admin.settings') }}" id="themeForm">
                @csrf
                <input type="hidden" name="hero_image_existing" value="{{ $settings['hero_image'] ?? '' }}">
                <div class="grid-2 color-grid">
                    <div class="field">
                        <label>Warna Utama (judul, ikon)</label>
                        <div class="color-field">
                            <input type="color" name="color_primary" value="{{ $settings['color_primary'] ?? '#3E3A39' }}">
                            <span class="color-code">{{ $settings['color_primary'] ?? '#3E3A39' }}</span>
                        </div>
                    </div>
                    <div class="field">
                        <label>Warna Aksen (highlight)</label>
                        <div class="color-field">
                            <input type="color" name="color_primary_light" value="{{ $settings['color_primary_light'] ?? '#C9A9A0' }}">
                            <span class="color-code">{{ $settings['color_primary_light'] ?? '#C9A9A0' }}</span>
                        </div>
                    </div>
                    <div class="field">
                        <label>Warna Latar Belakang</label>
                        <div class="color-field">
                            <input type="color" name="color_bg" value="{{ $settings['color_bg'] ?? '#FDF8F0' }}">
                            <span class="color-code">{{ $settings['color_bg'] ?? '#FDF8F0' }}</span>
                        </div>
                    </div>
                    <div class="field">
                        <label>Warna Teks Utama</label>
                        <div class="color-field">
                            <input type="color" name="color_text" value="{{ $settings['color_text'] ?? '#3E3A39' }}">
                            <span class="color-code">{{ $settings['color_text'] ?? '#3E3A39' }}</span>
                        </div>
                    </div>
                    <div class="field">
                        <label>Warna Teks Sekunder</label>
                        <div class="color-field">
                            <input type="color" name="color_text_light" value="{{ $settings['color_text_light'] ?? '#7A6E6A' }}">
                            <span class="color-code">{{ $settings['color_text_light'] ?? '#7A6E6A' }}</span>
                        </div>
                    </div>
                    <div class="field">
                        <label>Warna Latar Tombol</label>
                        <div class="color-field">
                            <input type="color" name="color_button_bg" value="{{ $settings['color_button_bg'] ?? $settings['color_primary'] ?? '#3E3A39' }}">
                            <span class="color-code">{{ $settings['color_button_bg'] ?? $settings['color_primary'] ?? '#3E3A39' }}</span>
                        </div>
                    </div>
                    <div class="field">
                        <label>Warna Teks Tombol</label>
                        <div class="color-field">
                            <input type="color" name="color_button_text" value="{{ $settings['color_button_text'] ?? '#FFFFFF' }}">
                            <span class="color-code">{{ $settings['color_button_text'] ?? '#FFFFFF' }}</span>
                        </div>
                    </div>
                </div>
                <div class="grid-2">
                    <div class="field">
                        <label>Font Judul / Logo</label>
                        <select name="font_heading">
                            @php $headingFont = $settings['font_heading'] ?? 'kalam'; @endphp
                            <option value="kalam" {{ $headingFont === 'kalam' ? 'selected' : '' }}>Kalam (tulisan tangan)</option>
                            <option value="playfair" {{ $headingFont === 'playfair' ? 'selected' : '' }}>Playfair Display (elegan)</option>
                            <option value="pacifico" {{ $headingFont === 'pacifico' ? 'selected' : '' }}>Pacifico (santai)</option>
                            <option value="dancing_script" {{ $headingFont === 'dancing_script' ? 'selected' : '' }}>Dancing Script</option>
                            <option value="caveat" {{ $headingFont === 'caveat' ? 'selected' : '' }}>Caveat</option>
                            <option value="inter" {{ $headingFont === 'inter' ? 'selected' : '' }}>Inter (modern/tegas)</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Font Isi / Body Text</label>
                        <select name="font_body">
                            @php $bodyFont = $settings['font_body'] ?? 'inter'; @endphp
                            <option value="inter" {{ $bodyFont === 'inter' ? 'selected' : '' }}>Inter</option>
                            <option value="poppins" {{ $bodyFont === 'poppins' ? 'selected' : '' }}>Poppins</option>
                            <option value="nunito" {{ $bodyFont === 'nunito' ? 'selected' : '' }}>Nunito</option>
                            <option value="montserrat" {{ $bodyFont === 'montserrat' ? 'selected' : '' }}>Montserrat</option>
                            <option value="quicksand" {{ $bodyFont === 'quicksand' ? 'selected' : '' }}>Quicksand</option>
                            <option value="lato" {{ $bodyFont === 'lato' ? 'selected' : '' }}>Lato</option>
                            <option value="roboto" {{ $bodyFont === 'roboto' ? 'selected' : '' }}>Roboto</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Warna &amp; Font</button>
            </form>
        </div>
    </div>

    <!-- Tab Produk -->
    <div class="tab-content" id="tab-products">
        @php
            $productsForJson = $products->map(fn($p) => [
                'image' => $p->image_url,
                'title' => $p->title,
                'description' => $p->description,
                'price' => $p->price,
                'shopeeUrl' => $p->shopee_url,
            ]);
        @endphp
        <div class="card">
            <h2>Kelola Produk</h2>
            <form method="POST" action="{{ route('admin.products') }}" id="productForm" enctype="multipart/form-data">
                @csrf

                <button type="button" class="btn btn-secondary add-item-btn" id="addProductBtn"><i class="fas fa-plus"></i> Tambah Produk</button>

                <div id="productList"></div>
                <div id="productEmptyHint" class="empty-hint" style="display:none;">Belum ada produk. Klik "Tambah Produk" untuk menambahkan.</div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Produk</button>
            </form>
        </div>
    </div>

    <!-- Tab Testimoni -->
    <div class="tab-content" id="tab-testimonials">
        @php
            $testimonialsForJson = $testimonials->map(fn($t) => [
                'quote' => $t->quote,
                'author' => $t->author,
            ]);
        @endphp
        <div class="card">
            <h2>Kelola Testimoni</h2>
            <form method="POST" action="{{ route('admin.testimonials') }}" id="testimonialForm">
                @csrf
                <input type="hidden" name="testimonials" id="testimonialsJsonInput">

                <button type="button" class="btn btn-secondary add-item-btn" id="addTestimonialBtn"><i class="fas fa-plus"></i> Tambah Testimoni</button>

                <div id="testimonialList"></div>
                <div id="testimonialEmptyHint" class="empty-hint" style="display:none;">Belum ada testimoni. Klik "Tambah Testimoni" untuk menambahkan.</div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Testimoni</button>
            </form>
        </div>
    </div>

    <!-- Tab Pesanan -->
    <div class="tab-content" id="tab-orders">
        <div class="card">
            <h2>Daftar Pesanan</h2>

            @php
                $statusLabels = [
                    'menunggu' => 'Menunggu',
                    'dikonfirmasi' => 'Dikonfirmasi',
                    'diproduksi' => 'Diproduksi',
                    'dikirim' => 'Dikirim',
                    'selesai' => 'Selesai',
                ];
            @endphp

            <div class="order-filters">
                <a href="{{ route('admin.index') }}#tab-orders" data-tab-link="orders" class="{{ !$orderStatusFilter ? 'active' : '' }}">
                    Semua <span class="count">{{ $orderCounts['semua'] }}</span>
                </a>
                @foreach($statusLabels as $val => $label)
                <a href="{{ route('admin.index', ['status' => $val]) }}#tab-orders" data-tab-link="orders" class="{{ $orderStatusFilter === $val ? 'active' : '' }}">
                    {{ $label }} <span class="count">{{ $orderCounts[$val] }}</span>
                </a>
                @endforeach
            </div>

            @if($orders->count())
                @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-card-header">
                        <div>
                            <span class="order-id">{{ $order->order_id }}</span>
                            <span class="order-date">{{ $order->created_at->translatedFormat('d M Y, H:i') }}</span>
                        </div>
                        <form method="POST" action="{{ route('admin.order.delete', $order->id) }}" onsubmit="return confirm('Hapus pesanan {{ $order->order_id }}? Tindakan ini tidak bisa dibatalkan.');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding:6px 12px;font-size:0.8rem;"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </div>
                    <div class="order-card-body">
                        <div><i class="fas fa-user"></i>{{ $order->customer_name }}</div>
                        <div>
                            <i class="fas fa-phone"></i>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->phone) }}" target="_blank">{{ $order->phone }}</a>
                        </div>
                        <div><i class="fas fa-box"></i>{{ $order->product_name }} &times; {{ $order->quantity }} pcs</div>
                        @if($order->custom_description)
                        <div class="order-desc"><i class="fas fa-comment-dots"></i> {{ $order->custom_description }}</div>
                        @endif
                    </div>
                    <div class="order-card-footer">
                        <form method="POST" action="{{ route('admin.order.status', $order->id) }}">
                            @csrf
                            <select name="status" class="badge status-select badge-{{ $order->status }}" onchange="this.className = 'badge status-select badge-' + this.value; this.form.submit();">
                                @foreach($statusLabels as $val => $label)
                                <option value="{{ $val }}" {{ $order->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                @endforeach
            @else
                <p style="color:#7d716c;">Belum ada pesanan{{ $orderStatusFilter ? ' dengan status ini' : '' }}.</p>
            @endif
        </div>
    </div>
</div>

<script>
// Fungsi global untuk menampilkan notifikasi pop-up (toast)
function showToast(message, type = 'success', duration = 4500) {
    if (!message) return;
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    const icon = type === 'error' ? 'fa-circle-exclamation' : 'fa-circle-check';
    toast.innerHTML = `
        <i class="fas ${icon} toast-icon"></i>
        <span class="toast-msg"></span>
        <button type="button" class="toast-close"><i class="fas fa-xmark"></i></button>
    `;
    toast.querySelector('.toast-msg').textContent = message;
    container.appendChild(toast);
    requestAnimationFrame(() => toast.classList.add('show'));

    const remove = () => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 250);
    };
    toast.querySelector('.toast-close').addEventListener('click', remove);
    setTimeout(remove, duration);
}

// Tampilkan pesan dari server (sukses/error) sebagai pop-up saat halaman dimuat
(function () {
    const successEl = document.getElementById('serverSuccessMsg');
    if (successEl) showToast(successEl.dataset.msg, 'success');

    document.querySelectorAll('#serverErrorMsgs .server-error-item').forEach(el => {
        showToast(el.dataset.msg, 'error');
    });
})();

document.querySelectorAll('.tabs button').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.tabs button').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('tab-' + this.dataset.tab).classList.add('active');
    });
});

// Buka tab Pesanan otomatis jika datang dari link filter status (?status=...#tab-orders)
if (window.location.hash === '#tab-orders' || window.location.search.includes('status=')) {
    const ordersBtn = document.querySelector('.tabs button[data-tab="orders"]');
    if (ordersBtn) ordersBtn.click();
}

function escapeHtml(str) {
    return String(str ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

/* ===== Pengaturan Umum: Gambar Hero ===== */
(function () {
    const MAX_SIZE_BYTES = 5 * 1024 * 1024; // 5MB
    const fileInput = document.getElementById('heroImageInput');
    const preview = document.getElementById('heroImagePreview');
    const errorEl = document.getElementById('heroImageError');
    if (!fileInput) return;

    fileInput.addEventListener('change', () => {
        errorEl.style.display = 'none';
        errorEl.textContent = '';

        const file = fileInput.files[0];
        if (!file) return;

        if (file.size > MAX_SIZE_BYTES) {
            errorEl.textContent = 'Ukuran file terlalu besar (maks 5MB). Silakan pilih gambar lain.';
            errorEl.style.display = 'block';
            fileInput.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            preview.src = e.target.result;
            preview.style.display = '';
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('generalForm').addEventListener('submit', function (e) {
        const file = fileInput.files[0];
        if (file && file.size > MAX_SIZE_BYTES) {
            e.preventDefault();
            showToast('Ukuran gambar hero melebihi 5MB. Silakan periksa kembali.', 'error');
        }
    });
})();

/* ===== Warna & Font: label kode warna live ===== */
(function () {
    document.querySelectorAll('.color-field input[type="color"]').forEach(input => {
        const codeEl = input.nextElementSibling;
        input.addEventListener('input', () => {
            if (codeEl) codeEl.textContent = input.value.toUpperCase();
        });
    });
})();

/* ===== Kelola Produk ===== */
(function () {
    const MAX_SIZE_BYTES = 5 * 1024 * 1024; // 5MB
    const initialProducts = @json($productsForJson);
    const list = document.getElementById('productList');
    const emptyHint = document.getElementById('productEmptyHint');
    let counter = 0;

    function toggleEmptyHint() {
        emptyHint.style.display = list.children.length ? 'none' : 'block';
    }

    function createProductItem(data = {}) {
        const idx = counter++;
        const item = document.createElement('div');
        item.className = 'item-card';
        item.innerHTML = `
            <button type="button" class="remove-item-btn" title="Hapus produk"><i class="fas fa-times"></i></button>
            <div class="item-number">Produk</div>
            <input type="hidden" name="products[${idx}][existing_image]" class="p-existing-image" value="${escapeHtml(data.image)}">
            <div class="grid-2">
                <div class="field">
                    <label>Judul Produk</label>
                    <input name="products[${idx}][title]" value="${escapeHtml(data.title)}" placeholder="Cover Korek Custom">
                </div>
                <div class="field">
                    <label>Harga</label>
                    <input name="products[${idx}][price]" value="${escapeHtml(data.price)}" placeholder="Mulai Rp35.000">
                </div>
            </div>
            <div class="field">
                <label>Deskripsi</label>
                <textarea name="products[${idx}][description]" rows="2" placeholder="Kecil, lucu, dan personal.">${escapeHtml(data.description)}</textarea>
            </div>
            <div class="field">
                <label>Link Shopee</label>
                <input name="products[${idx}][shopee_url]" value="${escapeHtml(data.shopeeUrl)}" placeholder="https://shopee.co.id/...">
            </div>
            <div class="field">
                <label>Gambar Produk</label>
                <input type="file" accept="image/jpeg,image/png,image/gif,image/webp,image/bmp" class="p-image-input">
                <p class="file-hint">Maks 5MB. Otomatis dikonversi ke format WebP agar ringan. Kosongkan jika tidak ingin mengganti gambar.</p>
                <p class="file-error"></p>
                <img class="preview-img" src="${escapeHtml(data.image)}" alt="preview" style="${data.image ? '' : 'display:none;'}">
            </div>
        `;

        item.querySelector('.remove-item-btn').addEventListener('click', () => {
            item.remove();
            toggleEmptyHint();
        });

        const fileInput = item.querySelector('.p-image-input');
        const previewImg = item.querySelector('.preview-img');
        const fileError = item.querySelector('.file-error');
        const existingImageInput = item.querySelector('.p-existing-image');

        fileInput.name = `products[${idx}][image]`;

        fileInput.addEventListener('change', () => {
            fileError.style.display = 'none';
            fileError.textContent = '';

            const file = fileInput.files[0];
            if (!file) return;

            if (file.size > MAX_SIZE_BYTES) {
                fileError.textContent = 'Ukuran file terlalu besar (maks 5MB). Silakan pilih gambar lain.';
                fileError.style.display = 'block';
                fileInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                previewImg.src = e.target.result;
                previewImg.style.display = '';
            };
            reader.readAsDataURL(file);
        });

        previewImg.addEventListener('error', () => { previewImg.style.display = 'none'; });

        list.appendChild(item);
        toggleEmptyHint();
    }

    initialProducts.forEach(p => createProductItem(p));
    toggleEmptyHint();

    document.getElementById('addProductBtn').addEventListener('click', () => createProductItem());

    document.getElementById('productForm').addEventListener('submit', function (e) {
        const oversized = [...list.querySelectorAll('.p-image-input')].some(input => input.files[0] && input.files[0].size > MAX_SIZE_BYTES);
        if (oversized) {
            e.preventDefault();
            showToast('Ada gambar produk yang melebihi 5MB. Silakan periksa kembali.', 'error');
        }
    });
})();

/* ===== Kelola Testimoni ===== */
(function () {
    const initialTestimonials = @json($testimonialsForJson);
    const list = document.getElementById('testimonialList');
    const emptyHint = document.getElementById('testimonialEmptyHint');

    function toggleEmptyHint() {
        emptyHint.style.display = list.children.length ? 'none' : 'block';
    }

    function createTestimonialItem(data = {}) {
        const item = document.createElement('div');
        item.className = 'item-card';
        item.innerHTML = `
            <button type="button" class="remove-item-btn" title="Hapus testimoni"><i class="fas fa-times"></i></button>
            <div class="item-number">Testimoni</div>
            <div class="field">
                <label>Isi Testimoni</label>
                <textarea class="t-quote" rows="2" placeholder="Hasilnya bagus banget, sesuai request!">${escapeHtml(data.quote)}</textarea>
            </div>
            <div class="field">
                <label>Nama Pemberi Testimoni</label>
                <input class="t-author" value="${escapeHtml(data.author)}" placeholder="Nama pelanggan">
            </div>
        `;

        item.querySelector('.remove-item-btn').addEventListener('click', () => {
            item.remove();
            toggleEmptyHint();
        });

        list.appendChild(item);
        toggleEmptyHint();
    }

    initialTestimonials.forEach(t => createTestimonialItem(t));
    toggleEmptyHint();

    document.getElementById('addTestimonialBtn').addEventListener('click', () => createTestimonialItem());

    document.getElementById('testimonialForm').addEventListener('submit', function () {
        const items = [...list.querySelectorAll('.item-card')].map(el => ({
            quote: el.querySelector('.t-quote').value,
            author: el.querySelector('.t-author').value,
        }));
        document.getElementById('testimonialsJsonInput').value = JSON.stringify(items);
    });
})();
</script>
</body>
</html>