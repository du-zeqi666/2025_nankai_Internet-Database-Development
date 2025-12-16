# 抗战胜利80周年纪念网站 - 四人开发小组分工指南 (Team Guide)

> **⚠️ 重要提示**：所有成员必须严格遵守本指南中的“开发公约”，特别是文件命名、注释规范及作业提交路径。

## 1. 严格开发公约 (Strict Development Covenant)

### 1.1 编码及格式要求
所有成员必须遵循以下规则，违者需重新提交。

1.  **统一命名规范**：
    *   **类名**：PascalCase (如 `HeroesController`, `HeroModel`)
    *   **变量/方法名**：camelCase (如 `actionIndex`, `$userList`)
    *   **数据库表名**：小写下划线 (如 `war_heroes`)
    *   **文件名**：与类名保持一致 (如 `HeroesController.php`)

2.  **PHP文件注释头**：
    **每个** PHP 文件（Controller, Model, View）顶部必须包含以下注释块：
    ```php
    /**
     * Team Member: [您的姓名/角色] (e.g., Member A)
     * Student ID: [您的学号]
     * Task: [任务描述] (e.g., 实现英烈列表页)
     * Date: 2023-XX-XX
     */
    ```

3.  **作业提交路径**：
    *   **数据库SQL**：统一汇总至 `/data/install.sql`。
    *   **团队作业**：所有团队共用文档/源码包放在 `/data/team/`。
    *   **个人作业**：个人的实验报告/独立代码包放在 `/data/personal/`。

4.  **下载页面**：
    *   项目首页或导航栏需提供“作业下载”入口，链接至上述文件夹内容的下载页。

5.  **MVC 覆盖要求**：
    *   每位组员**必须**至少编写 MVC 三层各一个文件（1 Model + 1 View + 1 Controller）。

---

## 2. 精确分工与文件权限 (Exact File Assignments)

为了避免代码冲突，每位成员**只能修改**分配给自己的文件。如需修改他人文件，必须先沟通。

### 👨‍💻 成员 A：用户系统 & 基础架构
*   **负责模块**：用户注册、登录、后台基础、数据库设计。
*   **指定修改文件**：
    *   **Model**:
        *   `common/models/User.php` (用户模型)
        *   `frontend/models/SignupForm.php` (注册表单模型)
        *   `frontend/models/LoginForm.php` (登录表单模型)
    *   **Controller**:
        *   `frontend/controllers/SiteController.php` (仅限 `actionLogin`, `actionLogout`, `actionSignup`)
    *   **View**:
        *   `frontend/views/site/login.php`
        *   `frontend/views/site/signup.php`
    *   **Config**: `common/config/main-local.php` (数据库配置)

### 🎨 成员 B：首页 & 历史时间轴
*   **负责模块**：网站首页展示、历史大事记时间轴。
*   **指定修改文件**：
    *   **Model**:
        *   `common/models/TimelineEvent.php` (时间轴事件模型 - **需新建**)
    *   **Controller**:
        *   `frontend/controllers/TimelineController.php`
        *   `frontend/controllers/SiteController.php` (仅限 `actionIndex`, `actionAbout`)
    *   **View**:
        *   `frontend/views/site/index.php` (首页)
        *   `frontend/views/timeline/index.php` (时间轴页)
    *   **Assets**: `frontend/assets/AppAsset.php` (全局资源管理)

### 🛠️ 成员 C：英烈 & 战役板块
*   **负责模块**：抗战英烈列表/详情、重大战役列表/详情。
*   **指定修改文件**：
    *   **Model**:
        *   `common/models/Hero.php` (英烈模型 - **需新建**)
        *   `common/models/Battle.php` (战役模型 - **需新建**)
    *   **Controller**:
        *   `frontend/controllers/HeroesController.php`
        *   `frontend/controllers/BattlesController.php`
    *   **View**:
        *   `frontend/views/heroes/index.php`
        *   `frontend/views/heroes/view.php`
        *   `frontend/views/battles/index.php`
        *   `frontend/views/battles/view.php`

### 📝 成员 D：网上祭奠 & 留言板 & 作业下载页
*   **负责模块**：留言寄语、在线献花、**作业下载页面**。
*   **指定修改文件**：
    *   **Model**:
        *   `common/models/Guestbook.php` (留言模型 - **需新建**)
        *   `frontend/models/DownloadSearch.php` (文件检索模型 - **需新建**)
    *   **Controller**:
        *   `frontend/controllers/GuestbookController.php`
        *   `frontend/controllers/DownloadController.php` (作业下载控制器 - **需新建**)
    *   **View**:
        *   `frontend/views/guestbook/index.php`
        *   `frontend/views/download/index.php` (作业列表展示页 - **需新建**)

---

## 3. 数据库设计汇总 (install.sql)

所有成员在设计好自己的 Model 后，需将对应的 `CREATE TABLE` 语句追加到项目根目录的 `/data/install.sql` 文件中。

### 示例结构：
```sql
-- Member A: Users Table
CREATE TABLE `user` ( ... );

-- Member B: Timeline Table
CREATE TABLE `timeline_event` ( ... );

-- Member C: Heroes Table
CREATE TABLE `hero` ( ... );

-- Member D: Guestbook Table
CREATE TABLE `guestbook` ( ... );
```

---

## 4. 作业下载页实现指南 (For Member D)

为了满足“项目页面提供团队及个人作业的下载链接”的要求：
1.  **Controller**: `DownloadController` 扫描 `/data/team/` 和 `/data/personal/` 目录。
2.  **View**: `views/download/index.php` 使用表格列出文件名，并提供 `<a>` 标签链接。
3.  **路由**: 在 `SiteController` 或 Header 中添加链接指向 `/index.php?r=download/index`。
