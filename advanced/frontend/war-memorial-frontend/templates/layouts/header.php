<?php
/**
 * 🏛️ 抗战胜利80周年纪念网站 - 头部模板
 * Header Partial Template
 * 
 * @description 包含网站 Logo、主导航、搜索栏和用户操作区
 */
?>
<header class="site-header" role="banner">
    <div class="container-fluid">
        <div class="header-inner">
            <!-- 1. Logo 区域 -->
            <div class="header-logo">
                <a href="/" class="logo-link" aria-label="返回首页">
                    <img src="/assets/images/logo-gold.svg" alt="抗战胜利80周年纪念" class="logo-img">
                    <div class="logo-text">
                        <span class="logo-title">铭记历史</span>
                        <span class="logo-subtitle">1945-2025</span>
                    </div>
                </a>
            </div>

            <!-- 2. 主导航区域 (桌面端) -->
            <nav class="main-nav d-none d-lg-block" role="navigation" aria-label="主导航">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="/" class="nav-link active">首页</a>
                    </li>
                    <li class="nav-item has-dropdown">
                        <a href="/heroes" class="nav-link dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                            抗战英雄谱
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-inner">
                                <a href="/heroes?type=martyr" class="dropdown-item">
                                    <span class="icon">🎖️</span>
                                    <span class="text">革命烈士</span>
                                </a>
                                <a href="/heroes?type=general" class="dropdown-item">
                                    <span class="icon">⭐</span>
                                    <span class="text">抗战名将</span>
                                </a>
                                <a href="/heroes?type=civilian" class="dropdown-item">
                                    <span class="icon">👥</span>
                                    <span class="text">平民英雄</span>
                                </a>
                                <a href="/heroes?type=international" class="dropdown-item">
                                    <span class="icon">🌍</span>
                                    <span class="text">国际友人</span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="/battles" class="nav-link">战役史诗</a>
                    </li>
                    <li class="nav-item">
                        <a href="/timeline" class="nav-link">历史长卷</a>
                    </li>
                    <li class="nav-item">
                        <a href="/relics" class="nav-link">文物珍藏</a>
                    </li>
                    <li class="nav-item">
                        <a href="/sites" class="nav-link">纪念场馆</a>
                    </li>
                    <li class="nav-item">
                        <a href="/memorial" class="nav-link highlight">献花祭奠</a>
                    </li>
                </ul>
            </nav>

            <!-- 3. 右侧工具栏 -->
            <div class="header-tools">
                <!-- 搜索按钮 -->
                <button class="tool-btn search-toggle" aria-label="打开搜索">
                    <svg class="icon" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="currentColor" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                </button>

                <!-- 用户登录/个人中心 -->
                <div class="user-menu">
                    <?php if (isset($user)): ?>
                        <a href="/user/profile" class="user-link" aria-label="个人中心">
                            <img src="<?= $user['avatar'] ?? '/assets/images/default-avatar.png' ?>" alt="" class="user-avatar">
                        </a>
                    <?php else: ?>
                        <a href="/user/login" class="btn btn-sm btn-outline-gold">登录</a>
                    <?php endif; ?>
                </div>

                <!-- 移动端菜单切换按钮 -->
                <button class="mobile-menu-toggle d-lg-none" aria-label="切换菜单" aria-expanded="false">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>

    <!-- 移动端侧滑菜单 -->
    <div class="mobile-nav-menu" aria-hidden="true">
        <div class="mobile-nav-content">
            <ul class="mobile-nav-list">
                <li><a href="/" class="mobile-nav-item">首页</a></li>
                <li><a href="/heroes" class="mobile-nav-item">抗战英雄谱</a></li>
                <li><a href="/battles" class="mobile-nav-item">战役史诗</a></li>
                <li><a href="/timeline" class="mobile-nav-item">历史长卷</a></li>
                <li><a href="/relics" class="mobile-nav-item">文物珍藏</a></li>
                <li><a href="/sites" class="mobile-nav-item">纪念场馆</a></li>
                <li><a href="/memorial" class="mobile-nav-item highlight">献花祭奠</a></li>
            </ul>
            <div class="mobile-nav-footer">
                <a href="/user/login" class="btn btn-block btn-outline-gold">登录 / 注册</a>
            </div>
        </div>
    </div>
</header>
