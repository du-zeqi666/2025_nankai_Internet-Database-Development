<?php
/**
* Team：数据四骑士,NKU
* Coding by 蒋枘言 2313546
* this is memorial site detail
*/
/**
 * Memorial Site Detail Template
 * @var int $id
 */

use yii\helpers\Url;

$this->title = '参观指南 - ' . $site->name;
$this->params['bodyClass'] = 'page-site-detail';
?>

<style>
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

</style>

<div class="page-header">
    <div class="container">
        <h1>
            <a href="<?= $site->website ?>" target="_blank">
                <?= $site->name ?>
            </a>
        </h1>
        <p class="hero-subtitle"><?= $site->province ?> · <?= $site->city ?></p>
    </div>
</div>

<div class="section">
    <div class="container">

        <!-- 封面 + 基本信息 -->
        <div style="display:flex; gap:24px; flex-wrap:wrap;">
            <div style="flex:1; min-width:260px;">
                <img src="<?= Url::to($site->image) ?>" alt="<?= $site->name ?>"
                    style="width:100%; border-radius:14px;">
            </div>

            <div style="flex:1; min-width:260px; border:1px solid #eee; border-radius:14px; padding:18px;">
                <h2>基本信息</h2>

                <p><strong>地址：</strong><?= $site->address ?></p>
                <p><strong>省市：</strong><?= $site->province ?> · <?= $site->city ?></p>
                <p><strong>开放时间：</strong><?= $site->opening ?></p>
                <p><strong>联系电话：</strong><?= $site->phone ?: '暂无' ?></p>
                <p><strong>交通建议：</strong><?= $site->transport ?: '暂无' ?></p>

                <div style="margin-top:16px;">
                    <a href="<?= Url::to(['/sites/index']) ?>" class="btn btn-outline-primary">← 返回列表</a>
                </div>
            </div>
        </div>

        <div class="site-divider" style="margin:40px 0;"></div>

        <!-- 详细介绍 -->
        <section style="border:1px solid #eee; border-radius:14px; padding:18px;">
            <h2>场馆介绍</h2>
            <p style="line-height:1.8;">
                <?= nl2br($site->details) ?>
            </p>
        </section>

        <div style="margin-top:26px;">
            <a href="<?= Url::to(['/sites/index']) ?>" class="btn btn-secondary">返回纪念场馆列表</a>
        </div>

    </div>
</div>
