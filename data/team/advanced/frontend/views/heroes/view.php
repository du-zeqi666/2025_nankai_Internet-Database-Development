<?php
/**
* Team：数据四骑士,NKU
* Coding by 杨中秀 2312323
* this is view hero
*/
/*
 * Hero Detail Template（动态参数化版本）
 * @var $this yii\web\View
 * @var $hero common\models\Hero
 */

use yii\helpers\Url;
use yii\web\NotFoundHttpException;

$css = <<<CSS
.hero-profile .profile-image {
    display: block;
    width: 67%;   /* 图片铺满左边那一列 */
    height: auto;
}
/*革命历程时间线的滚动动画样式*/
.hero-timeline .hero-timeline__item {
    opacity: 0;
    transform: translateY(40px);
}

/* 元素进入视口后，淡入并上移归位 */
.hero-timeline .hero-timeline__item.is-visible {
    opacity: 1;
    transform: translateY(0);
    transition: opacity .6s ease, transform .6s ease;
}
/*把文字布局 & 颜色强制拉出来*/
.hero-timeline .timeline-container {
    position: relative;
    /* 新增：确保容器占满宽度，作为基础 */
    width: 100% !important;
    box-sizing: border-box !important;
}

/* 每条时间线项目水平排布：左边年份，右边文字（重写flex布局，强制对齐） */
.hero-timeline .hero-timeline__item {
    display: flex !important; /*强制flex布局，防止被覆盖*/
    align-items: flex-start !important;
    justify-content: flex-end !important; /*让整个flex内容靠右*/
    gap: 24px !important;
    margin-bottom: 24px !important;
    width: 100% !important; /* 强制占满父宽度，必加 */
    box-sizing: border-box !important;
}

/* 年份块：强制固定在左侧，不受justify-content影响 */
.hero-timeline .hero-timeline__item .timeline-date {
    flex: 0 0 auto !important;
    /* 关键：用绝对定位固定年份在左侧，文字自然靠右（兜底方案） */
    position: relative !important;
    left: 0 !important;
    min-width: 80px !important; /* 固定最小宽度，避免挤压 */
}

/* 事件内容块：强制占剩余空间，文字绝对靠 */
.hero-timeline .hero-timeline__item .timeline-content {
    flex: 1 1 auto !important;
    opacity: 1 !important;
    transform: none !important;
    color: #460675ff !important;
    /* 移除display: block !important; 避免破坏flex子元素特性 */
    display: inline-block !important; /* 改为行内块，配合居右 */
    text-align: right !important; /* 核心1：文字右对齐（强制） */
    width: calc(100% - 104px) !important; /* 减去年份宽度+gap，确保不换行 */
    margin-left: auto !important; /*margin-left auto 强制块靠右 */
}

/* 标题 & 描述：强制继承右对齐，覆盖所有默认样式 */
.hero-timeline .hero-timeline__item .event-title {
    font-size: 20px !important;
    font-weight: bold !important;
    margin: 0 0 8px 0 !important;
    text-align: right !important; /* 单独强制右对齐 */
}

.hero-timeline .hero-timeline__item .event-desc {
    margin: 0 !important;
    line-height: 1.6 !important;
    text-align: right !important; /* 单独强制右对齐 */
}


CSS;
$this->registerCss($css);

// 3. 配置页面元信息
$this->title = $hero->name . ' - 英雄谱';
$this->params['bodyClass'] = 'page-hero-detail';
?>

<!-- 英雄档案展示区 -->
<div class="hero-profile">
    <div class="container">
        <div class="row align-items-center g-0">
            <div class="col-md-5">
                <img src="<?= Url::to('@web/assets/images/heroes/' . ($hero->photo_large ?: $hero->photo)) ?>" alt="<?= htmlspecialchars($hero->name) ?>" class="profile-image">
            </div>
            <div class="col-md-7">
                <div class="profile-info">
                    <h1><?= htmlspecialchars($hero->name) ?></h1>
                    <div class="hero-title"><?= htmlspecialchars($hero->title) ?></div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <label>籍贯</label>
                            <span><?= htmlspecialchars($hero->birth_place) ?></span>
                        </div>
                        <div class="info-item">
                            <label>生卒年</label>
                            <span><?= htmlspecialchars($hero->lifeYears) ?></span>
                        </div>
                        <div class="info-item">
                            <label>牺牲地点</label>
                            <span><?= htmlspecialchars($hero->death_place) ?></span>
                        </div>
                        <div class="info-item">
                            <label>荣誉</label>
                            <span><?= htmlspecialchars($hero->honor) ?></span>
                        </div>
                    </div>
                    
                    <blockquote class="blockquote">
                        "<?= htmlspecialchars($hero->quote) ?>"
                        <footer><?= htmlspecialchars($hero->quote_source) ?></footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 生平事迹展示区 -->
<div class="hero-biography">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-header">
                    <h2>生平事迹</h2>
                </div>
                <div class="bio-content">
                    <?php 
                    // 处理生平简介，按换行符分割段落
                    $paragraphs = preg_split('/\r\n|\r|\n/', $hero->biography, -1, PREG_SPLIT_NO_EMPTY);
                    foreach ($paragraphs as $paragraph): 
                    ?>
                    <p><?= htmlspecialchars($paragraph) ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($hero->timelines)): ?>
<!-- 革命历程时间线 -->
<div class="hero-timeline">
    <div class="container">
        <!-- 与“生平事迹”一致的网格包装，保证左边线统一 -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-header">
                    <h2>革命历程</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="timeline-container">
                    <?php foreach ($hero->timelines as $item): ?>
                        <div class="hero-timeline__item timeline-item">
                            <div class="year timeline-date"><?= htmlspecialchars($item->year) ?></div>
                            <div class="event timeline-content">
                                <h3 class="event-title"><?= htmlspecialchars($item->title) ?></h3>
                                <p class="event-desc"><?= htmlspecialchars($item->content) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
$js = <<<JS
document.addEventListener('DOMContentLoaded', function () {
    var items = document.querySelectorAll('.hero-timeline__item');
    if (!items.length) return;

    var observer = new IntersectionObserver(function(entries, obs) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var el = entry.target;
                el.classList.add('is-visible');

                if (window.gsap) {
                    gsap.fromTo(el,
                        { opacity: 0, y: 50 },
                        { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out' }
                    );
                }

                obs.unobserve(el);
            }
        });
    }, {
        threshold: 0.2
    });

    items.forEach(function(item) {
        observer.observe(item);
    });
});
JS;

$this->registerJs($js, \yii\web\View::POS_END);
?>