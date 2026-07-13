@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <h1>{{ $settings['logo_prefix'] ?? 'eco.' }}<span>{{ $settings['logo_suffix'] ?? 'clayart' }}</span></h1>
        </div>
        <div class="nav-links">
            <a href="#produk">Produk</a>
            <a href="#custom-order">Custom Order</a>
            <a href="#tracking">Tracking</a>
            <a href="#testimoni">Testimoni</a>
        </div>
    </nav>

    <!-- Hero -->
    <div class="hero">
        <div class="hero-content">
            <h1>{{ $settings['hero_title'] ?? 'Clay Art Custom Unik,' }}
                <span class="hero-highlight">{{ $settings['hero_highlight'] ?? 'Sesuai Karaktermu' }}</span>
            </h1>
            <p>{{ $settings['hero_description'] ?? 'Hadiah handmade aesthetic untuk pasangan, sahabat, dan koleksi pribadi.' }}</p>
            <a href="#custom-order" class="btn-primary">🎨 {{ $settings['hero_button'] ?? 'Custom Sekarang' }}</a>
        </div>
        <div class="hero-image">
            <img src="{{ $settings['hero_image'] ?? 'https://i.pinimg.com/736x/5e/5f/70/5e5f70645a4403e6c16469fc71471df2.jpg' }}" alt="Clay Art">
        </div>
    </div>

    <!-- Products -->
    <div id="produk" class="section">
        <h2 class="section-title">{{ $settings['products_title'] ?? '🌿 Produk Unggulan Kami' }}</h2>
        <p class="section-sub">{{ $settings['products_subtitle'] ?? 'Klik tombol Shopee untuk langsung order di marketplace' }}</p>
        <div class="product-grid">
            @foreach($products as $product)
            <div class="product-card">
                <img src="{{ $product->image_url }}" alt="{{ $product->title }}">
                <h3>{{ $product->title }}</h3>
                <p>{{ $product->description }}</p>
                <div class="price">{{ $product->price }}</div>
                <a href="{{ $product->shopee_url ?? $settings['shopee_url'] ?? '#' }}" target="_blank" class="shopee-link">
                    <i class="fab fa-shopee"></i> Beli di Shopee
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Custom Order Form -->
    <div id="custom-order" class="section">
        <h2 class="section-title">{{ $settings['custom_title'] ?? '✏️ Custom Order' }}</h2>
        <p class="section-sub">{{ $settings['custom_subtitle'] ?? 'Isi form di bawah untuk memesan produk sesuai keinginanmu.' }}</p>
        <div class="form-container">
            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="customer_name" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor WhatsApp</label>
                        <input type="tel" name="phone" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Jenis Produk</label>
                        <select name="product_name" required>
                            <option value="">Pilih produk</option>
                            @foreach($products as $product)
                            <option value="{{ $product->title }}">{{ $product->title }}</option>
                            @endforeach
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="quantity" value="1" min="1">
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi Custom</label>
                    <textarea name="custom_description" rows="4" placeholder="Warna, karakter, nama, dll..."></textarea>
                </div>
                <button type="submit" class="btn-submit"><i class="fab fa-whatsapp"></i> Kirim Pesanan</button>
            </form>
        </div>
    </div>

    <!-- Tracking -->
    <div id="tracking" class="tracking-section">
        <h2 class="section-title">{{ $settings['tracking_title'] ?? '📦 Tracking Pesanan' }}</h2>
        <p class="section-sub">{{ $settings['tracking_subtitle'] ?? 'Cek status pesanan kamu di sini' }}</p>
        <div class="tracking-input-group">
            <input type="text" id="orderId" placeholder="Masukkan Order ID (ECOxxxx)">
            <button onclick="trackOrder()" class="btn-primary">Cek Status</button>
        </div>
        <div id="orderStatusResult"></div>
    </div>

    <!-- Features -->
    <div class="section">
        <h2 class="section-title">✨ Kenapa Memilih Kami?</h2>
        <div class="features-grid">
            @foreach($features as $feature)
            <div class="feature-item">
                <i class="{{ $feature['icon'] }}"></i>
                <h3>{{ $feature['title'] }}</h3>
                <p>{{ $feature['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Testimonials -->
    <div id="testimoni" class="section">
        @foreach($testimonials as $testimonial)
        <div class="testimoni-card" style="{{ $loop->first ? '' : 'margin-top:30px;background:#F9F3EF;' }}">
            <i class="fas fa-quote-left" style="font-size:2rem;color:#C9A9A0;opacity:.6;"></i>
            <p>"{{ $testimonial->quote }}"</p>
            <strong>- {{ $testimonial->author }}</strong>
        </div>
        @endforeach
    </div>

    <!-- CTA -->
    <div class="cta-section" id="kontak">
        <h2>{{ $settings['cta_title'] ?? '🎁 Buat versi custom kamu sekarang!' }}</h2>
        <p>{{ $settings['cta_subtitle'] ?? 'Konsultasi desain gratis via chat atau langsung order di Shopee.' }}</p>
        <div class="cta-buttons">
            <a href="{{ $settings['shopee_url'] ?? '#' }}" target="_blank" class="social-btn"><i class="fab fa-shopee"></i> Shopee</a>
            <a href="{{ $settings['tiktok_url'] ?? '#' }}" target="_blank" class="social-btn"><i class="fab fa-tiktok"></i> TikTok</a>
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6287745275007' }}?text={{ urlencode($settings['whatsapp_text'] ?? 'Halo eco.clayart') }}" target="_blank" class="social-btn"><i class="fab fa-whatsapp"></i> WhatsApp</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        @foreach(explode("\n", $settings['footer_lines'] ?? "© 2026 eco.clayart - Handmade Clay Art from Yogyakarta\nKarangsari, Wedomartani, Ngemplak, Sleman, DIY 55584\nSetiap produk dibuat dengan cinta dan estetika") as $line)
        <p>{{ $line }}</p>
        @endforeach
    </footer>
</div>

<!-- Live Chat -->
<button class="chat-button" id="chatButton">
    <i class="fab fa-whatsapp"></i>
</button>
<div class="chat-modal" id="chatModal">
    <div class="chat-header">
        <span><i class="fas fa-comment-dots"></i> Live Chat</span>
        <button class="chat-close" id="chatClose">✕</button>
    </div>
    <div class="chat-body" id="chatBody">
        <div class="chat-message bot">👋 {{ $settings['chat_welcome'] ?? 'Halo! Ada yang bisa kami bantu?' }}</div>
    </div>
    <div class="chat-input-area">
        <input type="text" id="chatInput" placeholder="Tulis pesan...">
        <button class="chat-send" id="chatSend"><i class="fas fa-paper-plane"></i></button>
    </div>
</div>

<script>
// Tracking function with AJAX
function trackOrder() {
    const orderId = document.getElementById('orderId').value.trim().toUpperCase();
    const resultDiv = document.getElementById('orderStatusResult');

    if(!orderId) {
        showToast('Masukkan Order ID!', 'error');
        return;
    }

    fetch(`/order/track/${orderId}`)
        .then(res => res.json())
        .then(data => {
            if(data.error) {
                resultDiv.innerHTML = `<div class="order-status-card" style="text-align:center;color:#D32F2F;">
                    <p>⚠️ ${data.error}</p>
                </div>`;
                return;
            }

            const statuses = ['menunggu', 'dikonfirmasi', 'diproduksi', 'dikirim', 'selesai'];
            const labels = ['Menunggu Konfirmasi', 'Dikonfirmasi', 'Sedang Diproduksi', 'Dikirim', 'Selesai'];
            const currentStep = statuses.indexOf(data.status) + 1;

            let stepsHtml = labels.map((label, i) => {
                const step = i + 1;
                let cls = '';
                if(step <= currentStep) cls = 'completed';
                if(step === currentStep) cls += ' active';
                return `<div class="status-step ${cls}">
                    <div class="status-icon">${step}</div>
                    <div>${label}</div>
                </div>`;
            }).join('');

            resultDiv.innerHTML = `
                <div class="order-status-card">
                    <h3>📋 Detail Pesanan</h3>
                    <p><strong>Order ID:</strong> ${data.order_id}</p>
                    <p><strong>Nama:</strong> ${data.customer_name}</p>
                    <p><strong>Produk:</strong> ${data.product_name}</p>
                    <p><strong>Status:</strong> <span style="color:#C9A9A0;font-weight:bold;">${labels[currentStep-1]}</span></p>
                    <div style="margin-top:20px;">${stepsHtml}</div>
                </div>
            `;
        });
}
</script>

<script>
// Live Chat
const chatButton = document.getElementById('chatButton');
const chatModal = document.getElementById('chatModal');
const chatClose = document.getElementById('chatClose');
const chatBody = document.getElementById('chatBody');
const chatInput = document.getElementById('chatInput');
const chatSend = document.getElementById('chatSend');

chatButton.addEventListener('click', () => chatModal.classList.toggle('active'));
chatClose.addEventListener('click', () => chatModal.classList.remove('active'));

function addMessage(text, isUser = false) {
    const div = document.createElement('div');
    div.className = `chat-message ${isUser ? 'user' : 'bot'}`;
    div.textContent = text;
    chatBody.appendChild(div);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function sendMessage() {
    const message = chatInput.value.trim();
    if(!message) return;

    addMessage(message, true);
    chatInput.value = '';

    // Simple auto-reply
    setTimeout(() => {
        const msg = message.toLowerCase();
        let reply = 'Terima kasih pesannya! Admin akan segera membalas. 😊';
        if(msg.includes('harga')) reply = '💸 Harga mulai Rp20.000 - Rp40.000 tergantung produk.';
        else if(msg.includes('estimasi') || msg.includes('lama')) reply = '⏱️ Pengerjaan 1-4 hari tergantung kompleksitas.';
        else if(msg.includes('bahan')) reply = '🧵 Menggunakan clay premium dan resin anti pecah.';
        addMessage(reply, false);
    }, 500);
}

chatSend.addEventListener('click', sendMessage);
chatInput.addEventListener('keypress', e => { if(e.key === 'Enter') sendMessage(); });
</script>

<script>
// Tampilkan error validasi form (jika ada) sebagai notifikasi pop-up
@if ($errors->any())
    document.addEventListener('DOMContentLoaded', () => {
        @foreach ($errors->all() as $error)
            showToast(@json($error), 'error');
        @endforeach
    });
@endif
</script>
@endsection