/**
 * Back To Top Component
 */
export class BackToTop {
    constructor() {
        this.button = null;
        this.threshold = 300;
        this.init();
    }

    init() {
        this.createButton();
        window.addEventListener('scroll', () => this.toggleButton());
        this.button.addEventListener('click', () => this.scrollToTop());
    }

    createButton() {
        this.button = document.createElement('button');
        this.button.className = 'back-to-top';
        this.button.innerHTML = '↑';
        this.button.setAttribute('aria-label', '返回顶部');
        document.body.appendChild(this.button);
    }

    toggleButton() {
        if (window.scrollY > this.threshold) {
            this.button.classList.add('visible');
        } else {
            this.button.classList.remove('visible');
        }
    }

    scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    new BackToTop();
});
