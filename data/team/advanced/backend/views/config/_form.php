<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is config form
*/

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">

    <?= $form->field($model, 'config_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'config_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'config_value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'config_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
