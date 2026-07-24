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
    var isProgrammatic = false; // true selagi step() yang menggerakkan scroll

    // Deteksi trackpad vs mouse fisik. Trackpad mengirim banyak event kecil
    // secara berturut-turut sangat rapat, sedangkan mouse fisik mengirim
    // event besar (per "notch") dengan jeda alami di antaranya. Kalau
    // kedeteksi trackpad, custom easing dimatikan sementara dan scroll
    // native browser dipakai (trackpad modern sudah smooth secara bawaan) —
    // ini yang memperbaiki bug "nyangkut" pas discroll pakai trackpad.
    var lastWheelTime = 0;
    var rapidEventCount = 0;
    var isTrackpadGesture = false;

    function maxScroll() {
        return Math.max(0, document.documentElement.scrollHeight - window.innerHeight);
    }

    function step() {
        var diff = target - current;
        if (Math.abs(diff) < 0.5) {
            current = target;
            isProgrammatic = true;
            window.scrollTo(0, current);
            raf = null;
            return;
        }
        current += diff * ease;
        isProgrammatic = true;
        window.scrollTo(0, current);
        raf = requestAnimationFrame(step);
    }

    window.addEventListener('wheel', function (e) {
        // Kalau kursor di atas elemen yang benar-benar punya isi lebih panjang
        // dari kotaknya (butuh scroll sendiri), biarkan native — supaya isinya
        // tetap bisa di-scroll. Kalau tidak (misal textarea kosong/pendek),
        // ikut scroll halaman biasa (custom smooth), biar tidak ada transisi
        // kasar-halus-kasar yang bikin "glitch" saat kursor keluar-masuk elemen itu.
        var scrollableParent = e.target.closest('select, textarea, .dash-sidebar, .lightbox, [data-native-scroll]');
        if (scrollableParent && scrollableParent.scrollHeight > scrollableParent.clientHeight) {
            return;
        }

        var now = performance.now();
        var timeSinceLast = now - lastWheelTime;
        lastWheelTime = now;

        if (Math.abs(e.deltaY) < 50 && timeSinceLast < 40) {
            rapidEventCount++;
        } else if (timeSinceLast > 200) {
            rapidEventCount = 0;
        }
        isTrackpadGesture = rapidEventCount > 3;

        if (isTrackpadGesture) {
            // Kemungkinan besar ini trackpad: matikan hijack, biarkan
            // scroll native browser yang jalan (jangan preventDefault).
            target = window.scrollY;
            current = window.scrollY;
            if (raf) {
                cancelAnimationFrame(raf);
                raf = null;
            }
            return;
        }

        e.preventDefault();
        target += e.deltaY;
        target = Math.max(0, Math.min(target, maxScroll()));

        if (!raf) {
            raf = requestAnimationFrame(step);
        }
    }, { passive: false });

    // Kalau scroll terjadi dari sumber LAIN (keyboard, drag scrollbar, klik anchor #link,
    // atau browser mengembalikan posisi scroll saat navigasi back/forward), samakan lagi
    // target & current ke posisi asli itu — ini yang memperbaiki bug "glitch"/lompat
    // sebelumnya, karena dulu variabel internal bisa "ketinggalan" dari posisi asli.
    window.addEventListener('scroll', function () {
        if (isProgrammatic) {
            isProgrammatic = false;
            return;
        }
        target = window.scrollY;
        current = window.scrollY;
        if (raf) {
            cancelAnimationFrame(raf);
            raf = null;
        }
    }, { passive: true });

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

