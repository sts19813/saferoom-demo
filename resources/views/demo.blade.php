<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>SafeRoom · Demo operativa</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
        />
        @vite('resources/js/app.js')
        <style>
            :root {
                --navy: #363434;
                --ink: #201e1e;
                --muted: #777273;
                --line: #e8e1dc;
                --bg: #fbf8f5;
                --gold: #ffca01;
                --green: #168b62;
                --blue: #506d88;
                --danger: #b42318;
                --surface: #ffffff;
                --radius: 16px;
                --shadow:
                    0 1px 2px rgb(20 20 40 / 0.04),
                    0 6px 20px rgb(20 20 40 / 0.05);
            }
            * {
                box-sizing: border-box;
            }
            body {
                margin: 0;
                background: var(--bg);
                font:
                    14px "DM Sans",
                    ui-sans-serif,
                    system-ui,
                    sans-serif;
                color: var(--ink);
            }
            button,
            input,
            select {
                font: inherit;
            }
            button {
                cursor: pointer;
                border: 0;
            }
            button:focus-visible,
            input:focus-visible,
            select:focus-visible {
                outline: 3px solid rgb(255 202 1 / 0.4);
                outline-offset: 2px;
            }
            .side {
                position: fixed;
                z-index: 3;
                inset: 0 auto 0 0;
                top: 0;
                width: 258px;
                background: linear-gradient(180deg, #fff 0%, #fbf6f2 100%);
                color: #5d5d68;
                display: flex;
                flex-direction: column;
            }
            .brand {
                height: 60px;
                padding: 0 18px;
                display: flex;
                align-items: center;
                gap: 12px;
                border-bottom: 1px solid #eee6df;
                overflow: hidden;
            }
            .logo {
                width: 38px;
                height: 38px;
                border-radius: 11px;
                background: var(--gold);
                display: grid;
                place-items: center;
                color: var(--navy);
                font-weight: 900;
                font-size: 18px;
            }
            .brand b {
                color: var(--ink);
                font-size: 16px;
            }
            .brand-logo {
                display: block;
                width: 200px;
                height: auto;
                max-height: none;
                object-fit: contain;
                object-position: left center;
                /* Enlarge only enough to counter the PNG's transparent canvas,
                   while preserving the complete wordmark inside the sidebar. */
                transform: scale(1.18);
                transform-origin: left center;
            }
            .brand small {
                display: block;
                color: var(--muted);
                font-size: 9px;
                letter-spacing: 0.16em;
            }
            .side nav {
                padding: 27px 14px;
                flex: 1;
            }
            .nav-label {
                margin: 0 10px 9px;
                color: #9a9aa6;
                font-size: 10px;
                font-weight: 800;
                letter-spacing: 0.15em;
            }
            .nav {
                width: 100%;
                display: flex;
                align-items: center;
                gap: 10px;
                text-align: left;
                padding: 9px 10px;
                margin: 3px 0;
                border-radius: 12px;
                background: transparent;
                color: inherit;
            }
            .nav:hover {
                background: #fbf3d7;
                color: var(--ink);
            }
            .nav.on {
                background: #fff1bc;
                color: #453b23;
                font-weight: 800;
                box-shadow: inset 3px 0 0 #d39f00;
            }
            .nav .ico {
                width: 27px;
                height: 27px;
                border-radius: 8px;
                display: grid;
                place-items: center;
                background: #ececf0;
                color: #6f6f7c;
                font-size: 13px;
                transition:
                    transform 0.16s ease,
                    background 0.16s ease;
            }
            .nav:hover .ico {
                transform: scale(1.06);
            }
            .nav[data-view="requests"] .ico {
                color: #2c7ed2;
                background: #e8f3ff;
            }
            .nav[data-view="boxes"] .ico {
                color: #87560e;
                background: #fff2d9;
            }
            .nav[data-view="tenants"] .ico {
                color: #c24f80;
                background: #fdebf3;
            }
            .nav[data-view="contracts"] .ico {
                color: #7a57bf;
                background: #f0eaff;
            }
            .nav[data-view="renewals"] .ico {
                color: #238368;
                background: #e5f7f1;
            }
            .nav[data-view="cancellations"] .ico {
                color: #c65b43;
                background: #feeee9;
            }
            .nav[data-view="access"] .ico {
                color: #237994;
                background: #e6f5f8;
            }
            .nav[data-view="documents"] .ico {
                color: #586ec0;
                background: #ebefff;
            }
            .nav[data-view="reports"] .ico {
                color: #9c6c19;
                background: #fff5dc;
            }
            .nav[data-view="finance"] .ico {
                color: #168661;
                background: #e6f8ef;
            }
            .nav.on .ico {
                background: var(--gold);
                color: var(--navy);
                box-shadow: 0 4px 10px #d49f0033;
            }
            .side.vault-mode .nav,
            .side.vault-mode .nav-label,
            .side.vault-mode .restore { display: none; }
            .side.vault-mode .nav[data-view="access"] { display: flex; margin-top: 28px; }
            .side.vault-mode::after { content: "PERFIL ACTIVO\A ENCARGADO DE BÓVEDA"; white-space: pre; margin: auto 18px 20px; padding: 12px; border-radius: 12px; background: #fff1bc; color: #5c4800; font-size: 10px; font-weight: 800; line-height: 1.6; }
            .side.c4-mode .nav,
            .side.c4-mode .nav-label,
            .side.c4-mode .restore { display: none; }
            .side.c4-mode .nav[data-view="access"] { display: flex; margin-top: 28px; }
            .side.c4-mode::after { content: "PERFIL ACTIVO\A C4 · CONTROL DE PUERTA"; white-space: pre; margin: auto 18px 20px; padding: 12px; border-radius: 12px; background: #e6f5f8; color: #237994; font-size: 10px; font-weight: 800; line-height: 1.6; }
            .c4-workspace { display:grid; grid-template-columns:minmax(210px,.85fr) minmax(255px,1fr) minmax(250px,.95fr); gap:16px; margin-top:18px; }
            .c4-workspace .panel { min-width:0; }
            .c4-photo-panel { display:flex; flex-direction:column; align-items:center; text-align:center; }
            .c4-photo-frame { position:relative; display:grid; width:min(100%,250px); margin:12px auto 0; overflow:hidden; aspect-ratio:1; place-items:center; border:1px solid #e2dcd6; border-radius:18px; background:#f2eeea; box-shadow:0 10px 24px rgb(50 39 32 / .09); }
            .c4-photo-frame::after { position:absolute; inset:10px; border:1px solid rgb(255 255 255 / .55); border-radius:12px; content:""; pointer-events:none; }
            .c4-photo-frame img { width:100%; height:100%; object-fit:cover; }
            .c4-photo-placeholder { display:grid; width:100%; height:100%; place-items:center; background:linear-gradient(145deg,#e9f1f2,#f7f4ed); color:#527f8e; font-size:42px; font-weight:800; letter-spacing:.05em; }
            .c4-identity-name { margin:16px 0 4px; color:var(--ink); font-size:17px; line-height:1.25; }
            .c4-identity-meta { margin:0; color:var(--muted); font-size:11px; line-height:1.55; }
            .c4-photo-status { display:inline-flex; align-items:center; gap:6px; margin-top:14px; padding:7px 10px; border-radius:999px; background:#e6f5f8; color:#237994; font-size:9px; font-weight:800; letter-spacing:.07em; }
            .c4-photo-status::before { width:6px; height:6px; border-radius:50%; background:currentColor; content:""; }
            #c4ControlPanel { transition:border-color .25s ease, box-shadow .25s ease, background .25s ease; }
            #c4ControlPanel.c4-door-open { border:2px solid #27a968; background:linear-gradient(135deg,#f4fff8 0%,#e2f7ea 100%); box-shadow:0 0 0 5px rgb(39 169 104 / .14),0 18px 38px rgb(39 169 104 / .16); }
            #c4ControlPanel.c4-door-closed { border:2px solid #d45b5b; background:linear-gradient(135deg,#fffafa 0%,#fff0f0 100%); box-shadow:0 0 0 5px rgb(212 91 91 / .11),0 18px 38px rgb(212 91 91 / .12); }
            .c4-door-state { display:inline-flex; margin-top:5px; padding:6px 9px; border-radius:999px; font-size:10px; font-weight:800; letter-spacing:.06em; }
            .c4-door-state.is-open { background:#daf5e5; color:#147645; }
            .c4-door-state.is-closed { background:#ffe1e1; color:#a72d2d; }
            .access-elapsed { display:inline-flex; align-items:center; margin-top:7px; padding:5px 8px; border-radius:999px; background:#e8f3ff; color:#286790; font-size:10px; font-weight:800; letter-spacing:.03em; }
            .access-elapsed.is-pending { background:#fff1d5; color:#946214; }
            .signature-pad { margin-top:16px; overflow:hidden; border:1px solid #d7d0c9; border-radius:14px; background:#fff; }
            .signature-pad__head { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:11px 13px; border-bottom:1px solid #eee7e1; color:#625b55; font-size:10px; font-weight:800; letter-spacing:.07em; }
            .signature-pad canvas { display:block; width:100%; height:160px; touch-action:none; cursor:crosshair; }
            .signature-pad__line { height:1px; margin:0 20px; background:#bdb4ab; }
            body[data-theme="dark"] #c4ControlPanel.c4-door-open { background:linear-gradient(135deg,#183b2c 0%,#1d4b37 100%); border-color:#4ec783; }
            body[data-theme="dark"] #c4ControlPanel.c4-door-closed { background:linear-gradient(135deg,#402525 0%,#502a2a 100%); border-color:#e57979; }
            @media (max-width:1120px) { .c4-workspace { grid-template-columns:repeat(2,minmax(0,1fr)); } .c4-workspace > :last-child { grid-column:1 / -1; } }
            @media (max-width:650px) { .c4-workspace { grid-template-columns:1fr; } .c4-workspace > :last-child { grid-column:auto; } }
            [hidden] { display: none !important; }
            .future {
                opacity: 0.45;
            }
            .restore {
                margin: 0 16px 18px;
                padding-top: 15px;
                border-top: 1px solid var(--line);
            }
            .restore button {
                padding: 10px;
                color: var(--muted);
                background: none;
            }
            .main {
                margin-left: 258px;
                min-height: 100vh;
            }
            .top {
                height: 60px;
                background: linear-gradient(
                    90deg,
                    #fbf6f2 0%,
                    #fffdfb 58%,
                    #f8f0e4 100%
                );
                border-bottom: 1px solid #eadfd3;
                box-shadow:
                    inset 0 -3px 0 var(--gold),
                    0 3px 16px rgb(54 52 52 / 0.04);
                display: flex;
                align-items: center;
                justify-content: flex-start;
                gap: 18px;
                /* The header belongs to the whole app, not only to the main column. */
                margin-left: -258px;
                padding: 0 34px 0 282px;
                position: sticky;
                top: 0;
                z-index: 1;
            }
            .top > .btn {
                display: none;
            }
            .crumb {
                font-size: 12px;
                color: #837b74;
                font-weight: 600;
            }
            .top strong {
                display: block;
                margin-top: 3px;
                color: var(--ink);
                font-size: 14px;
            }
            .profile {
                display: flex;
                align-items: center;
                gap: 10px;
                font-size: 12px;
                color: var(--ink);
                margin-left: auto;
                padding: 5px 11px 5px 6px;
                border: 1px solid #eadfd3;
                border-radius: 14px;
                background: rgb(255 255 255 / 0.72);
                box-shadow: 0 2px 8px rgb(54 52 52 / 0.035);
                text-align: left;
                transition:
                    background 0.16s ease,
                    border-color 0.16s ease,
                    box-shadow 0.16s ease;
            }
            .profile:hover {
                background: #fff;
                border-color: #e5c75d;
                box-shadow: 0 6px 15px rgb(54 52 52 / 0.08);
            }
            .avatar {
                width: 38px;
                height: 38px;
                border-radius: 50%;
                background: #fff1bc;
                color: var(--blue);
                display: grid;
                place-items: center;
                font-weight: 800;
            }
            .top-tools {
                display: flex;
                align-items: center;
                gap: 9px;
                margin-left: auto;
            }
            .top-divider {
                width: 1px;
                height: 26px;
                margin: 0 2px;
                background: #e6ddd5;
            }
            .header-popover-wrap {
                position: relative;
            }
            .utility-button {
                position: relative;
                display: grid;
                width: 38px;
                height: 38px;
                place-items: center;
                border: 1px solid transparent;
                border-radius: 11px;
                background: transparent;
                color: #5f5954;
                transition:
                    background 0.16s ease,
                    border-color 0.16s ease,
                    color 0.16s ease;
            }
            .utility-button:hover {
                border-color: #ead9a0;
                background: #fff4cc;
                color: #5c4800;
            }
            .utility-button svg {
                width: 18px;
                height: 18px;
            }
            .notification-dot {
                position: absolute;
                top: 8px;
                right: 8px;
                width: 6px;
                height: 6px;
                border: 1.5px solid #fffaf5;
                border-radius: 50%;
                background: #d39f00;
            }
            .top-popover {
                position: absolute;
                top: calc(100% + 14px);
                right: 0;
                z-index: 12;
                width: 330px;
                overflow: hidden;
                border: 1px solid #e9ded2;
                border-radius: 16px;
                background: #fffdfb;
                box-shadow:
                    0 20px 44px rgb(54 52 52 / 0.17),
                    0 3px 10px rgb(54 52 52 / 0.06);
                text-align: left;
            }
            .top-popover[hidden] {
                display: none;
            }
            .top-popover__head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 15px 16px 12px;
                border-bottom: 1px solid #eee5de;
            }
            .top-popover__head b {
                color: var(--ink);
                font-size: 13px;
            }
            .top-popover__head span {
                color: #987400;
                font-size: 10px;
                font-weight: 800;
                letter-spacing: 0.07em;
                text-transform: uppercase;
            }
            .notification-item {
                display: flex;
                gap: 10px;
                padding: 13px 16px;
                border-bottom: 1px solid #f1eae4;
            }
            .notification-item:last-child {
                border-bottom: 0;
            }
            .notification-icon {
                display: grid;
                width: 30px;
                height: 30px;
                flex: none;
                place-items: center;
                border-radius: 9px;
                background: #fff1bc;
                color: #765b00;
                font-size: 14px;
            }
            .notification-item b {
                display: block;
                color: var(--ink);
                font-size: 11px;
            }
            .notification-item p {
                margin: 3px 0 0;
                color: var(--muted);
                font-size: 10px;
                line-height: 1.45;
            }
            .profile-popover {
                width: 278px;
            }
            .profile-summary {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 15px 16px;
                border-bottom: 1px solid #eee5de;
            }
            .profile-summary .avatar {
                width: 36px;
                height: 36px;
            }
            .profile-summary b {
                display: block;
                color: var(--ink);
                font-size: 12px;
            }
            .profile-summary span {
                color: var(--muted);
                font-size: 10px;
            }
            .theme-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                padding: 14px 16px;
            }
            .theme-row b {
                display: block;
                color: var(--ink);
                font-size: 11px;
            }
            .theme-row span {
                color: var(--muted);
                font-size: 10px;
            }
            .theme-switch {
                position: relative;
                width: 42px;
                height: 24px;
                flex: none;
                cursor: pointer;
            }
            .theme-switch input {
                position: absolute;
                opacity: 0;
            }
            .theme-switch__track {
                display: block;
                height: 100%;
                border-radius: 999px;
                background: #e5ddd5;
                transition: background 0.18s ease;
            }
            .theme-switch__track::after {
                position: absolute;
                top: 3px;
                left: 3px;
                width: 18px;
                height: 18px;
                border-radius: 50%;
                background: #fff;
                box-shadow: 0 1px 4px rgb(54 52 52 / 0.25);
                content: "";
                transition: transform 0.18s ease;
            }
            .theme-switch input:checked + .theme-switch__track {
                background: #363434;
            }
            .theme-switch input:checked + .theme-switch__track::after {
                transform: translateX(18px);
            }
            body[data-theme="dark"] {
                --bg: #201e1d;
                --surface: #2a2827;
                --ink: #f7f0e9;
                --muted: #c5bab0;
                --line: #4a4541;
                --shadow:
                    0 1px 2px rgb(0 0 0 / 0.18), 0 10px 28px rgb(0 0 0 / 0.2);
            }
            body[data-theme="dark"] .side {
                background: linear-gradient(180deg, #2a2827, #211f1e);
                color: #c5bab0;
            }
            body[data-theme="dark"] .brand {
                border-color: #4a4541;
            }
            body[data-theme="dark"] .nav:hover {
                background: #383431;
                color: #fff;
            }
            body[data-theme="dark"] .nav.on {
                background: #554617;
                color: #fff0b6;
            }
            body[data-theme="dark"] .top {
                background: linear-gradient(90deg, #292625, #35312e);
                border-color: #4d463e;
            }
            body[data-theme="dark"] .crumb {
                color: #c5bab0;
            }
            body[data-theme="dark"] .top strong {
                color: #fffaf4;
            }
            body[data-theme="dark"] .profile,
            body[data-theme="dark"] .top-popover {
                border-color: #514a44;
                background: #302d2b;
            }
            body[data-theme="dark"] .profile:hover {
                background: #393532;
            }
            body[data-theme="dark"] .top-divider {
                background: #514a44;
            }
            body[data-theme="dark"] .utility-button {
                color: #eee3da;
            }
            body[data-theme="dark"] .utility-button:hover {
                background: #4a3d18;
            }
            body[data-theme="dark"] .top-popover__head,
            body[data-theme="dark"] .profile-summary,
            body[data-theme="dark"] .notification-item {
                border-color: #4b4540;
            }
            body[data-theme="dark"] .notification-item b,
            body[data-theme="dark"] .top-popover__head b,
            body[data-theme="dark"] .profile-summary b,
            body[data-theme="dark"] .theme-row b {
                color: #fffaf4;
            }
            body[data-theme="dark"] .field input,
            body[data-theme="dark"] .field select,
            body[data-theme="dark"] .search input,
            body[data-theme="dark"] .safe-date {
                background-color: #302d2b;
                color: #fffaf4;
                border-color: #514a44;
            }
            .content {
                max-width: 1480px;
                margin: auto;
                padding: 32px;
            }
            .view {
                display: none;
            }
            .view.on {
                display: block;
            }
            .hero {
                background: linear-gradient(
                    125deg,
                    #363434 0%,
                    #514c49 62%,
                    #6b635d 100%
                );
                border-radius: 18px;
                color: #fff;
                padding: 28px 30px;
                display: flex;
                justify-content: space-between;
                gap: 20px;
                align-items: center;
            }
            .eyebrow {
                font-size: 10px;
                letter-spacing: 0.14em;
                font-weight: 800;
                color: var(--gold);
                text-transform: uppercase;
            }
            .hero .eyebrow {
                display: inline-block;
                background: var(--gold);
                padding: 5px 8px;
                border-radius: 999px;
                color: var(--navy);
            }
            .hero h1 {
                margin: 11px 0 6px;
                font-size: 27px;
            }
            .hero p {
                margin: 0;
                color: #f4eadd;
                line-height: 1.55;
            }
            .btn {
                border-radius: 11px;
                padding: 11px 14px;
                font-weight: 750;
                font-size: 13px;
                transition:
                    transform 0.16s ease,
                    box-shadow 0.16s ease,
                    background 0.16s ease;
            }
            .btn:hover {
                transform: translateY(-1px);
            }
            .primary {
                background: var(--navy);
                color: #fff;
            }
            .gold {
                background: var(--gold);
                color: var(--navy);
                box-shadow: 0 7px 16px #ffca0140;
            }
            .outline {
                border: 1px solid var(--line);
                background: white;
                color: var(--ink);
            }
            .outline:hover {
                border-color: #e3b400;
                background: #fffaf0;
            }
            .hero .outline {
                background: transparent;
                border-color: #ffffff35;
                color: #fff;
            }
            .grid4 {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 16px;
                margin: 22px 0;
            }
            .card,
            .panel {
                background: var(--surface);
                border: 1px solid var(--line);
                border-radius: var(--radius);
                box-shadow: var(--shadow);
            }
            .card {
                padding: 19px;
                transition:
                    transform 0.18s ease,
                    box-shadow 0.18s ease;
            }
            .card:hover {
                transform: translateY(-2px);
                box-shadow: 0 12px 28px rgb(20 20 40 / 0.09);
            }
            .metric {
                font-size: 28px;
                font-weight: 800;
                margin: 12px 0 4px;
            }
            .muted {
                color: var(--muted);
                font-size: 12px;
            }
            .panel-head {
                padding: 18px 20px;
                border-bottom: 1px solid var(--line);
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .panel-head b,
            .section h2 {
                letter-spacing: -0.01em;
            }
            .panel-body {
                padding: 20px;
            }
            .two {
                display: grid;
                grid-template-columns: 1.35fr 0.65fr;
                gap: 20px;
            }
            .activity {
                padding: 15px 20px;
                border-bottom: 1px solid var(--line);
                display: flex;
                justify-content: space-between;
                gap: 12px;
            }
            .tag {
                display: inline-block;
                padding: 5px 9px;
                border-radius: 999px;
                font-size: 11px;
                font-weight: 800;
                letter-spacing: 0.015em;
            }
            .green {
                background: #e9f8f1;
                color: #147653;
            }
            .amber {
                background: #fff5dc;
                color: #a35d00;
            }
            .blue {
                background: #eef3f6;
                color: #506d88;
            }
            .red {
                background: #feecec;
                color: #b42318;
            }
            .slate {
                background: #eff3f6;
                color: #566473;
            }
            .bar {
                height: 7px;
                background: #edf1f4;
                border-radius: 99px;
                overflow: hidden;
                margin-top: 7px;
            }
            .bar i {
                display: block;
                height: 100%;
                background: var(--green);
            }
            .heading {
                display: flex;
                justify-content: space-between;
                align-items: end;
                margin-bottom: 22px;
            }
            .heading h1 {
                font-size: 26px;
                margin: 4px 0;
            }
            .toolbar {
                display: flex;
                gap: 10px;
                padding: 14px 18px;
                border-bottom: 1px solid var(--line);
                background: linear-gradient(180deg, #fff, #fcfcfd);
            }
            .search {
                position: relative;
                flex: 1;
                max-width: 370px;
            }
            .search input,
            .field input,
            .field select {
                width: 100%;
                border: 1px solid var(--line);
                border-radius: 11px;
                padding: 10px 12px;
                background: #fcfcfd;
                outline: none;
                color: var(--ink);
                transition:
                    border-color 0.16s ease,
                    box-shadow 0.16s ease,
                    background 0.16s ease;
            }
            .field input:hover,
            .field select:hover,
            .search input:hover {
                border-color: #c8c6d0;
                background: #fff;
            }
            .field select,
            .toolbar select {
                appearance: none;
                -webkit-appearance: none;
                border: 1px solid var(--line);
                border-radius: 11px;
                min-height: 42px;
                padding: 9px 39px 9px 12px;
                background-color: #fcfcfd;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%235b4bd6' stroke-width='2.3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
                background-position: right 12px center;
                background-repeat: no-repeat;
                background-size: 16px;
                color: var(--ink);
                font-weight: 650;
                cursor: pointer;
                box-shadow: 0 1px 1px rgb(20 20 40 / 0.02);
                transition:
                    border-color 0.16s ease,
                    box-shadow 0.16s ease,
                    background-color 0.16s ease;
            }
            .toolbar select {
                min-width: 156px;
            }
            .field select:hover,
            .toolbar select:hover {
                border-color: #aaa3e5;
                background-color: #fff;
            }
            .field select:focus,
            .toolbar select:focus {
                outline: none;
                border-color: #d39f00;
                box-shadow: 0 0 0 4px #ffca012b;
                background-color: #fff;
            }
            /* Native calendar popovers cannot be branded consistently. */
            .safe-date {
                position: relative;
                display: flex;
                align-items: center;
                width: 100%;
                min-height: 42px;
                border: 1px solid var(--line);
                border-radius: 11px;
                background: #fcfcfd;
                box-shadow: 0 1px 1px rgb(20 20 40 / 0.02);
                transition:
                    border-color 0.16s ease,
                    box-shadow 0.16s ease,
                    background-color 0.16s ease;
            }
            .safe-date:hover {
                border-color: #d6b13c;
                background: #fffdf8;
            }
            .safe-date:focus-within {
                border-color: #d39f00;
                box-shadow: 0 0 0 4px #ffca012b;
                background: #fff;
            }
            .safe-date__value {
                min-width: 0;
                flex: 1;
                padding: 10px 0 10px 12px;
                color: var(--ink);
                font-size: 13px;
                font-weight: 650;
                white-space: nowrap;
            }
            .safe-date__trigger {
                display: grid;
                width: 38px;
                height: 38px;
                flex: none;
                place-items: center;
                margin-right: 2px;
                border-radius: 9px;
                background: transparent;
                color: #947100;
            }
            .safe-date__trigger:hover {
                background: #fff1bc;
            }
            .safe-date__trigger svg {
                width: 17px;
                height: 17px;
            }
            .safe-date__native {
                position: absolute;
                width: 1px !important;
                height: 1px !important;
                overflow: hidden;
                opacity: 0;
                pointer-events: none;
            }
            .safe-date--readonly {
                background: #f8f4f0;
                color: var(--muted);
            }
            .safe-date--readonly .safe-date__trigger {
                display: none;
            }
            .safe-calendar {
                position: absolute;
                top: calc(100% + 9px);
                left: 0;
                z-index: 20;
                width: 286px;
                padding: 13px;
                border: 1px solid #e8dfd6;
                border-radius: 16px;
                background: #fffdfb;
                box-shadow:
                    0 18px 40px rgb(54 52 52 / 0.17),
                    0 2px 7px rgb(54 52 52 / 0.06);
            }
            .safe-calendar[hidden] {
                display: none;
            }
            .safe-calendar__head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
                margin-bottom: 12px;
            }
            .safe-calendar__month {
                color: var(--ink);
                font-size: 13px;
                font-weight: 800;
                text-transform: capitalize;
            }
            .safe-calendar__actions {
                display: flex;
                gap: 4px;
            }
            .safe-calendar__nav {
                display: grid;
                width: 29px;
                height: 29px;
                place-items: center;
                border: 1px solid #eee4d8;
                border-radius: 8px;
                background: #fff;
                color: #645e58;
                font-size: 17px;
                line-height: 1;
            }
            .safe-calendar__nav:hover {
                background: #fff1bc;
                border-color: #edcf65;
                color: #5c4900;
            }
            .safe-calendar__week,
            .safe-calendar__days {
                display: grid;
                grid-template-columns: repeat(7, 1fr);
                text-align: center;
            }
            .safe-calendar__week {
                margin-bottom: 4px;
                color: #9b938a;
                font-size: 10px;
                font-weight: 800;
            }
            .safe-calendar__day {
                display: grid;
                width: 32px;
                height: 32px;
                place-items: center;
                margin: 1px auto;
                border-radius: 9px;
                background: transparent;
                color: var(--ink);
                font-size: 12px;
                font-weight: 650;
            }
            .safe-calendar__day:hover {
                background: #fff1bc;
                color: #493900;
            }
            .safe-calendar__day--muted {
                color: #c0b9b2;
            }
            .safe-calendar__day--today {
                box-shadow: inset 0 0 0 1px #e3bb25;
            }
            .safe-calendar__day--selected {
                background: var(--navy);
                color: #fff;
                box-shadow: 0 4px 10px rgb(54 52 52 / 0.18);
            }
            .safe-calendar__day--selected:hover {
                background: var(--navy);
                color: #fff;
            }
            .search input:focus,
            .field input:focus,
            .field select:focus {
                border-color: var(--gold);
                box-shadow: 0 0 0 3px #eeecfb;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
                min-width: 730px;
            }
            th {
                background: #f6f6f7;
                color: var(--muted);
                font-size: 10px;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }
            th,
            td {
                padding: 13px 18px;
                border-bottom: 1px solid var(--line);
            }
            tbody tr {
                transition: background 0.15s ease;
            }
            tbody tr:hover {
                background: #f6f6f7;
            }
            td b {
                font-size: 13px;
            }
            .table-wrap {
                overflow: auto;
            }
            .box-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 13px;
                padding: 20px;
            }
            .availability-map {
                display: grid;
                gap: 14px;
                padding: 18px 20px 20px;
                border-bottom: 1px solid var(--line);
            }
            .availability-map__head {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
            }
            .availability-map__legend {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
                color: var(--muted);
                font-size: 11px;
            }
            .availability-map__legend i {
                display: inline-block;
                width: 10px;
                height: 10px;
                margin-right: 4px;
                border-radius: 3px;
                vertical-align: -1px;
            }
            .availability-map__grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(78px, 1fr));
                gap: 7px;
            }
            .availability-slot {
                min-height: 48px;
                padding: 7px;
                border: 1px solid transparent;
                border-radius: 8px;
                color: #fff;
                font-size: 11px;
                font-weight: 800;
                text-align: left;
            }
            .availability-slot small { display:block; margin-top:3px; color:inherit; font-size:9px; font-weight:600; opacity:.82; }
            .availability-slot--Disponible { background:#168b62; }
            .availability-slot--Ocupada { background:#c0392b; }
            .availability-slot--Reservada { background:#c98b00; }
            .availability-slot--Mantenimiento { background:#506d88; }
            .availability-slot.chosen { outline:3px solid var(--gold); outline-offset:2px; }
            .box-card {
                border: 1px solid #e4e4e9;
                border-radius: 16px;
                padding: 16px;
                text-align: left;
                background: linear-gradient(145deg, #fff, #f8f8f9);
                min-height: 145px;
                color: var(--ink);
                box-shadow: 0 2px 5px rgb(20 20 40 / 0.025);
                transition:
                    transform 0.18s ease,
                    box-shadow 0.18s ease,
                    border-color 0.18s ease;
            }
            .box-card.available {
                background: linear-gradient(145deg, #f5fffa, #eafaf2);
                border-color: #bfead5;
                cursor: pointer;
            }
            .box-card.available:hover {
                box-shadow: 0 12px 24px #168b6220;
                transform: translateY(-3px);
                border-color: #5fc99e;
            }
            .box-card.chosen {
                outline: 3px solid #d8d2ff;
                border-color: var(--gold);
            }
            .box-card b {
                font-size: 18px;
                display: block;
                margin-top: 18px;
            }
            .box-card:disabled {
                opacity: 0.72;
                cursor: not-allowed;
            }
            .split {
                display: grid;
                grid-template-columns: 1fr 360px;
                gap: 22px;
            }
            .section {
                padding: 20px;
            }
            .section h2 {
                font-size: 15px;
                margin: 0 0 4px;
            }
            .fields {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 15px;
                margin-top: 20px;
            }
            .fields .wide {
                grid-column: span 2;
            }
            .field label {
                display: block;
                font-size: 11px;
                font-weight: 800;
                margin-bottom: 6px;
                color: #525260;
                letter-spacing: 0.04em;
            }
            .form-group {
                border-top: 1px solid var(--line);
                margin-top: 24px;
                padding-top: 18px;
            }
            .form-group summary {
                cursor: pointer;
                font-weight: 800;
                color: var(--ink);
                list-style: none;
            }
            .form-group summary::before {
                content: "+";
                display: inline-grid;
                place-items: center;
                width: 18px;
                height: 18px;
                margin-right: 8px;
                border-radius: 50%;
                background: #f2f5f7;
                color: var(--muted);
            }
            .form-group[open] summary::before {
                content: "−";
            }
            .form-helper {
                margin: 7px 0 0 26px;
                font-size: 12px;
                color: var(--muted);
            }
            .selected {
                margin-top: 18px;
                background: #effbf5;
                border: 1px solid #bce7d4;
                border-radius: 10px;
                padding: 15px;
            }
            .summary-row {
                display: flex;
                justify-content: space-between;
                padding: 9px 0;
                color: var(--muted);
            }
            .summary-total {
                border-top: 1px solid var(--line);
                margin-top: 8px;
                padding-top: 14px;
                color: var(--ink);
                font-size: 18px;
                font-weight: 800;
            }
            .notice {
                padding: 12px;
                border-radius: 8px;
                background: linear-gradient(135deg, #fff8e6, #fff3d4);
                color: #895400;
                font-size: 12px;
                line-height: 1.5;
            }
            .tabs {
                display: flex;
                gap: 22px;
                overflow: auto;
                border-top: 1px solid rgb(255 255 255 / 0.16);
                margin-top: 22px;
                padding-top: 12px;
            }
            .tabs button {
                color: #ded7d0;
                background: none;
                padding: 8px 0;
                white-space: nowrap;
            }
            .tabs button.on {
                color: #fff;
                border-bottom: 2px solid var(--gold);
            }
            .tenant-top {
                /* Same secure-vault finish as the operational hero. */
                background: linear-gradient(
                    125deg,
                    #363434 0%,
                    #514c49 62%,
                    #6b635d 100%
                );
                color: #fff;
                border-radius: 18px;
                padding: 28px 30px;
                box-shadow: 0 14px 28px rgb(54 52 52 / 0.13);
            }
            .tenant-name {
                display: flex;
                align-items: center;
                gap: 13px;
            }
            .tenant-name .avatar {
                width: 54px;
                height: 54px;
                font-size: 17px;
                background: var(--gold);
                color: var(--navy);
                box-shadow: 0 6px 16px rgb(255 202 1 / 0.24);
            }
            .tenant-name h1 {
                margin: 0;
                font-size: 24px;
            }
            .empty {
                padding: 52px;
                text-align: center;
                color: var(--muted);
            }
            .toast {
                position: fixed;
                right: 22px;
                bottom: 22px;
                background: var(--navy);
                color: #fff;
                padding: 14px 17px;
                border-radius: 10px;
                box-shadow: 0 8px 28px #0003;
                display: none;
                z-index: 5;
            }
            .skip-link {
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 20;
                transform: translateY(-160%);
                background: #fff;
                color: var(--navy);
                padding: 10px 14px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgb(0 0 0 / 0.2);
            }
            .skip-link:focus {
                transform: translateY(0);
            }
            .modal {
                display: none;
                position: fixed;
                inset: 0;
                background: #17202b77;
                z-index: 4;
                place-items: center;
                padding: 18px;
            }
            .modal.on {
                display: grid;
            }
            .invoice {
                background: white;
                width: min(560px, 100%);
                border-radius: 14px;
                padding: 26px;
                box-shadow: 0 20px 55px #0004;
            }
            .invoice h2 {
                margin: 0;
            }
            .invoice .line {
                border-top: 1px solid var(--line);
                margin: 15px 0;
            }
            .document-list-head { padding:22px 22px 0; }
            .document-list-head h2 { margin:0; }
            .document-list-head p { margin:5px 0 0; font-size:12px; }
            .document-filters { display:flex; gap:14px; align-items:end; padding:18px 22px; }
            .document-filters .document-search { flex:1; }
            .document-filters .field:not(.document-search) { width:250px; }
            .document-folio { display:block; margin-top:5px; color:var(--muted); font-size:11px; }
            .document-table-type { display:inline-block; padding:6px 9px; border-radius:8px; background:#f4f1e9; color:#685822; font-size:11px; font-weight:700; }
            body[data-theme="dark"] .document-table-type { background:#493e24; color:#f4d779; }
            @media(max-width:700px) { .document-filters { flex-direction:column; align-items:stretch; } .document-filters .field:not(.document-search) { width:auto; } }
            .document-paper {
                max-width: 760px;
                margin: 0 auto;
                padding: 42px;
                background: #fff;
                border: 1px solid #ded7d0;
                box-shadow: 0 12px 30px rgb(30 25 20 / 0.1);
                color: #292525;
            }
            .document-paper__head {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 20px;
                padding-bottom: 20px;
                border-bottom: 2px solid var(--gold);
            }
            .document-paper__logo {
                width: 150px;
                max-height: 46px;
                object-fit: contain;
                object-position: left center;
            }
            .document-paper__meta {
                text-align: right;
                font-size: 12px;
                color: #625b55;
            }
            .document-paper__title {
                margin: 30px 0 8px;
                font-size: 20px;
                color: #292525;
            }
            .document-paper__body {
                color: #403a36;
                line-height: 1.7;
            }
            .document-paper__summary {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px 24px;
                margin: 24px 0;
                padding: 16px;
                background: #fbf8f5;
                border: 1px solid #ece4dc;
            }
            .document-paper__summary small {
                display: block;
                margin-bottom: 3px;
                color: #756d67;
                font-size: 10px;
                font-weight: 800;
                letter-spacing: 0.08em;
            }
            .document-paper__signatures {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 36px;
                margin-top: 68px;
                font-size: 11px;
                color: #625b55;
                text-align: center;
            }
            .document-paper__signatures span {
                display: block;
                padding-top: 9px;
                border-top: 1px solid #77706b;
            }
            @media print {
                body { background: #fff; }
                .side, .top, .heading, .content > .view:not(#documents), #documents .document-selection, #documents .panel-head, .small-grid, .document-preview-actions, .toast, .modal { display: none !important; }
                .main, .content, #documents, #documents.on, .panel, .panel.section { display: block !important; margin: 0 !important; padding: 0 !important; border: 0 !important; box-shadow: none !important; background: #fff !important; }
                #documentPreview { display: block !important; padding: 0 !important; background: transparent !important; }
                .document-paper { max-width: none; padding: 0; border: 0; box-shadow: none; }
            }
            .small-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 13px;
            }
            /* Reportes es un tablero de decisión: prioriza seguridad, capacidad y operación. */
            .report-hero {
                display: grid;
                grid-template-columns: minmax(0, 1fr) auto;
                gap: 24px;
                align-items: end;
                margin-bottom: 20px;
                padding: 23px 24px;
                overflow: hidden;
                border: 1px solid #494440;
                border-radius: 18px;
                background:
                    radial-gradient(circle at 88% 8%, rgb(255 202 1 / .32), transparent 28%),
                    linear-gradient(125deg, #292727, #494440);
                color: #fff;
                box-shadow: 0 13px 28px rgb(40 32 28 / .16);
            }
            .report-hero__eyebrow { margin: 0 0 8px; color: #ffda4f; font-size: 10px; font-weight: 800; letter-spacing: .14em; }
            .report-hero h1 { margin: 0; font-size: 27px; letter-spacing: -.03em; }
            .report-hero p { max-width: 680px; margin: 8px 0 0; color: #f0e7df; font-size: 12px; line-height: 1.55; }
            .report-hero__meta { min-width: 170px; padding: 12px 14px; border: 1px solid rgb(255 255 255 / .2); border-radius: 12px; background: rgb(255 255 255 / .1); }
            .report-hero__meta span { display: block; color: #fff1bc; font-size: 9px; font-weight: 800; letter-spacing: .1em; }
            .report-hero__meta b { display: block; margin-top: 5px; font-size: 12px; line-height: 1.35; }
            .report-actions { display: flex; flex-wrap: wrap; justify-content: flex-end; gap: 9px; }
            .report-filter { margin-bottom: 20px; padding: 17px 20px 19px; }
            .report-filter__top, .report-filter__fields { display: flex; align-items: center; gap: 12px; }
            .report-filter__top { justify-content: space-between; margin-bottom: 15px; }
            .report-filter__top h2 { margin: 0; font-size: 14px; }
            .report-filter__top p { margin: 3px 0 0; color: var(--muted); font-size: 11px; }
            .report-filter__fields { flex-wrap: wrap; }
            .report-filter .field { min-width: 150px; flex: 1 1 150px; }
            .report-filter .field--wide { min-width: 230px; flex-grow: 1.45; }
            .report-filter .field label { margin-bottom: 5px; }
            .report-presets { display: flex; flex-wrap: wrap; gap: 7px; }
            .report-preset { padding: 7px 10px; border: 1px solid #e5ddd5; border-radius: 999px; background: #fff; color: #625b55; font-size: 10px; font-weight: 800; }
            .report-preset:hover, .report-preset.is-active { border-color: #e2b810; background: #fff4c8; color: #5d4700; }
            .report-kpi { position: relative; overflow: hidden; min-height: 145px; }
            .report-kpi::after { position: absolute; top: -25px; right: -25px; width: 90px; height: 90px; border-radius: 50%; background: var(--report-tint, #fff5dc); content: ""; }
            .report-kpi__label, .report-kpi__detail, .report-kpi__trend { position: relative; z-index: 1; display: block; }
            .report-kpi__label { color: var(--muted); font-size: 10px; font-weight: 800; letter-spacing: .08em; }
            .report-kpi .metric { margin: 10px 0 7px; font-size: 25px; }
            .report-kpi__detail { color: var(--muted); font-size: 11px; line-height: 1.4; }
            .report-kpi__trend { margin-top: 10px; color: var(--report-accent, #895400); font-size: 10px; font-weight: 800; }
            .report-kpi--income { --report-tint: #e9f8f1; --report-accent: #147653; }
            .report-kpi--occupancy { --report-tint: #eef3f6; --report-accent: #506d88; }
            .report-kpi--flow { --report-tint: #fff5dc; --report-accent: #a35d00; }
            .report-kpi--risk { --report-tint: #feecec; --report-accent: #b42318; }
            .report-insights { display: grid; grid-template-columns: minmax(0, 1.3fr) minmax(290px, .7fr); gap: 20px; margin-bottom: 20px; }
            .report-panel__head { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; padding: 18px 20px 14px; border-bottom: 1px solid var(--line); }
            .report-panel__head h2 { margin: 0; font-size: 15px; }
            .report-panel__head p { margin: 4px 0 0; color: var(--muted); font-size: 11px; line-height: 1.45; }
            .report-alerts { padding: 8px 12px 12px; }
            .report-alert { display: flex; gap: 11px; padding: 12px 8px; border-bottom: 1px solid var(--line); }
            .report-alert:last-child { border-bottom: 0; }
            .report-alert__icon { display: grid; width: 26px; height: 26px; flex: none; place-items: center; border-radius: 9px; font-size: 13px; font-weight: 900; }
            .report-alert--danger .report-alert__icon { background: #feecec; color: #b42318; }
            .report-alert--warning .report-alert__icon { background: #fff5dc; color: #a35d00; }
            .report-alert--success .report-alert__icon { background: #e9f8f1; color: #147653; }
            .report-alert b { display: block; color: var(--ink); font-size: 11px; }
            .report-alert p { margin: 3px 0 0; color: var(--muted); font-size: 10px; line-height: 1.45; }
            .report-capacity { padding: 18px 20px 20px; }
            .report-capacity__total { margin: 0 0 17px; color: var(--ink); font-size: 24px; font-weight: 800; }
            .report-capacity__total span { color: var(--muted); font-size: 11px; font-weight: 600; }
            .report-capacity__row { margin-top: 12px; }
            .report-capacity__label { display: flex; justify-content: space-between; gap: 12px; color: var(--muted); font-size: 11px; }
            .report-capacity__label b { color: var(--ink); }
            .report-capacity__track { height: 8px; margin-top: 6px; overflow: hidden; border-radius: 999px; background: #edf1f4; }
            .report-capacity__track i { display: block; height: 100%; border-radius: inherit; background: var(--capacity-color, var(--green)); }
            .report-briefing { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; padding: 16px 20px; border-top: 1px solid var(--line); background: #fbfaf8; }
            .report-briefing span { display: block; color: var(--muted); font-size: 10px; font-weight: 700; }
            .report-briefing b { display: block; margin-top: 4px; color: var(--ink); font-size: 13px; }
            .report-preview { margin-top: 20px; }
            .report-preview .toolbar { align-items: center; flex-wrap: wrap; margin: 0; }
            .report-preview__context { margin-left: auto; color: var(--muted); font-size: 10px; font-weight: 700; }
            .report-library { margin-top: 20px; }
            .report-library__intro { margin: 4px 0 0; color: var(--muted); font-size: 11px; }
            .report-shortcut { display: flex; width: 100%; min-height: 116px; flex-direction: column; align-items: flex-start; padding: 15px; border: 1px solid transparent; border-radius: 10px; background: linear-gradient(135deg, #fff8e6, #fff3d4); color: #895400; text-align: left; transition: border-color .16s ease, box-shadow .16s ease, transform .16s ease; }
            .report-shortcut:hover { border-color: #dfb30c; box-shadow: 0 7px 16px rgb(175 125 0 / .12); transform: translateY(-2px); }
            .report-shortcut.is-selected { border-color: #b78900; background: linear-gradient(135deg, #fff0b8, #ffe491); box-shadow: 0 0 0 3px rgb(255 202 1 / .25); }
            .report-shortcut b { color: var(--ink); font-size: 12px; }
            .report-shortcut span { margin-top: 4px; color: #895400; font-size: 11px; line-height: 1.45; }
            .report-shortcut small { margin-top: auto; padding-top: 10px; color: #745100; font-size: 10px; font-weight: 800; letter-spacing: .04em; }
            body[data-theme="dark"] .report-filter, body[data-theme="dark"] .report-panel__head, body[data-theme="dark"] .report-alert, body[data-theme="dark"] .report-briefing { border-color: #4d4844; }
            body[data-theme="dark"] .report-preset { border-color: #5a534d; background: #363230; color: #e8ddd4; }
            body[data-theme="dark"] .report-preset:hover, body[data-theme="dark"] .report-preset.is-active { background: #554617; border-color: #d7ad20; color: #fff1bc; }
            body[data-theme="dark"] .report-briefing { background: #252322; }
            body[data-theme="dark"] .report-capacity__track { background: #4a4541; }
            body[data-theme="dark"] .report-shortcut { background: linear-gradient(135deg, #463713, #3d3010); color: #ffe48a; }
            body[data-theme="dark"] .report-shortcut:hover, body[data-theme="dark"] .report-shortcut.is-selected { border-color: #e3bc28; background: linear-gradient(135deg, #5a4617, #4a3911); }
            body[data-theme="dark"] .report-shortcut b { color: #fffaf4; }
            body[data-theme="dark"] .report-shortcut span, body[data-theme="dark"] .report-shortcut small { color: #ffe48a; }
            @media (max-width: 900px) { .report-insights { grid-template-columns: 1fr; } .report-hero { grid-template-columns: 1fr; } .report-hero__meta { width: fit-content; } }
            @media (max-width: 640px) { .report-filter__top { align-items: flex-start; flex-direction: column; } .report-filter__fields { align-items: stretch; flex-direction: column; } .report-filter .field { width: 100%; } .report-actions { justify-content: flex-start; } .report-briefing { grid-template-columns: 1fr; } .report-preview__context { width: 100%; margin-left: 0; } }
            /* Complete dark treatment for operational data, controls and vault states. */
            body[data-theme="dark"] .card,
            body[data-theme="dark"] .panel {
                background: #2a2827;
                border-color: #4d4844;
            }
            body[data-theme="dark"] .toolbar {
                background: linear-gradient(180deg, #322f2d, #2a2827);
                border-color: #4d4844;
            }
            body[data-theme="dark"] .search input,
            body[data-theme="dark"] .field input,
            body[data-theme="dark"] .field select,
            body[data-theme="dark"] .toolbar select,
            body[data-theme="dark"] .safe-date {
                background-color: #363230;
                border-color: #5a534d;
                color: #fffaf4;
                box-shadow: none;
            }
            body[data-theme="dark"] .search input::placeholder {
                color: #aaa098;
            }
            body[data-theme="dark"] .field input:hover,
            body[data-theme="dark"] .field select:hover,
            body[data-theme="dark"] .toolbar select:hover,
            body[data-theme="dark"] .search input:hover {
                background-color: #403b38;
                border-color: #927829;
            }
            body[data-theme="dark"] .field select option,
            body[data-theme="dark"] .toolbar select option {
                background: #363230;
                color: #fffaf4;
            }
            body[data-theme="dark"] .safe-date--readonly {
                background: #302d2b;
                color: #c5bab0;
            }
            body[data-theme="dark"] .safe-calendar {
                background: #302d2b;
                border-color: #514a44;
                box-shadow: 0 18px 40px rgb(0 0 0 / 0.38);
            }
            body[data-theme="dark"] .safe-calendar__nav {
                background: #3b3734;
                border-color: #5a534d;
                color: #f7f0e9;
            }
            body[data-theme="dark"] .safe-calendar__week {
                color: #c5bab0;
            }
            body[data-theme="dark"] .safe-calendar__day {
                color: #f7f0e9;
            }
            body[data-theme="dark"] .safe-calendar__day--muted {
                color: #827a73;
            }
            body[data-theme="dark"] .safe-calendar__day:hover {
                background: #554617;
                color: #fff4c8;
            }
            body[data-theme="dark"] .outline {
                background: #393532;
                border-color: #5a534d;
                color: #fffaf4;
            }
            body[data-theme="dark"] .outline:hover {
                background: #47413c;
                border-color: #d3a400;
            }
            body[data-theme="dark"] .primary {
                background: #ffca01;
                color: #302900;
                box-shadow: 0 7px 16px rgb(255 202 1 / 0.16);
            }
            body[data-theme="dark"] th {
                background: #383431;
                color: #d6cbc1;
                border-color: #514a44;
            }
            body[data-theme="dark"] th,
            body[data-theme="dark"] td {
                border-color: #48433f;
            }
            body[data-theme="dark"] tbody tr:hover {
                background: #34312f;
            }
            body[data-theme="dark"] .bar {
                background: #494440;
            }
            body[data-theme="dark"] .box-grid {
                background: #242220;
            }
            body[data-theme="dark"] .box-card,
            body[data-theme="dark"] .box-card:disabled {
                opacity: 1;
                background: linear-gradient(145deg, #3a3735, #302e2c);
                border-color: #59534e;
                color: #f7f0e9;
                box-shadow: 0 3px 8px rgb(0 0 0 / 0.12);
            }
            body[data-theme="dark"] .box-card.available {
                background: linear-gradient(145deg, #173e34, #12352d);
                border-color: #2f9c79;
            }
            body[data-theme="dark"] .box-card.available:hover {
                background: linear-gradient(145deg, #1c4a3e, #164238);
                border-color: #68d2aa;
            }
            body[data-theme="dark"] .box-card.chosen {
                outline-color: #ffdc57;
                border-color: var(--gold);
            }
            body[data-theme="dark"] .box-card .muted {
                color: #d4cbc4;
            }
            body[data-theme="dark"] .green {
                background: #173f34;
                color: #8be0bd;
            }
            body[data-theme="dark"] .amber {
                background: #4a3a16;
                color: #ffd66c;
            }
            body[data-theme="dark"] .blue {
                background: #263b4a;
                color: #add9f3;
            }
            body[data-theme="dark"] .slate {
                background: #3b4145;
                color: #d1dbe2;
            }
            body[data-theme="dark"] .notice {
                background: linear-gradient(135deg, #514118, #3e3216);
                color: #ffe29a;
            }
            body[data-theme="dark"] .selected {
                background: #163d32;
                border-color: #318564;
            }
            body[data-theme="dark"] .field label {
                color: #d9d0c8;
            }
            body[data-theme="dark"] .form-group summary::before {
                background: #45403c;
                color: #f4eade;
            }
            body[data-theme="dark"] .invoice {
                background: #302d2b;
                color: #fffaf4;
            }
            @media (max-width: 1050px) {
                .side {
                    width: 70px;
                }
                .brand {
                    padding: 0;
                    justify-content: center;
                }
                .brand > div {
                    display: none;
                }
                .brand-logo {
                    width: 38px;
                    height: 38px;
                    object-fit: cover;
                    object-position: left center;
                    transform: none;
                }
                .side .nav {
                    justify-content: center;
                }
                .side .nav span:not(.ico),
                .nav-label,
                .restore span {
                    display: none;
                }
                .restore {
                    margin: 0;
                }
                .main {
                    margin-left: 70px;
                }
                .top {
                    margin-left: -70px;
                    padding-left: 94px;
                }
                .grid4 {
                    grid-template-columns: repeat(2, 1fr);
                }
                .box-grid {
                    grid-template-columns: repeat(3, 1fr);
                }
            }
            @media (max-width: 700px) {
                .side {
                    top: 0;
                    transform: translateX(-100%);
                    width: 250px;
                }
                .side.open {
                    transform: translateX(0);
                }
                .main {
                    margin: 0;
                }
                .top {
                    gap: 12px;
                    margin-left: 0;
                    padding: 0 15px;
                }
                .top > .btn {
                    display: inline-grid;
                    width: 38px;
                    height: 38px;
                    place-items: center;
                    padding: 0;
                    border-radius: 10px;
                }
                .content {
                    padding: 18px;
                }
                .hero,
                .heading {
                    align-items: flex-start;
                    flex-direction: column;
                }
                .grid4,
                .two,
                .split {
                    grid-template-columns: 1fr;
                }
                .box-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
                .fields {
                    grid-template-columns: 1fr;
                }
                .fields .wide {
                    grid-column: auto;
                }
                .profile span {
                    display: none;
                }
                .top-divider {
                    display: none;
                }
                .top-popover {
                    position: fixed;
                    top: 70px;
                    right: 16px;
                    left: 16px;
                    width: auto;
                }
            }

            .swal2-popup.saferoom-dialog { border: 1px solid var(--line); border-radius: 20px; background: var(--surface); color: var(--ink); font-family: "DM Sans", sans-serif; box-shadow: 0 24px 70px rgb(22 27 24 / .25); }
            .saferoom-dialog .swal2-title { font-family: Manrope, sans-serif; font-size: 23px; letter-spacing: -.03em; }
            .saferoom-dialog .swal2-html-container { color: var(--muted); font-size: 14px; line-height: 1.5; }
            .saferoom-dialog .swal2-input-label { justify-content: flex-start; margin: 22px 2em 0; font-size: 12px; font-weight: 700; }
            .saferoom-dialog .swal2-textarea { width: calc(100% - 4em); min-height: 105px; margin: 9px 2em 0; border: 1px solid var(--line); border-radius: 10px; background: var(--surface); color: var(--ink); font: inherit; resize: vertical; }
            .saferoom-dialog .swal2-textarea:focus { border-color: #d7a900; box-shadow: 0 0 0 3px rgb(255 202 1 / .22); }
            .saferoom-dialog .swal2-actions { gap: 10px; }
            .saferoom-dialog .swal2-confirm, .saferoom-dialog .swal2-cancel { margin: 0; padding: 12px 20px; border-radius: 10px; font: 700 13px Manrope, sans-serif; }
            .saferoom-dialog .swal2-confirm { background: #ffca01; color: #292722; }
            .saferoom-dialog .swal2-cancel { border: 1px solid var(--line); background: var(--surface); color: var(--ink); }
            .saferoom-dialog .swal2-validation-message { border-radius: 8px; font-size: 12px; }
            .invoice.contract-invoice { width:min(900px,100%); max-height:calc(100vh - 36px); overflow-y:auto; }
            .contract-invoice-summary { display:flex; align-items:center; justify-content:space-between; gap:16px; margin:18px 0; padding:16px; border-radius:12px; background:#fff5d2; color:#302b20; }
            .contract-invoice-summary strong { font-size:21px; white-space:nowrap; }
            .contract-invoice-fields { align-items:end; }
            .contract-invoice-fields .btn { min-height:42px; }
            .contract-invoice-table { margin-top:16px; }
            .contract-invoice-totals, .contract-invoice-actions { display:flex; flex-wrap:wrap; justify-content:flex-end; gap:18px; align-items:center; margin-top:16px; }
            .contract-invoice-totals span { color:var(--muted); font-size:12px; }
            .contract-invoice-totals b { margin-left:6px; color:var(--ink); font-size:15px; }
            .contract-invoice-error { padding:10px 12px; border-radius:8px; background:#fff0ee; color:#a12c20; font-size:12px; }
            @media(max-width:600px) { .contract-invoice-summary { align-items:flex-start; flex-direction:column; } .contract-invoice-actions .btn { flex:1; } }
            .contract-selector { display:grid; grid-template-columns:1fr 1.2fr; gap:24px; align-items:center; }
            .contract-empty { margin-top:18px; text-align:center; color:var(--muted); padding:42px; }
            .contract-tabs { display:flex; gap:5px; overflow-x:auto; margin:20px 0 14px; border-bottom:1px solid var(--line); }
            .contract-tabs button { flex:none; padding:13px 16px; background:transparent; color:var(--muted); border-bottom:3px solid transparent; font-weight:700; }
            .contract-tabs button.on { color:var(--ink); border-color:var(--gold); }
            .contract-panel[hidden], [data-contract-panel][hidden] { display:none; }
            .contract-info { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:0 24px; margin-top:20px; }
            .contract-info div { padding:12px 0; border-bottom:1px solid var(--line); overflow-wrap:anywhere; }
            .contract-info span { display:block; margin-bottom:5px; color:var(--muted); font-size:11px; }
            .contract-divider { border:0; border-top:1px solid var(--line); margin:25px 0; }
            .contract-selector .select2-container .select2-selection--single { height:46px; border:1px solid var(--line); border-radius:10px; background:var(--surface); }
            .contract-selector .select2-container .select2-selection__rendered { line-height:44px; padding-left:14px; color:var(--ink); }
            .contract-selector .select2-container .select2-selection__arrow { height:44px; }
            .select2-dropdown { border-color:var(--line); border-radius:10px; background:var(--surface); color:var(--ink); }
            .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable { background:#ffca01; color:#242121; }
            body[data-theme="dark"] .select2-search__field { background:var(--surface); color:var(--ink); }
            @media(max-width:700px) { .contract-selector, .contract-info { grid-template-columns:1fr; } }
            /* A calm, tactile console inspired by the vault itself. */
            h1, h2, h3, .nav, .btn, .metric { font-family: Manrope, sans-serif; }
            .side { border-right: 1px solid #e7e2dc; overflow-y: auto; }
            .side nav { padding-top: 20px; }
            .nav { transition: background .2s ease, color .2s ease, transform .2s ease; }
            .nav:hover { transform: translateX(3px); }
            .hero { background: radial-gradient(circle at 85% 20%, #5c5b4e 0, transparent 35%), linear-gradient(120deg,#222b2a,#343d38); }
            .hero h1 { letter-spacing: -.045em; }
            .workflow { display:grid; grid-template-columns: 1.15fr repeat(3, 1fr); gap: 1px; margin: 18px 0; overflow:hidden; border:1px solid var(--line); border-radius:16px; background:var(--line); }
            .workflow-intro, .workflow button { min-width:0; padding:17px; background:var(--surface); text-align:left; }
            .workflow-intro span { display:block; color:#907319; font-size:10px; font-weight:800; letter-spacing:.12em; margin-bottom:7px; }
            .workflow-intro b { font-size:13px; }
            .workflow button { display:flex; align-items:center; gap:10px; color:var(--ink); transition:background .2s; }
            .workflow button:hover { background:#fff8dc; }
            .workflow i { display:grid; place-items:center; flex:none; width:32px; height:32px; border-radius:50%; background:#f4f1e9; color:#8f761c; font-style:normal; font-size:10px; font-weight:800; }
            .workflow button span { min-width:0; flex:1; }
            .workflow button b, .workflow button small { display:block; }
            .workflow button small { margin-top:4px; color:var(--muted); font-size:10px; line-height:1.4; }
            .workflow em { color:#a99d76; font-style:normal; }
            #reports .report-hero, #reports > .grid4, #reports .report-insights, #reports .report-library { display:none; }
            .report-preview { margin-top:18px; overflow:hidden; }
            .report-preview .toolbar { padding:20px 22px; }
            .sheet-bar { display:flex; align-items:center; gap:9px; padding:10px 16px; border-block:1px solid #dfe5e0; background:#f2f6f3; color:#315c49; font-weight:700; font-size:12px; }
            .sheet-bar small { margin-left:auto; color:#718078; font-weight:400; }
            .sheet-grid { margin:0; overflow:auto; }
            .sheet-grid table { min-width:700px; border-collapse:collapse; }
            .sheet-grid th, .sheet-grid td { border:1px solid #e1e8e2; padding:11px 14px; white-space:nowrap; }
            .sheet-grid thead tr:not(.sheet-letters) th { background:#e7f1eb; color:#254f3a; }
            .sheet-grid thead .sheet-letters th, .sheet-grid tbody th { padding:6px 12px; background:#f4f6f4; color:#85918a; text-align:center; font-size:10px; font-weight:600; }
            .sheet-grid tbody tr:hover td { background:#f8fbf8; }
            .sheet-footer { display:flex; justify-content:space-between; align-items:center; padding:10px 18px; background:#f4f6f4; color:#65746a; font-size:11px; }
            .sheet-footer span { border-bottom:2px solid #347b55; color:#28563d; font-weight:700; padding:5px 12px; }
            body[data-theme="dark"] .workflow-intro, body[data-theme="dark"] .workflow button { background:var(--surface); }
            body[data-theme="dark"] .sheet-bar, body[data-theme="dark"] .sheet-footer, body[data-theme="dark"] .sheet-grid thead .sheet-letters th, body[data-theme="dark"] .sheet-grid tbody th { background:#28332e; color:#c2d4c7; }
            body[data-theme="dark"] .sheet-grid thead tr:not(.sheet-letters) th { background:#304b3c; color:#e3f4e8; }
            body[data-theme="dark"] .sheet-grid td, body[data-theme="dark"] .sheet-grid th { border-color:#455148; }
            body[data-theme="dark"] .sheet-grid tbody tr:hover td { background:#29362e; }
            @media (max-width: 950px) { .workflow { grid-template-columns:repeat(2,1fr); } }
            @media (max-width: 600px) { .workflow { grid-template-columns:1fr; } .workflow-intro, .workflow button { padding:12px 15px; } .sheet-bar small { display:none; } }
            @media (prefers-reduced-motion: reduce) { *, *::before, *::after { scroll-behavior:auto !important; animation-duration:.01ms !important; animation-iteration-count:1 !important; transition-duration:.01ms !important; } }
        </style>
    </head>
    <body>
        <a class="skip-link" href="#contenido-principal">Saltar al contenido</a>
        <aside class="side" id="side">
            <div class="brand">
                <img
                    class="brand-logo"
                    src="{{ asset('images/saferoom-logo.png') }}"
                    alt="SafeRoom"
                />
            </div>
            <nav aria-label="Navegación principal">
                <p class="nav-label" data-nav-section="operation">CLIENTES Y ARRENDAMIENTO</p>
                <button class="nav on" data-section="operation" data-view="home"><span class="ico">◫</span><span>Inicio</span></button>
                <button class="nav" data-section="operation" data-view="requests"><span class="ico">☷</span><span>Solicitudes</span></button>
                <button class="nav" data-section="operation" data-view="tenants"><span class="ico">♙</span><span>Arrendatarios</span></button>
                <button class="nav" data-section="operation" data-view="contracts"><span class="ico">▤</span><span>Contratos</span></button>
                <button class="nav" data-section="operation" data-view="renewals"><span class="ico">↻</span><span>Renovaciones</span></button>
                <button class="nav" data-section="operation" data-view="cancellations"><span class="ico">⊘</span><span>Cancelaciones</span></button>
                <p class="nav-label" data-nav-section="management" style="margin-top: 22px">BÓVEDA Y ADMINISTRACIÓN</p>
                <button class="nav" data-section="management" data-view="access"><span class="ico">⌁</span><span>Accesos a bóveda</span></button>
                <button class="nav" data-section="management" data-view="boxes"><span class="ico">▣</span><span>Catálogo de cajas</span></button>
                <button class="nav" data-section="management" data-view="documents"><span class="ico">◱</span><span>Documentos</span></button>
                <button class="nav" data-section="management" data-view="finance"><span class="ico">$</span><span>Finanzas</span></button>
                <button class="nav" data-section="management" data-view="reports"><span class="ico">▥</span><span>Reportes</span></button>
                <p class="nav-label" data-nav-section="settings" style="margin-top: 22px">CONFIGURACIÓN</p>
                <button class="nav" data-section="settings" data-view="settings"><span class="ico">⚙</span><span>Catálogos y alertas</span></button>
                <button class="nav" data-section="settings" data-view="users"><span class="ico">♧</span><span>Usuarios y permisos</span></button>
            </nav>
            <div class="restore">
                <button onclick="resetDemo()">
                    ↺ <span>Restablecer demo</span>
                </button>
            </div>
        </aside>
        <main class="main">
            <header class="top">
                <button
                    class="btn outline"
                    onclick="
                        document.getElementById('side').classList.toggle('open')
                    "
                >
                    ☰
                </button>
                <div>
                    <span class="crumb">SafeRoom · Centro Mérida</span
                    ><strong id="pageTitle">Vista general</strong>
                </div>
                <div class="top-tools">
                    <span
                        class="tag blue"
                        title="Los registros se conservan solo en este navegador"
                        >DEMO · DATOS FICTICIOS</span
                    >
                    <div class="header-popover-wrap">
                        <button
                            class="utility-button"
                            type="button"
                            onclick="toggleHeaderPanel('notificationPanel')"
                            aria-label="Ver notificaciones"
                            aria-expanded="false"
                            aria-controls="notificationPanel"
                            id="notificationButton"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.9"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <path
                                    d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"
                                ></path>
                                <path d="M10 22h4"></path>
                            </svg>
                            <span
                                class="notification-dot"
                                aria-hidden="true"
                            ></span>
                        </button>
                        <section
                            class="top-popover"
                            id="notificationPanel"
                            hidden
                            aria-label="Notificaciones"
                        >
                            <header class="top-popover__head">
                                <b>Notificaciones</b><span>2 nuevas</span>
                            </header>
                            <div class="notification-item">
                                <div class="notification-icon">✓</div>
                                <div>
                                    <b>Acceso validado</b>
                                    <p>
                                        Mariana López Canto registró acceso a la
                                        bóveda.
                                    </p>
                                </div>
                            </div>
                            <div class="notification-item">
                                <div class="notification-icon">!</div>
                                <div>
                                    <b>Contrato próximo a vencer</b>
                                    <p>
                                        CT-2026-0148 requiere seguimiento dentro
                                        de 30 días.
                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>
                    <span class="top-divider" aria-hidden="true"></span>
                    <div class="header-popover-wrap">
                        <button
                            class="profile"
                            type="button"
                            onclick="toggleHeaderPanel('profilePanel')"
                            aria-label="Opciones del perfil"
                            aria-expanded="false"
                            aria-controls="profilePanel"
                            id="profileButton"
                        >
                            <i class="avatar" id="profileInitials">AC</i>
                            <span
                                ><b id="profileName">Andrea Castillo</b><br /><small id="profileRole"
                                    >Administración</small
                                ></span
                            >
                        </button>
                        <section
                            class="top-popover profile-popover"
                            id="profilePanel"
                            hidden
                            aria-label="Opciones de perfil"
                        >
                            <div class="profile-summary">
                                <i class="avatar" id="profilePanelInitials">AC</i>
                                <div>
                                    <b id="profilePanelName">Andrea Castillo</b
                                    ><span id="profilePanelRole">Administración</span>
                                </div>
                            </div>
                            <label class="theme-row"
                                ><span
                                    ><b>Modo oscuro</b
                                    ><span
                                        >Interfaz de operación nocturna</span
                                    ></span
                                ><span class="theme-switch"
                                    ><input
                                        id="themeToggle"
                                        type="checkbox"
                                        onchange="setTheme(this.checked)"
                                        aria-label="Activar modo oscuro" /><span
                                        class="theme-switch__track"
                                    ></span></span
                            ></label>
                            <form method="POST" action="{{ route('logout') }}" style="margin-top:14px">
                                @csrf
                                <button class="btn outline" type="submit" style="width:100%">Cerrar sesión</button>
                            </form>
                        </section>
                    </div>
                </div>
            </header>
            <div class="content" id="contenido-principal" tabindex="-1">
                <section class="view on" id="home">
                    <div class="hero">
                        <div>
                            <span class="eyebrow"
                                >DEMO OPERATIVA · DATOS FICTICIOS</span
                            >
                            <h1>Tu bóveda, en orden.</h1>
                            <p>
                                De la solicitud al acceso: administra cada paso desde un solo lugar.
                            </p>
                        </div>
                        <div>
                            <button class="btn gold" onclick="startRequest()">
                                ＋ Nueva solicitud
                            </button>
                            <button
                                class="btn outline"
                                onclick="chooseBoxForDraft()"
                            >
                                Ver cajas
                            </button>
                        </div>
                    </div>
                    <section class="workflow" aria-label="Flujo de operación">
                        <div class="workflow-intro"><span>FLUJO DE OPERACIÓN</span><b>Todo comienza con una solicitud</b></div>
                        <button type="button" onclick="showView('requests')"><i>01</i><span><b>Solicitud</b><small>Registrar y autorizar</small></span><em>→</em></button>
                        <button type="button" onclick="showView('tenants')"><i>02</i><span><b>Arrendatario</b><small>Contrato y autorizados</small></span><em>→</em></button>
                        <button type="button" onclick="showView('access')"><i>03</i><span><b>Acceso a bóveda</b><small>Entrada, C4 y firma de salida</small></span><em>→</em></button>
                    </section>
                    <div class="grid4">
                        <article class="card">
                            <span class="muted">OCUPACIÓN ACTUAL</span>
                            <div class="metric" id="occupancy">58%</div>
                            <span class="muted" id="occDetail"
                                >7 de 12 cajas ocupadas</span
                            >
                        </article>
                        <article class="card">
                            <span class="muted">CONTRATOS ACTIVOS</span>
                            <div class="metric" id="contractsCount">148</div>
                            <span class="muted">+4 este mes</span>
                        </article>
                        <article class="card">
                            <span class="muted">PRÓXIMOS VENCIMIENTOS</span>
                            <div class="metric" id="upcomingCount">0</div>
                            <span class="muted">En los siguientes 30 días</span>
                        </article>
                        <article class="card">
                            <span class="muted">ACCESOS HOY</span>
                            <div class="metric" id="accessesToday">0</div>
                            <span class="muted">Entradas registradas hoy</span>
                        </article>
                    </div>
                    <div class="two">
                        <section class="panel" id="recentActivity">
                            <div class="panel-head">
                                <div>
                                    <b>Actividad reciente</b>
                                    <p class="muted">Operación del día</p>
                                </div>
                                <button
                                    class="btn outline"
                                    onclick="showView('requests')"
                                >
                                    Ver solicitudes
                                </button>
                            </div>
                            <div class="activity">
                                <span
                                    ><b>Sofía Herrera</b><br /><small
                                        class="muted"
                                        >Nueva solicitud para caja B-201</small
                                    ></span
                                ><small class="muted">Hace 18 min</small>
                            </div>
                            <div class="activity">
                                <span
                                    ><b>Mariana López Canto</b><br /><small
                                        class="muted"
                                        >Contrato CT-2026-0148 próximo a
                                        vencer</small
                                    ></span
                                ><small class="muted">Hace 42 min</small>
                            </div>
                            <div class="activity">
                                <span
                                    ><b>A-102</b><br /><small class="muted"
                                        >Caja disponible después de
                                        inspección</small
                                    ></span
                                ><small class="muted">Hace 1 h</small>
                            </div>
                        </section>
                        <section class="panel">
                            <div class="panel-body">
                                <b>Disponibilidad por estado</b>
                                <div
                                    id="statusBars"
                                    style="margin-top: 18px"
                                ></div>
                                <div
                                    id="availabilityAlertBanner"
                                    style="margin-top: 14px"
                                ></div>

                            </div>
                        </section>
                    </div>
                </section>
                <section class="view" id="requests">
                    <div class="heading">
                        <div>
                            <p class="eyebrow">OPERACIÓN</p>
                            <h1>Solicitudes de arrendamiento</h1>
                            <p class="muted">
                                Expedientes por verificar antes de aprobar,
                                denegar o dar de alta al arrendatario.
                            </p>
                        </div>
                        <button class="btn primary" onclick="startRequest()">
                            ＋ Nueva solicitud
                        </button>
                    </div>
                    <section class="panel">
                        <div class="availability-map">
                            <div class="availability-map__head">
                                <div><b>Mapa de disponibilidad</b><br /><small class="muted">Consulta el estado de cada caja antes de asignarla.</small></div>
                                <div class="availability-map__legend"><span><i style="background:#168b62"></i>Disponible</span><span><i style="background:#c0392b"></i>Ocupada</span><span><i style="background:#c98b00"></i>Reservada</span><span><i style="background:#506d88"></i>Mantenimiento</span></div>
                            </div>
                            <div class="grid4">
                                <div class="notice"><b id="boxAvailableCount">—</b><br /><small>Disponibles</small></div>
                                <div class="notice"><b id="boxOccupiedCount">—</b><br /><small>Ocupadas</small></div>
                                <div class="notice"><b id="boxReservedCount">—</b><br /><small>Reservadas</small></div>
                                <div class="notice"><b id="boxAvailabilityRate">—</b><br /><small>Disponibilidad</small></div>
                            </div>
                            <div class="availability-map__grid" id="availabilityMap"></div>
                        </div>
                        <div class="toolbar">
                            <div class="search">
                                <input
                                    id="requestSearch"
                                    oninput="renderRequests()"
                                    placeholder="Buscar por nombre, folio o caja"
                                />
                            </div>
                            <button class="btn outline">☷ Filtros</button>
                        </div>
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Solicitud</th>
                                        <th>Persona solicitante</th>
                                        <th>Servicios solicitados</th>
                                        <th>Creada</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="requestRows"></tbody>
                            </table>
                        </div>
                    </section>
                </section>
                <section class="view" id="form">
                    <button class="btn outline" onclick="showView('requests')">
                        ← Solicitudes
                    </button>
                    <p class="eyebrow" style="margin-top: 20px">SOLICITUD · EXPEDIENTE</p>
                    <h1>Nueva solicitud</h1>
                    <p class="muted">
                        Captura el expediente, referencias, servicios y datos
                        de facturación. La autorización ocurre después de la
                        verificación.
                    </p>
                    <div class="split" style="margin-top: 22px">
                        <div class="panel section">
                            <h2>Datos de la persona solicitante</h2>
                            <p class="muted">
                                Campos relevantes observados en el sistema
                                anterior, organizados para la primera etapa.
                            </p>
                            <div class="fields">
                                <div class="field">
                                    <label>TIPO DE PERSONA</label
                                    ><select id="fPersonType" onchange="syncRequestRequirements()">
                                        <option value="Física">Persona física</option>
                                        <option value="Moral">Persona moral</option>
                                    </select>
                                </div>
                                <div class="field wide">
                                    <label>NOMBRE COMPLETO</label
                                    ><input
                                        id="fName"
                                        placeholder="Ej. Andrea Mendoza Torres"
                                    />
                                </div>
                                <div class="field">
                                    <label>CORREO ELECTRÓNICO</label
                                    ><input
                                        id="fEmail"
                                        placeholder="nombre@correo.mx"
                                    />
                                </div>
                                <div class="field">
                                    <label>TELÉFONO</label
                                    ><input
                                        id="fPhone"
                                        placeholder="999 000 0000"
                                    />
                                </div>
                                <div class="field">
                                    <label
                                        >RFC
                                        <span class="muted"
                                            >(opcional)</span
                                        ></label
                                    ><input
                                        id="fRfc"
                                        placeholder="XAXX010101000"
                                    />
                                </div>
                            </div>
                            <details class="form-group" open>
                                <summary>
                                    Datos generales e identificación
                                </summary>
                                <p class="form-helper">
                                    Campos observados en la pantalla de
                                    solicitud. La obligatoriedad se definirá en
                                    la validación operativa.
                                </p>
                                <div class="fields">
                                    <div class="field">
                                        <label>CURP</label
                                        ><input
                                            id="fCurp"
                                            placeholder="CURP de 18 caracteres"
                                        />
                                    </div>
                                    <div class="field">
                                        <label>FECHA DE NACIMIENTO</label
                                        ><input id="fBirthDate" type="date" />
                                    </div>
                                    <div class="field">
                                        <label>LUGAR DE NACIMIENTO</label
                                        ><input id="fBirthPlace" placeholder="Mérida, Yucatán" />
                                    </div>
                                    <div class="field">
                                        <label>SEXO</label
                                        ><select id="fGender">
                                            <option value="">
                                                Seleccionar
                                            </option>
                                            <option>Femenino</option>
                                            <option>Masculino</option>
                                            <option>Prefiero no indicar</option>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>NACIONALIDAD</label
                                        ><input
                                            id="fNationality"
                                            placeholder="Mexicana"
                                        />
                                    </div>
                                    <div class="field">
                                        <label>ESTADO CIVIL</label
                                        ><select id="fCivilStatus">
                                            <option value="">
                                                Seleccionar
                                            </option>
                                            <option>Soltero/a</option>
                                            <option>Casado/a</option>
                                            <option>Otro</option>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>NOMBRE DEL CÓNYUGE</label
                                        ><input id="fSpouseName" placeholder="Nombre completo" />
                                    </div>
                                    <div class="field">
                                        <label>RÉGIMEN MATRIMONIAL</label
                                        ><select id="fMaritalRegime">
                                            <option value="">Sin seleccionar</option>
                                            <option>Ninguno</option>
                                            <option>Sociedad conyugal</option>
                                            <option>Separación de bienes</option>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>CÓMO SE ENTERÓ</label
                                        ><select id="fSource">
                                            <option value="">
                                                Seleccionar
                                            </option>
                                            <option>Recomendación</option>
                                            <option>Redes sociales</option>
                                            <option>Visita directa</option>
                                            <option>Otro</option>
                                        </select>
                                    </div>
                                </div>
                            </details>
                            <details class="form-group" open>
                                <summary>Domicilio y referencias</summary>
                                <p class="form-helper">
                                    Datos de domicilio y referencia personal
                                    observados en el sistema legado.
                                </p>
                                <div class="fields">
                                    <div class="field wide">
                                        <label>CALLE Y NÚMERO</label
                                        ><input
                                            id="fStreet"
                                            placeholder="Calle, número exterior e interior"
                                        />
                                    </div>
                                    <div class="field">
                                        <label>COLONIA</label
                                        ><input
                                            id="fNeighborhood"
                                            placeholder="Colonia"
                                        />
                                    </div>
                                    <div class="field">
                                        <label>CÓDIGO POSTAL</label
                                        ><input
                                            id="fPostalCode"
                                            placeholder="97000"
                                        />
                                    </div>
                                    <div class="field">
                                        <label>MUNICIPIO</label
                                        ><input
                                            id="fMunicipality"
                                            placeholder="Mérida"
                                        />
                                    </div>
                                    <div class="field">
                                        <label>ESTADO</label
                                        ><input
                                            id="fState"
                                            placeholder="Yucatán"
                                        />
                                    </div>
                                    <div class="field">
                                        <label>TIEMPO DE RESIDENCIA</label
                                        ><input id="fResidenceTime" placeholder="Ej. 5 años" />
                                    </div>
                                    <div class="field">
                                        <label>TELÉFONO DE CASA</label
                                        ><input id="fHomePhone" placeholder="999 000 0000" />
                                    </div>
                                    <div class="field">
                                        <label>OTRO TELÉFONO</label
                                        ><input id="fOtherPhone" placeholder="999 000 0000" />
                                    </div>
                                    <div class="field">
                                        <label>REFERENCIA PERSONAL</label
                                        ><input
                                            id="fReference"
                                            placeholder="Nombre de referencia"
                                        />
                                    </div>
                                    <div class="field">
                                        <label>TELÉFONO DE REFERENCIA</label
                                        ><input
                                            id="fReferencePhone"
                                            placeholder="999 000 0000"
                                        />
                                    </div>
                                    <div class="field">
                                        <label>REFERENCIA 2</label
                                        ><input id="fReferenceTwo" placeholder="Nombre de referencia" />
                                    </div>
                                    <div class="field">
                                        <label>TELÉFONO REFERENCIA 2</label
                                        ><input id="fReferenceTwoPhone" placeholder="999 000 0000" />
                                    </div>
                                </div>
                            </details>
                            <details class="form-group">
                                <summary>Empresa y facturación</summary>
                                <p class="form-helper">
                                    El perfil de público general es opcional.
                                    Para facturar a nombre del cliente se
                                    requiere la constancia de situación fiscal.
                                </p>
                                <div class="fields">
                                    <div class="field">
                                        <label>EMPRESA / RAZÓN SOCIAL</label
                                        ><input
                                            id="fCompany"
                                            placeholder="Empresa o razón social"
                                        />
                                    </div>
                                    <div class="field">
                                        <label>PUESTO / ACTIVIDAD</label
                                        ><input
                                            id="fJobTitle"
                                            placeholder="Puesto o actividad"
                                        />
                                    </div>
                                    <div class="field">
                                        <label>TIPO DE EMPRESA</label
                                        ><select id="fWorkType"><option value="">Sin seleccionar</option><option>Privada</option><option>Pública</option><option>Propia</option></select>
                                    </div>
                                    <div class="field">
                                        <label>RFC DE LA EMPRESA</label
                                        ><input id="fWorkRfc" placeholder="RFC de la empresa" />
                                    </div>
                                    <div class="field">
                                        <label>TELÉFONO DE TRABAJO</label
                                        ><input id="fWorkPhone" placeholder="999 000 0000" />
                                    </div>
                                    <div class="field">
                                        <label>FECHA DE INGRESO</label
                                        ><input id="fWorkStartDate" type="date" />
                                    </div>
                                    <div class="field wide">
                                        <label>DOMICILIO DE TRABAJO</label
                                        ><input id="fWorkAddress" placeholder="Calle, número, colonia y ciudad" />
                                    </div>
                                    <div class="field">
                                        <label>FACTURACIÓN</label
                                        ><select id="fBillingMode" onchange="syncRequestRequirements()">
                                            <option value="Público general">Público general (sin factura a nombre del cliente)</option>
                                            <option value="Factura a nombre del cliente">Factura a nombre del cliente</option>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>RÉGIMEN FISCAL</label
                                        ><select id="fTaxRegime">
                                            <option value="">
                                                Sin seleccionar
                                            </option>
                                            <option>
                                                Régimen simplificado de
                                                confianza
                                            </option>
                                            <option>General de ley</option>
                                            <option>
                                                Persona física con actividad
                                                empresarial
                                            </option>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label>USO CFDI</label
                                        ><select id="fCfdiUse">
                                            <option value="">
                                                Sin seleccionar
                                            </option>
                                            <option>
                                                G03 · Gastos en general
                                            </option>
                                            <option>
                                                S01 · Sin efectos fiscales
                                            </option>
                                        </select>
                                    </div>
                                    <div class="field wide">
                                        <label>CORREO DE FACTURACIÓN</label
                                        ><input
                                            id="fBillingEmail"
                                            type="email"
                                            placeholder="facturacion@empresa.mx"
                                        />
                                    </div>
                                </div>
                                <div id="moralPersonFields" class="fields" style="margin-top:18px">
                                    <div class="field wide"><label>NOTARIO PÚBLICO</label><input id="fNotaryPublic" placeholder="Nombre del notario" /></div>
                                    <div class="field"><label>NÚMERO DE NOTARÍA</label><input id="fNotaryNumber" placeholder="Ej. 23" /></div>
                                    <div class="field"><label>ACTA</label><input id="fConstitutiveAct" placeholder="Número de acta" /></div>
                                    <div class="field"><label>VOLUMEN</label><input id="fConstitutiveVolume" placeholder="Volumen" /></div>
                                    <div class="field"><label>TOMO</label><input id="fConstitutiveBook" placeholder="Tomo" /></div>
                                    <div class="field"><label>FECHA DE CONSTITUCIÓN</label><input id="fConstitutiveDate" type="date" /></div>
                                </div>
                            </details>
                            <details class="form-group" open>
                                <summary>Servicios a contratar y expediente</summary>
                                <p class="form-helper">Indica cuántas cajas requiere por tamaño y marca los documentos recibidos para habilitar la autorización.</p>
                                <div class="fields">
                                    <div class="field"><label>CAJAS 3 × 5</label><input id="fService35" type="number" min="0" value="0" /></div>
                                    <div class="field"><label>CAJAS 5 × 5</label><input id="fService55" type="number" min="0" value="0" /></div>
                                    <div class="field"><label>CAJAS 3 × 10</label><input id="fService310" type="number" min="0" value="0" /></div>
                                    <div class="field"><label>CAJAS 5 × 10</label><input id="fService510" type="number" min="0" value="0" /></div>
                                    <div class="field"><label>CAJAS 10 × 10</label><input id="fService1010" type="number" min="0" value="0" /></div>
                                    <div class="field"><label>CAJAS 11 × 16</label><input id="fService1116" type="number" min="0" value="0" /></div>
                                    <div class="field"><label>CAJAS 22 × 16</label><input id="fService2216" type="number" min="0" value="0" /></div>
                                </div>
                                <div class="check-list" style="margin-top:18px">
                                    <label><input id="fDocIdentification" type="checkbox" onchange="syncRequestRequirements()" /> INE del titular recibida</label>
                                    <input id="fDocIdentificationFile" type="file" accept=".pdf,image/*" onchange="markDocumentReceived('identification', this)" />
                                    <label id="fConstituentDoc"><input id="fDocConstitutive" type="checkbox" onchange="syncRequestRequirements()" /> Acta constitutiva recibida</label>
                                    <input id="fDocConstitutiveFile" type="file" accept=".pdf,image/*" onchange="markDocumentReceived('constitutive', this)" />
                                    <label id="fFiscalDoc"><input id="fDocFiscal" type="checkbox" onchange="syncRequestRequirements()" /> Constancia de situación fiscal recibida</label>
                                    <input id="fDocFiscalFile" type="file" accept=".pdf,image/*" onchange="markDocumentReceived('fiscal', this)" />
                                </div>
                                <p class="notice" id="requestRequirements" style="margin-top:14px"></p>
                            </details>
                            <hr
                                style="
                                    border: 0;
                                    border-top: 1px solid var(--line);
                                    margin: 25px 0;
                                "
                            />
                            <h2>Persona autorizada</h2>
                            <p class="muted">
                                Se conserva la capacidad de registrar
                                autorizados del contrato.
                            </p>
                            <div class="fields">
                                <div class="field">
                                    <label>NOMBRE</label
                                    ><input
                                        id="fAuth"
                                        placeholder="Nombre completo"
                                    />
                                </div>
                                <div class="field">
                                    <label>TELÉFONO</label
                                    ><input
                                        id="fAuthPhone"
                                        placeholder="999 000 0000"
                                    />
                                </div>
                            </div>
                        </div>
                        <aside class="panel section">
                            <h2>Servicios solicitados</h2>
                            <div
                                id="selectedBox"
                                class="selected"
                                style="display: none"
                            ></div>
                            <div
                                id="noBox"
                                class="empty"
                                style="padding: 28px 10px"
                            >
                                ▣<br /><b>Aún no hay caja asignada</b
                                ><br /><small
                                    >Selecciona una caja de referencia o deja
                                    el servicio pendiente de asignación.</small
                                >
                            </div>
                            <button
                                class="btn outline"
                                style="width: 100%; margin-top: 14px"
                                onclick="showView('boxes')"
                            >
                                Consultar disponibilidad</button
                            ><button
                                class="btn primary"
                                style="width: 100%; margin-top: 10px"
                                onclick="saveRequestForReview()"
                            >
                                Guardar para verificación →
                            </button>
                            <div id="approvalPanel" style="margin-top:18px"></div>
                        </aside>
                    </div>
                </section>
                <section class="view" id="boxes">
                    <div class="heading">
                        <div>
                            <p class="eyebrow">OPERACIÓN</p>
                            <h1>Disponibilidad de cajas</h1>
                            <p class="muted">
                                Cajas físicas para resguardar pertenencias y
                                valores.
                            </p>
                        </div>
                        <span
                            id="selectionMode"
                            class="tag amber"
                            style="display: none"
                            >MODO SELECCIÓN ACTIVO</span
                        >
                    </div>
                    <section class="panel">
                        <div class="toolbar">
                            <select id="boxStatus" onchange="renderBoxes()">
                                <option>Todas</option>
                                <option>Disponible</option>
                                <option>Ocupada</option>
                                <option>Reservada</option>
                                <option>Mantenimiento</option></select
                            ><select id="boxSize" onchange="renderBoxes()">
                                <option>Todas</option>
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option></select
                            >
                        </div>
                        <div class="box-grid" id="boxGrid"></div>
                    </section>
                    <p class="notice" style="margin-top: 15px">
                        La asignación, disponibilidad e importes son simulados
                        para la demo. La caja literal cuenta con cerradura y dos
                        llaves.
                    </p>
                </section>
                <section class="view" id="contract">
                    <button class="btn outline" onclick="showView('contracts')">← Contratos</button>
                    <div class="heading" style="margin-top:20px"><div><p class="eyebrow">ARRENDAMIENTO</p><h1>Nuevo contrato</h1><p class="muted">Selecciona un arrendatario y revisa las condiciones antes de guardar.</p></div><span class="tag blue">DATOS DE DEMOSTRACIÓN</span></div>
                    <section class="panel section contract-selector">
                        <div><h2>¿Para quién es el contrato?</h2><p class="muted">Busca en el catálogo de arrendatarios.</p></div>
                        <div class="field"><label for="cTenant">ARRENDATARIO</label><select id="cTenant" onchange="selectContractTenant(this.value)"><option value="">Selecciona un arrendatario</option></select></div>
                    </section>
                    <div id="contractEmpty" class="panel section contract-empty">Selecciona un arrendatario para consultar su expediente y preparar el contrato.</div>
                    <div id="contractWorkspace" style="display:none">
                        <div class="contract-tabs" role="tablist" aria-label="Información del contrato">
                            <button type="button" class="on" role="tab" aria-selected="true" data-contract-tab="conditions" onclick="contractTab('conditions')">Contrato</button>
                            <button type="button" role="tab" aria-selected="false" data-contract-tab="profile" onclick="contractTab('profile')">Expediente</button>
                            <button type="button" role="tab" aria-selected="false" data-contract-tab="people" onclick="contractTab('people')">Autorizados y apoyo</button>
                            <button type="button" role="tab" aria-selected="false" data-contract-tab="documents" onclick="contractTab('documents')">Llaves y documentos</button>
                            <button type="button" role="tab" aria-selected="false" data-contract-tab="history" onclick="contractTab('history')">Historial</button>
                        </div>
                        <div data-contract-panel="conditions" class="split contract-layout">
                            <section class="panel section"><h2>Condiciones del contrato</h2><p class="muted" id="contractRequestLabel"></p>
                                <div class="fields">
                                    <div class="field"><label for="cBox">CAJA DISPONIBLE</label><select id="cBox" onchange="updateContractBox()"></select></div>
                                    <div class="field"><label for="cDuration">DURACIÓN</label><select id="cDuration" onchange="updateContractDates()"><option>12 meses</option><option>6 meses</option><option>18 meses</option></select></div>
                                    <div class="field"><label for="cStart">INICIO DE VIGENCIA</label><input id="cStart" type="date" onchange="updateContractDates()" /></div>
                                    <div class="field"><label for="cEnd">FECHA DE VENCIMIENTO</label><input id="cEnd" type="date" /></div>
                                    <div class="field"><label for="cPaymentDate">FECHA DE PAGO</label><input id="cPaymentDate" type="date" /></div>
                                    <div class="field"><label for="cPrintDate">FECHA DE IMPRESIÓN</label><input id="cPrintDate" type="date" /></div>
                                    <div class="field"><label for="cPaymentMethod">FORMA DE PAGO</label><select id="cPaymentMethod"><option>Transferencia</option><option>Efectivo</option><option>Tarjeta</option></select></div>
                                </div>
                            </section>
                            <aside class="panel section"><p class="eyebrow">SIMULACIÓN</p><h2>Resumen financiero</h2><p class="muted">Ajusta los importes para esta operación.</p>
                                <div class="field" style="margin-top:16px"><label for="rent">IMPORTE DE RENTA</label><input id="rent" type="number" min="0" step="0.01" oninput="calc()" /></div>
                                <div class="field" style="margin-top:13px"><label for="deposit">IMPORTE DE GARANTÍA</label><input id="deposit" type="number" min="0" step="0.01" oninput="calc()" /></div>
                                <div style="margin-top:16px"><div class="summary-row"><span>Renta</span><span id="sumRent"></span></div><div class="summary-row"><span>Garantía</span><span id="sumDeposit"></span></div><div class="summary-row"><span>IVA estimado (16%)</span><span id="sumIva"></span></div><div class="summary-total"><span>Total inicial</span><span id="sumTotal" style="float:right"></span></div></div>
                                <div class="notice" style="margin-top:16px"><label style="display:block;margin-bottom:8px"><input id="cKeysConfirmed" type="checkbox" /> Registrar entrega simulada de llaves</label><label><input id="cReviewConfirmed" type="checkbox" /> Confirmo los datos del contrato</label></div>
                                <button class="btn primary" style="width:100%;margin-top:20px" onclick="requestContractConfirmation()">Revisar y guardar contrato →</button><p class="muted" style="font-size:11px">La factura y los documentos son simulados.</p>
                            </aside>
                        </div>
                        <section class="panel section contract-panel" data-contract-panel="profile" hidden><h2>Expediente del arrendatario</h2><p class="muted">Datos registrados en su solicitud y catálogo.</p><div id="contractProfile" class="contract-info"></div></section>
                        <section class="panel section contract-panel" data-contract-panel="people" hidden><h2>Personas autorizadas</h2><p class="muted">Personas registradas en el expediente del arrendatario.</p><div id="contractAuthorizations"></div><hr class="contract-divider" /><h2>Personal de apoyo</h2><p class="muted">Personas autorizadas para acompañar al arrendatario cuando necesite asistencia.</p><div id="contractSupport"></div><div class="fields" style="margin-top:16px"><div class="field"><label for="supportName">NOMBRE DE LA PERSONA</label><input id="supportName" maxlength="90" /></div><div class="field"><label for="supportPhone">TELÉFONO</label><input id="supportPhone" maxlength="30" /></div></div><button class="btn outline" style="margin-top:14px" type="button" onclick="addContractSupport()">＋ Autorizar personal de apoyo</button></section>
                        <section class="panel section contract-panel" data-contract-panel="documents" hidden><h2>Llaves y documentos</h2><p class="muted">Estado del expediente relacionado con la solicitud.</p><div id="contractDocuments"></div><p class="notice" style="margin-top:16px">La entrega de llaves se confirma al guardar el contrato. Los documentos de la demo son simulados.</p></section>
                        <section class="panel section contract-panel" data-contract-panel="history" hidden><h2>Historial del arrendatario</h2><p class="muted">Contratos y movimientos registrados en esta demo.</p><div id="contractHistory"></div></section>
                    </div>
                </section>
                <section class="view" id="tenant">
                    <div class="tenant-top">
                        <div class="tenant-name">
                            <i class="avatar" id="tenantInitials">AM</i>
                            <div>
                                <h1 id="tenantName">Mariana López Canto</h1>
                                <p
                                    id="tenantContract"
                                    style="color: #bdc8d3; margin: 5px 0"
                                >
                                    Arrendatario · CT-2026-0148
                                </p>
                            </div>
                        </div>
                        <div class="tabs" id="tenantTabs">
                            <button
                                class="on"
                                onclick="tenantTab('Resumen', this)"
                            >
                                Resumen</button
                            ><button onclick="tenantTab('Generales', this)">
                                Generales</button
                            ><button onclick="tenantTab('Domicilio', this)">
                                Domicilio</button
                            ><button
                                onclick="tenantTab('Laboral y fiscal', this)"
                            >
                                Laboral y fiscal</button
                            ><button onclick="tenantTab('Autorizados', this)">
                                Autorizados</button
                            ><button onclick="tenantTab('Cajas', this)">
                                Cajas</button
                            ><button onclick="tenantTab('Contratos', this)">
                                Contratos</button
                            ><button onclick="tenantTab('Facturas', this)">
                                Facturas</button
                            ><button onclick="tenantTab('Documentos', this)">
                                Documentos</button
                            ><button onclick="tenantTab('Accesos', this)">
                                Accesos
                            </button>
                        </div>
                    </div>
                    <div class="two" style="margin-top: 22px">
                        <div class="panel section">
                            <h2 id="tenantSectionTitle">
                                Información de contacto
                            </h2>
                            <div id="tenantMain" class="fields"></div>
                        </div>
                        <div class="panel section">
                            <h2>Caja asignada</h2>
                            <div id="tenantBox"></div>
                            <hr
                                style="
                                    border: 0;
                                    border-top: 1px solid var(--line);
                                    margin: 20px 0;
                                "
                            />
                            <h2>Factura inicial</h2>
                            <p class="muted" style="margin-top: 10px">
                                Representación de ejemplo; timbrado fiscal no
                                conectado.
                            </p>
                            <span class="tag amber" style="margin-top: 10px"
                                >SIMULADA</span
                            >
                        </div>
                    </div>
                </section>
                <section class="view" id="contracts">
                    <div class="heading">
                        <div>
                            <p class="eyebrow">OPERACIÓN</p>
                            <h1>Contratos</h1>
                            <p class="muted">
                                Consulta el ciclo de vida contractual y
                                documentos asociados.
                            </p>
                        </div>
                        <button class="btn primary" onclick="startNewContract()">
                            ＋ Nuevo contrato
                        </button>
                    </div>
                    <section class="panel">
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Arrendatario</th>
                                        <th>Caja</th>
                                        <th>Vigencia</th>
                                        <th>Facturación</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="contractRows"></tbody>
                            </table>
                        </div>
                    </section>
                </section>
                <section class="view" id="renewals">
                    <div class="heading">
                        <div>
                            <p class="eyebrow">GESTIÓN · DEMO</p>
                            <h1>Cambios y renovaciones de contrato</h1>
                            <p class="muted">
                                Primero registra modificaciones; después
                                renueva o renueva con cambio de caja.
                            </p>
                        </div>
                        <span class="tag amber">SIMULACIÓN</span>
                    </div>
                    <div class="split">
                        <section class="panel section">
                            <h2>Selecciona la operación</h2>
                            <p class="muted">
                                Compara el contrato actual con las nuevas
                                condiciones antes de confirmar.
                            </p>
                            <div class="fields">
                                <div class="field wide">
                                    <label>CONTRATO / ARRENDATARIO</label
                                    ><select
                                        id="rContract"
                                        onchange="renderRenewal()"
                                    >
                                        <option value="active">
                                            Contrato activo de demostración
                                        </option>
                                        <option>
                                            CT-2026-0148 · Mariana López Canto ·
                                            A-101
                                        </option>
                                        <option>
                                            CT-2026-0141 · Blanca González Gómez
                                            · B-202
                                        </option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>OPERACIÓN</label
                                    ><select
                                        id="rMode"
                                        onchange="renderRenewal()"
                                    >
                                        <option value="renew">
                                            Renovar misma caja
                                        </option>
                                        <option value="move">
                                            Renovar con cambio de caja
                                        </option>
                                        <option value="renew-size">
                                            Renovar con cambio de medida
                                        </option>
                                        <option value="location">
                                            Cambio de ubicación
                                        </option>
                                        <option value="size">
                                            Cambio de medida y recálculo
                                        </option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>NUEVA VIGENCIA</label
                                    ><select
                                        id="rDuration"
                                        onchange="renderRenewal()"
                                    >
                                        <option value="12">12 meses</option>
                                        <option value="6">6 meses</option>
                                        <option value="18">18 meses</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>INICIO DE VIGENCIA</label
                                    ><input
                                        id="rStart"
                                        type="date"
                                        value="2026-11-01"
                                        onchange="renderRenewal()"
                                    />
                                </div>
                                <div class="field">
                                    <label>NUEVA CAJA</label
                                    ><select
                                        id="rBox"
                                        onchange="renderRenewal()"
                                    >
                                        <option value="">
                                            Conservar caja actual
                                        </option>
                                        <option value="A-102">
                                            A-102 · S · Disponible
                                        </option>
                                        <option value="B-201">
                                            B-201 · M · Disponible
                                        </option>
                                        <option value="B-203">
                                            B-203 · L · Disponible
                                        </option>
                                        <option value="C-302">
                                            C-302 · XL · Disponible
                                        </option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>NUEVA RENTA MENSUAL</label
                                    ><input
                                        id="rRent"
                                        type="number"
                                        value="1290"
                                        oninput="renderRenewal()"
                                    />
                                </div>
                                <div class="field">
                                    <label>LLAVES A DEVOLVER</label
                                    ><select id="rKeys">
                                        <option>2 de 2 llaves</option>
                                        <option>1 de 2 llaves</option>
                                        <option>0 de 2 llaves</option>
                                    </select>
                                </div>
                            </div>
                            <div class="notice" style="margin-top: 18px">
                                <label
                                    ><input id="rReviewed" type="checkbox" />
                                    Revisé la caja, importes, llaves y
                                    documentos a generar.</label
                                >
                            </div>
                        </section>
                        <aside class="panel section">
                            <h2>Comparativo de operación</h2>
                            <div id="renewalSummary" class="selected"></div>
                            <p class="notice" style="margin-top: 14px">
                                Se simulará la generación de contrato,
                                recibo/devolución de llaves, factura y
                                expediente. El prorrateo, diferencias y reglas
                                de cambio aún están por validar.
                            </p>
                            <button
                                class="btn primary"
                                style="width: 100%; margin-top: 16px"
                                onclick="requestRenewalConfirmation()"
                            >
                                Revisar y confirmar
                            </button>
                        </aside>
                    </div>
                </section>
                <section class="view" id="access">
                    <div class="heading">
                        <div>
                            <p class="eyebrow" id="accessEyebrow">BÓVEDA · CONTROL OPERATIVO</p>
                            <h1 id="accessHeading">Accesos a la bóveda</h1>
                            <p class="muted" id="accessDescription">
                                El encargado valida la entrada de una persona;
                                la salida se actualiza con su firma simulada.
                            </p>
                        </div>
                        <span class="tag blue">SIMULACIÓN BIOMÉTRICA</span>
                    </div>
                    <div class="two" id="vaultOperations">
                        <section class="panel">
                            <div class="panel-head">
                                <div>
                                    <b>Actualizar entrada</b>
                                    <p class="muted">
                                        El encargado de bóveda confirma a otra
                                        persona tras revisar su contrato.
                                    </p>
                                </div>
                                <button class="btn outline" onclick="renderAccessQueue()">↻ Actualizar</button>
                            </div>
                            <div class="toolbar">
                                <div class="search">
                                    <input
                                        id="accessSearch"
                                        oninput="renderAccessQueue()"
                                        placeholder="Buscar persona o caja"
                                    />
                                </div>
                                <select
                                    id="accessFilter"
                                    onchange="renderAccessQueue()"
                                >
                                    <option value="Todas">
                                        Todas las personas
                                    </option>
                                    <option value="Titular">Titulares</option>
                                    <option value="Autorizado">
                                        Autorizados
                                    </option>
                                </select>
                            </div>
                            <div id="accessQueue"></div>
                        </section>
                        <section class="panel section">
                            <h2>Marcar salida</h2>
                            <p class="muted">Personas dentro de la bóveda pendientes de firma de salida.</p>
                            <div id="accessExitQueue"></div>
                        </section>
                    </div>
                    <section class="panel section" id="c4ControlPanel" style="display:none; margin-top:20px">
                        <div class="panel-head">
                            <div>
                                <p class="eyebrow">C4 · MONITOREO DE PUERTA</p>
                                <h2>Control de puerta</h2>
                                <p class="muted">C4 monitorea las cámaras y controla a distancia la puerta de la bóveda. Los clientes no ingresan a C4; Bóveda conserva la validación documental y las firmas.</p>
                            </div>
                            <span class="tag blue">OPERACIÓN C4</span>
                        </div>
                        <div class="c4-workspace">
                            <section class="panel" style="box-shadow:none">
                                <div class="panel-head">
                                    <div><b>Registros autorizados (<span id="c4RecordCount">0</span>)</b><p class="muted">Cola enviada por el encargado de bóveda.</p><small class="muted" id="c4RefreshStatus">Vista inicial</small></div>
                                    <button class="btn outline" id="c4RefreshButton" type="button" onclick="refreshC4Monitor()">↻ Actualizar vista</button>
                                </div>
                                <div id="c4RecordList"></div>
                            </section>
                            <section class="panel section c4-photo-panel" style="box-shadow:none">
                                <p class="eyebrow">VALIDACIÓN VISUAL</p>
                                <div id="c4VisualValidation" class="notice">Selecciona un registro para mostrar su fotografía de referencia.</div>
                            </section>
                            <section class="panel section" style="box-shadow:none">
                                <p class="eyebrow">REGISTRO SELECCIONADO</p>
                                <div id="c4SelectedRecord" class="notice">Selecciona una persona de la cola para operar la puerta.</div>
                                <div class="small-grid" style="margin-top:14px">
                                    <div class="notice"><b>Estado de puerta</b><br /><span id="c4DoorState" class="c4-door-state is-closed">CERRADA</span></div>
                                    <div class="notice"><b>Última acción</b><br /><span id="c4DoorUpdated">Sin movimientos en esta sesión</span></div>
                                </div>
                                <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:18px">
                                    <button class="btn primary" id="c4GrantButton" type="button" onclick="grantC4Access()">↗ Abrir puerta</button>
                                    <button class="btn gold" id="c4ConfirmButton" type="button" onclick="recordC4RemoteAccess()">✓ Registrar acceso remoto</button>
                                    <button class="btn outline" id="c4CloseButton" type="button" onclick="closeC4Door()">⇥ Cerrar puerta</button>
                                </div>
                                <div style="display:flex; gap:10px; flex-wrap:wrap; margin-top:10px">
                                    <button class="btn outline" id="c4RemoveButton" type="button" onclick="removeC4Record()">Archivar registro</button>
                                    <button class="btn outline" type="button" onclick="clearC4Selection()">Cerrar</button>
                                </div>
                                <p class="notice" id="c4ControlFeedback" style="margin-top:16px">La puerta permanece cerrada hasta que C4 autorice su apertura remota para un registro seleccionado.</p>
                            </section>
                        </div>
                    </section>
                    <section class="panel section" id="vaultVerification" style="margin-top:20px">
                        <h2>Validación del encargado</h2>
                        <div id="accessVerification" class="notice">Selecciona una persona de entrada o salida para continuar.</div>
                        <p class="notice" style="margin-top:14px"><b>Biometría:</b> la identificación mostrada es una referencia visual de la integración. La demo no procesa imágenes ni biométricos.</p>
                    </section>
                    <section class="panel" id="vaultAudit" style="margin-top: 20px">
                        <div class="panel-head">
                            <div>
                                <b>Bitácora operativa</b>
                                <p class="muted">
                                    Eventos locales de la demostración; en
                                    producción deberán ser inmutables y
                                    asociados a un usuario.
                                </p>
                            </div>
                            <span class="tag blue">AUDITORÍA DEMO</span>
                        </div>
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Fecha / hora</th>
                                        <th>Usuario</th>
                                        <th>Acción</th>
                                        <th>Entidad</th>
                                        <th>Resultado</th>
                                    </tr>
                                </thead>
                                <tbody id="auditRows"></tbody>
                            </table>
                        </div>
                    </section>
                </section>
                <section class="view" id="documents">
                    <div class="heading">
                        <div><p class="eyebrow">EXPEDIENTES · DEMO</p><h1>Documentos</h1><p class="muted">Consulta los documentos asociados a cada contrato y revisa su contenido de ejemplo.</p></div>
                        <span class="tag blue">DOCUMENTOS SIMULADOS</span>
                    </div>
                    <section class="panel document-selection" aria-label="Listado de documentos">
                        <div class="document-list-head"><div><h2>Documentos registrados</h2><p class="muted" id="documentCount" aria-live="polite"></p></div></div>
                        <div class="document-filters">
                            <div class="field document-search"><label for="documentSearch">BUSCAR DOCUMENTO</label><input id="documentSearch" type="search" placeholder="Nombre, folio, arrendatario, contrato o caja" oninput="renderDocuments()" /></div>
                            <div class="field"><label for="documentTypeFilter">TIPO DE DOCUMENTO</label><select id="documentTypeFilter" onchange="renderDocuments()"><option value="">Todos los tipos</option></select></div>
                        </div>
                        <div class="table-wrap"><table><thead><tr><th>Documento</th><th>Tipo</th><th>Arrendatario</th><th>Contrato / caja</th><th>Fecha</th><th></th></tr></thead><tbody id="documentRows"></tbody></table></div>
                    </section>
                    <section class="panel section document-preview-panel" style="margin-top:20px">
                        <div class="panel-head" style="margin:-20px -20px 18px"><div><b id="documentPreviewTitle">Vista previa documental</b><p class="muted">Selecciona un documento del listado para revisar su información.</p></div><div class="document-preview-actions" style="display:flex;gap:10px;align-items:center"><span class="tag amber">SIMULACIÓN</span><button id="printDocumentButton" class="btn outline" type="button" onclick="printDocument()" disabled>Imprimir</button></div></div>
                        <div id="documentPreview" class="notice">Selecciona «Vista previa» en un documento para consultar el formato simulado.</div>
                    </section>
                </section>
                <section class="view" id="reports">
                    <div class="heading">
                        <div>
                            <p class="eyebrow">ADMINISTRACIÓN · INTELIGENCIA OPERATIVA</p>
                            <h1>Reportes</h1>
                            <p class="muted">Elige un reporte, revisa los datos y descarga tu archivo.</p>
                        </div>
                        <div class="report-actions">

                            <button class="btn primary" type="button" onclick="exportReport()">⇩ Descargar CSV</button>
                        </div>
                    </div>
                    <section class="report-hero" aria-labelledby="reportDecisionTitle">
                        <div>
                            <p class="report-hero__eyebrow">CORTE OPERATIVO</p>
                            <h1 id="reportDecisionTitle">Lo que necesita atención hoy</h1>
                            <p id="reportDecisionDescription">Usa el periodo y el contexto para priorizar seguridad de visitas, renovaciones y disponibilidad comercial.</p>
                        </div>
                        <div class="report-hero__meta">
                            <span>CONTEXTO ACTIVO</span>
                            <b id="reportContextLabel">Toda la operación</b>
                        </div>
                    </section>
                    <section id="reportFilter" class="panel report-filter" aria-label="Filtros del centro de decisiones">
                        <div class="report-filter__top">
                            <div>
                                <h2>Filtros del reporte</h2>
                                <p>Selecciona el periodo y, si lo necesitas, un arrendatario o contrato.</p>
                            </div>
                            <div class="report-presets" aria-label="Periodos rápidos">
                                <button class="report-preset" type="button" data-report-preset="month" onclick="setReportPreset('month')">Este mes</button>
                                <button class="report-preset" type="button" data-report-preset="30days" onclick="setReportPreset('30days')">Últimos 30 días</button>
                                <button class="report-preset" type="button" data-report-preset="year" onclick="setReportPreset('year')">Este año</button>
                            </div>
                        </div>
                        <div class="report-filter__fields">
                            <div class="field field--wide">
                                <label for="reportType">REPORTE</label>
                                <select id="reportType" onchange="renderReport()">
                                    <option value="general">Resumen ejecutivo</option>
                                    <option value="availability">Disponibilidad de cajas</option>
                                    <option value="access">Bitácora de accesos</option>
                                    <option value="finance">Ingresos y garantías</option>
                                    <option value="new-contracts">Contratos nuevos</option>
                                    <option value="annual">Resumen anual de operaciones</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="reportFrom">DESDE</label>
                                <input id="reportFrom" type="date" value="2026-10-01" onchange="renderReport()" />
                            </div>
                            <div class="field">
                                <label for="reportTo">HASTA</label>
                                <input id="reportTo" type="date" value="2026-10-31" onchange="renderReport()" />
                            </div>
                            <div class="field">
                                <label for="reportTenant">ARRENDATARIO</label>
                                <select id="reportTenant" onchange="refreshReportContracts(); renderReport()"></select>
                            </div>
                            <div class="field">
                                <label for="reportContract">CONTRATO</label>
                                <select id="reportContract" onchange="syncReportContextFromContract(); renderReport()"></select>
                            </div>
                            <button class="btn outline" type="button" onclick="clearReportContext()">Limpiar contexto</button>
                        </div>
                    </section>
                    <section class="panel report-preview">
                        <div class="toolbar">
                            <div>
                                <h2 id="reportPreviewTitle">Vista previa: resumen ejecutivo</h2>
                                <span class="muted">Revisa antes de descargar o compartir.</span>
                            </div>
                            <span class="report-preview__context" id="reportPreviewContext">Toda la operación</span>
                        </div>
                        <div class="sheet-bar"><span>▦</span> Vista previa de datos <small>Los filtros también se aplican al archivo CSV</small></div>
                        <div class="table-wrap sheet-grid">
                            <table>
                                <thead id="reportPreviewHead"></thead>
                                <tbody id="reportPreviewRows"></tbody>
                            </table>
                        </div>
                        <div class="sheet-footer"><span>Hoja 1</span><small id="reportRowCount"></small></div>
                    </section>
                    <div class="grid4" aria-live="polite">
                        <article class="card report-kpi report-kpi--income">
                            <span class="report-kpi__label">INGRESO REGISTRADO</span>
                            <div class="metric" id="reportIncome">—</div>
                            <span class="report-kpi__detail" id="reportIncomeDetail">En el periodo seleccionado</span>
                            <span class="report-kpi__trend" id="reportIncomeTrend">Movimiento operativo</span>
                        </article>
                        <article class="card report-kpi report-kpi--occupancy">
                            <span class="report-kpi__label">OCUPACIÓN ACTUAL</span>
                            <div class="metric" id="reportOccupied">—</div>
                            <span class="report-kpi__detail" id="reportOccupiedDetail">Inventario completo</span>
                            <span class="report-kpi__trend" id="reportOccupiedTrend">Capacidad disponible</span>
                        </article>
                        <article class="card report-kpi report-kpi--flow">
                            <span class="report-kpi__label">FLUJO COMERCIAL</span>
                            <div class="metric" id="reportRequests">—</div>
                            <span class="report-kpi__detail" id="reportRequestsDetail">Solicitudes del periodo</span>
                            <span class="report-kpi__trend" id="reportRequestsTrend">Por resolver</span>
                        </article>
                        <article class="card report-kpi report-kpi--risk">
                            <span class="report-kpi__label">RIESGO DE SEGURIDAD</span>
                            <div class="metric" id="reportOpenVisits">—</div>
                            <span class="report-kpi__detail" id="reportOpenVisitsDetail">Entradas sin salida registrada</span>
                            <span class="report-kpi__trend" id="reportOpenVisitsTrend">Requiere seguimiento</span>
                        </article>
                    </div>
                    <div class="report-insights">
                        <section class="panel">
                            <div class="report-panel__head">
                                <div>
                                    <h2>Prioridades de operación</h2>
                                    <p>Excepciones que conviene resolver antes de cerrar el corte.</p>
                                </div>
                                <span class="tag amber" id="reportAlertCount">REVISANDO</span>
                            </div>
                            <div class="report-alerts" id="reportAlerts"></div>
                        </section>
                        <section class="panel">
                            <div class="report-panel__head">
                                <div>
                                    <h2>Capacidad comercial</h2>
                                    <p>Inventario físico al momento de la consulta.</p>
                                </div>
                            </div>
                            <div class="report-capacity" id="reportCapacity"></div>
                        </section>
                    </div>
                    <section class="panel section report-library" style="margin-top: 20px" aria-labelledby="reportLibraryTitle">
                        <h2 id="reportLibraryTitle">Reportes listos</h2>
                        <p class="report-library__intro">Elige uno para abrir su simulación con el periodo y contexto activos.</p>
                        <div class="small-grid" style="margin-top: 18px">
                            <button class="report-shortcut" type="button" data-report-shortcut="general" aria-pressed="true" onclick="selectReportShortcut('general')">
                                <b>Resumen ejecutivo</b>
                                <span>Capacidad, flujo, seguridad y contratos que requieren seguimiento.</span>
                                <small>Abrir simulación ↗</small>
                            </button>
                            <button class="report-shortcut" type="button" data-report-shortcut="availability" aria-pressed="false" onclick="selectReportShortcut('availability')">
                                <b>Disponibilidad de cajas</b>
                                <span>Estado de inventario para detectar capacidad comercial y mantenimiento.</span>
                                <small>Abrir simulación ↗</small>
                            </button>
                            <button class="report-shortcut" type="button" data-report-shortcut="new-contracts" aria-pressed="false" onclick="selectReportShortcut('new-contracts')">
                                <b>Contratos nuevos</b>
                                <span>Fecha, cliente, caja, renta, garantía y estatus de cada alta.</span>
                                <small>Abrir simulación ↗</small>
                            </button>
                            <button class="report-shortcut" type="button" data-report-shortcut="annual" aria-pressed="false" onclick="selectReportShortcut('annual')">
                                <b>Resumen anual</b>
                                <span>Altas, cancelaciones, renovaciones y modificaciones por año.</span>
                                <small>Abrir simulación ↗</small>
                            </button>
                            <button class="report-shortcut" type="button" data-report-shortcut="access" aria-pressed="false" onclick="selectReportShortcut('access')">
                                <b>Bitácora de accesos</b>
                                <span>Entradas, salidas y firmas por persona, contrato y rango de fechas.</span>
                                <small>Abrir simulación ↗</small>
                            </button>
                            <button class="report-shortcut" type="button" data-report-shortcut="finance" aria-pressed="false" onclick="selectReportShortcut('finance')">
                                <b>Ingresos y garantías</b>
                                <span>Movimientos registrados; no sustituye conciliación ni CFDI real.</span>
                                <small>Abrir simulación ↗</small>
                            </button>
                        </div>
                    </section>
                </section>
                <section class="view" id="settings">
                    <div class="heading">
                        <div>
                            <p class="eyebrow">CONFIGURACIÓN · DEMO</p>
                            <h1>Catálogos y alertas</h1>
                            <p class="muted">
                                Se conservan capacidades vistas; parámetros y
                                reglas reales permanecen por definir.
                            </p>
                        </div>
                    </div>
                    <div class="two">
                        <section class="panel section">
                            <h2>Alertas de operación</h2>
                            <div class="fields">
                                <div class="field">
                                    <label>ALERTA POR DISPONIBILIDAD</label
                                    ><select id="availabilityAlert">
                                        <option>Activa</option>
                                        <option>Inactiva</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>LÍMITE PORCENTUAL</label
                                    ><input id="availabilityLimit" value="25%" />
                                </div>
                                <div class="field wide">
                                    <label>MENSAJE</label
                                    ><input
                                        id="availabilityMessage"
                                        value="Disponibilidad de cajas por debajo del límite"
                                    />
                                </div>
                                <div class="field">
                                    <label>RECORDATORIO DE CUMPLEAÑOS</label
                                    ><select id="birthdayAlert"><option>Activo</option><option>Inactivo</option></select>
                                </div>
                                <div class="field">
                                    <label>ANTICIPACIÓN DE CUMPLEAÑOS</label
                                    ><select id="birthdayLeadDays"><option value="0">El mismo día</option><option value="1">1 día antes</option><option value="3">3 días antes</option><option value="7">7 días antes</option></select>
                                </div>
                            </div>
                            <button
                                class="btn primary"
                                style="margin-top: 18px"
                                onclick="saveSettings()"
                            >
                                Guardar simulación
                            </button>
                            <div
                                id="settingsFeedback"
                                class="notice"
                                style="margin-top: 18px"
                            ></div>
                        </section>
                        <section class="panel section">
                            <h2>Conexión biométrica</h2>
                            <p class="muted">Configuración preparada para un proveedor externo; esta demo no intenta conectarse ni envía biométricos.</p>
                            <div class="fields">
                                <div class="field"><label>PROVEEDOR</label><select id="biometricProvider"><option>BioStar 2</option><option>Otro proveedor</option></select></div>
                                <div class="field"><label>ESTADO</label><select id="biometricEnabled"><option>Configuración pendiente</option><option>Simulación conectada</option><option>Desactivado</option></select></div>
                                <div class="field wide"><label>REFERENCIA DEL SERVIDOR</label><input id="biometricEndpoint" placeholder="Ej. servidor interno / dispositivo de acceso" /></div>
                            </div>
                            <button class="btn outline" style="margin-top:18px" onclick="testBiometricConfiguration()">Probar configuración simulada</button>
                            <div id="biometricFeedback" class="notice" style="margin-top:14px"></div>
                        </section>
                    </div>
                </section>
                <section class="view" id="tenants">
                    <div class="heading">
                        <div>
                            <p class="eyebrow">OPERACIÓN</p>
                            <h1>Arrendatarios</h1>
                            <p class="muted">
                                Perfil unificado con contratos, cajas,
                                autorizados, documentos, facturas y accesos.
                            </p>
                        </div>
                        <button class="btn primary" onclick="startRequest()">
                            ＋ Alta de arrendatario
                        </button>
                    </div>
                    <section class="panel">
                        <div class="toolbar">
                            <div class="search">
                                <input
                                    id="tenantSearch"
                                    oninput="renderTenants()"
                                    placeholder="Buscar por nombre, RFC, caja o contrato"
                                />
                            </div>
                            <button class="btn outline">Filtros</button>
                        </div>
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Arrendatario</th>
                                        <th>Caja</th>
                                        <th>Contrato</th>
                                        <th>Vencimiento</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tenantRows"></tbody>
                            </table>
                        </div>
                    </section>
                </section>
                <section class="view" id="cancellations">
                    <div class="heading">
                        <div>
                            <p class="eyebrow">GESTIÓN · SIMULACIÓN</p>
                            <h1>Cancelaciones</h1>
                            <p class="muted">
                                Flujo observado para devolución de llaves,
                                garantía y documentos de cancelación.
                            </p>
                        </div>
                        <span class="tag amber">REGLAS POR VALIDAR</span>
                    </div>
                    <div class="split">
                        <section class="panel section">
                            <h2>Cancelar contrato</h2>
                            <div class="fields">
                                <div class="field wide">
                                    <label>CONTRATO / ARRENDATARIO</label
                                    ><select
                                        id="xContract"
                                        onchange="renderCancellation()"
                                    >
                                        <option>
                                            CT-2026-0148 · Mariana López Canto
                                        </option>
                                        <option>
                                            CT-2026-0141 · Blanca González Gómez
                                        </option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>FECHA DE CANCELACIÓN</label
                                    ><input
                                        id="xDate"
                                        type="date"
                                        value="2026-10-31"
                                        onchange="renderCancellation()"
                                    />
                                </div>
                                <div class="field">
                                    <label>LLAVES DEVUELTAS</label
                                    ><select
                                        id="xKeys"
                                        onchange="renderCancellation()"
                                    >
                                        <option>2 de 2 llaves</option>
                                        <option>1 de 2 llaves</option>
                                        <option>0 de 2 llaves</option>
                                    </select>
                                </div>
                                <div class="field wide">
                                    <label>MOTIVO</label
                                    ><select id="xReason">
                                        <option>
                                            No se concreta la firma del contrato
                                        </option>
                                        <option>
                                            Solicitud del arrendatario
                                        </option>
                                        <option>Fin de vigencia</option>
                                        <option>Otro motivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field" style="margin-top: 15px">
                                <label>OBSERVACIONES</label
                                ><input
                                    id="xNotes"
                                    placeholder="Daños, inspección u otra observación"
                                />
                            </div>
                            <div class="notice" style="margin-top: 15px">
                                <label
                                    ><input id="xReviewed" type="checkbox" />
                                    Confirmé revisión de llaves, garantía y
                                    documentos.</label
                                >
                            </div>
                            <button
                                class="btn primary"
                                style="margin-top: 20px"
                                onclick="requestCancellationConfirmation()"
                            >
                                Preparar cancelación
                            </button>
                        </section>
                        <aside class="panel section">
                            <h2>Garantía y formatos</h2>
                            <div id="cancellationSummary"></div>
                            <p class="notice" style="margin-top: 15px">
                                Formatos observados: devolución de depósito,
                                recepción de llaves, expediente y aviso de
                                cancelación. Los criterios exactos de devolución
                                siguen sin verificarse.
                            </p>
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:14px">
                                <button class="btn outline" onclick="previewDocument('Recibo de depósito en garantía')">Ver devolución</button>
                                <button class="btn outline" onclick="previewDocument('Constancia de entrega de llaves')">Ver recepción de llaves</button>
                                <button class="btn outline" onclick="previewDocument('Expediente de arrendatario')">Ver expediente</button>
                                <button class="btn outline" onclick="previewDocument('Aviso de cancelación')">Ver aviso</button>
                            </div>
                        </aside>
                    </div>
                </section>
                <section class="view" id="finance">
                    <div class="heading">
                        <div>
                            <p class="eyebrow">FINANZAS · SIMULACIÓN</p>
                            <h1>Facturación, garantías y otros ingresos</h1>
                            <p class="muted">
                                Interfaz de consulta basada en las pantallas de
                                factura y catálogo de otros ingresos.
                            </p>
                        </div>
                        <button
                            class="btn primary"
                            onclick="openInvoiceModal()"
                        >
                            ＋ Nueva factura
                        </button>
                    </div>
                    <div class="grid4">
                        <article class="card">
                            <span class="muted">FACTURADO EN OCTUBRE</span>
                            <div class="metric">$327,900</div>
                            <span class="tag green">SIMULADO</span>
                        </article>
                        <article class="card">
                            <span class="muted">DEPÓSITOS EN GARANTÍA</span>
                            <div class="metric">$189,420</div>
                            <span class="muted">Saldo de ejemplo</span>
                        </article>
                        <article class="card">
                            <span class="muted">PENDIENTE DE COBRO</span>
                            <div class="metric">$18,490</div>
                            <span class="tag amber">SIMULADO</span>
                        </article>
                        <article class="card">
                            <span class="muted">OTROS INGRESOS</span>
                            <div class="metric">$12,800</div>
                            <span class="muted">Catálogo de ejemplo</span>
                        </article>
                    </div>
                    <section class="panel">
                        <div class="panel-head">
                            <div>
                                <b>Movimientos recientes</b>
                                <p class="muted">
                                    Representación de factura(s) del contrato
                                </p>
                            </div>
                            <span class="tag amber">CFDI SIMULADO</span>
                        </div>
                        <div class="table-wrap">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Arrendatario</th>
                                        <th>Concepto</th>
                                        <th>Forma de pago</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="financeRows">
                                    <tr>
                                        <td>F-2026-1637</td>
                                        <td>Mariana López Canto</td>
                                        <td>Renta + depósito</td>
                                        <td>Transferencia</td>
                                        <td>$2,786</td>
                                        <td>
                                            <span class="tag amber"
                                                >Simulada</span
                                            >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>OI-2026-0032</td>
                                        <td>Carlos Méndez Ruiz</td>
                                        <td>Reposición de llaves</td>
                                        <td>Tarjeta</td>
                                        <td>$450</td>
                                        <td>
                                            <span class="tag green"
                                                >Registrado</span
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                    <section class="panel section" style="margin-top: 20px">
                        <div
                            class="panel-head"
                            style="margin: -20px -20px 18px"
                        >
                            <div>
                                <b>Registrar otro ingreso</b>
                                <p class="muted">
                                    Catálogo observado: llaves, cerraduras,
                                    penalizaciones y otros conceptos.
                                </p>
                            </div>
                            <span class="tag amber">SIMULACIÓN</span>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label>CONCEPTO</label
                                ><select id="incomeConcept">
                                    <option>Reposición de llaves</option>
                                    <option>Reposición de cerradura</option>
                                    <option>
                                        Penalización por incumplimiento
                                    </option>
                                    <option>Otro ingreso</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>ARRENDATARIO</label
                                ><select id="incomeTenant">
                                    <option>Mariana López Canto</option>
                                    <option>Carlos Méndez Ruiz</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>IMPORTE</label
                                ><input
                                    id="incomeAmount"
                                    type="number"
                                    value="450"
                                />
                            </div>
                            <div class="field">
                                <label>FORMA DE PAGO</label
                                ><select id="incomeMethod">
                                    <option>Transferencia</option>
                                    <option>Efectivo</option>
                                    <option>Tarjeta</option>
                                </select>
                            </div>
                        </div>
                        <button
                            class="btn primary"
                            style="margin-top: 18px"
                            onclick="registerOtherIncome()"
                        >
                            Registrar movimiento simulado
                        </button>
                    </section>
                </section>
                <section class="view" id="users">
                    <div class="heading">
                        <div>
                            <p class="eyebrow">CONFIGURACIÓN · SIMULACIÓN</p>
                            <h1>Usuarios, perfiles y permisos</h1>
                            <p class="muted">
                                Capacidad observada en el catálogo de perfiles
                                del sistema anterior.
                            </p>
                        </div>
                        <button
                            class="btn primary"
                            onclick="openUserModal()"
                        >
                            ＋ Nuevo usuario
                        </button>
                    </div>
                    <div class="two">
                        <section class="panel section">
                            <h2>Perfiles disponibles</h2>
                            <div class="activity">
                                <span
                                    ><b>Administrador</b><br /><small
                                        class="muted"
                                        >Acceso a operación, reportes,
                                        configuración y accesos.</small
                                    ></span
                                ><span class="tag green">Activo</span>
                            </div>
                            <div class="activity">
                                <span
                                    ><b>Recepción</b><br /><small class="muted"
                                        >Solicitudes, arrendatarios, contratos y
                                        control de acceso.</small
                                    ></span
                                ><span class="tag green">Activo</span>
                            </div>
                            <div class="activity">
                                <span
                                    ><b>Finanzas</b><br /><small class="muted"
                                        >Facturación, reportes y catálogo de
                                        otros ingresos.</small
                                    ></span
                                ><span class="tag green">Activo</span>
                            </div>
                            <div class="activity">
                                <span><b>Encargado de bóveda</b><br /><small class="muted">Solo puede consultar y confirmar entradas/salidas en Accesos a la bóveda.</small></span><span class="tag green">Activo</span>
                            </div>
                            <div class="activity">
                                <span><b>Operador C4</b><br /><small class="muted">Monitorea cámaras y controla a distancia la puerta de Bóveda.</small></span><span class="tag green">Activo</span>
                            </div>
                        </section>
                        <section class="panel section" style="margin-top:20px">
                            <h2>Usuarios disponibles en la demo</h2>
                            <div id="demoUserList" style="margin-top:14px"></div>
                        </section>
                        <section class="panel section">
                            <h2>Matriz de permisos</h2>
                            <div class="small-grid" style="margin-top: 18px">
                                <div class="notice">
                                    <b>Operación</b><br />Solicitudes,
                                    arrendatarios, contratos, renovaciones y
                                    cancelaciones.
                                </div>
                                <div class="notice">
                                    <b>Seguridad</b><br />Accesos, autorizados y
                                    futuras integraciones biométricas.
                                </div>
                                <div class="notice">
                                    <b>Finanzas</b><br />Facturas, garantías,
                                    otros ingresos y reportes.
                                </div>
                                <div class="notice">
                                    <b>Configuración</b><br />Alertas,
                                    catálogos, perfiles y plantillas.
                                </div>
                            </div>
                        </section>
                    </div>
                    <section class="panel section" style="margin-top: 20px">
                        <div
                            class="panel-head"
                            style="margin: -20px -20px 18px"
                        >
                            <div>
                                <b>Revisión de permisos por rol</b>
                                <p class="muted">
                                    Representación de permisos observados por
                                    módulo/acción.
                                </p>
                            </div>
                            <select
                                id="rolePreview"
                                onchange="renderRolePermissions()"
                            >
                                <option>Administrador</option>
                                <option>Recepción</option>
                                <option>Finanzas</option>
                                <option>Encargado de bóveda</option>
                                <option>Operador C4</option>
                            </select>
                        </div>
                        <div id="rolePermissions" class="small-grid"></div>
                        <p class="notice" style="margin-top: 18px">
                            Las aprobaciones reforzadas, permisos definitivos y
                            auditoría inmutable siguen pendientes de validación
                            con operación y dirección.
                        </p>
                    </section>
                </section>
            </div>
        </main>
        <div
            id="contractConfirm"
            class="modal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="contractConfirmTitle"
        >
            <section class="invoice contract-invoice">
                <p class="eyebrow">ÚLTIMO PASO · FACTURACIÓN SIMULADA</p>
                <h2 id="contractConfirmTitle">Facturas del contrato</h2>
                <p class="muted">Distribuye el total entre una o varias facturas antes de guardar.</p>
                <div class="contract-invoice-summary" id="contractConfirmSummary"></div>
                <div class="fields contract-invoice-fields">
                    <div class="field"><label for="contractInvoiceProfile">PERFIL DE FACTURACIÓN</label><select id="contractInvoiceProfile"><option value="general">Público general</option><option value="tenant">Datos fiscales del arrendatario</option></select></div>
                    <div class="field"><label for="contractInvoiceMethod">FORMA DE PAGO</label><select id="contractInvoiceMethod"><option>Transferencia</option><option>Efectivo</option><option>Tarjeta</option></select></div>
                    <div class="field"><label for="contractInvoiceAmount">TOTAL DE ESTA FACTURA</label><input id="contractInvoiceAmount" type="number" min="0.01" step="0.01" /></div>
                    <button class="btn outline" type="button" onclick="addContractInvoice()">＋ Agregar factura</button>
                </div>
                <p class="contract-invoice-error" id="contractInvoiceError" role="alert" hidden></p>
                <div class="table-wrap contract-invoice-table"><table><thead><tr><th>Perfil</th><th>Pago</th><th>Subtotal*</th><th>IVA*</th><th>Total</th><th></th></tr></thead><tbody id="contractInvoiceRows"></tbody></table></div>
                <div class="contract-invoice-totals"><span>Agregado <b id="contractInvoiceAllocated">$0.00</b></span><span>Pendiente <b id="contractInvoiceRemaining">$0.00</b></span></div>
                <p class="muted" style="font-size:11px">* IVA estimado sobre la renta y distribuido proporcionalmente entre las facturas. La garantía se incluye en el total de la simulación. No se emite CFDI.</p>
                <div class="contract-invoice-actions"><button class="btn outline" type="button" onclick="closeContractConfirmation()">Volver a editar</button><button class="btn primary" type="button" onclick="saveContract()">Guardar contrato y facturas</button></div>
            </section>
        </div>
        <div
            id="lifecycleConfirm"
            class="modal"
            role="dialog"
            aria-modal="true"
            aria-labelledby="lifecycleConfirmTitle"
        >
            <section class="invoice">
                <p class="eyebrow" id="lifecycleConfirmEyebrow">
                    GESTIÓN · DEMO
                </p>
                <h2 id="lifecycleConfirmTitle">Confirmar operación</h2>
                <p
                    class="muted"
                    id="lifecycleConfirmText"
                    style="margin-top: 8px"
                ></p>
                <div
                    class="selected"
                    id="lifecycleConfirmSummary"
                    style="margin-top: 18px"
                ></div>
                <p class="notice" style="margin-top: 14px">
                    Esta operación modifica únicamente los datos locales de
                    demostración. No emite documentos, CFDI ni movimientos
                    reales.
                </p>
                <div
                    style="
                        display: flex;
                        gap: 10px;
                        justify-content: flex-end;
                        margin-top: 20px;
                    "
                >
                    <button
                        class="btn outline"
                        onclick="closeLifecycleConfirmation()"
                    >
                        Volver a editar</button
                    ><button class="btn primary" id="lifecycleConfirmAction">
                        Confirmar
                    </button>
                </div>
            </section>
        </div>
        <div id="invoiceModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="invoiceModalTitle">
            <section class="invoice">
                <p class="eyebrow">FACTURACIÓN · SIMULACIÓN</p>
                <h2 id="invoiceModalTitle">Registrar factura de ejemplo</h2>
                <p class="muted" style="margin-top: 8px">No genera CFDI, timbrado ni cobro real.</p>
                <div class="fields" style="margin-top: 20px">
                    <div class="field wide"><label>ARRENDATARIO</label><select id="invoiceTenant" onchange="syncInvoiceContracts()"></select></div>
                    <div class="field wide"><label>CONTRATO</label><select id="invoiceContract"></select></div>
                    <div class="field wide"><label>PERFIL DE FACTURACIÓN</label><select id="invoiceProfile" onchange="syncInvoiceProfile()"><option value="general">Público general</option><option value="tenant">Datos fiscales del arrendatario</option></select></div>
                    <div id="invoiceProfileHelp" class="notice wide"></div>
                    <div class="field"><label>CONCEPTO</label><input id="invoiceConcept" value="Renta mensual" /></div>
                    <div class="field"><label>IMPORTE</label><input id="invoiceAmount" type="number" min="0.01" step="0.01" /></div>
                    <div class="field"><label>FORMA DE PAGO</label><select id="invoiceMethod"><option>Transferencia</option><option>Efectivo</option><option>Tarjeta</option></select></div>
                </div>
                <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:24px">
                    <button class="btn outline" type="button" onclick="closeInvoiceModal()">Cancelar</button>
                    <button class="btn primary" type="button" onclick="registerInvoice()">Registrar factura</button>
                </div>
            </section>
        </div>
        <div id="userModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="userModalTitle">
            <section class="invoice">
                <p class="eyebrow">USUARIOS · SIMULACIÓN</p>
                <h2 id="userModalTitle">Agregar usuario de demostración</h2>
                <p class="muted" style="margin-top: 8px">No crea credenciales ni concede permisos reales.</p>
                <div class="fields" style="margin-top: 20px">
                <div class="field wide"><label>NOMBRE COMPLETO</label><input id="userName" placeholder="Ej. Laura Pérez" /></div>
                    <div class="field"><label>CORREO</label><input id="userEmail" type="email" placeholder="nombre@saferoom.mx" /></div>
                    <div class="field"><label>PERFIL</label><select id="userRole"><option>Recepción</option><option>Finanzas</option><option>Administrador</option><option>Encargado de bóveda</option><option>Operador C4</option></select></div>
                </div>
                <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:24px">
                    <button class="btn outline" type="button" onclick="closeUserModal()">Cancelar</button>
                    <button class="btn primary" type="button" onclick="saveDemoUser()">Guardar usuario</button>
                </div>
            </section>
        </div>
        <div id="toast" class="toast"></div>
        <div id="documentViewerModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="documentViewerTitle">
            <section class="invoice" style="width:min(900px,100%);max-height:88vh;overflow:auto">
                <div class="panel-head">
                    <div><p class="eyebrow">DOCUMENTO · VISTA PREVIA</p><h2 id="documentViewerTitle">Documento</h2></div>
                    <button class="btn outline" type="button" onclick="closeDocumentViewer()">× Cerrar</button>
                </div>
                <div id="documentViewerContent" style="margin-top:18px"></div>
                <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:20px">
                    <button class="btn outline" type="button" onclick="printDocument()">Imprimir</button>
                    <button class="btn outline" type="button" onclick="downloadPreviewDocument()">⇩ Descargar texto</button>
                    <button class="btn primary" type="button" onclick="closeDocumentViewer()">Listo</button>
                </div>
            </section>
        </div>
        <script>
            const DEMO_STORAGE_KEY = "saferoom-demo-state";
            const DEMO_SCHEMA_VERSION = 12;
            const CURRENT_USER = @json(request()->attributes->get('demoUser'));
            const CURRENT_PERMISSIONS = @json(config('demo.permissions.'.(request()->attributes->get('demoUser')['role'] ?? ''), []));
            const C4_DEMO_PORTRAITS = {
                "auth-pacho": @json(asset('images/demo-c4-portrait.png')),
            };
            const seedState = {
                schemaVersion: DEMO_SCHEMA_VERSION,
                boxes: [
                    { id: "box-a101", code: "A-101", size: "S", area: "Acceso A", status: "Ocupada", rentCents: 129000, keys: 2 },
                    { id: "box-a102", code: "A-102", size: "S", area: "Acceso A", status: "Disponible", rentCents: 129000, keys: 2 },
                    { id: "box-a103", code: "A-103", size: "S", area: "Acceso A", status: "Disponible", rentCents: 129000, keys: 2 },
                    { id: "box-a104", code: "A-104", size: "M", area: "Acceso A", status: "Reservada", rentCents: 189000, keys: 2 },
                    { id: "box-a105", code: "A-105", size: "M", area: "Acceso A", status: "Ocupada", rentCents: 189000, keys: 2 },
                    { id: "box-b201", code: "B-201", size: "M", area: "Nivel B", status: "Disponible", rentCents: 189000, keys: 2 },
                    { id: "box-b202", code: "B-202", size: "L", area: "Nivel B", status: "Ocupada", rentCents: 259000, keys: 2 },
                    { id: "box-b203", code: "B-203", size: "L", area: "Nivel B", status: "Disponible", rentCents: 259000, keys: 2 },
                    { id: "box-b204", code: "B-204", size: "L", area: "Nivel B", status: "Mantenimiento", rentCents: 259000, keys: 2 },
                    { id: "box-c301", code: "C-301", size: "XL", area: "Nivel C", status: "Disponible", rentCents: 349000, keys: 2 },
                    { id: "box-c302", code: "C-302", size: "XL", area: "Nivel C", status: "Disponible", rentCents: 349000, keys: 2 },
                    { id: "box-c303", code: "C-303", size: "XL", area: "Nivel C", status: "Disponible", rentCents: 349000, keys: 2 },
                ],
                tenants: [
                    { id: "tenant-mariana", catalogNumber: 13, name: "Mariana López Canto", email: "mariana.lopez@ejemplo.mx", phone: "999 261 4587", rfc: "LOCM9004127A4", curp: "LOCM900412MYNPNT08", street: "Calle 60 #412", neighborhood: "Centro", postalCode: "97000", municipality: "Mérida", state: "Yucatán", billingEmail: "mariana.lopez@ejemplo.mx", taxRegime: "Régimen simplificado de confianza", cfdiUse: "S01 · Sin efectos fiscales" },
                    { id: "tenant-carlos", catalogNumber: 14, name: "Carlos Méndez Ruiz", email: "carlos.mendez@ejemplo.mx", phone: "999 180 1212", rfc: "MERC840822N21", municipality: "Mérida", state: "Yucatán" },
                    { id: "tenant-blanca", catalogNumber: 15, name: "Blanca González Gómez", email: "blanca.gonzalez@ejemplo.mx", phone: "999 209 7861", rfc: "GOGB860211P91", municipality: "Mérida", state: "Yucatán" },
                    { id: "tenant-sofia", name: "Sofía Herrera", email: "sofia.herrera@ejemplo.mx", phone: "999 312 4578", rfc: "", municipality: "Mérida", state: "Yucatán" },
                    { id: "tenant-daniela", name: "Daniela Cruz", email: "daniela.cruz@ejemplo.mx", phone: "999 425 1087", rfc: "", municipality: "Mérida", state: "Yucatán" },
                    { id: "tenant-alberto", name: "Alberto Torres", email: "alberto.torres@ejemplo.mx", phone: "999 140 9833", rfc: "", municipality: "Mérida", state: "Yucatán" },
                ],
                authorizations: [
                    { id: "auth-jose", tenantId: "tenant-mariana", name: "José Luis López", phone: "999 852 9911", type: "Autorizado" },
                    { id: "auth-rejon", tenantId: "tenant-blanca", name: "Rejón Pérez Juan Manuel", phone: "999 620 4432", type: "Autorizado" },
                    { id: "auth-pacho", tenantId: "tenant-mariana", name: "Pacho Lozano María Ofelia Lucía", phone: "999 821 4087", type: "Autorizado" },
                ],
                requests: [
                    { id: "request-0032", folio: "SOL-0032", tenantId: "tenant-sofia", boxId: "box-b201", createdAt: "2026-10-27T09:42:00", status: "Nueva", contractId: null, services: { "5 × 10": 1 }, documents: { identification: false, constitutive: false, fiscal: false } },
                    { id: "request-0031", folio: "SOL-0031", tenantId: "tenant-daniela", boxId: "box-a102", createdAt: "2026-10-26T16:10:00", status: "En revisión", contractId: null, services: { "3 × 5": 1, "5 × 5": 1 }, documents: { identification: true, constitutive: false, fiscal: false } },
                    { id: "request-0030", folio: "SOL-0030", tenantId: "tenant-alberto", boxId: "box-c302", createdAt: "2026-10-26T11:25:00", status: "Nueva", contractId: null, services: { "10 × 10": 1 }, documents: { identification: false, constitutive: false, fiscal: false } },
                ],
                contracts: [
                    { id: "contract-0148", folio: "CT-2026-0148", tenantId: "tenant-mariana", boxId: "box-a101", startDate: "2026-01-01", endDate: "2026-11-13", durationMonths: 12, rentCents: 129000, depositCents: 129000, paymentDay: 1, paymentMethod: "Transferencia", status: "Activo", createdAt: "2026-01-01T10:00:00" },
                    { id: "contract-0149", folio: "CT-2026-0149", tenantId: "tenant-carlos", boxId: "box-a105", startDate: "2026-01-01", endDate: "2026-12-20", durationMonths: 12, rentCents: 189000, depositCents: 189000, paymentDay: 5, paymentMethod: "Tarjeta", status: "Activo", createdAt: "2026-01-01T10:00:00" },
                    { id: "contract-0141", folio: "CT-2026-0141", tenantId: "tenant-blanca", boxId: "box-b202", startDate: "2025-11-23", endDate: "2026-11-22", durationMonths: 12, rentCents: 259000, depositCents: 259000, paymentDay: 1, paymentMethod: "Transferencia", status: "Por renovar", createdAt: "2025-11-23T10:00:00" },
                ],
                movements: [
                    { id: "movement-1637", folio: "F-2026-1637", tenantId: "tenant-mariana", contractId: "contract-0148", concept: "Renta + depósito", method: "Transferencia", amountCents: 278640, type: "Factura", status: "Simulada", occurredAt: "2026-10-01" },
                    { id: "movement-0032", folio: "OI-2026-0032", tenantId: "tenant-carlos", contractId: "contract-0149", concept: "Reposición de llaves", method: "Tarjeta", amountCents: 45000, type: "Otro ingreso", status: "Registrado", occurredAt: "2026-10-08" },
                ],
                documents: [
                    { id: "document-0148-contract", contractId: "contract-0148", type: "Contrato de arrendamiento", folio: "DOC-CT-0148", createdAt: "2026-01-01" },
                    { id: "document-0148-keys", contractId: "contract-0148", type: "Constancia de entrega de llaves", folio: "DOC-LL-0148", createdAt: "2026-01-01" },
                    { id: "document-0148-deposit", contractId: "contract-0148", type: "Recibo de depósito en garantía", folio: "DOC-DG-0148", createdAt: "2026-01-01" },
                ],
                accessQueue: [
                    { id: "queue-1", tenantId: "tenant-mariana", authorizationId: "auth-jose", contractId: "contract-0148", direction: "Entrada", status: "Pendiente", createdAt: "2026-10-27T09:42:00" },
                    { id: "queue-2", tenantId: "tenant-blanca", authorizationId: null, contractId: "contract-0141", direction: "Entrada", status: "Pendiente", createdAt: "2026-10-27T09:15:00" },
                    { id: "queue-3", tenantId: "tenant-daniela", authorizationId: null, contractId: null, direction: "Entrada", status: "Requiere revisión", createdAt: "2026-10-27T09:02:00" },
                    { id: "queue-c4-1", tenantId: "tenant-mariana", authorizationId: "auth-pacho", contractId: "contract-0148", direction: "Entrada", status: "Autorizado para C4", c4EntryId: "access-c4-pacho", createdAt: "2026-10-28T17:18:00" },
                ],
                accessEvents: [
                    { id: "access-c4-pacho", tenantId: "tenant-mariana", contractId: "contract-0148", authorizationId: "auth-pacho", direction: "Entrada", status: "Confirmado", reason: "Entrada registrada por Bóveda; C4 mantiene el control remoto de la puerta", confirmedBy: "Sergio Paredes", occurredAt: "2026-10-28T17:18:00", image: "Referencia biométrica simulada" },
                    { id: "access-entry-c4", tenantId: "tenant-mariana", contractId: "contract-0148", authorizationId: null, direction: "Entrada", status: "Confirmado", reason: "Acceso confirmado por encargado de bóveda", confirmedBy: "Sergio Paredes", occurredAt: "2026-10-27T10:04:00", image: "Referencia biométrica simulada" },
                    { id: "access-exit-c4", entryId: "access-entry-c4", tenantId: "tenant-mariana", contractId: "contract-0148", authorizationId: null, direction: "Salida", status: "Confirmado", reason: "Salida firmada en demo", signature: "Mariana López", occurredAt: "2026-10-27T10:18:00" },
                ],
                operations: [],
                auditLog: [
                    { id: "audit-1", occurredAt: "2026-10-27T09:42:00", user: "Andrea Castillo", action: "Creó solicitud", entity: "SOL-0032", result: "Correcto" },
                    { id: "audit-2", occurredAt: "2026-10-27T09:12:00", user: "Seguridad", action: "Actualizó entradas", entity: "Accesos", result: "Simulado" },
                ],
                users: [
                    { id: "user-andrea", name: "Andrea Castillo", email: "andrea.castillo@saferoom.demo", role: "Administrador", status: "Activo" },
                    { id: "user-marco", name: "Marco Rodríguez", email: "marco.rodriguez@saferoom.demo", role: "Recepción", status: "Activo" },
                    { id: "user-finance", name: "Elena Vargas", email: "elena.vargas@saferoom.demo", role: "Finanzas", status: "Activo" },
                    { id: "user-boveda", name: "Sergio Paredes", email: "boveda@saferoom.demo", role: "Encargado de bóveda", status: "Activo", permissions: ["access"] },
                    { id: "user-c4", name: "Valeria Cárdenas", email: "c4@saferoom.demo", role: "Operador C4", status: "Activo", permissions: ["door-control"] },
                ],
                settings: { availabilityAlert: "Activa", availabilityLimit: "25%", availabilityMessage: "Disponibilidad de cajas por debajo del límite" },
                ui: { selectedTenantId: "tenant-mariana", selectedContractId: "contract-0148", selectedRequestId: null, draft: null, activeProfile: "admin" },
            };
            const clone = (value) => structuredClone(value);
            const createDemoId = (prefix) => {
                const uuid = globalThis.crypto?.randomUUID?.();
                const fallback = `${Date.now().toString(36)}-${Math.random().toString(36).slice(2, 10)}`;
                return `${prefix}-${uuid || fallback}`;
            };
            const validState = (value) => value && value.schemaVersion === DEMO_SCHEMA_VERSION && ["boxes", "tenants", "requests", "contracts", "movements", "documents", "accessQueue", "accessEvents", "operations", "auditLog", "users"].every((key) => Array.isArray(value[key])) && value.ui;
            function loadState() {
                try {
                    const saved = JSON.parse(localStorage.getItem(DEMO_STORAGE_KEY));
                    return validState(saved) ? saved : clone(seedState);
                } catch (_) {
                    return clone(seedState);
                }
            }
            let state = loadState();
            function persistState() {
                try {
                    localStorage.setItem(DEMO_STORAGE_KEY, JSON.stringify(state));
                    return true;
                } catch (_) {
                    flash("No fue posible guardar los cambios de la demo en este navegador.");
                    return false;
                }
            }
            const title = {
                home: "Vista general",
                requests: "Solicitudes",
                form: "Nueva solicitud",
                boxes: "Disponibilidad de cajas",
                contract: "Generar contrato",
                tenant: "Ficha del arrendatario",
                contracts: "Contratos",
                tenants: "Arrendatarios",
                renewals: "Renovaciones",
                cancellations: "Cancelaciones",
                access: "Historial de accesos",
                documents: "Documentos",
                reports: "Reportes",
                finance: "Finanzas",
                settings: "Catálogos y alertas",
                users: "Usuarios y permisos",
            };
            const viewRoutes = {
                home: @json(route('dashboard')),
                requests: @json(route('requests.index')),
                form: @json(route('requests.create')),
                boxes: @json(route('boxes.index')),
                tenants: @json(route('tenants.index')),
                tenant: @json(route('tenants.show')),
                contracts: @json(route('contracts.index')),
                contract: @json(route('contracts.create')),
                renewals: @json(route('renewals.index')),
                cancellations: @json(route('cancellations.index')),
                access: @json(route('access.index')),
                documents: @json(route('documents.index')),
                reports: @json(route('reports.index')),
                finance: @json(route('finance.index')),
                settings: @json(route('settings.index')),
                users: @json(route('users.index')),
            };
            const initialView = @json($view ?? 'home');
            const initialTenantTab = @json(request('tab', 'Resumen'));
            const tenantTabs = ["Resumen", "Generales", "Domicilio", "Laboral y fiscal", "Autorizados", "Cajas", "Contratos", "Facturas", "Documentos", "Accesos"];
            let currentTenantTab = tenantTabs.includes(initialTenantTab) ? initialTenantTab : "Resumen";
            const navParent = { form: "requests", contract: "contracts", tenant: "tenants" };
            const safeDateFormat = new Intl.DateTimeFormat("es-MX", {
                day: "2-digit",
                month: "short",
                year: "numeric",
            });
            const safeDateMonthFormat = new Intl.DateTimeFormat("es-MX", {
                month: "long",
                year: "numeric",
            });
            const safeDateIcon = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4.5" width="18" height="16" rx="3"/><path d="M8 2.5v4M16 2.5v4M3 9.5h18M8 14h.01M12 14h.01M16 14h.01M8 17.5h.01M12 17.5h.01"/></svg>`;
            const safeDateValue = (date) =>
                `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, "0")}-${String(date.getDate()).padStart(2, "0")}`;
            const safeDateFromValue = (value) => {
                if (!value) return new Date();
                const [year, month, day] = value.split("-").map(Number);
                return new Date(year, month - 1, day);
            };
            const safeDateLabel = (value) =>
                value ? safeDateFormat.format(safeDateFromValue(value)).replace(".", "") : "Sin fecha";
            function refreshSafeDate(input) {
                if (!input || !input._safeDate) return;
                input._safeDate.value.textContent = safeDateLabel(input.value);
                input._safeDate.state.selected = safeDateFromValue(input.value);
                drawSafeCalendar(input._safeDate);
            }
            function drawSafeCalendar(control) {
                const { input, state, calendar } = control;
                const year = state.view.getFullYear();
                const month = state.view.getMonth();
                const first = new Date(year, month, 1);
                const start = (first.getDay() + 6) % 7;
                const firstDay = new Date(year, month, 1 - start);
                const today = safeDateValue(new Date());
                const selected = input.value;
                let days = "";
                for (let i = 0; i < 42; i++) {
                    const day = new Date(firstDay);
                    day.setDate(firstDay.getDate() + i);
                    const value = safeDateValue(day);
                    const classes = ["safe-calendar__day"];
                    if (day.getMonth() !== month) classes.push("safe-calendar__day--muted");
                    if (value === today) classes.push("safe-calendar__day--today");
                    if (value === selected) classes.push("safe-calendar__day--selected");
                    days += `<button type="button" class="${classes.join(" ")}" data-safe-day="${value}" aria-label="${safeDateLabel(value)}">${day.getDate()}</button>`;
                }
                calendar.innerHTML = `<div class="safe-calendar__head"><span class="safe-calendar__month">${safeDateMonthFormat.format(first)}</span><span class="safe-calendar__actions"><button type="button" class="safe-calendar__nav" data-safe-nav="prev" aria-label="Mes anterior">‹</button><button type="button" class="safe-calendar__nav" data-safe-nav="next" aria-label="Mes siguiente">›</button></span></div><div class="safe-calendar__week"><span>L</span><span>M</span><span>M</span><span>J</span><span>V</span><span>S</span><span>D</span></div><div class="safe-calendar__days">${days}</div>`;
                calendar.querySelector('[data-safe-nav="prev"]').onclick = () => { state.view = new Date(year, month - 1, 1); drawSafeCalendar(control); };
                calendar.querySelector('[data-safe-nav="next"]').onclick = () => { state.view = new Date(year, month + 1, 1); drawSafeCalendar(control); };
                calendar.querySelectorAll("[data-safe-day]").forEach((button) => {
                    button.onclick = () => {
                        input.value = button.dataset.safeDay;
                        state.selected = safeDateFromValue(input.value);
                        control.value.textContent = safeDateLabel(input.value);
                        calendar.hidden = true;
                        input.dispatchEvent(new Event("change", { bubbles: true }));
                    };
                });
            }
            function initialiseSafeDates() {
                document.querySelectorAll('input[type="date"]').forEach((input) => {
                    if (input.dataset.safeDateReady) return;
                    input.dataset.safeDateReady = "true";
                    const wrapper = document.createElement("div");
                    wrapper.className = `safe-date${input.readOnly ? " safe-date--readonly" : ""}`;
                    const value = document.createElement("span");
                    value.className = "safe-date__value";
                    value.textContent = safeDateLabel(input.value);
                    const trigger = document.createElement("button");
                    trigger.type = "button";
                    trigger.className = "safe-date__trigger";
                    trigger.setAttribute("aria-label", "Elegir fecha");
                    trigger.innerHTML = safeDateIcon;
                    const calendar = document.createElement("div");
                    calendar.className = "safe-calendar";
                    calendar.hidden = true;
                    input.parentNode.insertBefore(wrapper, input);
                    wrapper.append(input, value, trigger, calendar);
                    input.classList.add("safe-date__native");
                    const control = input._safeDate = { input, value, calendar, state: { selected: safeDateFromValue(input.value), view: safeDateFromValue(input.value) } };
                    drawSafeCalendar(control);
                    trigger.onclick = () => {
                        const shouldOpen = calendar.hidden;
                        document.querySelectorAll(".safe-calendar").forEach((panel) => panel.hidden = true);
                        calendar.hidden = !shouldOpen;
                    };
                });
                document.addEventListener("click", (event) => {
                    if (!event.target.closest(".safe-date")) document.querySelectorAll(".safe-calendar").forEach((panel) => panel.hidden = true);
                });
            }
            function closeHeaderPanels() {
                ["notificationPanel", "profilePanel"].forEach((id) => {
                    const panel = byId(id);
                    const button = byId(id === "notificationPanel" ? "notificationButton" : "profileButton");
                    if (panel) panel.hidden = true;
                    if (button) button.setAttribute("aria-expanded", "false");
                });
            }
            function toggleHeaderPanel(id) {
                const panel = byId(id);
                const button = byId(id === "notificationPanel" ? "notificationButton" : "profileButton");
                if (!panel || !button) return;
                const willOpen = panel.hidden;
                closeHeaderPanels();
                panel.hidden = !willOpen;
                button.setAttribute("aria-expanded", String(willOpen));
            }
            function setTheme(isDark) {
                document.body.dataset.theme = isDark ? "dark" : "light";
                try { localStorage.setItem("saferoom-demo-theme", isDark ? "dark" : "light"); } catch (_) {}
            }
            function initialiseHeaderControls() {
                const savedTheme = (() => {
                    try { return localStorage.getItem("saferoom-demo-theme"); } catch (_) { return null; }
                })();
                const toggle = byId("themeToggle");
                if (toggle) {
                    toggle.checked = savedTheme === "dark";
                    setTheme(toggle.checked);
                }
                document.querySelectorAll(".nav[data-view]").forEach((nav) => {
                    nav.addEventListener("click", () => showView(nav.dataset.view));
                });
                document.addEventListener("click", (event) => {
                    if (!event.target.closest(".header-popover-wrap")) closeHeaderPanels();
                });
                window.addEventListener("popstate", () => {
                    const match = Object.entries(viewRoutes).find(([, route]) => new URL(route, window.location.origin).pathname === location.pathname);
                    syncSelectionFromUrl();
                    showView(match?.[0] || fallbackView(), { sync: false, scroll: false });
                });
            }
            function flash(message) {
                const toast = byId("toast");
                if (!toast) return;
                toast.textContent = message;
                toast.style.display = "block";
                clearTimeout(window.safeRoomToastTimer);
                window.safeRoomToastTimer = setTimeout(() => { toast.style.display = "none"; }, 4200);
            }
            function closeContractConfirmation() {
                byId("contractConfirm")?.classList.remove("on");
            }
            function closeLifecycleConfirmation() {
                byId("lifecycleConfirm")?.classList.remove("on");
            }
            function renderRolePermissions() {
                const role = byId("rolePreview")?.value || "Administrador";
                const permissions = {
                    Administrador: ["Operación completa", "Gestión de accesos", "Facturación y reportes", "Configuración y usuarios"],
                    "Recepción": ["Solicitudes y expediente", "Cajas y arrendatarios", "Contratos y renovaciones", "Documentos"],
                    Finanzas: ["Facturación simulada", "Otros ingresos", "Reportes administrativos", "Sin operación de bóveda"],
                    "Encargado de bóveda": ["Validar persona autorizada", "Enviar solicitud a C4", "Registrar salida", "Capturar firma simulada"],
                    "Operador C4": ["Ver registros autorizados", "Monitorear cámara y foto de referencia", "Abrir puerta de bóveda a distancia", "Registrar y cerrar la puerta"],
                }[role] || [];
                const target = byId("rolePermissions");
                if (target) target.innerHTML = permissions.map((permission) => `<div class="notice"><b>✓</b><br />${esc(permission)}</div>`).join("");
            }
            /* Estado relacionado de la demo (fase 7). Estas funciones reemplazan
               progresivamente la implementación anterior basada en arreglos. */
            const moneyFormatter = new Intl.NumberFormat("es-MX", { style: "currency", currency: "MXN", minimumFractionDigits: 2, maximumFractionDigits: 2 });
            const fmtCents = (cents) => moneyFormatter.format((Number(cents) || 0) / 100);
            const esc = (value) => String(value ?? "").replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\"/g, "&quot;").replace(/'/g, "&#039;");
            const byId = (id) => document.getElementById(id);
            const tenantById = (id) => state.tenants.find((tenant) => tenant.id === id);
            const boxById = (id) => state.boxes.find((box) => box.id === id);
            const contractById = (id) => state.contracts.find((contract) => contract.id === id);
            const requestById = (id) => state.requests.find((request) => request.id === id);
            const contractsForTenant = (tenantId) => state.contracts.filter((contract) => contract.tenantId === tenantId);
            const isOpenContract = (contract) => contract && ["Activo", "Por renovar"].includes(contract.status);
            const activeContracts = () => state.contracts.filter(isOpenContract);
            const nextSequence = (items, field, fallback) => Math.max.apply(null, [fallback].concat(items.map((item) => Number(String(item[field] || "").match(/(\d+)(?!.*\d)/)?.[1]) || 0))) + 1;
            const dateLabel = (value) => value ? new Intl.DateTimeFormat("es-MX", { day: "2-digit", month: "short", year: "numeric" }).format(new Date(`${value}T12:00:00`)).replace(".", "") : "Sin fecha";
            function addMonthsMinusOne(startValue, months) {
                if (!startValue) return "";
                const [year, month, day] = startValue.split("-").map(Number);
                if (!year || !month || !day) return "";
                const target = (month - 1) + Math.max(1, Number(months) || 1);
                const targetYear = year + Math.floor(target / 12);
                const targetMonth = target % 12;
                const lastDay = new Date(Date.UTC(targetYear, targetMonth + 1, 0)).getUTCDate();
                const result = new Date(Date.UTC(targetYear, targetMonth, Math.min(day, lastDay)));
                result.setUTCDate(result.getUTCDate() - 1);
                return result.toISOString().slice(0, 10);
            }
            function selectedTenant() {
                return tenantById(state.ui.selectedTenantId) || state.tenants[0];
            }
            function selectedContract() {
                return contractById(state.ui.selectedContractId) || activeContracts()[0] || state.contracts[0];
            }
            function syncSelectionFromUrl() {
                const params = new URLSearchParams(location.search);
                if (tenantById(params.get("tenant"))) state.ui.selectedTenantId = params.get("tenant");
                if (contractById(params.get("contract"))) {
                    state.ui.selectedContractId = params.get("contract");
                    state.ui.selectedTenantId = selectedContract().tenantId;
                }
                if (requestById(params.get("request"))) state.ui.selectedRequestId = params.get("request");
            }
            function routeFor(id, tab = null) {
                const url = new URL(viewRoutes[id] || viewRoutes.home, window.location.origin);
                if (state.ui.selectedTenantId) url.searchParams.set("tenant", state.ui.selectedTenantId);
                if (state.ui.selectedContractId) url.searchParams.set("contract", state.ui.selectedContractId);
                if (state.ui.selectedRequestId) url.searchParams.set("request", state.ui.selectedRequestId);
                if (id === "tenant" && tab && tab !== "Resumen") url.searchParams.set("tab", tab);
                return `${url.pathname}${url.search}`;
            }
            function isAllowedView(id) {
                return CURRENT_PERMISSIONS.includes("*") || CURRENT_PERMISSIONS.includes(id);
            }
            function fallbackView() {
                return CURRENT_PERMISSIONS.length === 1 && CURRENT_PERMISSIONS[0] === "access" ? "access" : "home";
            }
            function showView(id, options = {}) {
                if (!isAllowedView(id)) id = fallbackView();
                if (!byId(id)) id = "home";
                document.querySelectorAll(".view").forEach((view) => view.classList.remove("on"));
                byId(id).classList.add("on");
                const activeNav = navParent[id] || id;
                document.querySelectorAll(".nav").forEach((nav) => nav.classList.toggle("on", nav.dataset.view === activeNav));
                byId("pageTitle").textContent = title[id];
                byId("side").classList.remove("open");
                if (id === "home") renderHome();
                if (id === "requests") renderRequests();
                if (id === "boxes") renderBoxes();
                if (id === "contract") populateContract();
                if (id === "tenants") renderTenants();
                if (id === "tenant") renderTenant(options.tab || currentTenantTab, { sync: false });
                if (id === "contracts") renderContracts();
                if (id === "renewals") renderRenewal();
                if (id === "cancellations") renderCancellation();
                if (id === "finance") renderFinance();
                if (id === "access") { renderAccessQueue(); renderAuditLog(); renderC4Control(); }
                if (id === "documents") renderDocuments();
                if (id === "reports") renderReport();
                if (id === "users") { renderRolePermissions(); renderDemoUsers(); }
                if (id === "settings") renderSettings();
                if (options.sync !== false) {
                    const target = routeFor(id, id === "tenant" ? (options.tab || currentTenantTab) : null);
                    if (`${location.pathname}${location.search}` !== target) history.pushState({ view: id }, "", target);
                }
                persistState();
                if (options.scroll !== false) scrollTo({ top: 0, behavior: "smooth" });
            }
            function badge(status) {
                const green = ["Disponible", "Activo", "Por renovar", "Confirmado", "Correcto", "Registrado", "Aprobada"];
                const amber = ["Nueva", "En revisión", "Reservada", "Pendiente", "Requiere revisión", "Revisión requerida"];
                const tone = green.includes(status) ? "green" : amber.includes(status) ? "amber" : status === "Denegada" ? "red" : status === "Simulado" ? "blue" : "slate";
                const visibleStatus = { "Autorizado para C4": "Autorizado para bóveda" }[status] || status;
                return `<span class="tag ${tone}">${esc(visibleStatus)}</span>`;
            }
            function tone(status) {
                return status === "Disponible" ? "green" : status === "Reservada" ? "amber" : status === "Mantenimiento" ? "blue" : "slate";
            }
            function formDraftFromTenant(tenant, request = null) {
                const authorization = state.authorizations.find((item) => item.tenantId === tenant.id && item.type !== "Personal de apoyo");
                return Object.assign({}, tenant, {
                    requestId: request?.id || null,
                    tenantId: tenant.id,
                    boxId: request?.boxId || "",
                    auth: authorization?.name || "",
                    authPhone: authorization?.phone || "",
                    services: request?.services || {},
                    documents: request?.documents || {},
                });
            }
            function fillRequestForm(draft) {
                const fields = { fName: "name", fEmail: "email", fPhone: "phone", fRfc: "rfc", fCurp: "curp", fBirthDate: "birthDate", fBirthPlace: "birthPlace", fGender: "gender", fNationality: "nationality", fCivilStatus: "civilStatus", fSpouseName: "spouseName", fMaritalRegime: "maritalRegime", fSource: "source", fStreet: "street", fNeighborhood: "neighborhood", fPostalCode: "postalCode", fMunicipality: "municipality", fState: "state", fResidenceTime: "residenceTime", fHomePhone: "homePhone", fOtherPhone: "otherPhone", fReference: "reference", fReferencePhone: "referencePhone", fReferenceTwo: "referenceTwo", fReferenceTwoPhone: "referenceTwoPhone", fPersonType: "personType", fCompany: "company", fJobTitle: "jobTitle", fWorkType: "workType", fWorkRfc: "workRfc", fWorkPhone: "workPhone", fWorkStartDate: "workStartDate", fWorkAddress: "workAddress", fBillingMode: "billingMode", fTaxRegime: "taxRegime", fCfdiUse: "cfdiUse", fBillingEmail: "billingEmail", fNotaryPublic: "notaryPublic", fNotaryNumber: "notaryNumber", fConstitutiveAct: "constitutiveAct", fConstitutiveVolume: "constitutiveVolume", fConstitutiveBook: "constitutiveBook", fConstitutiveDate: "constitutiveDate", fAuth: "auth", fAuthPhone: "authPhone" };
                Object.entries(fields).forEach(([inputId, property]) => { const input = byId(inputId); if (input) { input.value = draft[property] || ""; refreshSafeDate(input); } });
                const services = { fService35: "3 × 5", fService55: "5 × 5", fService310: "3 × 10", fService510: "5 × 10", fService1010: "10 × 10", fService1116: "11 × 16", fService2216: "22 × 16" };
                Object.entries(services).forEach(([inputId, service]) => { byId(inputId).value = draft.services?.[service] || 0; });
                byId("fDocIdentification").checked = Boolean(draft.documents?.identification);
                byId("fDocConstitutive").checked = Boolean(draft.documents?.constitutive);
                byId("fDocFiscal").checked = Boolean(draft.documents?.fiscal);
                syncRequestRequirements();
                selected();
            }
            function readRequestForm() {
                const source = state.ui.draft || {};
                const values = Object.assign({}, source);
                const fields = { fName: "name", fEmail: "email", fPhone: "phone", fRfc: "rfc", fCurp: "curp", fBirthDate: "birthDate", fBirthPlace: "birthPlace", fGender: "gender", fNationality: "nationality", fCivilStatus: "civilStatus", fSpouseName: "spouseName", fMaritalRegime: "maritalRegime", fSource: "source", fStreet: "street", fNeighborhood: "neighborhood", fPostalCode: "postalCode", fMunicipality: "municipality", fState: "state", fResidenceTime: "residenceTime", fHomePhone: "homePhone", fOtherPhone: "otherPhone", fReference: "reference", fReferencePhone: "referencePhone", fReferenceTwo: "referenceTwo", fReferenceTwoPhone: "referenceTwoPhone", fPersonType: "personType", fCompany: "company", fJobTitle: "jobTitle", fWorkType: "workType", fWorkRfc: "workRfc", fWorkPhone: "workPhone", fWorkStartDate: "workStartDate", fWorkAddress: "workAddress", fBillingMode: "billingMode", fTaxRegime: "taxRegime", fCfdiUse: "cfdiUse", fBillingEmail: "billingEmail", fNotaryPublic: "notaryPublic", fNotaryNumber: "notaryNumber", fConstitutiveAct: "constitutiveAct", fConstitutiveVolume: "constitutiveVolume", fConstitutiveBook: "constitutiveBook", fConstitutiveDate: "constitutiveDate", fAuth: "auth", fAuthPhone: "authPhone" };
                Object.entries(fields).forEach(([inputId, property]) => { values[property] = byId(inputId)?.value.trim() || ""; });
                const services = { fService35: "3 × 5", fService55: "5 × 5", fService310: "3 × 10", fService510: "5 × 10", fService1010: "10 × 10", fService1116: "11 × 16", fService2216: "22 × 16" };
                values.services = Object.fromEntries(Object.entries(services).map(([inputId, service]) => [service, Number(byId(inputId)?.value) || 0]).filter(([, quantity]) => quantity > 0));
                values.documents = { identification: byId("fDocIdentification").checked, constitutive: byId("fDocConstitutive").checked, fiscal: byId("fDocFiscal").checked };
                return values;
            }
            function requestGaps(draft) {
                const gaps = [];
                if (!draft.name || !draft.email || !draft.phone) gaps.push("datos de contacto");
                if (!draft.reference || !draft.referencePhone) gaps.push("referencia personal");
                if (!draft.boxId && !Object.keys(draft.services || {}).length) gaps.push("al menos un servicio o caja");
                if (!draft.documents?.identification) gaps.push("INE del titular");
                if (draft.personType === "Moral" && !draft.documents?.constitutive) gaps.push("acta constitutiva");
                if (draft.billingMode === "Factura a nombre del cliente" && !draft.documents?.fiscal) gaps.push("constancia de situación fiscal");
                return gaps;
            }
            function markDocumentReceived(type, input) {
                if (!input.files?.length) return;
                const checkbox = byId({ identification: "fDocIdentification", constitutive: "fDocConstitutive", fiscal: "fDocFiscal" }[type]);
                if (checkbox) checkbox.checked = true;
                syncRequestRequirements();
                flash(`${input.files[0].name} marcado como recibido en el expediente de la demo.`);
            }
            function syncRequestRequirements() {
                const draft = readRequestForm();
                const isMoral = draft.personType === "Moral";
                const needsFiscal = draft.billingMode === "Factura a nombre del cliente";
                byId("fConstituentDoc").style.display = isMoral ? "block" : "none";
                byId("fDocConstitutiveFile").style.display = isMoral ? "block" : "none";
                byId("moralPersonFields").style.display = isMoral ? "grid" : "none";
                byId("fFiscalDoc").style.display = needsFiscal ? "block" : "none";
                byId("fDocFiscalFile").style.display = needsFiscal ? "block" : "none";
                const gaps = requestGaps(draft);
                byId("requestRequirements").innerHTML = gaps.length ? `<b>Falta para autorizar:</b> ${esc(gaps.join(", "))}.` : "<b>Expediente completo.</b> Ya puede pasar a autorización.";
                renderApprovalPanel();
            }
            function startRequest() {
                state.ui.selectedRequestId = null;
                state.ui.selectedTenantId = null;
                state.ui.selectedContractId = null;
                state.ui.draft = { requestId: null, tenantId: null, boxId: "" };
                fillRequestForm(state.ui.draft);
                showView("form");
                history.replaceState({ view: "form" }, "", viewRoutes.form);
            }
            function openRequest(id) {
                const request = requestById(id);
                if (!request) return flash("No encontramos esa solicitud.");
                const tenant = tenantById(request.tenantId);
                state.ui.selectedRequestId = id;
                state.ui.selectedTenantId = tenant.id;
                state.ui.draft = formDraftFromTenant(tenant, request);
                fillRequestForm(state.ui.draft);
                showView("form");
            }
            function renderRequests() {
                const query = (byId("requestSearch")?.value || "").toLocaleLowerCase("es");
                const rows = state.requests.filter((request) => {
                    const tenant = tenantById(request.tenantId);
                    const box = boxById(request.boxId);
                    return `${request.folio} ${tenant?.name || ""} ${box?.code || ""}`.toLocaleLowerCase("es").includes(query);
                });
                byId("requestRows").innerHTML = rows.map((request) => {
                    const tenant = tenantById(request.tenantId);
                    const box = boxById(request.boxId);
                    const services = Object.entries(request.services || {}).map(([service, quantity]) => `${quantity} × ${service}`).join(", ") || (box ? `${box.code} · ${box.size}` : "Sin servicios");
                    return `<tr><td><b>${esc(request.folio)}</b></td><td><b>${esc(tenant?.name)}</b><br><small class="muted">${esc(tenant?.email)}</small></td><td>${esc(services)}</td><td class="muted">${esc(dateLabel(request.createdAt.slice(0, 10)))}</td><td>${badge(request.status)}</td><td><button class="btn outline" onclick="openRequest('${request.id}')">Abrir</button></td></tr>`;
                }).join("") || `<tr><td colspan="6" class="muted">No hay solicitudes con ese criterio.</td></tr>`;
            }
            function renderBoxes() {
                const status = byId("boxStatus").value;
                const size = byId("boxSize").value;
                const draft = state.ui.draft || {};
                byId("selectionMode").style.display = draft.requestId || Object.keys(draft).length ? "block" : "none";
                const filtered = state.boxes.filter((box) => (status === "Todas" || box.status === status) && (size === "Todas" || box.size === size));
                const totals = (boxStatus) => state.boxes.filter((box) => box.status === boxStatus).length;
                const available = totals("Disponible");
                byId("boxAvailableCount").textContent = available;
                byId("boxOccupiedCount").textContent = totals("Ocupada");
                byId("boxReservedCount").textContent = totals("Reservada");
                byId("boxAvailabilityRate").textContent = `${Math.round((available / Math.max(state.boxes.length, 1)) * 100)}%`;
                byId("availabilityMap").innerHTML = filtered.map((box) => `<button class="availability-slot availability-slot--${esc(box.status)} ${draft.boxId === box.id ? "chosen" : ""}" ${box.status !== "Disponible" ? "disabled" : ""} onclick="selectBox('${box.id}')" title="${esc(`${box.code} · ${box.area} · ${box.size} · ${box.status}`)}">${esc(box.code)}<small>${esc(box.size)} · ${esc(box.area)}</small></button>`).join("") || `<div class="empty">No hay cajas para estos filtros.</div>`;
                byId("boxGrid").innerHTML = filtered.map((box) => `<button class="box-card ${box.status === "Disponible" ? "available" : ""} ${draft.boxId === box.id ? "chosen" : ""}" ${box.status !== "Disponible" ? "disabled" : ""} onclick="selectBox('${box.id}')"><span class="tag ${tone(box.status)}">${esc(box.status)}</span><b>▣ ${esc(box.code)}</b><small class="muted">${esc(box.area)} · Tamaño ${esc(box.size)}</small><p style="margin:14px 0 0;border-top:1px solid #0000000b;padding-top:8px;font-size:12px">Renta base <strong style="float:right">${fmtCents(box.rentCents)}</strong></p></button>`).join("") || `<div class="empty">No hay cajas para este filtro.</div>`;
            }
            function selectBox(id) {
                const box = boxById(id);
                if (!box || box.status !== "Disponible") return flash("Esa caja ya no está disponible.");
                state.ui.draft = Object.assign({}, state.ui.draft || {}, { boxId: id });
                selected();
                persistState();
                flash(`Caja ${box.code} seleccionada.`);
                showView("form");
            }
            function selected() {
                const box = boxById(state.ui.draft?.boxId);
                const selectedBox = byId("selectedBox");
                const noBox = byId("noBox");
                if (!selectedBox || !noBox) return;
                selectedBox.style.display = box ? "block" : "none";
                noBox.style.display = box ? "none" : "block";
                if (box) selectedBox.innerHTML = `<b style="font-size:19px">${esc(box.code)}</b><p class="muted">${esc(box.area)} · Tamaño ${esc(box.size)}</p><strong>${fmtCents(box.rentCents)} / mes</strong>`;
            }
            function saveRequestForReview() {
                const draft = readRequestForm();
                if (!draft.name || !draft.email || !draft.phone) return flash("Completa nombre, correo y teléfono para guardar la solicitud.");
                let tenant = tenantById(draft.tenantId) || state.tenants.find((item) => item.email.toLocaleLowerCase() === draft.email.toLocaleLowerCase());
                if (tenant) Object.assign(tenant, draft, { id: tenant.id });
                else { tenant = Object.assign({}, draft, { id: createDemoId("tenant") }); state.tenants.push(tenant); }
                let request = requestById(draft.requestId);
                if (request) Object.assign(request, { tenantId: tenant.id, boxId: draft.boxId || null, services: draft.services, documents: draft.documents, status: request.status === "Aprobada" || request.status === "Denegada" ? request.status : "En revisión" });
                else {
                    const number = nextSequence(state.requests, "folio", 32);
                    request = { id: createDemoId("request"), folio: `SOL-${String(number).padStart(4, "0")}`, tenantId: tenant.id, boxId: draft.boxId || null, createdAt: new Date().toISOString(), status: "En revisión", contractId: null, services: draft.services, documents: draft.documents };
                    state.requests.unshift(request);
                }
                const authorization = state.authorizations.find((item) => item.tenantId === tenant.id && item.type !== "Personal de apoyo");
                if (draft.auth) {
                    if (authorization) Object.assign(authorization, { name: draft.auth, phone: draft.authPhone });
                    else state.authorizations.push({ id: createDemoId("auth"), tenantId: tenant.id, name: draft.auth, phone: draft.authPhone, type: "Autorizado" });
                }
                state.ui.selectedTenantId = tenant.id;
                state.ui.selectedRequestId = request.id;
                state.ui.draft = Object.assign({}, draft, { tenantId: tenant.id, requestId: request.id });
                logAudit("Envió solicitud a verificación", request.folio, "Correcto", false);
                persistState();
                fillRequestForm(state.ui.draft);
                flash("Solicitud guardada en revisión. Completa el expediente para autorizarla.");
            }
            function createRequest() { saveRequestForReview(); }
            function renderApprovalPanel() {
                const panel = byId("approvalPanel");
                const request = requestById(state.ui.selectedRequestId || state.ui.draft?.requestId);
                if (!panel) return;
                if (!request) {
                    panel.innerHTML = `<p class="muted" style="font-size:12px">Guarda la solicitud para habilitar la verificación y autorización.</p>`;
                    return;
                }
                const gaps = requestGaps(readRequestForm());
                const decision = request.status === "Aprobada" ? `<p class="notice"><b>Solicitud aprobada.</b> Arrendatario #${esc(tenantById(request.tenantId)?.catalogNumber || "—")} creado en el catálogo.${request.demoCompletedFields?.length ? `<br /><small>Datos simulados: ${esc(request.demoCompletedFields.join(", "))}.</small>` : ""}<br /><small>Autorizó ${esc(request.approvedBy || "—")} · ${esc(dateLabel(request.approvedAt?.slice(0, 10)))}</small></p>` : request.status === "Denegada" ? `<p class="notice"><b>Solicitud denegada.</b> ${esc(request.denialReason || "Sin motivo registrado.")}<br /><small>${esc(dateLabel(request.deniedAt?.slice(0, 10)))}</small></p>` : `<p class="muted" style="font-size:12px">${gaps.length ? "Al aprobar, los requisitos pendientes se completarán con datos de demostración." : "El expediente está listo para decisión."}</p><div style="display:grid;gap:10px"><button class="btn primary" onclick="approveRequest()">✓ Aprobar solicitud</button><button class="btn outline" onclick="denyRequest()">Denegar solicitud</button></div>`;
                panel.innerHTML = `<hr style="border:0;border-top:1px solid var(--line);margin:18px 0" /><p class="eyebrow">AUTORIZACIÓN</p><p style="margin:7px 0">${badge(request.status)}</p>${decision}`;
            }
            function completeDemoRequirements(draft) {
                const completed = [];
                const defaults = {
                    name: ["Cliente de demostración", "nombre"],
                    email: ["cliente@ejemplo.test", "correo"],
                    phone: ["999 000 0000", "teléfono"],
                    reference: ["Referencia de demostración", "referencia personal"],
                    referencePhone: ["999 000 0000", "teléfono de referencia"],
                };
                Object.entries(defaults).forEach(([key, [value, label]]) => {
                    if (!draft[key]) { draft[key] = value; completed.push(label); }
                });
                if (!draft.boxId && !Object.keys(draft.services || {}).length) {
                    draft.services = { "3 × 5": 1 };
                    completed.push("servicio de ejemplo");
                }
                draft.documents = { ...draft.documents };
                if (!draft.documents.identification) { draft.documents.identification = true; completed.push("identificación simulada"); }
                if (draft.personType === "Moral" && !draft.documents.constitutive) { draft.documents.constitutive = true; completed.push("acta constitutiva simulada"); }
                if (draft.billingMode === "Factura a nombre del cliente" && !draft.documents.fiscal) { draft.documents.fiscal = true; completed.push("constancia fiscal simulada"); }
                return completed;
            }
            async function approveRequest() {
                const request = requestById(state.ui.selectedRequestId || state.ui.draft?.requestId);
                const tenant = request && tenantById(request.tenantId);
                if (!request || !tenant) return flash("Guarda la solicitud antes de autorizarla.");
                if (["Aprobada", "Denegada"].includes(request.status)) return flash("Esta solicitud ya tiene una decisión registrada.");
                const draft = readRequestForm();
                const completed = completeDemoRequirements(draft);
                const previousState = clone(state);
                Object.assign(tenant, draft, { id: tenant.id });
                request.boxId = draft.boxId || null;
                request.services = draft.services;
                request.documents = draft.documents;
                request.demoCompletedFields = completed;
                request.status = "Aprobada";
                request.approvedAt = new Date().toISOString();
                request.approvedBy = CURRENT_USER.name;
                if (!tenant.catalogNumber) tenant.catalogNumber = state.tenants.reduce((maximum, item) => Math.max(maximum, Number(item.catalogNumber) || 0), 0) + 1;
                const authorization = state.authorizations.find((item) => item.tenantId === tenant.id && item.type !== "Personal de apoyo");
                if (draft.auth) {
                    if (authorization) Object.assign(authorization, { name: draft.auth, phone: draft.authPhone });
                    else state.authorizations.push({ id: createDemoId("auth"), tenantId: tenant.id, name: draft.auth, phone: draft.authPhone, type: "Autorizado" });
                }
                state.ui.selectedTenantId = tenant.id;
                state.ui.draft = Object.assign({}, draft, { tenantId: tenant.id, requestId: request.id });
                logAudit("Aprobó solicitud y creó arrendatario", `${request.folio} · #${tenant.catalogNumber}`, "Correcto", false);
                if (!persistState()) {
                    state = previousState;
                    return;
                }
                byId("tenantSearch").value = "";
                showView("tenants");
                const confirmation = `${tenant.name} se guardó en el catálogo de arrendatarios con el número #${tenant.catalogNumber}.${completed.length ? ` Se completaron datos simulados: ${completed.join(", ")}.` : ""}`;
                if (!window.Swal) return flash(confirmation);
                await window.Swal.fire({
                    title: "Solicitud aprobada",
                    text: confirmation,
                    icon: "success",
                    iconColor: "#168b62",
                    confirmButtonText: "Entendido",
                    buttonsStyling: false,
                    customClass: { popup: "saferoom-dialog" },
                });
            }
            async function denyRequest() {
                const request = requestById(state.ui.selectedRequestId);
                if (!request) return flash("Guarda la solicitud antes de denegarla.");
                const { isConfirmed, value: reason } = await window.Swal.fire({
                    title: "Denegar solicitud",
                    text: "El motivo quedará registrado en el expediente.",
                    icon: "warning",
                    iconColor: "#d5a500",
                    input: "textarea",
                    inputLabel: "Motivo de la denegación",
                    inputPlaceholder: "Describe el motivo de la decisión",
                    inputValue: request.denialReason || "",
                    inputAttributes: { maxlength: "180" },
                    inputValidator: (value) => !value.trim() ? "Escribe el motivo para continuar." : undefined,
                    showCancelButton: true,
                    confirmButtonText: "Denegar solicitud",
                    cancelButtonText: "Cancelar",
                    reverseButtons: true,
                    buttonsStyling: false,
                    customClass: { popup: "saferoom-dialog" },
                });
                if (!isConfirmed) return;
                request.status = "Denegada";
                request.denialReason = reason.trim().slice(0, 180);
                request.deniedAt = new Date().toISOString();
                logAudit("Denegó solicitud", request.folio, "Correcto", false);
                persistState();
                renderApprovalPanel();
                flash("Solicitud denegada; se conserva el motivo en el expediente.");
            }
            function chooseBoxForDraft() {
                state.ui.draft = readRequestForm();
                persistState();
                showView("boxes");
            }
            function startNewContract() {
                state.ui.selectedTenantId = null;
                state.ui.selectedRequestId = null;
                state.ui.selectedContractId = null;
                showView("contract");
            }
            function contractTab(tab) {
                document.querySelectorAll("[data-contract-tab]").forEach((button) => {
                    const selected = button.dataset.contractTab === tab;
                    button.classList.toggle("on", selected);
                    button.setAttribute("aria-selected", String(selected));
                });
                document.querySelectorAll("[data-contract-panel]").forEach((panel) => { panel.hidden = panel.dataset.contractPanel !== tab; });
            }
            function populateContract() {
                const request = requestById(state.ui.selectedRequestId);
                const selectedId = state.ui.selectedTenantId || (request?.status === "Aprobada" ? request.tenantId : "");
                const tenantSelect = byId("cTenant");
                tenantSelect.innerHTML = `<option value="">Selecciona un arrendatario</option>${state.tenants.filter((tenant) => tenant.catalogNumber).map((tenant) => `<option value="${esc(tenant.id)}">#${esc(tenant.catalogNumber)} · ${esc(tenant.name)} · ${esc(tenant.email || "")}</option>`).join("")}`;
                tenantSelect.value = selectedId || "";
                if (window.initialiseContractTenantSelect) window.initialiseContractTenantSelect();
                selectContractTenant(tenantSelect.value);
            }
            function selectContractTenant(tenantId) {
                const tenant = tenantById(tenantId);
                byId("contractEmpty").style.display = tenant ? "none" : "";
                byId("contractWorkspace").style.display = tenant ? "" : "none";
                state.ui.selectedTenantId = tenant?.id || null;
                if (!tenant) { state.ui.selectedRequestId = null; return; }
                const approvedRequests = state.requests.filter((item) => item.tenantId === tenant.id && item.status === "Aprobada" && !item.contractId);
                const request = approvedRequests.find((item) => item.id === state.ui.selectedRequestId) || approvedRequests[0];
                state.ui.selectedRequestId = request?.id || null;
                byId("contractRequestLabel").textContent = request ? `Solicitud ${request.folio} · aprobada` : "Arrendatario del catálogo · sin solicitud pendiente de contrato";
                const availableBoxes = state.boxes.filter((box) => box.status === "Disponible");
                byId("cBox").innerHTML = `<option value="">Selecciona una caja</option>${availableBoxes.map((box) => `<option value="${esc(box.id)}">${esc(box.code)} · ${esc(box.area)} · ${esc(box.size)}</option>`).join("")}`;
                byId("cBox").value = availableBoxes.some((box) => box.id === request?.boxId) ? request.boxId : "";
                const today = reportDateValue(new Date());
                ["cStart", "cPaymentDate", "cPrintDate"].forEach((id) => { byId(id).value = today; refreshSafeDate(byId(id)); });
                byId("cKeysConfirmed").checked = false;
                byId("cReviewConfirmed").checked = false;
                updateContractDates();
                updateContractBox();
                renderContractTenantDetails(tenant, request);
                contractTab("conditions");
            }
            window.selectContractTenant = selectContractTenant;
            function updateContractBox() {
                const box = boxById(byId("cBox").value);
                byId("rent").value = box ? (box.rentCents / 100).toFixed(2) : "";
                byId("deposit").value = box ? (box.rentCents / 100).toFixed(2) : "";
                calc();
            }
            function renderContractTenantDetails(tenant, request) {
                const fields = [["Nombre", tenant.name], ["Correo", tenant.email], ["Teléfono", tenant.phone], ["Tipo de persona", tenant.personType], ["RFC", tenant.rfc], ["CURP", tenant.curp], ["Nacimiento", tenant.birthDate], ["Lugar de nacimiento", tenant.birthPlace], ["Género", tenant.gender], ["Nacionalidad", tenant.nationality], ["Estado civil", tenant.civilStatus], ["Cónyuge", tenant.spouseName], ["Régimen matrimonial", tenant.maritalRegime], ["Origen", tenant.source], ["Calle", tenant.street], ["Colonia", tenant.neighborhood], ["Código postal", tenant.postalCode], ["Municipio", tenant.municipality], ["Estado", tenant.state], ["Tiempo de residencia", tenant.residenceTime], ["Teléfono de casa", tenant.homePhone], ["Otro teléfono", tenant.otherPhone], ["Referencia", tenant.reference], ["Teléfono de referencia", tenant.referencePhone], ["Segunda referencia", tenant.referenceTwo], ["Teléfono de segunda referencia", tenant.referenceTwoPhone], ["Empresa", tenant.company], ["Puesto", tenant.jobTitle], ["Ocupación", tenant.workType], ["RFC laboral", tenant.workRfc], ["Teléfono laboral", tenant.workPhone], ["Inicio laboral", tenant.workStartDate], ["Domicilio laboral", tenant.workAddress], ["Facturación", tenant.billingMode], ["Régimen fiscal", tenant.taxRegime], ["Uso CFDI", tenant.cfdiUse], ["Correo de facturación", tenant.billingEmail], ["Notario", tenant.notaryPublic], ["Número de notario", tenant.notaryNumber], ["Acta constitutiva", tenant.constitutiveAct], ["Volumen", tenant.constitutiveVolume], ["Libro", tenant.constitutiveBook], ["Fecha del acta", tenant.constitutiveDate]];
                const latestRequest = request || state.requests.find((item) => item.tenantId === tenant.id);
                if (latestRequest) fields.push(["Solicitud", latestRequest.folio], ["Estado de solicitud", latestRequest.status], ["Servicios solicitados", Object.entries(latestRequest.services || {}).map(([size, count]) => `${count} × ${size}`).join(", ")]);
                byId("contractProfile").innerHTML = fields.filter(([, value]) => value).map(([label, value]) => `<div><span>${esc(label)}</span><b>${esc(value)}</b></div>`).join("") || '<p class="muted">Sin datos adicionales.</p>';
                const people = state.authorizations.filter((item) => item.tenantId === tenant.id);
                const personRows = (items) => items.map((person) => `<div class="activity"><span><b>${esc(person.name)}</b><br><small class="muted">${esc(person.phone || "Sin teléfono")}</small></span><span class="tag green">Autorizado</span></div>`).join("") || '<p class="muted">No hay personas registradas.</p>';
                byId("contractAuthorizations").innerHTML = personRows(people.filter((person) => person.type !== "Personal de apoyo"));
                byId("contractSupport").innerHTML = personRows(people.filter((person) => person.type === "Personal de apoyo"));
                byId("supportName").value = ""; byId("supportPhone").value = "";
                const docs = latestRequest?.documents || {};
                byId("contractDocuments").innerHTML = [["Identificación", docs.identification], ["Acta constitutiva", docs.constitutive], ["Constancia fiscal", docs.fiscal]].map(([label, received]) => `<div class="summary-row"><span>${label}</span><b>${received ? "Registrado en demo" : "No registrado"}</b></div>`).join("");
                const contracts = contractsForTenant(tenant.id);
                const entries = contracts.flatMap((contract) => [{ date: contract.createdAt || contract.startDate, title: contract.folio, detail: `${boxById(contract.boxId)?.code || "Sin caja"} · ${contract.status} · ${dateLabel(contract.startDate)} a ${dateLabel(contract.endDate)}` }, ...state.operations.filter((operation) => operation.contractId === contract.id).map((operation) => ({ date: operation.occurredAt, title: operation.type, detail: operation.detail || contract.folio }))]);
                const requests = state.requests.filter((item) => item.tenantId === tenant.id);
                requests.forEach((item) => entries.push({ date: item.createdAt, title: item.folio, detail: `Solicitud · ${item.status}` }));
                const relatedFolios = [...requests.map((item) => item.folio), ...contracts.map((item) => item.folio)];
                state.auditLog.filter((item) => item.entity && (item.entity.includes(tenant.name) || relatedFolios.some((folio) => item.entity.includes(folio)))).forEach((item) => entries.push({ date: item.occurredAt, title: item.action, detail: `${item.entity} · ${item.user}` }));
                entries.sort((a, b) => String(b.date).localeCompare(String(a.date)));
                byId("contractHistory").innerHTML = entries.map((entry) => `<div class="activity"><span><b>${esc(entry.title)}</b><br><small class="muted">${esc(entry.detail)}</small></span><small class="muted">${esc(dateLabel(String(entry.date).slice(0, 10)))}</small></div>`).join("") || '<p class="muted">Este arrendatario aún no tiene contratos registrados.</p>';
            }
            function addContractSupport() {
                const tenant = tenantById(byId("cTenant").value);
                const name = byId("supportName").value.trim().slice(0, 90);
                const phone = byId("supportPhone").value.trim().slice(0, 30);
                if (!tenant || !name) return flash("Indica el nombre de la persona de apoyo.");
                if (state.authorizations.some((person) => person.tenantId === tenant.id && person.name.toLocaleLowerCase() === name.toLocaleLowerCase())) return flash("Esta persona ya está registrada para el arrendatario.");
                const previousState = clone(state);
                state.authorizations.push({ id: createDemoId("auth"), tenantId: tenant.id, name, phone, type: "Personal de apoyo" });
                logAudit("Autorizó personal de apoyo", `${tenant.name} · ${name}`, "Correcto", false);
                if (!persistState()) { state = previousState; return; }
                renderContractTenantDetails(tenant, requestById(state.ui.selectedRequestId));
                flash("Personal de apoyo autorizado en la demo.");
            }
            function updateContractDates() {
                const duration = Number(byId("cDuration").value.split(" ")[0]) || 12;
                byId("cEnd").value = addMonthsMinusOne(byId("cStart").value, duration);
                refreshSafeDate(byId("cEnd"));
            }
            function calc() {
                const rentCents = Math.round((Number(byId("rent").value) || 0) * 100);
                const depositCents = Math.round((Number(byId("deposit").value) || 0) * 100);
                const taxCents = Math.round(rentCents * 0.16);
                byId("sumRent").textContent = fmtCents(rentCents);
                byId("sumDeposit").textContent = fmtCents(depositCents);
                byId("sumIva").textContent = fmtCents(taxCents);
                byId("sumTotal").textContent = fmtCents(rentCents + depositCents + taxCents);
            }
            function contractInputError() {
                const tenant = tenantById(byId("cTenant").value);
                const box = boxById(byId("cBox").value);
                if (!tenant?.catalogNumber) return "Selecciona un arrendatario del catálogo.";
                if (!box || box.status !== "Disponible") return "Selecciona una caja disponible.";
                if (!["cStart", "cEnd", "cPaymentDate", "cPrintDate"].every((id) => byId(id).value)) return "Completa las fechas del contrato.";
                if (byId("cEnd").value < byId("cStart").value) return "El vencimiento no puede ser anterior al inicio.";
                if (!byId("rent").value || Number(byId("rent").value) <= 0 || byId("deposit").value === "" || Number(byId("deposit").value) < 0) return "Indica una renta mayor a cero y una garantía válida.";
                if (!byId("cKeysConfirmed").checked || !byId("cReviewConfirmed").checked) return "Confirma la revisión del contrato y la entrega simulada de llaves.";
                return "";
            }
            let contractInvoices = [];
            function contractInvoiceTotals() {
                const rent = Math.round((Number(byId("rent").value) || 0) * 100);
                const guarantee = Math.round((Number(byId("deposit").value) || 0) * 100);
                const tax = Math.round(rent * 0.16);
                return { tax, total: rent + guarantee + tax };
            }
            function contractInvoiceAllocations() {
                const { total, tax } = contractInvoiceTotals();
                let cumulative = 0;
                let previousTax = 0;
                return contractInvoices.map((invoice) => {
                    cumulative += invoice.amountCents;
                    const cumulativeTax = total ? Math.round(tax * cumulative / total) : 0;
                    const taxCents = cumulativeTax - previousTax;
                    previousTax = cumulativeTax;
                    return { ...invoice, taxCents, subtotalCents: invoice.amountCents - taxCents };
                });
            }
            function renderContractInvoices() {
                const { total } = contractInvoiceTotals();
                const allocated = contractInvoices.reduce((sum, invoice) => sum + invoice.amountCents, 0);
                byId("contractInvoiceRows").innerHTML = contractInvoiceAllocations().map((invoice, index) => `<tr><td>${invoice.profile === "tenant" ? "Arrendatario" : "Público general"}</td><td>${esc(invoice.method)}</td><td>${fmtCents(invoice.subtotalCents)}</td><td>${fmtCents(invoice.taxCents)}</td><td><b>${fmtCents(invoice.amountCents)}</b></td><td><button class="btn outline" type="button" onclick="removeContractInvoice(${index})" aria-label="Quitar factura ${index + 1}">Quitar</button></td></tr>`).join("") || '<tr><td colspan="6" class="muted">Agrega al menos una factura.</td></tr>';
                byId("contractInvoiceAllocated").textContent = fmtCents(allocated);
                byId("contractInvoiceRemaining").textContent = fmtCents(total - allocated);
                byId("contractInvoiceAmount").value = ((total - allocated) / 100).toFixed(2);
            }
            function contractInvoiceError(message = "") {
                const target = byId("contractInvoiceError");
                target.hidden = !message;
                target.textContent = message;
            }
            function addContractInvoice() {
                const tenant = tenantById(byId("cTenant").value);
                const profile = byId("contractInvoiceProfile").value;
                const amountCents = Math.round(Number(byId("contractInvoiceAmount").value) * 100);
                const remaining = contractInvoiceTotals().total - contractInvoices.reduce((sum, invoice) => sum + invoice.amountCents, 0);
                if (profile === "tenant" && (!tenant?.rfc || !tenant.taxRegime || !tenant.billingEmail)) return contractInvoiceError("El perfil del arrendatario requiere RFC, régimen fiscal y correo de facturación. Puedes usar Público general.");
                if (!Number.isSafeInteger(amountCents) || amountCents <= 0) return contractInvoiceError("Indica un importe mayor a cero.");
                if (amountCents > remaining) return contractInvoiceError("El importe supera el saldo pendiente por facturar.");
                contractInvoices.push({ profile, method: byId("contractInvoiceMethod").value, amountCents });
                contractInvoiceError();
                renderContractInvoices();
            }
            function removeContractInvoice(index) {
                contractInvoices.splice(index, 1);
                contractInvoiceError();
                renderContractInvoices();
            }
            function requestContractConfirmation() {
                const error = contractInputError();
                if (error) return flash(error);
                const tenant = tenantById(byId("cTenant").value);
                const box = boxById(byId("cBox").value);
                const { total } = contractInvoiceTotals();
                contractInvoices = [];
                byId("contractInvoiceProfile").value = "general";
                byId("contractInvoiceMethod").value = byId("cPaymentMethod").value;
                byId("contractConfirmSummary").innerHTML = `<span><b>${esc(tenant.name)}</b><br><small>Caja ${esc(box.code)} · ${esc(byId("cStart").value)} a ${esc(byId("cEnd").value)}</small></span><span>Total por facturar<br><strong>${fmtCents(total)}</strong></span>`;
                contractInvoiceError();
                renderContractInvoices();
                byId("contractConfirm").classList.add("on");
            }
            let isSavingContract = false;
            function saveContract() {
                if (isSavingContract) return;
                const error = contractInputError();
                if (error) { closeContractConfirmation(); return flash(error); }
                const tenant = tenantById(byId("cTenant").value);
                const box = boxById(byId("cBox").value);
                const allocations = contractInvoiceAllocations();
                if (!allocations.length || allocations.reduce((sum, invoice) => sum + invoice.amountCents, 0) !== contractInvoiceTotals().total) return contractInvoiceError("Agrega facturas hasta cubrir exactamente el total por facturar.");
                if (allocations.some((invoice) => invoice.profile === "tenant") && (!tenant.rfc || !tenant.taxRegime || !tenant.billingEmail)) return contractInvoiceError("El perfil del arrendatario requiere RFC, régimen fiscal y correo de facturación.");
                const request = requestById(state.ui.selectedRequestId);
                if (request && (request.tenantId !== tenant.id || request.status !== "Aprobada" || request.contractId)) return flash("La solicitud ya no está disponible para este contrato.");
                isSavingContract = true;
                const previousState = clone(state);
                const number = nextSequence(state.contracts, "folio", 149);
                const paymentDate = byId("cPaymentDate").value;
                const contract = { id: createDemoId("contract"), folio: `CT-${new Date().getFullYear()}-${String(number).padStart(4, "0")}`, tenantId: tenant.id, boxId: box.id, startDate: byId("cStart").value, endDate: byId("cEnd").value, paymentDate, printDate: byId("cPrintDate").value, durationMonths: Number(byId("cDuration").value.split(" ")[0]) || 12, rentCents: Math.round(Number(byId("rent").value) * 100), depositCents: Math.round(Number(byId("deposit").value) * 100), paymentDay: Number(paymentDate.slice(-2)), paymentMethod: new Set(allocations.map((invoice) => invoice.method)).size === 1 ? allocations[0].method : "Varias", status: "Activo", createdAt: new Date().toISOString() };
                state.contracts.push(contract);
                if (request) { request.contractId = contract.id; request.boxId = box.id; request.status = "Contratada"; }
                box.status = "Ocupada";
                allocations.forEach((invoice) => {
                    const folio = `F-${new Date().getFullYear()}-${String(nextSequence(state.movements, "folio", 1637)).padStart(4, "0")}`;
                    state.movements.unshift({ id: createDemoId("movement"), folio, tenantId: contract.tenantId, contractId: contract.id, concept: "Renta, IVA estimado y garantía", method: invoice.method, profile: invoice.profile, subtotalCents: invoice.subtotalCents, taxCents: invoice.taxCents, amountCents: invoice.amountCents, type: "Factura", status: "Simulada", occurredAt: contract.paymentDate });
                });
                ["Contrato de arrendamiento", "Constancia de entrega de llaves", "Recibo de depósito en garantía"].forEach((type, index) => state.documents.push({ id: createDemoId("document"), contractId: contract.id, type, folio: `DOC-${contract.folio.slice(-4)}-${index + 1}`, createdAt: contract.printDate }));
                state.operations.unshift({ id: createDemoId("operation"), contractId: contract.id, type: "Contrato generado", occurredAt: new Date().toISOString(), detail: `Caja ${box.code}` });
                state.ui.selectedContractId = contract.id; state.ui.selectedTenantId = contract.tenantId; state.ui.draft = null;
                logAudit("Generó contrato", contract.folio, "Correcto", false);
                if (!persistState()) { state = previousState; isSavingContract = false; closeContractConfirmation(); return; }
                closeContractConfirmation(); isSavingContract = false;
                showView("tenant");
                flash(`Contrato ${contract.folio} guardado con ${allocations.length} factura${allocations.length === 1 ? "" : "s"} simulada${allocations.length === 1 ? "" : "s"}.`);
            }
            function openTenant(tenantId, tab = "Resumen") {
                const tenant = tenantById(tenantId);
                if (!tenant) return flash("No encontramos ese arrendatario.");
                state.ui.selectedTenantId = tenantId;
                const contract = contractsForTenant(tenantId).find(isOpenContract) || contractsForTenant(tenantId)[0];
                if (contract) state.ui.selectedContractId = contract.id;
                persistState();
                showView("tenant", { tab });
            }
            function openContract(contractId, destination = "tenant") {
                const contract = contractById(contractId);
                if (!contract) return flash("No encontramos ese contrato.");
                state.ui.selectedContractId = contractId;
                state.ui.selectedTenantId = contract.tenantId;
                persistState();
                showView(destination);
            }
            function renderTenants() {
                const query = (byId("tenantSearch")?.value || "").toLocaleLowerCase("es");
                const rows = state.tenants.filter((tenant) => tenant.catalogNumber).filter((tenant) => {
                    const contract = contractsForTenant(tenant.id).find(isOpenContract) || contractsForTenant(tenant.id)[0];
                    const box = contract && boxById(contract.boxId);
                    return `${tenant.name} ${tenant.rfc || ""} ${contract?.folio || ""} ${box?.code || ""}`.toLocaleLowerCase("es").includes(query);
                });
                byId("tenantRows").innerHTML = rows.map((tenant) => {
                    const contract = contractsForTenant(tenant.id).find(isOpenContract) || contractsForTenant(tenant.id)[0];
                    const box = contract && boxById(contract.boxId);
                    const status = contract?.status || "Sin contrato";
                    return `<tr><td><b>#${esc(tenant.catalogNumber)} · ${esc(tenant.name)}</b><br><small class="muted">${esc(tenant.rfc || "Sin RFC")}</small></td><td>${esc(box ? `${box.code} · ${box.size}` : "Sin caja activa")}</td><td>${esc(contract?.folio || "—")}</td><td>${esc(dateLabel(contract?.endDate))}</td><td>${badge(status)}</td><td><button class="btn outline" onclick="openTenant('${tenant.id}')">Ver ficha</button>${isOpenContract(contract) ? ` <button class="btn outline" onclick="openContract('${contract.id}', 'renewals')">Renovar</button>` : ""}</td></tr>`;
                }).join("") || `<tr><td colspan="6" class="muted">No hay arrendatarios con ese criterio.</td></tr>`;
            }
            function renderContracts() {
                byId("contractRows").innerHTML = state.contracts.map((contract) => {
                    const tenant = tenantById(contract.tenantId);
                    const box = boxById(contract.boxId);
                    const invoice = state.movements.find((movement) => movement.contractId === contract.id && movement.type === "Factura");
                    return `<tr><td><b>${esc(contract.folio)}</b></td><td>${esc(tenant?.name)}</td><td>${esc(box?.code || "Sin caja")}</td><td>${esc(`${dateLabel(contract.startDate)} · ${dateLabel(contract.endDate)}`)}</td><td>${invoice ? badge(invoice.status) : "—"}</td><td>${badge(contract.status)}<br><button class="btn outline" style="margin-top:8px" onclick="openContract('${contract.id}')">Abrir</button>${isOpenContract(contract) ? ` <button class="btn outline" style="margin-top:8px" onclick="openContract('${contract.id}', 'renewals')">Renovar</button>` : ""}</td></tr>`;
                }).join("") || `<tr><td colspan="6" class="muted">No hay contratos.</td></tr>`;
            }
            function renderTenant(tab = currentTenantTab, options = {}) {
                const tenant = selectedTenant();
                if (!tenant) return;
                const contract = contractsForTenant(tenant.id).find((item) => item.id === state.ui.selectedContractId) || contractsForTenant(tenant.id).find(isOpenContract) || contractsForTenant(tenant.id)[0];
                if (contract) state.ui.selectedContractId = contract.id;
                byId("tenantName").textContent = tenant.name;
                byId("tenantInitials").textContent = tenant.name.split(" ").slice(0, 2).map((part) => part[0]).join("");
                byId("tenantContract").textContent = contract ? `Arrendatario · ${contract.folio} · ${contract.status}` : "Arrendatario · Sin contrato activo";
                tenantTab(tenantTabs.includes(tab) ? tab : "Resumen", Array.from(document.querySelectorAll("#tenantTabs button")).find((button) => button.textContent.trim() === tab), { sync: options.sync !== false });
            }
            function tenantTab(tab, button, options = {}) {
                if (!tenantTabs.includes(tab)) tab = "Resumen";
                currentTenantTab = tab;
                const tenant = selectedTenant();
                const contracts = contractsForTenant(tenant.id);
                const contract = contracts.find((item) => item.id === state.ui.selectedContractId) || contracts.find(isOpenContract) || contracts[0];
                const box = contract && boxById(contract.boxId);
                document.querySelectorAll("#tenantTabs button").forEach((item) => item.classList.remove("on"));
                (button || document.querySelector("#tenantTabs button")).classList.add("on");
                byId("tenantSectionTitle").textContent = tab === "Resumen" ? "Información de contacto" : tab;
                const field = (label, value) => `<div class="field"><label>${esc(label)}</label><input value="${esc(value || "Sin registro")}" readonly /></div>`;
                const table = (headers, rows) => `<div class="table-wrap wide"><table><thead><tr>${headers.map((header) => `<th>${esc(header)}</th>`).join("")}</tr></thead><tbody>${rows.length ? rows.map((row) => `<tr>${row.map((cell) => `<td>${cell}</td>`).join("")}</tr>`).join("") : `<tr><td colspan="${headers.length}" class="muted">Sin registros relacionados.</td></tr>`}</tbody></table></div>`;
                const authorizations = state.authorizations.filter((item) => item.tenantId === tenant.id);
                const invoices = state.movements.filter((item) => item.tenantId === tenant.id && item.type === "Factura");
                const documents = state.documents.filter((item) => contracts.some((contractItem) => contractItem.id === item.contractId));
                const events = state.accessEvents.filter((item) => item.tenantId === tenant.id);
                const content = {
                    Resumen: field("CORREO", tenant.email) + field("TELÉFONO", tenant.phone) + field("RFC", tenant.rfc) + field("CONTRATO ACTIVO", contract?.folio) + field("CAJA ACTIVA", box?.code),
                    Generales: field("CURP", tenant.curp) + field("FECHA DE NACIMIENTO", tenant.birthDate) + field("SEXO", tenant.gender) + field("NACIONALIDAD", tenant.nationality) + field("ESTADO CIVIL", tenant.civilStatus) + field("CÓMO SE ENTERÓ", tenant.source),
                    Domicilio: field("CALLE Y NÚMERO", tenant.street) + field("COLONIA", tenant.neighborhood) + field("CÓDIGO POSTAL", tenant.postalCode) + field("MUNICIPIO", tenant.municipality) + field("ESTADO", tenant.state) + field("REFERENCIA", tenant.reference),
                    "Laboral y fiscal": field("EMPRESA / RAZÓN SOCIAL", tenant.company) + field("PUESTO / ACTIVIDAD", tenant.jobTitle) + field("RÉGIMEN FISCAL", tenant.taxRegime) + field("USO CFDI", tenant.cfdiUse) + field("CORREO DE FACTURACIÓN", tenant.billingEmail),
                    Autorizados: table(["Persona", "Teléfono", "Tipo"], authorizations.map((item) => [esc(item.name), esc(item.phone), badge(item.type)])),
                    Cajas: table(["Caja", "Tamaño", "Estado", "Contrato"], contracts.map((item) => { const assignedBox = boxById(item.boxId); return [esc(assignedBox?.code), esc(assignedBox?.size), badge(assignedBox?.status || "Sin caja"), esc(item.folio)]; })),
                    Contratos: table(["Folio", "Vigencia", "Renta", "Estado"], contracts.map((item) => [esc(item.folio), esc(`${dateLabel(item.startDate)} a ${dateLabel(item.endDate)}`), esc(fmtCents(item.rentCents)), badge(item.status)])),
                    Facturas: table(["Folio", "Contrato", "Perfil", "Pago", "Subtotal", "IVA", "Total", "Estado"], invoices.map((item) => [esc(item.folio), esc(contractById(item.contractId)?.folio || "—"), esc(item.profile === "tenant" ? "Arrendatario" : item.profile === "general" ? "Público general" : "No especificado"), esc(item.method), item.subtotalCents == null ? "—" : esc(fmtCents(item.subtotalCents)), item.taxCents == null ? "—" : esc(fmtCents(item.taxCents)), esc(fmtCents(item.amountCents)), badge(item.status)])),
                    Documentos: table(["Folio", "Documento", "Fecha", ""], documents.map((item) => [esc(item.folio), esc(item.type), esc(dateLabel(item.createdAt)), `<button class="btn outline" onclick="state.ui.selectedContractId='${item.contractId}';previewDocument('${esc(item.type)}')">Vista previa</button>`])),
                    Accesos: table(["Fecha", "Movimiento", "Resultado", "Motivo"], events.map((item) => [esc(dateLabel(item.occurredAt.slice(0, 10))), esc(item.direction), badge(item.status), esc(item.reason || "—")])),
                };
                byId("tenantMain").innerHTML = content[tab];
                byId("tenantBox").innerHTML = box ? `<b style="font-size:20px">▣ ${esc(box.code)}</b><p class="muted">${esc(box.area)} · Tamaño ${esc(box.size)}</p><div class="summary-row"><span>Renta mensual</span><b>${fmtCents(contract.rentCents)}</b></div><div class="summary-row"><span>Llaves</span><b>${box.keys} de ${box.keys}</b></div>${isOpenContract(contract) ? `<button class="btn outline" style="margin-top:14px" onclick="openContract('${contract.id}', 'renewals')">Renovar o cambiar caja</button>` : ""}` : `<div class="empty">No tiene una caja activa.</div>`;
                if (options.sync !== false) showView("tenant", { sync: true, scroll: false, tab });
            }
            function renderHome() {
                const occupied = state.boxes.filter((box) => box.status === "Ocupada").length;
                const total = state.boxes.length;
                const today = new Date().toISOString().slice(0, 10);
                const inThirtyDays = new Date(Date.now() + (30 * 86400000)).toISOString().slice(0, 10);
                byId("occupancy").textContent = `${Math.round((occupied / total) * 100)}%`;
                byId("occDetail").textContent = `${occupied} de ${total} cajas ocupadas`;
                byId("contractsCount").textContent = activeContracts().length;
                byId("upcomingCount").textContent = activeContracts().filter((contract) => contract.endDate >= today && contract.endDate <= inThirtyDays).length;
                byId("accessesToday").textContent = state.accessEvents.filter((event) => event.occurredAt.slice(0, 10) === today).length;
                const activity = state.auditLog.slice(0, 3).map((item) => `<div class="activity"><span><b>${esc(item.action)}</b><br><small class="muted">${esc(item.entity)}</small></span><small class="muted">${esc(dateLabel(item.occurredAt.slice(0, 10)))}</small></div>`).join("") || `<div class="empty">Aún no hay actividad en esta sesión.</div>`;
                byId("recentActivity").innerHTML = `<div class="panel-head"><div><b>Actividad reciente</b><p class="muted">Operación del día</p></div><button class="btn outline" onclick="showView('requests')">Ver solicitudes</button></div>${activity}`;
                byId("statusBars").innerHTML = ["Disponible", "Ocupada", "Reservada", "Mantenimiento"].map((status) => { const count = state.boxes.filter((box) => box.status === status).length; return `<div class="summary-row"><span>${esc(status)}</span><b>${count}</b></div>`; }).join("");
                const availability = Math.round((state.boxes.filter((box) => box.status === "Disponible").length / Math.max(total, 1)) * 100);
                const limit = Number(String(state.settings?.availabilityLimit || "25").replace(/[^0-9.]/g, "")) || 0;
                const alertTarget = byId("availabilityAlertBanner");
                if (alertTarget) {
                    alertTarget.innerHTML = state.settings?.availabilityAlert === "Activa" && availability <= limit
                        ? `<p class="notice"><b>Alerta de disponibilidad:</b> ${esc(state.settings.availabilityMessage || "Disponibilidad de cajas por debajo del límite")} (${availability}% disponible).</p>`
                        : `<p class="muted">Disponibilidad actual: ${availability}%. Las alertas operativas están ${state.settings?.availabilityAlert === "Activa" ? "activas" : "inactivas"}.</p>`;
                }
            }
            function logAudit(action, entity, result = "Correcto", save = true) {
                state.auditLog.unshift({ id: createDemoId("audit"), occurredAt: new Date().toISOString(), user: CURRENT_USER.name, action, entity, result });
                if (save) persistState();
                if (byId("auditRows")) renderAuditLog();
            }
            function renderAuditLog() {
                const target = byId("auditRows");
                if (target) target.innerHTML = state.auditLog.map((item) => `<tr><td>${esc(new Intl.DateTimeFormat("es-MX", { dateStyle: "short", timeStyle: "short" }).format(new Date(item.occurredAt)))}</td><td>${esc(item.user)}</td><td>${esc(item.action)}</td><td>${esc(item.entity)}</td><td>${badge(item.result)}</td></tr>`).join("");
            }
            function accessContext(item) {
                const tenant = tenantById(item.tenantId);
                const contract = contractById(item.contractId);
                const box = contract && boxById(contract.boxId);
                const authorization = item.authorizationId && state.authorizations.find((record) => record.id === item.authorizationId);
                const type = authorization ? "Autorizado" : "Titular";
                const name = authorization?.name || tenant?.name || "Persona no identificada";
                const valid = Boolean(tenant && contract && isOpenContract(contract) && box?.status === "Ocupada" && (!authorization || authorization.tenantId === tenant.id));
                return { tenant, contract, box, authorization, type, name, valid };
            }
            let signaturePad = null;
            function accessElapsedLabel(occurredAt, status = "Confirmado") {
                const elapsedSeconds = Math.max(0, Math.floor((Date.now() - new Date(occurredAt).getTime()) / 1000));
                const hours = Math.floor(elapsedSeconds / 3600);
                const minutes = Math.floor((elapsedSeconds % 3600) / 60);
                const seconds = elapsedSeconds % 60;
                const duration = hours ? `${hours} h ${String(minutes).padStart(2, "0")} min` : `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
                return `Dentro · ${duration}`;
            }
            function updateAccessElapsedTimers() {
                document.querySelectorAll("[data-access-start]").forEach((element) => {
                    element.textContent = accessElapsedLabel(element.dataset.accessStart, element.dataset.accessStatus);
                });
            }
            function renderAccessQueue() {
                const target = byId("accessQueue");
                if (!target) return;
                const query = (byId("accessSearch")?.value || "").toLocaleLowerCase("es");
                const filter = byId("accessFilter")?.value || "Todas";
                const items = state.accessQueue.filter((item) => {
                    const context = accessContext(item);
                    return !["Confirmado", "Rechazado", "Autorizado para C4", "Concedido por C4", "Acceso remoto registrado", "Retirado por C4"].includes(item.status) && (filter === "Todas" || context.type === filter) && `${context.name} ${context.box?.code || ""}`.toLocaleLowerCase("es").includes(query);
                });
                target.innerHTML = items.map((item) => { const context = accessContext(item); return `<div class="activity"><span><b>${esc(context.name)}</b><br><small class="muted">${esc(context.box?.code || "Sin caja")} · ${esc(context.type)} · ${esc(context.contract?.folio || "Sin contrato")}</small></span><span>${badge(item.status)} <button class="btn primary" style="margin-left:8px" onclick="selectAccess('${item.id}')">Validar</button></span></div>`; }).join("") || `<div class="empty">No hay accesos pendientes con esos filtros.</div>`;
                renderAccessExitQueue();
            }
            function renderAccessExitQueue() {
                const target = byId("accessExitQueue");
                if (!target) return;
                const entries = state.accessEvents.filter((event) => event.direction === "Entrada" && event.status === "Confirmado" && !state.accessEvents.some((exit) => exit.direction === "Salida" && exit.entryId === event.id));
                target.innerHTML = entries.map((entry) => {
                    const context = accessContext({ tenantId: entry.tenantId, contractId: entry.contractId, authorizationId: entry.authorizationId });
                    return `<div class="activity"><span><b>${esc(context.name)}</b><br><small class="muted">${esc(context.box?.code || "Sin caja")} · Entrada ${esc(new Date(entry.occurredAt).toLocaleTimeString("es-MX", { hour: "2-digit", minute: "2-digit" }))}</small><br /><span class="access-elapsed" data-access-start="${esc(entry.occurredAt)}" data-access-status="${esc(entry.status)}">${esc(accessElapsedLabel(entry.occurredAt, entry.status))}</span></span><button class="btn outline" onclick="prepareAccessExit('${entry.id}')">Marcar salida</button></div>`;
                }).join("") || `<div class="empty">No hay personas dentro de la bóveda.</div>`;
                updateAccessElapsedTimers();
            }
            function renderC4Control() {
                const panel = byId("c4ControlPanel");
                if (!panel) return;
                const isC4Profile = state.ui.activeProfile === "c4";
                panel.style.display = isC4Profile ? "block" : "none";
                if (!isC4Profile) return;
                const records = state.accessQueue.filter((item) => item.status === "Autorizado para C4");
                if (!records.some((item) => item.id === state.ui.c4SelectedQueueId)) state.ui.c4SelectedQueueId = records[0]?.id || null;
                const selected = records.find((item) => item.id === state.ui.c4SelectedQueueId);
                const isOpen = state.ui.c4DoorState === "Abierta";
                panel.classList.toggle("c4-door-open", isOpen);
                panel.classList.toggle("c4-door-closed", !isOpen);
                byId("c4RecordCount").textContent = String(records.length);
                const refreshStatus = byId("c4RefreshStatus");
                if (refreshStatus) refreshStatus.textContent = state.ui.c4MonitorRefreshedAt
                    ? `Actualizado ${new Intl.DateTimeFormat("es-MX", { hour: "2-digit", minute: "2-digit", second: "2-digit" }).format(new Date(state.ui.c4MonitorRefreshedAt))}`
                    : "Vista inicial";
                byId("c4RecordList").innerHTML = records.map((item) => {
                    const context = accessContext(item);
                    const selectedClass = item.id === selected?.id ? "background:#fff8df" : "background:transparent";
                    return `<button type="button" class="activity" style="width:100%;text-align:left;${selectedClass}" onclick="selectC4Record('${item.id}')"><span><b>${esc(context.name)}</b><br><small class="muted">${esc(context.type)} · Caja ${esc(context.box?.code || "Sin caja")} · ${esc(context.contract?.folio || "Sin contrato")}</small></span><span>${badge(item.status)}</span></button>`;
                }).join("") || `<div class="empty">No hay registros autorizados para C4.</div>`;
                byId("c4DoorState").textContent = isOpen ? "ABIERTA · CONTROL REMOTO ACTIVO" : "CERRADA · ACCESO BLOQUEADO";
                byId("c4DoorState").className = `c4-door-state ${isOpen ? "is-open" : "is-closed"}`;
                byId("c4DoorUpdated").textContent = state.ui.c4DoorUpdatedAt
                    ? new Intl.DateTimeFormat("es-MX", { dateStyle: "short", timeStyle: "short" }).format(new Date(state.ui.c4DoorUpdatedAt))
                    : "Sin movimientos en esta sesión";
                const context = selected && accessContext(selected);
                byId("c4SelectedRecord").innerHTML = selected
                    ? `<b>${esc(context.name)}</b><br /><span class="muted">${esc(context.type)} · Caja ${esc(context.box?.code || "Sin caja")}</span><div class="summary-row"><span>Contrato validado por Bóveda</span><b>${esc(context.contract?.folio || "Sin contrato")}</b></div><div class="summary-row"><span>Solicitud autorizada</span><b>${dateLabel(selected.createdAt.slice(0, 10))}</b></div>`
                    : "Selecciona una persona de la cola para operar la puerta.";
                const portrait = selected?.authorizationId ? C4_DEMO_PORTRAITS[selected.authorizationId] : null;
                const initials = context?.name ? context.name.split(" ").filter(Boolean).slice(0, 2).map((part) => part[0]).join("") : "—";
                byId("c4VisualValidation").innerHTML = selected
                    ? `<div class="c4-photo-frame">${portrait ? `<img src="${esc(portrait)}" alt="Retrato ficticio de referencia de ${esc(context.name)}" />` : `<div class="c4-photo-placeholder" aria-hidden="true">${esc(initials)}</div>`}</div><h3 class="c4-identity-name">${esc(context.name)}</h3><p class="c4-identity-meta">${esc(context.type)} · Registro autorizado por Bóveda</p><span class="c4-photo-status">${portrait ? "FOTO FICTICIA · DEMO" : "SIN FOTO DE REFERENCIA"}</span>`
                    : "Selecciona un registro para mostrar su fotografía de referencia.";
                byId("c4GrantButton").disabled = !selected || !portrait || isOpen;
                byId("c4ConfirmButton").disabled = !selected || !portrait || !isOpen;
                byId("c4CloseButton").disabled = !isOpen;
                byId("c4RemoveButton").disabled = !selected;
                byId("c4ControlFeedback").textContent = isOpen
                    ? selected
                        ? `Puerta de bóveda abierta de forma remota para ${context.name}. Registra el acceso remoto y después cierra la puerta.`
                        : `Puerta de bóveda abierta de forma remota. ${state.ui.c4LastAction || "Registra el acceso remoto y después cierra la puerta."}`
                    : selected && !portrait
                        ? "No hay una foto de referencia para este registro; solicita revisión manual a Bóveda."
                    : selected
                        ? `Foto validada en demo. C4 puede abrir a distancia la puerta de bóveda para ${context.name}.`
                        : state.ui.c4LastAction || "La puerta permanece cerrada hasta que C4 autorice una apertura remota.";
            }
            function addC4DemoRecord() {
                const occurredAt = new Date().toISOString();
                const entryId = createDemoId("access-c4");
                const record = { id: createDemoId("queue-c4"), tenantId: "tenant-mariana", authorizationId: "auth-pacho", contractId: "contract-0148", direction: "Entrada", status: "Autorizado para C4", c4EntryId: entryId, createdAt: occurredAt, simulated: true };
                state.accessEvents.unshift({ id: entryId, tenantId: record.tenantId, contractId: record.contractId, authorizationId: record.authorizationId, direction: "Entrada", status: "Confirmado", reason: "Entrada registrada por Bóveda; control remoto de puerta disponible para C4", confirmedBy: "Sergio Paredes", occurredAt, image: "Retrato ficticio de referencia" });
                state.accessQueue.unshift(record);
                state.ui.c4SelectedQueueId = record.id;
                return record;
            }
            function refreshC4Monitor() {
                if (state.ui.activeProfile !== "c4") return flash("Inicia sesión con el perfil C4 para actualizar este monitor.");
                state.ui.c4MonitorRefreshedAt = new Date().toISOString();
                const generated = !state.accessQueue.some((item) => item.status === "Autorizado para C4") ? addC4DemoRecord() : null;
                persistState();
                renderC4Control();
                const pending = state.accessQueue.filter((item) => item.status === "Autorizado para C4").length;
                flash(generated ? "Registro simulado agregado al monitor C4 para demostración." : `Vista C4 actualizada: ${pending} registro${pending === 1 ? "" : "s"} autorizado${pending === 1 ? "" : "s"}.`);
            }
            function selectC4Record(id) {
                if (!state.accessQueue.some((item) => item.id === id && item.status === "Autorizado para C4")) return;
                state.ui.c4SelectedQueueId = id;
                persistState();
                renderC4Control();
            }
            function clearC4Selection() {
                state.ui.c4SelectedQueueId = null;
                persistState();
                renderC4Control();
            }
            function grantC4Access() {
                if (state.ui.c4DoorState === "Abierta") return flash("La puerta ya está abierta en esta simulación.");
                const selected = state.accessQueue.find((item) => item.id === state.ui.c4SelectedQueueId && item.status === "Autorizado para C4");
                if (!selected) return flash("Selecciona un registro autorizado por Bóveda antes de accionar la puerta.");
                if (!C4_DEMO_PORTRAITS[selected.authorizationId]) return flash("No hay foto de referencia; solicita revisión manual a Bóveda.");
                const context = accessContext(selected);
                state.ui.c4DoorState = "Abierta";
                state.ui.c4DoorUpdatedAt = new Date().toISOString();
                state.ui.c4LastAction = `Puerta abierta para ${context.name}.`;
                logAudit("Abrió puerta de bóveda por C4", `${context.name} · ${context.box?.code || "Sin caja"}`, "Abierta", false);
                persistState();
                renderC4Control();
                flash(`Puerta de bóveda abierta para ${context.name} (simulación).`);
            }
            function recordC4RemoteAccess() {
                const selected = state.accessQueue.find((item) => item.id === state.ui.c4SelectedQueueId && item.status === "Autorizado para C4");
                if (!selected || state.ui.c4DoorState !== "Abierta") return flash("Primero abre la puerta de bóveda antes de registrar el acceso remoto.");
                if (!C4_DEMO_PORTRAITS[selected.authorizationId]) return flash("No hay foto de referencia para registrar este acceso remoto.");
                const context = accessContext(selected);
                selected.status = "Acceso remoto registrado";
                selected.c4ConfirmedAt = new Date().toISOString();
                const entry = state.accessEvents.find((event) => event.id === selected.c4EntryId);
                if (entry) {
                    entry.status = "Confirmado";
                    entry.reason = "Puerta de bóveda abierta a distancia por C4";
                    entry.c4ConfirmedBy = CURRENT_USER.name;
                }
                state.ui.c4SelectedQueueId = null;
                state.ui.c4LastAction = `Acceso remoto de ${context.name} registrado. Cierra la puerta de bóveda.`;
                logAudit("Registró acceso remoto por C4", `${context.name} · ${context.box?.code || "Sin caja"}`, "Confirmado", false);
                persistState();
                renderC4Control();
                renderAccessExitQueue();
                flash(`Acceso remoto de ${context.name} registrado. Cierra la puerta de bóveda.`);
            }
            function confirmC4Access() {
                recordC4RemoteAccess();
            }
            function closeC4Door() {
                if (state.ui.c4DoorState !== "Abierta") return flash("La puerta ya está cerrada en esta simulación.");
                state.ui.c4DoorState = "Cerrada";
                state.ui.c4DoorUpdatedAt = new Date().toISOString();
                state.ui.c4LastAction = "Puerta de bóveda cerrada.";
                logAudit("Cerró puerta de bóveda por C4", "Puerta de bóveda", "Cerrada", false);
                persistState();
                renderC4Control();
                flash("Puerta de bóveda cerrada por C4 (simulación).");
            }
            function removeC4Record() {
                const selected = state.accessQueue.find((item) => item.id === state.ui.c4SelectedQueueId && item.status === "Autorizado para C4");
                if (!selected) return flash("Selecciona un registro para retirarlo del monitor.");
                const context = accessContext(selected);
                selected.status = "Retirado por C4";
                selected.c4RemovedAt = new Date().toISOString();
                state.ui.c4SelectedQueueId = null;
                logAudit("Retiró registro de monitor C4", `${context.name} · ${context.box?.code || "Sin caja"}`, "Correcto", false);
                persistState();
                renderC4Control();
                flash("Registro retirado de la vista de C4; se conserva en la bitácora de la demo.");
            }
            function selectAccess(id) {
                const item = state.accessQueue.find((record) => record.id === id);
                if (!item) return;
                const context = accessContext(item);
                const result = context.valid ? "Contrato y caja vigentes en demo" : "Requiere revisión operativa";
                const actions = context.valid ? `<button class="btn primary" onclick="confirmAccess('${item.id}')">Confirmar entrada</button><button class="btn outline" style="margin-left:8px" onclick="denyAccess('${item.id}')">Rechazar</button>` : `<button class="btn outline" onclick="denyAccess('${item.id}')">Registrar rechazo</button>`;
                byId("accessVerification").innerHTML = `<b>${esc(context.name)}</b><br><span class="muted">${esc(context.type)} · Caja ${esc(context.box?.code || "Sin caja")}</span><div class="summary-row"><span>Contrato</span><b>${esc(context.contract?.folio || "Sin contrato")}</b></div><div class="summary-row"><span>Resultado de validación</span><b>${esc(result)}</b></div><p class="notice" style="margin-top:12px"><b>Encargado de bóveda:</b> Sergio Paredes confirma el acceso de esta persona.</p><div style="margin-top:14px">${actions}</div>`;
            }
            function confirmAccess(id) {
                const item = state.accessQueue.find((record) => record.id === id);
                const context = item && accessContext(item);
                if (!item || !context?.valid) return flash("No se puede confirmar: valida contrato, caja y autorizado.");
                item.status = "Autorizado para C4";
                const entry = { id: createDemoId("access"), tenantId: context.tenant.id, contractId: context.contract.id, authorizationId: context.authorization?.id || null, direction: "Entrada", status: "Confirmado", reason: "Entrada validada por Bóveda; control remoto de puerta disponible para C4", confirmedBy: CURRENT_USER.name, occurredAt: new Date().toISOString(), image: "Referencia biométrica simulada" };
                state.accessEvents.unshift(entry);
                item.c4EntryId = entry.id;
                logAudit("Autorizó acceso para C4", `${context.name} · ${context.box.code}`, "Correcto", false);
                persistState();
                renderAccessQueue();
                byId("accessVerification").innerHTML = `<b>Entrada registrada</b><br><span class="muted">${esc(context.name)} ya aparece en Marcar salida con su contador. C4 recibe el mismo evento únicamente para el control remoto de la puerta.</span>`;
                flash("Entrada registrada por Bóveda. C4 puede controlar la puerta de forma independiente.");
            }
            function prepareAccessExit(entryId) {
                const entry = state.accessEvents.find((event) => event.id === entryId);
                if (!entry) return flash("No encontramos la entrada pendiente.");
                if (entry.status !== "Confirmado") return flash("La puerta debe ser abierta y registrada por C4 antes de capturar la salida.");
                const context = accessContext({ tenantId: entry.tenantId, contractId: entry.contractId, authorizationId: entry.authorizationId });
                byId("accessVerification").innerHTML = `<b>Marcar salida · ${esc(context.name)}</b><br /><span class="muted">Caja ${esc(context.box?.code || "Sin caja")} · ${esc(accessElapsedLabel(entry.occurredAt))} dentro de la bóveda.</span><div class="field" style="margin-top:14px"><label>NOMBRE PARA FIRMA</label><input id="exitSignatureName" placeholder="Nombre de la persona" value="${esc(context.name)}" /></div><div class="signature-pad"><div class="signature-pad__head"><span>FIRMA EN PANTALLA</span><button class="btn outline" type="button" onclick="clearExitSignature()">Limpiar</button></div><canvas id="exitSignaturePad" aria-label="Área para capturar firma simulada"></canvas><div class="signature-pad__line"></div></div><button class="btn primary" style="margin-top:14px" onclick="registerAccessExit('${entry.id}')">Guardar salida y firma</button>`;
                initialiseExitSignaturePad(entry.id);
            }
            function initialiseExitSignaturePad(entryId) {
                const canvas = byId("exitSignaturePad");
                if (!canvas) return;
                const ratio = window.devicePixelRatio || 1;
                const width = Math.max(canvas.clientWidth || 560, 1);
                const height = Math.max(canvas.clientHeight || 160, 1);
                canvas.width = Math.floor(width * ratio);
                canvas.height = Math.floor(height * ratio);
                const context = canvas.getContext("2d");
                context.scale(ratio, ratio);
                context.strokeStyle = "#38322f";
                context.lineWidth = 2.2;
                context.lineCap = "round";
                context.lineJoin = "round";
                let drawing = false;
                let previousPoint = null;
                const pointFor = (event) => {
                    const rect = canvas.getBoundingClientRect();
                    return { x: event.clientX - rect.left, y: event.clientY - rect.top };
                };
                canvas.addEventListener("pointerdown", (event) => {
                    drawing = true;
                    previousPoint = pointFor(event);
                    signaturePad.hasStroke = true;
                    canvas.setPointerCapture?.(event.pointerId);
                });
                canvas.addEventListener("pointermove", (event) => {
                    if (!drawing || !previousPoint) return;
                    const point = pointFor(event);
                    context.beginPath();
                    context.moveTo(previousPoint.x, previousPoint.y);
                    context.lineTo(point.x, point.y);
                    context.stroke();
                    previousPoint = point;
                });
                const stopDrawing = () => { drawing = false; previousPoint = null; };
                canvas.addEventListener("pointerup", stopDrawing);
                canvas.addEventListener("pointerleave", stopDrawing);
                canvas.addEventListener("pointercancel", stopDrawing);
                signaturePad = { entryId, canvas, context, width, height, ratio, hasStroke: false };
            }
            function clearExitSignature() {
                if (!signaturePad) return;
                signaturePad.context.clearRect(0, 0, signaturePad.width, signaturePad.height);
                signaturePad.hasStroke = false;
            }
            function registerAccessExit(entryId) {
                const entry = state.accessEvents.find((event) => event.id === entryId);
                if (!entry) return flash("No encontramos la entrada pendiente.");
                const signature = byId("exitSignatureName")?.value.trim();
                if (!signature || !signaturePad?.hasStroke || signaturePad.entryId !== entryId) return flash("Indica el nombre y captura la firma en pantalla para registrar la salida.");
                const contract = contractById(entry.contractId);
                const signatureImage = signaturePad.canvas.toDataURL("image/png");
                state.accessEvents.unshift({ id: createDemoId("access"), entryId: entry.id, tenantId: entry.tenantId, contractId: entry.contractId, authorizationId: entry.authorizationId || null, direction: "Salida", status: "Confirmado", reason: "Salida firmada en demo", signature, signatureImage, occurredAt: new Date().toISOString() });
                logAudit("Actualizó salida con firma", contract?.folio || "Acceso a bóveda", "Confirmado", false);
                persistState();
                renderAccessQueue();
                signaturePad = null;
                byId("accessVerification").innerHTML = `<b>Salida registrada</b><br><span class="muted">Firma simulada de ${esc(signature)} guardada en el historial de bóveda.</span>`;
                flash("Salida y firma simulada registradas.");
            }
            function denyAccess(id) {
                const item = state.accessQueue.find((record) => record.id === id);
                if (!item) return;
                const context = accessContext(item);
                item.status = "Rechazado";
                state.accessEvents.unshift({ id: createDemoId("access"), tenantId: item.tenantId, contractId: item.contractId, authorizationId: item.authorizationId, direction: item.direction, status: "Rechazado", reason: context.valid ? "Rechazado por operación" : "Contrato, caja o autorización no válidos", occurredAt: new Date().toISOString() });
                logAudit("Rechazó acceso", `${context.name} · ${context.box?.code || "Sin caja"}`, "Revisión requerida", false);
                persistState();
                renderAccessQueue();
                byId("accessVerification").innerHTML = `<b>Rechazo registrado</b><br><span class="muted">No se concedió acceso automático.</span>`;
                flash("Rechazo de acceso registrado (simulación).");
            }
            function renderFinance() {
                const target = byId("financeRows");
                if (!target) return;
                target.innerHTML = state.movements.map((movement) => `<tr><td>${esc(movement.folio)}</td><td>${esc(tenantById(movement.tenantId)?.name)}</td><td>${esc(movement.concept)}</td><td>${esc(movement.method)}</td><td>${fmtCents(movement.amountCents)}</td><td>${badge(movement.status)}</td></tr>`).join("") || `<tr><td colspan="6" class="muted">Sin movimientos.</td></tr>`;
                const select = byId("incomeTenant");
                if (select) {
                    const previous = select.value;
                    select.innerHTML = state.tenants.map((tenant) => `<option value="${tenant.id}">${esc(tenant.name)}</option>`).join("");
                    if (tenantById(previous)) select.value = previous;
                }
            }
            function registerOtherIncome() {
                const amountCents = Math.round((Number(byId("incomeAmount").value) || 0) * 100);
                const tenantId = byId("incomeTenant").value;
                if (!tenantById(tenantId) || amountCents <= 0) return flash("Indica un arrendatario y un importe mayor que cero.");
                const number = nextSequence(state.movements, "folio", 32);
                state.movements.unshift({ id: createDemoId("movement"), folio: `OI-2026-${String(number).padStart(4, "0")}`, tenantId, contractId: contractsForTenant(tenantId).find(isOpenContract)?.id || null, concept: byId("incomeConcept").value, method: byId("incomeMethod").value, amountCents, type: "Otro ingreso", status: "Registrado", occurredAt: new Date().toISOString().slice(0, 10) });
                logAudit("Registró otro ingreso", `${byId("incomeConcept").value} · ${fmtCents(amountCents)}`, "Registrado", false);
                persistState();
                renderFinance();
                flash("Otro ingreso registrado en la demostración.");
            }
            function documentTypeLabel(type) {
                const labels = { "Contrato de arrendamiento": "Contrato", "Constancia de entrega de llaves": "Llaves", "Recibo de depósito en garantía": "Garantía", "Expediente de arrendatario": "Expediente", "Aviso de cancelación": "Cancelación" };
                return labels[type] || "Documento";
            }
            function documentSearchText(value) {
                return String(value || "").normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLocaleLowerCase("es").trim();
            }
            function renderDocuments() {
                const search = documentSearchText(byId("documentSearch").value);
                const filter = byId("documentTypeFilter");
                const selectedType = filter.value;
                const types = [...new Set(state.documents.map((record) => record.type).filter(Boolean))].sort((a, b) => a.localeCompare(b, "es"));
                filter.innerHTML = `<option value="">Todos los tipos</option>${types.map((type) => `<option value="${esc(type)}">${esc(type)}</option>`).join("")}`;
                filter.value = types.includes(selectedType) ? selectedType : "";
                const rows = state.documents.map((record) => {
                    const contract = contractById(record.contractId);
                    const tenant = contract && tenantById(contract.tenantId);
                    const box = contract && boxById(contract.boxId);
                    return { record, contract, tenant, box };
                }).filter(({ record, contract, tenant, box }) => (!filter.value || record.type === filter.value) && documentSearchText([record.type, documentTypeLabel(record.type), record.folio, tenant?.name, contract?.folio, box?.code].join(" ")).includes(search))
                    .sort((a, b) => String(b.record.createdAt || "").localeCompare(String(a.record.createdAt || "")));
                byId("documentCount").textContent = `${rows.length} documento${rows.length === 1 ? "" : "s"} ${search || filter.value ? "encontrado" : "registrado"}${rows.length === 1 ? "" : "s"}`;
                byId("documentRows").innerHTML = rows.map(({ record, contract, tenant, box }) => `<tr><td><b>${esc(record.type || "Documento")}</b><small class="document-folio">${esc(record.folio || "Sin folio")}</small></td><td><span class="document-table-type">${esc(documentTypeLabel(record.type))}</span></td><td>${esc(tenant?.name || "Sin arrendatario")}</td><td>${esc(contract?.folio || "Sin contrato")}<small class="document-folio">${esc(box?.code || "Sin caja")}</small></td><td>${esc(record.createdAt ? dateLabel(record.createdAt.slice(0, 10)) : "Sin fecha")}</td><td><button class="btn outline" type="button" data-document-id="${esc(record.id)}" ${!contract || !tenant ? "disabled" : ""}>Vista previa</button></td></tr>`).join("") || `<tr><td colspan="6" class="muted">${search || filter.value ? "No hay documentos que coincidan con la búsqueda." : "Aún no hay documentos registrados."}</td></tr>`;
            }
            function previewRecordedDocument(id) {
                const record = state.documents.find((item) => item.id === id);
                if (!record) return flash("No encontramos ese documento.");
                previewDocument(record.type, record.id);
            }
            function previewDocument(type, documentId = null) {
                const selectedRecord = documentId ? state.documents.find((item) => item.id === documentId) : null;
                if (documentId && !selectedRecord) return flash("No encontramos ese documento.");
                const contract = documentId ? contractById(selectedRecord.contractId) : selectedContract();
                const tenant = contract && tenantById(contract.tenantId);
                const box = contract && boxById(contract.boxId);
                const documentRecord = selectedRecord || state.documents.find((item) => item.contractId === contract?.id && item.type === type);
                if (!contract || !tenant) return flash("Selecciona primero un contrato relacionado.");
                const folio = documentRecord?.folio || `VISTA-${contract.folio}`;
                const createdAt = (documentRecord?.createdAt || new Date().toISOString()).slice(0, 10);
                const documentBodies = {
                    "Contrato de arrendamiento": `<p>Se presenta el resumen operativo del contrato para la caja <b>${esc(box?.code)}</b>, tamaño ${esc(box?.size)}.</p><div class="document-paper__summary"><div><span>Vigencia</span><b>${esc(dateLabel(contract.startDate))} a ${esc(dateLabel(contract.endDate))}</b></div><div><span>Renta mensual</span><b>${fmtCents(contract.rentCents)}</b></div><div><span>Garantía</span><b>${fmtCents(contract.depositCents)}</b></div></div><p>Este formato es una representación visual; las cláusulas, firmas y efectos legales quedan fuera del alcance de la demo.</p>`,
                    "Constancia de entrega de llaves": `<p>Se deja constancia simulada de la entrega de acceso físico a la caja <b>${esc(box?.code)}</b>.</p><div class="document-paper__summary"><div><span>Caja</span><b>${esc(box?.code)} · ${esc(box?.area)}</b></div><div><span>Llaves entregadas</span><b>${Number(box?.keys) || 2} de ${Number(box?.keys) || 2}</b></div><div><span>Estatus</span><b>Entrega simulada</b></div></div><p>La demo no sustituye un acta ni registra entrega física de llaves.</p>`,
                    "Recibo de depósito en garantía": `<p>Comprobante demostrativo del depósito asociado al contrato <b>${esc(contract.folio)}</b>.</p><div class="document-paper__summary"><div><span>Importe recibido</span><b>${fmtCents(contract.depositCents)}</b></div><div><span>Forma de pago</span><b>Simulación de registro</b></div><div><span>Referencia</span><b>${esc(folio)}</b></div></div><p>Sin timbrado, CFDI, cobro ni efecto fiscal.</p>`,
                    "Aviso de cancelación": `<p>Resumen simulado de la cancelación del contrato <b>${esc(contract.folio)}</b>.</p><div class="document-paper__summary"><div><span>Caja</span><b>${esc(box?.code || "Sin asignar")}</b></div><div><span>Estado del contrato</span><b>${esc(contract.status || "Sin estado")}</b></div><div><span>Fecha de cancelación</span><b>${esc(contract.cancelledAt ? dateLabel(contract.cancelledAt.slice(0, 10)) : "No registrada")}</b></div><div><span>Motivo</span><b>${esc(contract.cancellationReason || "No registrado")}</b></div></div><p>Este aviso es una representación de demostración.</p>`,
                    "Expediente de arrendatario": `<p>Índice visual del expediente de <b>${esc(tenant.name)}</b> para consulta durante la presentación.</p><div class="document-paper__summary"><div><span>Identificación</span><b>Disponible en demo</b></div><div><span>Contrato</span><b>${esc(contract.folio)}</b></div><div><span>Documentos relacionados</span><b>${state.documents.filter((item) => item.contractId === contract.id).length} registros</b></div></div><p>Los archivos, la validación documental y el resguardo legal son simulados.</p>`,
                };
                const content = `<article class="document-paper"><header class="document-paper__head"><img class="document-paper__logo" src="{{ asset('images/saferoom-logo.png') }}" alt="SafeRoom"><div class="document-paper__meta"><b>${esc(folio)}</b><span>Emitido: ${esc(dateLabel(createdAt))}</span><span>ESTADO: SIMULACIÓN</span></div></header><div class="document-paper__title"><p>SAFE ROOM · FORMATO OPERATIVO</p><h2>${esc(type)}</h2></div><div class="document-paper__body"><p><b>Arrendatario:</b> ${esc(tenant.name)}</p><p><b>Contrato:</b> ${esc(contract.folio)} · <b>Caja:</b> ${esc(box?.code || "Sin asignar")}</p>${documentBodies[type] || "<p>Vista de ejemplo del documento asociado a este contrato.</p>"}</div><footer class="document-paper__signatures"><div>Nombre y firma del arrendatario</div><div>Nombre y firma de SafeRoom</div></footer></article>`;
                byId("documentPreviewTitle").textContent = `${type} · ${folio}`;
                byId("documentPreview").innerHTML = content;
                byId("documentViewerTitle").textContent = `${type} · ${folio}`;
                byId("documentViewerContent").innerHTML = content;
                byId("documentViewerModal").dataset.filename = `${type}-${folio}`;
                byId("documentViewerModal").classList.add("on");
                byId("printDocumentButton").disabled = false;
                flash(`${type}: vista previa actualizada.`);
            }
            function closeDocumentViewer() { byId("documentViewerModal")?.classList.remove("on"); }
            function downloadPreviewDocument() {
                const viewer = byId("documentViewerModal");
                const content = byId("documentViewerContent")?.innerText;
                if (!content) return flash("Abre primero un documento para descargarlo.");
                const link = document.createElement("a");
                link.href = URL.createObjectURL(new Blob([content], { type: "text/plain;charset=utf-8" }));
                link.download = `${viewer.dataset.filename || "documento-saferoom"}.txt`;
                link.click();
                URL.revokeObjectURL(link.href);
                flash("Ejemplo descargado. La descarga solo ocurre por decisión del usuario.");
            }
            function printDocument() {
                if (byId("printDocumentButton")?.disabled) return flash("Selecciona un documento antes de imprimir.");
                window.print();
            }
            const reportInitialTenantId = @json(request('tenant'));
            const reportInitialContractId = @json(request('contract'));
            let reportContextInitialised = false;

            function reportDateValue(date) {
                const localDate = new Date(date.getTime() - date.getTimezoneOffset() * 60000);
                return localDate.toISOString().slice(0, 10);
            }
            function refreshReportContracts() {
                const tenantSelect = byId("reportTenant");
                const contractSelect = byId("reportContract");
                if (!tenantSelect || !contractSelect) return;
                const previousContractId = contractSelect.value;
                const contracts = state.contracts.filter((contract) => !tenantSelect.value || contract.tenantId === tenantSelect.value);
                contractSelect.innerHTML = `<option value="">Todos los contratos</option>${contracts.map((contract) => {
                    const tenant = tenantById(contract.tenantId);
                    const box = boxById(contract.boxId);
                    return `<option value="${esc(contract.id)}">${esc(`${contract.folio} · ${tenant?.name || "Sin titular"} · ${box?.code || "Sin caja"}`)}</option>`;
                }).join("")}`;
                const initialContractId = reportContextInitialised ? previousContractId : reportInitialContractId;
                if (contracts.some((contract) => contract.id === initialContractId)) contractSelect.value = initialContractId;
            }
            function initialiseReportContext() {
                if (reportContextInitialised) return;
                const tenantSelect = byId("reportTenant");
                if (!tenantSelect) return;
                const initialContract = contractById(reportInitialContractId);
                const initialTenantId = tenantById(reportInitialTenantId)
                    ? reportInitialTenantId
                    : initialContract?.tenantId || "";
                tenantSelect.innerHTML = `<option value="">Toda la operación</option>${state.tenants.map((tenant) => `<option value="${esc(tenant.id)}">${esc(tenant.name)}</option>`).join("")}`;
                tenantSelect.value = initialTenantId;
                refreshReportContracts();
                reportContextInitialised = true;
            }
            function syncReportContextFromContract() {
                const contract = contractById(byId("reportContract")?.value);
                if (contract && byId("reportTenant")) {
                    byId("reportTenant").value = contract.tenantId;
                    refreshReportContracts();
                    byId("reportContract").value = contract.id;
                }
            }
            function clearReportContext() {
                initialiseReportContext();
                byId("reportTenant").value = "";
                refreshReportContracts();
                renderReport();
            }
            function setReportPreset(preset) {
                const today = new Date();
                let from = new Date(today);
                if (preset === "month") from.setDate(1);
                if (preset === "30days") from.setDate(today.getDate() - 29);
                if (preset === "year") from = new Date(today.getFullYear(), 0, 1);
                byId("reportFrom").value = reportDateValue(from);
                byId("reportTo").value = reportDateValue(today);
                renderReport();
            }
            function selectReportShortcut(type) {
                const reportSelect = byId("reportType");
                if (!reportSelect || !reportSelect.querySelector(`option[value="${type}"]`)) return;
                reportSelect.value = type;
                renderReport();
                byId("reportFilter")?.scrollIntoView({ behavior: "smooth", block: "start" });
                reportSelect.focus({ preventScroll: true });
                flash(`Simulación de ${reportSelect.options[reportSelect.selectedIndex].text} lista. Ajusta los filtros y descarga el CSV cuando quieras.`);
            }
            function reportFilters() {
                initialiseReportContext();
                const from = byId("reportFrom")?.value || "0000-01-01";
                const to = byId("reportTo")?.value || "9999-12-31";
                const tenantId = byId("reportTenant")?.value || "";
                const contractId = byId("reportContract")?.value || "";
                const between = (value) => value && value.slice(0, 10) >= from && value.slice(0, 10) <= to;
                const matches = (item) => (!tenantId || item.tenantId === tenantId) && (!contractId || item.contractId === contractId);
                return { from, to, tenantId, contractId, between, matches };
            }
            function reportContextLabel(filters = reportFilters()) {
                const contract = contractById(filters.contractId);
                if (contract) return `${contract.folio} · ${tenantById(contract.tenantId)?.name || "Sin titular"}`;
                const tenant = tenantById(filters.tenantId);
                return tenant ? tenant.name : "Toda la operación";
            }
            function reportData(filters = reportFilters()) {
                const type = byId("reportType").value;
                const scopedRequests = state.requests.filter((request) => filters.between(request.createdAt) && filters.matches(request));
                const scopedContracts = state.contracts.filter((contract) => filters.matches(contract));
                const scopedMovements = state.movements.filter((movement) => filters.between(movement.occurredAt) && filters.matches(movement));
                const scopedEntries = state.accessEvents.filter((event) => event.direction === "Entrada" && filters.between(event.occurredAt) && filters.matches(event));
                if (type === "availability") return { title: "Vista previa: disponibilidad de cajas", headers: ["Estado", "Cantidad", "Participación"], rows: ["Disponible", "Ocupada", "Reservada", "Mantenimiento"].map((status) => { const quantity = state.boxes.filter((box) => box.status === status).length; return [status, quantity, `${Math.round((quantity / Math.max(state.boxes.length, 1)) * 100)}%`]; }) };
                if (type === "access") return { title: "Vista previa: bitácora de accesos", headers: ["Fecha", "Nombre", "Tipo", "Caja", "Hora entrada", "Referencia", "Hora salida", "Firma"], rows: scopedEntries.map((entry) => { const contract = contractById(entry.contractId); const authorization = entry.authorizationId && state.authorizations.find((item) => item.id === entry.authorizationId); const exit = state.accessEvents.find((event) => event.direction === "Salida" && event.entryId === entry.id); return [dateLabel(entry.occurredAt.slice(0, 10)), authorization?.name || tenantById(entry.tenantId)?.name || "Sin persona", authorization ? "Autorizado" : "Titular", boxById(contract?.boxId)?.code || "Sin caja", new Date(entry.occurredAt).toLocaleTimeString("es-MX", { hour: "2-digit", minute: "2-digit" }), entry.image || "Referencia simulada", exit ? new Date(exit.occurredAt).toLocaleTimeString("es-MX", { hour: "2-digit", minute: "2-digit" }) : "Pendiente", exit?.signature || "Pendiente"]; }) };
                if (type === "finance") return { title: "Vista previa: ingresos y garantías", headers: ["Fecha", "Folio", "Concepto", "Importe", "Estado"], rows: scopedMovements.map((movement) => [dateLabel(movement.occurredAt), movement.folio, movement.concept, fmtCents(movement.amountCents), movement.status]) };
                if (type === "new-contracts") return { title: "Vista previa: contratos nuevos", headers: ["Fecha", "Cliente", "Caja", "Medida", "Renta", "Garantía", "Estatus"], rows: scopedContracts.filter((contract) => filters.between(contract.createdAt || contract.startDate)).map((contract) => { const box = boxById(contract.boxId); return [dateLabel((contract.createdAt || contract.startDate).slice(0, 10)), tenantById(contract.tenantId)?.name || "Sin cliente", box?.code || "Sin caja", box?.size || "—", fmtCents(contract.rentCents), fmtCents(contract.depositCents), contract.status]; }) };
                if (type === "annual") {
                    const years = [2024, 2025, 2026];
                    const totals = (year, label) => state.operations.filter((operation) => filters.matches(operation) && operation.type === label && operation.occurredAt.startsWith(String(year))).length;
                    return { title: "Vista previa: resumen anual de operaciones", headers: ["Año", "Nuevos", "Renovaciones", "Cambios", "Cancelaciones"], rows: years.map((year) => [year, scopedContracts.filter((contract) => (contract.createdAt || "").startsWith(String(year))).length, totals(year, "Renovación") + totals(year, "Renovación con cambio de caja") + totals(year, "Renovación con cambio de medida"), totals(year, "Cambio de ubicación") + totals(year, "Cambio de medida"), totals(year, "Cancelación")]) };
                }
                const openEntries = scopedEntries.filter((entry) => !state.accessEvents.some((event) => event.direction === "Salida" && event.entryId === entry.id));
                return { title: "Vista previa: resumen ejecutivo", headers: ["Indicador", "Resultado"], rows: [["Solicitudes recibidas", scopedRequests.length], ["Solicitudes pendientes", scopedRequests.filter((request) => !["Aprobada", "Rechazada"].includes(request.status)).length], ["Contratos abiertos", scopedContracts.filter(isOpenContract).length], ["Renta mensual contratada", fmtCents(scopedContracts.filter(isOpenContract).reduce((total, contract) => total + contract.rentCents, 0))], ["Entradas sin salida registrada", openEntries.length], ["Ingresos registrados", fmtCents(scopedMovements.reduce((total, movement) => total + movement.amountCents, 0))]] };
            }
            function renderReport() {
                const filters = reportFilters();
                const report = reportData(filters);
                const scopedRequests = state.requests.filter((request) => filters.between(request.createdAt) && filters.matches(request));
                const scopedMovements = state.movements.filter((movement) => filters.between(movement.occurredAt) && filters.matches(movement));
                const scopedContracts = state.contracts.filter((contract) => filters.matches(contract));
                const scopedEntries = state.accessEvents.filter((event) => event.direction === "Entrada" && filters.between(event.occurredAt) && filters.matches(event));
                const openEntries = scopedEntries.filter((entry) => !state.accessEvents.some((event) => event.direction === "Salida" && event.entryId === entry.id));
                const income = scopedMovements.reduce((total, movement) => total + Math.max(0, movement.amountCents), 0);
                const occupied = state.boxes.filter((box) => box.status === "Ocupada").length;
                const available = state.boxes.filter((box) => box.status === "Disponible").length;
                const totalBoxes = Math.max(state.boxes.length, 1);
                const occupancy = Math.round((occupied / totalBoxes) * 100);
                const pendingRequests = scopedRequests.filter((request) => !["Aprobada", "Rechazada"].includes(request.status));
                const cutoff = new Date(`${filters.to}T12:00:00`);
                const renewalDeadline = new Date(cutoff);
                renewalDeadline.setDate(renewalDeadline.getDate() + 30);
                const renewalsDue = scopedContracts.filter((contract) => isOpenContract(contract) && contract.endDate >= filters.to && contract.endDate <= reportDateValue(renewalDeadline));
                const pendingAccesses = state.accessQueue.filter((access) => filters.matches(access) && ["Pendiente", "Requiere revisión"].includes(access.status));
                const context = reportContextLabel(filters);
                const setReportText = (id, value) => { if (byId(id)) byId(id).textContent = value; };

                setReportText("reportIncome", fmtCents(income));
                setReportText("reportIncomeDetail", `${scopedMovements.length} movimiento${scopedMovements.length === 1 ? "" : "s"} en el corte`);
                setReportText("reportIncomeTrend", `Renta mensual contratada: ${fmtCents(scopedContracts.filter(isOpenContract).reduce((total, contract) => total + contract.rentCents, 0))}`);
                setReportText("reportOccupied", `${occupancy}%`);
                setReportText("reportOccupiedDetail", `${occupied} ocupada${occupied === 1 ? "" : "s"} de ${state.boxes.length} cajas`);
                setReportText("reportOccupiedTrend", `${available} disponible${available === 1 ? "" : "s"} · ${fmtCents(state.boxes.filter((box) => box.status === "Disponible").reduce((total, box) => total + box.rentCents, 0))}/mes potencial`);
                setReportText("reportRequests", scopedRequests.length);
                setReportText("reportRequestsDetail", `${pendingRequests.length} pendiente${pendingRequests.length === 1 ? "" : "s"} por resolver`);
                setReportText("reportRequestsTrend", `${scopedRequests.filter((request) => request.status === "Aprobada").length} aprobada${scopedRequests.filter((request) => request.status === "Aprobada").length === 1 ? "" : "s"} en el corte`);
                setReportText("reportOpenVisits", openEntries.length);
                setReportText("reportOpenVisitsDetail", openEntries.length ? "Entrada(s) sin salida registrada" : "Todas las entradas tienen salida registrada");
                setReportText("reportOpenVisitsTrend", openEntries.length ? "Requiere seguimiento de bóveda" : "Bitácora completa en el corte");
                setReportText("reportContextLabel", context);
                setReportText("reportPreviewContext", `${context} · ${dateLabel(filters.from)} — ${dateLabel(filters.to)}`);
                setReportText("reportDecisionDescription", `Corte del ${dateLabel(filters.from)} al ${dateLabel(filters.to)} · ${context}. Prioriza primero las excepciones de seguridad y continuidad contractual.`);

                byId("reportPreviewTitle").textContent = report.title;
                byId("reportPreviewHead").innerHTML = `<tr class="sheet-letters"><th></th>${report.headers.map((_, index) => `<th>${String.fromCharCode(65 + index)}</th>`).join("")}</tr><tr><th>1</th>${report.headers.map ( (header) => `<th>${esc(header)}</th>`).join("")}</tr>`;
                byId("reportPreviewRows").innerHTML = report.rows.map((row, index) => `<tr><th scope="row">${index + 2}</th>${row.map((cell) => `<td>${esc(cell)}</td>`).join("")}</tr>`).join("") || `<tr><th>2</th><td colspan="${report.headers.length}" class="muted">No hay resultados para los filtros seleccionados.</td></tr>`;
                byId("reportRowCount").textContent = `${report.rows.length} registro${report.rows.length === 1 ? "" : "s"}`;

                const alerts = [];
                if (openEntries.length) alerts.push({ tone: "danger", icon: "!", title: `${openEntries.length} entrada${openEntries.length === 1 ? "" : "s"} sin salida registrada`, detail: "Confirma físicamente la salida y completa la bitácora antes de cerrar el turno." });
                if (pendingAccesses.length) alerts.push({ tone: "warning", icon: "⌁", title: `${pendingAccesses.length} solicitud${pendingAccesses.length === 1 ? "" : "es"} de acceso pendiente`, detail: "Hay validaciones de identidad o autorización que siguen en cola." });
                if (renewalsDue.length) alerts.push({ tone: "warning", icon: "↻", title: `${renewalsDue.length} contrato${renewalsDue.length === 1 ? "" : "s"} vence en los próximos 30 días`, detail: "Anticipa la renovación para proteger ocupación e ingreso recurrente." });
                if (pendingRequests.length) alerts.push({ tone: "warning", icon: "•", title: `${pendingRequests.length} solicitud${pendingRequests.length === 1 ? "" : "es"} comercial${pendingRequests.length === 1 ? "" : "es"} sin resolver`, detail: "Revisa expediente, disponibilidad y aprobación para no perder la oportunidad." });
                if (!alerts.length) alerts.push({ tone: "success", icon: "✓", title: "Sin excepciones críticas en este corte", detail: "La bitácora, la cola de accesos y los vencimientos no muestran pendientes para este contexto." });
                byId("reportAlerts").innerHTML = alerts.map((alert) => `<article class="report-alert report-alert--${alert.tone}"><span class="report-alert__icon">${alert.icon}</span><div><b>${esc(alert.title)}</b><p>${esc(alert.detail)}</p></div></article>`).join("");
                const criticalAlerts = alerts.filter((alert) => alert.tone !== "success").length;
                const alertBadge = byId("reportAlertCount");
                alertBadge.textContent = criticalAlerts ? `${criticalAlerts} PENDIENTE${criticalAlerts === 1 ? "" : "S"}` : "AL DÍA";
                alertBadge.className = `tag ${criticalAlerts ? "amber" : "green"}`;

                const capacityRows = [
                    ["Ocupadas", "Ocupada", "#168b62"],
                    ["Disponibles", "Disponible", "#506d88"],
                    ["Reservadas", "Reservada", "#c98b00"],
                    ["Mantenimiento", "Mantenimiento", "#b42318"],
                ];
                byId("reportCapacity").innerHTML = `<p class="report-capacity__total">${occupancy}% <span>ocupación actual</span></p>${capacityRows.map(([label, status, color]) => { const amount = state.boxes.filter((box) => box.status === status).length; const percentage = Math.round((amount / totalBoxes) * 100); return `<div class="report-capacity__row"><div class="report-capacity__label"><span>${label}</span><b>${amount} · ${percentage}%</b></div><div class="report-capacity__track"><i style="width:${percentage}%;--capacity-color:${color}"></i></div></div>`; }).join("")}<div class="report-briefing"><div><span>RENTA ACTIVA / MES</span><b>${fmtCents(scopedContracts.filter(isOpenContract).reduce((total, contract) => total + contract.rentCents, 0))}</b></div><div><span>POTENCIAL DISPONIBLE / MES</span><b>${fmtCents(state.boxes.filter((box) => box.status === "Disponible").reduce((total, box) => total + box.rentCents, 0))}</b></div><div><span>CONTRATOS ABIERTOS</span><b>${scopedContracts.filter(isOpenContract).length}</b></div></div>`;

                document.querySelectorAll("[data-report-preset]").forEach((button) => {
                    const today = reportDateValue(new Date());
                    const monthStart = reportDateValue(new Date(new Date().getFullYear(), new Date().getMonth(), 1));
                    const daysStart = reportDateValue(new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate() - 29));
                    const yearStart = reportDateValue(new Date(new Date().getFullYear(), 0, 1));
                    const active = (button.dataset.reportPreset === "month" && filters.from === monthStart && filters.to === today) || (button.dataset.reportPreset === "30days" && filters.from === daysStart && filters.to === today) || (button.dataset.reportPreset === "year" && filters.from === yearStart && filters.to === today);
                    button.classList.toggle("is-active", active);
                });
                document.querySelectorAll("[data-report-shortcut]").forEach((button) => {
                    const selected = button.dataset.reportShortcut === byId("reportType").value;
                    button.classList.toggle("is-selected", selected);
                    button.setAttribute("aria-pressed", String(selected));
                });
            }
            function copyReportBriefing() {
                const filters = reportFilters();
                const report = reportData(filters);
                const briefing = [`SafeRoom · ${report.title.replace("Vista previa: ", "")}`, `Periodo: ${dateLabel(filters.from)} al ${dateLabel(filters.to)}`, `Contexto: ${reportContextLabel(filters)}`, ""].concat(report.rows.map((row) => `${row[0]}: ${row[1]}`)).join("\n");
                if (!navigator.clipboard?.writeText) return flash("Tu navegador no permite copiar automáticamente. Usa la descarga CSV.");
                navigator.clipboard.writeText(briefing).then(() => flash("Briefing copiado para compartir internamente.")).catch(() => flash("No fue posible copiar el briefing. Usa la descarga CSV."));
            }
            function exportReport() {
                const filters = reportFilters();
                const report = reportData(filters);
                const escapeCsv = (value) => `"${String(value ?? "").replaceAll("\"", "\"\"")}"`;
                const csvRows = [["Reporte", report.title.replace("Vista previa: ", "")], ["Periodo", `${filters.from} a ${filters.to}`], ["Contexto", reportContextLabel(filters)], [], report.headers].concat(report.rows);
                const csv = csvRows.map((row) => row.map(escapeCsv).join(",")).join("\n");
                const link = document.createElement("a");
                link.href = URL.createObjectURL(new Blob([`\uFEFF${csv}`], { type: "text/csv;charset=utf-8" }));
                link.download = `saferoom-${byId("reportType").value}-${filters.from || "demo"}.csv`;
                link.click();
                URL.revokeObjectURL(link.href);
                flash("Reporte CSV descargado con el corte y contexto aplicados.");
            }
            function fillContractOptions(selectId, selectedId, includeCancelled = false) {
                const select = byId(selectId);
                if (!select) return null;
                const contracts = state.contracts.filter((contract) => includeCancelled || isOpenContract(contract));
                select.innerHTML = contracts.map((contract) => { const tenant = tenantById(contract.tenantId); const box = boxById(contract.boxId); return `<option value="${contract.id}">${esc(`${contract.folio} · ${tenant?.name || "Sin titular"} · ${box?.code || "Sin caja"}`)}</option>`; }).join("");
                if (contracts.some((contract) => contract.id === selectedId)) select.value = selectedId;
                else if (contracts[0]) select.value = contracts[0].id;
                return contractById(select.value);
            }
            function renderRenewal() {
                const requestedContract = contractById(byId("rContract")?.value);
                if (requestedContract) state.ui.selectedContractId = requestedContract.id;
                let contract = fillContractOptions("rContract", state.ui.selectedContractId);
                if (!contract) { byId("renewalSummary").innerHTML = `<div class="empty">No hay contratos vigentes para renovar.</div>`; return; }
                state.ui.selectedContractId = contract.id;
                state.ui.selectedTenantId = contract.tenantId;
                const mode = byId("rMode").value;
                const box = boxById(contract.boxId);
                const options = state.boxes.filter((candidate) => candidate.status === "Disponible" && candidate.id !== box.id);
                const boxSelect = byId("rBox");
                const currentChoice = boxSelect.value;
                boxSelect.innerHTML = `<option value="">Conservar caja actual</option>${options.map((candidate) => `<option value="${candidate.id}">${esc(`${candidate.code} · ${candidate.size} · Disponible`)}</option>`).join("")}`;
                if (options.some((candidate) => candidate.id === currentChoice)) boxSelect.value = currentChoice;
                if (!byId("rStart").value || byId("rContract").dataset.contractId !== contract.id) {
                    const dayAfterEnd = new Date(`${contract.endDate}T12:00:00`);
                    dayAfterEnd.setDate(dayAfterEnd.getDate() + 1);
                    byId("rStart").value = dayAfterEnd.toISOString().slice(0, 10);
                    refreshSafeDate(byId("rStart"));
                }
                if (!byId("rRent").value || byId("rContract").dataset.contractId !== contract.id) byId("rRent").value = (contract.rentCents / 100).toFixed(2);
                byId("rContract").dataset.contractId = contract.id;
                const changesBox = ["move", "renew-size", "location", "size"].includes(mode);
                const nextBox = changesBox ? boxById(boxSelect.value) : box;
                const duration = Number(byId("rDuration").value) || 12;
                const endDate = addMonthsMinusOne(byId("rStart").value, duration);
                const rentCents = Math.round((Number(byId("rRent").value) || 0) * 100);
                const operationLabel = { renew: "Renovación", move: "Renovación con cambio de caja", "renew-size": "Renovación con cambio de medida", location: "Cambio de ubicación", size: "Cambio de medida" }[mode];
                const difference = rentCents - contract.rentCents;
                byId("renewalSummary").innerHTML = `<p class="muted">${esc(operationLabel)}</p><b>${esc(contract.folio)}</b><div class="summary-row"><span>Caja actual</span><b>${esc(`${box.code} · ${box.size}`)}</b></div><div class="summary-row"><span>${changesBox ? "Nueva caja" : "Caja a conservar"}</span><b>${esc(nextBox ? `${nextBox.code} · ${nextBox.size}` : "Selecciona una caja")}</b></div>${["renew", "move", "renew-size"].includes(mode) ? `<div class="summary-row"><span>Vigencia nueva</span><b>${esc(`${duration} meses · hasta ${dateLabel(endDate)}`)}</b></div>` : `<div class="summary-row"><span>Vigencia</span><b>Se conserva sin renovar</b></div>`}<div class="summary-row"><span>Renta actual</span><b>${fmtCents(contract.rentCents)}</b></div><div class="summary-total"><span>${["size", "renew-size"].includes(mode) ? "Nueva renta / diferencia" : "Nueva renta"}</span><span style="float:right">${fmtCents(rentCents)}${["size", "renew-size"].includes(mode) ? ` · ${difference >= 0 ? "+" : ""}${fmtCents(difference)}` : ""}</span></div>`;
            }
            function requestRenewalConfirmation() {
                const contract = contractById(byId("rContract").value);
                if (!isOpenContract(contract)) return flash("Solo pueden renovarse contratos vigentes.");
                if (!byId("rReviewed").checked) return flash("Confirma la revisión de caja, llaves, importes y documentos.");
                const mode = byId("rMode").value;
                const changesBox = ["move", "renew-size", "location", "size"].includes(mode);
                const nextBox = changesBox ? boxById(byId("rBox").value) : boxById(contract.boxId);
                if (!nextBox || (changesBox && (nextBox.id === contract.boxId || nextBox.status !== "Disponible"))) return flash("Selecciona otra caja disponible para el cambio.");
                if (["renew", "move", "renew-size"].includes(mode) && !byId("rStart").value) return flash("Indica la fecha de inicio de la nueva vigencia.");
                byId("lifecycleConfirmEyebrow").textContent = `${{ renew: "RENOVACIÓN", move: "RENOVACIÓN", "renew-size": "RENOVACIÓN", location: "CAMBIO DE UBICACIÓN", size: "CAMBIO DE MEDIDA" }[mode]} · DEMO`;
                byId("lifecycleConfirmTitle").textContent = { renew: "Confirmar renovación", move: "Confirmar renovación y cambio de caja", "renew-size": "Confirmar renovación con cambio de medida", location: "Confirmar cambio de ubicación", size: "Confirmar cambio de medida y recálculo" }[mode];
                byId("lifecycleConfirmText").textContent = ["renew", "move", "renew-size"].includes(mode) ? "Se conservará el historial de la operación, se simulará el timbrado y se actualizará la vigencia." : "Se registra primero la modificación contractual. Después puede continuar con una renovación.";
                byId("lifecycleConfirmSummary").innerHTML = byId("renewalSummary").innerHTML;
                byId("lifecycleConfirmAction").onclick = completeRenewal;
                byId("lifecycleConfirm").classList.add("on");
            }
            function completeRenewal() {
                const contract = contractById(byId("rContract").value);
                if (!isOpenContract(contract)) return flash("El contrato ya no está disponible para renovación.");
                const mode = byId("rMode").value;
                const oldBox = boxById(contract.boxId);
                const changesBox = ["move", "renew-size", "location", "size"].includes(mode);
                const nextBox = changesBox ? boxById(byId("rBox").value) : oldBox;
                if (!nextBox || (changesBox && nextBox.status !== "Disponible")) return flash("La caja seleccionada dejó de estar disponible.");
                const previous = { boxId: contract.boxId, startDate: contract.startDate, endDate: contract.endDate, rentCents: contract.rentCents };
                const duration = Number(byId("rDuration").value) || 12;
                if (["renew", "move", "renew-size"].includes(mode)) { contract.startDate = byId("rStart").value; contract.endDate = addMonthsMinusOne(contract.startDate, duration); contract.durationMonths = duration; }
                contract.rentCents = Math.round((Number(byId("rRent").value) || 0) * 100);
                contract.status = "Activo";
                if (changesBox) { oldBox.status = "Disponible"; nextBox.status = "Ocupada"; contract.boxId = nextBox.id; }
                const operationType = { renew: "Renovación", move: "Renovación con cambio de caja", "renew-size": "Renovación con cambio de medida", location: "Cambio de ubicación", size: "Cambio de medida" }[mode];
                state.operations.unshift({ id: createDemoId("operation"), contractId: contract.id, type: operationType, occurredAt: new Date().toISOString(), detail: `Anterior: ${boxById(previous.boxId).code} · ${dateLabel(previous.startDate)} a ${dateLabel(previous.endDate)} · ${fmtCents(previous.rentCents)}` });
                state.ui.selectedTenantId = contract.tenantId;
                state.ui.selectedContractId = contract.id;
                closeLifecycleConfirmation();
                logAudit(operationType, contract.folio, "Correcto", false);
                persistState();
                flash(`${operationType} guardado${["renew", "move", "renew-size"].includes(mode) ? "; timbrado simulado." : ". Ya puede renovar el contrato cuando corresponda."}`);
                showView("tenant", { tab: "Contratos" });
            }
            function renderCancellation() {
                const requestedContract = contractById(byId("xContract")?.value);
                if (requestedContract) state.ui.selectedContractId = requestedContract.id;
                const contract = fillContractOptions("xContract", state.ui.selectedContractId);
                if (!contract) { byId("cancellationSummary").innerHTML = `<div class="empty">No hay contratos vigentes para cancelar.</div>`; return; }
                state.ui.selectedContractId = contract.id;
                state.ui.selectedTenantId = contract.tenantId;
                const box = boxById(contract.boxId);
                const keys = Number((byId("xKeys").value || "2").match(/^\d+/)?.[0] || 0);
                byId("cancellationSummary").innerHTML = `<div class="summary-row"><span>Contrato activo</span><b>${esc(contract.folio)}</b></div><div class="summary-row"><span>Caja actual</span><b>${esc(box?.code)}</b></div><div class="summary-row"><span>Garantía registrada</span><b>${fmtCents(contract.depositCents)}</b></div><div class="summary-row"><span>Llaves devueltas</span><b>${keys} de ${box?.keys || 2}</b></div><div class="summary-total"><span>Devolución propuesta*</span><span style="float:right">${fmtCents(contract.depositCents)}</span></div>`;
            }
            function requestCancellationConfirmation() {
                const contract = contractById(byId("xContract").value);
                if (!isOpenContract(contract)) return flash("Solo pueden cancelarse contratos vigentes.");
                if (!byId("xReviewed").checked) return flash("Confirma la revisión de llaves, garantía y documentos.");
                byId("lifecycleConfirmEyebrow").textContent = "CANCELACIÓN · DEMO";
                byId("lifecycleConfirmTitle").textContent = "Confirmar cancelación de contrato";
                byId("lifecycleConfirmText").textContent = "Se liberará solamente la caja de este contrato y se registrará una devolución de garantía simulada.";
                byId("lifecycleConfirmSummary").innerHTML = byId("cancellationSummary").innerHTML;
                byId("lifecycleConfirmAction").onclick = completeCancellation;
                byId("lifecycleConfirm").classList.add("on");
            }
            function completeCancellation() {
                const contract = contractById(byId("xContract").value);
                if (!isOpenContract(contract)) return flash("El contrato ya fue cancelado o no es vigente.");
                const box = boxById(contract.boxId);
                const cancellationDate = byId("xDate").value;
                if (!cancellationDate) return flash("Indica la fecha de cancelación.");
                contract.status = "Cancelado";
                contract.cancelledAt = cancellationDate;
                contract.cancellationReason = byId("xReason").value;
                contract.cancellationNotes = byId("xNotes").value.trim();
                contract.keysReturned = Number((byId("xKeys").value.match(/^\d+/) || [0])[0]);
                if (box) box.status = "Disponible";
                state.movements.unshift({ id: createDemoId("movement"), folio: `DG-2026-${String(nextSequence(state.movements, "folio", 1)).padStart(4, "0")}`, tenantId: contract.tenantId, contractId: contract.id, concept: "Devolución propuesta de garantía", method: "Transferencia", amountCents: -contract.depositCents, type: "Devolución de garantía", status: "Simulada", occurredAt: cancellationDate });
                state.operations.unshift({ id: createDemoId("operation"), contractId: contract.id, type: "Cancelación", occurredAt: `${cancellationDate}T12:00:00`, detail: `${contract.cancellationReason} · ${contract.keysReturned} llaves devueltas` });
                closeLifecycleConfirmation();
                logAudit("Canceló contrato", contract.folio, "Simulado", false);
                persistState();
                flash(`Contrato ${contract.folio} cancelado; caja ${box?.code || ""} liberada.`);
                showView("tenant", { tab: "Contratos" });
            }
            function renderSettings() {
                const settings = state.settings || {};
                const availabilityAlert = byId("availabilityAlert");
                const availabilityLimit = byId("availabilityLimit");
                const availabilityMessage = byId("availabilityMessage");
                if (!availabilityAlert || !availabilityLimit || !availabilityMessage) return;
                availabilityAlert.value = settings.availabilityAlert === "Inactiva" ? "Inactiva" : "Activa";
                availabilityLimit.value = settings.availabilityLimit || "25%";
                availabilityMessage.value = settings.availabilityMessage || "Disponibilidad de cajas por debajo del límite";
                byId("birthdayAlert").value = settings.birthdayAlert === "Inactivo" ? "Inactivo" : "Activo";
                byId("birthdayLeadDays").value = settings.birthdayLeadDays || "0";
                byId("biometricProvider").value = settings.biometricProvider || "BioStar 2";
                byId("biometricEnabled").value = settings.biometricEnabled || "Configuración pendiente";
                byId("biometricEndpoint").value = settings.biometricEndpoint || "";
                const available = state.boxes.filter((box) => box.status === "Disponible").length;
                const percentage = Math.round((available / Math.max(state.boxes.length, 1)) * 100);
                const target = byId("settingsFeedback");
                const birthdayCount = state.tenants.filter((tenant) => tenant.birthDate).length;
                if (target) target.innerHTML = `${availabilityAlert.value === "Activa" ? `<b>Indicador actual:</b> ${percentage}% de cajas disponibles. La alerta se mostrará en Inicio cuando la disponibilidad sea igual o menor al límite.` : `<b>Alertas de disponibilidad inactivas.</b>`}<br /><br />${byId("birthdayAlert").value === "Activo" ? `<b>Cumpleaños:</b> recordatorio configurado para ${byId("birthdayLeadDays").selectedOptions[0].text.toLowerCase()}. Se revisarán ${birthdayCount} perfiles con fecha de nacimiento; esta demo no envía correos o mensajes.` : `<b>Cumpleaños:</b> recordatorios inactivos.`}`;
            }
            function saveSettings() {
                const limitInput = byId("availabilityLimit").value.replace(",", ".").replace(/[^0-9.]/g, "");
                const limit = Math.min(100, Math.max(0, Number(limitInput) || 0));
                const message = byId("availabilityMessage").value.trim().slice(0, 140) || "Disponibilidad de cajas por debajo del límite";
                state.settings = { availabilityAlert: byId("availabilityAlert").value, availabilityLimit: `${limit}%`, availabilityMessage: message, birthdayAlert: byId("birthdayAlert").value, birthdayLeadDays: byId("birthdayLeadDays").value, biometricProvider: byId("biometricProvider").value, biometricEnabled: byId("biometricEnabled").value, biometricEndpoint: byId("biometricEndpoint").value.trim().slice(0, 120) };
                logAudit("Actualizó alertas", `Disponibilidad ≤ ${limit}%`, "Correcto", false);
                persistState();
                renderSettings();
                renderHome();
                flash("Configuración de alertas guardada en esta demo.");
            }
            function testBiometricConfiguration() {
                const provider = byId("biometricProvider").value;
                const status = byId("biometricEnabled").value;
                const reference = byId("biometricEndpoint").value.trim();
                byId("biometricFeedback").innerHTML = status === "Simulación conectada"
                    ? `<b>${esc(provider)} listo para simulación.</b> ${reference ? `Referencia: ${esc(reference)}.` : "Sin servidor externo configurado."} No se conectó ningún dispositivo ni se transmitieron datos biométricos.`
                    : `<b>Conexión no activa.</b> Configura proveedor, estado y referencia antes de una integración real.`;
                flash("Validación biométrica ejecutada solo en modo demostración.");
            }
            function closeInvoiceModal() {
                byId("invoiceModal")?.classList.remove("on");
            }
            function syncInvoiceContracts() {
                const tenantId = byId("invoiceTenant")?.value;
                const select = byId("invoiceContract");
                if (!select) return;
                const contracts = contractsForTenant(tenantId).filter(isOpenContract);
                select.innerHTML = contracts.map((contract) => {
                    const box = boxById(contract.boxId);
                    return `<option value="${esc(contract.id)}">${esc(`${contract.folio} · ${box?.code || "Sin caja"}`)}</option>`;
                }).join("");
                const contract = contractById(select.value);
                if (contract) byId("invoiceAmount").value = (contract.rentCents / 100).toFixed(2);
                syncInvoiceProfile();
            }
            function syncInvoiceProfile() {
                const tenant = tenantById(byId("invoiceTenant")?.value);
                const profile = byId("invoiceProfile")?.value || "general";
                const help = byId("invoiceProfileHelp");
                if (!help || !tenant) return;
                const hasFiscalData = Boolean(tenant.rfc && tenant.taxRegime && tenant.billingEmail);
                help.innerHTML = profile === "general"
                    ? `<b>Público general:</b> se usa el perfil genérico configurado; no se emite a nombre del arrendatario.`
                    : hasFiscalData
                        ? `<b>Datos del arrendatario listos:</b> ${esc(tenant.rfc)} · ${esc(tenant.taxRegime)} · ${esc(tenant.billingEmail)}.`
                        : `<b>Datos fiscales incompletos.</b> Registra RFC, régimen y correo de facturación o usa Público general.`;
            }
            function openInvoiceModal() {
                const tenantSelect = byId("invoiceTenant");
                if (!tenantSelect) return;
                const currentTenant = selectedContract()?.tenantId || selectedTenant()?.id;
                tenantSelect.innerHTML = state.tenants.map((tenant) => `<option value="${esc(tenant.id)}">${esc(tenant.name)}</option>`).join("");
                if (tenantById(currentTenant)) tenantSelect.value = currentTenant;
                byId("invoiceConcept").value = "Renta mensual";
                byId("invoiceMethod").value = "Transferencia";
                byId("invoiceProfile").value = "general";
                syncInvoiceContracts();
                if (!byId("invoiceContract").value) return flash("El arrendatario seleccionado no tiene un contrato vigente para facturar.");
                byId("invoiceModal").classList.add("on");
                setTimeout(() => byId("invoiceAmount")?.focus(), 0);
            }
            function registerInvoice() {
                const tenantId = byId("invoiceTenant").value;
                const contract = contractById(byId("invoiceContract").value);
                const tenant = tenantById(tenantId);
                const amountCents = Math.round((Number(byId("invoiceAmount").value) || 0) * 100);
                if (!tenantById(tenantId) || !contract || contract.tenantId !== tenantId || !isOpenContract(contract) || amountCents <= 0) return flash("Completa un arrendatario, contrato vigente e importe mayor a cero.");
                if (byId("invoiceProfile").value === "tenant" && (!tenant.rfc || !tenant.taxRegime || !tenant.billingEmail)) return flash("Completa RFC, régimen fiscal y correo de facturación, o selecciona Público general.");
                const number = nextSequence(state.movements, "folio", 48);
                const folio = `FAC-2026-${String(number).padStart(4, "0")}`;
                state.movements.unshift({ id: createDemoId("movement"), folio, tenantId, contractId: contract.id, concept: byId("invoiceConcept").value.trim().slice(0, 80) || "Renta mensual", method: byId("invoiceMethod").value, amountCents, type: "Factura", profile: byId("invoiceProfile").value, status: "Simulada", occurredAt: new Date().toISOString().slice(0, 10) });
                logAudit("Registró factura", `${folio} · ${contract.folio}`, "Simulado", false);
                persistState();
                closeInvoiceModal();
                renderFinance();
                flash(`Factura ${folio} registrada como simulación; no se generó CFDI.`);
            }
            function closeUserModal() {
                byId("userModal")?.classList.remove("on");
            }
            function applyDemoProfile() {
                const isVaultProfile = CURRENT_USER.role === "Encargado de bóveda";
                const isC4Profile = CURRENT_USER.role === "Operador C4";
                const profile = { name: CURRENT_USER.name, role: CURRENT_USER.role, initials: CURRENT_USER.initials };
                state.ui.activeProfile = isVaultProfile ? "vault" : isC4Profile ? "c4" : "standard";
                byId("side").classList.toggle("vault-mode", isVaultProfile);
                byId("side").classList.toggle("c4-mode", isC4Profile);
                document.querySelectorAll(".nav").forEach((nav) => {
                    nav.hidden = !isAllowedView(nav.dataset.view);
                });
                document.querySelectorAll("[data-nav-section]").forEach((label) => {
                    label.hidden = !Array.from(document.querySelectorAll(`.nav[data-section="${label.dataset.navSection}"]`)).some((nav) => !nav.hidden);
                });
                byId("side").querySelector(".restore").hidden = CURRENT_USER.role !== "Administrador";
                if (byId("vaultOperations")) byId("vaultOperations").style.display = isC4Profile ? "none" : "";
                if (byId("vaultVerification")) byId("vaultVerification").style.display = isC4Profile ? "none" : "";
                if (byId("vaultAudit")) byId("vaultAudit").style.display = isC4Profile ? "none" : "";
                if (byId("accessEyebrow")) byId("accessEyebrow").textContent = isC4Profile ? "BÓVEDA · CONTROL DE PUERTA" : "BÓVEDA · CONTROL OPERATIVO";
                if (byId("accessHeading")) byId("accessHeading").textContent = isC4Profile ? "Puerta de bóveda · C4" : "Accesos a la bóveda";
                if (byId("accessDescription")) byId("accessDescription").textContent = isC4Profile ? "C4 monitorea por cámaras y controla a distancia la puerta de la bóveda; los clientes no ingresan a C4. La validación y las firmas las registra el encargado de bóveda." : "El encargado valida la entrada de una persona; la salida se actualiza con su firma simulada.";
                ["profileName", "profilePanelName"].forEach((id) => byId(id).textContent = profile.name);
                ["profileRole", "profilePanelRole"].forEach((id) => byId(id).textContent = profile.role);
                ["profileInitials", "profilePanelInitials"].forEach((id) => byId(id).textContent = profile.initials);
            }
            function enterVaultProfile() {
                flash("Para operar como Encargado de bóveda, inicia sesión con esa cuenta de demostración.");
            }
            function enterC4Profile() {
                flash("Para operar como C4, inicia sesión con esa cuenta de demostración.");
            }
            function exitVaultProfile() {
                flash("Cierra sesión para cambiar de perfil.");
            }
            function openUserModal() {
                byId("userName").value = "";
                byId("userEmail").value = "";
                byId("userRole").value = "Recepción";
                byId("userModal").classList.add("on");
                setTimeout(() => byId("userName")?.focus(), 0);
            }
            function renderDemoUsers() {
                const target = byId("demoUserList");
                if (!target) return;
                target.innerHTML = state.users.map((user) => {
                    const isVaultUser = user.role === "Encargado de bóveda";
                    const isC4User = user.role === "Operador C4";
                    const restriction = isVaultUser ? "Registra entradas, salidas y firmas" : isC4User ? "Acceso exclusivo: Bóveda · Control de puerta" : "";
                    return `<div class="activity"><span><b>${esc(user.name)}</b><br><small class="muted">${esc(user.email)} · ${esc(user.role)}</small>${restriction ? `<br><small class="muted">${restriction}</small>` : ""}</span><span>${badge(user.status)}</span></div>`;
                }).join("") || `<div class="empty">Sin usuarios configurados.</div>`;
            }
            function saveDemoUser() {
                const name = byId("userName").value.trim().slice(0, 90);
                const email = byId("userEmail").value.trim().toLowerCase().slice(0, 120);
                const role = byId("userRole").value;
                if (name.length < 3 || !email.includes("@")) return flash("Indica nombre completo y un correo válido.");
                if (state.users.some((user) => user.email.toLowerCase() === email)) return flash("Ese correo ya está registrado en la demo.");
                state.users.push({ id: createDemoId("user"), name, email, role, status: "Activo" });
                logAudit("Agregó usuario", `${name} · ${role}`, "Correcto", false);
                persistState();
                closeUserModal();
                renderDemoUsers();
                flash("Usuario agregado solo a los datos locales de la demo.");
            }
            function resetDemo() {
                if (!window.confirm("¿Restablecer todos los datos locales de la demo? Esta acción no se puede deshacer.")) return;
                state = clone(seedState);
                try { localStorage.removeItem(DEMO_STORAGE_KEY); } catch (_) {}
                currentTenantTab = "Resumen";
                byId("contractConfirm").classList.remove("on");
                byId("lifecycleConfirm").classList.remove("on");
                closeInvoiceModal();
                closeUserModal();
                applyDemoProfile();
                persistState();
                flash("Datos de demo restablecidos.");
                showView("home");
            }
            document.addEventListener("keydown", (event) => {
                if (event.key === "Escape") { closeContractConfirmation(); closeLifecycleConfirmation(); closeInvoiceModal(); closeUserModal(); closeDocumentViewer(); closeHeaderPanels(); }
            });
            syncSelectionFromUrl();
            initialiseSafeDates();
            initialiseHeaderControls();
            byId("documentRows").addEventListener("click", (event) => {
                const button = event.target.closest("[data-document-id]");
                if (button && !button.disabled) previewRecordedDocument(button.dataset.documentId);
            });
            applyDemoProfile();
            const requestForm = byId("form");
            requestForm.addEventListener("input", (event) => {
                if (event.target.matches("input, select, textarea")) syncRequestRequirements();
            });
            if (initialView === "form") {
                const request = requestById(state.ui.selectedRequestId);
                const tenant = request && tenantById(request.tenantId);
                const draft = request && state.ui.draft?.requestId !== request.id && tenant
                    ? formDraftFromTenant(tenant, request)
                    : state.ui.draft || {};
                state.ui.draft = draft;
                fillRequestForm(draft);
            }
            showView(initialView, { sync: false, scroll: false, tab: currentTenantTab });
            setInterval(updateAccessElapsedTimers, 1000);
        </script>
    </body>
</html>
