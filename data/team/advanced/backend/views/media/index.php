<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is media list
*/

use common\models\Media;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '媒体文件管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="media-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('上传文件', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'filename',
                'filepath',
                'type',
                'size',
                //'updated_at:datetime',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, Media $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                     }
                ],
            ],
        ]); ?>
    </div>
</div>
