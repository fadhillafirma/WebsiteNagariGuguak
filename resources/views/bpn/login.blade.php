<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin – BPN {{ $lembaga->nama_lembaga }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet">
    <style>
        :root {
            /* Tema Marun Tua dan Emas Minangkabau */
            --maroon-dark: #580F1C;
            --maroon-mid:  #8A1A2B;
            --gold:       #c9a84c;
            --gold-light: #e8c96a;
            --white:      #ffffff;
            --text-main:  #1c1c1c;
            --text-sub:   #4b4b4b;
            --font: 'Inter', ui-sans-serif, system-ui, sans-serif;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: var(--font); min-height: 100vh; display: flex; background: var(--maroon-dark); overflow: hidden; }
        
        .brand-panel { flex: 1.1; position: relative; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 60px; overflow: hidden; }
        .brand-bg { position: absolute; inset: 0; background: linear-gradient(160deg, #1F0409 0%, var(--maroon-dark) 40%, #470C16 100%); }
        .brand-pattern { position: absolute; inset: 0; background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='rgba(201,168,76,0.05)' stroke-width='0.8'%3E%3Crect x='10' y='10' width='40' height='40' transform='rotate(45 30 30)'/%3E%3Crect x='15' y='15' width='30' height='30'/%3E%3C/g%3E%3C/svg%3E"); background-size: 60px 60px; }
        
        .brand-content { position: relative; z-index: 2; text-align: center; max-width: 420px; }
        .brand-title { font-size: 32px; font-weight: 800; color: var(--white); line-height: 1.2; margin-bottom: 12px; }
        .brand-title em { font-style: italic; color: var(--gold-light); }
        .brand-subtitle { font-size: 15px; color: rgba(255,255,255,0.5); font-weight: 300; line-height: 1.8; }

        .login-panel { flex: 0.9; display: flex; align-items: center; justify-content: center; padding: 60px; background: var(--white); position: relative; }
        .login-panel::before { content: ''; position: absolute; top: 0; left: 0; bottom: 0; width: 4px; background: linear-gradient(to bottom, var(--gold), var(--maroon-mid), var(--gold)); }
        
        .login-card { width: 100%; max-width: 400px; }
        .login-greeting { font-size: 13px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--gold); margin-bottom: 10px; display: flex; align-items: center; gap: 8px; }
        .login-greeting::before { content: ''; width: 24px; height: 2px; background: var(--gold); }
        .login-title { font-size: 30px; font-weight: 800; color: var(--maroon-dark); line-height: 1.25; margin-bottom: 8px; }
        .login-desc { font-size: 14px; color: var(--text-sub); font-weight: 400; margin-bottom: 36px; }

        .error-box { background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; padding: 14px 18px; margin-bottom: 24px; display: flex; gap: 10px; }
        .error-box svg { width: 18px; height: 18px; stroke: #dc2626; fill: none; flex-shrink: 0; margin-top: 1px; }
        .error-box p { font-size: 13px; color: #b91c1c; font-weight: 500; }

        .form-group { margin-bottom: 22px; }
        .form-label { display: block; font-size: 12px; font-weight: 700; color: var(--text-sub); text-transform: uppercase; margin-bottom: 8px; }
        .input-wrapper { position: relative; }
        .input-wrapper svg { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; stroke: #999; fill: none; stroke-width: 1.8; transition: stroke 0.3s; }
        .form-input { width: 100%; padding: 14px 16px 14px 44px; border: 2px solid #e5e7eb; border-radius: 10px; font-size: 15px; font-family: var(--font); color: var(--text-main); background: #fafafa; outline: none; transition: all 0.3s; }
        .form-input:focus { border-color: var(--maroon-mid); background: var(--white); box-shadow: 0 0 0 4px rgba(138,26,43,0.08); }
        .form-input:focus + svg { stroke: var(--maroon-mid); }
        
        .toggle-password { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 4px; }
        .toggle-password svg { position: static; transform: none; width: 18px; height: 18px; stroke: #999; }
        .toggle-password:hover svg { stroke: var(--maroon-mid); }

        .btn-login { width: 100%; padding: 15px; background: var(--maroon-dark); color: var(--white); border: none; border-radius: 10px; font-size: 15px; font-weight: 700; cursor: pointer; transition: background 0.3s; margin-top: 28px; }
        .btn-login:hover { background: var(--maroon-mid); }
        
        .login-footer { margin-top: 32px; text-align: center; }
        .login-footer a { font-size: 13px; color: var(--text-sub); text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; }
        .login-footer a:hover { color: var(--maroon-mid); }
        .login-footer a svg { width: 14px; height: 14px; stroke: currentColor; fill: none; stroke-width: 2; }

        @media (max-width: 900px) {
            body { flex-direction: column; overflow-y: auto; }
            .brand-panel { flex: none; min-height: 340px; padding: 40px 30px; }
            .login-panel { flex: none; padding: 40px 30px; }
            .login-panel::before { width: auto; height: 4px; top: 0; left: 0; right: 0; bottom: auto; }
        }
    </style>
</head>
<body>
    <div class="brand-panel">
        <div class="brand-bg"></div>
        <div class="brand-pattern"></div>
        <div class="brand-content">
            <h1 class="brand-title">Admin Panel<br><em>BPN {{ $lembaga->nama_lembaga }}</em></h1>
            <p class="brand-subtitle">Kelola program, berita, dan informasi lembaga Anda melalui panel administrasi yang aman dan terpercaya.</p>
        </div>
    </div>
    <div class="login-panel">
        <div class="login-card">
            <div class="login-header">
                <div class="login-greeting">Selamat Datang</div>
                <h2 class="login-title">Masuk ke<br>Admin Panel</h2>
                <p class="login-desc">Silakan masukkan kredensial Anda untuk mengakses dashboard administrasi BPN.</p>
            </div>

            @if ($errors->any())
                <div class="error-box">
                    <svg viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <div>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('bpn.login.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" id="email" class="form-input" placeholder="admin@bpn.nagariguguak.id" value="{{ old('email') }}" required autocomplete="email">
                        <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" id="password" class="form-input" placeholder="••••••••" required autocomplete="current-password">
                        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        <button type="button" class="toggle-password" onclick="togglePass()">
                            <svg id="eye-icon" viewBox="0 0 24 24" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn-login">Masuk ke Dashboard</button>
            </form>
            <div class="login-footer">
                <a href="{{ route('bpn.beranda') }}">
                    <svg viewBox="0 0 24 24" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </div>
    <script>
        function togglePass() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
            }
        }
    </script>
</body>
</html>

