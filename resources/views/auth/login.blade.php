<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Acceso a demo · SafeRoom</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
        <style>
            :root { --ink:#242121; --muted:#736e6f; --gold:#ffca01; --line:#ebe4de; --surface:#fff; --bg:#fbf8f5; --danger:#b42318; }
            * { box-sizing:border-box; }
            body { min-height:100vh; margin:0; color:var(--ink); background:radial-gradient(circle at 8% 8%, #fff0bd 0, transparent 25rem), radial-gradient(circle at 96% 98%, #dff3ec 0, transparent 28rem), var(--bg); font:14px "DM Sans", ui-sans-serif, system-ui, sans-serif; }
            .shell { min-height:100vh; display:grid; grid-template-columns:minmax(360px,.94fr) minmax(500px,1.06fr); }
            .welcome { padding:clamp(36px,6vw,88px); display:flex; flex-direction:column; justify-content:center; background:#302f2f; color:#fff; position:relative; overflow:hidden; }
            .brand { width:220px; max-width:100%; filter:brightness(0) invert(1); margin-bottom:70px; position:relative; z-index:1; }
            .welcome-mark { position:absolute; right:-68px; bottom:-66px; width:min(43vw,370px); opacity:.3; pointer-events:none; user-select:none; }
            .eyebrow { position:relative; z-index:1; margin:0 0 14px; color:var(--gold); font-size:11px; letter-spacing:.16em; font-weight:800; }
            h1 { position:relative; z-index:1; max-width:520px; margin:0; font-size:clamp(34px,4vw,54px); line-height:1.07; letter-spacing:-.04em; }
            .panel-wrap { padding:clamp(30px,6vw,78px); display:grid; place-items:center; }
            .panel { width:min(100%,580px); }
            h2 { margin:0 0 28px; font-size:31px; letter-spacing:-.035em; }
            .form { padding:27px; border:1px solid var(--line); border-radius:20px; background:var(--surface); box-shadow:0 18px 45px rgb(50 39 32 / .07); }
            label { display:block; margin:0 0 8px; color:#605b5c; font-size:10px; letter-spacing:.09em; font-weight:800; }
            input { width:100%; padding:13px 14px; border:1px solid #dcd4ce; border-radius:10px; color:var(--ink); background:#fff; font:inherit; }
            input:focus { border-color:#d7a900; outline:3px solid rgb(255 202 1 / .22); }
            .field + .field { margin-top:17px; }
            .submit { width:100%; margin-top:23px; padding:14px 18px; border:0; border-radius:10px; background:var(--ink); color:#fff; font:700 14px Manrope, sans-serif; cursor:pointer; transition:transform .15s,background .15s; }
            .submit:hover { transform:translateY(-1px); background:#000; }
            .error { margin:0 0 18px; padding:12px 14px; border-radius:10px; background:#fff0ee; color:var(--danger); font-size:12px; line-height:1.5; }
            .credentials { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:10px; margin-top:24px; }
            .credential { min-height:72px; padding:16px; border:1px solid var(--line); border-radius:13px; background:#fff; text-align:left; cursor:pointer; transition:border .15s,transform .15s,box-shadow .15s,background .15s; display:flex; align-items:center; justify-content:space-between; gap:12px; }
            .credential:hover { border-color:#f0c22b; transform:translateY(-2px); box-shadow:0 8px 22px rgb(50 39 32 / .08); }
            .credential:focus-visible { outline:3px solid rgb(255 202 1 / .3); outline-offset:2px; }
            .credential.is-selected { border-color:#d7a900; background:#fff9e5; box-shadow:0 8px 22px rgb(50 39 32 / .08); }
            .credential b { display:block; font-size:14px; }
            .credential::after { color:#a49d99; content:"→"; font-size:18px; transition:transform .15s,color .15s; }
            .credential:hover::after, .credential.is-selected::after { color:#8d6e00; transform:translateX(3px); }
            h1, h2, .credential b { font-family:Manrope, sans-serif; }
            .welcome { justify-content:flex-start; background:radial-gradient(circle at 50% 60%, #44504a, #202826 65%); }
            .brand { margin-bottom:clamp(35px, 6vh, 75px); }
            .welcome-copy { position:relative; z-index:1; }
            .welcome-copy p:last-child { max-width:410px; color:#c5d0c9; line-height:1.7; }
            .vault { position:relative; width:min(62%, 310px); aspect-ratio:1; margin:clamp(25px, 5vh, 55px) auto 0; border-radius:50%; background:linear-gradient(145deg,#717b73,#29332f 45%,#6c786f); box-shadow:0 28px 65px #10171599, inset 0 2px 5px #d1dcd199, inset 0 -7px 14px #121b18; display:grid; place-items:center; }
            .vault::before { content:""; position:absolute; inset:5%; border-radius:50%; border:2px dashed #a6b2a470; box-shadow:inset 0 0 0 10px #26312d, 0 0 0 2px #15201c; }
            .vault-door { position:absolute; inset:15%; border-radius:50%; background:radial-gradient(circle at 35% 30%,#839086,#424f47 45%,#222e29); border:3px solid #a2aea080; box-shadow:inset 0 0 0 8px #26332e, inset 0 0 20px #0d1612, 0 4px 16px #121a16; display:grid; place-items:center; animation:vault-enter 1.4s cubic-bezier(.2,.7,.2,1) both; }
            .vault-wheel { width:48%; aspect-ratio:1; border:6px solid #b6c1b4; border-radius:50%; position:relative; box-shadow:0 2px 8px #1119, inset 0 2px 6px #1119; animation:vault-turn 2s .4s cubic-bezier(.2,.7,.2,1) both; }
            .vault-wheel::before, .vault-wheel::after { content:""; position:absolute; left:50%; top:50%; width:100%; height:6px; border-radius:8px; background:#b6c1b4; transform:translate(-50%,-50%); }
            .vault-wheel::after { transform:translate(-50%,-50%) rotate(90deg); }
            .vault-hub { position:absolute; z-index:1; width:24%; aspect-ratio:1; border-radius:50%; background:#d2d9ca; box-shadow:0 2px 5px #1118; }
            .vault-caption { margin:22px 0 0; text-align:center; color:#a6b5a9; font-size:10px; font-weight:700; letter-spacing:.18em; }
            .panel { max-width:480px; }
            .panel-subtitle { margin:-18px 0 25px; color:var(--muted); line-height:1.6; }
            .profiles-label { margin:25px 0 0; color:var(--muted); font-size:12px; }
            .credentials { margin-top:12px; }
            @keyframes vault-enter { from { opacity:0; transform:scale(.85); } to { opacity:1; transform:scale(1); } }
            @keyframes vault-turn { from { transform:rotate(-100deg); } to { transform:rotate(0); } }
            @media (prefers-reduced-motion:reduce) { *, *::before, *::after { animation:none !important; transition:none !important; } }
            @media (max-width:880px) { .shell { grid-template-columns:1fr; } .welcome { min-height:390px; padding:44px 32px; } .brand { margin-bottom:42px; } .panel-wrap { padding:42px 24px 58px; } }
            @media (max-width:460px) { .credentials { grid-template-columns:1fr; } .form { padding:20px; } }
        </style>
    </head>
    <body>
        <main class="shell">
            <section class="welcome" aria-labelledby="welcome-title">
                <img class="brand" src="{{ asset('images/saferoom-logo.png') }}" alt="SafeRoom" />
                <div class="welcome-copy">
                    <p class="eyebrow">SAFEROOM · SISTEMA DE BÓVEDA</p>
                    <h1 id="welcome-title">La seguridad tiene un nuevo espacio.</h1>
                    <p>Clientes, cajas y accesos en una sola plataforma.</p>
                </div>
                <div class="vault" aria-hidden="true"><div class="vault-door"><div class="vault-wheel"></div><div class="vault-hub"></div></div></div>
                <p class="vault-caption" aria-hidden="true">CONTROL · CONFIANZA · SEGURIDAD</p>
            </section>
            <section class="panel-wrap" aria-labelledby="login-title">
                <div class="panel">
                    <h2 id="login-title">Acceso de demostración</h2>
                    <p class="panel-subtitle">Ingresa tus datos o selecciona un perfil para explorar el sistema.</p>
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
                    <p class="profiles-label">Selecciona un perfil de demostración</p>
                    <div class="credentials" aria-label="Perfiles disponibles para acceso">
                        @foreach ($users as $user)
                            <button class="credential" type="button" aria-pressed="false" data-email="{{ $user['email'] }}" data-password="{{ $user['password'] }}">
                                <b>{{ $user['role'] }}</b>
                            </button>
                        @endforeach
                    </div>
                </div>
            </section>
        </main>
        <script>
            document.querySelectorAll('.credential').forEach((button) => {
                button.addEventListener('click', () => {
                    document.querySelectorAll('.credential').forEach((item) => {
                        item.classList.remove('is-selected');
                        item.setAttribute('aria-pressed', 'false');
                    });
                    button.classList.add('is-selected');
                    button.setAttribute('aria-pressed', 'true');
                    document.getElementById('email').value = button.dataset.email;
                    document.getElementById('password').value = button.dataset.password;
                    document.getElementById('password').focus();
                });
            });
        </script>
    </body>
</html>
