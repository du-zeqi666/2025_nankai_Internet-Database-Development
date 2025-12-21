-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2025-12-16 15:03:10
-- 服务器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `war_memorial`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `view_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文章';

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `title`, `summary`, `content`, `cover_image`, `category_id`, `author_id`, `view_count`) VALUES
(1, '平型关大捷的历史意义', '平型关大捷是八路军出师华北抗日前线后取得的首战胜利，也是全国抗战爆发后中国军队的第一个大胜仗。', '平型关大捷发生于1937年9月25日，八路军第115师在师长林彪、副师长聂荣臻的指挥下，于山西省平型关附近伏击日军板垣师团第21旅团一部。战斗共歼敌1000余人，击毁汽车100余辆，马车200余辆，缴获大批军用物资。\n\n这次胜利打破了日军\"不可战胜\"的神话，极大地振奋了全国人民的抗战信心，提高了共产党和八路军的声威。平型关大捷证明了中国共产党领导的抗日武装力量能够给日本侵略者以沉重打击，也展现了八路军灵活机动的战术和英勇顽强的战斗精神。\n\n平型关大捷的胜利，对于创建晋察冀抗日根据地，开辟华北敌后战场，具有重要的战略意义。', NULL, 4, 1, 156),
(2, '民族英雄杨靖宇的抗日传奇', '杨靖宇将军是东北抗日联军的主要创建人和领导人之一，他在极其艰苦的条件下坚持抗日斗争，直至壮烈牺牲。', '杨靖宇，原名马尚德，1905年出生于河南确山。1927年加入中国共产党，1929年被派往东北工作。\n\n在东北，他创建了中国工农红军第32军南满游击队，后任东北抗日联军第一军军长兼政委、第一路军总司令兼政委。他率部长期转战于白山黑水之间，给日伪军以沉重打击。\n\n1939年冬，日伪军对东北抗日联军进行残酷\"讨伐\"，杨靖宇率部在极其艰苦的条件下坚持战斗。1940年2月23日，在吉林濛江县（今靖宇县）保安村三道崴子，杨靖宇孤身一人与大量日伪军周旋战斗，最后壮烈牺牲，年仅35岁。\n\n日军剖开他的遗体，发现胃里只有树皮、草根和棉絮，没有一粒粮食。在场的日本军官都为之震惊，感叹：\"杨靖宇是真正的英雄！\"', NULL, 5, 2, 203),
(3, '台儿庄战役：血与火的史诗', '台儿庄战役是抗战初期中国军队在正面战场取得的一次重大胜利，沉重打击了日军的嚣张气焰。', '台儿庄战役是徐州会战的重要组成部分，发生于1938年3月16日至4月7日。中国军队在李宗仁指挥下，以孙连仲的第二集团军、汤恩伯的第二十军团为主力，与日军在山东台儿庄地区展开激战。\n\n战役中，中国军队采取诱敌深入、分割包围的战术，在台儿庄内外与日军展开激烈巷战。中国守军以血肉之躯抵抗日军的猛烈进攻，许多阵地反复争夺，战斗异常惨烈。\n\n经过20多天的激战，中国军队歼灭日军1万余人，击毁坦克30余辆，缴获大批武器弹药，取得了抗战以来正面战场的最大胜利。\n\n台儿庄大捷极大地鼓舞了全国军民的抗战信心，打破了日军不可战胜的神话，为随后的武汉会战争取了时间，在中国抗战史上写下了光辉的一页。', NULL, 4, 1, 178);

-- --------------------------------------------------------

--
-- 表的结构 `battle`
--

CREATE TABLE `battle` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '战役名称',
  `start_date` date NOT NULL COMMENT '开始日期',
  `end_date` date DEFAULT NULL COMMENT '结束日期',
  `location` varchar(255) NOT NULL COMMENT '发生地点',
  `description` text NOT NULL COMMENT '战役描述',
  `result` varchar(100) DEFAULT NULL COMMENT '战役结果',
  `significance` text DEFAULT NULL COMMENT '历史意义',
  `image` varchar(255) DEFAULT NULL,
  `detail_image` varchar(255) DEFAULT NULL,
  `map_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='战役';

--
-- 转存表中的数据 `battle`
--

