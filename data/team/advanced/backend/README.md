# 后台管理系统说明文档

## 1. 目录结构说明

`backend` 目录包含了后台管理系统的所有源代码，基于 Yii2 Advanced 模板构建。主要目录结构如下：

*   **assets/**: 包含应用的前端资源（CSS, JS, 图片等）定义。
*   **config/**: 包含后台特有的配置文件。
    *   `main.php`: 主要配置文件。
    *   `params.php`: 应用参数。
*   **controllers/**: 包含控制器类，处理用户请求。
    *   `SiteController.php`: 处理登录、注销、首页等默认操作。
    *   `GuestbookController.php`: 留言板管理。
    *   `ConfigController.php`: 系统配置管理。
    *   `HistoricalRelicController.php`: 历史文物管理。
    *   `MemorialSiteController.php`: 纪念设施管理。
    *   `BattleController.php`: 战役管理。
*   **models/**: 包含后台特有的模型类（通常是搜索模型）。
    *   `*Search.php`: 对应各个数据模型的搜索类。
*   **views/**: 包含视图文件，负责页面展示。
    *   `layouts/`: 布局文件（如 `main.php` 包含侧边栏和顶部导航）。
    *   `site/`: 对应 `SiteController` 的视图（如 `index.php` 仪表盘, `login.php` 登录页）。
    *   `guestbook/`, `config/`, etc.: 对应各个控制器的 CRUD 视图。
*   **web/**: Web 入口目录。
    *   `index.php`: 入口脚本。
    *   `css/`, `js/`: 静态资源文件。

## 2. 如何启动后台

### 步骤 1: 启动服务器环境
请确保 **XAMPP** 控制面板中的 **Apache** 和 **MySQL** 模块都已启动（显示为绿色）。

### 步骤 2: 数据库准备
本项目依赖 `yii2advanced_test` 数据库。如果尚未导入数据，请执行以下 SQL 文件：
`d:\xampp\htdocs\advanced\war_memorial.sql`

可以使用 phpMyAdmin 或命令行导入。命令行示例：
```bash
mysql -u root -P 3300 yii2advanced_test < d:\xampp\htdocs\advanced\war_memorial.sql
```

### 步骤 3: 访问后台
在浏览器中输入以下地址访问后台管理系统：

```
http://localhost/advanced/backend/web/
```

### 步骤 4: 登录
请使用以下默认管理员账号登录：
*   **用户名**: admin
*   **密码**: password (默认开发密码，请根据实际情况尝试)

## 3. 常见问题

*   **页面报错 404**: 检查 URL 是否正确，或者 Apache/Nginx 的伪静态配置是否生效。
*   **数据库连接错误**: 检查 `common/config/main-local.php` 中的数据库配置。
*   **样式加载失败**: 检查 `backend/web/assets` 目录是否有写入权限。
