<?php
/**
 * Memorial Sites List Template
 * @var $this yii\web\View
 */

use yii\helpers\Url;

$this->title = '纪念场馆';
$this->params['bodyClass'] = 'page-sites';
?>

<div class="page-header">
    <div class="container">
        <h1>纪念场馆</h1>
        <p>踏寻红色足迹，缅怀革命先烈，传承红色基因。</p>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="sites-list">
            <!-- Site Item 1 -->
            <article class="site-item">
                <div class="site-image">
                    <img src="<?= Url::to('@web/assets/images/sites/nanjing.jpg') ?>" alt="侵华日军南京大屠杀遇难同胞纪念馆" loading="lazy">
                </div>
                <div class="site-content">
                    <h2>侵华日军南京大屠杀遇难同胞纪念馆</h2>
                    <p class="location"><i class="icon-location"></i> 江苏省南京市建邺区水西门大街418号</p>
                    <p class="desc">建立在南京大屠杀江东门集体屠杀地及“万人坑”遗址之上，是国际公认的二战期间三大惨案纪念馆之一。</p>
                    <div class="site-actions">
                        <a href="<?= Url::to(['/sites/view', 'id' => 1]) ?>" class="btn btn-primary">参观指南</a>
                        <a href="<?= Url::to(['/sites/vr', 'id' => 1]) ?>" class="btn btn-outline-primary">VR全景</a>
                    </div>
                </div>
            </article>

            <!-- Site Item 2 -->
            <article class="site-item reverse">
                <div class="site-image">
                    <img src="<?= Url::to('@web/assets/images/sites/shenyang.jpg') ?>" alt="“九·一八”历史博物馆" loading="lazy">
                </div>
                <div class="site-content">
                    <h2>“九·一八”历史博物馆</h2>
                    <p class="location"><i class="icon-location"></i> 辽宁省沈阳市大东区望花南街46号</p>
                    <p class="desc">通过大量文物、史料、照片，真实记录了日本帝国主义发动“九·一八”事变、奴役中国人民的罪行。</p>
                    <div class="site-actions">
                        <a href="<?= Url::to(['/sites/view', 'id' => 2]) ?>" class="btn btn-primary">参观指南</a>
                        <a href="<?= Url::to(['/sites/vr', 'id' => 2]) ?>" class="btn btn-outline-primary">VR全景</a>
                    </div>
                </div>
            </article>

            <!-- Site Item 3 -->
            <article class="site-item">
                <div class="site-image">
                    <img src="<?= Url::to('@web/assets/images/sites/lugouqiao.jpg') ?>" alt="中国人民抗日战争纪念馆" loading="lazy">
                </div>
                <div class="site-content">
                    <h2>中国人民抗日战争纪念馆</h2>
                    <p class="location"><i class="icon-location"></i> 北京市丰台区卢沟桥宛平城内街101号</p>
                    <p class="desc">全国唯一一座全面反映中国人民抗日战争历史的大型综合性专题纪念馆。</p>
                    <div class="site-actions">
                        <a href="<?= Url::to(['/sites/view', 'id' => 3]) ?>" class="btn btn-primary">参观指南</a>
                        <a href="<?= Url::to(['/sites/vr', 'id' => 3]) ?>" class="btn btn-outline-primary">VR全景</a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>

