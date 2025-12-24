<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is update memorial-site
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MemorialSite */

$this->title = '更新纪念场所: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '纪念场所管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="memorial-site-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
