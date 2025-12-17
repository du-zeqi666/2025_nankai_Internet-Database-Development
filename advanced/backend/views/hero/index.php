<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HeroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '英雄管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hero-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('新增英雄', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'birth_year',
                'death_year',
                'birth_place',
                //'description:ntext',
                //'photo',
                //'status',
                //'created_at',
                //'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
