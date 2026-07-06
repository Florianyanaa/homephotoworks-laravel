// Smooth scroll pakai mouse wheel — scroll jadi punya efek "easing"
// (halus/melambat di ujung), mirip yang dipakai web Kaira.
// Implementasi ini dibuat sendiri dari nol (bukan copy library manapun).
(function () {
    // Device layar sentuh (HP/tablet) sudah punya momentum-scroll bawaan
    // yang lebih baik dari ini, jadi efek custom ini cuma dipasang untuk mouse.
    var isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    if (isTouchDevice) return;

    var target = window.scrollY;
    var current = window.scrollY;
    var raf = null;
    var ease = 0.1; // 0.05 = lebih "berat"/melambat, 0.2 = lebih responsif

    function maxScroll() {
        return document.documentElement.scrollHeight - window.innerHeight;
    }

    function step() {
        var diff = target - current;
        if (Math.abs(diff) < 0.5) {
            current = target;
            window.scrollTo(0, current);
            raf = null;
            return;
        }
        current += diff * ease;
        window.scrollTo(0, current);
        raf = requestAnimationFrame(step);
    }

    window.addEventListener('wheel', function (e) {
        // Biarkan area yang punya scroll sendiri (dropdown, textarea, sidebar dashboard,
        // lightbox, dll) tetap pakai scroll native, jangan diganggu
        if (e.target.closest('select, textarea, .dash-sidebar, .lightbox, [data-native-scroll]')) {
            return;
        }

        e.preventDefault();
        target += e.deltaY;
        target = Math.max(0, Math.min(target, maxScroll()));

        if (!raf) {
            raf = requestAnimationFrame(step);
        }
    }, { passive: false });

    // Kalau ada perubahan ukuran konten (gambar lazy-load selesai, dll),
    // pastikan batas scroll tetap akurat
    window.addEventListener('resize', function () {
        target = Math.min(target, maxScroll());
    });
})();

// Transisi pindah halaman — halaman lama fade-out dulu sebelum benar-benar
// pindah, jadi berasa smooth mirip animasi di web Kaira, walaupun ini
// website multi-halaman biasa (bukan SPA).
document.addEventListener('click', function (e) {
    if (e.defaultPrevented) return; // sudah ditangani handler lain (lightbox, tombol keluar, dll)

    var link = e.target.closest('a');
    if (!link) return;

    var href = link.getAttribute('href');
    if (!href || href.charAt(0) === '#') return;
    if (link.target === '_blank' || link.hasAttribute('download')) return;
    if (href.startsWith('mailto:') || href.startsWith('tel:') || href.startsWith('javascript:')) return;
    if (link.classList.contains('js-lightbox-trigger')) return; // biar tidak bentrok sama lightbox galeri
    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return; // biar Ctrl+Klik tetap buka tab baru normal

    var url;
    try {
        url = new URL(href, window.location.href);
    } catch (err) {
        return;
    }
    if (url.origin !== window.location.origin) return; // link ke situs lain: biarkan normal

    e.preventDefault();
    document.body.classList.add('page-exit');
    setTimeout(function () {
        window.location.href = url.href;
    }, 320);
});

// Preloader — hilang halus begitu halaman selesai dimuat,
// lalu foto hero "muncul" dengan animasi fade + slide-up.
window.addEventListener('load', function () {
    var preloader = document.getElementById('pagePreloader');
    var heroContent = document.querySelector('.hero-content');
    var pageHeroContent = document.querySelector('.page-hero-content');

    setTimeout(function () {
        if (preloader) {
            preloader.classList.add('loaded');
        }
        if (heroContent) {
            heroContent.classList.add('revealed');
        }
        if (pageHeroContent) {
            pageHeroContent.classList.add('revealed');
        }
        if (preloader) {
            setTimeout(function () { preloader.remove(); }, 800);
        }
    }, 300);
});