// Perbaikan bug: kalau halaman ini dibuka lagi lewat tombol Back/Forward
// browser, beberapa browser (terutama Chrome & Safari) mengembalikan
// halaman dari "bfcache" persis di kondisi terakhir sebelum ditinggal —
// yaitu saat masih dalam status memudar (class 'page-exit', opacity: 0).
// Makanya halaman kelihatan putih/kosong. Perbaikannya: begitu halaman
// muncul lagi (baik normal maupun dari bfcache), pastikan class itu dicopot.
window.addEventListener('pageshow', function (event) {
    document.body.classList.remove('page-exit');
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

    // Parallax halus di foto hero — foto bergerak sedikit lebih lambat dari
    // konten saat discroll, memberi kesan kedalaman (depth). Cuma jalan
    // selagi hero masih kelihatan, dan dimatikan buat yang minta animasi minim.
    var heroSlider = document.querySelector('.hero-bg-slider');
    var heroSection = document.querySelector('.hero');
    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (heroSlider && heroSection && !prefersReducedMotion) {
        var parallaxTicking = false;

        var applyParallax = function () {
            var heroHeight = heroSection.offsetHeight;
            var scrollY = window.scrollY;

            if (scrollY <= heroHeight) {
                var offset = Math.min(scrollY * 0.3, 80);
                heroSlider.style.transform = 'translateY(' + offset + 'px)';
            }

            parallaxTicking = false;
        };

        var onParallaxScroll = function () {
            if (!parallaxTicking) {
                requestAnimationFrame(applyParallax);
                parallaxTicking = true;
            }
        };

        applyParallax();
        window.addEventListener('scroll', onParallaxScroll, { passive: true });
    }

    // Efek shimmer/kilau saat gambar galeri masih loading — biar tidak
    // langsung nongol kotak kosong sebelum foto beneran tampil.
    document.querySelectorAll('.gallery-item img').forEach(function (img) {
        var item = img.closest('.gallery-item');
        if (!item) return;

        var markLoaded = function () { item.classList.add('img-loaded'); };

        if (img.complete && img.naturalWidth > 0) {
            markLoaded();
        } else {
            img.addEventListener('load', markLoaded);
            img.addEventListener('error', markLoaded); // biar shimmer tidak nyangkut selamanya kalau gambar gagal dimuat
        }
    });

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

document.addEventListener('DOMContentLoaded', function () {
    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // ---------- Progress bar scroll di atas halaman ----------
    var progressBar = document.getElementById('scrollProgressBar');
    if (progressBar) {
        var updateProgress = function () {
            var scrollTop = window.scrollY;
            var docHeight = document.documentElement.scrollHeight - window.innerHeight;
            var pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            progressBar.style.width = pct + '%';
        };
        window.addEventListener('scroll', updateProgress, { passive: true });
        window.addEventListener('resize', updateProgress);
        updateProgress();
    }

    // ---------- Tilt 3D halus di kartu layanan, ngikutin posisi kursor ----------
    if (!prefersReducedMotion && window.matchMedia('(hover: hover)').matches) {
        document.querySelectorAll('.service-card').forEach(function (card) {
            card.addEventListener('mousemove', function (e) {
                var bounds = card.getBoundingClientRect();
                var x = e.clientX - bounds.left;
                var y = e.clientY - bounds.top;
                var rotateX = ((y - bounds.height / 2) / (bounds.height / 2)) * -5;
                var rotateY = ((x - bounds.width / 2) / (bounds.width / 2)) * 5;
                card.style.transform = 'perspective(900px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) translateY(-6px)';
            });
            card.addEventListener('mouseleave', function () {
                card.style.transform = '';
            });
        });
    }

    // ---------- Judul muncul kata-per-kata saat halaman dibuka/discroll ----------
    // Versi node-aware: kalau di dalam judul ada elemen lain (misal <span> kata
    // yang gonta-ganti di hero), elemen itu tetap dijaga utuh, bukan ikut kebongkar
    // jadi teks polos.
    function wrapWordsPreservingElements(heading) {
        var wordIndex = 0;
        var fragment = document.createDocumentFragment();

        Array.prototype.slice.call(heading.childNodes).forEach(function (node) {
            if (node.nodeType === Node.TEXT_NODE) {
                node.textContent.split(/(\s+)/).forEach(function (part) {
                    if (part.trim() === '') {
                        if (part) fragment.appendChild(document.createTextNode(part));
                        return;
                    }
                    var span = document.createElement('span');
                    span.className = 'word';
                    span.style.animationDelay = (wordIndex * 150) + 'ms';
                    span.textContent = part;
                    fragment.appendChild(span);
                    wordIndex++;
                });
            } else {
                node.classList.add('word');
                node.style.animationDelay = (wordIndex * 150) + 'ms';
                fragment.appendChild(node);
                wordIndex++;
            }
        });

        heading.innerHTML = '';
        heading.appendChild(fragment);
    }

    var animatedHeadings = document.querySelectorAll('.section-head h2, .hero-content h1, .page-hero h1');
    if (animatedHeadings.length) {
        animatedHeadings.forEach(wrapWordsPreservingElements);

        if ('IntersectionObserver' in window) {
            var headingObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('words-revealed');
                        headingObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.4 });

            animatedHeadings.forEach(function (heading) { headingObserver.observe(heading); });
        } else {
            animatedHeadings.forEach(function (heading) { heading.classList.add('words-revealed'); });
        }
    }
});
