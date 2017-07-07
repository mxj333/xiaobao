/*
Navicat MySQL Data Transfer

Source Server         : 192.168.33.100_3306
Source Server Version : 50549
Source Host           : 192.168.33.100:3306
Source Database       : cms

Target Server Type    : MYSQL
Target Server Version : 50549
File Encoding         : 65001

Date: 2016-07-17 16:34:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for acl_phinxlog
-- ----------------------------
DROP TABLE IF EXISTS `acl_phinxlog`;
CREATE TABLE `acl_phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of acl_phinxlog
-- ----------------------------
INSERT INTO `acl_phinxlog` VALUES ('20141229162641', 'DbAcl', '2016-06-13 16:54:15', '2016-06-13 16:54:15');

-- ----------------------------
-- Table structure for acos
-- ----------------------------
DROP TABLE IF EXISTS `acos`;
CREATE TABLE `acos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`,`rght`),
  KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of acos
-- ----------------------------

-- ----------------------------
-- Table structure for aros
-- ----------------------------
DROP TABLE IF EXISTS `aros`;
CREATE TABLE `aros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(11) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`,`rght`),
  KEY `alias` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aros
-- ----------------------------

-- ----------------------------
-- Table structure for aros_acos
-- ----------------------------
DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE `aros_acos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aro_id` int(11) NOT NULL,
  `aco_id` int(11) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `aro_id` (`aro_id`,`aco_id`),
  KEY `aco_id` (`aco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aros_acos
-- ----------------------------

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `column_id` int(11) unsigned DEFAULT '0',
  `art_title` varchar(50) DEFAULT '' COMMENT '标题',
  `art_url_alias` varchar(100) DEFAULT '' COMMENT 'URL别名',
  `art_body` text COMMENT '内容',
  `art_cover` varchar(60) NOT NULL DEFAULT '' COMMENT '文章封面名称（含后缀）',
  `art_cover_path` varchar(60) NOT NULL DEFAULT '' COMMENT '文章封面路径',
  `art_video` varchar(60) NOT NULL DEFAULT '' COMMENT '文章封面名称（含后缀）',
  `art_video_path` varchar(60) NOT NULL DEFAULT '' COMMENT '文章封面路径',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES ('43', '0', '1', 'test 上传封面', '', '<p>test 上传视频test 上传视频test 上传视频</p>', '578724a31015d.jpg', 'webroot/files/Articles/art_cover/2016/07/14', '', '', '2016-07-14 05:28:17', '2016-07-14 05:35:31');
INSERT INTO `articles` VALUES ('44', '0', '1', 'aaaaaaaaasdfdsf', '', '<p>150x120150x120150x120</p>', '578726e9d99e3.jpg', 'webroot/files/Articles/art_cover/2016/07/14', '', '', '2016-07-14 05:45:13', '2016-07-14 05:45:13');
INSERT INTO `articles` VALUES ('45', '0', '1', '区的李克勤=硒鼓', '', '<p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓区的李克勤=硒鼓</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/></p>', '/files/Articles/art_cover/2016/0714/thumbnail-/files/Article', 'webroot/files/Articles/art_cover/2016/0714', '5787a3d6ac6d6.jpg', '', '2016-07-14 14:23:57', '2016-07-14 15:37:41');
INSERT INTO `articles` VALUES ('46', '0', '3', '视频1', '', '<p>视频1</p>', '5787b3ac9d592.jpg', 'webroot/files/Articles/art_cover/2016/0714', '', '', '2016-07-14 15:39:41', '2016-07-14 15:45:48');
INSERT INTO `articles` VALUES ('47', '1', '4', '联系我们', 'contact_us', '<p>联系我们联系我们</p><p>联系我们联系我们联系我们联系我们联系我们</p><p>联系我们联系我们</p><p>联系我们</p><p>联系我们</p><p>关于我关于我</p>', '/files/Articles/art_cover/2016/0714/thumbnail-5787c44ae7179.', 'webroot/files/Articles/art_cover/2016/0714', '', '', '2016-07-14 16:56:42', '2016-07-16 15:58:42');
INSERT INTO `articles` VALUES ('49', '1', '3', '视频12视频12视频12视频12视频12视频12', '', '<p>视频12视频12视频12视频12视频12视频12视频12视频12视频12视频12视频12</p>', '/files/Articles/art_cover/2016/0716/thumbnail-/files/Article', 'webroot/files/Articles/art_cover/2016/0716', '5789c6c195f56.mp4', 'webroot/files/Articles/art_video/2016/0716', '2016-07-16 05:31:45', '2016-07-16 15:54:17');
INSERT INTO `articles` VALUES ('50', '1', '4', '关于我', 'about', '<p>北京德泉缘创始人简介<br/>姓名：刘德龙<br/>网名：泉海散人<br/>&nbsp;&nbsp;&nbsp;&nbsp; 中国收藏家协会会员<br/>&nbsp;&nbsp;&nbsp;&nbsp; 亚洲钱币鉴定中心特约顾问<br/>&nbsp;&nbsp;&nbsp;&nbsp; 美国PCGS&nbsp; NGC&nbsp; PMG 专业钱币鉴定机构授权经销商<br/>&nbsp;&nbsp;&nbsp;&nbsp; 国内各大评级公司授权经销商（GBCA、CNCS、源泰等评级公司）<br/>&nbsp;&nbsp;&nbsp;&nbsp; 北京“德泉缘”创建人刘德龙（泉海散人）长期代理美国PCGS ，是大陆北京地区唯一一位受到PCGS两位总裁亲自邀请，去美国评级总部考察访问的官方授权代理商，并且被官方授予为优秀代理商。经本人代理评级钱币不胜枚举，从业经验丰富 ，过程监管严格，每次送评不辞劳苦、不计成本，必亲力亲为，以保证每位泉友的利益及藏品的安全。在各位泉友多年的支持和信任下，成立了“北京德泉缘鉴定钱币牛X微拍群”，每周晚上19:30定期举办微信拍卖。此项工作也得到了PCGS总裁Don WiIIis 的高度认可 为了更好的为广大泉友提供服务。</p><p><iframe class=\"ueditor_baidumap\" src=\"http://192.168.33.100:8081/Js/ueditor/dialogs/map/show.html#center=116.390969,39.972323&zoom=17&width=530&height=340&markers=116.390969,39.972323&markerStyles=l,A\" frameborder=\"0\" height=\"344\" width=\"534\"></iframe></p>', '/thumbnail-http://placehold.it/150x120?text=ZenCMS.CN', '', '', '', '2016-07-16 14:53:04', '2016-07-16 15:51:23');
INSERT INTO `articles` VALUES ('51', '1', '1', '莫兹戈夫苛', '', '<p>材料<br/></p>', '578a5a11eb0d8.jpg', 'webroot/files/Articles/art_cover/2016/0716', '', '', '2016-07-16 16:00:17', '2016-07-16 16:00:17');
INSERT INTO `articles` VALUES ('52', '1', '1', '莫兹戈夫苛莫兹戈夫苛', 'mozigefukemozigefuke', '<p>莫兹戈夫苛莫兹戈夫苛莫兹戈夫苛莫兹戈夫苛莫兹戈夫苛</p>', '578a5bb47da49.jpg', 'webroot/files/Articles/art_cover/2016/0716', '', '', '2016-07-16 16:03:58', '2016-07-16 16:07:16');

-- ----------------------------
-- Table structure for articles_tags
-- ----------------------------
DROP TABLE IF EXISTS `articles_tags`;
CREATE TABLE `articles_tags` (
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`article_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of articles_tags
-- ----------------------------
INSERT INTO `articles_tags` VALUES ('33', '1');
INSERT INTO `articles_tags` VALUES ('40', '2');

-- ----------------------------
-- Table structure for attachments
-- ----------------------------
DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments` (
  `id` int(11) NOT NULL,
  `product_id` int(11) unsigned DEFAULT '0' COMMENT '商品ID',
  `at_name` varchar(50) DEFAULT '' COMMENT '图片名称',
  `at_description` varchar(500) DEFAULT '' COMMENT '图片描述',
  `at_sort` tinyint(4) unsigned DEFAULT '0' COMMENT '排序',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of attachments
-- ----------------------------

-- ----------------------------
-- Table structure for attributes
-- ----------------------------
DROP TABLE IF EXISTS `attributes`;
CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of attributes
-- ----------------------------

-- ----------------------------
-- Table structure for categori1212es
-- ----------------------------
DROP TABLE IF EXISTS `categori1212es`;
CREATE TABLE `categori1212es` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` text NOT NULL,
  `slug` text NOT NULL,
  `metadescription` text NOT NULL,
  `metakeywords` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categori1212es
-- ----------------------------

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', '0', '1', '30', 'My Categories');
INSERT INTO `categories` VALUES ('2', '1', '2', '15', 'Fun');
INSERT INTO `categories` VALUES ('3', '2', '3', '8', 'Sport');
INSERT INTO `categories` VALUES ('4', '3', '4', '5', 'Surfing');
INSERT INTO `categories` VALUES ('5', '3', '6', '7', 'Extreme knitting');
INSERT INTO `categories` VALUES ('6', '2', '9', '14', 'Friends');
INSERT INTO `categories` VALUES ('7', '6', '10', '11', 'Gerald');
INSERT INTO `categories` VALUES ('8', '6', '12', '13', 'Gwendolyn');
INSERT INTO `categories` VALUES ('9', '1', '16', '29', 'Work');
INSERT INTO `categories` VALUES ('10', '9', '17', '22', 'Reports');
INSERT INTO `categories` VALUES ('11', '10', '18', '19', 'Annual');
INSERT INTO `categories` VALUES ('12', '10', '20', '21', 'Status');
INSERT INTO `categories` VALUES ('13', '9', '23', '28', 'Trips');
INSERT INTO `categories` VALUES ('14', '13', '24', '25', 'National');
INSERT INTO `categories` VALUES ('15', '13', '26', '27', 'International');

-- ----------------------------
-- Table structure for columns
-- ----------------------------
DROP TABLE IF EXISTS `columns`;
CREATE TABLE `columns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT '',
  `typt` tinyint(4) DEFAULT '1' COMMENT '文章模型：1文章，2图文，3产品，4视频，5单页',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of columns
-- ----------------------------
INSERT INTO `columns` VALUES ('1', '0', '1', '2', '新闻', '1');
INSERT INTO `columns` VALUES ('2', '0', '3', '4', '钱币', '2');
INSERT INTO `columns` VALUES ('3', '0', '5', '6', '视频', '4');
INSERT INTO `columns` VALUES ('4', '0', '7', '8', '单页', '9');

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'Administrator', '2016-06-13 12:51:25', '2016-06-13 12:51:25');
INSERT INTO `groups` VALUES ('2', 'Manager', '2016-06-13 12:51:40', '2016-06-13 12:51:40');
INSERT INTO `groups` VALUES ('3', 'User', '2016-06-13 12:51:49', '2016-06-13 12:51:49');

-- ----------------------------
-- Table structure for managements
-- ----------------------------
DROP TABLE IF EXISTS `managements`;
CREATE TABLE `managements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `structure_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '结构表ID',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `label` varchar(20) NOT NULL DEFAULT '' COMMENT '中文显示',
  `icon` varchar(20) DEFAULT NULL,
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '外链地址',
  `target` varchar(20) NOT NULL DEFAULT '' COMMENT '打开目标窗口',
  `weight` tinyint(4) unsigned DEFAULT '0' COMMENT '权重',
  `status` tinyint(4) unsigned DEFAULT '1' COMMENT '1，启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of managements
-- ----------------------------
INSERT INTO `managements` VALUES ('1', '1', 'dashboards', '仪表盘', 'fa fa-tachometer', '', '', '0', '1');
INSERT INTO `managements` VALUES ('2', '2', 'articles', '内容管理', 'fa fa-pencil fa-fw', '', '', '1', '1');
INSERT INTO `managements` VALUES ('3', '3', 'users', '用户管理', 'fa fa-user', '', '', '0', '1');
INSERT INTO `managements` VALUES ('4', '3', 'groups', '用户组管理', 'fa fa-users', '', '', '1', '1');
INSERT INTO `managements` VALUES ('5', '4', 'roles', '权限控制', 'fa fa-cog fa-fw', '', '', '9', '1');
INSERT INTO `managements` VALUES ('6', '4', 'taxonomys', '分类管理', 'fa fa-certificate', '', '', '1', '1');
INSERT INTO `managements` VALUES ('7', '5', 'configs', '系统配置', 'fa fa-cog fa-fw', '', '', '9', '1');
INSERT INTO `managements` VALUES ('8', '4', 'structures', '结构管理', 'fa fa-gg', '', '', '0', '1');
INSERT INTO `managements` VALUES ('9', '4', 'managements', '菜单管理', 'fa fa-bars', '', '', '1', '1');
INSERT INTO `managements` VALUES ('10', '5', 'caches', '缓存管理', 'fa fa-fire-extinguis', '', '', '0', '1');
INSERT INTO `managements` VALUES ('11', '2', 'columns', '栏目管理', 'fa fa-pencil fa-fw', '', '', '1', '1');
INSERT INTO `managements` VALUES ('12', '4', 'navigations', '导航管理', 'fa fa-pencil fa-fw', '', '', '0', '1');

-- ----------------------------
-- Table structure for models
-- ----------------------------
DROP TABLE IF EXISTS `models`;
CREATE TABLE `models` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `m_name` varchar(30) NOT NULL COMMENT '英文名',
  `m_title` varchar(100) NOT NULL COMMENT '中文名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of models
-- ----------------------------
INSERT INTO `models` VALUES ('1', 'article', '文章');
INSERT INTO `models` VALUES ('2', 'pic', '图片');
INSERT INTO `models` VALUES ('3', 'video', '视频');
INSERT INTO `models` VALUES ('4', 'product', '产品');

-- ----------------------------
-- Table structure for navigations
-- ----------------------------
DROP TABLE IF EXISTS `navigations`;
CREATE TABLE `navigations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(30) NOT NULL,
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '链接',
  `target` varchar(10) NOT NULL DEFAULT '' COMMENT '目标窗口',
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of navigations
-- ----------------------------
INSERT INTO `navigations` VALUES ('1', '0', '首页', '/', '', '1');
INSERT INTO `navigations` VALUES ('2', '0', '公司简介', '/pages/about', '', '2');
INSERT INTO `navigations` VALUES ('3', '0', '公司新闻', '/articles', '', '3');
INSERT INTO `navigations` VALUES ('4', '0', '钱币专区', '/product', '', '4');
INSERT INTO `navigations` VALUES ('5', '0', '联系我们', '/pages/contact_us', '', '8');
INSERT INTO `navigations` VALUES ('6', '0', '精彩视频', 'video/25/jingcaishipin', '', '5');
INSERT INTO `navigations` VALUES ('7', '0', '资格证书', '/credentials', '', '6');

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('1', '关于我', 'about', '<p><strong>北京德泉缘创始人简介</strong><br />姓名：刘德龙<br />网名：泉海散人<br />&nbsp;&nbsp;&nbsp;&nbsp; 中国收藏家协会会员<br />&nbsp;&nbsp;&nbsp;&nbsp; 亚洲钱币鉴定中心特约顾问<br />&nbsp;&nbsp;&nbsp;&nbsp; 美国PCGS&nbsp; NGC&nbsp; PMG 专业钱币鉴定机构授权经销商<br />&nbsp;&nbsp;&nbsp;&nbsp; 国内各大评级公司授权经销商（GBCA、CNCS、源泰等评级公司）<br />&nbsp;&nbsp;&nbsp;&nbsp; 北京&ldquo;德泉缘&rdquo;创建人刘德龙（泉海散人）长期代理美国PCGS ，是大陆北京地区唯一一位受到PCGS两位总裁亲自邀请，去美国评级总部考察访问的官方授权代理商，并且被官方授予为优秀代理商。经本人代理评级钱币不胜枚举，从业经验丰富 ，过程监管严格，每次送评不辞劳苦、不计成本，必亲力亲为，以保证每位泉友的利益及藏品的安全。在各位泉友多年的支持和信任下，成立了&ldquo;北京德泉缘鉴定钱币牛X微拍群&rdquo;，每周晚上19:30定期举办微信拍卖。此项工作也得到了PCGS总裁Don WiIIis 的高度认可 为了更好的为广大泉友提供服务。</p>');
INSERT INTO `pages` VALUES ('2', '荣誉证书', 'certificate', '<p>荣誉证书</p>');
INSERT INTO `pages` VALUES ('3', '联系我们', 'contact_us', '<p>北京德泉缘古钱币艺术品鉴定有限公司</p>\r\n<ul>\r\n<li>13910061888</li>\r\n<li>13051661888</li>\r\n<li>13391630789</li>\r\n<li>传真：010-86355678</li>\r\n<li>地址：北京市西城区广安门内大街报国寺1号文化市场西二院B11室</li>\r\n<li>联系人：刘德龙</li>\r\n</ul>');

-- ----------------------------
-- Table structure for product_types
-- ----------------------------
DROP TABLE IF EXISTS `product_types`;
CREATE TABLE `product_types` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `pt_type` varchar(50) DEFAULT '' COMMENT '型号',
  `pt_code` varchar(20) DEFAULT NULL,
  `pt_price` varchar(10) DEFAULT '' COMMENT '价格',
  `pt_stock` int(11) unsigned DEFAULT '0' COMMENT '库存数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_types
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT '0' COMMENT '用户ID',
  `category_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `p_title` varchar(90) NOT NULL DEFAULT '' COMMENT '商品名称',
  `p_body` text NOT NULL COMMENT '描述',
  `p_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态0未发布，1发布，9下架',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', '1', '10', '船长est', 'sdfasdfasdf', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Administrator', '2016-06-13 12:51:25', '2016-06-13 12:51:25');
INSERT INTO `roles` VALUES ('2', 'Manager', '2016-06-13 12:51:40', '2016-06-13 12:51:40');
INSERT INTO `roles` VALUES ('3', 'User', '2016-06-13 12:51:49', '2016-06-13 12:51:49');

-- ----------------------------
-- Table structure for structures
-- ----------------------------
DROP TABLE IF EXISTS `structures`;
CREATE TABLE `structures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '' COMMENT '名称',
  `label` varchar(20) NOT NULL DEFAULT '' COMMENT '中文显示',
  `icon` varchar(20) DEFAULT '' COMMENT 'calss名',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '外链地址',
  `target` varchar(20) NOT NULL DEFAULT '' COMMENT '打开目标窗口',
  `weight` tinyint(4) unsigned DEFAULT '0' COMMENT '权重',
  `status` tinyint(4) unsigned DEFAULT '1' COMMENT '1,启用,',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of structures
-- ----------------------------
INSERT INTO `structures` VALUES ('1', 'index', '首页', 'fa fa-home', './index.php', '', '0', '1');
INSERT INTO `structures` VALUES ('2', 'content', '内容', 'fa fa-pencil fa-fw', './content.php', '', '1', '1');
INSERT INTO `structures` VALUES ('3', 'users', '用户', 'fa fa-user', './users.php', '', '2', '1');
INSERT INTO `structures` VALUES ('4', 'basic_configuration', '基础', 'fa fa-certificate', './basic_configuration.php', '', '3', '1');
INSERT INTO `structures` VALUES ('5', 'system_management', '系统', 'fa fa-cog fa-fw', './system_management.php', '', '4', '1');

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('1', '融水', null, null);
INSERT INTO `tags` VALUES ('2', '苗族', null, null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT '' COMMENT '邮箱',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '$2y$10$e.x.Te0X7imRO50837GQX.U3Z3ePf1aaxI28ZbQsdN3cmxc1TLhum', '1', 'admin', null, null, '', '0', '2016-07-05 23:23:22', '2016-07-05 23:23:22');

-- ----------------------------
-- Table structure for users__
-- ----------------------------
DROP TABLE IF EXISTS `users__`;
CREATE TABLE `users__` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `group_id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `email` varchar(100) DEFAULT '' COMMENT '邮箱',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users__
-- ----------------------------
INSERT INTO `users__` VALUES ('1', 'admin', '$2y$10$ZOa7SWfRsZpuLDmPZJ9lg.hj2yzNdkoISC96vuI24n6', '1', 'header.png', '/webroot/files/Users/photo/1/1', '2016-02-09 18:23:48', '2016-06-17 17:54:08', null, '1');
INSERT INTO `users__` VALUES ('2', 'manage', 'manage', '2', 'cover2.jpg', '/webroot/files/Users/photo/2/2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null, '0');
INSERT INTO `users__` VALUES ('3', 'user', 'user', '3', 'qrCode.png', 'webroot/files/Users/photo/3/3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null, '0');
INSERT INTO `users__` VALUES ('4', 'test', '$2y$10$6sXbPvL2pOcvhy0a7HcozenpPPZ6OhXoYG5XZ0EEZIx', '3', '1', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', null, '0');
INSERT INTO `users__` VALUES ('5', 'mxj', '$2y$10$ZOa7SWfRsZpuLDmPZJ9lg.hj2yzNdkoISC96vuI24n6', '1', '1', '11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'me@example.com', '1');

-- ----------------------------
-- Table structure for widgets
-- ----------------------------
DROP TABLE IF EXISTS `widgets`;
CREATE TABLE `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `part_no` varchar(12) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of widgets
-- ----------------------------
