/**
 * Gallery Component Tests
 */
import Gallery from '../../scripts/components/Gallery/Gallery';

describe('Gallery Component', () => {
    let container;

    beforeEach(() => {
        // Setup mock DOM
        document.body.innerHTML = `
            <div class="gallery-grid">
                <div class="gallery-item" href="img1.jpg" data-caption="Image 1">
                    <img src="thumb1.jpg" alt="Image 1">
                </div>
                <div class="gallery-item" href="img2.jpg" data-caption="Image 2">
                    <img src="thumb2.jpg" alt="Image 2">
                </div>
            </div>
        `;
        container = document.querySelector('.gallery-grid');
    });

    afterEach(() => {
        document.body.innerHTML = '';
    });

    test('should initialize correctly', () => {
        const gallery = new Gallery('.gallery-grid');
        expect(gallery.items.length).toBe(2);
        expect(document.querySelector('.lightbox')).toBeTruthy();
    });

    test('should open lightbox on item click', () => {
        const gallery = new Gallery('.gallery-grid');
        const item = container.querySelector('.gallery-item');
        
        item.click();
        
        const lightbox = document.querySelector('.lightbox');
        expect(lightbox.classList.contains('active')).toBe(true);
        expect(lightbox.querySelector('img').src).toContain('img1.jpg');
    });

    test('should close lightbox', () => {
        const gallery = new Gallery('.gallery-grid');
        gallery.open(0);
        
        const closeBtn = document.querySelector('.lightbox-close');
        closeBtn.click();
        
        const lightbox = document.querySelector('.lightbox');
        expect(lightbox.classList.contains('active')).toBe(false);
    });

    test('should navigate to next image', () => {
        const gallery = new Gallery('.gallery-grid');
        gallery.open(0);
        
        const nextBtn = document.querySelector('.lightbox-next');
        nextBtn.click();
        
        const img = document.querySelector('.lightbox-image');
        expect(img.src).toContain('img2.jpg');
    });
});
