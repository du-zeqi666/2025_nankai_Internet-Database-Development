<?php
/**
 * About Page
 * @var $this yii\web\View
 */

use yii\helpers\Html;

$this->title = '关于本站';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .about-section {
        max-width: 960px;
        margin: 0 auto;
        line-height: 1.8;
    }

    .about-section h2 {
        margin-top: 40px;
        margin-bottom: 16px;
        padding-left: 12px;
        border-left: 4px solid #c40000;
        color: #c40000;
    }

    .about-intro {
        font-size: 1.05rem;
        background: #fafafa;
        padding: 20px 24px;
        border-radius: 8px;
        border: 1px solid #eee;
    }

    .team-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .team-table th,
    .team-table td {
        border: 1px solid #ddd;
        padding: 12px 10px;
        text-align: center;
    }

    .team-table th {
        background-color: #f3f3f3;
        font-weight: bold;
    }

    .about-footer {
        margin-top: 50px;
        padding: 20px;
        background: #fdf6f6;
        border-left: 4px solid #c40000;
        color: #555;
    }
</style>

<div class="site-about">
    <div class="about-section">

        <h1><?= Html::encode($this->title) ?></h1>

        <!-- 一、网站基本介绍 -->
        <h2>网站基本介绍</h2>
        <div class="about-intro">
            <p>
                本网站是 <strong>南开大学 2025 年秋季学期《互联网数据库开发》课程</strong> 的课程大作业成果。
            </p>
            <p>
                网站主题为 <strong>“纪念中国人民抗日战争暨世界反法西斯战争胜利 80 周年”</strong>，
                旨在通过信息化与互联网技术手段，展示抗战历史、英雄人物、重要战役及相关文物资料，
                以数字化方式传承红色记忆、弘扬爱国主义精神。
            </p>
            <p>
                本项目基于 <strong>PHP + Yii2 框架</strong> 开发，采用前后端分离思想，
                结合数据库进行动态内容管理，是一次综合性的 Web 应用开发实践。
            </p>
        </div>

        <!-- 二、项目开发小组 -->
        <h2>项目开发小组（数据四骑士）</h2>
        <p>
            本网站由 <strong>数据四骑士 小组</strong> 共同完成，小组共 <strong>4 名成员</strong>，
            成员分工协作，分别负责页面设计、功能开发、数据库设计与整体集成。
        </p>

        <table class="team-table">
            <thead>
                <tr>
                    <th>姓名</th>
                    <th>学号</th>
                    <th>学院</th>
                    <th>主要负责内容</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>杜泽琦</td>
                    <td>2313508</td>
                    <td>密码与网络空间安全学院</td>
                    <td>项目文档书写，数据库框架搭建与前台页面完善，连接数据库</td>
                </tr>
                <tr>
                    <td>杨中秀</td>
                    <td>2312323</td>
                    <td>密码与网络空间安全学院</td>
                    <td>项目文档书写，数据库框架搭建与前台页面完善，连接数据库，后台界面搭建</td>
                </tr>
                <tr>
                    <td>巩岱松</td>
                    <td>2312325</td>
                    <td>密码与网络空间安全学院</td>
                    <td>前台整体框架搭建，PPT与视频录制，后台界面搭建</td>
                </tr>
                <tr>
                    <td>蒋枘言</td>
                    <td>2313546</td>
                    <td>密码与网络空间安全学院</td>
                    <td>数据库框架搭建与前台页面完善，连接数据库，PPT与视频录制</td>
                </tr>
            </tbody>
        </table>

        <!-- 三、功能与特色（拓展内容） -->
        <h2>网站功能与特色</h2>
        <ul>
            <li>📌 抗战历史时间轴展示，按时间顺序呈现重大历史事件</li>
            <li>📌 英雄人物与重要战役专题页面，支持图文展示</li>
            <li>📌 文物史料分类浏览，增强历史真实感</li>
            <li>📌 基于数据库的动态内容管理，便于后续扩展</li>
        </ul>

        <!-- 四、课程说明 -->
        <div class="about-footer">
            <p>
                本项目仅用于 <strong>教学与课程实践</strong> 目的，
                所涉及历史资料主要来源于公开史料与网络整理内容，
                如有不当之处，欢迎指正。
            </p>
            <p>
                © 2025 南开大学《互联网数据库开发》课程 · 数据四骑士 小组
            </p>
        </div>

    </div>
</div>