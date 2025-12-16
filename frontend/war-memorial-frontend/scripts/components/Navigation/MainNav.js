/**
 * 🏛️ 抗战胜利80周年纪念网站 - 主导航组件
 * Main Navigation Component
 * 
 * @version 1.0.0
 * @description 响应式主导航，支持桌面端下拉菜单和移动端侧滑菜单
 */

import Component from '../Component';
import { gsap } from 'gsap';

export default class MainNav extends Component {
    constructor(container, options = {}) {
        super(container, options);
        
        this.state = {
            isMobileMenuOpen: false,
            isScrolled: false,
            activeDropdown: null
        };
        
        this.elements = {
            header: document.querySelector('.site-header'),
            toggleBtn: document.querySelector('.mobile-menu-toggle'),
            mobileMenu: document.querySelector('.mobile-nav-menu'),
            dropdowns: document.querySelectorAll('.nav-item.has-dropdown'),
            links: document.querySelectorAll('.nav-link')
        };
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.checkScroll();
        this.highlightActiveLink();
    }

    bindEvents() {
        // 滚动监听
        window.addEventListener('scroll', () => this.checkScroll(), { passive: true });
        
        // 移动端菜单切换
        if (this.elements.toggleBtn) {
            this.elements.toggleBtn.addEventListener('click', () => this.toggleMobileMenu());
        }
        
        // 下拉菜单交互 (桌面端)
        this.elements.dropdowns.forEach(dropdown => {
            const trigger = dropdown.querySelector('.dropdown-toggle');
            
            // 鼠标悬停
            dropdown.addEventListener('mouseenter', () => this.openDropdown(dropdown));
            dropdown.addEventListener('mouseleave', () => this.closeDropdown(dropdown));
            
            // 键盘焦点
            if (trigger) {
                trigger.addEventListener('focus', () => this.openDropdown(dropdown));
                trigger.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.toggleDropdown(dropdown);
                    }
                });
            }
        });
        
        // 点击外部关闭菜单
        document.addEventListener('click', (e) => {
            if (this.state.isMobileMenuOpen && 
                !this.elements.mobileMenu.contains(e.target) && 
                !this.elements.toggleBtn.contains(e.target)) {
                this.closeMobileMenu();
            }
        });
    }

    /**
     * 检查滚动状态，改变 Header 样式
     */
    checkScroll() {
        const scrollTop = window.scrollY;
        const threshold = 50;
        
        if (scrollTop > threshold && !this.state.isScrolled) {
            this.state.isScrolled = true;
            this.elements.header.classList.add('is-scrolled');
            
            // 动画效果
            gsap.to(this.elements.header, {
                backgroundColor: 'rgba(26, 26, 26, 0.95)',
                boxShadow: '0 4px 20px rgba(0,0,0,0.2)',
                padding: '0.5rem 0',
                duration: 0.3
            });
            
        } else if (scrollTop <= threshold && this.state.isScrolled) {
            this.state.isScrolled = false;
            this.elements.header.classList.remove('is-scrolled');
            
            // 恢复初始状态
            gsap.to(this.elements.header, {
                backgroundColor: 'transparent',
                boxShadow: 'none',
                padding: '1.5rem 0',
                duration: 0.3
            });
        }
    }

    /**
     * 切换移动端菜单
     */
    toggleMobileMenu() {
        if (this.state.isMobileMenuOpen) {
            this.closeMobileMenu();
        } else {
            this.openMobileMenu();
        }
    }

    openMobileMenu() {
        this.state.isMobileMenuOpen = true;
        this.elements.toggleBtn.classList.add('is-active');
        this.elements.toggleBtn.setAttribute('aria-expanded', 'true');
        this.elements.mobileMenu.classList.add('is-open');
        document.body.style.overflow = 'hidden'; // 禁止背景滚动
        
        // 菜单项入场动画
        const items = this.elements.mobileMenu.querySelectorAll('.mobile-nav-item');
        gsap.fromTo(items, 
            { x: -50, opacity: 0 },
            { x: 0, opacity: 1, stagger: 0.1, duration: 0.4, ease: 'power2.out' }
        );
    }

    closeMobileMenu() {
        this.state.isMobileMenuOpen = false;
        this.elements.toggleBtn.classList.remove('is-active');
        this.elements.toggleBtn.setAttribute('aria-expanded', 'false');
        this.elements.mobileMenu.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    /**
     * 下拉菜单控制
     */
    openDropdown(dropdown) {
        dropdown.classList.add('is-active');
        const menu = dropdown.querySelector('.dropdown-menu');
        
        if (menu) {
            gsap.to(menu, {
                opacity: 1,
                y: 0,
                visibility: 'visible',
                duration: 0.2,
                ease: 'power2.out'
            });
        }
    }

    closeDropdown(dropdown) {
        dropdown.classList.remove('is-active');
        const menu = dropdown.querySelector('.dropdown-menu');
        
        if (menu) {
            gsap.to(menu, {
                opacity: 0,
                y: 10,
                visibility: 'hidden',
                duration: 0.2,
                ease: 'power2.in'
            });
        }
    }

    toggleDropdown(dropdown) {
        if (dropdown.classList.contains('is-active')) {
            this.closeDropdown(dropdown);
        } else {
            // 关闭其他打开的菜单
            this.elements.dropdowns.forEach(d => {
                if (d !== dropdown) this.closeDropdown(d);
            });
            this.openDropdown(dropdown);
        }
    }

    /**
     * 高亮当前页面链接
     */
    highlightActiveLink() {
        const currentPath = window.location.pathname;
        
        this.elements.links.forEach(link => {
            const href = link.getAttribute('href');
            if (href === currentPath || (href !== '/' && currentPath.startsWith(href))) {
                link.classList.add('is-active');
                link.setAttribute('aria-current', 'page');
            } else {
                link.classList.remove('is-active');
                link.removeAttribute('aria-current');
            }
        });
    }
}
