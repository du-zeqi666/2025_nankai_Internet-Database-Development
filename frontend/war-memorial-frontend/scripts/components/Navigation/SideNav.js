/**
 * 📑 Side Navigation Component
 * Handles sidebar navigation, scroll spy, and sticky behavior.
 */

import Component from '../Component';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export default class SideNav extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.links = this.element.querySelectorAll('a');
        this.sections = [];
        
        this.init();
    }

    init() {
        this.collectSections();
        this.setupScrollSpy();
        this.bindEvents();
    }

    collectSections() {
        this.links.forEach(link => {
            const href = link.getAttribute('href');
            if (href && href.startsWith('#')) {
                const section = document.querySelector(href);
                if (section) {
                    this.sections.push({
                        id: href.substring(1),
                        element: section,
                        link: link
                    });
                }
            }
        });
    }

    setupScrollSpy() {
        this.sections.forEach(section => {
            ScrollTrigger.create({
                trigger: section.element,
                start: 'top center',
                end: 'bottom center',
                onEnter: () => this.setActive(section.id),
                onEnterBack: () => this.setActive(section.id)
            });
        });
    }

    setActive(id) {
        this.links.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${id}`) {
                link.classList.add('active');
            }
        });
    }

    bindEvents() {
        this.links.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const href = link.getAttribute('href');
                const target = document.querySelector(href);
                
                if (target) {
                    gsap.to(window, {
                        duration: 1,
                        scrollTo: {
                            y: target,
                            offsetY: 100
                        },
                        ease: 'power3.inOut'
                    });
                }
            });
        });
    }
}
