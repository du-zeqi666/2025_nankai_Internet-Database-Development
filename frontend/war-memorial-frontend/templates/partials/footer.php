<?php
use yii\helpers\Url;
?>
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>关于我们</h3>
                <p>铭记历史，缅怀先烈，珍爱和平，开创未来。本网站旨在纪念中国人民抗日战争暨世界反法西斯战争胜利80周年，弘扬伟大的抗战精神。</p>
            </div>
            <div class="footer-section">
                <h3>快速链接</h3>
                <ul>
                    <li><a href="<?= Url::to(['/heroes']) ?>">抗战英烈</a></li>
                    <li><a href="<?= Url::to(['/battles']) ?>">重大战役</a></li>
                    <li><a href="<?= Url::to(['/timeline']) ?>">历史时间轴</a></li>
                    <li><a href="<?= Url::to(['/relics']) ?>">文物史料</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>联系方式</h3>
                <ul>
                    <li>邮箱：contact@warmemorial.cn</li>
                    <li>地址：北京市丰台区卢沟桥宛平城内街101号</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> 抗战胜利80周年纪念网站 版权所有 | 京ICP备XXXXXXXX号</p>
        </div>
    </div>
</footer>

