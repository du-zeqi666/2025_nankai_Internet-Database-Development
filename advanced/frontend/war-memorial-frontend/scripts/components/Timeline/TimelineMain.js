import Timeline3D from './Timeline3D.js';
import TimelineScroller from './TimelineScroller.js';
import { gsap } from 'gsap';

/**
 * @class TimelineMain
 * @description Main controller for the Timeline Page.
 * Manages the switching between 2D and 3D modes, data fetching, and global timeline state.
 */
export default class TimelineMain {
    /**
     * @constructor
     * @param {HTMLElement} container - The main container element.
     */
    constructor(container) {
        this.container = container;
        this.mode = '3d'; // '2d' or '3d'
        this.data = [];
        this.components = {
            timeline3D: null,
            timeline2D: null,
            scroller: null
        };

        this.ui = {
            viewToggle: container.querySelector('.timeline-view-toggle'),
            canvasContainer: container.querySelector('#timeline-3d-container'),
            listContainer: container.querySelector('#timeline-list-container'),
            loading: container.querySelector('.timeline-loading')
        };

        this.init();
    }

    /**
     * Initialize the timeline page.
     */
    async init() {
        console.log('TimelineMain: Initializing...');
        
        // 1. Show Loading
        this.toggleLoading(true);

        // 2. Fetch Data
        try {
            await this.fetchData();
        } catch (error) {
            console.error('Failed to load timeline data:', error);
            // Show error state
            return;
        }

        // 3. Initialize UI Controls
        this.bindEvents();

        // 4. Render Initial View
        this.render();

        // 5. Hide Loading
        this.toggleLoading(false);
    }

    /**
     * Fetch timeline data from API.
     */
    async fetchData() {
        // Simulation of API call
        return new Promise((resolve) => {
            setTimeout(() => {
                this.data = this.generateMockData();
                resolve(this.data);
            }, 1000);
        });
    }

    /**
     * Generate mock data for development.
     * @returns {Array} Mock timeline data.
     */
    generateMockData() {
        const years = [];
        const startYear = 1931;
        const endYear = 1945;

        for (let year = startYear; year <= endYear; year++) {
            years.push({
                year: year,
                events: [
                    {
                        id: `${year}-1`,
                        title: `Event in ${year}`,
                        date: `${year}-05-12`,
                        description: `A significant historical event happened in ${year}.`,
                        image: `/assets/images/timeline/${year}.jpg`
                    },
                    {
                        id: `${year}-2`,
                        title: `Another Event ${year}`,
                        date: `${year}-09-18`,
                        description: `Detailed description of the second event in ${year}.`,
                        image: `/assets/images/timeline/${year}-2.jpg`
                    }
                ]
            });
        }
        return years;
    }

    /**
     * Bind global events.
     */
    bindEvents() {
        // View Toggle Button
        if (this.ui.viewToggle) {
            this.ui.viewToggle.addEventListener('click', () => {
                this.switchMode(this.mode === '3d' ? '2d' : '3d');
            });
        }

        // Listen for 3D event selection
        window.addEventListener('timeline-event-select', (e) => {
            this.showEventDetail(e.detail);
        });
    }

    /**
     * Switch between 2D and 3D modes.
     * @param {string} newMode 
     */
    switchMode(newMode) {
        if (this.mode === newMode) return;

        console.log(`TimelineMain: Switching to ${newMode} mode.`);
        this.mode = newMode;

        // Animate transition
        const tl = gsap.timeline();

        tl.to(this.container, { opacity: 0, duration: 0.3, onComplete: () => {
            this.render();
            tl.to(this.container, { opacity: 1, duration: 0.5 });
        }});
    }

    /**
     * Render the current mode.
     */
    render() {
        if (this.mode === '3d') {
            this.render3D();
        } else {
            this.render2D();
        }
        
        // Update toggle button text
        if (this.ui.viewToggle) {
            this.ui.viewToggle.textContent = this.mode === '3d' ? '切换至列表视图' : '切换至3D视图';
        }
    }

    /**
     * Render the 3D view.
     */
    render3D() {
        // Hide 2D container
        if (this.ui.listContainer) this.ui.listContainer.style.display = 'none';
        
        // Show 3D container
        if (this.ui.canvasContainer) {
            this.ui.canvasContainer.style.display = 'block';
            
            // Initialize 3D component if not exists
            if (!this.components.timeline3D) {
                this.components.timeline3D = new Timeline3D(
                    this.ui.canvasContainer, 
                    this.data,
                    { debug: true }
                );
            }
            
            // Optimization 2: Resume rendering
            this.components.timeline3D.resume();
        }
    }

    /**
     * Render the 2D list view.
     */
    render2D() {
        // Hide 3D container
        if (this.ui.canvasContainer) {
            this.ui.canvasContainer.style.display = 'none';
            
            // Optimization 2: Pause rendering to save resources
            if (this.components.timeline3D) {
                this.components.timeline3D.pause();
            }
        }
        
        // Show 2D container
        if (this.ui.listContainer) {
            this.ui.listContainer.style.display = 'block';
            
            // Initialize 2D scroller if not exists
            if (!this.components.scroller) {
                // Assuming TimelineScroller handles the DOM generation for 2D list
                this.components.scroller = new TimelineScroller(
                    this.ui.listContainer,
                    this.data
                );
            }
        }
    }

    /**
     * Show event details (e.g., in a modal).
     * @param {Object} eventData 
     */
    showEventDetail(eventData) {
        console.log('Show detail for:', eventData);
        // Implementation for opening a modal would go here
        // For now, just a console log or a simple alert
        // new Modal({ title: eventData.title, content: ... }).open();
    }

    /**
     * Toggle loading state.
     * @param {boolean} show 
     */
    toggleLoading(show) {
        if (this.ui.loading) {
            this.ui.loading.style.display = show ? 'flex' : 'none';
        }
    }
}
