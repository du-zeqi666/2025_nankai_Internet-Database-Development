<?php
/**
 * 🏛️ 抗战胜利80周年纪念网站 - 献花祭奠页面
 * Guestbook Page Template
 */

$this->title = '献花祭奠';
$this->params['bodyClass'] = 'guestbook-page';
?>

<div class="memorial-bg-wrapper">
    <div class="memorial-overlay"></div>
    <!-- 动画容器 -->
    <div class="memorial-animation-container"></div>
</div>

<div class="container position-relative z-index-1 py-5">
    <div class="row justify-content-center text-center mb-5">
        <div class="col-lg-8">
            <h1 class="display-4 text-white mb-3 text-shadow">缅怀先烈 寄托哀思</h1>
            <p class="lead text-white-50">向为国捐躯的英雄致以最崇高的敬意</p>
        </div>
    </div>

    <!-- 互动区域 -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-4 mb-4">
            <div class="action-card text-center p-4 bg-dark-glass rounded">
                <div class="icon-wrapper mb-3">
                    <i class="icon-flower text-gold display-3"></i>
                </div>
                <h3 class="text-white h4">献花致敬</h3>
                <p class="text-gold h2 mb-4" id="count-flower">0</p>
                <button id="btn-flower" class="btn btn-gold btn-lg btn-block">
                    <i class="icon-flower"></i> 我要献花
                </button>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="action-card text-center p-4 bg-dark-glass rounded">
                <div class="icon-wrapper mb-3">
                    <i class="icon-candle text-gold display-3"></i>
                </div>
                <h3 class="text-white h4">点灯祈福</h3>
                <p class="text-gold h2 mb-4" id="count-candle">0</p>
                <button id="btn-candle" class="btn btn-outline-gold btn-lg btn-block">
                    <i class="icon-candle"></i> 我要点灯
                </button>
            </div>
        </div>
    </div>

    <!-- 留言墙与表单 -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card bg-dark-glass border-0 text-white h-100">
                <div class="card-header border-bottom-0">
                    <h3 class="h5 mb-0"><i class="icon-comment"></i> 寄语墙</h3>
                </div>
                <div class="card-body p-0">
                    <div id="guestbook-wall" class="message-wall-container" style="height: 400px; overflow: hidden;">
                        <!-- 留言将在此滚动显示 -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card bg-white border-0 h-100">
                <div class="card-body">
                    <h3 class="h5 mb-4">写下您的寄语</h3>
                    <form id="message-form">
                        <div class="form-group">
                            <label for="nickname">您的称呼</label>
                            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="请输入昵称">
                        </div>
                        <div class="form-group">
                            <label for="content">寄语内容</label>
                            <textarea class="form-control" id="content" name="content" rows="5" placeholder="写下您对先烈的缅怀..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">提交寄语</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.guestbook-page {
    background-image: url('/assets/images/bg-memorial.jpg');
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    min-height: 100vh;
}
.memorial-bg-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    pointer-events: none;
}
.memorial-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
}
.bg-dark-glass {
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
}
.text-gold {
    color: #d4af37 !important;
}
.btn-gold {
    background-color: #d4af37;
    border-color: #d4af37;
    color: #000;
}
.btn-outline-gold {
    color: #d4af37;
    border-color: #d4af37;
}
.btn-outline-gold:hover {
    background-color: #d4af37;
    color: #000;
}
.floating-icon {
    position: absolute;
    bottom: 0;
    font-size: 2rem;
    pointer-events: none;
    z-index: 10;
}
.toast-message {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0,0,0,0.8);
    color: #fff;
    padding: 10px 20px;
    border-radius: 20px;
    z-index: 9999;
}
.toast-message.error {
    background: rgba(220, 53, 69, 0.9);
}
</style>
