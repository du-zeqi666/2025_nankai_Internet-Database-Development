/**
 * 🏺 Relic Card Component
 * Displays relic preview, potentially with 3D hover preview.
 */

import Component from '../Component';
import { gsap } from 'gsap';

export default class RelicCard extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.init();
    }

    init() {
        this.bindEvents();
    }

    bindEvents() {
        this.element.addEventListener('mouseenter', () => {
            gsap.to(this.element.querySelector('.relic-icon'), {
                rotationY: 360,
                duration: 1,
                ease: 'power1.inOut'
            });
        });
    }
}
