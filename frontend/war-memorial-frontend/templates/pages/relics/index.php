<?php
/**
 * Relics List Template
 * @var $this yii\web\View
 */

use yii\helpers\Url;

$this->title = '文物史料';
$this->params['bodyClass'] = 'page-relics';
?>

<div class="page-header">
    <div class="container">
        <h1>文物史料</h1>
        <p>每一件文物都是历史的见证，诉说着那段烽火连天的岁月。</p>
    </div>
</div>

<div class="section">
    <div class="container">
        <!-- Filter Categories -->
        <div class="filter-bar">
            <button class="btn-filter active" data-filter="all">全部</button>
            <button class="btn-filter" data-filter="weapon">武器装备</button>
            <button class="btn-filter" data-filter="document">文献资料</button>
            <button class="btn-filter" data-filter="daily">生活用品</button>
        </div>

        <!-- Relics Grid -->
        <div class="relics-grid">
            <!-- Relic Item 1 -->
            <div class="relic-card" data-category="weapon">
                <div class="relic-image-wrapper">
                    <img src="<?= Url::to('@web/assets/images/relics/gun.jpg') ?>" alt="三八式步枪" class="relic-image" loading="lazy">
                    <div class="relic-overlay">
                        <button class="btn btn-sm btn-primary btn-3d-view" data-model="gun-3d">3D预览</button>
                    </div>
                </div>
                <div class="relic-info">
                    <h3>缴获的三八式步枪</h3>
                    <p class="category">武器装备</p>
                    <p class="desc">平型关大捷中缴获的日军武器，看见了八路军的英勇战绩。</p>
                </div>
            </div>

            <!-- Relic Item 2 -->
            <div class="relic-card" data-category="document">
                <div class="relic-image-wrapper">
                    <img src="<?= Url::to('@web/assets/images/relics/diary.jpg') ?>" alt="战地日记" class="relic-image" loading="lazy">
                </div>
                <div class="relic-info">
                    <h3>抗战老兵日记</h3>
                    <p class="category">文献资料</p>
                    <p class="desc">记录了1940年百团大战期间的战斗细节，具有极高的史料价值。</p>
                </div>
            </div>

            <!-- Relic Item 3 -->
            <div class="relic-card" data-category="daily">
                <div class="relic-image-wrapper">
                    <img src="<?= Url::to('@web/assets/images/relics/uniform.jpg') ?>" alt="八路军军服" class="relic-image" loading="lazy">
                </div>
                <div class="relic-info">
                    <h3>打补丁的军服</h3>
                    <p class="category">生活用品</p>
                    <p class="desc">这件布满补丁的军服，体现了抗战时期物资匮乏但精神富足的艰苦岁月。</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 3D Viewer Modal (Placeholder) -->
<div id="viewer-3d-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="viewer-3d-container"></div>
    </div>
</div>

