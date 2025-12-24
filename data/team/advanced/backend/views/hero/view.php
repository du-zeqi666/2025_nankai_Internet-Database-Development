<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is view hero
*/

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Hero */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '英雄管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hero-view box box-primary">
    <div class="box-header">
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => '确定要删除这项吗？',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'birth_year',
                'death_year',
                'birth_place',
                'introduction:ntext',
            ],
        ]) ?>
    </div>
</div>
