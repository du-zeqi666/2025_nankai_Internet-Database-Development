<?php
/**
 * User Profile Template
 * @var $this yii\web\View
 */

$this->title = '个人中心';
$this->params['bodyClass'] = 'page-user-profile';
?>

<div class="container section-padding">
    <div class="profile-layout">
        <!-- Sidebar -->
        <aside class="profile-sidebar">
            <div class="user-card">
                <div class="user-avatar">
                    <img src="/assets/images/default-avatar.png" alt="User Avatar" id="user-avatar-img">
                </div>
                <h3 class="user-name" id="profile-username">加载中...</h3>
                <p class="user-email" id="profile-email">...</p>
            </div>
            
            <nav class="profile-nav">
                <a href="#info" class="active" data-tab="info">基本资料</a>
                <a href="#memorials" data-tab="memorials">我的祭奠</a>
                <a href="#messages" data-tab="messages">我的留言</a>
                <a href="#" id="logout-btn" class="text-danger">退出登录</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="profile-content">
            <!-- Info Tab -->
            <div id="tab-info" class="profile-tab active">
                <div class="section-header">
                    <h2>基本资料</h2>
                </div>
                <form id="profile-form" class="form">
                    <div class="form-group">
                        <label>用户名</label>
                        <input type="text" id="edit-username" name="username" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>电子邮箱</label>
                        <input type="email" id="edit-email" name="email" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>注册时间</label>
                        <input type="text" id="join-date" class="form-control" readonly>
                    </div>
                </form>
            </div>

            <!-- Memorials Tab -->
            <div id="tab-memorials" class="profile-tab">
                <div class="section-header">
                    <h2>我的祭奠</h2>
                </div>
                <div class="memorial-list" id="memorial-list">
                    <!-- Loaded via JS -->
                    <div class="empty-state">暂无祭奠记录</div>
                </div>
            </div>

            <!-- Messages Tab -->
            <div id="tab-messages" class="profile-tab">
                <div class="section-header">
                    <h2>我的留言</h2>
                </div>
                <div class="message-list" id="message-list">
                    <!-- Loaded via JS -->
                    <div class="empty-state">暂无留言记录</div>
                </div>
            </div>
        </main>
    </div>
</div>
