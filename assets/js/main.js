document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle
    const mobileToggle = document.querySelector('.mobile-toggle');
    const mainNav = document.querySelector('.main-nav');

    if (mobileToggle && mainNav) {
        mobileToggle.addEventListener('click', () => {
            mainNav.classList.toggle('is-open');
            mobileToggle.textContent = mainNav.classList.contains('is-open') ? '✕' : '☰';
        });
    }

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
});
