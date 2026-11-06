<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Abriendo bóveda · SafeRoom</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&display=swap" rel="stylesheet" />
        <style>
            :root { color-scheme:dark; --gold:#ffca01; --ink:#1d1c1a; }
            * { box-sizing:border-box; }
            body { display:grid; min-height:100vh; margin:0; overflow:hidden; place-items:center; background:radial-gradient(circle at 50% 63%,#5a4816 0,transparent 18rem),radial-gradient(circle at 50% 0,#42403b 0,transparent 30rem),#242323; color:#fff; font-family:Montserrat,ui-sans-serif,system-ui,sans-serif; }
            .vault-opening { position:relative; display:grid; width:min(100%,760px); min-height:100vh; padding:32px; overflow:hidden; place-items:center; text-align:center; }
            .vault-opening::before,.vault-opening::after { position:absolute; width:540px; aspect-ratio:1; border:1px solid #ffca0124; border-radius:50%; content:""; }
            .vault-opening::before { top:-390px; left:-300px; box-shadow:0 0 0 48px #ffca0108,0 0 0 96px #ffca0105; }
            .vault-opening::after { right:-370px; bottom:-365px; border-width:54px; border-color:#ffca0117; }
            .opening-content { position:relative; z-index:2; display:grid; justify-items:center; gap:18px; }
            .brand { width:190px; filter:brightness(0) invert(1); animation:brand-arrive .65s ease-out both; }
            .eyebrow { margin:34px 0 -6px; color:var(--gold); font-size:10px; font-weight:800; letter-spacing:.16em; animation:copy-arrive .55s .12s ease-out both; }
            h1 { margin:0; font-size:clamp(28px,4vw,44px); letter-spacing:-.045em; }
            h1,.opening-content > p { animation:copy-arrive .55s .2s ease-out both; }
            .opening-content p { max-width:410px; margin:0; color:#d5d0cb; font-size:13px; line-height:1.65; }
            .vault { position:relative; width:min(68vw,320px); aspect-ratio:1; margin-top:22px; isolation:isolate; border:11px solid #42413f; border-radius:50%; background:radial-gradient(circle at 34% 25%,#73716d,#3c3b38 45%,#242321 78%); box-shadow:0 0 0 3px #161615,0 0 0 5px #ffca0122,inset 0 0 0 4px #77736d,inset 0 0 36px #141412,0 25px 55px #0008; animation:vault-arrive .8s .3s cubic-bezier(.2,.8,.25,1) both; }
            .vault::before { position:absolute; z-index:3; inset:18px; border:2px dashed #a19b907d; border-radius:50%; content:""; }
            .vault::after { position:absolute; z-index:4; top:50%; left:50%; width:17px; height:17px; border:3px solid #ffca01; border-radius:50%; background:#2d2d2a; box-shadow:0 -108px 0 -3px #ffca01,0 108px 0 -3px #ffca01,108px 0 -3px #ffca01,-108px 0 -3px #ffca01; content:""; transform:translate(-50%,-50%); }
            .vault-brand-mark { position:absolute; z-index:1; top:50%; left:50%; width:57%; opacity:0; filter:drop-shadow(0 0 20px #ffca01aa); transform:translate(-50%,-50%) scale(.7); animation:reveal-mark .9s 1.45s cubic-bezier(.2,.8,.25,1) forwards; }
            .vault-door { position:absolute; z-index:2; inset:29px; display:grid; place-items:center; border:5px solid #6d6b66; border-radius:50%; background:radial-gradient(circle at 35% 28%,#98958e,#54524e 52%,#292826); box-shadow:inset 0 0 0 7px #353431,inset 0 0 26px #151514,0 7px 17px #111b; transform-origin:left center; animation:open-vault 1.65s .45s cubic-bezier(.2,.78,.22,1) forwards; }
            .wheel { width:44%; aspect-ratio:1; border:6px solid #d4d0c6; border-radius:50%; box-shadow:inset 0 2px 8px #1119,0 2px 5px #111a; animation:turn-wheel .8s ease-in-out both; }
            .wheel::before,.wheel::after { position:absolute; top:50%; left:50%; width:44%; height:6px; border-radius:99px; background:#d4d0c6; content:""; transform:translate(-50%,-50%); }
            .wheel::after { transform:translate(-50%,-50%) rotate(90deg); }
            .wheel-hub { position:absolute; width:23px; aspect-ratio:1; border-radius:50%; background:#ece7d9; box-shadow:0 2px 6px #111a; }
            .open-glow { position:absolute; z-index:0; inset:18px; border-radius:50%; background:radial-gradient(circle,#ffe88d 0 3%,#ffca014f 18%,#f8bd0018 47%,transparent 70%); opacity:0; animation:reveal-glow .7s 1.35s forwards; }
            .status { display:flex; align-items:center; gap:8px; margin-top:14px; color:#f3db76; font-size:10px; font-weight:800; letter-spacing:.13em; animation:status-arrive .45s 1.8s both; }
            .status::before { width:8px; height:8px; border-radius:50%; background:var(--gold); box-shadow:0 0 0 5px #ffca0129; content:""; animation:status-pulse 1.2s 1.8s ease-out infinite; }
            .continue { color:#bdb8b2; font-size:11px; text-decoration:underline; text-underline-offset:4px; }
            @keyframes turn-wheel { from { transform:rotate(-125deg); } to { transform:rotate(0deg); } }
            @keyframes open-vault { 0%,42% { transform:perspective(800px) rotateY(0deg); } 100% { transform:perspective(800px) rotateY(-80deg) translateX(-24px); } }
            @keyframes reveal-glow { to { opacity:1; } }
            @keyframes reveal-mark { to { opacity:.92; transform:translate(-50%,-50%) scale(1); } }
            @keyframes vault-arrive { from { opacity:0; transform:translateY(18px) scale(.92); } to { opacity:1; transform:none; } }
            @keyframes brand-arrive { from { opacity:0; transform:translateY(-12px); } to { opacity:1; transform:none; } }
            @keyframes copy-arrive { from { opacity:0; transform:translateY(9px); } to { opacity:1; transform:none; } }
            @keyframes status-arrive { from { opacity:0; transform:translateY(6px); } to { opacity:1; transform:none; } }
            @keyframes status-pulse { 60% { box-shadow:0 0 0 10px transparent; } 100% { box-shadow:0 0 0 5px transparent; } }
            @media (prefers-reduced-motion:reduce) { .brand,.eyebrow,h1,.opening-content > p,.vault,.vault-door,.wheel,.open-glow,.vault-brand-mark,.status,.status::before { animation:none; } .vault-door { transform:perspective(800px) rotateY(-80deg) translateX(-24px); } .open-glow { opacity:1; } .vault-brand-mark { opacity:.92; transform:translate(-50%,-50%) scale(1); } }
        </style>
    </head>
    <body>
        <main class="vault-opening" aria-labelledby="opening-title">
            <div class="opening-content">
                <img class="brand" src="{{ asset('images/saferoom-logo.png') }}" alt="SafeRoom" />
                <p class="eyebrow">ACCESO VERIFICADO</p>
                <h1 id="opening-title">Abriendo bóveda</h1>
                <p>Preparando el centro de operación seguro.</p>
                <div class="vault" aria-hidden="true">
                    <div class="open-glow"></div>
                    <img class="vault-brand-mark" src="{{ asset('favicon.png') }}" alt="" />
                    <div class="vault-door"><div class="wheel"></div><div class="wheel-hub"></div></div>
                </div>
                <span class="status">ACCESO CONCEDIDO</span>
                <a class="continue" href="{{ route('dashboard') }}">Continuar al sistema</a>
            </div>
        </main>
        <script>
            window.setTimeout(() => window.location.replace(@js(route('dashboard'))), window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 250 : 2600);
        </script>
    </body>
</html>
