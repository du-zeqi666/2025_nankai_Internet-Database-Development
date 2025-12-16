<?php
/**
 * 🏛️ 抗战胜利80周年纪念网站 - 首页模板
 * Home Page Template
 */

$this->title = '首页';
$this->params['bodyClass'] = 'home-page';
?>

<!-- 1. Hero Section: 首屏震撼区 -->
<section class="home-hero" aria-label="首屏展示">
    <!-- 背景视频/图片 -->
    <div class="hero-bg-wrapper">
        <video class="hero-video" autoplay muted loop playsinline poster="/assets/images/hero-poster.jpg">
            <source src="/assets/videos/hero-bg.mp4" type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
    </div>

    <div class="container">
        <div class="hero-content text-center">
            <h1 class="display-1 text-gold mb-4" data-animate="fadeInUp">
                铭记历史 珍爱和平
            </h1>
            <p class="lead text-white mb-5" data-animate="fadeInUp" data-delay="0.2">
                纪念中国人民抗日战争暨世界反法西斯战争胜利80周年<br>
                <span class="text-gold">1945 — 2025</span>
            </p>
            
            <!-- 倒计时组件 -->
            <div class="hero-countdown mb-5" data-animate="fadeInUp" data-delay="0.4">
                <div class="countdown-item">
                    <span class="number" id="days">00</span>
                    <span class="label">天</span>
                </div>
                <div class="countdown-separator">:</div>
                <div class="countdown-item">
                    <span class="number" id="hours">00</span>
                    <span class="label">时</span>
                </div>
                <div class="countdown-separator">:</div>
                <div class="countdown-item">
                    <span class="number" id="minutes">00</span>
                    <span class="label">分</span>
                </div>
                <div class="countdown-separator">:</div>
                <div class="countdown-item">
                    <span class="number" id="seconds">00</span>
                    <span class="label">秒</span>
                </div>
            </div>

            <div class="hero-actions" data-animate="fadeInUp" data-delay="0.6">
                <a href="/memorial" class="btn btn-lg btn-gold mr-3">
                    <i class="icon-flower"></i> 献花祭奠
                </a>
                <a href="/timeline" class="btn btn-lg btn-outline-white">
                    <i class="icon-history"></i> 浏览历史
                </a>
            </div>
        </div>
    </div>

    <!-- 滚动提示 -->
    <div class="scroll-indicator">
        <span class="text">向下滚动</span>
        <i class="icon-arrow-down"></i>
    </div>
</section>

<!-- 2. Stats Section: 历史数据统计 -->
<section class="stats-section section-padding bg-dark text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <div class="stat-item" data-animate="countUp">
                    <div class="stat-number text-gold display-3">14</div>
                    <div class="stat-label">年抗战岁月</div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <div class="stat-item" data-animate="countUp">
                    <div class="stat-number text-gold display-3">3500</div>
                    <div class="stat-label">万+ 伤亡同胞</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item" data-animate="countUp">
                    <div class="stat-number text-gold display-3">22</div>
                    <div class="stat-label">场重大战役</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item" data-animate="countUp">
                    <div class="stat-number text-gold display-3">100</div>
                    <div class="stat-label">% 伟大胜利</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Timeline Preview: 历史长卷预览 -->
