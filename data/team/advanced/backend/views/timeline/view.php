<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is view timeline
*/

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Timeline */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '时间线管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="timeline-view box box-primary">
    <div class="box-header with-border">
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'title',
                'description:ntext',
                'date',
                'image:url',
                'related_battle_id',
                'related_hero_id',
            ],
        ]) ?>
    </div>
</div>
