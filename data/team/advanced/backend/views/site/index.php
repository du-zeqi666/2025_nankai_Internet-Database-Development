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
                    <h3 class="box-title">留言趋势</h3>
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
                                <div class="product-info" style="margin-left: 0;">
                                    <a href="<?= Url::to(['hero/view', 'id' => $hero->id]) ?>" class="product-title"><?= Html::encode($hero->name) ?>
                                        <span class="label label-warning pull-right">英雄</span></a>
                                    <span class="product-description">
                                      <?= Html::encode(mb_substr(strip_tags($hero->introduction), 0, 50)) ?>...
                                    </span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php foreach ($recentBattles as $battle): ?>
                            <li class="item">
                                <div class="product-info" style="margin-left: 0;">
                                    <a href="<?= Url::to(['battle/view', 'id' => $battle->id]) ?>" class="product-title"><?= Html::encode($battle->name) ?>
                                        <span class="label label-danger pull-right">战役</span></a>
                                    <span class="product-description">
                                      <?= Html::encode(mb_substr(strip_tags($battle->description), 0, 50)) ?>...
                                    </span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="box-footer text-center">
                    <a href="<?= Url::to(['/hero/index']) ?>" class="uppercase">查看所有英雄</a>
                    <span style="margin: 0 10px;">|</span>
                    <a href="<?= Url::to(['/battle/index']) ?>" class="uppercase">查看所有战役</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Register JS for ECharts
$activityJson = json_encode($activityData);
$contentJson = json_encode($contentData);

$js = <<<JS
    // Initialize Visit Chart
    var visitChart = echarts.init(document.getElementById('visitChart'));
    var activityData = $activityJson;
    var dates = activityData.map(function(item) { return item.date; });
    var counts = activityData.map(function(item) { return item.count; });

    var visitOption = {
        tooltip: {
            trigger: 'axis'
        },
        xAxis: {
            type: 'category',
            data: dates
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: counts,
            type: 'line',
            smooth: true,
            itemStyle: {
                color: '#dd4b39'
            },
            areaStyle: {
                color: 'rgba(221, 75, 57, 0.2)'
            }
        }]
    };
    visitChart.setOption(visitOption);

    // Initialize Content Pie Chart
    var contentChart = echarts.init(document.getElementById('contentPieChart'));
    var contentData = $contentJson;
    
    var contentOption = {
        tooltip: {
            trigger: 'item'
        },
        legend: {
            top: '5%',
            left: 'center'
        },
        series: [
            {
                name: '内容统计',
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
                data: contentData.map(function(item) {
                    return { value: item.value, name: item.label };
                })
            }
        ]
    };
    contentChart.setOption(contentOption);

    // Resize charts on window resize
    window.addEventListener('resize', function() {
        visitChart.resize();
        contentChart.resize();
    });
JS;

$this->registerJs($js);
?>