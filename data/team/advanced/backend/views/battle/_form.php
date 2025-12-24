<?php
/**
* Team：数据四骑士
* Coding by 巩岱松 2312325
* this is battle form
*/

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Battle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="battle-form box box-primary">
    <div class="box-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'start_date')->textInput() ?>

        <?= $form->field($model, 'end_date')->textInput() ?>

        <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'significance')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'detail_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'map_image')->textInput(['maxlength' => true]) ?>
        <?= Html::submitButton('保存', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
