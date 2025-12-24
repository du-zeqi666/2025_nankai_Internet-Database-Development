<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is update developer
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Developer */

$this->title = 'Update Developer: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Developers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="developer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
