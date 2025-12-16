/**
 * Loader Component
 * Displays a loading spinner
 */
export class Loader {
    constructor() {
        this.element = null;
    }

    show(container = document.body, text = '加载中...') {
        if (this.element) return;

        this.element = document.createElement('div');
        this.element.className = 'loader-overlay';
        this.element.innerHTML = `
            <div class="loader-spinner"></div>
            <div class="loader-text">${text}</div>
        `;

        // If container is not body, make sure it has relative positioning
        if (container !== document.body) {
            const style = window.getComputedStyle(container);
            if (style.position === 'static') {
                container.style.position = 'relative';
            }
            this.element.style.position = 'absolute';
        } else {
            this.element.style.position = 'fixed';
        }

        container.appendChild(this.element);
        
        requestAnimationFrame(() => {
            this.element.classList.add('active');
        });
    }

    hide() {
        if (!this.element) return;

        this.element.classList.remove('active');
        this.element.addEventListener('transitionend', () => {
            this.element.remove();
            this.element = null;
        });
    }
}

export const loader = new Loader();