INSERT INTO `battle` (`id`, `name`, `start_date`, `end_date`, `location`, `description`, `result`, `significance`, `image`, `detail_image`, `map_image`) VALUES
(2, '平型关大捷', '1937-09-25', '1937-09-25', '山西平型关', '八路军第115师在平型关附近伏击日军板垣师团一部，取得全面抗战以来中国军队的第一个大胜利。', '中国军队获胜', '打破了日军不可战胜的神话，鼓舞了全国军民的抗战信心，提高了共产党和八路军的威望。', 'pingxingguan.jpg', 'pingxingguan.jpg', 'pingxingguanditu.png'),
(3, '台儿庄大捷', '1938-03-16', '1938-04-07', '山东台儿庄', '徐州会战的一部分，中国军队在李宗仁指挥下，与日军在台儿庄地区展开激战。', '中国军队获胜', '抗战以来正面战场取得的最大胜利，歼灭日军万余人，极大地鼓舞了全国抗战的士气。', 'taierzhuang.jpg', 'tierzhuang.jpg', 'taierzhuangditu.png'),
(4, '百团大战', '1940-08-20', '1941-01-24', '华北地区', '八路军在彭德怀指挥下，发动对日军交通线和据点的破袭战，因参战部队达105个团而得名。', '破坏日军交通线', '沉重打击了日军的\"囚笼政策\"，提高了八路军的声威，增强了全国人民的抗战信心。', 'baituan.jpg', 'baituandazhan4.jpg', 'baituandazhanditu.png');

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='分类表';

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `type`, `parent_id`, `sort_order`, `status`) VALUES
(1, '抗战历史', '抗日战争相关文章', 'article', NULL, 1, 1),
(2, '英雄事迹', '抗日英雄故事', 'article', NULL, 2, 1),
(3, '文物研究', '历史文物研究', 'article', NULL, 3, 1),
(4, '战役回顾', '重要战役分析', 'article', 1, 10, 1),
(5, '人物传记', '英雄人物传记', 'article', 2, 20, 1);

-- --------------------------------------------------------

--
-- 表的结构 `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `config_key` varchar(255) NOT NULL,
  `config_value` text DEFAULT NULL,
  `config_name` varchar(255) DEFAULT NULL,
  `config_group` varchar(100) DEFAULT 'basic',
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统配置';

--
-- 转存表中的数据 `config`
--

INSERT INTO `config` (`id`, `config_key`, `config_value`, `config_name`, `config_group`, `sort_order`) VALUES
(1, 'site_name', '抗战历史纪念馆', '网站名称', 'basic', 1),
(2, 'site_description', '铭记历史，缅怀先烈，珍爱和平', '网站描述', 'basic', 2),
(3, 'contact_email', 'contact@war-memorial.com', '联系邮箱', 'contact', 10),
(4, 'record_number', '京ICP备12345678号', '备案号', 'basic', 20),
(5, 'maintenance_mode', '0', '维护模式', 'system', 100);

-- --------------------------------------------------------

--
-- 表的结构 `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `guestbook`
--

CREATE TABLE `guestbook` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `visitor_name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `reply_content` text DEFAULT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户留言';

--
-- 转存表中的数据 `guestbook`
--

INSERT INTO `guestbook` (`id`, `user_id`, `visitor_name`, `content`, `reply_content`, `created_at`) VALUES
(1, 3, '李明', '参观了这个网站，深受教育。我们要永远铭记历史，珍惜来之不易的和平。', '感谢您的留言！我们会继续努力，做好历史教育工作。', 1765025845),
(2, NULL, '张华', '希望能增加更多的英雄故事，让年轻一代了解那段历史。', '感谢建议，我们正在整理更多英雄事迹，会陆续更新。', 1765025845),
(3, NULL, '游客', '资料很丰富，向抗日英雄致敬！', NULL, 1765025845);

-- --------------------------------------------------------

--
-- 表的结构 `hero`
--

CREATE TABLE `hero` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `birth_year` int(11) DEFAULT NULL,
  `death_year` int(11) DEFAULT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `death_place` varchar(255) DEFAULT NULL,
  `introduction` text NOT NULL,
  `biography` text DEFAULT NULL,
  `heroic_deeds` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo_large` varchar(255) DEFAULT NULL,
  `army` varchar(64) DEFAULT NULL,
  `rank` varchar(64) DEFAULT NULL,
  `honor` varchar(255) DEFAULT NULL,
  `quote` text DEFAULT NULL,
  `quote_source` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='英雄';

--
-- 转存表中的数据 `hero`
--

