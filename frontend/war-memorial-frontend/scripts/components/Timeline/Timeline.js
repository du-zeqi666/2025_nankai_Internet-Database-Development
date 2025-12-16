/**
 * War Memorial Website - Timeline Component
 * Handles the interactive timeline visualization using GSAP.
 */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export default class Timeline {
    constructor(selector) {
        this.container = document.querySelector(selector);
        if (!this.container) return;

        this.items = this.container.querySelectorAll('.timeline-item');
        this.line = this.container.querySelector('.timeline-line');
        this.progress = this.container.querySelector('.timeline-progress');
        
        this.init();
    }

    init() {
        this.setupLayout();
        this.createAnimations();
        this.bindEvents();
    }

    setupLayout() {
        // Initial layout setup if needed
    }

    createAnimations() {
        // Animate the central line progress
        if (this.line && this.progress) {
            gsap.to(this.progress, {
                height: '100%',
                ease: 'none',
                scrollTrigger: {
                    trigger: this.container,
                    start: 'top center',
                    end: 'bottom center',
                    scrub: 0.5
                }
            });
        }

        // Animate each timeline item
        this.items.forEach((item, index) => {
            const content = item.querySelector('.timeline-content');
            const date = item.querySelector('.timeline-date');
            const marker = item.querySelector('.timeline-marker');
            
            const isEven = index % 2 === 0;
            const xOffset = isEven ? -50 : 50;

            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: item,
                    start: 'top 80%',
                    end: 'bottom 20%',
                    toggleActions: 'play none none reverse'
                }
            });

            tl.from(marker, {
                scale: 0,
                opacity: 0,
                duration: 0.4,
                ease: 'back.out(1.7)'
            })
            .from(date, {
                opacity: 0,
                x: isEven ? 20 : -20,
                duration: 0.4
            }, '-=0.2')
            .from(content, {
                opacity: 0,
                x: xOffset,
                duration: 0.6,
                ease: 'power2.out'
            }, '-=0.4');
        });
    }

    bindEvents() {
        // Optional: Click to expand details
        this.items.forEach(item => {
            item.addEventListener('click', () => {
                this.toggleItemDetails(item);
            });
        });
    }

    toggleItemDetails(item) {
        const details = item.querySelector('.timeline-details');
        if (!details) return;

        const isOpen = item.classList.contains('is-open');
        
        if (isOpen) {
            gsap.to(details, {
                height: 0,
                opacity: 0,
                duration: 0.3,
                onComplete: () => item.classList.remove('is-open')
            });
        } else {
            item.classList.add('is-open');
            gsap.set(details, { height: 'auto' });
            gsap.from(details, {
                height: 0,
                opacity: 0,
                duration: 0.3
            });
        }
    }
}
