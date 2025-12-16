# 抗战胜利80周年纪念网站

由"数据四骑士"小组共同完成的2025年南开大学互联网数据库开发大作业

## 小组成员

- 杜泽琦（2313508）
- 杨中秀（2312323）
- 巩岱松（2312325）
- 蒋枘言（2313546）

## 项目结构

```
2025_nankai_Internet-Database-Development/
├── advanced/                           # 项目源代码和配置文件
│   ├── backend/                       # 后台管理系统
│   ├── common/                        # 共用模块
│   ├── console/                       # 控制台应用（数据库迁移）
│   ├── data/                          # 数据文件
│   ├── environments/                  # 环境配置（开发/生产）
│   ├── frontend/                      # 前台应用（用户界面）
│   │   └── war-memorial-frontend/    # 现代化前端项目（Webpack + SCSS）
│   ├── vagrant/                       # Vagrant 虚拟机配置
│   ├── composer.json & .lock          # PHP 依赖管理
│   ├── README.md                      # 项目说明（详见 advanced 目录）
│   └── 其他配置文件
│
├── 2025秋季乜鹏老师课件/               # 老师提供的课程资料
├── 实验操作记录（每次提交仓库...）/    # 实验过程记录
├── 项目文档/                           # 项目相关文档
│   ├── 需求文档/
│   ├── 设计文档/
│   ├── 实现文档/
│   ├── 用户手册/
│   └── 部署文档/
│
└── README.md                           # 本文件
```

## 快速开始

如需安装和运行项目，请查看 `advanced` 文件夹下的相关说明：

```bash
cd advanced
composer install
php init
php yii migrate
```

## 项目特色

- **多应用架构**：基于 Yii2 Advanced Framework 的前后台分离架构
- **现代化前端**：使用 Webpack、SCSS 等现代前端技术栈
- **完整的功能模块**：包含用户认证、数据管理、留言系统等
- **数据库设计**：超过 10 张表，支持复杂的数据关系
- **虚拟机支持**：提供 Vagrant 配置用于统一开发环境
- **Docker 支持**：提供 Docker 和 docker-compose 配置

## 文档

详见 `项目文档/` 文件夹下的各类文档：

- **需求文档**：项目的需求分析和功能设计
- **设计文档**：数据库设计和模块架构
- **实现文档**：实现过程和代码展示
- **用户手册**：系统的使用说明
- **部署文档**：项目的部署和还原流程

## 技术栈

- **后端**：PHP 7+ + Yii2 框架
- **前端**：HTML5 + CSS3 + JavaScript + SCSS + Webpack
- **数据库**：MySQL
- **测试框架**：Codeception
- **开发工具**：Git + Composer + npm

## License

仅限教学使用

---

更多详细信息，请查看 `advanced/README.md` 文件。
