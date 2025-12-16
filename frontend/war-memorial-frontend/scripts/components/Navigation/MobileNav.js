/**
 * 📱 Mobile Navigation Component
 * Handles the mobile menu toggle and interactions.
 */

import Component from '../Component';
import { gsap } from 'gsap';

export default class MobileNav extends Component {
    constructor(container, options = {}) {
        super(container, options);
        
        this.toggleBtn = null;
        this.menu = null;
        this.isOpen = false;
        
        this.init();
    }

    init() {
        this.toggleBtn = document.querySelector('.mobile-nav-toggle');
        this.menu = document.querySelector('.mobile-nav-menu');
        
        if (this.toggleBtn && this.menu) {
            this.bindEvents();
        }
    }

    bindEvents() {
        this.toggleBtn.addEventListener('click', () => this.toggle());
        
        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (this.isOpen && !this.element.contains(e.target) && !this.toggleBtn.contains(e.target)) {
                this.close();
            }
        });
        
        // Close menu when clicking a link
        this.menu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => this.close());
        });
    }

    toggle() {
        if (this.isOpen) {
            this.close();
        } else {
            this.open();
        }
    }

    open() {
        this.isOpen = true;
        this.toggleBtn.classList.add('active');
        this.menu.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
        
        // Animation
        gsap.to(this.menu, {
            x: '0%',
            duration: 0.4,
            ease: 'power3.out'
        });
        
        gsap.from(this.menu.querySelectorAll('li'), {
            x: -20,
            opacity: 0,
            duration: 0.4,
            stagger: 0.1,
            delay: 0.2
        });
    }

    close() {
        this.isOpen = false;
        this.toggleBtn.classList.remove('active');
        this.menu.classList.remove('active');
        document.body.style.overflow = '';
        
        // Animation
        gsap.to(this.menu, {
            x: '-100%',
            duration: 0.3,
            ease: 'power3.in'
        });
    }
}
