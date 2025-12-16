<?php
/**add by 2312323 杨中秀
 * Battle Detail Template
 * @var $this yii\web\View
 * @var $battle common\models\Battle
 */

use yii\helpers\Url;
use yii\web\NotFoundHttpException;

$timelineCss = <<<CSS
/* 初始状态：用于滚动动画 */
.battle-timeline .timeline-item {
    opacity: 0;
    transform: translateY(40px);
}

/* 进入视口后的状态：淡入 + 上移 */
.battle-timeline .timeline-item.is-visible {
    opacity: 1;
    transform: translateY(0);
    transition: opacity .6s ease, transform .6s ease;
}

/* 布局：左边时间，右边内容（新增强制宽度和盒模型，避免宽度问题 + 适配轴线布局） */
.battle-timeline .timeline-container {
    position: relative;
    max-width: 960px;
    margin: 0 auto;
    width: 100% !important; /* 强制占满父宽度，作为基础 */
    box-sizing: border-box !important; /* 宽度包含内边距和边框 */
}

/* 时间线项目：强制flex布局，确保时间左、文字右的结构 + 适配轴线的对齐逻辑 */
.battle-timeline .timeline-item {
    display: flex !important; /* 强制flex布局，防止被覆盖 */
    align-items: flex-start !important;
    /* 替换注释的space-between为生效状态，让时间贴左、文字贴右（核心修改1） */
    justify-content: space-between !important;
    /* gap: 24px !important; 注释gap，改用space-between的间距逻辑，避免和轴线冲突 */
    margin-bottom: 32px !important;
    width: 100% !important; /* 强制占满容器宽度，确保布局生效 */
    box-sizing: border-box !important;
    position: relative !important; /* 新增：作为中间轴线的定位参考（核心修改2） */
}

/* 时间在左侧：固定最小宽度，避免挤压，保持布局整齐 + 贴近轴线的右对齐（核心修改3） */
.battle-timeline .timeline-event-date {
    flex: 0 0 auto !important;
    min-width: 120px !important; /* 调整宽度，给轴线留空间，比80px更适配布局 */
    text-align: right !important; /* 时间本身右对齐，贴近中间轴线 */
}

/* 内容在右侧，占满剩余宽度（解决之前样式不生效的核心修改 + 文字靠右+宽度适配） */
.battle-timeline .timeline-content {
    flex: 1 1 auto !important;
    opacity: 1 !important;
    transform: none !important;
    /* 移除display: block !important; 避免破坏flex子元素特性 */
    color: #333 !important;
    /* 取消注释，强制文字右对齐（核心修改5） */
    text-align: right !important;
    /* 取消注释，强制文字块靠右（flex杀手锏，双重保障，核心修改6） */
    margin-left: auto !important;
    width: calc(100% - 150px) !important; /* 新增：减时间块+轴线宽度，避免换行（核心修改7） */
}

/* 标题 & 描述样式，可以按你自己的主题再调（继承父元素的对齐方式 + 强制右对齐） */
.battle-timeline .timeline-event-title {
    font-size: 20px !important;
    font-weight: bold !important;
    margin: 0 0 8px 0 !important;
    /* 取消注释，强制标题右对齐（核心修改8） */
    text-align: right !important;
    color: #d9534f !important; /* 新增：标题红色，匹配截图样式 */
}

.battle-timeline .timeline-event-desc-text {
    margin: 0 !important;
    line-height: 1.6 !important;
    /* 取消注释，强制描述右对齐（核心修改9） */
    text-align: right !important;
}
CSS;

$this->registerCss($timelineCss);

// 3. 配置页面元信息
$this->title = $battle->name . ' - 战役史诗';
$this->params['bodyClass'] = 'page-battle-detail';
?>

<!-- 战役档案展示区 -->
<div class="battle-profile">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <img src="<?= Url::to('@web/assets/images/battles/' . ($battle->detail_image ?: ($battle->image ?: 'default.jpg'))) ?>"
                     alt="<?= htmlspecialchars($battle->name) ?>"
                     class="profile-image">
            </div>
            <div class="col-md-7">
                <div class="profile-info">
                    <h1><?= htmlspecialchars($battle->name) ?></h1>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <label>时间</label>
                            <span><?= htmlspecialchars($battle->getDuration()) ?></span>
                        </div>
                        <div class="info-item">
                            <label>地点</label>
                            <span><?= htmlspecialchars($battle->location) ?></span>
                        </div>
                        <div class="info-item">
                            <label>战役结果</label>
                            <span><?= htmlspecialchars($battle->result) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 战役概况展示区 -->
<div class="battle-summary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-header">
                    <h2>战役概况</h2>
                </div>
                <div class="summary-content">
                    <p><?= nl2br(htmlspecialchars($battle->description)) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 战役意义 -->
<?php if (!empty($battle->significance)): ?>
<div class="battle-significance">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-header">
                    <h2>历史意义</h2>
                </div>
                <div class="significance-content">
                    <p><?= nl2br(htmlspecialchars($battle->significance)) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- 战役历程时间线 -->
<?php if (!empty($battle->timelines)): ?>
<div class="battle-timeline">
    <div class="container">
        <div class="section-header">
            <h2>战役历程</h2>
        </div>
        <div class="timeline-container">
            <?php foreach ($battle->timelines as $item): ?>
                <div class="timeline-item timeline-event-card">
                    <div class="timeline-event-date timeline-date"><?= date('Y年m月', strtotime($item->date)) ?></div>
                    <div class="timeline-content timeline-event-desc">
                        <h3 class="timeline-event-title"><?= htmlspecialchars($item->title) ?></h3>
                        <p class="timeline-event-desc-text"><?= htmlspecialchars($item->description) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
$timelineJs = <<<JS
document.addEventListener('DOMContentLoaded', function () {
    var items = document.querySelectorAll('.battle-timeline .timeline-item');
    if (!items.length) return;

    var observer = new IntersectionObserver(function(entries, obs) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var el = entry.target;
                el.classList.add('is-visible');

                // 如果全局已经引入 GSAP，可以用 GSAP 做更顺滑的动画
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

$this->registerJs($timelineJs, \yii\web\View::POS_END);
?>
