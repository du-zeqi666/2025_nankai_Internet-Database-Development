<?php

use common\models\Group;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户组管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('创建用户组', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'description',
                //'created_at:datetime',
                //'updated_at:datetime',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, Group $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                     }
                ],
            ],
        ]); ?>
    </div>
</div>
