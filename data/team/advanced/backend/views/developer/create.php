<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is create developer
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Developer */

$this->title = 'Create Developer';
$this->params['breadcrumbs'][] = ['label' => 'Developers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="developer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
