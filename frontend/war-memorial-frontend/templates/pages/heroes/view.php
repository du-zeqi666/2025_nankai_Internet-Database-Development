<?php
/**
 * Hero Detail Template
 * @var $this yii\web\View
 */

use yii\helpers\Url;

$this->title = '杨靖宇 - 英雄谱';
$this->params['bodyClass'] = 'page-hero-detail';
?>

<div class="hero-profile">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5">
                <img src="<?= Url::to('@web/assets/images/heroes/yang-jingyu-large.jpg') ?>" alt="杨靖宇" class="profile-image">
            </div>
            <div class="col-md-7">
                <div class="profile-info">
                    <h1>杨靖宇</h1>
                    <div class="hero-title">东北抗日联军第一路军总司令兼政治委员</div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <label>籍贯</label>
                            <span>河南省确山县</span>
                        </div>
                        <div class="info-item">
                            <label>生卒年</label>
                            <span>1905 - 1940</span>
                        </div>
                        <div class="info-item">
                            <label>牺牲地点</label>
                            <span>吉林省濛江县</span>
                        </div>
                        <div class="info-item">
                            <label>荣誉</label>
                            <span>100位为新中国成立作出突出贡献的英雄模范人物</span>
                        </div>
                    </div>
                    
                    <blockquote class="blockquote">
                        "头颅可断腹可剖，烈忾难消志不磨，碧血青蒿两千古，于今赤旗满山河。"
                        <footer>杨靖宇 诗作</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hero-biography">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="section-header">
                    <h2>生平事迹</h2>
                </div>
                <div class="bio-content">
                    <p>杨靖宇（1905年2月13日－1940年2月23日），原名马尚德，字骥生，汉族，河南省确山县人，中国共产党优秀党员，无产阶级革命家、军事家、著名抗日民族英雄，鄂豫皖苏区及其红军的创始人之一，东北抗日联军的主要创建者和领导人之一。</p>
                    <p>1932年，受党中央委托到东北组织抗日联军，历任抗日联军总指挥政委等职。率领东北军民与日寇血战于白山黑水之间，冰天雪地，弹尽粮绝，孤身一人与大量日寇周旋战斗几昼夜后壮烈牺牲。</p>
                    <p>杨靖宇牺牲后，日军解剖了他的尸体，发现胃里只有树皮、草根和棉絮，没有一粒粮食。在场的日军无不为之震惊。</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hero-timeline">
    <div class="container">
        <div class="section-header">
            <h2>革命历程</h2>
        </div>
        <div class="timeline-container">
            <!-- Timeline Component will be used here -->
            <div class="timeline-item">
                <div class="timeline-date">1905年</div>
                <div class="timeline-content">
                    <h3>出生</h3>
                    <p>出生于河南省确山县李湾村。</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-date">1927年</div>
                <div class="timeline-content">
                    <h3>加入中国共产党</h3>
                    <p>确山农民暴动领导人之一。</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-date">1940年</div>
                <div class="timeline-content">
                    <h3>壮烈牺牲</h3>
                    <p>在吉林濛江三道崴子与日军激战中牺牲。</p>
                </div>
            </div>
        </div>
    </div>
</div>

