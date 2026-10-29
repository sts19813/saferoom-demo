<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Acceso a demo · SafeRoom</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
        <style>
            :root { --ink:#242121; --muted:#736e6f; --gold:#ffca01; --line:#ebe4de; --surface:#fff; --bg:#fbf8f5; --danger:#b42318; }
            * { box-sizing:border-box; }
            body { min-height:100vh; margin:0; color:var(--ink); background:radial-gradient(circle at 8% 8%, #fff0bd 0, transparent 25rem), radial-gradient(circle at 96% 98%, #dff3ec 0, transparent 28rem), var(--bg); font:14px Montserrat, ui-sans-serif, system-ui, sans-serif; }
            .shell { min-height:100vh; display:grid; grid-template-columns:minmax(360px,.94fr) minmax(500px,1.06fr); }
            .welcome { padding:clamp(36px,6vw,88px); display:flex; flex-direction:column; justify-content:center; background:#302f2f; color:#fff; position:relative; overflow:hidden; }
            .welcome::after { content:""; position:absolute; right:-130px; bottom:-130px; width:380px; height:380px; border:54px solid rgb(255 202 1 / .25); border-radius:50%; }
            .brand { width:220px; max-width:100%; filter:brightness(0) invert(1); margin-bottom:70px; position:relative; z-index:1; }
            .eyebrow { margin:0 0 14px; color:var(--gold); font-size:11px; letter-spacing:.16em; font-weight:800; }
            h1 { max-width:520px; margin:0; font-size:clamp(34px,4vw,54px); line-height:1.07; letter-spacing:-.04em; }
            .welcome > p:not(.eyebrow) { max-width:485px; margin:23px 0 0; color:#dbd7d5; font-size:16px; line-height:1.7; }
            .role-note { position:relative; z-index:1; display:flex; gap:12px; align-items:flex-start; max-width:490px; margin-top:42px; padding:16px 18px; border:1px solid rgb(255 255 255 / .16); border-radius:14px; background:rgb(255 255 255 / .08); color:#f5f1ef; line-height:1.55; }
            .role-note i { font-style:normal; color:var(--gold); font-size:20px; }
            .panel-wrap { padding:clamp(30px,6vw,78px); display:grid; place-items:center; }
            .panel { width:min(100%,580px); }
            .tag { display:inline-flex; padding:8px 11px; border-radius:999px; background:#e8f2f8; color:#4b6d8c; font-size:10px; font-weight:800; letter-spacing:.08em; }
            h2 { margin:16px 0 8px; font-size:31px; letter-spacing:-.035em; }
            .intro { margin:0 0 28px; color:var(--muted); line-height:1.6; }
            .form { padding:27px; border:1px solid var(--line); border-radius:20px; background:var(--surface); box-shadow:0 18px 45px rgb(50 39 32 / .07); }
            label { display:block; margin:0 0 8px; color:#605b5c; font-size:10px; letter-spacing:.09em; font-weight:800; }
            input { width:100%; padding:13px 14px; border:1px solid #dcd4ce; border-radius:10px; color:var(--ink); background:#fff; font:inherit; }
            input:focus { border-color:#d7a900; outline:3px solid rgb(255 202 1 / .22); }
            .field + .field { margin-top:17px; }
            .submit { width:100%; margin-top:23px; padding:14px 18px; border:0; border-radius:10px; background:var(--ink); color:#fff; font:700 14px Montserrat, sans-serif; cursor:pointer; transition:transform .15s,background .15s; }
            .submit:hover { transform:translateY(-1px); background:#000; }
            .error { margin:0 0 18px; padding:12px 14px; border-radius:10px; background:#fff0ee; color:var(--danger); font-size:12px; line-height:1.5; }
            .credentials-head { display:flex; align-items:end; justify-content:space-between; gap:16px; margin:30px 2px 13px; }
            .credentials-head b { font-size:15px; }
            .credentials-head small { color:var(--muted); font-size:11px; }
            .credentials { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:10px; }
            .credential { min-height:106px; padding:14px; border:1px solid var(--line); border-radius:13px; background:#fff; text-align:left; cursor:pointer; transition:border .15s,transform .15s,box-shadow .15s; }
            .credential:hover { border-color:#f0c22b; transform:translateY(-2px); box-shadow:0 8px 22px rgb(50 39 32 / .08); }
            .credential b, .credential span, .credential small { display:block; }
            .credential b { font-size:12px; }
            .credential span { margin-top:6px; color:#6b6666; font-size:10px; line-height:1.45; }
            .credential small { margin-top:7px; color:#9a9491; font-family:ui-monospace,SFMono-Regular,Menlo,monospace; font-size:10px; }
            .legal { margin:20px 4px 0; color:#8d8784; font-size:10px; line-height:1.55; }
            @media (max-width:880px) { .shell { grid-template-columns:1fr; } .welcome { min-height:390px; padding:44px 32px; } .brand { margin-bottom:42px; } .panel-wrap { padding:42px 24px 58px; } }
            @media (max-width:460px) { .credentials { grid-template-columns:1fr; } .form { padding:20px; } }
        </style>
    </head>
    <body>
        <main class="shell">
            <section class="welcome" aria-labelledby="welcome-title">
                <img class="brand" src="{{ asset('images/saferoom-logo.png') }}" alt="SafeRoom" />
                <p class="eyebrow">CENTRO MÉRIDA · ENTORNO DE DEMOSTRACIÓN</p>
                <h1 id="welcome-title">Una operación segura empieza con el acceso correcto.</h1>
                <p>Ingresa con uno de los perfiles ficticios para recorrer la experiencia de cada área sin exponer información ni ejecutar acciones reales.</p>
                <div class="role-note"><i>✦</i><span><b>Permisos aplicados por rol.</b><br />Bóveda registra validaciones y firmas; C4 opera exclusivamente la puerta.</span></div>
            </section>
            <section class="panel-wrap" aria-labelledby="login-title">
                <div class="panel">
                    <span class="tag">DEMO · DATOS FICTICIOS</span>
                    <h2 id="login-title">Bienvenido de nuevo</h2>
                    <p class="intro">Selecciona una cuenta de ejemplo o escribe las credenciales para iniciar sesión.</p>
                    <form class="form" method="POST" action="{{ route('login.store') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="error" role="alert">{{ $errors->first() }}</div>
                        @endif
                        <div class="field">
                            <label for="email">CORREO DE DEMOSTRACIÓN</label>
                            <input id="email" name="email" type="email" autocomplete="username" value="{{ old('email') }}" placeholder="nombre@saferoom.demo" required autofocus />
                        </div>
                        <div class="field">
                            <label for="password">CONTRASEÑA</label>
                            <input id="password" name="password" type="password" autocomplete="current-password" placeholder="••••••••••••" required />
                        </div>
                        <button class="submit" type="submit">Entrar al sistema <span aria-hidden="true">→</span></button>
                    </form>
                    <div class="credentials-head"><b>Cuentas disponibles</b><small>Haz clic para completar el acceso</small></div>
                    <div class="credentials" aria-label="Credenciales de demostración">
                        @foreach ($users as $user)
                            <button class="credential" type="button" data-email="{{ $user['email'] }}" data-password="{{ $user['password'] }}">
                                <b>{{ $user['role'] }}</b>
                                <span>{{ $user['name'] }}</span>
                                <small>{{ $user['email'] }}<br />{{ $user['password'] }}</small>
                            </button>
                        @endforeach
                    </div>
                    <p class="legal">Estas cuentas y contraseñas son exclusivamente para esta demo. No se conecta con BioStar, facturación, correo ni ningún servicio externo.</p>
                </div>
            </section>
        </main>
        <script>
            document.querySelectorAll('.credential').forEach((button) => {
                button.addEventListener('click', () => {
                    document.getElementById('email').value = button.dataset.email;
                    document.getElementById('password').value = button.dataset.password;
                    document.getElementById('password').focus();
                });
            });
        </script>
    </body>
</html>
