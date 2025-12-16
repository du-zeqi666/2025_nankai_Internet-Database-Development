<?php
/**
 * 🏛️ 抗战胜利80周年纪念网站 - 底部模板
 * Footer Partial Template
 * 
 * @description 包含网站地图、版权信息、友情链接和联系方式
 */
?>
<footer class="site-footer" role="contentinfo">
    <!-- 1. 装饰性顶部边框 -->
    <div class="footer-decoration">
        <div class="pattern-border"></div>
    </div>

    <div class="container">
        <div class="footer-content">
            <div class="row">
                <!-- 2. 网站简介与 Logo -->
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="footer-brand">
                        <img src="/assets/images/logo-white.svg" alt="抗战胜利80周年纪念" class="footer-logo">
                        <p class="footer-desc">
                            铭记历史，缅怀先烈，珍爱和平，开创未来。<br>
                            本网站旨在纪念中国人民抗日战争暨世界反法西斯战争胜利80周年，弘扬伟大的抗战精神。
                        </p>
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="微信公众号"><i class="icon-wechat"></i></a>
                            <a href="#" class="social-link" aria-label="新浪微博"><i class="icon-weibo"></i></a>
                            <a href="#" class="social-link" aria-label="抖音"><i class="icon-tiktok"></i></a>
                        </div>
                    </div>
                </div>

                <!-- 3. 快速导航 -->
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <h4 class="footer-heading">铭记历史</h4>
                    <ul class="footer-links">
                        <li><a href="/timeline">抗战年表</a></li>
                        <li><a href="/battles">重大战役</a></li>
                        <li><a href="/heroes">英雄人物</a></li>
                        <li><a href="/relics">历史文物</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <h4 class="footer-heading">缅怀先烈</h4>
                    <ul class="footer-links">
                        <li><a href="/memorial">网上祭奠</a></li>
                        <li><a href="/sites">纪念场馆</a></li>
                        <li><a href="/heroes?type=martyr">烈士英名录</a></li>
                        <li><a href="/guestbook">留言寄语</a></li>
                    </ul>
                </div>

                <!-- 4. 联系方式与订阅 -->
                <div class="col-lg-4 col-md-4 col-12 mb-4">
                    <h4 class="footer-heading">联系我们</h4>
                    <ul class="contact-info">
                        <li><i class="icon-location"></i> 北京市丰台区卢沟桥宛平城内街101号</li>
                        <li><i class="icon-phone"></i> 010-12345678</li>
                        <li><i class="icon-email"></i> contact@memorial80.cn</li>
                    </ul>
                    
                    <div class="newsletter-form mt-3">
                        <p class="text-sm text-muted mb-2">订阅最新纪念活动资讯</p>
                        <form action="/api/subscribe" method="POST" class="d-flex">
                            <input type="email" class="form-control form-control-sm" placeholder="请输入您的邮箱">
                            <button type="submit" class="btn btn-sm btn-gold">订阅</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. 友情链接 -->
        <div class="footer-links-row">
            <span class="links-label">友情链接：</span>
            <a href="http://www.1937china.com/" target="_blank" rel="noopener">中国人民抗日战争纪念馆</a>
            <a href="http://www.nj1937.org/" target="_blank" rel="noopener">侵华日军南京大屠杀遇难同胞纪念馆</a>
            <a href="http://www.918museum.org.cn/" target="_blank" rel="noopener">沈阳"九·一八"历史博物馆</a>
            <a href="http://www.nlc.cn/" target="_blank" rel="noopener">国家图书馆</a>
            <a href="http://www.saac.gov.cn/" target="_blank" rel="noopener">国家档案局</a>
        </div>

        <!-- 6. 版权信息 -->
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright">
                        &copy; 2025 抗战胜利80周年纪念网 版权所有<br>
                        <a href="/privacy">隐私政策</a> | <a href="/terms">使用条款</a> | <a href="/sitemap">网站地图</a>
                    </p>
                </div>
                <div class="col-md-6 text-md-right">
                    <p class="beian">
                        <a href="https://beian.miit.gov.cn/" target="_blank" rel="noopener">京ICP备12345678号-1</a>
                        <a href="#" target="_blank" rel="noopener">
                            <img src="/assets/images/gongan.png" alt="" width="16"> 京公网安备 11010102000001号
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
