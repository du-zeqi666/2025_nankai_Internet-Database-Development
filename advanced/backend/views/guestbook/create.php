<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Guestbook */

$this->title = '创建留言';
$this->params['breadcrumbs'][] = ['label' => '留言板管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guestbook-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