<section class="timeline-preview section-padding bg-parchment">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">抗战历史长卷</h2>
            <p class="section-subtitle text-muted">十四年浴血奋战，铸就民族复兴的钢铁长城</p>
        </div>
        
        <div class="timeline-scroll-container">
            <div class="timeline-track">
                <!-- 1931 九一八 -->
                <div class="timeline-card" data-year="1931">
                    <div class="card-media">
                        <img src="/assets/images/events/918.jpg" alt="九一八事变" loading="lazy">
                    </div>
                    <div class="card-content">
                        <span class="year">1931.9.18</span>
                        <h3>九一八事变</h3>
                        <p>日本关东军炸毁南满铁路，炮轰北大营，抗日战争爆发。</p>
                    </div>
                </div>
                
                <!-- 1937 七七事变 -->
                <div class="timeline-card" data-year="1937">
                    <div class="card-media">
                        <img src="/assets/images/events/77.jpg" alt="七七事变" loading="lazy">
                    </div>
                    <div class="card-content">
                        <span class="year">1937.7.7</span>
                        <h3>七七事变</h3>
                        <p>日军炮轰卢沟桥，中国守军奋起抵抗，全民族抗战开始。</p>
                    </div>
                </div>
                
                <!-- 1937 平型关大捷 -->
                <div class="timeline-card" data-year="1937">
                    <div class="card-media">
                        <img src="/assets/images/events/pingxingguan.jpg" alt="平型关大捷" loading="lazy">
                    </div>
                    <div class="card-content">
                        <span class="year">1937.9.25</span>
                        <h3>平型关大捷</h3>
                        <p>八路军115师伏击日军，取得抗战以来第一个大胜仗。</p>
                    </div>
                </div>
                
                <!-- 1938 台儿庄大捷 -->
                <div class="timeline-card" data-year="1938">
                    <div class="card-media">
                        <img src="/assets/images/events/taierzhuang.jpg" alt="台儿庄大捷" loading="lazy">
                    </div>
                    <div class="card-content">
                        <span class="year">1938.4</span>
                        <h3>台儿庄大捷</h3>
                        <p>中国军队在台儿庄重创日军，歼敌万余人，振奋了民族精神。</p>
                    </div>
                </div>
                
                <!-- 1945 日本投降 -->
                <div class="timeline-card highlight" data-year="1945">
                    <div class="card-media">
                        <img src="/assets/images/events/surrender.jpg" alt="日本投降" loading="lazy">
                    </div>
                    <div class="card-content">
                        <span class="year">1945.8.15</span>
                        <h3>日本无条件投降</h3>
                        <p>日本天皇广播《终战诏书》，宣布无条件投降。</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="/timeline" class="btn btn-outline-primary">查看完整历史长卷</a>
        </div>
    </div>
</section>

<!-- 4. Heroes Section: 英雄谱 -->
<section class="heroes-section section-padding">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">抗战英雄谱</h2>
            <p class="section-subtitle text-muted">天地英雄气，千秋尚凛然</p>
        </div>
        
        <div class="hero-grid">
            <!-- 动态加载英雄卡片 -->
            <div class="loading-placeholder">正在加载英雄数据...</div>
        </div>
        
        <div class="text-center mt-5">
            <a href="/heroes" class="btn btn-primary">缅怀更多英雄</a>
        </div>
    </div>
</section>

<!-- 5. Memorial Section: 献花互动 -->
<section class="memorial-section section-padding bg-dark text-white" style="background-image: url('/assets/images/bg-candle.jpg');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="display-4 mb-4">缅怀先烈 寄托哀思</h2>
                <p class="lead mb-5">每一朵鲜花，都是一份敬意；每一盏烛光，都是一份思念。</p>
                
                <div class="memorial-stats mb-5">
                    <div class="d-flex align-items-center mb-3">
                        <i class="icon-flower text-gold mr-3" style="font-size: 2rem;"></i>
                        <div>
                            <div class="h3 mb-0">125,680</div>
                            <small class="text-muted">人次已献花</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="icon-candle text-gold mr-3" style="font-size: 2rem;"></i>
                        <div>
                            <div class="h3 mb-0">89,432</div>
                            <small class="text-muted">人次已点灯</small>
                        </div>
                    </div>
                </div>
                
                <a href="/memorial" class="btn btn-gold btn-lg">立即祭奠</a>
            </div>
            <div class="col-lg-6">
                <!-- 实时留言墙组件 -->
                <div class="message-wall-widget">
                    <div class="wall-header">最新留言</div>
                    <div class="wall-content" id="home-message-wall">
                        <!-- 动态插入留言 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
