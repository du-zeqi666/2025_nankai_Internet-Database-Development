/**
 * War Memorial Website - Navigation Component
 * Handles mobile menu toggle, scroll effects, and active state management.
 */

import { gsap } from 'gsap';

export default class Navigation {
    constructor() {
        this.header = document.querySelector('.site-header');
        this.navToggle = document.querySelector('.nav-toggle');
        this.navMenu = document.querySelector('.main-nav');
        this.navLinks = document.querySelectorAll('.nav-link');
        
        this.isMenuOpen = false;
        this.lastScrollTop = 0;
        this.scrollThreshold = 50;

        this.init();
    }

    init() {
        if (!this.header) return;

        this.bindEvents();
        this.checkActiveLink();
    }

    bindEvents() {
        // Mobile Menu Toggle
        if (this.navToggle) {
            this.navToggle.addEventListener('click', () => this.toggleMenu());
        }

        // Scroll Handler
        window.addEventListener('scroll', () => {
            requestAnimationFrame(() => this.handleScroll());
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (this.isMenuOpen && !this.header.contains(e.target)) {
                this.closeMenu();
            }
        });

        // Close menu on link click (mobile)
        this.navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    this.closeMenu();
                }
            });
        });
    }

    toggleMenu() {
        this.isMenuOpen = !this.isMenuOpen;
        this.navToggle.setAttribute('aria-expanded', this.isMenuOpen);
        this.navMenu.classList.toggle('is-active');
        document.body.style.overflow = this.isMenuOpen ? 'hidden' : '';

        if (this.isMenuOpen) {
            this.animateMenuOpen();
        } else {
            this.animateMenuClose();
        }
    }

    closeMenu() {
        this.isMenuOpen = false;
        this.navToggle.setAttribute('aria-expanded', 'false');
        this.navMenu.classList.remove('is-active');
        document.body.style.overflow = '';
        this.animateMenuClose();
    }

    animateMenuOpen() {
        const items = this.navMenu.querySelectorAll('.nav-item');
        gsap.fromTo(items, 
            { opacity: 0, y: 20 },
            { 
                opacity: 1, 
                y: 0, 
                duration: 0.4, 
                stagger: 0.1,
                ease: 'power2.out'
            }
        );
    }

    animateMenuClose() {
        // Optional: Add closing animation logic
    }

    handleScroll() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Sticky Header Effect
        if (scrollTop > this.scrollThreshold) {
            this.header.classList.add('is-scrolled');
        } else {
            this.header.classList.remove('is-scrolled');
        }

        // Hide/Show on scroll (optional)
        // if (scrollTop > this.lastScrollTop && scrollTop > this.header.offsetHeight) {
        //     this.header.style.transform = 'translateY(-100%)';
        // } else {
        //     this.header.style.transform = 'translateY(0)';
        // }

        this.lastScrollTop = scrollTop;
    }

    checkActiveLink() {
        const currentPath = window.location.pathname;
        this.navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }
}
