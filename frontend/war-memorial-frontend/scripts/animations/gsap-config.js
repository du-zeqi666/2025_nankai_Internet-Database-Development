/**
 * 🏛️ 抗战胜利80周年纪念网站 - GSAP 动画配置
 * GSAP Animation Configuration
 * 
 * @version 1.0.0
 * @description 注册 GSAP 插件，配置全局默认值
 */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';
import { TextPlugin } from 'gsap/TextPlugin';

export function initAnimations() {
    // 注册插件
    gsap.registerPlugin(ScrollTrigger, ScrollToPlugin, TextPlugin);
    
    // 配置全局默认值
    gsap.defaults({
        ease: 'power2.out',
        duration: 0.5
    });
    
    // 配置 ScrollTrigger 默认值
    ScrollTrigger.defaults({
        // markers: process.env.NODE_ENV === 'development', // 开发模式显示标记
        toggleActions: 'play none none reverse'
    });
    
    console.log('✅ GSAP Configured');
    
    // 注册自定义效果
    registerCustomEffects();
}

function registerCustomEffects() {
    // 1. 渐入上浮效果
    gsap.registerEffect({
        name: 'fadeInUp',
        effect: (targets, config) => {
            return gsap.fromTo(targets, 
                { opacity: 0, y: config.y },
                { opacity: 1, y: 0, duration: config.duration, ease: config.ease }
            );
        },
        defaults: { y: 50, duration: 1, ease: 'power3.out' },
        extendTimeline: true
    });
    
    // 2. 文本打字机效果
    gsap.registerEffect({
        name: 'typewriter',
        effect: (targets, config) => {
            return gsap.to(targets, {
                text: { value: config.text, delimiter: "" },
                duration: config.duration,
                ease: "none"
            });
        },
        defaults: { text: "", duration: 2 },
        extendTimeline: true
    });
    
    // 3. 庄严显现 (用于纪念碑等)
    gsap.registerEffect({
        name: 'memorialReveal',
        effect: (targets, config) => {
            return gsap.fromTo(targets,
                { opacity: 0, scale: 0.95, filter: 'blur(10px)' },
                { opacity: 1, scale: 1, filter: 'blur(0px)', duration: config.duration, ease: 'power2.inOut' }
            );
        },
        defaults: { duration: 2 },
        extendTimeline: true
    });
}
