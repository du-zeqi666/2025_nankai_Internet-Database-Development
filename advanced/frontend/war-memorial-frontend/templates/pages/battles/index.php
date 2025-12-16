<?php
/**
 * Battles List Template
 * @var $this yii\web\View
 */

use yii\helpers\Url;

$this->title = '战役史诗';
$this->params['bodyClass'] = 'page-battles';
?>

<div class="page-header">
    <div class="container">
        <h1>战役史诗</h1>
        <p>重温那些惊天地、泣鬼神的伟大战役，见证中华民族不屈的脊梁。</p>
    </div>
</div>

<div class="section">
    <div class="container">
        <!-- View Toggle -->
        <div class="view-toggle">
            <button class="btn-toggle active" data-view="list">列表视图</button>
            <button class="btn-toggle" data-view="map">地图视图</button>
        </div>

        <!-- List View -->
        <div class="battles-list" id="battles-list-view">
            <!-- Battle Item 1 -->
            <article class="battle-item fade-in-up">
                <img src="<?= Url::to('@web/assets/images/battles/pingxingguan.jpg') ?>" alt="平型关大捷" class="battle-image" loading="lazy">
                <div class="battle-content">
                    <div class="battle-meta">
                        <span class="date">1937年9月</span>
                        <span class="location">山西省灵丘县</span>
                    </div>
                    <h3>平型关大捷</h3>
                    <p>八路军115师在平型关伏击日军精锐板垣师团，歼敌1000余人，打破了日军不可战胜的神话，极大地鼓舞了全国军民的抗战信心。</p>
                    <a href="<?= Url::to(['/battles/view', 'id' => 1]) ?>" class="btn btn-outline-primary btn-sm align-self-start">查看详情</a>
                </div>
            </article>

            <!-- Battle Item 2 -->
            <article class="battle-item fade-in-up">
                <img src="<?= Url::to('@web/assets/images/battles/taierzhuang.jpg') ?>" alt="台儿庄大捷" class="battle-image" loading="lazy">
                <div class="battle-content">
                    <div class="battle-meta">
                        <span class="date">1938年3月</span>
                        <span class="location">山东省枣庄市</span>
                    </div>
                    <h3>台儿庄大捷</h3>
                    <p>中国军队在台儿庄地区重创日军两个精锐师团，歼敌1万余人，取得了抗战以来正面战场的最大胜利。</p>
                    <a href="<?= Url::to(['/battles/view', 'id' => 2]) ?>" class="btn btn-outline-primary btn-sm align-self-start">查看详情</a>
                </div>
            </article>

            <!-- Battle Item 3 -->
            <article class="battle-item fade-in-up">
                <img src="<?= Url::to('@web/assets/images/battles/baituan.jpg') ?>" alt="百团大战" class="battle-image" loading="lazy">
                <div class="battle-content">
                    <div class="battle-meta">
                        <span class="date">1940年8月</span>
                        <span class="location">华北地区</span>
                    </div>
                    <h3>百团大战</h3>
                    <p>八路军在华北敌后发动的一次大规模进攻和反“扫荡”的战役，参战兵力达105个团，重击了日军的囚笼政策。</p>
                    <a href="<?= Url::to(['/battles/view', 'id' => 3]) ?>" class="btn btn-outline-primary btn-sm align-self-start">查看详情</a>
                </div>
            </article>
        </div>

        <!-- Map View -->
        <div class="battles-map-container" id="battles-map-view">
            <div id="battles-map" style="width: 100%; height: 100%;"></div>
        </div>
    </div>
</div>

