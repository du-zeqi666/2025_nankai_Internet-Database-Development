<?php
use yii\helpers\Url;

$this->title = '历史时间轴 - 抗战胜利80周年纪念网站';
$this->params['bodyClass'] = 'page-timeline';
?>

<div class="page-header">
    <div class="container">
        <h1 class="page-title">历史时间轴</h1>
        <p class="page-desc">十四年抗战全景记录</p>
    </div>
</div>

<div class="container-fluid section p-0">
    <div class="timeline-container" id="main-timeline">
        <div class="timeline-line"></div>
        <div class="timeline-progress"></div>
        
        <!-- Timeline Items (Will be populated by JS or PHP loop) -->
        <?php 
        $years = range(1931, 1945);
        foreach($years as $year): 
        ?>
        <div class="timeline-item" data-year="<?= $year ?>">
            <div class="timeline-marker"></div>
            <div class="timeline-date"><?= $year ?></div>
            <div class="timeline-content">
                <h3><?= $year ?>年大事记</h3>
                <p>此处显示<?= $year ?>年的重要历史事件...</p>
                <img src="<?= Url::to("@web/assets/images/timeline/{$year}.jpg") ?>" alt="<?= $year ?>" loading="lazy">
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

