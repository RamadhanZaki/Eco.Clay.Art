<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eco.clayart - Handmade Custom Clay Art</title>
    @php
        // Whitelist font agar aman disisipkan ke URL Google Fonts (bukan dari input bebas)
        $bodyFontMap = [
            'inter' => ['name' => 'Inter', 'weights' => '300;400;500;600;700'],
            'poppins' => ['name' => 'Poppins', 'weights' => '300;400;500;600;700'],
            'nunito' => ['name' => 'Nunito', 'weights' => '300;400;600;700'],
            'montserrat' => ['name' => 'Montserrat', 'weights' => '300;400;500;600;700'],
            'quicksand' => ['name' => 'Quicksand', 'weights' => '300;400;500;600;700'],
            'lato' => ['name' => 'Lato', 'weights' => '300;400;700'],
            'roboto' => ['name' => 'Roboto', 'weights' => '300;400;500;700'],
        ];
        $headingFontMap = [
            'kalam' => ['name' => 'Kalam', 'weights' => '300;400;700'],
            'playfair' => ['name' => 'Playfair Display', 'weights' => '400;600;700'],
            'pacifico' => ['name' => 'Pacifico', 'weights' => '400'],
            'dancing_script' => ['name' => 'Dancing Script', 'weights' => '400;600;700'],
            'caveat' => ['name' => 'Caveat', 'weights' => '400;600;700'],
            'inter' => ['name' => 'Inter', 'weights' => '600;700'],
        ];
        $bodyFont = $bodyFontMap[$settings['font_body'] ?? 'inter'] ?? $bodyFontMap['inter'];
        $headingFont = $headingFontMap[$settings['font_heading'] ?? 'kalam'] ?? $headingFontMap['kalam'];

        // Validasi warna: hanya terima format hex, fallback ke default jika tidak valid
        $safeColor = function ($value, $default) {
            $value = trim((string) $value);
            return preg_match('/^#[A-Fa-f0-9]{3,8}$/', $value) ? $value : $default;
        };
        $colorPrimary = $safeColor($settings['color_primary'] ?? null, '#3E3A39');
        $colorPrimaryLight = $safeColor($settings['color_primary_light'] ?? null, '#C9A9A0');
        $colorBg = $safeColor($settings['color_bg'] ?? null, '#FDF8F0');
        $colorText = $safeColor($settings['color_text'] ?? null, '#3E3A39');
        $colorTextLight = $safeColor($settings['color_text_light'] ?? null, '#7A6E6A');
        $colorButtonBg = $safeColor($settings['color_button_bg'] ?? null, $colorPrimary);
        $colorButtonText = $safeColor($settings['color_button_text'] ?? null, '#FFFFFF');
    @endphp
    <link href="https://fonts.googleapis.com/css2?family={{ str_replace(' ', '+', $bodyFont['name']) }}:wght@{{ $bodyFont['weights'] }}&family={{ str_replace(' ', '+', $headingFont['name']) }}:wght@{{ $headingFont['weights'] }}&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: {{ $colorPrimary }};
            --primary-light: {{ $colorPrimaryLight }};
            --bg: {{ $colorBg }};
            --text: {{ $colorText }};
            --text-light: {{ $colorTextLight }};
            --btn-bg: {{ $colorButtonBg }};
            --btn-text: {{ $colorButtonText }};
            --font-body: '{{ $bodyFont['name'] }}', sans-serif;
            --font-heading: '{{ $headingFont['name'] }}', cursive;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: var(--font-body); background-color: var(--bg); color: var(--text); line-height: 1.5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
        a { text-decoration: none; color: inherit; }
        img { max-width: 100%; display: block; }

        /* Navbar */
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 24px 0; flex-wrap: wrap; gap: 16px; }
        .logo h1 { font-family: var(--font-heading); font-size: 1.8rem; color: var(--primary); }
        .logo h1 span { color: var(--primary-light); }
        .nav-links { display: flex; align-items: center; gap: 28px; flex-wrap: wrap; }
        .nav-links a { font-weight: 500; color: var(--text); transition: color .2s; }
        .nav-links a:hover { color: var(--primary-light); }

        /* Buttons */
        .btn-primary, .btn-outline, .btn-submit, .social-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 12px 28px; border-radius: 40px; font-weight: 600;
            border: none; cursor: pointer; transition: transform .2s, box-shadow .2s;
        }
        .btn-primary { background: var(--btn-bg); color: var(--btn-text); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(62,58,57,0.25); }
        .btn-outline { background: transparent; border: 2px solid var(--primary); color: var(--primary); padding: 10px 26px; }
        .btn-outline:hover { background: var(--primary); color: #fff; }
        .btn-submit { background: #25D366; color: #fff; width: 100%; justify-content: center; padding: 14px; font-size: 1rem; }
        .btn-submit:hover { background: #1ebe57; }
        .social-btn { background: #fff; color: var(--primary); box-shadow: 0 4px 14px rgba(0,0,0,0.08); }
        .social-btn:hover { transform: translateY(-2px); }

        /* Hero */
        .hero { display: flex; align-items: center; gap: 48px; padding: 40px 0 80px; flex-wrap: wrap; }
        .hero-content { flex: 1; min-width: 280px; }
        .hero-content h1 { font-size: 2.6rem; line-height: 1.25; margin-bottom: 20px; color: var(--primary); }
        .hero-highlight { display: block; font-family: var(--font-heading); color: var(--primary-light); }
        .hero-content p { color: var(--text-light); font-size: 1.1rem; margin-bottom: 28px; max-width: 480px; }
        .hero-image { flex: 1; min-width: 280px; }
        .hero-image img { border-radius: 24px; box-shadow: 0 20px 50px rgba(62,58,57,0.15); }

        /* Sections */
        .section { padding: 60px 0; }
        .section-title { text-align: center; font-size: 2rem; color: var(--primary); margin-bottom: 8px; }
        .section-sub { text-align: center; color: var(--text-light); margin-bottom: 40px; }

        /* Product grid */
        .product-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 28px; }
        .product-card { background: #fff; border-radius: 18px; padding: 20px; text-align: center; box-shadow: 0 6px 20px rgba(62,58,57,0.08); transition: transform .2s; }
        .product-card:hover { transform: translateY(-6px); }
        .product-card img { border-radius: 12px; margin-bottom: 16px; aspect-ratio: 1/1; object-fit: cover; }
        .product-card h3 { font-size: 1.1rem; margin-bottom: 6px; color: var(--primary); }
        .product-card p { color: var(--text-light); font-size: 0.9rem; margin-bottom: 12px; }
        .price { font-weight: 700; color: var(--primary); margin-bottom: 16px; font-size: 1.1rem; }
        .shopee-link { display: inline-flex; align-items: center; gap: 8px; background: #EE4D2D; color: #fff; padding: 10px 20px; border-radius: 30px; font-weight: 600; font-size: 0.9rem; }
        .shopee-link:hover { background: #d43f21; }

        /* Custom order form */
        .form-container { max-width: 640px; margin: 0 auto; background: #fff; padding: 40px; border-radius: 20px; box-shadow: 0 6px 24px rgba(62,58,57,0.08); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.9rem; }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%; padding: 12px 16px; border: 1px solid #e5dcd5; border-radius: 10px;
            font-family: inherit; font-size: 0.95rem; background: var(--bg);
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none; border-color: var(--primary-light);
        }
        .form-group textarea { resize: vertical; }

        /* Tracking */
        .tracking-section { padding: 60px 0; background: #F3E9E1; text-align: center; }
        .tracking-input-group { display: flex; justify-content: center; gap: 12px; max-width: 480px; margin: 0 auto 24px; flex-wrap: wrap; }
        .tracking-input-group input { flex: 1; min-width: 200px; padding: 12px 18px; border-radius: 30px; border: 1px solid #e5dcd5; font-family: inherit; }
        .order-status-card { max-width: 480px; margin: 24px auto 0; background: #fff; padding: 24px; border-radius: 16px; text-align: left; box-shadow: 0 6px 20px rgba(62,58,57,0.08); }
        .order-status-card h3 { margin-bottom: 12px; color: var(--primary); }
        .order-status-card p { margin-bottom: 6px; font-size: 0.95rem; }
        .status-step { display: flex; align-items: center; gap: 12px; padding: 8px 0; color: var(--text-light); }
        .status-step.completed { color: var(--primary); font-weight: 600; }
        .status-icon { width: 26px; height: 26px; border-radius: 50%; background: #e5dcd5; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; flex-shrink: 0; }
        .status-step.completed .status-icon { background: var(--primary); }
        .status-step.active .status-icon { background: var(--primary-light); }

        /* Features */
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 28px; }
        .feature-item { text-align: center; padding: 24px; }
        .feature-item i { font-size: 2rem; color: var(--primary-light); margin-bottom: 16px; }
        .feature-item h3 { margin-bottom: 8px; color: var(--primary); font-size: 1.05rem; }
        .feature-item p { color: var(--text-light); font-size: 0.9rem; }

        /* Testimonials */
        .testimoni-card { max-width: 640px; margin: 0 auto; background: #fff; padding: 32px; border-radius: 18px; text-align: center; box-shadow: 0 6px 20px rgba(62,58,57,0.08); }
        .testimoni-card p { font-style: italic; margin: 16px 0; font-size: 1.05rem; }
        .testimoni-card strong { color: var(--primary-light); }

        /* CTA */
        .cta-section { background: var(--primary); color: #fff; text-align: center; padding: 70px 24px; border-radius: 24px; margin: 40px 0; }
        .cta-section h2 { font-size: 1.8rem; margin-bottom: 12px; }
        .cta-section p { opacity: .85; margin-bottom: 28px; }
        .cta-buttons { display: flex; justify-content: center; gap: 16px; flex-wrap: wrap; }

        /* Footer */
        .footer { text-align: center; padding: 40px 0; color: var(--text-light); font-size: 0.9rem; }
        .footer p { margin-bottom: 4px; }

        /* Live chat widget */
        .chat-button {
            position: fixed; bottom: 24px; right: 24px; width: 60px; height: 60px; border-radius: 50%;
            background: #25D366; color: #fff; border: none; font-size: 1.5rem; cursor: pointer;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2); z-index: 999;
        }
        .chat-modal {
            position: fixed; bottom: 96px; right: 24px; width: 320px; max-height: 440px; background: #fff;
            border-radius: 16px; box-shadow: 0 12px 40px rgba(0,0,0,0.2); display: flex; flex-direction: column;
            overflow: hidden; opacity: 0; pointer-events: none; transform: translateY(20px); transition: all .25s; z-index: 999;
        }
        .chat-modal.active { opacity: 1; pointer-events: auto; transform: translateY(0); }
        .chat-header { background: var(--primary); color: #fff; padding: 16px; display: flex; justify-content: space-between; align-items: center; }
        .chat-close { background: none; border: none; color: #fff; font-size: 1rem; cursor: pointer; }
        .chat-body { flex: 1; padding: 16px; overflow-y: auto; display: flex; flex-direction: column; gap: 10px; max-height: 280px; }
        .chat-message { padding: 10px 14px; border-radius: 14px; font-size: 0.9rem; max-width: 80%; }
        .chat-message.bot { background: #f0ebe7; align-self: flex-start; }
        .chat-message.user { background: var(--primary); color: #fff; align-self: flex-end; }
        .chat-input-area { display: flex; border-top: 1px solid #eee; }
        .chat-input-area input { flex: 1; border: none; padding: 12px 16px; font-family: inherit; }
        .chat-input-area input:focus { outline: none; }
        .chat-send { background: none; border: none; color: var(--primary); padding: 0 16px; cursor: pointer; }

        @media (max-width: 768px) {
            .hero { padding: 20px 0 60px; }
            .hero-content h1 { font-size: 2rem; }
            .form-row { grid-template-columns: 1fr; }
            .nav-links { gap: 16px; font-size: 0.9rem; }
        }

        /* Admin preview styling */
        .admin-preview { border: 2px dashed #C9A9A0; padding: 16px; border-radius: 12px; margin: 8px 0; background: rgba(201,169,160,0.05); }
        .admin-preview .hint { font-size: 0.8rem; color: #C9A9A0; }

        /* Toast notification (pop-up) */
        .toast-container {
            position: fixed; top: 20px; right: 20px; z-index: 2000;
            display: flex; flex-direction: column; gap: 10px; max-width: 360px;
        }
        .toast {
            display: flex; align-items: flex-start; gap: 10px;
            background: #fff; color: var(--text); padding: 14px 16px; border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15); font-size: 0.92rem;
            border-left: 4px solid var(--primary); opacity: 0; transform: translateX(30px);
            transition: opacity .25s, transform .25s;
        }
        .toast.show { opacity: 1; transform: translateX(0); }
        .toast.toast-success { border-left-color: #2f6f43; }
        .toast.toast-error { border-left-color: #b13b2e; }
        .toast i.toast-icon { margin-top: 2px; }
        .toast.toast-success i.toast-icon { color: #2f6f43; }
        .toast.toast-error i.toast-icon { color: #b13b2e; }
        .toast .toast-msg { flex: 1; line-height: 1.4; }
        .toast .toast-close { background: none; border: none; cursor: pointer; color: var(--text-light); font-size: 0.85rem; padding: 0; }
        @media (max-width: 480px) {
            .toast-container { left: 12px; right: 12px; max-width: none; }
        }
    </style>
</head>
<body>
    <div class="toast-container" id="toastContainer"></div>
    @yield('content')

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
    </script>
</body>
</html>