// Auto-slide untuk info-slider di mobile
// FIX: dibungkus DOMContentLoaded agar DOM sudah siap saat script di-load
document.addEventListener('DOMContentLoaded', function () {
    const slider = document.querySelector('.info-slider');
    if (!slider) return;
    const slides = slider.querySelectorAll('.info-slide');
    const dots = slider.querySelectorAll('.info-dot');
    if (!slides.length) return;
    let current = 0;

    function goTo(index) {
        slides[current].classList.remove('active');
        if (dots[current]) dots[current].classList.remove('active');
        current = index;
        slides[current].classList.add('active');
        if (dots[current]) dots[current].classList.add('active');
    }

    slides[0].classList.add('active');
    if (dots[0]) dots[0].classList.add('active');

    setInterval(function () {
        goTo((current + 1) % slides.length);
    }, 3000);

    dots.forEach(function (dot, i) {
        dot.addEventListener('click', function () { goTo(i); });
    });
});
