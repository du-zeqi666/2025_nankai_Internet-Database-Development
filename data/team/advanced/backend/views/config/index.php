<?php

use common\models\Config;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '系统配置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('创建配置', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'config_name',
                'config_key',
                'config_value:ntext',
                'config_group',
                'sort_order',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, Config $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                     }
                ],
            ],
        ]); ?>
    </div>
</div>
