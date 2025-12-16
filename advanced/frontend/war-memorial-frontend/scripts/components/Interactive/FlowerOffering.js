/**
 * 💐 Flower Offering Component
 * Interactive flower offering animation.
 */

import Component from '../Component';
import { gsap } from 'gsap';

export default class FlowerOffering extends Component {
    constructor(container, options = {}) {
        super(container, options);
        this.btn = this.element.querySelector('.offer-btn');
        this.countDisplay = this.element.querySelector('.count');
        this.init();
    }

    init() {
        if (this.btn) {
            this.btn.addEventListener('click', () => this.offerFlower());
        }
    }

    offerFlower() {
        // Create flower element
        const flower = document.createElement('div');
        flower.classList.add('flower-anim');
        flower.innerHTML = '🌼';
        this.element.appendChild(flower);

        // Animate
        gsap.fromTo(flower, 
            { y: 0, opacity: 1, scale: 0.5 },
            { 
                y: -100, 
                opacity: 0, 
                scale: 1.5, 
                duration: 1.5, 
                ease: 'power1.out',
                onComplete: () => flower.remove()
            }
        );

        // Update count (mock)
        if (this.countDisplay) {
            let count = parseInt(this.countDisplay.innerText.replace(/,/g, '')) || 0;
            this.countDisplay.innerText = (count + 1).toLocaleString();
        }
        
        // Trigger API call here in real app
    }
}
