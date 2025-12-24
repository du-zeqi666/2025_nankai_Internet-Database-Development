<?php
/**
* Team：数据四骑士,NKU
* Coding by 蒋枘言 2313546
* this is timeline
*/

use yii\helpers\Html;

/* @var $events common\models\Timeline[] */

$this->title = '历史时间轴 - 抗战胜利80周年纪念网站';
$this->params['bodyClass'] = 'page-timeline';

/* 在视图顶部追加：取消时间轴项的初始隐藏，并补齐布局样式 */
$this->registerCss(<<<CSS
/* 让事件项默认可见并排版 */
.hero-timeline__item{
  display:flex;
  align-items:flex-start;
  gap:24px;
  margin:0 0 26px 0;
  opacity:1 !important;
  transform:none !important;
}
.timeline-date{
  min-width:140px;
  font-size:48px;
  font-weight:900;
  color:#b8882a;
  line-height:1;
}
.timeline-content{
  flex:1 1 auto;
  margin-left:auto;
  text-align:right;
  opacity:1 !important;
}
.event-title{
  font-size:26px;
  font-weight:900;
  color:#7a1d1d;
  margin:0 0 10px 0;
}
.event-desc{
  margin:0;
  color:rgba(0,0,0,.62);
  line-height:1.8;
  font-size:16px;
}

/* 若页面之前引入了“进入视口动画”的样式，但没有对应 JS，请先禁用它的初始隐藏 */
.timeline-stage.is-animating .hero-timeline__item{
  opacity:1;
  transform:none;
}

CSS);
?>

<style>
    /* ===== 时间轴整体 ===== */
    .timeline {
        max-width: 900px;
        margin: 0 auto;
        padding: 60px 20px;
        position: relative;
    }

    .timeline::before {
        background: linear-gradient(
            to bottom,
            rgba(184,136,42,0),
            rgba(184,136,42,.6),
            rgba(184,136,42,0)
        );
    }

    /* ===== 单条事件 ===== */
    .timeline-item {
        display: flex;
        margin-bottom: 50px;
        position: relative;
    }

    .timeline-date {
        width: 200px;
        text-align: right;
        padding-right: 20px;
        font-weight: bold;
        color: #b71c1c;
        font-size: 30px;
        line-height: 1.6;
    }

    .timeline-dot {
        width: 16px;
        height: 16px;
        background: #b8882a;
        border-radius: 50%;
        box-shadow:
            0 0 0 4px #f6f1e6,
            0 4px 10px rgba(0,0,0,.15);
        transition: transform .3s ease;
    }

    .timeline-content{
        flex: 1 1 auto;
        margin-left: auto;      /* 关键：贴右 */
        max-width: 520px;       /* 控制内容区域宽度 */
        background: rgba(255,255,255,.55);
        border-radius: 10px;
        padding: 22px 26px;
        box-shadow: 0 10px 24px rgba(0,0,0,.05);
        border-left: 4px solid #b8882a;
        transition: all .35s ease;
    }

    /* ===== 悬浮微交互 ===== */
    .timeline-item:hover .timeline-content {
        background: rgba(255,255,255,.85);
        transform: translateY(-3px);
        box-shadow: 0 16px 32px rgba(0,0,0,.08);
    }

    .timeline-item:hover .timeline-dot {
        transform: scale(1.15);
    }

    .timeline-content h3 {
        font-size: 22px;
        font-weight: 800;
        color: #7a1d1d;
        letter-spacing: .5px;
    }

    .timeline-content p {
        font-size: 16px;
        line-height: 1.9;
        color: rgba(0,0,0,.65);
    }

    /* 分隔线 */
    .timeline-item:not(:last-child) {
        border-bottom: 1px dashed #e71b1bff;
        padding-bottom: 30px;
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
</style>

<div class="page-header">
    <div class="container">
        <h1>历史时间轴</h1>
        <p class="hero-subtitle">十四年抗战全景记录。</p>
    </div>
</div>

<div class="container-fluid section p-0">
    <div class="timeline">

        <?php foreach ($events as $event): ?>
            <div class="timeline-item">
                <div class="timeline-date">
                    <?= Html::encode($event->formattedDate) ?>
                </div>

                <div class="timeline-dot"></div>

                <div class="timeline-content">
                    <h3><?= Html::encode($event->title) ?></h3>
                    <p><?= Html::encode($event->description) ?></p>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>