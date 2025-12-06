<?php
use yii\grid\GridView;
use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '小组列表';
?>
<div class="group-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('创建小组', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'description:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                // 默认就有 view / update / delete 三个按钮
            ],
        ],
    ]); ?>
</div>
