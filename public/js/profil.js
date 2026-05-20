document.addEventListener('DOMContentLoaded', function () {
    initTabs();
    initSmoothScroll();
    initScrollOnTabChange();
    handleHashNavigation();
    makeTabsSticky();
    initWarekSlider();
});

function initTabs() {
    document.querySelectorAll('#profilTabs button[data-bs-toggle="tab"]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            bootstrap.Tab.getOrCreateInstance(el).show();
        });
    });
}

function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var href = this.getAttribute('href');
            if (href.length > 1) {
                var target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    window.scrollTo({ top: target.offsetTop - 100, behavior: 'smooth' });
                }
            }
        });
    });
}

function scrollToTabs() {
    var nav = document.querySelector('.tab-navigation');
    if (nav) window.scrollTo({ top: nav.offsetTop - 80, behavior: 'smooth' });
}

function initScrollOnTabChange() {
    document.querySelectorAll('#profilTabs button[data-bs-toggle="tab"]').forEach(function (btn) {
        btn.addEventListener('shown.bs.tab', function (e) {
            scrollToTabs();
            var target = e.target.getAttribute('data-bs-target');
            if (target) history.pushState(null, null, target);
            if (target === '#struktur') initWarekSlider();
        });
    });
}

function handleHashNavigation() {
    var hash = window.location.hash;
    if (!hash) return;
    var btn = document.querySelector('button[data-bs-target="' + hash + '"]');
    if (!btn) return;
    bootstrap.Tab.getOrCreateInstance(btn).show();
    setTimeout(function () {
        scrollToTabs();
        if (hash === '#struktur') initWarekSlider();
    }, 100);
}

window.addEventListener('popstate', handleHashNavigation);

function makeTabsSticky() {
    var tabNav = document.querySelector('.tab-navigation');
    if (!tabNav) return;
    var navbar = document.querySelector('.navbar');
    var navH = navbar ? navbar.offsetHeight : 0;
    var last = 0;
    window.addEventListener('scroll', function () {
        var cur = window.pageYOffset;
        tabNav.style.top = (cur > last && cur > navH) ? '0' : navH + 'px';
        last = cur;
    }, { passive: true });
}

function initWarekSlider() {
    var slider = document.querySelector('.warek-slider');
    if (!slider || window.innerWidth >= 768 || slider._sliderInit) return;
    slider._sliderInit = true;

    var track = slider.querySelector('.warek-slider-track');
    var dots = slider.querySelectorAll('.warek-dot');
    var total = dots.length;
    var current = 0;
    var timer = null;

    function goTo(index) {
        current = (index + total) % total;
        track.style.transform = 'translateX(-' + (current * 100) + '%)';
        dots.forEach(function (d, i) { d.classList.toggle('active', i === current); });
    }

    function startAuto() { timer = setInterval(function () { goTo(current + 1); }, 3000); }
    function stopAuto() { clearInterval(timer); }

    dots.forEach(function (dot) {
        dot.addEventListener('click', function () {
            stopAuto();
            goTo(parseInt(this.dataset.index));
            startAuto();
        });
    });

    var touchX = 0;
    slider.addEventListener('touchstart', function (e) { touchX = e.changedTouches[0].clientX; stopAuto(); }, { passive: true });
    slider.addEventListener('touchend', function (e) {
        var diff = touchX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) goTo(diff > 0 ? current + 1 : current - 1);
        startAuto();
    }, { passive: true });

    goTo(0);
    startAuto();
}

window.printPage = function () { window.print(); };
window.downloadPDF = function (type) { alert('Download ' + type + ' PDF - Fitur ini akan segera tersedia'); };
window.initWarekSlider = initWarekSlider;