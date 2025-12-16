<?php
/* @var $this yii\web\View */

$this->title = '抗战历史长卷 - 3D 时间轴';
?>
<div class="site-timeline">
    <div id="timeline-3d-container" style="width: 100%; height: 100vh; position: fixed; top: 0; left: 0; z-index: 0;"></div>
    
    <div class="timeline-ui-overlay" style="position: relative; z-index: 10; pointer-events: none;">
        <div class="container">
            <h1 class="text-gold mt-5" style="text-shadow: 0 2px 4px rgba(0,0,0,0.8);">历史长河</h1>
            <p class="text-white">滚动探索 1931-1945 的峥嵘岁月</p>
        </div>
    </div>
</div>

<script>
    // Will be initialized by Webpack bundle
    window.timelineData = [
        // Mock data for initialization
        { date: '1931-09-18', title: '九一八事变', description: '日本关东军炸毁南满铁路柳条湖段，反诬中国军队所为，炮轰北大营。' },
        { date: '1937-07-07', title: '七七事变', description: '日军在卢沟桥附近演习，借口一名士兵失踪，炮轰宛平城。' },
        // ... more data
    ];
</script>
