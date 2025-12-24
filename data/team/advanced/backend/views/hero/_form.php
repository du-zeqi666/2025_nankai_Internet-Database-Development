<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is hero form
*/

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Hero */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hero-form box box-primary">
    <div class="box-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'birth_year')->textInput() ?>

        <?= $form->field($model, 'death_year')->textInput() ?>

        <?= $form->field($model, 'birth_place')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'introduction')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
