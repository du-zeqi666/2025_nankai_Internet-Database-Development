import * as THREE from 'three';
import { gsap } from 'gsap';

/**
 * @class TimelineScroller
 * @description 2D Timeline Scroller Component.
 * Handles the vertical/horizontal scrolling list view of the timeline.
 */
export default class TimelineScroller {
    /**
     * @constructor
     * @param {HTMLElement} container - The container element.
     * @param {Array} data - Timeline data.
     */
    constructor(container, data) {
        this.container = container;
        this.data = data;
        this.items = [];
        
        this.init();
    }

    /**
     * Initialize the scroller.
     */
    init() {
        this.render();
        this.observeScroll();
    }

    /**
     * Render the timeline list.
     */
    render() {
        this.container.innerHTML = ''; // Clear existing

        this.data.forEach(yearData => {
            const yearGroup = document.createElement('div');
            yearGroup.className = 'timeline-year-group';
            
            // Year Label
            const yearLabel = document.createElement('div');
            yearLabel.className = 'timeline-year-label';
            yearLabel.textContent = yearData.year;
            yearGroup.appendChild(yearLabel);

            // Events
            yearData.events.forEach(event => {
                const eventCard = this.createEventCard(event);
                yearGroup.appendChild(eventCard);
                this.items.push(eventCard);
            });

            this.container.appendChild(yearGroup);
        });
    }

    /**
     * Create an event card DOM element.
     * @param {Object} event 
     * @returns {HTMLElement}
     */
    createEventCard(event) {
        const card = document.createElement('div');
        card.className = 'timeline-event-card';
        card.dataset.id = event.id;

        const date = document.createElement('div');
        date.className = 'timeline-event-date';
        date.textContent = event.date;

        const title = document.createElement('div');
        title.className = 'timeline-event-title';
        title.textContent = event.title;

        const desc = document.createElement('div');
        desc.className = 'timeline-event-desc';
        desc.textContent = event.description;

        card.appendChild(date);
        card.appendChild(title);
        card.appendChild(desc);

        // Click interaction
        card.addEventListener('click', () => {
            const customEvent = new CustomEvent('timeline-event-select', { detail: event });
            window.dispatchEvent(customEvent);
        });

        return card;
    }

    /**
     * Setup Intersection Observer for scroll animations.
     */
    observeScroll() {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    
                    // Animate in with GSAP
                    gsap.fromTo(entry.target, 
                        { opacity: 0, y: 50 },
                        { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out' }
                    );
                    
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        this.items.forEach(item => observer.observe(item));
    }

    /**
     * Destroy and cleanup.
     */
    destroy() {
        this.container.innerHTML = '';
        this.items = [];
    }
}
