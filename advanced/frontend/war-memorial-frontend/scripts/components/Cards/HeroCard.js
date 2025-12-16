/**
 *  英雄卡片组件 (Hero Card)
 * 
 * 实现 3D 翻转效果和鼠标跟随视差
 */

import { gsap } from 'gsap';

export default class HeroCard {
    constructor(element) {
        this.element = element;
        this.inner = element.querySelector('.hero-card__inner');
        this.front = element.querySelector('.hero-card__front');
        this.back = element.querySelector('.hero-card__back');
        
        this.init();
    }

    init() {
        this.addEventListeners();
    }

    addEventListeners() {
        // 鼠标移动视差效果 (仅在非翻转状态下)
        this.element.addEventListener('mousemove', (e) => {
            if (this.element.classList.contains('is-flipped')) return;

            const rect = this.element.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = ((y - centerY) / centerY) * -10; // Max 10deg
            const rotateY = ((x - centerX) / centerX) * 10;

            gsap.to(this.inner, {
                rotateX: rotateX,
                rotateY: rotateY,
                duration: 0.5,
                ease: 'power2.out'
            });
        });

        // 鼠标移出复位
        this.element.addEventListener('mouseleave', () => {
            gsap.to(this.inner, {
                rotateX: 0,
                rotateY: 0,
                duration: 0.5,
                ease: 'power2.out'
            });
        });

        // 点击翻转
        this.element.addEventListener('click', () => {
            this.element.classList.toggle('is-flipped');
            
            const isFlipped = this.element.classList.contains('is-flipped');
            
            gsap.to(this.inner, {
                rotateY: isFlipped ? 180 : 0,
                duration: 0.8,
                ease: 'power2.inOut'
            });
        });
    }
}
