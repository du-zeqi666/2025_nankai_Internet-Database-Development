<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is create guestbook
*/

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
