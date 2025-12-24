<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is battle list
*/

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BattleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '战役管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="battle-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('新增战役', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
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
                'start_date',
                'end_date',
                'location',
                'result',
                //'description:ntext',
                //'significance:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
