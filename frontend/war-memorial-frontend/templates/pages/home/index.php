<?php
/**
 * Home Page Template
 * @var $this yii\web\View
 */

$this->title = '首页';
$this->params['bodyClass'] = 'page-home';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg">
        <video autoplay muted loop playsinline poster="/assets/images/hero-poster.jpg">
            <source src="/assets/videos/hero-intro/intro.mp4" type="video/mp4">
        </video>
    </div>
    <div class="hero-content">
        <h1 class="hero-title">铭记历史 珍爱和平</h1>
        <p class="hero-subtitle">纪念中国人民抗日战争暨世界反法西斯战争胜利80周年</p>
        <div class="hero-actions">
            <a href="/timeline" class="btn btn-primary btn-lg">探索历史长卷</a>
            <a href="/heroes" class="btn btn-outline-gold btn-lg ml-4">瞻仰英雄谱</a>
        </div>
    </div>
    <div class="scroll-indicator">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M7 13l5 5 5-5M7 6l5 5 5-5"/>
        </svg>
    </div>
</section>

<!-- Featured Heroes -->
<section class="section section-heroes">
    <div class="container">
        <div class="section-header">
            <h2>英雄不朽</h2>
            <p>他们用血肉之躯筑起了钢铁长城，他们的名字将永远镌刻在历史的丰碑上。</p>
        </div>
        
        <div class="heroes-grid">
            <!-- Hero Card 1 -->
            <div class="card card-hero fade-in-up">
                <div class="card-img-wrapper">
                    <img src="/assets/images/heroes/yang-jingyu.jpg" alt="杨靖宇" loading="lazy">
                </div>
                <div class="card-body">
                    <h3 class="card-title">杨靖宇</h3>
                    <p class="card-text">东北抗日联军第一路军总司令兼政治委员</p>
                </div>
            </div>
            
            <!-- Hero Card 2 -->
            <div class="card card-hero fade-in-up" style="transition-delay: 0.1s">
                <div class="card-img-wrapper">
                    <img src="/assets/images/heroes/zuo-quan.jpg" alt="左权" loading="lazy">
                </div>
                <div class="card-body">
                    <h3 class="card-title">左权</h3>
                    <p class="card-text">八路军副参谋长</p>
                </div>
            </div>
            
            <!-- Hero Card 3 -->
            <div class="card card-hero fade-in-up" style="transition-delay: 0.2s">
                <div class="card-img-wrapper">
                    <img src="/assets/images/heroes/zhang-zizhong.jpg" alt="张自忠" loading="lazy">
                </div>
                <div class="card-body">
                    <h3 class="card-title">张自忠</h3>
                    <p class="card-text">第33集团军总司令</p>
                </div>
            </div>
            
            <!-- Hero Card 4 -->
            <div class="card card-hero fade-in-up" style="transition-delay: 0.3s">
                <div class="card-img-wrapper">
                    <img src="/assets/images/heroes/zhao-yiman.jpg" alt="赵一曼" loading="lazy">
                </div>
                <div class="card-body">
                    <h3 class="card-title">赵一曼</h3>
                    <p class="card-text">东北抗日联军第三军二团政委</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="/heroes" class="btn btn-outline-primary">查看更多英雄</a>
        </div>
    </div>
</section>

<!-- History Timeline Preview -->
<section class="section section-dark section-history">
    <div class="container">
        <div class="section-header">
            <h2 class="text-gold">烽火岁月</h2>
            <p class="text-muted">十四年抗战，艰苦卓绝。重温那段波澜壮阔的历史征程。</p>
        </div>
        
        <div class="timeline-preview">
            <!-- Timeline content will be injected by JS -->
            <div class="timeline-slider">
                <!-- 1931 -->
                <div class="timeline-slide">
                    <span class="year">1931</span>
                    <h3>九一八事变</h3>
                    <p>日本关东军炸毁南满铁路，炮轰北大营，抗日战争爆发。</p>
                </div>
                <!-- 1937 -->
                <div class="timeline-slide">
                    <span class="year">1937</span>
                    <h3>七七事变</h3>
                    <p>日本发动全面侵华战争，中国全民族抗战开始。</p>
                </div>
                <!-- 1945 -->
                <div class="timeline-slide">
                    <span class="year">1945</span>
                    <h3>抗战胜利</h3>
                    <p>日本宣布无条件投降，中国人民抗日战争取得伟大胜利。</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="/timeline" class="btn btn-secondary">进入历史长卷</a>
        </div>
    </div>
</section>

<!-- Memorial Sites Map -->
<section class="section section-map">
    <div class="map-container" id="home-map"></div>
    <div class="map-overlay">
        <h3>红色足迹</h3>
        <p>遍布神州大地的抗战纪念地，是历史的见证，也是精神的坐标。</p>
        <ul class="site-list">
            <li>中国人民抗日战争纪念馆</li>
            <li>侵华日军南京大屠杀遇难同胞纪念馆</li>
            <li>沈阳"九·一八"历史博物馆</li>
        </ul>
        <a href="/sites" class="btn btn-primary btn-sm mt-4">探索纪念地图</a>
    </div>
</section>
