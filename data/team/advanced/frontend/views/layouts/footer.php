<?php
/**
* Team：数据四骑士,NKU
* Coding by 杨中秀 2312323
* this is footer layout
*/
use yii\helpers\Url;
?>
<style> 
    .footer-content {
        display: flex;
        gap: 40px;
    }

    .footer-image {
        margin-left: auto; /* 关键：推到最右侧 */
        display: flex;
        align-items: center;
    }

    .footer-image img {
        width: 120px;        /* 你可以改 */
        max-width: 100%;
        height: auto;
        opacity: 0.9;        /* 稍微柔和一点 */
    }
</style>
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>关于我们</h3>
                <p>我们是南开大学密码与网络空间安全学院2023级本科生，此网站为《互联网数据库开发》课程的课程大作业成果。</p>
            </div>
            <div class="footer-section">
                <h3>联系方式</h3>
                <ul>
                    <li>邮箱：2313508@mail.nankai.edu.cn，2312323@mail.nankai.edu.cn，2312325@mail.nankai.edu.cn，2313546@mail.nankai.edu.cn</li>
                    <li>地址：天津市津南区同砚路38号南开大学津南校区</li>
                </ul>
            </div>
            <div class="footer-section footer-image">
                <img src="<?= Url::to('@web/assets/images/footer/footer-logo.png') ?>" alt="网站标识">
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> 南开大学 <strong>数据四骑士</strong>小组 版权所有 | <a href="<?= Url::to(['/site/about']) ?>">关于本站</a></p>
        </div>
    </div>
</footer>
