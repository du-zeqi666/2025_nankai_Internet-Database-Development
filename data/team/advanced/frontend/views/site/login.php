<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .login-card {
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-top: 20px;
    }
    .login-header {
        margin-bottom: 30px;
    }
    .login-header h1 {
        font-size: 2rem;
        color: #333;
        margin-bottom: 10px;
    }
    .login-header p {
        color: #777;
    }
    .form-control {
        height: 45px;
        border-radius: 5px;
    }
    .btn-primary {
        background-color: #d9534f;
        border-color: #d9534f;
        padding: 10px 20px;
        font-size: 1.1rem;
        transition: all 0.3s;
    }
    .btn-primary:hover {
        background-color: #c9302c;
        border-color: #c9302c;
        transform: translateY(-2px);
    }
</style>

<div class="site-login">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <div class="login-card">
                <div class="login-header text-center">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <p>欢迎回来，请登录您的账号</p>
                </div>

                <?php $form = ActiveForm::begin(['id' => 'login-form', 'validateOnBlur' => false]); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => '请输入用户名'])->label('用户名') ?>

                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => '请输入密码'])->label('密码') ?>

                    <?= $form->field($model, 'rememberMe')->checkbox()->label('记住我') ?>

                    <div class="form-group" style="margin-top: 30px;">
                        <?= Html::submitButton('立即登录', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                    </div>

                    <div style="text-align: center; margin-top: 15px;">
                        <a href="/advanced/backend/web/index.php?r=site/login" style="color: #999;">后台管理登录</a>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
