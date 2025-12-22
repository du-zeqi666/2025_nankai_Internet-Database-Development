<?php
/**
 * Memorial Sites List Template
 * @var $this yii\web\View
 */

use yii\helpers\Url;

$this->title = '纪念场馆';
$this->params['bodyClass'] = 'page-sites';
?>

<style>
    .site-divider {
        margin: 70px 0;
        height: 4px;
        background: linear-gradient(
            to right,
            transparent,
            #c40000,
            transparent
        );
    }

    .site-item {
        padding: 20px 0;
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
        /* 新的场馆列表布局 */
    .site-item {
        display: flex;
        gap: 36px;
        align-items: center;
        padding: 36px 0;
    }

    /* 左侧文字区域 */
    .site-content {
        flex: 1;
    }

    .site-content h2 {
        margin-top: 0;
        font-size: 22px;
    }

    .site-content h2 a {
        color: #111;
        text-decoration: none;
    }

    .site-content h2 a:hover {
        color: #c40000;
        text-decoration: underline;
    }

    .site-content .location {
        margin: 10px 0;
        color: #666;
        font-size: 14px;
    }

    .site-content .desc {
        margin: 14px 0 20px;
        line-height: 1.8;
        color: #444;
    }

    /* 右侧图片区域 */
    .site-image {
        flex: 0 0 320px;
    }

    .site-image img {
        width: 320px;
        height: 200px;
        object-fit: cover;
        border-radius: 14px;
        box-shadow: 0 8px 24px rgba(0,0,0,.08);
        background: #f5f5f5;
    }

    /* 按钮微调 */
    .site-actions .btn {
        padding: 8px 22px;
        border-radius: 999px;
    }

    /* 响应式：小屏上下排列 */
    @media (max-width: 768px) {
        .site-item {
            flex-direction: column-reverse;
            gap: 20px;
        }

        .site-image {
            width: 100%;
        }

        .site-image img {
            width: 100%;
            height: auto;
        }
    }
</style>



<div class="page-header">
    <div class="container">
        <h1>纪念场馆</h1>
        <p class="hero-subtitle">踏寻红色足迹，缅怀革命先烈，传承红色基因。</p>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="sites-list">

            <?php foreach ($sites as $index => $site): ?>

                <article class="site-item">
                    <!-- 左：文字 -->
                    <div class="site-content">
                        <h2>
                            <a href="<?= $site->website ?>" target="_blank">
                                <?= $site->name ?>
                            </a>
                        </h2>

                        <p class="location">
                            <i class="icon-location"></i>
                            <?= $site->address ?>
                        </p>

                        <p class="desc">
                            <?= $site->description ?>
                        </p>

                        <div class="site-actions">
                            <a href="<?= Url::to(['/sites/view', 'id' => $site->id]) ?>" class="btn btn-primary">
                                详情
                            </a>
                        </div>
                    </div>

                    <!-- 右：图片 -->
                    <div class="site-image">
                        <img src="<?= Url::to($site->image) ?>" alt="<?= $site->name ?>" loading="lazy">
                    </div>
                </article>

                <?php if ($index < count($sites) - 1): ?>
                    <div class="site-divider"></div>
                <?php endif; ?>

            <?php endforeach; ?>

        </div>
    </div>
</div>