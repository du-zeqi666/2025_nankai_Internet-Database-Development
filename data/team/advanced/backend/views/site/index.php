<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = '仪表盘 - 抗战胜利80周年纪念网站';
?>
<div class="site-index">

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-memorial-red">
                <div class="inner">
                    <h3><?= $heroCount ?></h3>
                    <p>抗战英雄</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-plus"></i>
                </div>
                <a href="<?= Url::to(['/hero/index']) ?>" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-memorial-gold">
                <div class="inner">
                    <h3><?= $battleCount ?></h3>
                    <p>重大战役</p>
                </div>
                <div class="icon">
                    <i class="fa fa-fire"></i>
                </div>
                <a href="<?= Url::to(['/battle/index']) ?>" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-memorial-dark">
                <div class="inner">
                    <h3><?= $articleCount ?></h3>
                    <p>纪念文章</p>
                </div>
                <div class="icon">
                    <i class="fa fa-file-text"></i>
                </div>
                <a href="<?= Url::to(['/article/index']) ?>" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-memorial-green">
                <div class="inner">
                    <h3><?= $guestbookCount ?></h3>
                    <p>访客留言</p>
                </div>
                <div class="icon">
                    <i class="fa fa-comments"></i>
                </div>
                <a href="<?= Url::to(['/guestbook/index']) ?>" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-md-8">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">访问趋势 (模拟数据)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="visitChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">内容分布</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="contentPieChart" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline & Latest -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">最新动态</h3>
                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <?php foreach ($recentHeroes as $hero): ?>
                        <li class="item">
                            <div class="product-img">
                                <img src="<?= Yii::$app->request->baseUrl ?>/images/default-hero.png" alt="Hero Image">
                            </div>
                            <div class="product-info">
                                <a href="<?= Url::to(['/hero/view', 'id' => $hero->id]) ?>" class="product-title">
                                    新增英雄：<?= Html::encode($hero->name) ?>
                                    <span class="label label-danger pull-right">英雄</span>
                                </a>
                                <span class="product-description">
                                    <?= Html::encode(mb_substr($hero->introduction, 0, 40)) ?>...
                                </span>
                            </div>
                        </li>
                        <?php endforeach; ?>
                        
                        <?php foreach ($recentBattles as $battle): ?>
                        <li class="item">
                            <div class="product-img">
                                <img src="<?= Yii::$app->request->baseUrl ?>/images/default-battle.png" alt="Battle Image">
                            </div>
                            <div class="product-info">
                                <a href="<?= Url::to(['/battle/view', 'id' => $battle->id]) ?>" class="product-title">
                                    更新战役：<?= Html::encode($battle->name) ?>
                                    <span class="label label-warning pull-right">战役</span>
                                </a>
                                <span class="product-description">
                                    <?= Html::encode(mb_substr($battle->description, 0, 40)) ?>...
                                </span>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="box-footer text-center">
                    <a href="<?= Url::to(['/timeline/index']) ?>" class="uppercase">查看所有动态</a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
$contentDataJson = json_encode(array_map(function($item) {
    return ['value' => $item['value'], 'name' => $item['label']];
}, $contentData));

$activityDates = json_encode(array_column($activityData, 'date'));
$activityCounts = json_encode(array_column($activityData, 'count'));

$script = <<< JS
    // Visit Chart (Guestbook Activity)
    var visitChart = echarts.init(document.getElementById('visitChart'));
    var visitOption = {
        title: {
            text: '近7日留言趋势',
            left: 'center'
        },
        tooltip: {
            trigger: 'axis'
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: $activityDates
        },
        yAxis: {
            type: 'value',
            minInterval: 1
        },
        series: [
            {
                name: '留言数',
                type: 'line',
                stack: 'Total',
                data: $activityCounts,
                itemStyle: {
                    color: '#C41E3A'
                },
                areaStyle: {
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                        { offset: 0, color: 'rgba(196, 30, 58, 0.5)' },
                        { offset: 1, color: 'rgba(196, 30, 58, 0.1)' }
                    ])
                }
            }
        ]
    };
    visitChart.setOption(visitOption);

    // Content Pie Chart
    var contentPieChart = echarts.init(document.getElementById('contentPieChart'));
    var pieOption = {
        title: {
            text: '系统内容统计',
            left: 'center'
        },
        tooltip: {
            trigger: 'item'
        },
        legend: {
            top: '10%',
            left: 'center'
        },
        series: [
            {
                name: '内容分布',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 10,
                    borderColor: '#fff',
                    borderWidth: 2
                },
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: '20',
                        fontWeight: 'bold'
                    }
                },
                labelLine: {
                    show: false
                },
                data: $contentDataJson
            }
        ]
    };
    contentPieChart.setOption(pieOption);

    // Resize charts on window resize
    window.addEventListener('resize', function() {
        visitChart.resize();
        contentPieChart.resize();
    });
JS;
$this->registerJs($script);
?>
