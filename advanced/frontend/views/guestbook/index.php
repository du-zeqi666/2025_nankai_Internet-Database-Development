<?php
/**
 * Guestbook Template
 * @var $this yii\web\View
 */

$this->title = '留言寄语';
$this->params['bodyClass'] = 'page-guestbook';
?>

<div class="page-header">
    <div class="container">
        <h1>留言寄语</h1>
        <p>铭记历史，珍爱和平。请留下您的感言，为和平祈愿。</p>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="guestbook-layout">
            <!-- Form Section -->
            <div class="guestbook-form-wrapper">
                <div class="card">
                    <h3>我要留言</h3>
                    <form id="guestbook-form" class="form">
                        <div class="form-group">
                            <label for="name">姓名</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message">寄语</label>
                            <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>献礼</label>
                            <div class="gift-options">
                                <label class="gift-option">
                                    <input type="radio" name="gift" value="flower" checked>
                                    <span class="gift-icon">💐</span> 鲜花
                                </label>
                                <label class="gift-option">
                                    <input type="radio" name="gift" value="candle">
                                    <span class="gift-icon">🕯️</span> 蜡烛
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">提交留言</button>
                    </form>
                </div>
            </div>

            <!-- Messages List -->
            <div class="guestbook-list">
                <!-- Message 1 -->
                <div class="message-card">
                    <div class="message-header">
                        <span class="author">张三</span>
                        <span class="date">2023-10-01</span>
                    </div>
                    <div class="message-body">
                        <p>勿忘国耻，振兴中华！向抗战英雄致敬！</p>
                    </div>
                    <div class="message-footer">
                        <span class="gift">💐 已献花</span>
                    </div>
                </div>

                <!-- Message 2 -->
                <div class="message-card">
                    <div class="message-header">
                        <span class="author">李四</span>
                        <span class="date">2023-09-30</span>
                    </div>
                    <div class="message-body">
                        <p>和平来之不易，我们要倍加珍惜。</p>
                    </div>
                    <div class="message-footer">
                        <span class="gift">🕯️ 已点烛</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
