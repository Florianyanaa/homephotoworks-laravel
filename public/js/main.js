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
    var siteHeader = document.querySelector('.site-header');
    if (siteHeader) {
        var toggleHeaderScrolled = function () {
            if (window.scrollY > 40) {
                siteHeader.classList.add('scrolled');
            } else {
                siteHeader.classList.remove('scrolled');
            }
        };
        toggleHeaderScrolled();
        window.addEventListener('scroll', toggleHeaderScrolled, { passive: true });
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
