document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu
    const mobileToggle = document.querySelector('.mobile-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (mobileToggle) {
        mobileToggle.addEventListener('click', () => {
            mainNav.classList.toggle('is-open');
            mobileToggle.innerHTML = mainNav.classList.contains('is-open') ? '✕' : '☰';
        });
    }

    // Scroll Reveal Animation
    const revealElements = document.querySelectorAll('section, .service-card, .pension-card, .price-card');

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('reveal', 'active');
                revealObserver.unobserve(entry.target); // Animate once
            }
        });
    }, {
        threshold: 0.15
    });

    revealElements.forEach(el => {
        el.classList.add('reveal');
        revealObserver.observe(el);
    });
});
// Sticky Header Effect
const header = document.querySelector('.site-header');
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        header.style.padding = '10px 0';
        header.style.background = 'rgba(2, 6, 23, 0.95)';
    } else {
        header.style.padding = '15px 0';
        header.style.background = 'rgba(2, 6, 23, 0.8)';
    }
});

