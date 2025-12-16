<?php
/**
 * Login Template
 * @var $this yii\web\View
 */

$this->title = '用户登录';
$this->params['bodyClass'] = 'page-user-auth';
?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>用户登录</h2>
            <p>欢迎回到抗战纪念网</p>
        </div>
        
        <form id="login-form" class="form">
            <div class="form-group">
                <label for="username">用户名/邮箱</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-block">登录</button>
            </div>
            
            <div class="auth-footer">
                <p>还没有账号？ <a href="/user/register">立即注册</a></p>
            </div>
        </form>
    </div>
</div>
