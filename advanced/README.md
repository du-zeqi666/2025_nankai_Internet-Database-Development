# 抗战胜利80周年纪念网站 (War Memorial 80th Anniversary)

## 1. 项目简介
本项目是基于 **Yii2 Advanced Framework** 开发的纪念中国人民抗日战争暨世界反法西斯战争胜利80周年官方网站。项目集成了现代化的前端设计与稳健的后端管理系统，旨在铭记历史、缅怀先烈、珍爱和平。

### 主要功能模块
- **首页**：倒计时、数据统计、沉浸式首屏。
- **抗战英烈**：英雄列表、英雄生平详情页。
- **重大战役**：战役历史回顾、详情介绍。
- **历史时间轴**：1931-1945年大事记全景展示。
- **文物史料**：珍贵文物展示与分类。
- **纪念场馆**：各地纪念馆介绍及VR全景入口。
- **网上祭奠**：在线献花、留言寄语（Guestbook）。
- **后台管理**：内容发布、用户管理、留言审核。

---

## 2. 系统环境要求
- **服务器**：Apache 或 Nginx
- **PHP版本**：>= 7.4 (推荐 8.0+)
- **数据库**：MySQL 5.7+ 或 MariaDB
- **依赖管理**：Composer

---

## 3. 快速开始 (Installation)

### 第一步：克隆项目
将项目代码下载至本地 Web 目录（如 `D:\xampp\htdocs\advanced`）。

### 第二步：初始化环境
在项目根目录下打开终端（Terminal），运行初始化脚本：
```bash
# Windows 环境
init.bat

# Linux/Mac 环境
./init
```
选择 `0` (Development) 开发环境，然后输入 `yes` 确认。

### 第三步：配置数据库
1. 打开 `common/config/main-local.php`。
2. 配置数据库连接信息（`dsn`, `username`, `password`）：
```php
'components' => [
    'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=war_memorial', // 确保数据库名正确
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ],
],
```
3. 在 MySQL 中创建名为 `war_memorial` 的数据库，并导入根目录下的 `war_memorial.sql`（如果有）或运行迁移命令：
```bash
php yii migrate
```

### 第四步：访问项目
确保 Web 服务器（Apache/Nginx）已启动。
- **前台首页**：`http://localhost/advanced/frontend/web/`
- **后台管理**：`http://localhost/advanced/backend/web/`

*(注：如果您配置了虚拟主机，请使用配置的域名访问)*

---

## 4. 目录结构说明

```
advanced/
├── backend/                # 后台应用（管理员使用）
│   ├── controllers/        # 后台控制器
│   ├── views/              # 后台视图
│   └── web/                # 后台入口
├── common/                 # 公共组件（数据库模型、配置）
│   ├── models/             # 数据模型 (User, Hero, Battle等)
│   └── config/             # 公共配置
├── frontend/               # 前台应用（用户访问）
│   ├── controllers/        # 前台控制器 (HeroesController, SiteController等)
│   ├── views/              # Yii视图文件
│   ├── web/                # 前台入口及资源 (css, js, images)
│   └── war-memorial-frontend/  # [核心] 前端静态模板源文件
│       ├── templates/      # 页面HTML模板 (home.php, heroes/index.php)
│       └── public/assets/  # 原始静态资源
├── console/                # 控制台命令 (定时任务等)
└── vendor/                 # Composer 第三方包
```

## 5. 开发注意事项
1. **静态资源更新**：
   如果修改了 `frontend/war-memorial-frontend/public/assets` 下的图片或样式，需要将其同步复制到 `frontend/web/assets` 目录下，或者使用构建工具自动同步。
   
2. **路由配置**：
   前台路由由 `frontend/config/main.php` 中的 `urlManager` 控制。目前已为主要板块创建了对应的控制器。

3. **视图渲染**：
   前台控制器主要通过 `renderFile` 方法直接渲染 `war-memorial-frontend/templates` 下的模板文件，以保持设计稿的原汁原味。

---

## 6. 许可证
本软件遵循 MIT 许可证。
