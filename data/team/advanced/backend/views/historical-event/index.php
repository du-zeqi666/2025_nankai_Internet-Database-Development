<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is historical-event list
*/

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HistoricalEventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '历史事件管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historical-event-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('新增历史事件', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'title',
                'event_date',
                'location',
                'importance_level',
                //'description:ntext',
                //'cover_image',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
