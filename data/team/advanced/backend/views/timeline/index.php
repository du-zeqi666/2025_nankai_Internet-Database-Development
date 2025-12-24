<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is timeline list
*/

use common\models\Timeline;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '时间线管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timeline-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('创建时间线事件', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'title',
                'date',
                //'created_at:datetime',
                //'updated_at:datetime',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, Timeline $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                     }
                ],
            ],
        ]); ?>
    </div>
</div>
