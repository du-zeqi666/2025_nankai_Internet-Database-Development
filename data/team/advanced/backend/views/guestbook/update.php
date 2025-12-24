<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is update guestbook
*/

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Guestbook */

$this->title = '更新留言: ' . $model->visitor_name;
$this->params['breadcrumbs'][] = ['label' => '留言板管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->visitor_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="guestbook-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
