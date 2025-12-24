<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is historical-relic list
*/

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HistoricalRelicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '历史文物管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historical-relic-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('新增历史文物', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'category',
                'era',
                'current_location',
                //'description:ntext',
                //'image',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
