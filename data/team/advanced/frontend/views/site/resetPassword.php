<?php
/**
* Team：数据四骑士,NKU
* Coding by 杜泽琦 2313508
* this is reset password
*/

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '重置密码';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p class="text-center">请输入您的新密码：</p>

    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label('新密码') ?>

                <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-primary btn-block']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
