<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Sedang Diperbaiki - UGK</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body,html{height:100%;font-family:'Poppins','Segoe UI',sans-serif;background:radial-gradient(ellipse at 30% 50%,#2a4ab0,#1a2e7a 35%,#0d1b50 70%,#080f30);display:flex;align-items:center;justify-content:center;min-height:100vh;overflow:hidden}
        .card{position:relative;z-index:2;background:rgba(255,255,255,.04);backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.07);border-radius:20px;padding:50px 60px;max-width:600px;width:90%;text-align:center;box-shadow:0 10px 40px rgba(0,0,0,.2);color:#fff}
        .logo-wrap{display:flex;align-items:center;justify-content:center;gap:12px;margin-bottom:30px}
        .logo-wrap img{height:55px;background:#fff;border-radius:50%;padding:5px;flex-shrink:0}
        .logo-text{display:flex;flex-direction:column;text-align:left;line-height:1.2}
        .logo-text span{font-size:1.1rem;font-weight:700;color:#fff;letter-spacing:1px}
        .icon-wrap{width:90px;height:90px;background:linear-gradient(135deg,#f5c518,#e6a800);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 25px;box-shadow:0 8px 30px rgba(245,197,24,.4);animation:pulse-glow 2.5s ease-in-out infinite}
        .icon-wrap span{font-size:2.5rem;line-height:1}
        .badge-label{display:inline-block;background:linear-gradient(135deg,#f5c518,#e6a800);color:#1a1a1a;font-size:.72rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:7px 22px;border-radius:50px;margin-bottom:22px}
        h1{font-size:1.75rem;font-weight:700;color:#fff;margin-bottom:15px;line-height:1.3}
        p{font-size:.95rem;color:rgba(255,255,255,.75);line-height:1.7;margin-bottom:0}
        .pmb-box{margin-top:18px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-radius:12px;padding:16px 20px}
        .pmb-box p{font-size:.82rem;color:rgba(255,255,255,.65);margin-bottom:14px}
        .pmb-box p strong{color:#f5c518}
        .pmb-buttons{display:flex;gap:10px;flex-wrap:wrap;justify-content:center}
        .btn-wa{display:inline-flex;align-items:center;gap:8px;background:#25D366;color:#fff;text-decoration:none;padding:9px 20px;border-radius:50px;font-size:.82rem;font-weight:600;transition:opacity .2s}
        .btn-wa:hover{opacity:.85;color:#fff}
        .btn-web{display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.1);color:#fff;text-decoration:none;padding:9px 20px;border-radius:50px;font-size:.82rem;font-weight:600;border:1px solid rgba(255,255,255,.25);transition:background .2s}
        .btn-web:hover{background:rgba(255,255,255,.18)}
        .divider{border:none;border-top:1px solid rgba(255,255,255,.15);margin:30px 0}
        #timer{font-size:2rem;font-weight:700;color:#fff;letter-spacing:2px;margin-bottom:10px;text-shadow:0 0 20px rgba(245,197,24,.5)}
        .estimasi{display:flex;align-items:center;justify-content:center;gap:8px;color:rgba(255,255,255,.6);font-size:.85rem;margin-bottom:25px}
        .estimasi span.dot{width:8px;height:8px;background:#f5c518;border-radius:50%;display:inline-block;animation:blink 1.2s infinite}
        .footer-note{font-size:.75rem;color:rgba(255,255,255,.35);border-top:1px solid rgba(255,255,255,.1);padding-top:20px}
        @keyframes pulse-glow{0%,100%{box-shadow:0 8px 30px rgba(245,197,24,.4);transform:scale(1)}50%{box-shadow:0 8px 45px rgba(245,197,24,.7);transform:scale(1.05)}}
        @keyframes blink{0%,100%{opacity:1}50%{opacity:.2}}
        @media(max-width:576px){.card{padding:35px 25px}h1{font-size:1.4rem}#timer{font-size:1.5rem}.icon-wrap{width:70px;height:70px}.icon-wrap span{font-size:2rem}.pmb-buttons{flex-direction:column;align-items:center}}
    </style>
</head>
<body>
<div class="card">
    <div class="logo-wrap">
        <img src="/images/logougk.png" alt="Universitas Gunung Kidul" onerror="this.style.display='none'">
        <div class="logo-text">
            <span>UNIVERSITAS</span>
            <span>GUNUNG KIDUL</span>
        </div>
    </div>

    <div class="icon-wrap"><span>🔧</span></div>
    <div class="badge-label">Maintenance Mode</div>
    <h1>Sedang Dalam Pemeliharaan</h1>
    {{-- $message dari MaintenanceCheckMiddleware, bukan query DB --}}
    <p>{{ $message ?? 'Mohon maaf, sistem sedang dalam tahap pemeliharaan untuk meningkatkan kualitas layanan.' }}</p>

    <div class="pmb-box">
        <p>Untuk informasi <strong>Penerimaan Mahasiswa Baru (PMB)</strong>, hubungi kami:</p>
        <div class="pmb-buttons">
            <a href="https://wa.me/6282313132007" class="btn-wa" target="_blank" rel="noopener">💬 WhatsApp PMB</a>
            <a href="https://pmb.ugk.ac.id/" class="btn-web" target="_blank" rel="noopener">🌐 Website PMB</a>
        </div>
    </div>

    <hr class="divider">

    {{-- Countdown dari middleware, bukan query DB --}}
    <div id="timer">— j — m — d</div>
    <div class="estimasi">
        <span class="dot"></span>
        <span id="status-text">Menghitung waktu selesai...</span>
    </div>

    <div class="footer-note">&copy; {{ date('Y') }} Universitas Gunung Kidul — Tim IT</div>
</div>

<script>
const targetRaw  = "{{ $countdown_to ?? '' }}";
const targetDate = targetRaw ? new Date(targetRaw).getTime() : 0;

function updateTimer() {
    if (!targetDate) {
        document.getElementById('timer').innerHTML = '— : — : —';
        document.getElementById('status-text').innerHTML = 'Segera selesai';
        return;
    }

    const now      = new Date().getTime();
    const distance = targetDate - now;

    if (distance <= 0) {
        clearInterval(interval);
        document.getElementById('timer').innerHTML = 'SISTEM SIAP!';
        document.getElementById('status-text').innerHTML = 'Segera kembali online';
        setTimeout(() => location.reload(), 3000);
        return;
    }

    const days    = Math.floor(distance / 86400000);
    const hours   = Math.floor((distance % 86400000) / 3600000);
    const minutes = Math.floor((distance % 3600000) / 60000);
    const seconds = Math.floor((distance % 60000) / 1000);

    let display = '';
    if (days > 0) display += days + 'h ';
    display += String(hours).padStart(2,'0') + 'j ';
    display += String(minutes).padStart(2,'0') + 'm ';
    display += String(seconds).padStart(2,'0') + 'd';

    document.getElementById('timer').innerHTML = display;
    document.getElementById('status-text').innerHTML = 'Harap bersabar';
}

updateTimer();
const interval = setInterval(updateTimer, 1000);
</script>
</body>
</html>
