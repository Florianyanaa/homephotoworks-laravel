<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Segera Hadir — Home Photoworks</title>
<meta name="description" content="Home Photoworks — Studio foto profesional. Website kami akan segera hadir.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
<link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" sizes="any">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon-32x32.png')); ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('apple-touch-icon.png')); ?>">
<style>
    .coming-soon-hero {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        color: var(--white);
        text-align: center;
        padding: 24px;
    }
    .coming-soon-wrap { position: relative; z-index: 2; max-width: 620px; }
    .coming-soon-logo {
        font-family: var(--font-display);
        font-size: 26px;
        font-weight: 700;
        letter-spacing: 2px;
        margin-bottom: 40px;
    }
    .coming-soon-logo span { font-weight: 400; color: var(--gray-light); }
    .coming-soon-eyebrow {
        display: inline-block;
        font-size: 12px;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: var(--gray-light);
        margin-bottom: 18px;
        font-weight: 500;
    }
    .coming-soon-title {
        font-family: var(--font-display);
        font-size: clamp(32px, 6vw, 52px);
        line-height: 1.15;
        margin-bottom: 18px;
    }
    .coming-soon-desc {
        font-size: 15px;
        color: var(--gray-light);
        line-height: 1.7;
        margin-bottom: 44px;
    }
    .coming-soon-timer {
        display: flex;
        justify-content: center;
        gap: 14px;
        margin-bottom: 44px;
        flex-wrap: wrap;
    }
    .timer-box {
        min-width: 78px;
        padding: 16px 10px;
        border: 1px solid rgba(255,255,255,0.25);
        border-radius: 4px;
        background: rgba(10,10,10,0.35);
        backdrop-filter: blur(2px);
    }
    .timer-num {
        font-family: var(--font-display);
        font-size: 34px;
        font-weight: 700;
        line-height: 1;
    }
    .timer-label {
        font-size: 10px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--gray-light);
        margin-top: 8px;
        display: block;
    }
    .coming-soon-contact {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .coming-soon-contact a {
        color: var(--white);
        font-size: 13px;
        letter-spacing: 0.5px;
        border: 1px solid rgba(255,255,255,0.4);
        padding: 10px 22px;
        border-radius: var(--radius);
        transition: var(--transition);
        background: rgba(10,10,10,0.25);
    }
    .coming-soon-contact a:hover { background: rgba(255,255,255,0.15); }

    @media (max-width: 480px) {
        .timer-box { min-width: 64px; padding: 12px 6px; }
        .timer-num { font-size: 26px; }
    }
</style>
</head>
<body>

<div class="page-preloader" id="pagePreloader">
    <div class="page-preloader-logo">HOME <span>PHOTOWORKS</span></div>
</div>

<section class="hero coming-soon-hero">
    <div class="hero-bg-slider">
        <?php $__currentLoopData = $heroImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="hero-slide <?php echo e($i === 0 ? 'active' : ''); ?>" style="background-image:url('<?php echo e(asset('img/hero/'.$img)); ?>')"></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="coming-soon-wrap">
        <div class="coming-soon-logo">HOME <span>PHOTOWORKS</span></div>

        <span class="coming-soon-eyebrow">Website Baru</span>
        <h1 class="coming-soon-title">Kami Sedang Bersiap<br>Menyambut Anda</h1>
        <p class="coming-soon-desc">
            Website Home Photoworks sedang dalam tahap persiapan akhir.
            Sementara menunggu, jangan ragu untuk langsung menghubungi kami.
        </p>

        <?php if($launchAt): ?>
            <div class="coming-soon-timer" id="countdownTimer" data-launch="<?php echo e(\Carbon\Carbon::parse($launchAt)->toIso8601String()); ?>">
                <div class="timer-box"><span class="timer-num" id="cdDays">00</span><span class="timer-label">Hari</span></div>
                <div class="timer-box"><span class="timer-num" id="cdHours">00</span><span class="timer-label">Jam</span></div>
                <div class="timer-box"><span class="timer-num" id="cdMinutes">00</span><span class="timer-label">Menit</span></div>
                <div class="timer-box"><span class="timer-num" id="cdSeconds">00</span><span class="timer-label">Detik</span></div>
            </div>
        <?php endif; ?>

        <div class="coming-soon-contact">
            <a href="https://wa.me/6285210400454" target="_blank" rel="noopener">WhatsApp Kami</a>
            <a href="https://www.instagram.com/homephotoworks_official?igsh=MTlna2gwcGE0MGNmcQ%3D%3D&utm_source=qr" target="_blank" rel="noopener">Instagram</a>
        </div>
    </div>
</section>

<script>
(function () {
    // Preloader — hilang halus begitu halaman selesai dimuat (sama seperti di web utama)
    window.addEventListener('load', function () {
        var preloader = document.getElementById('pagePreloader');
        setTimeout(function () {
            if (preloader) {
                preloader.classList.add('loaded');
                setTimeout(function () { preloader.remove(); }, 800);
            }
        }, 300);
    });

    // Slideshow background — persis seperti hero di halaman Beranda
    var heroSlides = document.querySelectorAll('.hero-slide');
    if (heroSlides.length > 1) {
        var currentSlide = 0;
        setInterval(function () {
            heroSlides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % heroSlides.length;
            heroSlides[currentSlide].classList.add('active');
        }, 5000);
    }

    <?php if($launchAt): ?>
    // Countdown timer
    var el = document.getElementById('countdownTimer');
    var launchTime = new Date(el.getAttribute('data-launch')).getTime();

    var dEl = document.getElementById('cdDays');
    var hEl = document.getElementById('cdHours');
    var mEl = document.getElementById('cdMinutes');
    var sEl = document.getElementById('cdSeconds');

    function pad(n) { return n < 10 ? '0' + n : '' + n; }

    function tick() {
        var now = new Date().getTime();
        var diff = launchTime - now;

        if (diff <= 0) {
            dEl.textContent = '00';
            hEl.textContent = '00';
            mEl.textContent = '00';
            sEl.textContent = '00';
            return;
        }

        var days = Math.floor(diff / (1000 * 60 * 60 * 24));
        var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((diff % (1000 * 60)) / 1000);

        dEl.textContent = pad(days);
        hEl.textContent = pad(hours);
        mEl.textContent = pad(minutes);
        sEl.textContent = pad(seconds);
    }

    tick();
    setInterval(tick, 1000);
    <?php endif; ?>
})();
</script>

</body>
</html>
<?php /**PATH C:\laragon\www\homephotoworks-laravel\resources\views/coming-soon.blade.php ENDPATH**/ ?>