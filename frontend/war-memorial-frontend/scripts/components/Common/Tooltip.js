/**
 * Tooltip Component
 * Simple tooltip implementation
 */
export class Tooltip {
    constructor() {
        this.tooltip = null;
        this.init();
    }

    init() {
        this.tooltip = document.createElement('div');
        this.tooltip.className = 'tooltip';
        document.body.appendChild(this.tooltip);

        document.addEventListener('mouseover', (e) => {
            const target = e.target.closest('[data-tooltip]');
            if (target) {
                this.show(target);
            }
        });

        document.addEventListener('mouseout', (e) => {
            const target = e.target.closest('[data-tooltip]');
            if (target) {
                this.hide();
            }
        });
    }

    show(element) {
        const text = element.dataset.tooltip;
        if (!text) return;

        this.tooltip.textContent = text;
        this.tooltip.classList.add('show');

        const rect = element.getBoundingClientRect();
        const tooltipRect = this.tooltip.getBoundingClientRect();

        let top = rect.top - tooltipRect.height - 10;
        let left = rect.left + (rect.width - tooltipRect.width) / 2;

        // Boundary checks
        if (top < 0) top = rect.bottom + 10;
        if (left < 0) left = 10;
        if (left + tooltipRect.width > window.innerWidth) {
            left = window.innerWidth - tooltipRect.width - 10;
        }

        this.tooltip.style.top = `${top}px`;
        this.tooltip.style.left = `${left}px`;
    }

    hide() {
        this.tooltip.classList.remove('show');
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    new Tooltip();
});