INSERT INTO `hero` (`id`, `name`, `alias`, `title`, `birth_year`, `death_year`, `birth_place`, `death_place`, `introduction`, `biography`, `heroic_deeds`, `photo`, `photo_large`, `army`, `rank`, `honor`, `quote`, `quote_source`) VALUES
(1, '杨靖宇', 'yang-jingyu', '东北抗日联军第一路军总司令兼政治委员', 1905, 1940, '河南省确山县', '吉林省濛江县', '东北抗日联军主要领导人之一，坚守敌后，英勇牺牲。', '杨靖宇（1905年2月13日－1940年2月23日），原名马尚德，字骥生，汉族，河南省确山县人，中国共产党优秀党员，无产阶级革命家、军事家、著名抗日民族英雄，鄂豫皖苏区及其红军的创始人之一，东北抗日联军的主要创建者和领导人之一。\n\n1932年，受党中央委托到东北组织抗日联军，历任抗日联军总指挥政委等职。率领东北军民与日寇血战于白山黑水之间，冰天雪地，弹尽粮绝，孤身一人与大量日寇周旋战斗几昼夜后壮烈牺牲。\n\n杨靖宇牺牲后，日军解剖了他的尸体，发现胃里只有树皮、草根和棉絮，没有一粒粮食。在场的日军无不为之震惊。', NULL, 'yangjingyu.jpg', 'yang-jingyu-large.png', 'ne_army', 'general', '100位为新中国成立作出突出贡献的英雄模范人物', '头颅可断腹可剖，烈忾难消志不磨，碧血青蒿两千古，于今赤旗满山河。', '杨靖宇 诗作'),
(2, '马本斋', 'ma-benzhai', '八路军冀鲁豫军区第三军分区司令员兼回民支队司令员', 1901, 1944, '河北省献县', '山东省莘县', '冀中回民支队创始人之一，率部抗击日寇，威震敌胆。', '马本斋（1901年－1944年），原名马守清，回族，河北省献县人，中国共产党优秀党员，著名抗日民族英雄，回民支队的创建者和领导者。他早年投身奉军，后因不满国民党的不抵抗政策，毅然返乡组织抗日武装。\n\n1938年，马本斋率领回民义勇队参加八路军，改编为回民支队，他任司令员。回民支队在他的指挥下，转战冀中平原和冀鲁豫边区，历经大小战斗870余次，歼灭日伪军3.8万余人，被毛泽东主席赞誉为“百战百胜的回民支队”。\n\n1941年，日军抓捕马本斋的母亲逼其劝降，马母绝食殉国，马本斋化悲痛为力量，继续率部抗日。1944年，马本斋因积劳成疾，在山东莘县病逝，年仅43岁。', NULL, 'mabenzhai.jpg', 'ma-benzhai-large.png', '8route', 'general', '“百战百胜的回民支队”（毛泽东题词）', '伟大母亲虽死犹生，儿承母志，继续斗争！', '马本斋 语录'),
(3, '佟麟阁', 'tong-linge', '国民革命军第29军副军长', 1892, 1937, '河北省高阳县', '北平南苑（今北京丰台区）', '卢沟桥事变后浴血奋战，壮烈殉国，民族气节永存。', '佟麟阁（1892年－1937年），原名佟凌阁，字捷三，河北省高阳县人，中华民国陆军二级上将（追赠），著名抗日爱国将领。他早年投身军旅，跟随冯玉祥将军征战，历任旅长、师长、军长等职，以爱国爱民、治军严明著称。\n\n1933年，佟麟阁率部参加察哈尔抗日同盟军，与吉鸿昌等将领并肩作战，收复多伦等失地，打击了日军的嚣张气焰。1937年七七事变爆发后，佟麟阁时任国民革命军第29军副军长，坐镇南苑，指挥部队奋起抵抗日军进攻。\n\n1937年7月28日，佟麟阁在南苑战斗中，腿部被日军机枪击中，仍坚持指挥作战，后头部再受重伤，壮烈殉国，成为抗日战争中殉国的第一位国民党高级将领。国民政府追赠其为陆军二级上将。', NULL, 'tonglingge.jpg', 'tong-linge-large.png', 'kmt', 'general', '抗日战争中殉国的第一位国民党高级将领', '中央如下令抗日，麟阁若不身先士卒，君等可执往天安门前，挖我两眼，割我两耳。', '佟麟阁 语录'),
(4, '赵一曼', 'zhao-yiman', '东北人民革命军第三军二团政治委员', 1905, 1936, '四川省宜宾市', '黑龙江省珠河县（今尚志市）', '投身抗日救亡，坚贞不屈，留下感人至深的家书。', '赵一曼（1905年－1936年），原名李坤泰，又名李一超，四川省宜宾市人，中国共产党优秀党员，著名抗日民族英雄。她早年接受革命思想，加入中国共产党，曾赴苏联莫斯科中山大学学习。\n\n1931年九一八事变后，赵一曼被派往东北从事抗日救亡工作，历任满洲总工会秘书、组织部长，东北人民革命军第三军二团政治委员等职。她率领部队在珠河、宾县等地开展游击战争，打击日军，深受当地群众爱戴。\n\n1935年，赵一曼在战斗中负伤被俘，日军对其施以酷刑，逼其招供，她始终坚贞不屈。1936年8月2日，赵一曼在黑龙江珠河县英勇就义，年仅31岁。牺牲前，她留下遗书，叮嘱儿子“毋忘母亲是为国而牺牲”。', NULL, 'zhaoyiman.jpg', 'zhao-yiman-large.png', 'ne_army', 'officer', '100位为新中国成立作出突出贡献的英雄模范人物', '未惜头颅新故国，甘将热血沃中华', '赵一曼 诗作'),
(5, '左权', 'zuo-quan', '八路军副参谋长、前方总部参谋长', 1905, 1942, '湖南省醴陵县（今醴陵市）', '山西省辽县（今左权县）', '八路军高级指挥员，协助彭德怀指挥多次战役，壮烈殉国。', '左权（1905年－1942年），字孳麟，号叔仁，原名左纪权，湖南省醴陵县人，中国共产党优秀党员，无产阶级革命家、军事家，八路军高级指挥员。他是黄埔军校一期毕业生，后赴苏联伏龙芝军事学院深造，具备深厚的军事理论素养。\n\n抗日战争爆发后，左权任八路军副参谋长、前方总部参谋长，协助彭德怀指挥八路军在华北开展游击战争，参与指挥了平型关大捷、百团大战等著名战役。1941年，他指挥黄崖洞保卫战，以少胜多，歼灭日军千余人，被八路军总部称为“反扫荡的模范战斗”。\n\n1942年5月，日军对八路军前方总部发动大“扫荡”，左权在掩护总部机关和群众突围时，被日军炮弹击中，壮烈牺牲，年仅37岁。为纪念他，晋冀鲁豫边区政府将辽县改名为左权县。', NULL, 'zuoquan.jpg', 'zuo-quan-large.png', '8route', 'general', '八路军在抗日战场牺牲的最高指挥员', '坚持抗战，坚持统一战线，坚持持久战，最后胜利必然是我们的。', '左权 语录'),
(6, '李林', 'li-lin', '雁北抗日游击队支队长、骑兵营教导员', 1915, 1940, '福建省漳州市', '山西省朔州市平鲁区', '归国华侨，抗日女英雄，驰骋雁北，血洒疆场。', '李林（1915年－1940年），原名李秀若，福建漳州人，侨居印尼爪哇，中国共产党优秀党员，著名抗日民族女英雄。她幼年侨居海外，目睹华侨受压迫，立志报国，14岁归国投身抗日救亡运动。\n\n1937年抗战爆发后，李林主动请缨赴晋绥边区，任雁北抗日游击队支队长、骑兵营教导员，率部与日军浴血奋战，曾以双枪骑战威慑敌寇。1940年4月，怀有身孕的她为掩护机关和群众突围，率骑兵连诱敌，身中数弹后饮弹殉国，年仅24岁，牺牲时胃中仅存树皮草根。\n\n她牺牲后，中共中央妇委称其为“全国同胞敬爱的女英雄”，延安《中国妇女杂志》等报刊广泛报道其事迹，晋闽两地至今立像缅怀。', NULL, 'lilin.jpg', 'li-lin-large.png', '8route', 'officer', '100位为新中国成立作出突出贡献的英雄模范人物', '甘愿征战血染衣，不平倭寇誓不休', '李林 诗作');

