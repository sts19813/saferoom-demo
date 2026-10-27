<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>SafeRoom · Demo operativa</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
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
                --shadow: 0 1px 2px rgb(20 20 40 / 0.04), 0 6px 20px rgb(20 20 40 / 0.05);
            }
            * {
                box-sizing: border-box;
            }
            body {
                margin: 0;
                background: var(--bg);
                font:
                    14px Montserrat,
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
                outline: 3px solid rgb(255 202 1 / 0.40);
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
                height: 118px;
                padding: 0 25px;
                display: flex;
                align-items: center;
                gap: 12px;
                border-bottom: 1px solid #eee6df;
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
                max-height: 88px;
                object-fit: contain;
                object-position: left center;
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
                transition: transform .16s ease, background .16s ease;
            }
            .nav:hover .ico { transform: scale(1.06); }
            .nav[data-view="requests"] .ico { color: #2c7ed2; background: #e8f3ff; }
            .nav[data-view="boxes"] .ico { color: #87560e; background: #fff2d9; }
            .nav[data-view="tenants"] .ico { color: #c24f80; background: #fdebf3; }
            .nav[data-view="contracts"] .ico { color: #7a57bf; background: #f0eaff; }
            .nav[data-view="renewals"] .ico { color: #238368; background: #e5f7f1; }
            .nav[data-view="cancellations"] .ico { color: #c65b43; background: #feeee9; }
            .nav[data-view="access"] .ico { color: #237994; background: #e6f5f8; }
            .nav[data-view="documents"] .ico { color: #586ec0; background: #ebefff; }
            .nav[data-view="reports"] .ico { color: #9c6c19; background: #fff5dc; }
            .nav[data-view="finance"] .ico { color: #168661; background: #e6f8ef; }
            .nav.on .ico { background: var(--gold); color: var(--navy); box-shadow: 0 4px 10px #d49f0033; }
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
                background: linear-gradient(90deg, #fbf6f2 0%, #fffdfb 58%, #f8f0e4 100%);
                border-bottom: 1px solid #eadfd3;
                box-shadow: inset 0 -3px 0 var(--gold), 0 3px 16px rgb(54 52 52 / 0.04);
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
                background: rgb(255 255 255 / .72);
                box-shadow: 0 2px 8px rgb(54 52 52 / .035);
                text-align: left;
                transition: background .16s ease, border-color .16s ease, box-shadow .16s ease;
            }
            .profile:hover {
                background: #fff;
                border-color: #e5c75d;
                box-shadow: 0 6px 15px rgb(54 52 52 / .08);
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
            .top-divider { width: 1px; height: 26px; margin: 0 2px; background: #e6ddd5; }
            .header-popover-wrap { position: relative; }
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
                transition: background .16s ease, border-color .16s ease, color .16s ease;
            }
            .utility-button:hover { border-color: #ead9a0; background: #fff4cc; color: #5c4800; }
            .utility-button svg { width: 18px; height: 18px; }
            .notification-dot { position: absolute; top: 8px; right: 8px; width: 6px; height: 6px; border: 1.5px solid #fffaf5; border-radius: 50%; background: #d39f00; }
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
                box-shadow: 0 20px 44px rgb(54 52 52 / .17), 0 3px 10px rgb(54 52 52 / .06);
                text-align: left;
            }
            .top-popover[hidden] { display: none; }
            .top-popover__head { display: flex; align-items: center; justify-content: space-between; padding: 15px 16px 12px; border-bottom: 1px solid #eee5de; }
            .top-popover__head b { color: var(--ink); font-size: 13px; }
            .top-popover__head span { color: #987400; font-size: 10px; font-weight: 800; letter-spacing: .07em; text-transform: uppercase; }
            .notification-item { display: flex; gap: 10px; padding: 13px 16px; border-bottom: 1px solid #f1eae4; }
            .notification-item:last-child { border-bottom: 0; }
            .notification-icon { display: grid; width: 30px; height: 30px; flex: none; place-items: center; border-radius: 9px; background: #fff1bc; color: #765b00; font-size: 14px; }
            .notification-item b { display: block; color: var(--ink); font-size: 11px; }
            .notification-item p { margin: 3px 0 0; color: var(--muted); font-size: 10px; line-height: 1.45; }
            .profile-popover { width: 278px; }
            .profile-summary { display: flex; align-items: center; gap: 10px; padding: 15px 16px; border-bottom: 1px solid #eee5de; }
            .profile-summary .avatar { width: 36px; height: 36px; }
            .profile-summary b { display: block; color: var(--ink); font-size: 12px; }.profile-summary span { color: var(--muted); font-size: 10px; }
            .theme-row { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 14px 16px; }
            .theme-row b { display: block; color: var(--ink); font-size: 11px; }.theme-row span { color: var(--muted); font-size: 10px; }
            .theme-switch { position: relative; width: 42px; height: 24px; flex: none; cursor: pointer; }.theme-switch input { position: absolute; opacity: 0; }.theme-switch__track { display: block; height: 100%; border-radius: 999px; background: #e5ddd5; transition: background .18s ease; }.theme-switch__track::after { position: absolute; top: 3px; left: 3px; width: 18px; height: 18px; border-radius: 50%; background: #fff; box-shadow: 0 1px 4px rgb(54 52 52 / .25); content: ""; transition: transform .18s ease; }.theme-switch input:checked + .theme-switch__track { background: #363434; }.theme-switch input:checked + .theme-switch__track::after { transform: translateX(18px); }
            body[data-theme="dark"] { --bg: #201e1d; --surface: #2a2827; --ink: #f7f0e9; --muted: #c5bab0; --line: #4a4541; --shadow: 0 1px 2px rgb(0 0 0 / .18), 0 10px 28px rgb(0 0 0 / .2); }
            body[data-theme="dark"] .side { background: linear-gradient(180deg, #2a2827, #211f1e); color: #c5bab0; }
            body[data-theme="dark"] .brand { border-color: #4a4541; } body[data-theme="dark"] .nav:hover { background: #383431; color: #fff; } body[data-theme="dark"] .nav.on { background: #554617; color: #fff0b6; }
            body[data-theme="dark"] .top { background: linear-gradient(90deg, #292625, #35312e); border-color: #4d463e; } body[data-theme="dark"] .crumb { color: #c5bab0; } body[data-theme="dark"] .top strong { color: #fffaf4; }
            body[data-theme="dark"] .profile, body[data-theme="dark"] .top-popover { border-color: #514a44; background: #302d2b; } body[data-theme="dark"] .profile:hover { background: #393532; } body[data-theme="dark"] .top-divider { background: #514a44; }
            body[data-theme="dark"] .utility-button { color: #eee3da; } body[data-theme="dark"] .utility-button:hover { background: #4a3d18; } body[data-theme="dark"] .top-popover__head, body[data-theme="dark"] .profile-summary, body[data-theme="dark"] .notification-item { border-color: #4b4540; }
            body[data-theme="dark"] .notification-item b, body[data-theme="dark"] .top-popover__head b, body[data-theme="dark"] .profile-summary b, body[data-theme="dark"] .theme-row b { color: #fffaf4; }
            body[data-theme="dark"] .field input, body[data-theme="dark"] .field select, body[data-theme="dark"] .search input, body[data-theme="dark"] .safe-date { background-color: #302d2b; color: #fffaf4; border-color: #514a44; }
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
                background: linear-gradient(125deg, #363434 0%, #514c49 62%, #6b635d 100%);
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
                transition: transform .16s ease, box-shadow .16s ease, background .16s ease;
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
            .outline:hover { border-color: #e3b400; background: #fffaf0; }
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
                transition: transform .18s ease, box-shadow .18s ease;
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
                letter-spacing: .015em;
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
                transition: border-color .16s ease, box-shadow .16s ease, background .16s ease;
            }
            .field input:hover, .field select:hover, .search input:hover { border-color: #c8c6d0; background: #fff; }
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
                transition: border-color .16s ease, box-shadow .16s ease, background-color .16s ease;
            }
            .toolbar select { min-width: 156px; }
            .field select:hover, .toolbar select:hover { border-color: #aaa3e5; background-color: #fff; }
            .field select:focus, .toolbar select:focus { outline: none; border-color: #d39f00; box-shadow: 0 0 0 4px #ffca012b; background-color: #fff; }
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
                transition: border-color .16s ease, box-shadow .16s ease, background-color .16s ease;
            }
            .safe-date:hover { border-color: #d6b13c; background: #fffdf8; }
            .safe-date:focus-within { border-color: #d39f00; box-shadow: 0 0 0 4px #ffca012b; background: #fff; }
            .safe-date__value { min-width: 0; flex: 1; padding: 10px 0 10px 12px; color: var(--ink); font-size: 13px; font-weight: 650; white-space: nowrap; }
            .safe-date__trigger { display: grid; width: 38px; height: 38px; flex: none; place-items: center; margin-right: 2px; border-radius: 9px; background: transparent; color: #947100; }
            .safe-date__trigger:hover { background: #fff1bc; }
            .safe-date__trigger svg { width: 17px; height: 17px; }
            .safe-date__native { position: absolute; width: 1px !important; height: 1px !important; overflow: hidden; opacity: 0; pointer-events: none; }
            .safe-date--readonly { background: #f8f4f0; color: var(--muted); }
            .safe-date--readonly .safe-date__trigger { display: none; }
            .safe-calendar { position: absolute; top: calc(100% + 9px); left: 0; z-index: 20; width: 286px; padding: 13px; border: 1px solid #e8dfd6; border-radius: 16px; background: #fffdfb; box-shadow: 0 18px 40px rgb(54 52 52 / .17), 0 2px 7px rgb(54 52 52 / .06); }
            .safe-calendar[hidden] { display: none; }
            .safe-calendar__head { display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 12px; }
            .safe-calendar__month { color: var(--ink); font-size: 13px; font-weight: 800; text-transform: capitalize; }
            .safe-calendar__actions { display: flex; gap: 4px; }
            .safe-calendar__nav { display: grid; width: 29px; height: 29px; place-items: center; border: 1px solid #eee4d8; border-radius: 8px; background: #fff; color: #645e58; font-size: 17px; line-height: 1; }
            .safe-calendar__nav:hover { background: #fff1bc; border-color: #edcf65; color: #5c4900; }
            .safe-calendar__week, .safe-calendar__days { display: grid; grid-template-columns: repeat(7, 1fr); text-align: center; }
            .safe-calendar__week { margin-bottom: 4px; color: #9b938a; font-size: 10px; font-weight: 800; }
            .safe-calendar__day { display: grid; width: 32px; height: 32px; place-items: center; margin: 1px auto; border-radius: 9px; background: transparent; color: var(--ink); font-size: 12px; font-weight: 650; }
            .safe-calendar__day:hover { background: #fff1bc; color: #493900; }
            .safe-calendar__day--muted { color: #c0b9b2; }
            .safe-calendar__day--today { box-shadow: inset 0 0 0 1px #e3bb25; }
            .safe-calendar__day--selected { background: var(--navy); color: #fff; box-shadow: 0 4px 10px rgb(54 52 52 / .18); }
            .safe-calendar__day--selected:hover { background: var(--navy); color: #fff; }
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
            .box-card {
                border: 1px solid #e4e4e9;
                border-radius: 16px;
                padding: 16px;
                text-align: left;
                background: linear-gradient(145deg, #fff, #f8f8f9);
                min-height: 145px;
                color: var(--ink);
                box-shadow: 0 2px 5px rgb(20 20 40 / 0.025);
                transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
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
            .box-card:disabled { opacity: .72; cursor: not-allowed; }
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
                letter-spacing: .04em;
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
                border-top: 1px solid rgb(255 255 255 / .16);
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
                background: linear-gradient(125deg, #363434 0%, #514c49 62%, #6b635d 100%);
                color: #fff;
                border-radius: 18px;
                padding: 28px 30px;
                box-shadow: 0 14px 28px rgb(54 52 52 / .13);
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
                box-shadow: 0 6px 16px rgb(255 202 1 / .24);
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
            .small-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 13px;
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
                .top-divider { display: none; }
                .top-popover { position: fixed; top: 70px; right: 16px; left: 16px; width: auto; }
            }
        </style>
    </head>
    <body>
        <a class="skip-link" href="#contenido-principal">Saltar al contenido</a>
        <aside class="side" id="side">
            <div class="brand">
                <img class="brand-logo" src="{{ asset('images/saferoom-logo.png') }}" alt="SafeRoom" />
            </div>
            <nav>
                <p class="nav-label">OPERACIÓN</p>
                <button class="nav on" data-view="home">
                    <span class="ico">◫</span><span>Inicio</span></button
                ><button class="nav" data-view="requests">
                    <span class="ico">☷</span><span>Solicitudes</span></button
                ><button class="nav" data-view="boxes">
                    <span class="ico">▣</span><span>Cajas</span></button
                ><button class="nav" data-view="tenants">
                    <span class="ico">♙</span><span>Arrendatarios</span></button
                ><button class="nav" data-view="contracts">
                    <span class="ico">▤</span><span>Contratos</span>
                </button>
                <p class="nav-label" style="margin-top: 25px">GESTIÓN</p>
                <button class="nav" data-view="renewals">
                    <span class="ico">↻</span><span>Renovaciones</span></button
                ><button class="nav" data-view="cancellations">
                    <span class="ico">⊘</span><span>Cancelaciones</span></button
                ><button class="nav" data-view="access">
                    <span class="ico">⌁</span><span>Accesos</span></button
                ><button class="nav" data-view="documents">
                    <span class="ico">◱</span><span>Documentos</span></button
                ><button class="nav" data-view="reports">
                    <span class="ico">▥</span><span>Reportes</span>
                </button>
                <button class="nav" data-view="finance">
                    <span class="ico">$</span><span>Finanzas</span>
                </button>
                <p class="nav-label" style="margin-top: 25px">CONFIGURACIÓN</p>
                <button class="nav" data-view="settings">
                    <span class="ico">⚙</span><span>Catálogos y alertas</span>
                </button>
                <button class="nav" data-view="users">
                    <span class="ico">♧</span><span>Usuarios y permisos</span>
                </button>
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
                    <div class="header-popover-wrap">
                        <button class="utility-button" type="button" onclick="toggleHeaderPanel('notificationPanel')" aria-label="Ver notificaciones" aria-expanded="false" aria-controls="notificationPanel" id="notificationButton">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"></path><path d="M10 22h4"></path></svg>
                            <span class="notification-dot" aria-hidden="true"></span>
                        </button>
                        <section class="top-popover" id="notificationPanel" hidden aria-label="Notificaciones">
                            <header class="top-popover__head"><b>Notificaciones</b><span>2 nuevas</span></header>
                            <div class="notification-item"><div class="notification-icon">✓</div><div><b>Acceso validado</b><p>Mariana López Canto registró acceso a la bóveda.</p></div></div>
                            <div class="notification-item"><div class="notification-icon">!</div><div><b>Contrato próximo a vencer</b><p>CT-2026-0148 requiere seguimiento dentro de 30 días.</p></div></div>
                        </section>
                    </div>
                    <span class="top-divider" aria-hidden="true"></span>
                    <div class="header-popover-wrap">
                        <button class="profile" type="button" onclick="toggleHeaderPanel('profilePanel')" aria-label="Opciones del perfil" aria-expanded="false" aria-controls="profilePanel" id="profileButton">
                            <i class="avatar">AC</i>
                            <span><b>Andrea Castillo</b><br /><small>Administración</small></span>
                        </button>
                        <section class="top-popover profile-popover" id="profilePanel" hidden aria-label="Opciones de perfil">
                            <div class="profile-summary"><i class="avatar">AC</i><div><b>Andrea Castillo</b><span>Administración</span></div></div>
                            <label class="theme-row"><span><b>Modo oscuro</b><span>Interfaz de operación nocturna</span></span><span class="theme-switch"><input id="themeToggle" type="checkbox" onchange="setTheme(this.checked)" aria-label="Activar modo oscuro" /><span class="theme-switch__track"></span></span></label>
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
                            <h1>Operación de cajas, contratos y clientes.</h1>
                            <p>
                                Una vista central para administrar el ciclo
                                completo de arrendamiento y presentar las
                                capacidades del sistema modernizado.
                            </p>
                        </div>
                        <div>
                            <button class="btn gold" onclick="showView('form')">
                                ＋ Nueva solicitud
                            </button>
                            <button
                                class="btn outline"
                                onclick="showView('boxes')"
                            >
                                Ver cajas
                            </button>
                        </div>
                    </div>
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
                            <div class="metric">12</div>
                            <span class="muted">En los siguientes 30 días</span>
                        </article>
                        <article class="card">
                            <span class="muted">ACCESOS HOY</span>
                            <div class="metric">37</div>
                            <span class="tag blue">SIMULACIÓN BIOMÉTRICA</span>
                        </article>
                    </div>
                    <div class="two">
                        <section class="panel">
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
                                <p class="notice" style="margin-top: 18px">
                                    <b>Dato confirmado:</b> cada caja física
                                    tiene cerradura y dos llaves.
                                </p>
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
                                Prospectos pendientes de asignación y
                                contratación.
                            </p>
                        </div>
                        <button class="btn primary" onclick="startRequest()">
                            ＋ Nueva solicitud
                        </button>
                    </div>
                    <section class="panel">
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
                                        <th>Caja solicitada</th>
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
                    <p class="eyebrow" style="margin-top: 20px">PASO 1 DE 3</p>
                    <h1>Nueva solicitud</h1>
                    <p class="muted">
                        Registra los datos iniciales y asigna una caja
                        disponible.
                    </p>
                    <div class="split" style="margin-top: 22px">
                        <div class="panel section">
                            <h2>Datos de la persona solicitante</h2>
                            <p class="muted">
                                Campos relevantes observados en el sistema
                                anterior, organizados para la primera etapa.
                            </p>
                            <div class="fields">
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
                            <details class="form-group">
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
                                </div>
                            </details>
                            <details class="form-group">
                                <summary>
                                    Empresa, facturación y expediente
                                </summary>
                                <p class="form-helper">
                                    Se conserva la estructura para trabajo,
                                    perfil fiscal y expediente; aún no se
                                    conectan documentos ni CFDI.
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
                                <p class="notice" style="margin-top: 14px">
                                    Expediente, identificación y documentos se
                                    muestran en la ficha como simulación: su
                                    almacenamiento, vencimiento y privacidad
                                    siguen pendientes de definición.
                                </p>
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
                            <h2>Caja solicitada</h2>
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
                                    >Consulta disponibilidad para
                                    continuar.</small
                                >
                            </div>
                            <button
                                class="btn outline"
                                style="width: 100%; margin-top: 14px"
                                onclick="showView('boxes')"
                            >
                                Seleccionar caja</button
                            ><button
                                class="btn primary"
                                style="width: 100%; margin-top: 10px"
                                onclick="createRequest()"
                            >
                                Continuar al contrato →
                            </button>
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
                            ><span
                                class="muted"
                                style="margin: auto 0 auto auto"
                                >Verde: disponible · Gris: ocupada · Ámbar:
                                reservada</span
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
                    <button class="btn outline" onclick="showView('form')">
                        ← Editar solicitud
                    </button>
                    <p class="eyebrow" style="margin-top: 20px">PASO 3 DE 3</p>
                    <h1>Generar contrato</h1>
                    <p class="muted">
                        Confirma condiciones, autorizados, caja y resumen
                        financiero.
                    </p>
                    <div class="split" style="margin-top: 22px">
                        <div class="panel section">
                            <h2>Contrato de arrendamiento</h2>
                            <p class="muted">
                                Datos de ejemplo; no constituye un documento
                                legal o fiscal.
                            </p>
                            <div class="fields">
                                <div class="field">
                                    <label>ARRENDATARIO</label
                                    ><input id="cTenant" readonly />
                                </div>
                                <div class="field">
                                    <label>CAJA ASIGNADA</label
                                    ><input id="cBox" readonly />
                                </div>
                                <div class="field">
                                    <label>VIGENCIA</label
                                    ><select
                                        id="cDuration"
                                        onchange="updateContractDates()"
                                    >
                                        <option>12 meses</option>
                                        <option>6 meses</option>
                                        <option>18 meses</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>INICIO</label
                                    ><input
                                        id="cStart"
                                        type="date"
                                        value="2026-11-01"
                                    />
                                </div>
                                <div class="field">
                                    <label>TIPO DE CONTRATO</label
                                    ><select id="cType">
                                        <option>Nuevo</option>
                                        <option>Renovación</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>FECHA DE VENCIMIENTO</label
                                    ><input id="cEnd" readonly />
                                </div>
                                <div class="field">
                                    <label>DÍA DE PAGO</label
                                    ><select id="cPaymentDay">
                                        <option>Día 1</option>
                                        <option>Día 5</option>
                                        <option>Día 10</option>
                                        <option>Día 15</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>FORMA DE PAGO</label
                                    ><select id="cPaymentMethod">
                                        <option>Transferencia</option>
                                        <option>Efectivo</option>
                                        <option>Tarjeta</option>
                                    </select>
                                </div>
                            </div>
                            <hr
                                style="
                                    border: 0;
                                    border-top: 1px solid var(--line);
                                    margin: 25px 0;
                                "
                            />
                            <h2>Autorizados y llaves</h2>
                            <div class="selected">
                                <b id="cAuth"
                                    >Sin persona autorizada registrada</b
                                >
                                <p class="muted" id="cAuthPhone">
                                    Puedes completar este dato en la solicitud.
                                </p>
                            </div>
                            <div class="notice" style="margin-top: 13px">
                                🔐 Se registrará la entrega de
                                <b>2 llaves</b> para la caja seleccionada. La
                                generación de formato es una simulación.
                            </div>
                            <details class="form-group">
                                <summary>
                                    Beneficiarios y personal de apoyo
                                </summary>
                                <p class="form-helper">
                                    Capacidades observadas en el contrato. Su
                                    relación exacta y permisos aún deben
                                    validarse.
                                </p>
                                <div class="fields">
                                    <div class="field">
                                        <label>BENEFICIARIO</label
                                        ><input
                                            id="cBeneficiary"
                                            placeholder="Nombre completo"
                                        />
                                    </div>
                                    <div class="field">
                                        <label>PERSONAL DE APOYO</label
                                        ><input
                                            id="cSupport"
                                            placeholder="Nombre completo"
                                        />
                                    </div>
                                </div>
                            </details>
                        </div>
                        <aside class="panel section">
                            <h2>Resumen financiero</h2>
                            <p class="muted">
                                Vista previa de factura · simulación fiscal
                            </p>
                            <div class="field" style="margin-top: 16px">
                                <label>RENTA MENSUAL</label
                                ><input
                                    id="rent"
                                    type="number"
                                    oninput="calc()"
                                />
                            </div>
                            <div class="field" style="margin-top: 13px">
                                <label>DEPÓSITO EN GARANTÍA</label
                                ><input
                                    id="deposit"
                                    type="number"
                                    oninput="calc()"
                                />
                            </div>
                            <div style="margin-top: 16px">
                                <div class="summary-row">
                                    <span>Renta</span><span id="sumRent"></span>
                                </div>
                                <div class="summary-row">
                                    <span>Depósito</span
                                    ><span id="sumDeposit"></span>
                                </div>
                                <div class="summary-row">
                                    <span>IVA estimado (16%)</span
                                    ><span id="sumIva"></span>
                                </div>
                                <div class="summary-total">
                                    <span>Total inicial</span
                                    ><span
                                        id="sumTotal"
                                        style="float: right"
                                    ></span>
                                </div>
                            </div>
                            <div class="notice" style="margin-top: 16px">
                                <label
                                    style="display: block; margin-bottom: 8px"
                                    ><input
                                        id="cKeysConfirmed"
                                        type="checkbox"
                                    />
                                    Se registrará la entrega de dos
                                    llaves.</label
                                >
                                <label style="display: block"
                                    ><input
                                        id="cReviewConfirmed"
                                        type="checkbox"
                                    />
                                    Confirmé los datos de contrato y
                                    caja.</label
                                >
                            </div>
                            <button
                                class="btn primary"
                                style="width: 100%; margin-top: 20px"
                                onclick="requestContractConfirmation()"
                            >
                                ✓ Generar contrato y factura</button
                            ><small
                                class="muted"
                                style="
                                    display: block;
                                    text-align: center;
                                    margin-top: 10px;
                                "
                                >El timbrado CFDI es una simulación.</small
                            >
                        </aside>
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
                        <button class="btn primary" onclick="startRequest()">
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
                            <h1>Renovaciones y cambios de caja</h1>
                            <p class="muted">
                                Capacidad observada en el sistema anterior.
                                Regla comercial pendiente de validación.
                            </p>
                        </div>
                        <span class="tag amber">SIMULACIÓN</span>
                    </div>
                    <div class="split">
                        <section class="panel section">
                            <h2>Preparar renovación o cambio</h2>
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
                            <p class="eyebrow">GESTIÓN · DEMO</p>
                            <h1>Historial de accesos</h1>
                            <p class="muted">
                                Interfaz de operación; integración biométrica y
                                hardware aún por definir.
                            </p>
                        </div>
                        <span class="tag blue">SIMULACIÓN BIOMÉTRICA</span>
                    </div>
                    <div class="two">
                        <section class="panel">
                            <div class="panel-head">
                                <div>
                                    <b>Entradas pendientes de confirmación</b>
                                    <p class="muted">
                                        La autorización se revisa contra
                                        contrato/caja de demostración.
                                    </p>
                                </div>
                                <button
                                    class="btn outline"
                                    onclick="renderAccessQueue()"
                                >
                                    ↻ Actualizar
                                </button>
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
                            <h2>Validación de acceso</h2>
                            <div id="accessVerification" class="notice">
                                Selecciona una persona pendiente para revisar su
                                acceso.
                            </div>
                            <p class="notice" style="margin-top: 14px">
                                <b>Biometría:</b> el video muestra esta
                                capacidad, pero dispositivo, proveedor,
                                privacidad y contingencia manual siguen
                                pendientes. Esta pantalla solo simula la
                                decisión de acceso.
                            </p>
                        </section>
                    </div>
                    <section class="panel" style="margin-top: 20px">
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
                        <div>
                            <p class="eyebrow">GESTIÓN · SIMULACIÓN</p>
                            <h1>Documentos y llaves</h1>
                            <p class="muted">
                                Formatos observados: contrato, constancia de
                                entrega de llaves y recibo de depósito.
                            </p>
                        </div>
                    </div>
                    <section class="panel">
                        <div class="panel-body">
                            <div class="small-grid">
                                <div class="card">
                                    <b>Contrato de arrendamiento</b>
                                    <p class="muted" style="margin: 8px 0">
                                        Plantilla con datos de cliente, caja y
                                        vigencia.
                                    </p>
                                    <button
                                        class="btn outline"
                                        onclick="
                                            previewDocument(
                                                'Contrato de arrendamiento',
                                            )
                                        "
                                    >
                                        Vista previa
                                    </button>
                                </div>
                                <div class="card">
                                    <b>Entrega de llaves</b>
                                    <p class="muted" style="margin: 8px 0">
                                        Constancia para dos llaves de la caja.
                                    </p>
                                    <button
                                        class="btn outline"
                                        onclick="
                                            previewDocument(
                                                'Constancia de entrega de llaves',
                                            )
                                        "
                                    >
                                        Generar formato
                                    </button>
                                </div>
                                <div class="card">
                                    <b>Depósito en garantía</b>
                                    <p class="muted" style="margin: 8px 0">
                                        Recibo de depósito de ejemplo.
                                    </p>
                                    <button
                                        class="btn outline"
                                        onclick="
                                            previewDocument(
                                                'Recibo de depósito en garantía',
                                            )
                                        "
                                    >
                                        Generar recibo
                                    </button>
                                </div>
                                <div class="card">
                                    <b>Expediente</b>
                                    <p class="muted" style="margin: 8px 0">
                                        Archivos y documentos asociados al
                                        arrendatario.
                                    </p>
                                    <button
                                        class="btn outline"
                                        onclick="
                                            previewDocument(
                                                'Expediente de arrendatario',
                                            )
                                        "
                                    >
                                        Consultar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="panel section" style="margin-top: 20px">
                        <div
                            class="panel-head"
                            style="margin: -20px -20px 18px"
                        >
                            <div>
                                <b id="documentPreviewTitle"
                                    >Vista previa documental</b
                                >
                                <p class="muted">
                                    Selecciona un formato para revisar los datos
                                    que incluiría.
                                </p>
                            </div>
                            <span class="tag amber">SIMULACIÓN</span>
                        </div>
                        <div id="documentPreview" class="notice">
                            No se ha seleccionado un documento. Los formatos no
                            crean archivos ni solicitan firmas en esta demo.
                        </div>
                    </section>
                </section>
                <section class="view" id="reports">
                    <div class="heading">
                        <div>
                            <p class="eyebrow">GESTIÓN · SIMULACIÓN</p>
                            <h1>Reportes operativos</h1>
                            <p class="muted">
                                Representación de los reportes administrativos,
                                disponibilidad y accesos observados.
                            </p>
                        </div>
                        <button class="btn primary" onclick="exportReport()">
                            ⇩ Exportar XLS
                        </button>
                    </div>
                    <div class="grid4">
                        <article class="card">
                            <span class="muted">INGRESOS DEL MES</span>
                            <div class="metric">$327,900</div>
                            <span class="tag amber">SIMULADO</span>
                        </article>
                        <article class="card">
                            <span class="muted">CAJAS OCUPADAS</span>
                            <div class="metric" id="reportOccupied">7</div>
                            <span class="muted">Disponibilidad actual</span>
                        </article>
                        <article class="card">
                            <span class="muted">SOLICITUDES</span>
                            <div class="metric" id="reportRequests">3</div>
                            <span class="muted">Periodo actual</span>
                        </article>
                        <article class="card">
                            <span class="muted">ACCESOS</span>
                            <div class="metric">37</div>
                            <span class="muted">Registro de ejemplo</span>
                        </article>
                    </div>
                    <section class="panel section">
                        <div class="toolbar" style="margin: -20px -20px 20px">
                            <select id="reportType" onchange="renderReport()">
                                <option value="general">
                                    General para consejo
                                </option>
                                <option value="availability">
                                    Disponibilidad de cajas
                                </option>
                                <option value="access">
                                    Accesos por arrendatario
                                </option>
                                <option value="finance">
                                    Ingresos y garantías
                                </option></select
                            ><input
                                id="reportFrom"
                                type="date"
                                value="2026-10-01"
                                onchange="renderReport()"
                            /><input
                                id="reportTo"
                                type="date"
                                value="2026-10-31"
                                onchange="renderReport()"
                            /><button
                                class="btn outline"
                                onclick="renderReport()"
                            >
                                Actualizar vista
                            </button>
                        </div>
                        <h2 id="reportPreviewTitle">
                            Vista previa: reporte general para consejo
                        </h2>
                        <div class="table-wrap" style="margin-top: 16px">
                            <table>
                                <thead id="reportPreviewHead"></thead>
                                <tbody id="reportPreviewRows"></tbody>
                            </table>
                        </div>
                    </section>
                    <section class="panel section" style="margin-top: 20px">
                        <h2>Reportes disponibles en el alcance</h2>
                        <div class="small-grid" style="margin-top: 18px">
                            <div class="notice">
                                <b>General para consejo</b><br />Solicitudes,
                                ingresos, ocupación, garantías y contratos
                                activos.
                            </div>
                            <div class="notice">
                                <b>Disponibilidad de cajas</b><br />Vista por
                                colores, medida, área y estado.
                            </div>
                            <div class="notice">
                                <b>Accesos por arrendatario</b><br />Filtros por
                                persona, caja y rango de fechas.
                            </div>
                            <div class="notice">
                                <b>Fiscal</b><br />Representación prevista; no
                                hay integración CFDI real.
                            </div>
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
                                    ><select>
                                        <option>Activa</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>LÍMITE PORCENTUAL</label
                                    ><input value="25%" />
                                </div>
                                <div class="field wide">
                                    <label>MENSAJE</label
                                    ><input
                                        value="Disponibilidad de cajas por debajo del límite"
                                    />
                                </div>
                            </div>
                            <button
                                class="btn primary"
                                style="margin-top: 18px"
                                onclick="
                                    flash(
                                        'Configuración guardada solo en esta simulación.',
                                    )
                                "
                            >
                                Guardar simulación
                            </button>
                        </section>
                        <section class="panel section">
                            <h2>Capacidades identificadas</h2>
                            <p class="notice">
                                Catálogos, roles/permisos, alertas, facturación,
                                biométricos, firmas, otros ingresos y
                                comunicación manual mediante Kommo. No hay
                                integración con Kommo ni servicios externos en
                                esta demo.
                            </p>
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
                                <tbody>
                                    <tr>
                                        <td>
                                            <b>Mariana López Canto</b
                                            ><br /><small class="muted"
                                                >LOCM9004127A4</small
                                            >
                                        </td>
                                        <td>A-101 · S</td>
                                        <td>CT-2026-0148</td>
                                        <td>13 nov 2026</td>
                                        <td>
                                            <span class="tag green"
                                                >Activo</span
                                            >
                                        </td>
                                        <td>
                                            <button
                                                class="btn outline"
                                                onclick="showView('tenant')"
                                            >
                                                Ver ficha
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Carlos Méndez Ruiz</b
                                            ><br /><small class="muted"
                                                >MERC840822N21</small
                                            >
                                        </td>
                                        <td>A-105 · M</td>
                                        <td>CT-2026-0149</td>
                                        <td>20 dic 2026</td>
                                        <td>
                                            <span class="tag green"
                                                >Activo</span
                                            >
                                        </td>
                                        <td>
                                            <button
                                                class="btn outline"
                                                onclick="
                                                    flash(
                                                        'Ficha de ejemplo disponible en la siguiente iteración.',
                                                    )
                                                "
                                            >
                                                Ver ficha
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Blanca González Gómez</b
                                            ><br /><small class="muted"
                                                >GOGB860211P91</small
                                            >
                                        </td>
                                        <td>B-202 · L</td>
                                        <td>CT-2026-0141</td>
                                        <td>22 nov 2026</td>
                                        <td>
                                            <span class="tag amber"
                                                >Por renovar</span
                                            >
                                        </td>
                                        <td>
                                            <button
                                                class="btn outline"
                                                onclick="showView('renewals')"
                                            >
                                                Renovar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
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
                            onclick="flash('Nueva factura simulada.')"
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
                            onclick="flash('Alta de usuario simulada.')"
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
            <section class="invoice">
                <p class="eyebrow">REVISIÓN FINAL · DEMO</p>
                <h2 id="contractConfirmTitle">
                    Confirmar generación de contrato
                </h2>
                <p class="muted" style="margin-top: 8px">
                    Esta acción simula ocupar la caja, crear el contrato,
                    registrar dos llaves y emitir una factura de ejemplo.
                </p>
                <div
                    class="selected"
                    id="contractConfirmSummary"
                    style="margin-top: 18px"
                ></div>
                <p class="notice" style="margin-top: 14px">
                    No se genera un documento legal ni un CFDI real. Los
                    cálculos y reglas comerciales son de demostración.
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
                        onclick="closeContractConfirmation()"
                    >
                        Volver a editar</button
                    ><button class="btn primary" onclick="saveContract()">
                        Confirmar contrato
                    </button>
                </div>
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
        <div id="toast" class="toast"></div>
        <script>
            const seedBoxes = [
                ["A-101", "S", "Acceso A", "Ocupada", 1290],
                ["A-102", "S", "Acceso A", "Disponible", 1290],
                ["A-103", "S", "Acceso A", "Disponible", 1290],
                ["A-104", "M", "Acceso A", "Reservada", 1890],
                ["A-105", "M", "Acceso A", "Ocupada", 1890],
                ["B-201", "M", "Nivel B", "Disponible", 1890],
                ["B-202", "L", "Nivel B", "Ocupada", 2590],
                ["B-203", "L", "Nivel B", "Disponible", 2590],
                ["B-204", "L", "Nivel B", "Mantenimiento", 2590],
                ["C-301", "XL", "Nivel C", "Ocupada", 3490],
                ["C-302", "XL", "Nivel C", "Disponible", 3490],
                ["C-303", "XL", "Nivel C", "Ocupada", 3490],
            ];
            const seedRequests = [
                [
                    "SOL-0032",
                    "Sofía Herrera",
                    "B-201 · Mediana",
                    "Hoy, 09:42",
                    "Nueva",
                    "sofia.herrera@ejemplo.mx",
                    "999 312 4578",
                ],
                [
                    "SOL-0031",
                    "Daniela Cruz",
                    "A-102 · Pequeña",
                    "Ayer, 16:10",
                    "En revisión",
                    "daniela.cruz@ejemplo.mx",
                    "999 425 1087",
                ],
                [
                    "SOL-0030",
                    "Alberto Torres",
                    "C-302 · Extra grande",
                    "Ayer, 11:25",
                    "Nueva",
                    "alberto.torres@ejemplo.mx",
                    "999 140 9833",
                ],
            ];
            let boxes = structuredClone(seedBoxes),
                requests = structuredClone(seedRequests),
                draft = {},
                activeTenant = {
                    name: "Mariana López Canto",
                    email: "mariana.lopez@ejemplo.mx",
                    phone: "999 261 4587",
                    rfc: "LOCM9004127A4",
                    box: "A-101",
                    contract: "CT-2026-0148",
                    auth: "José Luis López",
                };
            const seedFinanceMovements = [
                [
                    "F-2026-1637",
                    "Mariana López Canto",
                    "Renta + depósito",
                    "Transferencia",
                    2786,
                    "Simulada",
                ],
                [
                    "OI-2026-0032",
                    "Carlos Méndez Ruiz",
                    "Reposición de llaves",
                    "Tarjeta",
                    450,
                    "Registrado",
                ],
            ];
            let financeMovements = structuredClone(seedFinanceMovements);
            const seedAccessQueue = [
                {
                    id: "a-1",
                    name: "José Luis López",
                    box: "A-101",
                    type: "Autorizado",
                    contract: "CT-2026-0148",
                    status: "Pendiente",
                },
                {
                    id: "a-2",
                    name: "Rejón Pérez Juan Manuel",
                    box: "D-127",
                    type: "Titular",
                    contract: "CT-2026-0141",
                    status: "Pendiente",
                },
                {
                    id: "a-3",
                    name: "Daniela Cruz",
                    box: "A-102",
                    type: "Titular",
                    contract: "Sin contrato",
                    status: "Requiere revisión",
                },
            ];
            let accessQueue = structuredClone(seedAccessQueue);
            const seedAuditLog = [
                [
                    "31 oct 2026 · 09:42",
                    "Andrea Castillo",
                    "Creó solicitud",
                    "SOL-0032",
                    "Correcto",
                ],
                [
                    "31 oct 2026 · 09:12",
                    "Seguridad",
                    "Actualizó entradas",
                    "Accesos",
                    "Simulado",
                ],
                [
                    "30 oct 2026 · 16:10",
                    "Andrea Castillo",
                    "Consultó arrendatario",
                    "Mariana López",
                    "Correcto",
                ],
            ];
            let auditLog = structuredClone(seedAuditLog);
            const fmt = (n) =>
                new Intl.NumberFormat("es-MX", {
                    style: "currency",
                    currency: "MXN",
                    maximumFractionDigits: 0,
                }).format(n);
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
            function routeFor(id, tab = null) {
                const url = new URL(viewRoutes[id] || viewRoutes.home, window.location.origin);
                if (id === "tenant" && tab && tab !== "Resumen") url.searchParams.set("tab", tab);
                return `${url.pathname}${url.search}`;
            }
            function showView(id, options = {}) {
                if (!document.getElementById(id)) id = "home";
                document
                    .querySelectorAll(".view")
                    .forEach((x) => x.classList.remove("on"));
                document.getElementById(id).classList.add("on");
                const activeNav = navParent[id] || id;
                document
                    .querySelectorAll(".nav")
                    .forEach((x) =>
                        x.classList.toggle("on", x.dataset.view === activeNav),
                    );
                document.getElementById("pageTitle").textContent = title[id];
                document.getElementById("side").classList.remove("open");
                if (id === "boxes") renderBoxes();
                if (id === "requests") renderRequests();
                if (id === "home") renderHome();
                if (id === "contracts") renderContracts();
                if (id === "reports") renderHome();
                if (id === "reports") renderReport();
                if (id === "finance") renderFinance();
                if (id === "access") {
                    renderAccessQueue();
                    renderAuditLog();
                }
                if (id === "users") renderRolePermissions();
                if (id === "renewals") renderRenewal();
                if (id === "cancellations") renderCancellation();
                if (id === "tenant") renderTenant(options.tab || currentTenantTab, { sync: false });
                if (options.sync !== false) {
                    const target = routeFor(id, id === "tenant" ? (options.tab || currentTenantTab) : null);
                    if (`${location.pathname}${location.search}` !== target) history.pushState({ view: id }, "", target);
                }
                if (options.scroll !== false) scrollTo({ top: 0, behavior: "smooth" });
            }
            document
                .querySelectorAll(".nav")
                .forEach((x) => (x.onclick = () => showView(x.dataset.view)));
            window.addEventListener("popstate", () => {
                const entry = Object.entries(viewRoutes).find(([, route]) => new URL(route, location.origin).pathname === location.pathname);
                const view = entry ? entry[0] : "home";
                showView(view, { sync: false, scroll: false, tab: new URLSearchParams(location.search).get("tab") || "Resumen" });
            });
            function badge(s) {
                return `<span class="tag ${["Disponible", "Contratada", "Confirmado", "Correcto", "Registrado", "Activo"].includes(s) ? "green" : s === "Nueva" || s === "Simulado" ? "blue" : ["En revisión", "Reservada", "Pendiente", "Requiere revisión", "Revisión requerida"].includes(s) ? "amber" : "slate"}">${s}</span>`;
            }
            function renderRequests() {
                let q = document
                    .getElementById("requestSearch")
                    .value.toLowerCase();
                document.getElementById("requestRows").innerHTML = requests
                    .filter((r) => r.join(" ").toLowerCase().includes(q))
                    .map(
                        (r) =>
                            `<tr><td><b>${r[0]}</b></td><td><b>${r[1]}</b><br><small class="muted">${r[5]}</small></td><td>${r[2]}</td><td class="muted">${r[3]}</td><td>${badge(r[4])}</td><td><button class="btn outline" onclick="openRequest('${r[0]}')">Abrir</button></td></tr>`,
                    )
                    .join("");
            }
            function openRequest(id) {
                let r = requests.find((x) => x[0] === id);
                draft = { name: r[1], email: r[5], phone: r[6], boxId: "" };
                document.getElementById("fName").value = draft.name;
                document.getElementById("fEmail").value = draft.email;
                document.getElementById("fPhone").value = draft.phone;
                showView("form");
            }
            function startRequest() {
                draft = {};
                [
                    "fName",
                    "fEmail",
                    "fPhone",
                    "fRfc",
                    "fCurp",
                    "fBirthDate",
                    "fGender",
                    "fNationality",
                    "fCivilStatus",
                    "fSource",
                    "fStreet",
                    "fNeighborhood",
                    "fPostalCode",
                    "fMunicipality",
                    "fState",
                    "fReference",
                    "fReferencePhone",
                    "fCompany",
                    "fJobTitle",
                    "fTaxRegime",
                    "fCfdiUse",
                    "fBillingEmail",
                    "fAuth",
                    "fAuthPhone",
                ].forEach((i) => (document.getElementById(i).value = ""));
                selected();
                showView("form");
            }
            function renderBoxes() {
                let f = document.getElementById("boxStatus").value,
                    z = document.getElementById("boxSize").value;
                document.getElementById("selectionMode").style.display =
                    draft && Object.keys(draft).length ? "block" : "none";
                document.getElementById("boxGrid").innerHTML = boxes
                    .filter(
                        (b) =>
                            (f === "Todas" || b[3] === f) &&
                            (z === "Todas" || b[1] === z),
                    )
                    .map(
                        (b) =>
                            `<button class="box-card ${b[3] === "Disponible" ? "available" : ""} ${draft.boxId === b[0] ? "chosen" : ""}" ${b[3] !== "Disponible" ? "disabled" : ""} onclick="selectBox('${b[0]}')"><span class="tag ${tone(b[3])}">${b[3]}</span><b>▣ ${b[0]}</b><small class="muted">${b[2]} · Tamaño ${b[1]}</small><p style="margin:14px 0 0;border-top:1px solid #0000000b;padding-top:8px;font-size:12px">Renta base <strong style="float:right">${fmt(b[4])}</strong></p></button>`,
                    )
                    .join("");
            }
            function tone(s) {
                return s === "Disponible"
                    ? "green"
                    : s === "Ocupada"
                      ? "slate"
                      : s === "Reservada"
                        ? "amber"
                        : "blue";
            }
            function selectBox(id) {
                let b = boxes.find((x) => x[0] === id);
                if (!b || b[3] !== "Disponible") return;
                draft.boxId = id;
                selected();
                flash(`Caja ${id} seleccionada.`);
                showView("form");
            }
            function selected() {
                let b = boxes.find((x) => x[0] === draft.boxId),
                    el = document.getElementById("selectedBox"),
                    no = document.getElementById("noBox");
                if (b) {
                    el.style.display = "block";
                    no.style.display = "none";
                    el.innerHTML = `<b style="font-size:19px">${b[0]}</b><p class="muted">${b[2]} · Tamaño ${b[1]}</p><strong>${fmt(b[4])} / mes</strong>`;
                } else {
                    el.style.display = "none";
                    no.style.display = "block";
                }
            }
            function createRequest() {
                draft.name = document.getElementById("fName").value.trim();
                draft.email = document.getElementById("fEmail").value.trim();
                draft.phone = document.getElementById("fPhone").value.trim();
                draft.rfc = document.getElementById("fRfc").value.trim();
                draft.curp = document.getElementById("fCurp").value.trim();
                draft.birthDate = document.getElementById("fBirthDate").value;
                draft.gender = document.getElementById("fGender").value;
                draft.nationality = document
                    .getElementById("fNationality")
                    .value.trim();
                draft.civilStatus =
                    document.getElementById("fCivilStatus").value;
                draft.source = document.getElementById("fSource").value;
                draft.street = document.getElementById("fStreet").value.trim();
                draft.neighborhood = document
                    .getElementById("fNeighborhood")
                    .value.trim();
                draft.postalCode = document
                    .getElementById("fPostalCode")
                    .value.trim();
                draft.municipality = document
                    .getElementById("fMunicipality")
                    .value.trim();
                draft.state = document.getElementById("fState").value.trim();
                draft.reference = document
                    .getElementById("fReference")
                    .value.trim();
                draft.referencePhone = document
                    .getElementById("fReferencePhone")
                    .value.trim();
                draft.company = document
                    .getElementById("fCompany")
                    .value.trim();
                draft.jobTitle = document
                    .getElementById("fJobTitle")
                    .value.trim();
                draft.taxRegime = document.getElementById("fTaxRegime").value;
                draft.cfdiUse = document.getElementById("fCfdiUse").value;
                draft.billingEmail = document
                    .getElementById("fBillingEmail")
                    .value.trim();
                draft.auth = document.getElementById("fAuth").value.trim();
                draft.authPhone = document
                    .getElementById("fAuthPhone")
                    .value.trim();
                if (!draft.name || !draft.email)
                    return flash("Completa nombre y correo para continuar.");
                if (!draft.boxId) return showView("boxes");
                let b = boxes.find((x) => x[0] === draft.boxId);
                requests.unshift([
                    `SOL-${String(33 + requests.length).padStart(4, "0")}`,
                    draft.name,
                    `${b[0]} · ${b[1]}`,
                    "Ahora",
                    "En revisión",
                    draft.email,
                    draft.phone,
                ]);
                document.getElementById("cTenant").value = draft.name;
                document.getElementById("cBox").value =
                    `${b[0]} · ${b[2]} · ${b[1]}`;
                document.getElementById("cAuth").textContent =
                    draft.auth || "Sin persona autorizada registrada";
                document.getElementById("cAuthPhone").textContent =
                    draft.authPhone ||
                    "Puedes completar este dato en la solicitud.";
                document.getElementById("rent").value = b[4];
                document.getElementById("deposit").value = b[4];
                document.getElementById("cKeysConfirmed").checked = false;
                document.getElementById("cReviewConfirmed").checked = false;
                updateContractDates();
                calc();
                showView("contract");
            }
            function updateContractDates() {
                const start = document.getElementById("cStart").value;
                const duration =
                    Number(
                        document
                            .getElementById("cDuration")
                            .value.split(" ")[0],
                    ) || 12;
                if (!start) return;
                const date = new Date(`${start}T12:00:00`);
                date.setMonth(date.getMonth() + duration);
                date.setDate(date.getDate() - 1);
                document.getElementById("cEnd").value = date
                    .toISOString()
                    .slice(0, 10);
                refreshSafeDate(document.getElementById("cEnd"));
            }
            function requestContractConfirmation() {
                if (
                    !document.getElementById("cKeysConfirmed").checked ||
                    !document.getElementById("cReviewConfirmed").checked
                ) {
                    return flash(
                        "Confirma la revisión de datos y la entrega de dos llaves para continuar.",
                    );
                }
                const box = boxes.find((x) => x[0] === draft.boxId);
                document.getElementById("contractConfirmSummary").innerHTML =
                    `<b>${draft.name}</b><br><span class="muted">Caja ${box[0]} · ${document.getElementById("cDuration").value} · ${document.getElementById("cStart").value} a ${document.getElementById("cEnd").value}</span><p style="margin:10px 0 0"><b>Total inicial: ${document.getElementById("sumTotal").textContent}</b></p>`;
                document.getElementById("contractConfirm").classList.add("on");
            }
            function closeContractConfirmation() {
                document
                    .getElementById("contractConfirm")
                    .classList.remove("on");
            }
            function calc() {
                let r = +document.getElementById("rent").value || 0,
                    d = +document.getElementById("deposit").value || 0,
                    i = Math.round(r * 0.16);
                document.getElementById("sumRent").textContent = fmt(r);
                document.getElementById("sumDeposit").textContent = fmt(d);
                document.getElementById("sumIva").textContent = fmt(i);
                document.getElementById("sumTotal").textContent = fmt(
                    r + d + i,
                );
            }
            function saveContract() {
                let b = boxes.find((x) => x[0] === draft.boxId);
                if (!b) return showView("boxes");
                closeContractConfirmation();
                b[3] = "Ocupada";
                requests.forEach((r) => {
                    if (r[1] === draft.name) r[4] = "Contratada";
                });
                activeTenant = {
                    ...draft,
                    name: draft.name,
                    email: draft.email,
                    phone: draft.phone,
                    rfc: draft.rfc || "XAXX010101000",
                    box: b[0],
                    contract: `CT-2026-${150 + requests.length}`,
                    auth: draft.auth,
                    authPhone: draft.authPhone,
                    beneficiary: document
                        .getElementById("cBeneficiary")
                        .value.trim(),
                    support: document.getElementById("cSupport").value.trim(),
                    duration: document.getElementById("cDuration").value,
                    startDate: document.getElementById("cStart").value,
                    endDate: document.getElementById("cEnd").value,
                    paymentDay: document.getElementById("cPaymentDay").value,
                    paymentMethod:
                        document.getElementById("cPaymentMethod").value,
                    rent: Number(document.getElementById("rent").value) || 0,
                    deposit:
                        Number(document.getElementById("deposit").value) || 0,
                };
                renderTenant();
                logAudit("Generó contrato", activeTenant.contract, "Correcto");
                flash(
                    `Contrato ${activeTenant.contract} generado; caja ${b[0]} ocupada.`,
                );
                showView("tenant");
            }
            function renderTenant(tab = currentTenantTab, options = {}) {
                let t = activeTenant;
                document.getElementById("tenantName").textContent = t.name;
                document.getElementById("tenantInitials").textContent = t.name
                    .split(" ")
                    .slice(0, 2)
                    .map((x) => x[0])
                    .join("");
                document.getElementById("tenantContract").textContent =
                    `Arrendatario · ${t.contract}`;
                const safeTab = tenantTabs.includes(tab) ? tab : "Resumen";
                tenantTab(
                    safeTab,
                    [...document.querySelectorAll("#tenantTabs button")].find((button) => button.textContent.trim() === safeTab),
                    { sync: options.sync !== false },
                );
            }
            function tenantTab(tab, btn, options = {}) {
                if (!tenantTabs.includes(tab)) tab = "Resumen";
                currentTenantTab = tab;
                document
                    .querySelectorAll("#tenantTabs button")
                    .forEach((x) => x.classList.remove("on"));
                (btn || document.querySelector("#tenantTabs button")).classList.add("on");
                let t = activeTenant,
                    b = boxes.find((x) => x[0] === t.box);
                document.getElementById("tenantSectionTitle").textContent =
                    tab === "Resumen" ? "Información de contacto" : tab;
                const field = (label, value) =>
                    `<div class="field"><label>${label}</label><input value="${value || "Sin registro"}" readonly></div>`;
                const note = (title, text) =>
                    `<div class="notice wide"><b>${title}</b><br>${text}</div>`;
                const views = {
                    Resumen:
                        field("CORREO", t.email) +
                        field("TELÉFONO", t.phone) +
                        field("RFC", t.rfc) +
                        field("PERSONA AUTORIZADA", t.auth),
                    Generales:
                        field("CURP", t.curp) +
                        field("FECHA DE NACIMIENTO", t.birthDate) +
                        field("SEXO", t.gender) +
                        field("NACIONALIDAD", t.nationality) +
                        field("ESTADO CIVIL", t.civilStatus) +
                        field("CÓMO SE ENTERÓ", t.source),
                    Domicilio:
                        field("CALLE Y NÚMERO", t.street) +
                        field("COLONIA", t.neighborhood) +
                        field("CÓDIGO POSTAL", t.postalCode) +
                        field("MUNICIPIO", t.municipality) +
                        field("ESTADO", t.state) +
                        field("REFERENCIA", t.reference),
                    "Laboral y fiscal":
                        field("EMPRESA / RAZÓN SOCIAL", t.company) +
                        field("PUESTO / ACTIVIDAD", t.jobTitle) +
                        field("RÉGIMEN FISCAL", t.taxRegime) +
                        field("USO CFDI", t.cfdiUse) +
                        field("CORREO DE FACTURACIÓN", t.billingEmail),
                    Autorizados:
                        field("NOMBRE", t.auth) +
                        field("TELÉFONO", t.authPhone) +
                        field("BENEFICIARIO", t.beneficiary) +
                        field("PERSONAL DE APOYO", t.support) +
                        note(
                            "Acceso autorizado",
                            "La capacidad de validar vigencia y biometría permanece como simulación hasta definir hardware y reglas.",
                        ),
                    Cajas: note(
                        "Historial de cajas",
                        `Caja activa: <b>${t.box}</b>. La posibilidad de varias cajas activas requiere validación operativa.`,
                    ),
                    Contratos:
                        field("FOLIO", t.contract) +
                        field(
                            "VIGENCIA",
                            `${t.startDate || "Sin registro"} a ${t.endDate || "Sin registro"}`,
                        ) +
                        field("DURACIÓN", t.duration) +
                        field("DÍA DE PAGO", t.paymentDay) +
                        note(
                            "Historial contractual",
                            "Renovaciones, cambios y cancelaciones se consultan desde sus módulos de demostración.",
                        ),
                    Facturas:
                        field("RENTA", t.rent ? fmt(t.rent) : "Sin registro") +
                        field(
                            "DEPÓSITO",
                            t.deposit ? fmt(t.deposit) : "Sin registro",
                        ) +
                        field("FORMA DE PAGO", t.paymentMethod) +
                        note(
                            "Facturación",
                            "Perfil fiscal y CFDI se muestran como datos de referencia; no hay timbrado ni conciliación conectados.",
                        ),
                    Documentos: note(
                        "Expediente",
                        "Contrato, recibos e identificación forman parte del alcance, pero el almacenamiento documental es una simulación.",
                    ),
                    Accesos: note(
                        "Historial de accesos",
                        "Los registros de entrada/salida y la biometría se muestran como capacidad futura simulada.",
                    ),
                };
                document.getElementById("tenantMain").innerHTML =
                    views[tab] ||
                    note(tab, "Información pendiente de configuración.");
                document.getElementById("tenantBox").innerHTML = b
                    ? `<div class="selected"><b style="font-size:22px">${b[0]}</b><p class="muted">${b[2]} · Tamaño ${b[1]}</p><p>Renta mensual: <b>${fmt(b[4])}</b><br>Llaves: <b>2 asignadas</b></p></div>`
                    : `<div class="notice"><b>Sin caja activa</b><br>La caja fue liberada durante una cancelación simulada.</div>`;
                if (options.sync !== false && document.getElementById("tenant").classList.contains("on")) {
                    const target = routeFor("tenant", tab);
                    if (`${location.pathname}${location.search}` !== target) history.pushState({ view: "tenant", tab }, "", target);
                }
            }
            function renderHome() {
                let n = boxes.filter((x) => x[3] === "Ocupada").length;
                document.getElementById("occupancy").textContent =
                    Math.round((n / boxes.length) * 100) + "%";
                document.getElementById("occDetail").textContent =
                    `${n} de ${boxes.length} cajas ocupadas`;
                document.getElementById("contractsCount").textContent =
                    148 + (activeTenant.name !== "Mariana López Canto" ? 1 : 0);
                document.getElementById("reportOccupied").textContent = n;
                document.getElementById("reportRequests").textContent =
                    requests.length;
                document.getElementById("statusBars").innerHTML = [
                    "Disponible",
                    "Ocupada",
                    "Reservada",
                    "Mantenimiento",
                ]
                    .map((s) => {
                        let n = boxes.filter((x) => x[3] === s).length;
                        return `<div style="margin:13px 0"><div style="display:flex;justify-content:space-between;font-size:12px"><span>${s}</span><b>${n}</b></div><div class="bar"><i style="width:${(n / boxes.length) * 100}%;background:${s === "Disponible" ? "#168b62" : s === "Ocupada" ? "#64748b" : s === "Reservada" ? "#e9a522" : "#6693c5"}"></i></div></div>`;
                    })
                    .join("");
            }
            function renderContracts() {
                document.getElementById("contractRows").innerHTML = [
                    [
                        activeTenant.contract,
                        activeTenant.name,
                        activeTenant.box,
                        "01 nov 2026 · 12 meses",
                        "Factura simulada",
                        "Activo",
                    ],
                    [
                        "CT-2026-0148",
                        "Mariana López Canto",
                        "A-101",
                        "13 nov 2025 · 12 meses",
                        "Pendiente",
                        "Activo",
                    ],
                    [
                        "CT-2026-0149",
                        "Carlos Méndez Ruiz",
                        "A-105",
                        "20 dic 2025 · 12 meses",
                        "Facturada",
                        "Activo",
                    ],
                ]
                    .map(
                        (x) =>
                            `<tr>${x.map((v, i) => `<td>${i === 5 ? badge(v) : v}</td>`).join("")}</tr>`,
                    )
                    .join("");
            }
            function logAudit(action, entity, result = "Correcto") {
                auditLog.unshift([
                    new Date().toLocaleString("es-MX", {
                        dateStyle: "short",
                        timeStyle: "short",
                    }),
                    "Andrea Castillo",
                    action,
                    entity,
                    result,
                ]);
                renderAuditLog();
            }
            function renderAuditLog() {
                const body = document.getElementById("auditRows");
                if (!body) return;
                body.innerHTML = auditLog
                    .map(
                        (row) =>
                            `<tr><td>${row[0]}</td><td>${row[1]}</td><td>${row[2]}</td><td>${row[3]}</td><td>${badge(row[4])}</td></tr>`,
                    )
                    .join("");
            }
            function renderAccessQueue() {
                const target = document.getElementById("accessQueue");
                if (!target) return;
                const query = document
                    .getElementById("accessSearch")
                    .value.toLowerCase();
                const filter = document.getElementById("accessFilter").value;
                target.innerHTML =
                    accessQueue
                        .filter(
                            (item) =>
                                item.status !== "Confirmado" &&
                                (filter === "Todas" || item.type === filter) &&
                                `${item.name} ${item.box}`
                                    .toLowerCase()
                                    .includes(query),
                        )
                        .map(
                            (item) =>
                                `<div class="activity"><span><b>${item.name}</b><br><small class="muted">Caja ${item.box} · ${item.type} · ${item.contract}</small></span><span>${badge(item.status)} <button class="btn primary" style="margin-left:8px" onclick="selectAccess('${item.id}')">Validar</button></span></div>`,
                        )
                        .join("") ||
                    `<div class="empty">No hay accesos pendientes con esos filtros.</div>`;
            }
            function selectAccess(id) {
                const item = accessQueue.find((x) => x.id === id);
                const contractValid = item.contract !== "Sin contrato";
                document.getElementById("accessVerification").innerHTML =
                    `<b>${item.name}</b><br><span class="muted">${item.type} · Caja ${item.box}</span><div class="summary-row"><span>Contrato</span><b>${item.contract}</b></div><div class="summary-row"><span>Resultado de validación</span><b>${contractValid ? "Vigente en demo" : "Requiere revisión"}</b></div><div style="margin-top:14px">${contractValid ? `<button class="btn primary" onclick="confirmAccess('${id}')">Confirmar acceso</button>` : `<button class="btn outline" onclick="denyAccess('${id}')">Marcar excepción</button>`}</div>`;
            }
            function confirmAccess(id) {
                const item = accessQueue.find((x) => x.id === id);
                item.status = "Confirmado";
                logAudit(
                    "Confirmó acceso",
                    `${item.name} · ${item.box}`,
                    "Confirmado",
                );
                renderAccessQueue();
                document.getElementById("accessVerification").innerHTML =
                    `<b>Acceso confirmado</b><br><span class="muted">${item.name} quedó registrado solo en esta demostración.</span>`;
                flash("Acceso confirmado (simulación).");
            }
            function denyAccess(id) {
                const item = accessQueue.find((x) => x.id === id);
                item.status = "Excepción";
                logAudit(
                    "Marcó excepción de acceso",
                    `${item.name} · ${item.box}`,
                    "Revisión requerida",
                );
                renderAccessQueue();
                document.getElementById("accessVerification").innerHTML =
                    `<b>Excepción registrada</b><br><span class="muted">La persona no se autoriza automáticamente; requiere revisión operativa.</span>`;
                flash("Excepción de acceso registrada (simulación).");
            }
            function renderRolePermissions() {
                const target = document.getElementById("rolePermissions");
                if (!target) return;
                const role = document.getElementById("rolePreview").value;
                const roles = {
                    Administrador: [
                        [
                            "Operación",
                            "Crear, editar, renovar y cancelar contratos",
                        ],
                        ["Seguridad", "Confirmar accesos y revisar bitácora"],
                        ["Finanzas", "Consultar movimientos y reportes"],
                        [
                            "Configuración",
                            "Gestionar catálogos, alertas y perfiles",
                        ],
                    ],
                    Recepción: [
                        ["Operación", "Solicitudes, arrendatarios y contratos"],
                        [
                            "Seguridad",
                            "Solicitar y confirmar accesos según reglas",
                        ],
                        ["Finanzas", "Consulta limitada de facturas"],
                        ["Configuración", "Sin acceso a parámetros críticos"],
                    ],
                    Finanzas: [
                        ["Operación", "Consulta de contratos"],
                        ["Seguridad", "Sin confirmación de accesos"],
                        [
                            "Finanzas",
                            "Facturas, garantías, otros ingresos y reportes",
                        ],
                        ["Configuración", "Sin edición de perfiles"],
                    ],
                };
                target.innerHTML = roles[role]
                    .map(
                        (item) =>
                            `<div class="notice"><b>${item[0]}</b><br>${item[1]}</div>`,
                    )
                    .join("");
            }
            function previewDocument(type) {
                const contract = activeTenant.contract || "CT-2026-0148";
                const box = activeTenant.box || "A-101";
                const details = {
                    "Contrato de arrendamiento": `Arrendatario: <b>${activeTenant.name}</b><br>Contrato: <b>${contract}</b><br>Caja: <b>${box}</b><br>Vigencia y condiciones: datos de demostración.`,
                    "Constancia de entrega de llaves": `Caja: <b>${box}</b><br>Llaves entregadas: <b>2</b><br>Responsable y firma: simulados.`,
                    "Recibo de depósito en garantía": `Arrendatario: <b>${activeTenant.name}</b><br>Depósito de demostración: <b>${fmt(activeTenant.deposit || 1290)}</b><br>Sin efecto fiscal o legal.`,
                    "Expediente de arrendatario": `Documentos previstos: identificación, contrato, comprobantes y formatos. El almacenamiento documental aún no está conectado.`,
                };
                document.getElementById("documentPreviewTitle").textContent =
                    type;
                document.getElementById("documentPreview").innerHTML =
                    details[type];
                flash(`${type}: vista previa actualizada.`);
            }
            function renderFinance() {
                const body = document.getElementById("financeRows");
                if (!body) return;
                body.innerHTML = financeMovements
                    .map(
                        (m) =>
                            `<tr><td>${m[0]}</td><td>${m[1]}</td><td>${m[2]}</td><td>${m[3]}</td><td>${fmt(m[4])}</td><td>${badge(m[5])}</td></tr>`,
                    )
                    .join("");
            }
            function registerOtherIncome() {
                const concept = document.getElementById("incomeConcept").value;
                const tenant = document.getElementById("incomeTenant").value;
                const amount = Number(
                    document.getElementById("incomeAmount").value,
                );
                const method = document.getElementById("incomeMethod").value;
                if (!amount || amount <= 0)
                    return flash("Indica un importe mayor que cero.");
                financeMovements.unshift([
                    `OI-2026-${String(33 + financeMovements.length).padStart(4, "0")}`,
                    tenant,
                    concept,
                    method,
                    amount,
                    "Registrado",
                ]);
                renderFinance();
                logAudit(
                    "Registró otro ingreso",
                    `${concept} · ${fmt(amount)}`,
                    "Registrado",
                );
                flash("Otro ingreso registrado en la demostración.");
            }
            function renderReport() {
                const type = document.getElementById("reportType").value;
                const meta = {
                    general: [
                        "Vista previa: reporte general para consejo",
                        ["Indicador", "Resultado"],
                        [
                            ["Solicitudes recibidas", requests.length],
                            [
                                "Cajas ocupadas",
                                boxes.filter((x) => x[3] === "Ocupada").length,
                            ],
                            ["Contratos activos", 148],
                            ["Ingresos estimados", "$327,900"],
                        ],
                    ],
                    availability: [
                        "Vista previa: disponibilidad de cajas",
                        ["Estado", "Cantidad"],
                        [
                            "Disponible",
                            "Ocupada",
                            "Reservada",
                            "Mantenimiento",
                        ].map((s) => [
                            s,
                            boxes.filter((x) => x[3] === s).length,
                        ]),
                    ],
                    access: [
                        "Vista previa: accesos por arrendatario",
                        ["Persona", "Caja", "Tipo", "Estado"],
                        [
                            [
                                "José Luis López",
                                "A-101",
                                "Autorizado",
                                "Simulado",
                            ],
                            ["Rejón Pérez", "D-127", "Titular", "Simulado"],
                        ],
                    ],
                    finance: [
                        "Vista previa: ingresos y garantías",
                        ["Concepto", "Importe", "Estado"],
                        financeMovements.map((m) => [m[2], fmt(m[4]), m[5]]),
                    ],
                }[type];
                document.getElementById("reportPreviewTitle").textContent =
                    meta[0];
                document.getElementById("reportPreviewHead").innerHTML =
                    `<tr>${meta[1].map((x) => `<th>${x}</th>`).join("")}</tr>`;
                document.getElementById("reportPreviewRows").innerHTML = meta[2]
                    .map(
                        (row) =>
                            `<tr>${row.map((x) => `<td>${x}</td>`).join("")}</tr>`,
                    )
                    .join("");
            }
            function exportReport() {
                const name =
                    document.getElementById("reportType").options[
                        document.getElementById("reportType").selectedIndex
                    ].text;
                flash(`Exportación XLS simulada: ${name}.`);
            }
            function renderRenewal() {
                const current =
                    boxes.find((x) => x[0] === activeTenant.box) || boxes[0];
                const mode = document.getElementById("rMode").value;
                const requestedBox = document.getElementById("rBox").value;
                const next =
                    mode === "move" && requestedBox
                        ? boxes.find((x) => x[0] === requestedBox)
                        : current;
                const rent =
                    Number(document.getElementById("rRent").value) ||
                    current[4];
                const duration =
                    Number(document.getElementById("rDuration").value) || 12;
                const start = document.getElementById("rStart").value;
                const end = new Date(`${start}T12:00:00`);
                end.setMonth(end.getMonth() + duration);
                end.setDate(end.getDate() - 1);
                const delta = rent - current[4];
                document.getElementById("renewalSummary").innerHTML =
                    `<p class="muted">CONTRATO ACTUAL</p><b>${activeTenant.contract}</b><div class="summary-row"><span>Caja actual</span><b>${current[0]} · ${current[1]}</b></div><div class="summary-row"><span>${mode === "move" ? "Nueva caja" : "Caja a conservar"}</span><b>${next[0]} · ${next[1]}</b></div><div class="summary-row"><span>Vigencia nueva</span><b>${duration} meses · hasta ${end.toISOString().slice(0, 10)}</b></div><div class="summary-row"><span>Renta actual</span><b>${fmt(current[4])}</b></div><div class="summary-row"><span>Nueva renta</span><b>${fmt(rent)}</b></div><div class="summary-total"><span>Diferencia mensual</span><span style="float:right">${delta >= 0 ? "+" : ""}${fmt(delta)}</span></div>`;
            }
            function requestRenewalConfirmation() {
                if (!document.getElementById("rReviewed").checked)
                    return flash(
                        "Confirma la revisión de caja, llaves, importes y documentos.",
                    );
                const mode = document.getElementById("rMode").value;
                const requestedBox = document.getElementById("rBox").value;
                if (mode === "move" && !requestedBox)
                    return flash(
                        "Selecciona una nueva caja disponible para realizar el cambio.",
                    );
                const next =
                    mode === "move"
                        ? boxes.find((x) => x[0] === requestedBox)
                        : boxes.find((x) => x[0] === activeTenant.box);
                if (next[3] === "Ocupada")
                    return flash(
                        "La caja seleccionada ya no está disponible en esta demo.",
                    );
                document.getElementById("lifecycleConfirmEyebrow").textContent =
                    "RENOVACIÓN · DEMO";
                document.getElementById("lifecycleConfirmTitle").textContent =
                    mode === "move"
                        ? "Confirmar renovación y cambio de caja"
                        : "Confirmar renovación";
                document.getElementById("lifecycleConfirmText").textContent =
                    "Se actualizarán condiciones de vigencia y renta; si corresponde, se liberará la caja anterior y se ocupará la nueva.";
                document.getElementById("lifecycleConfirmSummary").innerHTML =
                    document.getElementById("renewalSummary").innerHTML;
                document.getElementById("lifecycleConfirmAction").onclick =
                    completeRenewal;
                document.getElementById("lifecycleConfirm").classList.add("on");
            }
            function completeRenewal() {
                const oldBox = boxes.find((x) => x[0] === activeTenant.box);
                const mode = document.getElementById("rMode").value;
                const requestedBox = document.getElementById("rBox").value;
                if (mode === "move") {
                    const next = boxes.find((x) => x[0] === requestedBox);
                    oldBox[3] = "Disponible";
                    next[3] = "Ocupada";
                    activeTenant.box = next[0];
                }
                activeTenant.duration = `${document.getElementById("rDuration").value} meses`;
                activeTenant.startDate =
                    document.getElementById("rStart").value;
                activeTenant.rent =
                    Number(document.getElementById("rRent").value) || oldBox[4];
                activeTenant.endDate = "Renovación simulada";
                closeLifecycleConfirmation();
                logAudit(
                    mode === "move"
                        ? "Renovó contrato y cambió caja"
                        : "Renovó contrato",
                    activeTenant.contract,
                    "Correcto",
                );
                renderHome();
                renderTenant();
                flash(
                    mode === "move"
                        ? "Renovación y cambio de caja simulados correctamente."
                        : "Renovación simulada correctamente.",
                );
                showView("tenant");
            }
            function renderCancellation() {
                const deposit = activeTenant.deposit || 1290;
                const box = boxes.find((x) => x[0] === activeTenant.box);
                document.getElementById("cancellationSummary").innerHTML =
                    `<div class="summary-row"><span>Contrato activo</span><b>${activeTenant.contract}</b></div><div class="summary-row"><span>Caja actual</span><b>${box ? box[0] : "Sin caja"}</b></div><div class="summary-row"><span>Importe de garantía</span><b>${fmt(deposit)}</b></div><div class="summary-row"><span>Llaves reportadas</span><b>${document.getElementById("xKeys").value}</b></div><div class="summary-total"><span>Devolución propuesta</span><span style="float:right">${fmt(deposit)}</span></div>`;
            }
            function requestCancellationConfirmation() {
                if (!document.getElementById("xReviewed").checked)
                    return flash(
                        "Confirma la revisión de llaves, garantía y documentos.",
                    );
                document.getElementById("lifecycleConfirmEyebrow").textContent =
                    "CANCELACIÓN · DEMO";
                document.getElementById("lifecycleConfirmTitle").textContent =
                    "Confirmar cancelación de contrato";
                document.getElementById("lifecycleConfirmText").textContent =
                    "Se simulará la liberación de la caja, la devolución propuesta de garantía y la generación de formatos.";
                document.getElementById("lifecycleConfirmSummary").innerHTML =
                    document.getElementById("cancellationSummary").innerHTML;
                document.getElementById("lifecycleConfirmAction").onclick =
                    completeCancellation;
                document.getElementById("lifecycleConfirm").classList.add("on");
            }
            function completeCancellation() {
                const box = boxes.find((x) => x[0] === activeTenant.box);
                const cancelledContract = activeTenant.contract;
                if (box) box[3] = "Disponible";
                activeTenant.contract = "Contrato cancelado · simulación";
                activeTenant.box = "Sin caja activa";
                closeLifecycleConfirmation();
                logAudit("Canceló contrato", cancelledContract, "Simulado");
                renderHome();
                renderTenant();
                flash(
                    "Cancelación simulada; caja liberada y formatos pendientes de generar.",
                );
                showView("tenant");
            }
            function closeLifecycleConfirmation() {
                document
                    .getElementById("lifecycleConfirm")
                    .classList.remove("on");
            }
            function flash(msg) {
                let x = document.getElementById("toast");
                x.textContent = "✓ " + msg;
                x.style.display = "block";
                setTimeout(() => (x.style.display = "none"), 3200);
            }
            function closeHeaderPanels(except = null) {
                ["notificationPanel", "profilePanel"].forEach((id) => {
                    if (id === except) return;
                    const panel = document.getElementById(id);
                    const button = document.getElementById(id === "notificationPanel" ? "notificationButton" : "profileButton");
                    if (panel) panel.hidden = true;
                    if (button) button.setAttribute("aria-expanded", "false");
                });
            }
            function toggleHeaderPanel(id) {
                const panel = document.getElementById(id);
                const button = document.getElementById(id === "notificationPanel" ? "notificationButton" : "profileButton");
                const shouldOpen = panel.hidden;
                closeHeaderPanels(id);
                panel.hidden = !shouldOpen;
                button.setAttribute("aria-expanded", String(shouldOpen));
            }
            function setTheme(dark) {
                document.body.dataset.theme = dark ? "dark" : "light";
                const toggle = document.getElementById("themeToggle");
                if (toggle) toggle.checked = dark;
                try { localStorage.setItem("saferoom-theme", dark ? "dark" : "light"); } catch (_) {}
            }
            function initialiseHeaderControls() {
                try { setTheme(localStorage.getItem("saferoom-theme") === "dark"); } catch (_) { setTheme(false); }
                document.addEventListener("click", (event) => {
                    if (!event.target.closest(".header-popover-wrap")) closeHeaderPanels();
                });
            }
            function resetDemo() {
                boxes = structuredClone(seedBoxes);
                requests = structuredClone(seedRequests);
                financeMovements = structuredClone(seedFinanceMovements);
                accessQueue = structuredClone(seedAccessQueue);
                auditLog = structuredClone(seedAuditLog);
                draft = {};
                activeTenant = {
                    name: "Mariana López Canto",
                    email: "mariana.lopez@ejemplo.mx",
                    phone: "999 261 4587",
                    rfc: "LOCM9004127A4",
                    box: "A-101",
                    contract: "CT-2026-0148",
                    auth: "José Luis López",
                };
                renderHome();
                renderAccessQueue();
                renderAuditLog();
                flash("Datos de demo restablecidos.");
            }
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
            initialiseSafeDates();
            initialiseHeaderControls();
            showView(initialView, { sync: false, scroll: false, tab: currentTenantTab });
        </script>
    </body>
</html>
