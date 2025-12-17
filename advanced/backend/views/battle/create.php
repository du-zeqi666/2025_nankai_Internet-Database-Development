<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Battle */

$this->title = '新增战役';
$this->params['breadcrumbs'][] = ['label' => '战役管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="battle-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
