<?php
/**
 * Register Template
 * @var $this yii\web\View
 */

$this->title = '用户注册';
$this->params['bodyClass'] = 'page-user-auth';
?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>用户注册</h2>
            <p>加入我们，共同传承红色基因</p>
        </div>
        
        <form id="register-form" class="form">
            <div class="form-group">
                <label for="username">用户名</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="email">邮箱</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="confirm-password">确认密码</label>
                <input type="password" id="confirm-password" name="confirm-password" class="form-control" required>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-block">注册</button>
            </div>
            
            <div class="auth-footer">
                <p>已有账号？ <a href="/user/login">立即登录</a></p>
            </div>
        </form>
    </div>
</div>