-- --------------------------------------------------------

--
-- 表的结构 `historical_event`
--

CREATE TABLE `historical_event` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `event_date` date NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `importance_level` tinyint(4) DEFAULT 1,
  `cover_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='历史事件';

--
-- 转存表中的数据 `historical_event`
--

INSERT INTO `historical_event` (`id`, `title`, `description`, `event_date`, `location`, `importance_level`, `cover_image`) VALUES
(1, '七七事变（卢沟桥事变）', '1937年7月7日夜，日军在卢沟桥附近演习时，借口一名士兵\"失踪\"，要求进入宛平县城搜查，遭拒后炮轰宛平城，中国守军奋起抵抗，全国性抗日战争由此开始。', '1937-07-07', '北京卢沟桥', 5, NULL),
(2, '南京大屠杀', '1937年12月13日，日军攻占南京后，进行了长达6周的有组织、有计划、有预谋的大屠杀和奸淫、放火、抢劫等血腥暴行，遇难人数超过30万。', '1937-12-13', '江苏南京', 5, NULL),
(3, '日本宣布无条件投降', '1945年8月15日，日本天皇裕仁通过广播发布《终战诏书》，宣布日本无条件投降，中国人民抗日战争取得最终胜利。', '1945-08-15', '日本东京', 5, NULL),
(4, '九一八事变', '1931年9月18日，日本关东军炸毁沈阳柳条湖附近的南满铁路路轨，并嫁祸于中国军队，以此为借口炮轰沈阳北大营，次日占领沈阳，标志着局部抗战的开始。', '1931-09-18', '辽宁沈阳', 4, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `historical_relic`
--

CREATE TABLE `historical_relic` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `era` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `current_location` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文物史料';

--
-- 转存表中的数据 `historical_relic`
--

INSERT INTO `historical_relic` (`id`, `name`, `category`, `era`, `description`, `current_location`, `image`) VALUES
(1, '《抗战日报》', '报刊文献', '抗日战争时期', '中国共产党在华北抗日根据地创办的报纸，记录了大量的抗战新闻和战斗故事，是研究抗战历史的重要文献资料。', '中国人民抗日战争纪念馆', NULL),
(2, '八路军臂章', '军事物品', '抗日战争时期', '八路军官兵佩戴的身份标识，上面有\"八路军\"字样，见证了八路军在抗战中的英勇斗争。', '军事博物馆', NULL),
(3, '地道战遗址', '遗址遗迹', '抗日战争时期', '冀中平原抗日军民创造的地下作战工事，用于隐蔽、转移和打击敌人，是人民战争智慧的结晶。', '河北冉庄地道战遗址', NULL),
(4, '《论持久战》手稿', '文献手稿', '1938年', '毛泽东1938年5-6月在延安抗日战争研究会上的讲演稿，系统阐述了持久战的战略思想，对抗战胜利具有重要指导意义。', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `memorial_site`
--

CREATE TABLE `memorial_site` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `opening_hours` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='纪念场馆';

--
-- 转存表中的数据 `memorial_site`
--

INSERT INTO `memorial_site` (`id`, `name`, `address`, `province`, `city`, `description`, `opening_hours`, `contact_phone`) VALUES
(1, '中国人民抗日战争纪念馆', '北京市丰台区卢沟桥宛平城内街101号', '北京', '北京', '全国唯一一座全面反映中国人民抗日战争历史的大型综合性专题纪念馆，建于1987年。', '周二至周日 9:00-16:30', '010-83892355'),
(2, '侵华日军南京大屠杀遇难同胞纪念馆', '江苏省南京市建邺区水西门大街418号', '江苏', '南京', '为铭记侵华日军攻占南京后制造南京大屠杀的暴行而筹建，是全国爱国主义教育示范基地。', '周二至周日 8:30-16:30', '025-86612230'),
(3, '沈阳九一八历史博物馆', '辽宁省沈阳市大东区望花南街46号', '辽宁', '沈阳', '为纪念九一八事变而修建的博物馆，通过大量文物、史料及多种展示手段反映了日本侵华历史和中国人民的抗日战争。', '周二至周日 9:00-16:30', '024-88338981'),
(4, '延安革命纪念馆', '陕西省延安市宝塔区王家坪路', '陕西', '延安', '全面展示了中共中央在延安十三年的光辉历程，包括抗日战争时期的历史。', '周二至周日 8:00-17:00', '0911-8213668');

-- --------------------------------------------------------

--
-- 表的结构 `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1765886236),
('m130524_201442_init', 1765886269),
('m190124_110200_add_verification_token_column_to_user_table', 1765886269),
('m251207_081508_create_group_table', 1765886281),
('m251211_000000_add_army_rank_to_hero', 1765886297),
('m251216_000000_fix_user_table', 1765886344);

