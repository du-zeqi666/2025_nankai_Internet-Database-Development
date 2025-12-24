<?php
/**
* Team：数据四骑士,NKU
* Coding by 杜泽琦 2313508
* this is signup
*/

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .signup-card {
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-top: 20px;
    }
    .signup-header {
        margin-bottom: 30px;
    }
    .signup-header h1 {
        font-size: 2rem;
        color: #333;
        margin-bottom: 10px;
    }
    .signup-header p {
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

<div class="site-signup">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
            <div class="signup-card">
                <div class="signup-header text-center">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <p>创建您的账号，加入我们</p>
                </div>

                <?php $form = ActiveForm::begin(['id' => 'form-signup', 'validateOnBlur' => false]); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => '请输入用户名'])->label('用户名') ?>

                    <?= $form->field($model, 'email')->textInput(['placeholder' => '请输入邮箱地址'])->label('邮箱') ?>

                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => '请输入密码'])->label('密码') ?>

                    <div class="form-group" style="margin-top: 30px;">
                        <?= Html::submitButton('立即注册', ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>
                    </div>

                    <div style="color:#999;margin-top:20px;text-align:center;font-size:0.9rem;">
                        已有账号？ <?= Html::a('直接登录', ['site/login'], ['style' => 'color:#d9534f;font-weight:bold;']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
