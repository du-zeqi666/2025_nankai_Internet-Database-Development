<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is create timeline
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Timeline */

$this->title = '创建时间线事件';
$this->params['breadcrumbs'][] = ['label' => '时间线管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timeline-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
