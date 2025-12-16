/**
 * ⚔️ Battle Card Component
 * Displays battle information with hover effects.
 */

import Component from '../Component';
import { gsap } from 'gsap';

export default class BattleCard extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.init();
    }

    init() {
        this.bindEvents();
    }

    bindEvents() {
        this.element.addEventListener('mouseenter', () => this.onHover());
        this.element.addEventListener('mouseleave', () => this.onLeave());
    }

    onHover() {
        gsap.to(this.element, {
            y: -10,
            boxShadow: '0 20px 40px rgba(0,0,0,0.2)',
            duration: 0.3,
            ease: 'power2.out'
        });
        
        const img = this.element.querySelector('img');
        if (img) {
            gsap.to(img, {
                scale: 1.1,
                duration: 0.5,
                ease: 'power2.out'
            });
        }
    }

    onLeave() {
        gsap.to(this.element, {
            y: 0,
            boxShadow: '0 4px 10px rgba(0,0,0,0.1)',
            duration: 0.3,
            ease: 'power2.out'
        });
        
        const img = this.element.querySelector('img');
        if (img) {
            gsap.to(img, {
                scale: 1,
                duration: 0.5,
                ease: 'power2.out'
            });
        }
    }
}
