<?php
/**
* Team：数据四骑士,NKU
* Coding by 杜泽琦 2313508
* this is guestbook
*/
/*
 * Guestbook Template
 * @var $this yii\web\View
 * @var $model common\models\Guestbook
 * @var $dataProvider yii\data\ActiveDataProvider
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

$this->title = '留言寄语';
$this->params['bodyClass'] = 'page-guestbook';
?>

<style>
    /* 新增：拉开标题文字和下面装饰的距离 */
    .page-header p {
        margin-bottom: 40px;
    }

    /* 统一的副标题样式 */
    .hero-subtitle {
        font-size: 18px;
        letter-spacing: 3px;
        color: rgba(0,0,0,.60);
        font-weight: 500;
        margin-top: 0.5rem;
    }
    
    .summary {
        margin-bottom: 1rem;
        color: #666;
    }
    
    .pagination {
        justify-content: center;
    }
    
    /* 强制覆盖按钮颜色为红色 */
    .btn-primary {
        background-color: #d9534f;
        border-color: #d9534f;
        transition: all 0.3s;
    }
    .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
        background-color: #c9302c !important;
        border-color: #c9302c !important;
    }
</style>

<div class="page-header">
    <div class="container">
        <h1>留言寄语</h1>
        <p class="hero-subtitle">铭记历史，珍爱和平。请留下您的感言，为和平祈愿。</p>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="guestbook-layout">
            <!-- Form Section -->
            <div class="guestbook-form-wrapper">
                <div class="card">
                    <h3>我要留言</h3>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <div class="alert alert-warning">
                            请 <?= Html::a('登录', ['site/login']) ?> 后发表留言。
                        </div>
                    <?php else: ?>
                        <?php $form = ActiveForm::begin(['id' => 'guestbook-form']); ?>
                            
                            <div class="form-group">
                                <label>姓名</label>
                                <input type="text" class="form-control" value="<?= Html::encode(Yii::$app->user->identity->username) ?>" disabled>
                                <small class="text-muted">以当前登录用户身份留言</small>
                            </div>

                            <?= $form->field($model, 'content')->textarea(['rows' => 5, 'placeholder' => '请输入您的寄语...'])->label('寄语') ?>

                            <div class="form-group">
                                <label>献礼</label>
                                <div class="gift-options">
                                    <label class="gift-option">
                                        <input type="radio" name="Guestbook[gift]" value="flower" checked>
                                        <span class="gift-icon">💐</span> 鲜花
                                    </label>
                                    <label class="gift-option">
                                        <input type="radio" name="Guestbook[gift]" value="candle">
                                        <span class="gift-icon">🕯️</span> 蜡烛
                                    </label>
                                </div>
                            </div>

                            <?= Html::submitButton('提交留言', ['class' => 'btn btn-primary btn-block']) ?>

                        <?php ActiveForm::end(); ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Messages List -->
            <div class="guestbook-list">
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => function ($model, $key, $index, $widget) {
                        // 解析内容中的献礼信息
                        $content = $model->content;
                        $gift = '';
                        $decoded = json_decode($content, true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                            $content = $decoded['text'] ?? $content;
                            $giftType = $decoded['gift'] ?? '';
                            if ($giftType === 'flower') {
                                $gift = '<span class="gift" style="color:#e91e63;margin-right:10px;">💐 已献花</span>';
                            } elseif ($giftType === 'candle') {
                                $gift = '<span class="gift" style="color:#ff9800;margin-right:10px;">🕯️ 已点烛</span>';
                            }
                        }

                        // 删除按钮
                        $deleteBtn = '';
                        if (!Yii::$app->user->isGuest && Yii::$app->user->id == $model->user_id) {
                            $deleteBtn = Html::a('删除', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-xs btn-danger pull-right',
                                'style' => 'float:right;font-size:12px;',
                                'data' => [
                                    'confirm' => '确定要删除这条留言吗？',
                                    'method' => 'post',
                                ],
                            ]);
                        }

                        return '<div class="message-card">
                            <div class="message-header">
                                <span class="author">' . Html::encode($model->visitor_name) . '</span>
                                <span class="date">' . date('Y-m-d H:i', $model->created_at) . '</span>
                                ' . $deleteBtn . '
                            </div>
                            <div class="message-body">
                                <p>' . Html::encode($content) . '</p>
                            </div>
                            <div class="message-footer" style="margin-top:10px;font-size:0.9em;">
                                ' . $gift . '
                            </div>
                            ' . ($model->reply_content ? '
                            <div class="message-reply" style="background:#f9f9f9;padding:10px;margin-top:10px;border-left:3px solid #d9534f;">
                                <strong>管理员回复：</strong>
                                <p style="margin:0;">' . Html::encode($model->reply_content) . '</p>
                            </div>
                            ' : '') . '
                        </div>';
                    },
                    'layout' => "{summary}\n{items}\n{pager}",
                    'emptyText' => '暂无留言，快来抢沙发吧！',
                    'emptyTextOptions' => ['class' => 'alert alert-info'],
                ]) ?>
            </div>
        </div>
    </div>
</div>
