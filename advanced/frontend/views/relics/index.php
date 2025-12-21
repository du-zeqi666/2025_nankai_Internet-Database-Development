<?php
/**
 * Relics List Template
 * @var $this yii\web\View
 */

use yii\helpers\Url;

$this->title = '文物史料';
$this->params['bodyClass'] = 'page-relics';
?>

<style>
    .relic-tabs {
        display: inline-flex;
        gap: 14px;
        padding: 10px 14px;
        margin-bottom: 32px;
        background: #f4f1ea;          /* 整体浅色背景 */
        border-radius: 12px;
    }

    .relic-tabs .tab {
        padding: 10px 22px;
        font-size: 16px;              /* 比之前稍大一点 */
        font-weight: 500;
        color: #333;
        background: transparent;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    /* 悬停效果 */
    .relic-tabs .tab:hover {
        background: #e7e2d8;
    }

    /* 当前激活的选项 */
    .relic-tabs .tab.active {
        background: #8b0000;          /* 深红色，契合抗战主题 */
        color: #fff;
        box-shadow: 0 4px 10px rgba(139, 0, 0, 0.25);
    }

    /* 新增：拉开标题文字和下面装饰的距离 */
    .page-header p {
        margin-bottom: 40px;
    }

    /* 统一的副标题样式 */
    .hero-subtitle {
        font-size: 18px;
        letter-spacing: 3px;
        color: rgba(0,0,0,.60);
        font-weight: 500;
        margin-top: 0.5rem;
    }

    /* ===== 文物卡片整体布局 ===== */
    .relics-grid {
        display: flex;
        flex-direction: column;
        gap: 28px;
    }

    /* 单个文物卡片：左右布局 */
    .relic-card {
        display: flex;
        align-items: stretch;
        gap: 28px;
        padding: 24px;
        background: #faf8f4;
        border-radius: 14px;
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.06);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    /* 悬停轻微抬起，增强质感 */
    .relic-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.10);
    }

    /* ===== 左侧文字区域 ===== */
    .relic-body {
        flex: 1 1 auto;
    }

    .relic-body h3 {
        font-size: 22px;
        font-weight: 700;
        color: #7a1d1d;
        margin-bottom: 12px;
    }

    .relic-body p {
        font-size: 15px;
        line-height: 1.8;
        color: #444;
        margin-bottom: 10px;
    }

    /* 现存地点弱化处理 */
    .relic-body p:last-child {
        font-size: 14px;
        color: #777;
    }

    /* ===== 右侧图片区域（关键） ===== */
    .relic-card img {
        width: 260px;          /* 固定宽度 */
        height: 180px;         /* 固定高度 */
        flex-shrink: 0;
        border-radius: 10px;
        object-fit: cover;     /* 强制裁剪，统一比例 */
        background: #ddd;
    }

    /* ===== 响应式：小屏幕下改为上下布局 ===== */
    @media (max-width: 768px) {
        .relic-card {
            flex-direction: column;
        }

        .relic-card img {
            width: 100%;
            height: 220px;
        }
    }

</style>

<div class="page-header">
    <div class="container">
        <h1>文物史料</h1>
        <p class="hero-subtitle">每一件文物都是历史的见证，诉说着那段烽火连天的岁月。</p>
    </div>
</div>

<div class="section">
    <div class="container">

        <!-- 分类选项卡 -->
        <div class="relic-tabs">
            <button class="tab active" data-category="all">全部</button>
            <button class="tab" data-category="武器装备">武器装备</button>
            <button class="tab" data-category="文献资料">文献资料</button>
            <button class="tab" data-category="生活用品">生活用品</button>
            <button class="tab" data-category="其他">其他</button>
        </div>

        <!-- 文物列表 -->
        <div class="relics-grid">

            <?php foreach ($relics as $relic): ?>
                <div class="relic-card" data-category="<?= $relic->category ?>">

                    <?php if (!empty($relic->image)): ?>
                        <img src="<?= Yii::getAlias('@web') . '/' . $relic->image ?>" alt="<?= $relic->name ?>">
                    <?php else: ?>
                        <img src="<?= Yii::getAlias('@web/assets/images/relics/default.jpg') ?>" alt="暂无图片">
                    <?php endif; ?>

                    <div class="relic-body">
                        <h3><?= $relic->name ?></h3>

                        <p><?= $relic->description ?></p>

                        <?php if (!empty($relic->current_location)): ?>
                            <p style="font-size: 14px; color: #666;">
                                现存地点：<?= $relic->current_location ?>
                            </p>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- 分类切换 JS -->
<script>
    const tabs = document.querySelectorAll('.relic-tabs .tab');
    const cards = document.querySelectorAll('.relic-card');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            const category = tab.dataset.category;

            cards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>
