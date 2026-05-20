document.addEventListener('DOMContentLoaded', function () {

    const heroCarousel = document.getElementById('heroCarousel');
    if (heroCarousel) {
        new bootstrap.Carousel(heroCarousel, { interval: 5000, wrap: true, pause: 'hover' });
    }

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) window.scrollTo({ top: target.offsetTop - 80, behavior: 'smooth' });
            }
        });
    });

    const statsSection = document.querySelector('.bg-warning');
    const counters = statsSection ? statsSection.querySelectorAll('.display-6') : [];

    if (counters.length > 0) {
        function animateCounter(el) {
            const raw = el.textContent.replace('+', '').trim();
            const target = parseInt(raw);
            if (isNaN(target)) return;
            const hasSuffix = el.textContent.includes('+');
            const increment = target / (2000 / 16);
            let current = 0;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    el.textContent = target + (hasSuffix ? '+' : '');
                    clearInterval(timer);
                } else {
                    el.textContent = Math.floor(current) + (hasSuffix ? '+' : '');
                }
            }, 16);
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    counters.forEach(counter => {
                        if (!counter.dataset.animated) {
                            counter.dataset.animated = '1';
                            animateCounter(counter);
                        }
                    });
                    observer.disconnect();
                }
            });
        }, { threshold: 0.3 });

        observer.observe(statsSection);
    }

    function initMobileSubmenu() {
        if (window.innerWidth >= 992) return;

        document.querySelectorAll('.submenu-arrow').forEach(btn => {
            if (btn.dataset.arrowInit) return;
            btn.dataset.arrowInit = '1';

            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                // Cari target submenu dari data-bs-target attribute
                const targetId = this.getAttribute('data-bs-target');
                const submenu = targetId ? document.querySelector(targetId) : null;
                if (!submenu) return;

                const isOpen = submenu.classList.contains('show');

                // Tutup semua submenu lain di level yang sama
                const parentDropdown = this.closest('.dropdown-menu');
                if (parentDropdown) {
                    parentDropdown.querySelectorAll('.dropdown-submenu > .dropdown-menu').forEach(el => {
                        if (el !== submenu) {
                            el.classList.remove('show');
                            // Reset arrow sibling
                            const arrow = el.closest('.dropdown-submenu')?.querySelector('.submenu-arrow');
                            if (arrow) arrow.classList.remove('open');
                        }
                    });
                }

                // Toggle submenu yang diklik
                if (isOpen) {
                    submenu.classList.remove('show');
                    this.classList.remove('open');
                } else {
                    submenu.classList.add('show');
                    this.classList.add('open');
                }
            });
        });

        // Reset semua submenu saat navbar collapse ditutup
        const navbarCollapse = document.getElementById('navbarMain');
        if (navbarCollapse && !navbarCollapse.dataset.submenuCollapseInit) {
            navbarCollapse.dataset.submenuCollapseInit = '1';
            navbarCollapse.addEventListener('hidden.bs.collapse', () => {
                document.querySelectorAll('.dropdown-submenu > .dropdown-menu').forEach(el => el.classList.remove('show'));
                document.querySelectorAll('.submenu-arrow').forEach(el => el.classList.remove('open'));
            });
        }
    }

    initMobileSubmenu();

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                const bsDropdown = bootstrap.Dropdown.getInstance(menu.previousElementSibling);
                if (bsDropdown) bsDropdown.hide();
            });
            document.querySelectorAll('.dropdown-submenu .dropdown-menu.show').forEach(sub => sub.classList.remove('show'));
        }
    });

    document.querySelectorAll('.dropdown-menu a:not(.dropdown-toggle):not(.submenu-arrow)').forEach(link => {
        link.addEventListener('click', function () {
            const navbar = document.querySelector('.navbar-collapse');
            if (navbar && navbar.classList.contains('show')) {
                (bootstrap.Collapse.getInstance(navbar) || new bootstrap.Collapse(navbar, { toggle: false })).hide();
            }
        });
    });

    const backToTop = document.createElement('button');
    backToTop.innerHTML = '<i class="fas fa-chevron-up"></i>';
    backToTop.setAttribute('aria-label', 'Kembali ke atas');
    backToTop.className = 'btn btn-primary rounded-circle position-fixed';
    backToTop.style.cssText = 'bottom:80px;right:20px;z-index:1000;width:46px;height:46px;display:none;opacity:0;transform:translateY(20px);transition:opacity 0.3s,transform 0.3s;box-shadow:0 3px 10px rgba(0,0,0,0.2);';
    document.body.appendChild(backToTop);

    backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    window.addEventListener('scroll', function () {
        if (window.pageYOffset > 300) {
            backToTop.style.display = 'block';
            requestAnimationFrame(() => { backToTop.style.opacity = '1'; backToTop.style.transform = 'translateY(0)'; });
        } else {
            backToTop.style.opacity = '0';
            backToTop.style.transform = 'translateY(20px)';
            setTimeout(() => { if (window.pageYOffset <= 300) backToTop.style.display = 'none'; }, 300);
        }
    }, { passive: true });

    const floatingPMB = document.getElementById('floatingPMB');
    if (floatingPMB) floatingPMB.classList.remove('hidden');

    function initSlider(sliderId, dotsId, interval) {
        const slider = document.getElementById(sliderId);
        const dotsWrap = document.getElementById(dotsId);
        if (!slider || !dotsWrap) return;
        const items = slider.querySelectorAll('.news-slide-item, .pengumuman-slide-item');
        if (items.length <= 1) return;
        if (slider.dataset.sliderInit) return;
        slider.dataset.sliderInit = '1';

        const total = items.length;
        let current = 0;
        let autoSlideTimer = null;

        dotsWrap.innerHTML = '';
        items.forEach((_, i) => {
            const dot = document.createElement('span');
            dot.className = 'news-dot' + (i === 0 ? ' active' : '');
            dot.addEventListener('click', () => goTo(i));
            dotsWrap.appendChild(dot);
        });

        function goTo(index) {
            current = index;
            slider.scrollTo({ left: current * slider.offsetWidth, behavior: 'smooth' });
            dotsWrap.querySelectorAll('.news-dot').forEach((d, i) => d.classList.toggle('active', i === current));
        }
        function next() { goTo((current + 1) % total); }
        function startAuto() { stopAuto(); autoSlideTimer = setInterval(next, interval || 3000); }
        function stopAuto() { clearInterval(autoSlideTimer); }

        startAuto();
        slider.addEventListener('touchstart', stopAuto, { passive: true });
        slider.addEventListener('touchend', () => setTimeout(startAuto, 400), { passive: true });
    }

    if (window.innerWidth < 768) {
        initSlider('newsSlider', 'newsDots', 3000);
        initSlider('fasilitasSlider', 'fasilitasDots', 3000);
        initSlider('pengumumanSlider', 'pengumumanDots', 4000);
    }

    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            if (window.innerWidth < 768) {
                initSlider('newsSlider', 'newsDots', 3000);
                initSlider('fasilitasSlider', 'fasilitasDots', 3000);
                initSlider('pengumumanSlider', 'pengumumanDots', 4000);
            }
            initMobileSubmenu();
        }, 300);
    }, { passive: true });

});

function closeFloatingPMB(event) {
    event.preventDefault();
    event.stopPropagation();
    const el = document.getElementById('floatingPMB');
    if (el) el.classList.add('hidden');
}