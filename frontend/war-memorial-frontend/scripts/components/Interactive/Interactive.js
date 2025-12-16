/**
 * Interactive Elements Component
 * Handles general UI interactions like scroll-to-top, smooth scroll, etc.
 */
export class Interactive {
    constructor() {
        this.scrollTopBtn = document.querySelector('.scroll-to-top');
        this.init();
    }

    init() {
        this.handleScrollTop();
        this.handleSmoothScroll();
        this.handleLoaders();
    }

    handleScrollTop() {
        if (!this.scrollTopBtn) return;

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                this.scrollTopBtn.classList.add('visible');
            } else {
                this.scrollTopBtn.classList.remove('visible');
            }
        });

        this.scrollTopBtn.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    handleSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const target = document.querySelector(targetId);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    handleLoaders() {
        // Remove global loader if exists
        const loader = document.querySelector('.global-loader');
        if (loader) {
            window.addEventListener('load', () => {
                loader.classList.add('fade-out');
                setTimeout(() => loader.remove(), 500);
            });
        }
    }
}
