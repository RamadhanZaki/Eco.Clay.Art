<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - eco.clayart</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: Inter, sans-serif;
            background: #f7f2ec;
            color: #332f2d;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }
        .login-header { text-align: center; margin-bottom: 28px; }
        .login-header .icon {
            width: 56px; height: 56px;
            background: #332f2d; color: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            margin: 0 auto 16px;
        }
        .login-header h1 { font-size: 1.3rem; margin: 0 0 4px; }
        .login-header p { color: #7a6e6a; font-size: 0.9rem; margin: 0; }
        .field { margin-bottom: 18px; }
        .field label { display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 6px; }
        .field input {
            width: 100%; padding: 12px 14px;
            border: 1px solid #decfc6; border-radius: 8px;
            font-family: inherit; font-size: 0.95rem;
        }
        .field input:focus { outline: none; border-color: #332f2d; }
        .checkbox-field { display: flex; align-items: center; gap: 8px; margin-bottom: 20px; font-size: 0.9rem; }
        .btn-login {
            width: 100%; padding: 12px; border: none; border-radius: 8px;
            background: #332f2d; color: #fff; font-weight: 600; font-size: 1rem;
            cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-login:hover { background: #4a4442; }
        .alert-error {
            background: #fdecea; color: #b13b2e;
            padding: 12px 14px; border-radius: 8px;
            margin-bottom: 18px; font-size: 0.88rem;
        }
        .back-link { text-align: center; margin-top: 20px; }
        .back-link a { color: #7a6e6a; font-size: 0.85rem; }

        /* Toast notification (pop-up) */
        .toast-container {
            position: fixed; top: 20px; right: 20px; z-index: 2000;
            display: flex; flex-direction: column; gap: 10px; max-width: 360px;
        }
        .toast {
            display: flex; align-items: flex-start; gap: 10px;
            background: #fff; color: #332f2d; padding: 14px 16px; border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15); font-size: 0.92rem;
            border-left: 4px solid #b13b2e; opacity: 0; transform: translateX(30px);
            transition: opacity .25s, transform .25s;
        }
        .toast.show { opacity: 1; transform: translateX(0); }
        .toast i.toast-icon { margin-top: 2px; color: #b13b2e; }
        .toast .toast-msg { flex: 1; line-height: 1.4; }
        .toast .toast-close { background: none; border: none; cursor: pointer; color: #a89b93; font-size: 0.85rem; padding: 0; }
        @media (max-width: 480px) {
            .toast-container { left: 12px; right: 12px; max-width: none; }
        }
    </style>
</head>
<body>
    <div class="toast-container" id="toastContainer"></div>
    <div class="login-card">
        <div class="login-header">
            <div class="icon"><i class="fas fa-lock"></i></div>
            <h1>Login Admin</h1>
            <p>eco.clayart Dashboard</p>
        </div>

        @if ($errors->any())
            <span id="loginErrorMsg" style="display:none;" data-msg="{{ $errors->first() }}"></span>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            <div class="checkbox-field">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember" style="font-weight:400;margin:0;">Ingat saya</label>
            </div>
            <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt"></i> Masuk</button>
        </form>

        <div class="back-link">
            <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
        </div>
    </div>

    <script>
        function showToast(message, type = 'error', duration = 4500) {
            if (!message) return;
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.innerHTML = `
                <i class="fas fa-circle-exclamation toast-icon"></i>
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

        const loginErrorEl = document.getElementById('loginErrorMsg');
        if (loginErrorEl) showToast(loginErrorEl.dataset.msg, 'error');
    </script>
</body>
</html>