document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.getElementById('navToggle');
    var nav = document.getElementById('mainNav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            nav.classList.toggle('open');
            toggle.classList.toggle('open');
        });
    }

    // Header transparan di atas, jadi solid putih begitu discroll
    // (di-throttle pakai requestAnimationFrame biar tidak bikin scroll patah-patah)
    var siteHeader = document.querySelector('.site-header');
    if (siteHeader) {
        var isScrolled = false;
        var ticking = false;

        var applyHeaderState = function () {
            var shouldBeScrolled = window.scrollY > 40;
            if (shouldBeScrolled !== isScrolled) {
                isScrolled = shouldBeScrolled;
                siteHeader.classList.toggle('scrolled', isScrolled);
            }
            ticking = false;
        };

        var onScroll = function () {
            if (!ticking) {
                requestAnimationFrame(applyHeaderState);
                ticking = true;
            }
        };

        applyHeaderState();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    // Reveal foto/kartu saat discroll (pakai IntersectionObserver — ringan, tidak bikin lag)
    var revealEls = document.querySelectorAll('.reveal-on-scroll');
    if (revealEls.length && 'IntersectionObserver' in window) {
        var revealObserver = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

        revealEls.forEach(function (el) { revealObserver.observe(el); });
    } else {
        // Browser tidak support IntersectionObserver: langsung tampilkan semua saja
        revealEls.forEach(function (el) { el.classList.add('is-visible'); });
    }

    // Auto hide alert after 4s
    var alerts = document.querySelectorAll('.alert');
    alerts.forEach(function (a) {
        setTimeout(function () {
            a.style.transition = 'opacity .4s ease';
            a.style.opacity = '0';
            setTimeout(function () { a.remove(); }, 400);
        }, 4000);
    });

    // Confirm before delete actions
    document.querySelectorAll('[data-confirm]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            if (!confirm(el.getAttribute('data-confirm'))) {
                e.preventDefault();
            }
        });
    });

    // Hero background slideshow — otomatis berganti foto tiap beberapa detik
    var heroSlides = document.querySelectorAll('.hero-slide');
    if (heroSlides.length > 1) {
        var currentSlide = 0;
        setInterval(function () {
            heroSlides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % heroSlides.length;
            heroSlides[currentSlide].classList.add('active');
        }, 6000);
    }

    // Lightbox Galeri — klik foto buka preview fullscreen, bisa geser kiri/kanan
    var lightbox = document.getElementById('lightbox');
    if (lightbox) {
        var triggers = Array.prototype.slice.call(document.querySelectorAll('.js-lightbox-trigger'));
        var lightboxImg = document.getElementById('lightboxImg');
        var lightboxTitle = document.getElementById('lightboxTitle');
        var lightboxCategory = document.getElementById('lightboxCategory');
        var lightboxDetailLink = document.getElementById('lightboxDetailLink');
        var closeBtn = lightbox.querySelector('.lightbox-close');
        var prevBtn = lightbox.querySelector('.lightbox-prev');
        var nextBtn = lightbox.querySelector('.lightbox-next');
        var currentIndex = 0;

        function showSlide(index) {
            if (triggers.length === 0) return;
            currentIndex = (index + triggers.length) % triggers.length;
            var el = triggers[currentIndex];
            lightboxImg.src = el.getAttribute('data-full');
            lightboxImg.alt = el.getAttribute('data-title') || '';
            lightboxTitle.textContent = el.getAttribute('data-title') || '';
            lightboxCategory.textContent = el.getAttribute('data-category') || '';
            lightboxDetailLink.href = el.getAttribute('data-detail') || '#';
        }

        function openLightbox(index) {
            showSlide(index);
            lightbox.classList.add('open');
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            // Lepaskan fokus dulu dari tombol di dalam lightbox sebelum disembunyikan,
            // supaya tidak ada elemen berfokus di balik aria-hidden="true" (accessibility warning)
            if (document.activeElement && lightbox.contains(document.activeElement)) {
                document.activeElement.blur();
            }
            lightbox.classList.remove('open');
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        triggers.forEach(function (el, index) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                openLightbox(index);
            });
        });

        closeBtn.addEventListener('click', closeLightbox);
        prevBtn.addEventListener('click', function () { showSlide(currentIndex - 1); });
        nextBtn.addEventListener('click', function () { showSlide(currentIndex + 1); });

        // Klik di area gelap (luar foto) buat nutup
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) closeLightbox();
        });

        // Kontrol keyboard: ESC nutup, panah kiri/kanan geser foto
        document.addEventListener('keydown', function (e) {
            if (!lightbox.classList.contains('open')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') showSlide(currentIndex - 1);
            if (e.key === 'ArrowRight') showSlide(currentIndex + 1);
        });
    }
});
