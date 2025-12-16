/**
 * War Memorial Website - Gallery Component
 * Handles Lightbox functionality
 */

export default class Gallery {
    constructor(selector = '.gallery-grid') {
        this.container = document.querySelector(selector);
        if (!this.container) return;

        this.items = this.container.querySelectorAll('.gallery-item');
        this.lightbox = null;
        this.currentIndex = 0;

        this.init();
    }

    init() {
        this.createLightbox();
        this.bindEvents();
    }

    createLightbox() {
        const lightbox = document.createElement('div');
        lightbox.className = 'lightbox';
        lightbox.innerHTML = `
            <div class="lightbox-content">
                <button class="lightbox-close">&times;</button>
                <button class="lightbox-prev">&lt;</button>
                <img src="" alt="Full size" class="lightbox-image">
                <div class="lightbox-caption"></div>
                <button class="lightbox-next">&gt;</button>
            </div>
        `;
        document.body.appendChild(lightbox);
        this.lightbox = lightbox;
        
        this.imageEl = lightbox.querySelector('.lightbox-image');
        this.captionEl = lightbox.querySelector('.lightbox-caption');
    }

    bindEvents() {
        this.items.forEach((item, index) => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                this.open(index);
            });
        });

        this.lightbox.querySelector('.lightbox-close').addEventListener('click', () => this.close());
        this.lightbox.querySelector('.lightbox-prev').addEventListener('click', () => this.prev());
        this.lightbox.querySelector('.lightbox-next').addEventListener('click', () => this.next());
        
        // Close on background click
        this.lightbox.addEventListener('click', (e) => {
            if (e.target === this.lightbox) this.close();
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!this.lightbox.classList.contains('active')) return;
            if (e.key === 'Escape') this.close();
            if (e.key === 'ArrowLeft') this.prev();
            if (e.key === 'ArrowRight') this.next();
        });
    }

    open(index) {
        this.currentIndex = index;
        this.updateContent();
        this.lightbox.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }

    close() {
        this.lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    next() {
        this.currentIndex = (this.currentIndex + 1) % this.items.length;
        this.updateContent();
    }

    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
        this.updateContent();
    }

    updateContent() {
        const item = this.items[this.currentIndex];
        const imgSrc = item.getAttribute('href') || item.querySelector('img').src;
        const caption = item.dataset.caption || item.querySelector('img').alt;

        this.imageEl.src = imgSrc;
        this.captionEl.textContent = caption;
    }
}
