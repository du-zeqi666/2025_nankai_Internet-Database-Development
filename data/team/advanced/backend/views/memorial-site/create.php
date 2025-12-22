<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MemorialSite */

$this->title = '创建纪念场所';
$this->params['breadcrumbs'][] = ['label' => '纪念场所管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="memorial-site-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