-- --------------------------------------------------------

--
-- 表的结构 `timeline`
--

CREATE TABLE `timeline` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL COMMENT '日期',
  `title` varchar(255) NOT NULL COMMENT '事件标题',
  `description` text NOT NULL COMMENT '事件描述',
  `image` varchar(255) DEFAULT NULL COMMENT '事件图片',
  `related_battle_id` int(11) DEFAULT NULL COMMENT '关联战役',
  `related_hero_id` int(11) DEFAULT NULL COMMENT '关联英雄'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `timeline`
--

INSERT INTO `timeline` (`id`, `date`, `title`, `description`, `image`, `related_battle_id`, `related_hero_id`) VALUES
(1, '1931-09-18', '九一八事变', '日本关东军炸毁沈阳柳条湖南满铁路路轨，并嫁祸于中国军队，以此为借口炮轰沈阳北大营，次日占领沈阳，东北三省逐渐沦陷。', NULL, NULL, NULL),
(2, '1937-07-07', '七七事变', '日军在卢沟桥附近演习时借口士兵失踪，要求进入宛平城搜查被拒，遂炮轰宛平城，中国守军奋起抵抗，全面抗战爆发。', NULL, NULL, NULL),
(6, '1945-08-15', '日本宣布无条件投降', '日本天皇裕仁发布《终战诏书》，宣布无条件投降，中国人民抗日战争取得最终胜利。', NULL, NULL, NULL),
(7, '1905-01-01', '出生', '出生于河南省确山县李湾村。', NULL, NULL, 1),
(8, '1927-01-01', '加入中国共产党', '确山农民暴动领导人之一。', NULL, NULL, 1),
(9, '1940-01-01', '壮烈牺牲', '在吉林濛江三道崴子与日军激战中牺牲。', NULL, NULL, 1),
(10, '1901-01-01', '出生', '出生于河北省献县东辛庄一个回族农民家庭。', NULL, NULL, 2),
(11, '1938-01-01', '加入八路军', '率领回民义勇队参加八路军，改编为回民支队并任司令员，同年加入中国共产党。', NULL, NULL, 2),
(12, '1944-01-01', '病逝', '因积劳成疾，在山东省莘县不幸病逝。', NULL, NULL, 2),
(13, '1892-01-01', '出生', '出生于河北省高阳县边家坞村一个农民家庭。', NULL, NULL, 3),
(14, '1933-01-01', '参加抗日同盟军', '任察哈尔抗日同盟军第一军军长，率部收复多伦等地。', NULL, NULL, 3),
(15, '1937-01-01', '壮烈牺牲', '在北平南苑抗击日军的战斗中，重伤殉国。', NULL, NULL, 3),
(16, '1905-01-01', '出生', '出生于四川省宜宾市白花镇一个封建地主家庭。', NULL, NULL, 4),
(17, '1926-01-01', '加入中国共产党', '进入宜宾女子中学读书，积极参加革命活动，同年加入中国共产党。', NULL, NULL, 4),
(18, '1936-01-01', '壮烈牺牲', '在黑龙江省珠河县被日军杀害，英勇就义。', NULL, NULL, 4),
(19, '1905-01-01', '出生', '出生于湖南省醴陵县平侨乡黄茅岭一个贫苦农民家庭。', NULL, NULL, 5),
(20, '1925-01-01', '加入中国共产党', '考入黄埔军校一期，同年加入中国共产党，后参加北伐战争。', NULL, NULL, 5),
(21, '1942-01-01', '壮烈牺牲', '在山西省辽县麻田镇掩护总部突围时，中弹牺牲。', NULL, NULL, 5),
(22, '1915-01-01', '出生', '出生于福建省漳州市贫苦农家，幼年侨居印尼爪哇。', NULL, NULL, 6),
(23, '1936-01-01', '加入中国共产党', '赴北平参加抗日救亡运动，加入中国共产党。', NULL, NULL, 6),
(24, '1940-01-01', '壮烈牺牲', '在山西平鲁区荫凉山掩护突围时，中弹后自戕殉国。', NULL, NULL, 6),
(25, '1937-09-15', '部队开赴前线', '八路军115师奉命开赴平型关地区，准备对日军实施伏击作战。', NULL, NULL, NULL),
(26, '1937-09-23', '设伏待敌', '部队分路潜伏于平型关两侧山地要隘，严密侦察敌情。', NULL, NULL, NULL),
(27, '1937-09-25', '发起伏击', '日军车队与步兵纵队进入纵深伏击圈后，我军集中火力突然袭击，歼敌千余人。', NULL, NULL, NULL),
(28, '1938-01-15', '战前部署', '中国军队在徐州、台儿庄一线部署防御，准备与日军决战。', NULL, 3, NULL),
(29, '1938-03-23', '激烈攻防', '台儿庄城区及周边多次易手，中日双方爆发激烈巷战。', NULL, 3, NULL),
(30, '1938-04-07', '大捷告成', '中国军队多路合围，对日军实施反击，取得台儿庄大捷。', NULL, 3, NULL),
(31, '1940-07-22', '战役筹划', '八路军总部根据华北敌情与民情，制定大规模破袭作战计划。', NULL, 4, NULL),
(32, '1940-08-20', '第一阶段攻击', '集中兵力破袭正太路、同蒲路等交通线，摧毁大量桥梁和车站。', NULL, 4, NULL),
(33, '1940-10-06', '持续反“扫荡”', '各根据地部队继续袭击敌据点，同日军展开拉锯战，巩固和扩大根据地。', NULL, 4, NULL),
(34, '1937-09-15', '部队开赴前线', '八路军115师奉命开赴平型关地区，准备对日军实施伏击作战。', NULL, 2, NULL),
(35, '1937-09-23', '设伏待敌', '部队分路潜伏于平型关两侧山地要隘，严密侦察敌情。', NULL, 2, NULL),
(36, '1937-09-25', '发起伏击', '日军车队与步兵纵队进入纵深伏击圈后，我军集中火力突然袭击，歼敌千余人。', NULL, 2, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `profile` text DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL DEFAULT '',
  `password_reset_token` varchar(255) DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `updated_at` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='用户';

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `profile`, `auth_key`, `password_reset_token`, `verification_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@war-memorial.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '系统管理员', 'wR8N8ZXYKaX9bJh72vynad6HAketmxrZ', NULL, NULL, 10, 1765886315, 1765886315),
(2, 'researcher', 'research@war-memorial.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '历史研究员', 'wR8N8ZXYKaX9bJh72vynad6HAketmxrZ', NULL, NULL, 10, 1765886315, 1765886315),
(3, 'visitor', 'visitor@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '普通访客', 'wR8N8ZXYKaX9bJh72vynad6HAketmxrZ', NULL, NULL, 10, 1765886315, 1765886315),
(4, 'admin2', 'admin2@example.com', '$2y$13$M6eKuKqhuVBp553sP.OPn.RVqG/DRnMr.YcsAipPXJAX/DgNABdwu', NULL, 'FvJOAevJ6kNXIHhCNaUjmOM0BHAfIUb9', NULL, '5smtYJUhHpD0EBFO6UoezGF-A8O3Cwje_1765886329', 10, 1765886329, 1765886329);

--
-- 转储表的索引
--

--
-- 表的索引 `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category` (`category_id`),
  ADD KEY `idx_author` (`author_id`);

--
-- 表的索引 `battle`
--
ALTER TABLE `battle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_dates` (`start_date`,`end_date`);

--
-- 表的索引 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_parent` (`parent_id`);

--
-- 表的索引 `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `config_key` (`config_key`);

--
-- 表的索引 `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user` (`user_id`);

--
-- 表的索引 `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `historical_event`
--
ALTER TABLE `historical_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_event_date` (`event_date`);

--
-- 表的索引 `historical_relic`
--
ALTER TABLE `historical_relic`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `memorial_site`
--
ALTER TABLE `memorial_site`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- 表的索引 `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_battle` (`related_battle_id`),
  ADD KEY `idx_hero` (`related_hero_id`),
  ADD KEY `idx_date` (`date`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `battle`
--
ALTER TABLE `battle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `hero`
--
ALTER TABLE `hero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `historical_event`
--
ALTER TABLE `historical_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `historical_relic`
--
ALTER TABLE `historical_relic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `memorial_site`
--
ALTER TABLE `memorial_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 限制导出的表
--

--
-- 限制表 `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_author` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_article_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `timeline`
--
ALTER TABLE `timeline`
  ADD CONSTRAINT `fk_timeline_battle` FOREIGN KEY (`related_battle_id`) REFERENCES `battle` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_timeline_hero` FOREIGN KEY (`related_hero_id`) REFERENCES `hero` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
