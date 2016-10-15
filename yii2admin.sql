-- phpMyAdmin SQL Dump
-- version 4.4.15.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-10-15 11:13:43
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2admin`
--

-- --------------------------------------------------------

--
-- 表的结构 `yii2_ad`
--

CREATE TABLE IF NOT EXISTS `yii2_ad` (
  `id` int(8) NOT NULL,
  `type` tinyint(3) NOT NULL COMMENT '类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `image` varchar(255) NOT NULL COMMENT '图片路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '跳转地址',
  `sort` int(5) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='图片广告';

--
-- 转存表中的数据 `yii2_ad`
--

INSERT INTO `yii2_ad` (`id`, `type`, `title`, `image`, `url`, `sort`, `status`) VALUES
(1, 1, '测试广告1', '/storage/web/image/201610/1476337725186.jpg', 'http://www.imhaigui.com', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_admin`
--

CREATE TABLE IF NOT EXISTS `yii2_admin` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(60) NOT NULL COMMENT '密码',
  `salt` char(32) NOT NULL COMMENT '密码干扰字符',
  `email` char(32) NOT NULL COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL DEFAULT '' COMMENT '用户手机',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态 1正常 0禁用'
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `yii2_admin`
--

INSERT INTO `yii2_admin` (`uid`, `username`, `password`, `salt`, `email`, `mobile`, `reg_time`, `reg_ip`, `last_login_time`, `last_login_ip`, `update_time`, `status`) VALUES
(1, 'admin', '$2y$13$0UVcG.mXF6Og0rnjfwJd2.wixT2gdn.wDO9rN44jGtIGc6JvBqR7i', 'SbSY36BLw3V2lU-GB7ZAzCVJKDFx82IJ', 'phphome111@qq.com', '13565231112', 1457922160, 2130706433, 1457922174, 2130706433, 1476437014, 1),
(2, 'feifei', '$2y$13$jqWGlVo8T3qtnWUX0kTX/ON5ctvokzkQ7RAvKuNRjN.WvxgBlFK4u', 'tzDsmCSLbtktnvbgn1YeEqslYOBo1Cn9', 'php11111@qq.com', '13631568985', 1458028401, 2130706433, 1458028401, 2130706433, 1468230085, 1),
(6, 'guanli', '$2y$13$QK.CEi7HHuTSIMbq5RbzeOfTNgrX8mUTl/noBkHtD/zKEf7y.SQO6', '_4F9_ptxkohU247kgi7UB4rg3UMYqo14', 'phphome222@qq.com', '13565656565', 1476438209, 2130706433, 0, 2130706433, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_article`
--

CREATE TABLE IF NOT EXISTS `yii2_article` (
  `id` int(10) unsigned NOT NULL COMMENT '文档ID',
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类',
  `name` char(40) NOT NULL DEFAULT '' COMMENT '标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
  `cover` varchar(255) NOT NULL DEFAULT '' COMMENT '封面',
  `description` char(140) NOT NULL DEFAULT '' COMMENT '描述',
  `content` text NOT NULL COMMENT '内容',
  `extend` text COMMENT '扩展内容array',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '内容类型',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '推荐位',
  `link` varchar(255) NOT NULL DEFAULT '' COMMENT '外链',
  `sort` int(4) NOT NULL DEFAULT '0' COMMENT '排序值',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态'
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='文章表';

--
-- 转存表中的数据 `yii2_article`
--

INSERT INTO `yii2_article` (`id`, `category_id`, `name`, `title`, `cover`, `description`, `content`, `extend`, `type`, `position`, `link`, `sort`, `create_time`, `update_time`, `status`) VALUES
(3, 1, 'jieshao', '帆海汇介绍', '/storage/web/image/201610/1476271990704.jpg', '帆海汇介绍', '<p><img src="/storage/web/image/201610/1476271961130042.png" title="1476271961130042.png" alt="icon_nav_button.png"/></p>', '', 2, 0, '', 0, 1473606822, 1476272167, 1),
(2, 1, 'aboutus', '关于我们', '/upload/image/201609/1473606655946.png', '关于我们', '<p>这里是关于我们的内容</p>', 'a:4:{i:1;s:3:"222";i:3;s:4:"3434";i:6;s:5:"sdfsa";s:1:"s";s:4:"sdsf";}', 2, 0, '', 0, 1472611249, 1473606779, 1),
(4, 1, 'julebu', '帆船俱乐部', '', '帆船俱乐部', '<p>帆船俱乐部帆船俱乐部帆船俱乐部帆船俱乐部帆船俱乐部帆船俱乐部帆船俱乐部</p>', '', 2, 0, '', 0, 1473606857, 0, 1),
(5, 1, 'peixun', '培训中心', '', '培训中心', '<p>培训中心培训中心培训中心培训中心培训中心培训中心培训中心培训中心培训中心培训中心培训中心</p>', '', 2, 0, '', 0, 1473606890, 0, 1),
(6, 1, 'lianxi', '联系我们', '', '联系我们', '<p>联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们联系我们</p>', '', 2, 0, '', 0, 1473606916, 0, 1),
(7, 1, 'hezuo', '合作伙伴', '', '合作伙伴', '<p>合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴</p>', '', 2, 0, '', 0, 1473606940, 0, 1),
(8, 3, '', '活动内容1111111', '', '活动内容1111111', '<p>活动内容1111111活动内容1111111活动内容1111111活动内容1111111活动内容1111111活动内容1111111活动内容1111111活动内容1111111</p>', '', 2, 0, '', 0, 1473607011, 1473608688, 1),
(9, 3, '', '活动内容222222', '', '活动内容222222', '<p>活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222活动内容222222</p>', '', 2, 0, '', 0, 1473607032, 1473608697, 1),
(10, 3, '', '活动内容333333', '201610/1476520935829.jpg', '活动内容333333', '<p>活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333活动内容333333</p>', '', 2, 0, '', 0, 1473607048, 1476520939, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_auth_assignment`
--

CREATE TABLE IF NOT EXISTS `yii2_auth_assignment` (
  `item_name` varchar(64) NOT NULL COMMENT '角色名称 role',
  `user_id` varchar(64) NOT NULL COMMENT '用户ID',
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `yii2_auth_assignment`
--

INSERT INTO `yii2_auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrator', '1', 1476437918),
('administrator', '4', 1460012730),
('administrator', '6', 1476438227),
('editor', '2', 1476437926);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_auth_item`
--

CREATE TABLE IF NOT EXISTS `yii2_auth_item` (
  `name` varchar(64) NOT NULL COMMENT '角色或权限名称',
  `type` int(11) NOT NULL COMMENT '1角色 2权限',
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `yii2_auth_item`
--

INSERT INTO `yii2_auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('action/actionlog', 2, '', 'action/actionlog', '', 1460031880, 1460031880),
('action/edit', 2, '', 'action/edit', '', 1460031880, 1460031880),
('ad/add', 2, NULL, 'ad/add', NULL, 1476437984, 1476437984),
('ad/delete', 2, NULL, 'ad/delete', NULL, 1476437984, 1476437984),
('ad/edit', 2, NULL, 'ad/edit', NULL, 1476437984, 1476437984),
('ad/index', 2, NULL, 'ad/index', NULL, 1476437984, 1476437984),
('Addons/addHook', 2, NULL, 'Addons/addHook', NULL, 1472528088, 1472528088),
('Addons/adminList', 2, NULL, 'Addons/adminList', NULL, 1472528088, 1472528088),
('Addons/edithook', 2, NULL, 'Addons/edithook', NULL, 1472528088, 1472528088),
('Addons/execute', 2, NULL, 'Addons/execute', NULL, 1472528088, 1472528088),
('Addons/hooks', 2, NULL, 'Addons/hooks', NULL, 1472528088, 1472528088),
('Addons/index', 2, '', 'Addons/index', '', 1460030539, 1460030539),
('admin/add', 2, NULL, 'admin/add', NULL, 1472528089, 1472528089),
('admin/auth', 2, NULL, 'admin/auth', NULL, 1472528089, 1472528089),
('admin/edit', 2, NULL, 'admin/edit', NULL, 1472528089, 1472528089),
('admin/index', 2, NULL, 'admin/index', NULL, 1472528089, 1472528089),
('administrator', 1, 'administrator角色12', NULL, NULL, 1465352150, 1476446363),
('article/add', 2, '', 'article/add', '', 1460027926, 1460027926),
('article/autoSave', 2, '', 'article/autoSave', '', 1460027926, 1460027926),
('article/batchOperate', 2, '', 'article/batchOperate', '', 1460027926, 1460027926),
('article/clear', 2, '', 'article/clear', '', 1460027927, 1460027927),
('article/copy', 2, '', 'article/copy', '', 1460027926, 1460027926),
('article/edit', 2, '', 'article/edit', '', 1460027926, 1460027926),
('Article/examine', 2, '', 'Article/examine', '', 1460027927, 1460027927),
('article/index', 2, '', 'article/index', '', 1460027926, 1460027926),
('article/move', 2, '', 'article/move', '', 1460027926, 1460027926),
('article/paste', 2, '', 'article/paste', '', 1460027926, 1460027926),
('article/permit', 2, '', 'article/permit', '', 1460027927, 1460027927),
('article/recycle', 2, '', 'article/recycle', '', 1460027927, 1460027927),
('article/setStatus', 2, '', 'article/setStatus', '', 1460027926, 1460027926),
('Article/sort', 2, '', 'Article/sort', '', 1460027927, 1460027927),
('article/update', 2, '', 'article/update', '', 1460027926, 1460027926),
('attribute/add', 2, '', 'attribute/add', '', 1460031881, 1460031881),
('attribute/edit', 2, '', 'attribute/edit', '', 1460031881, 1460031881),
('attribute/index1', 2, '', 'attribute/index1', '', 1460031881, 1460031881),
('attribute/setStatus', 2, '', 'attribute/setStatus', '', 1460031881, 1460031881),
('attribute/update', 2, '', 'attribute/update', '', 1460031881, 1460031881),
('auth/access', 2, '', 'auth/access', '', 1460031879, 1460031879),
('auth/add', 2, NULL, 'auth/add', NULL, 1472528089, 1472528089),
('auth/addToCategory', 2, '', 'auth/addToCategory', '', 1460031880, 1460031880),
('auth/addToGroup', 2, '', 'auth/addToGroup', '', 1460031880, 1460031880),
('auth/addToModel', 2, '', 'auth/addToModel', '', 1460031880, 1460031880),
('auth/auth', 2, '', 'auth/auth', '', 1460031879, 1460031879),
('auth/category', 2, '', 'auth/category', '', 1460031880, 1460031880),
('auth/changeStatus?method=deleteGroup', 2, '', 'auth/changeStatus?method=deleteGroup', '', 1460031879, 1460031879),
('auth/changeStatus?method=forbidGroup', 2, '', 'auth/changeStatus?method=forbidGroup', '', 1460031879, 1460031879),
('auth/changeStatus?method=resumeGroup', 2, '', 'auth/changeStatus?method=resumeGroup', '', 1460031879, 1460031879),
('auth/createGroup', 2, '', 'auth/createGroup', '', 1460031879, 1460031879),
('auth/delete', 2, NULL, 'auth/delete', NULL, 1472528089, 1472528089),
('auth/edit', 2, NULL, 'auth/edit', NULL, 1472528089, 1472528089),
('auth/editGroup', 2, '', 'auth/editGroup', '', 1460031879, 1460031879),
('auth/index', 2, '', 'auth/index', '', 1200000000, 1300000000),
('auth/modelauth', 2, '', 'auth/modelauth', '', 1460031880, 1460031880),
('auth/removeFromGroup', 2, '', 'auth/removeFromGroup', '', 1460031880, 1460031880),
('auth/user', 2, '', 'auth/user', '', 1460031880, 1460031880),
('auth/writeGroup', 2, '', 'auth/writeGroup', '', 1460031879, 1460031879),
('category/add', 2, '', 'category/add', '', 1460031882, 1460031882),
('category/edit', 2, '', 'category/edit', '', 1460031882, 1460031882),
('category/index', 2, '', 'category/index', '', 1460031882, 1460031882),
('category/operate/type/merge', 2, '', 'category/operate/type/merge', '', 1460031882, 1460031882),
('category/operate/type/move', 2, '', 'category/operate/type/move', '', 1460031882, 1460031882),
('category/remove', 2, '', 'category/remove', '', 1460031882, 1460031882),
('certificate/delete', 2, NULL, 'certificate/delete', NULL, 1476437984, 1476437984),
('certificate/edit', 2, NULL, 'certificate/edit', NULL, 1476437983, 1476437983),
('certificate/index', 2, NULL, 'certificate/index', NULL, 1476437983, 1476437983),
('channel/add', 2, '', 'channel/add', '', 1460031884, 1460031884),
('channel/del', 2, '', 'channel/del', '', 1460031885, 1460031885),
('channel/edit', 2, '', 'channel/edit', '', 1460031884, 1460031884),
('channel/index', 2, '', 'channel/index', '', 1460031884, 1460031884),
('config/add', 2, '', 'config/add', '', 1460031883, 1460031883),
('config/del', 2, '', 'config/del', '', 1460031883, 1460031883),
('config/edit', 2, '', 'config/edit', '', 1460031883, 1460031883),
('config/group', 2, '', 'config/group', '', 1452653200, 1452653210),
('config/index', 2, '', 'config/index', '', 1452653200, 1452653210),
('config/save', 2, '', 'config/save', '', 1460031883, 1460031883),
('Config/sort', 2, '', 'Config/sort', '', 1460031884, 1460031884),
('database/del', 2, '', 'database/del', '', 1460031882, 1460031882),
('database/export', 2, '', 'database/export', '', 1460031881, 1460031881),
('database/import', 2, '', 'database/import', '', 1460031882, 1460031882),
('database/index?type=export', 2, '数据库导出', 'database/index?type=export', '', 120000000, 130000000),
('database/index?type=import', 2, '数据库导入', 'database/index?type=import', '', 1200000000, 1300000000),
('database/optimize', 2, '', 'database/optimize', '', 1460031881, 1460031881),
('database/repair', 2, '', 'database/repair', '', 1460031881, 1460031881),
('editor', 1, 'editor 网站编辑角色', NULL, '', 1356232000, 1400000000),
('group/add', 2, NULL, 'group/add', NULL, 1476437986, 1476437986),
('group/delete', 2, NULL, 'group/delete', NULL, 1476437986, 1476437986),
('group/edit', 2, NULL, 'group/edit', NULL, 1476437986, 1476437986),
('group/index', 2, NULL, 'group/index', NULL, 1476437986, 1476437986),
('index/index', 2, '', 'index/index', '', 1356542542, 1425652320),
('log/index', 2, NULL, 'log/index', NULL, 1472528090, 1472528090),
('log/view', 2, NULL, 'log/view', NULL, 1472528090, 1472528090),
('login/logout', 2, '', 'login/logout', '', 1356565230, 1452653210),
('menu/add', 2, '', 'menu/add', '', 1460031884, 1460031884),
('menu/edit', 2, '', 'menu/edit', '', 1460031884, 1460031884),
('Menu/import', 2, '', 'Menu/import', '', 1460031884, 1460031884),
('menu/index', 2, '', 'menu/index', '', 1452653200, 1452653210),
('Menu/sort', 2, '', 'Menu/sort', '', 1460031884, 1460031884),
('model/add', 2, '', 'model/add', '', 1460031882, 1460031882),
('model/edit', 2, '', 'model/edit', '', 1460031883, 1460031883),
('Model/generate', 2, '', 'Model/generate', '', 1460031019, 1460031019),
('Model/index', 2, '', 'Model/index', '', 1460031882, 1460031882),
('model/setStatus', 2, '', 'model/setStatus', '', 1460031883, 1460031883),
('model/update', 2, '', 'model/update', '', 1460031883, 1460031883),
('order/add', 2, NULL, 'order/add', NULL, 1476438050, 1476438050),
('order/delete', 2, NULL, 'order/delete', NULL, 1476438050, 1476438050),
('order/edit', 2, NULL, 'order/edit', NULL, 1476438049, 1476438049),
('order/index', 2, NULL, 'order/index', NULL, 1472528088, 1472528088),
('other', 2, NULL, 'other', NULL, 1472528090, 1472528090),
('shop/add', 2, NULL, 'shop/add', NULL, 1476437985, 1476437985),
('shop/delete', 2, NULL, 'shop/delete', NULL, 1476437985, 1476437985),
('shop/edit', 2, NULL, 'shop/edit', NULL, 1476437985, 1476437985),
('shop/group', 2, NULL, 'shop/group', NULL, 1472528088, 1472528088),
('shop/index&type=1', 2, NULL, 'shop/index&type=1', NULL, 1472528087, 1472528087),
('shop/index&type=2', 2, NULL, 'shop/index&type=2', NULL, 1472528087, 1472528087),
('shop/index&type=3', 2, NULL, 'shop/index&type=3', NULL, 1472528087, 1472528087),
('shop/index&type=4', 2, NULL, 'shop/index&type=4', NULL, 1472528088, 1472528088),
('shop/index?type=1', 2, NULL, 'shop/index?type=1', NULL, 1476437985, 1476437985),
('shop/index?type=2', 2, NULL, 'shop/index?type=2', NULL, 1476437986, 1476437986),
('shop/index?type=3', 2, NULL, 'shop/index?type=3', NULL, 1476437986, 1476437986),
('shop/index?type=4', 2, NULL, 'shop/index?type=4', NULL, 1476437986, 1476437986),
('think/add', 2, '', 'think/add', '', 1460031883, 1460031883),
('think/edit', 2, '', 'think/edit', '', 1460031019, 1460031019),
('think/lists', 2, '', 'think/lists', '', 1460031020, 1460031020),
('train/add', 2, NULL, 'train/add', NULL, 1476437985, 1476437985),
('train/delete', 2, NULL, 'train/delete', NULL, 1476437984, 1476437984),
('train/edit', 2, NULL, 'train/edit', NULL, 1476437984, 1476437984),
('train/index', 2, NULL, 'train/index', NULL, 1472528088, 1472528088),
('traintype/delete', 2, NULL, 'traintype/delete', NULL, 1476437984, 1476437984),
('traintype/edit', 2, NULL, 'traintype/edit', NULL, 1476437984, 1476437984),
('traintype/index', 2, NULL, 'traintype/index', NULL, 1476437984, 1476437984),
('user/action', 2, '', 'user/action', '', 1460031878, 1460031878),
('user/add', 2, '', 'user/add', '', 1460031878, 1460031878),
('user/addaction', 2, '', 'user/addaction', '', 1460031878, 1460031878),
('user/auth', 2, '', 'user/auth', '', 1460031878, 1460031878),
('User/changeStatus?method=deleteUser', 2, '', 'User/changeStatus?method=deleteUser', '', 1460031879, 1460031879),
('user/changeStatus?method=forbidUser', 2, '', 'user/changeStatus?method=forbidUser', '', 1460031878, 1460031878),
('user/changeStatus?method=resumeUser', 2, '', 'user/changeStatus?method=resumeUser', '', 1460031878, 1460031878),
('user/delete', 2, NULL, 'user/delete', NULL, 1476438050, 1476438050),
('user/edit', 2, NULL, 'user/edit', NULL, 1476438051, 1476438051),
('user/editaction', 2, '', 'user/editaction', '', 1460031878, 1460031878),
('user/index', 2, '', 'user/index', '', 1200000000, 1230000000),
('user/saveAction', 2, '', 'user/saveAction', '', 1460031878, 1460031878),
('user/setStatus', 2, '', 'user/setStatus', '', 1460031878, 1460031878),
('user/updateNickname', 2, '', 'user/updateNickname', '', 1460031881, 1460031881),
('user/updatePassword', 2, '', 'user/updatePassword', '', 1460031881, 1460031881);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_auth_item_child`
--

CREATE TABLE IF NOT EXISTS `yii2_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `yii2_auth_item_child`
--

INSERT INTO `yii2_auth_item_child` (`parent`, `child`) VALUES
('administrator', 'ad/add'),
('editor', 'ad/add'),
('administrator', 'ad/delete'),
('editor', 'ad/delete'),
('administrator', 'ad/edit'),
('editor', 'ad/edit'),
('administrator', 'ad/index'),
('editor', 'ad/index'),
('administrator', 'admin/index'),
('administrator', 'article/add'),
('editor', 'article/add'),
('administrator', 'article/autoSave'),
('editor', 'article/autoSave'),
('administrator', 'article/clear'),
('editor', 'article/clear'),
('administrator', 'article/edit'),
('editor', 'article/edit'),
('administrator', 'article/index'),
('editor', 'article/index'),
('administrator', 'article/move'),
('editor', 'article/move'),
('administrator', 'article/permit'),
('editor', 'article/permit'),
('administrator', 'article/recycle'),
('editor', 'article/recycle'),
('administrator', 'article/setStatus'),
('editor', 'article/setStatus'),
('administrator', 'article/update'),
('editor', 'article/update'),
('administrator', 'attribute/add'),
('administrator', 'attribute/edit'),
('administrator', 'attribute/index1'),
('administrator', 'attribute/setStatus'),
('administrator', 'attribute/update'),
('administrator', 'auth/index'),
('administrator', 'category/add'),
('editor', 'category/add'),
('administrator', 'category/edit'),
('editor', 'category/edit'),
('administrator', 'category/index'),
('editor', 'category/index'),
('administrator', 'category/operate/type/merge'),
('editor', 'category/operate/type/merge'),
('administrator', 'category/operate/type/move'),
('administrator', 'category/remove'),
('editor', 'category/remove'),
('administrator', 'certificate/delete'),
('editor', 'certificate/delete'),
('administrator', 'certificate/edit'),
('editor', 'certificate/edit'),
('administrator', 'certificate/index'),
('editor', 'certificate/index'),
('administrator', 'config/add'),
('administrator', 'config/del'),
('administrator', 'config/edit'),
('administrator', 'config/group'),
('administrator', 'config/index'),
('administrator', 'config/save'),
('administrator', 'Config/sort'),
('administrator', 'database/del'),
('administrator', 'database/export'),
('administrator', 'database/import'),
('administrator', 'database/index?type=export'),
('administrator', 'database/index?type=import'),
('administrator', 'database/optimize'),
('administrator', 'database/repair'),
('administrator', 'group/add'),
('editor', 'group/add'),
('administrator', 'group/delete'),
('editor', 'group/delete'),
('administrator', 'group/edit'),
('editor', 'group/edit'),
('administrator', 'group/index'),
('editor', 'group/index'),
('administrator', 'index/index'),
('editor', 'index/index'),
('administrator', 'log/index'),
('administrator', 'log/view'),
('administrator', 'menu/add'),
('administrator', 'menu/edit'),
('administrator', 'Menu/import'),
('administrator', 'menu/index'),
('administrator', 'Menu/sort'),
('administrator', 'order/add'),
('administrator', 'order/delete'),
('administrator', 'order/edit'),
('administrator', 'order/index'),
('administrator', 'other'),
('administrator', 'shop/add'),
('editor', 'shop/add'),
('administrator', 'shop/delete'),
('editor', 'shop/delete'),
('administrator', 'shop/edit'),
('editor', 'shop/edit'),
('administrator', 'shop/index?type=1'),
('editor', 'shop/index?type=1'),
('administrator', 'shop/index?type=2'),
('editor', 'shop/index?type=2'),
('administrator', 'shop/index?type=3'),
('editor', 'shop/index?type=3'),
('administrator', 'shop/index?type=4'),
('editor', 'shop/index?type=4'),
('administrator', 'train/add'),
('editor', 'train/add'),
('administrator', 'train/delete'),
('editor', 'train/delete'),
('administrator', 'train/edit'),
('editor', 'train/edit'),
('administrator', 'train/index'),
('editor', 'train/index'),
('administrator', 'traintype/delete'),
('editor', 'traintype/delete'),
('administrator', 'traintype/edit'),
('editor', 'traintype/edit'),
('administrator', 'traintype/index'),
('editor', 'traintype/index'),
('administrator', 'user/add'),
('administrator', 'user/delete'),
('administrator', 'user/edit'),
('administrator', 'user/index'),
('administrator', 'user/updateNickname'),
('administrator', 'user/updatePassword');

-- --------------------------------------------------------

--
-- 表的结构 `yii2_auth_rule`
--

CREATE TABLE IF NOT EXISTS `yii2_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text COMMENT 'serialize后的rule对象',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `yii2_auth_rule`
--

INSERT INTO `yii2_auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('action/actionlog', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:16:"action/actionlog";s:9:"createdAt";i:1460031880;s:9:"updatedAt";i:1460031880;}', 1460031880, 1460031880),
('action/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"action/edit";s:9:"createdAt";i:1460031880;s:9:"updatedAt";i:1460031880;}', 1460031880, 1460031880),
('ad/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:6:"ad/add";s:9:"createdAt";i:1476437984;s:9:"updatedAt";i:1476437984;}', 1476437984, 1476437984),
('ad/delete', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"ad/delete";s:9:"createdAt";i:1476437984;s:9:"updatedAt";i:1476437984;}', 1476437984, 1476437984),
('ad/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:7:"ad/edit";s:9:"createdAt";i:1476437984;s:9:"updatedAt";i:1476437984;}', 1476437984, 1476437984),
('ad/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:8:"ad/index";s:9:"createdAt";i:1476437984;s:9:"updatedAt";i:1476437984;}', 1476437984, 1476437984),
('Addons/addHook', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:14:"Addons/addHook";s:9:"createdAt";i:1472528088;s:9:"updatedAt";i:1472528088;}', 1472528088, 1472528088),
('Addons/adminList', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:16:"Addons/adminList";s:9:"createdAt";i:1472528088;s:9:"updatedAt";i:1472528088;}', 1472528088, 1472528088),
('Addons/edithook', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"Addons/edithook";s:9:"createdAt";i:1472528088;s:9:"updatedAt";i:1472528088;}', 1472528088, 1472528088),
('Addons/execute', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:14:"Addons/execute";s:9:"createdAt";i:1472528088;s:9:"updatedAt";i:1472528088;}', 1472528088, 1472528088),
('Addons/hooks', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"Addons/hooks";s:9:"createdAt";i:1472528088;s:9:"updatedAt";i:1472528088;}', 1472528088, 1472528088),
('Addons/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"Addons/index";s:9:"createdAt";i:1460030539;s:9:"updatedAt";i:1460030539;}', 1460030539, 1460030539),
('admin/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"admin/add";s:9:"createdAt";i:1472528089;s:9:"updatedAt";i:1472528089;}', 1472528089, 1472528089),
('admin/auth', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:10:"admin/auth";s:9:"createdAt";i:1472528089;s:9:"updatedAt";i:1472528089;}', 1472528089, 1472528089),
('admin/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:10:"admin/edit";s:9:"createdAt";i:1472528089;s:9:"updatedAt";i:1472528089;}', 1472528089, 1472528089),
('admin/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"admin/index";s:9:"createdAt";i:1472528089;s:9:"updatedAt";i:1472528089;}', 1472528089, 1472528089),
('article/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"article/add";s:9:"createdAt";i:1460027926;s:9:"updatedAt";i:1460027926;}', 1460027926, 1460027926),
('article/autoSave', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:16:"article/autoSave";s:9:"createdAt";i:1460027926;s:9:"updatedAt";i:1460027926;}', 1460027926, 1460027926),
('article/batchOperate', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:20:"article/batchOperate";s:9:"createdAt";i:1460027926;s:9:"updatedAt";i:1460027926;}', 1460027926, 1460027926),
('article/clear', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:13:"article/clear";s:9:"createdAt";i:1460027927;s:9:"updatedAt";i:1460027927;}', 1460027927, 1460027927),
('article/copy', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"article/copy";s:9:"createdAt";i:1460027926;s:9:"updatedAt";i:1460027926;}', 1460027926, 1460027926),
('article/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"article/edit";s:9:"createdAt";i:1460027926;s:9:"updatedAt";i:1460027926;}', 1460027926, 1460027926),
('Article/examine', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"Article/examine";s:9:"createdAt";i:1460027927;s:9:"updatedAt";i:1460027927;}', 1460027927, 1460027927),
('article/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:13:"article/index";s:9:"createdAt";i:1460027926;s:9:"updatedAt";i:1460027926;}', 1460027926, 1460027926),
('article/move', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"article/move";s:9:"createdAt";i:1460027926;s:9:"updatedAt";i:1460027926;}', 1460027926, 1460027926),
('article/paste', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:13:"article/paste";s:9:"createdAt";i:1460027926;s:9:"updatedAt";i:1460027926;}', 1460027926, 1460027926),
('article/permit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:14:"article/permit";s:9:"createdAt";i:1460027927;s:9:"updatedAt";i:1460027927;}', 1460027927, 1460027927),
('article/recycle', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"article/recycle";s:9:"createdAt";i:1460027927;s:9:"updatedAt";i:1460027927;}', 1460027927, 1460027927),
('article/setStatus', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:17:"article/setStatus";s:9:"createdAt";i:1460027926;s:9:"updatedAt";i:1460027926;}', 1460027926, 1460027926),
('Article/sort', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"Article/sort";s:9:"createdAt";i:1460027927;s:9:"updatedAt";i:1460027927;}', 1460027927, 1460027927),
('article/update', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:14:"article/update";s:9:"createdAt";i:1460027926;s:9:"updatedAt";i:1460027926;}', 1460027926, 1460027926),
('attribute/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:13:"attribute/add";s:9:"createdAt";i:1460031881;s:9:"updatedAt";i:1460031881;}', 1460031881, 1460031881),
('attribute/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:14:"attribute/edit";s:9:"createdAt";i:1460031881;s:9:"updatedAt";i:1460031881;}', 1460031881, 1460031881),
('attribute/index1', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:16:"attribute/index1";s:9:"createdAt";i:1460031881;s:9:"updatedAt";i:1460031881;}', 1460031881, 1460031881),
('attribute/setStatus', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:19:"attribute/setStatus";s:9:"createdAt";i:1460031881;s:9:"updatedAt";i:1460031881;}', 1460031881, 1460031881),
('attribute/update', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:16:"attribute/update";s:9:"createdAt";i:1460031881;s:9:"updatedAt";i:1460031881;}', 1460031881, 1460031881),
('auth/access', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"auth/access";s:9:"createdAt";i:1460031879;s:9:"updatedAt";i:1460031879;}', 1460031879, 1460031879),
('auth/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:8:"auth/add";s:9:"createdAt";i:1472528089;s:9:"updatedAt";i:1472528089;}', 1472528089, 1472528089),
('auth/addToCategory', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:18:"auth/addToCategory";s:9:"createdAt";i:1460031880;s:9:"updatedAt";i:1460031880;}', 1460031880, 1460031880),
('auth/addToGroup', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"auth/addToGroup";s:9:"createdAt";i:1460031880;s:9:"updatedAt";i:1460031880;}', 1460031880, 1460031880),
('auth/addToModel', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"auth/addToModel";s:9:"createdAt";i:1460031880;s:9:"updatedAt";i:1460031880;}', 1460031880, 1460031880),
('auth/auth', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"auth/auth";s:9:"createdAt";i:1460031879;s:9:"updatedAt";i:1460031879;}', 1460031879, 1460031879),
('auth/category', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:13:"auth/category";s:9:"createdAt";i:1460031880;s:9:"updatedAt";i:1460031880;}', 1460031880, 1460031880),
('auth/changeStatus?method=deleteGroup', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:36:"auth/changeStatus?method=deleteGroup";s:9:"createdAt";i:1460031879;s:9:"updatedAt";i:1460031879;}', 1460031879, 1460031879),
('auth/changeStatus?method=forbidGroup', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:36:"auth/changeStatus?method=forbidGroup";s:9:"createdAt";i:1460031879;s:9:"updatedAt";i:1460031879;}', 1460031879, 1460031879),
('auth/changeStatus?method=resumeGroup', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:36:"auth/changeStatus?method=resumeGroup";s:9:"createdAt";i:1460031879;s:9:"updatedAt";i:1460031879;}', 1460031879, 1460031879),
('auth/createGroup', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:16:"auth/createGroup";s:9:"createdAt";i:1460031879;s:9:"updatedAt";i:1460031879;}', 1460031879, 1460031879),
('auth/delete', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"auth/delete";s:9:"createdAt";i:1472528089;s:9:"updatedAt";i:1472528089;}', 1472528089, 1472528089),
('auth/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"auth/edit";s:9:"createdAt";i:1472528089;s:9:"updatedAt";i:1472528089;}', 1472528089, 1472528089),
('auth/editGroup', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:14:"auth/editGroup";s:9:"createdAt";i:1460031879;s:9:"updatedAt";i:1460031879;}', 1460031879, 1460031879),
('auth/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:10:"auth/index";s:9:"createdAt";i:1459148617;s:9:"updatedAt";i:1459148627;}', 1456542110, 1456542120),
('auth/modelauth', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:14:"auth/modelauth";s:9:"createdAt";i:1460031880;s:9:"updatedAt";i:1460031880;}', 1460031880, 1460031880),
('auth/removeFromGroup', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:20:"auth/removeFromGroup";s:9:"createdAt";i:1460031880;s:9:"updatedAt";i:1460031880;}', 1460031880, 1460031880),
('auth/user', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"auth/user";s:9:"createdAt";i:1460031880;s:9:"updatedAt";i:1460031880;}', 1460031880, 1460031880),
('auth/writeGroup', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"auth/writeGroup";s:9:"createdAt";i:1460031879;s:9:"updatedAt";i:1460031879;}', 1460031879, 1460031879),
('category/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"category/add";s:9:"createdAt";i:1460031882;s:9:"updatedAt";i:1460031882;}', 1460031882, 1460031882),
('category/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:13:"category/edit";s:9:"createdAt";i:1460031882;s:9:"updatedAt";i:1460031882;}', 1460031882, 1460031882),
('category/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:14:"category/index";s:9:"createdAt";i:1460031882;s:9:"updatedAt";i:1460031882;}', 1460031882, 1460031882),
('category/operate/type/merge', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:27:"category/operate/type/merge";s:9:"createdAt";i:1460031882;s:9:"updatedAt";i:1460031882;}', 1460031882, 1460031882),
('category/operate/type/move', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:26:"category/operate/type/move";s:9:"createdAt";i:1460031882;s:9:"updatedAt";i:1460031882;}', 1460031882, 1460031882),
('category/remove', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"category/remove";s:9:"createdAt";i:1460031882;s:9:"updatedAt";i:1460031882;}', 1460031882, 1460031882),
('certificate/delete', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:18:"certificate/delete";s:9:"createdAt";i:1476437984;s:9:"updatedAt";i:1476437984;}', 1476437984, 1476437984),
('certificate/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:16:"certificate/edit";s:9:"createdAt";i:1476437983;s:9:"updatedAt";i:1476437983;}', 1476437983, 1476437983),
('certificate/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:17:"certificate/index";s:9:"createdAt";i:1476437983;s:9:"updatedAt";i:1476437983;}', 1476437983, 1476437983),
('channel/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"channel/add";s:9:"createdAt";i:1460031884;s:9:"updatedAt";i:1460031884;}', 1460031884, 1460031884),
('channel/del', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"channel/del";s:9:"createdAt";i:1460031884;s:9:"updatedAt";i:1460031884;}', 1460031884, 1460031884),
('channel/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"channel/edit";s:9:"createdAt";i:1460031884;s:9:"updatedAt";i:1460031884;}', 1460031884, 1460031884),
('channel/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:13:"channel/index";s:9:"createdAt";i:1460031884;s:9:"updatedAt";i:1460031884;}', 1460031884, 1460031884),
('config/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:10:"config/add";s:9:"createdAt";i:1460031883;s:9:"updatedAt";i:1460031883;}', 1460031883, 1460031883),
('config/del', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:10:"config/del";s:9:"createdAt";i:1460031883;s:9:"updatedAt";i:1460031883;}', 1460031883, 1460031883),
('config/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"config/edit";s:9:"createdAt";i:1460031883;s:9:"updatedAt";i:1460031883;}', 1460031883, 1460031883),
('config/group', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"config/group";s:9:"createdAt";i:1459148617;s:9:"updatedAt";i:1459148627;}', 1200000000, 1300000000),
('config/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"config/index";s:9:"createdAt";i:1459148617;s:9:"updatedAt";i:1459148627;}', 1200000000, 1300000000),
('config/save', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"config/save";s:9:"createdAt";i:1460031883;s:9:"updatedAt";i:1460031883;}', 1460031883, 1460031883),
('Config/sort', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"Config/sort";s:9:"createdAt";i:1460031884;s:9:"updatedAt";i:1460031884;}', 1460031884, 1460031884),
('database/del', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"database/del";s:9:"createdAt";i:1460031882;s:9:"updatedAt";i:1460031882;}', 1460031882, 1460031882),
('database/export', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"database/export";s:9:"createdAt";i:1460031881;s:9:"updatedAt";i:1460031881;}', 1460031881, 1460031881),
('database/import', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"database/import";s:9:"createdAt";i:1460031882;s:9:"updatedAt";i:1460031882;}', 1460031882, 1460031882),
('database/index?type=export', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:26:"database/index?type=export";s:9:"createdAt";i:1459148617;s:9:"updatedAt";i:1459148627;}', 1456542110, 1456542120),
('database/index?type=import', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:26:"database/index?type=import";s:9:"createdAt";i:1459148617;s:9:"updatedAt";i:1459148627;}', 1456542110, 1456542120),
('database/optimize', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:17:"database/optimize";s:9:"createdAt";i:1460031881;s:9:"updatedAt";i:1460031881;}', 1460031881, 1460031881),
('database/repair', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"database/repair";s:9:"createdAt";i:1460031881;s:9:"updatedAt";i:1460031881;}', 1460031881, 1460031881),
('group/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"group/add";s:9:"createdAt";i:1476437986;s:9:"updatedAt";i:1476437986;}', 1476437986, 1476437986),
('group/delete', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"group/delete";s:9:"createdAt";i:1476437986;s:9:"updatedAt";i:1476437986;}', 1476437986, 1476437986),
('group/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:10:"group/edit";s:9:"createdAt";i:1476437986;s:9:"updatedAt";i:1476437986;}', 1476437986, 1476437986),
('group/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"group/index";s:9:"createdAt";i:1476437986;s:9:"updatedAt";i:1476437986;}', 1476437986, 1476437986),
('index/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"index/index";s:9:"createdAt";i:1459148617;s:9:"updatedAt";i:1459148627;}', 1456542110, 1456542120),
('log/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"log/index";s:9:"createdAt";i:1472528090;s:9:"updatedAt";i:1472528090;}', 1472528090, 1472528090),
('log/view', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:8:"log/view";s:9:"createdAt";i:1472528090;s:9:"updatedAt";i:1472528090;}', 1472528090, 1472528090),
('login/logout', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"login/logout";s:9:"createdAt";i:1459148665;s:9:"updatedAt";i:1459148675;}', 1456542110, 1456542120),
('menu/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:8:"menu/add";s:9:"createdAt";i:1460031884;s:9:"updatedAt";i:1460031884;}', 1460031884, 1460031884),
('menu/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"menu/edit";s:9:"createdAt";i:1460031884;s:9:"updatedAt";i:1460031884;}', 1460031884, 1460031884),
('Menu/import', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"Menu/import";s:9:"createdAt";i:1460031884;s:9:"updatedAt";i:1460031884;}', 1460031884, 1460031884),
('menu/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:10:"menu/index";s:9:"createdAt";i:1459148617;s:9:"updatedAt";i:1459148627;}', 1200000000, 1300000000),
('Menu/sort', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"Menu/sort";s:9:"createdAt";i:1460031884;s:9:"updatedAt";i:1460031884;}', 1460031884, 1460031884),
('model/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"model/add";s:9:"createdAt";i:1460031882;s:9:"updatedAt";i:1460031882;}', 1460031882, 1460031882),
('model/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:10:"model/edit";s:9:"createdAt";i:1460031883;s:9:"updatedAt";i:1460031883;}', 1460031883, 1460031883),
('Model/generate', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:14:"Model/generate";s:9:"createdAt";i:1460031019;s:9:"updatedAt";i:1460031019;}', 1460031019, 1460031019),
('Model/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"Model/index";s:9:"createdAt";i:1460031882;s:9:"updatedAt";i:1460031882;}', 1460031882, 1460031882),
('model/setStatus', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"model/setStatus";s:9:"createdAt";i:1460031883;s:9:"updatedAt";i:1460031883;}', 1460031883, 1460031883),
('model/update', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"model/update";s:9:"createdAt";i:1460031883;s:9:"updatedAt";i:1460031883;}', 1460031883, 1460031883),
('order/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"order/add";s:9:"createdAt";i:1476438050;s:9:"updatedAt";i:1476438050;}', 1476438050, 1476438050),
('order/delete', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"order/delete";s:9:"createdAt";i:1476438049;s:9:"updatedAt";i:1476438049;}', 1476438049, 1476438049),
('order/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:10:"order/edit";s:9:"createdAt";i:1476438049;s:9:"updatedAt";i:1476438049;}', 1476438049, 1476438049),
('order/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"order/index";s:9:"createdAt";i:1472528088;s:9:"updatedAt";i:1472528088;}', 1472528088, 1472528088),
('other', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:5:"other";s:9:"createdAt";i:1472528090;s:9:"updatedAt";i:1472528090;}', 1472528090, 1472528090),
('shop/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:8:"shop/add";s:9:"createdAt";i:1476437985;s:9:"updatedAt";i:1476437985;}', 1476437985, 1476437985),
('shop/delete', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"shop/delete";s:9:"createdAt";i:1476437985;s:9:"updatedAt";i:1476437985;}', 1476437985, 1476437985),
('shop/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"shop/edit";s:9:"createdAt";i:1476437985;s:9:"updatedAt";i:1476437985;}', 1476437985, 1476437985),
('shop/group', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:10:"shop/group";s:9:"createdAt";i:1472528088;s:9:"updatedAt";i:1472528088;}', 1472528088, 1472528088),
('shop/index&type=1', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:17:"shop/index&type=1";s:9:"createdAt";i:1472528087;s:9:"updatedAt";i:1472528087;}', 1472528087, 1472528087),
('shop/index&type=2', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:17:"shop/index&type=2";s:9:"createdAt";i:1472528087;s:9:"updatedAt";i:1472528087;}', 1472528087, 1472528087),
('shop/index&type=3', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:17:"shop/index&type=3";s:9:"createdAt";i:1472528087;s:9:"updatedAt";i:1472528087;}', 1472528087, 1472528087),
('shop/index&type=4', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:17:"shop/index&type=4";s:9:"createdAt";i:1472528088;s:9:"updatedAt";i:1472528088;}', 1472528088, 1472528088),
('shop/index?type=1', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:17:"shop/index?type=1";s:9:"createdAt";i:1476437985;s:9:"updatedAt";i:1476437985;}', 1476437985, 1476437985),
('shop/index?type=2', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:17:"shop/index?type=2";s:9:"createdAt";i:1476437985;s:9:"updatedAt";i:1476437985;}', 1476437985, 1476437985),
('shop/index?type=3', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:17:"shop/index?type=3";s:9:"createdAt";i:1476437986;s:9:"updatedAt";i:1476437986;}', 1476437986, 1476437986),
('shop/index?type=4', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:17:"shop/index?type=4";s:9:"createdAt";i:1476437986;s:9:"updatedAt";i:1476437986;}', 1476437986, 1476437986),
('think/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"think/add";s:9:"createdAt";i:1460031883;s:9:"updatedAt";i:1460031883;}', 1460031883, 1460031883),
('think/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:10:"think/edit";s:9:"createdAt";i:1460031019;s:9:"updatedAt";i:1460031019;}', 1460031019, 1460031019),
('think/lists', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"think/lists";s:9:"createdAt";i:1460031020;s:9:"updatedAt";i:1460031020;}', 1460031020, 1460031020),
('train/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"train/add";s:9:"createdAt";i:1476437985;s:9:"updatedAt";i:1476437985;}', 1476437985, 1476437985),
('train/delete', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:12:"train/delete";s:9:"createdAt";i:1476437984;s:9:"updatedAt";i:1476437984;}', 1476437984, 1476437984),
('train/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:10:"train/edit";s:9:"createdAt";i:1476437984;s:9:"updatedAt";i:1476437984;}', 1476437984, 1476437984),
('train/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"train/index";s:9:"createdAt";i:1472528088;s:9:"updatedAt";i:1472528088;}', 1472528088, 1472528088),
('traintype/delete', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:16:"traintype/delete";s:9:"createdAt";i:1476437984;s:9:"updatedAt";i:1476437984;}', 1476437984, 1476437984),
('traintype/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:14:"traintype/edit";s:9:"createdAt";i:1476437984;s:9:"updatedAt";i:1476437984;}', 1476437984, 1476437984),
('traintype/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"traintype/index";s:9:"createdAt";i:1476437984;s:9:"updatedAt";i:1476437984;}', 1476437984, 1476437984),
('user/action', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"user/action";s:9:"createdAt";i:1460031878;s:9:"updatedAt";i:1460031878;}', 1460031878, 1460031878),
('user/add', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:8:"user/add";s:9:"createdAt";i:1460031877;s:9:"updatedAt";i:1460031877;}', 1460031877, 1460031877),
('user/addaction', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:14:"user/addaction";s:9:"createdAt";i:1460031878;s:9:"updatedAt";i:1460031878;}', 1460031878, 1460031878),
('user/auth', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"user/auth";s:9:"createdAt";i:1460031878;s:9:"updatedAt";i:1460031878;}', 1460031878, 1460031878),
('User/changeStatus?method=deleteUser', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:35:"User/changeStatus?method=deleteUser";s:9:"createdAt";i:1460031879;s:9:"updatedAt";i:1460031879;}', 1460031879, 1460031879),
('user/changeStatus?method=forbidUser', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:35:"user/changeStatus?method=forbidUser";s:9:"createdAt";i:1460031878;s:9:"updatedAt";i:1460031878;}', 1460031878, 1460031878),
('user/changeStatus?method=resumeUser', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:35:"user/changeStatus?method=resumeUser";s:9:"createdAt";i:1460031878;s:9:"updatedAt";i:1460031878;}', 1460031878, 1460031878),
('user/delete', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:11:"user/delete";s:9:"createdAt";i:1476438050;s:9:"updatedAt";i:1476438050;}', 1476438050, 1476438050),
('user/edit', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:9:"user/edit";s:9:"createdAt";i:1476438051;s:9:"updatedAt";i:1476438051;}', 1476438051, 1476438051),
('user/editaction', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"user/editaction";s:9:"createdAt";i:1460031878;s:9:"updatedAt";i:1460031878;}', 1460031878, 1460031878),
('user/index', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:10:"user/index";s:9:"createdAt";i:1459148617;s:9:"updatedAt";i:1459148627;}', 1456542110, 1456542120),
('user/saveAction', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:15:"user/saveAction";s:9:"createdAt";i:1460031878;s:9:"updatedAt";i:1460031878;}', 1460031878, 1460031878),
('user/setStatus', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:14:"user/setStatus";s:9:"createdAt";i:1460031878;s:9:"updatedAt";i:1460031878;}', 1460031878, 1460031878),
('user/updateNickname', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:19:"user/updateNickname";s:9:"createdAt";i:1460031881;s:9:"updatedAt";i:1460031881;}', 1460031881, 1460031881),
('user/updatePassword', 'O:21:"common\\core\\rbac\\Rule":3:{s:4:"name";s:19:"user/updatePassword";s:9:"createdAt";i:1460031880;s:9:"updatedAt";i:1460031880;}', 1460031880, 1460031880);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_captcha`
--

CREATE TABLE IF NOT EXISTS `yii2_captcha` (
  `id` int(8) unsigned NOT NULL,
  `ip` char(15) NOT NULL DEFAULT '0.0.0.0' COMMENT 'IP地址',
  `mobile` char(20) NOT NULL COMMENT '手机号',
  `captcha` char(6) NOT NULL COMMENT '验证码',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间'
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='验证码表';

--
-- 转存表中的数据 `yii2_captcha`
--

INSERT INTO `yii2_captcha` (`id`, `ip`, `mobile`, `captcha`, `time`) VALUES
(1, '127.0.0.1', '13631539420', '7978', 1474196824),
(2, '127.0.0.1', '13631639420', '6743', 1474197192),
(3, '59.40.134.141', '13631539420', '8879', 1474199719),
(4, '59.40.134.141', '13631639420', '1111', 1474206930),
(5, '113.116.72.128', '13631539420', '2216', 1474278556),
(6, '113.116.72.128', '13631539420', '6349', 1474279293),
(7, '113.116.72.128', '13631539420', '8966', 1474279946),
(8, '14.154.236.128', '13631539420', '4171', 1474281062),
(9, '14.154.236.128', '13631539420', '3651', 1474281145),
(10, '116.6.88.148', '18665354960', '8448', 1474334541),
(11, '113.104.231.102', '13421839870', '3321', 1474365606),
(12, '113.104.231.102', '13421839870', '8593', 1474378859),
(13, '113.104.231.102', '13421839870', '6249', 1474380034),
(14, '113.104.231.102', '13421839870', '9893', 1474380089),
(15, '113.104.231.102', '13316922246', '9521', 1474380153),
(16, '113.104.231.115', '13421839870', '1606', 1474443343),
(17, '113.104.231.115', '13421839870', '9673', 1474443423),
(18, '113.104.231.115', '13421839870', '3285', 1474443621),
(19, '183.11.157.104', '13631539420', '6292', 1474444126),
(20, '183.11.157.104', '13631539420', '3221', 1474444208),
(21, '113.104.231.115', '13421839870', '9664', 1474444261),
(22, '113.104.231.115', '13421839870', '6477', 1474444479),
(23, '120.234.16.114', '13316922246', '2312', 1474612724);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_category`
--

CREATE TABLE IF NOT EXISTS `yii2_category` (
  `id` int(10) unsigned NOT NULL COMMENT '分类ID',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `name` varchar(30) NOT NULL COMMENT '标志',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `link` varchar(250) DEFAULT '' COMMENT '外链',
  `extend` text COMMENT '扩展设置',
  `meta_title` varchar(50) DEFAULT '' COMMENT 'SEO的网页标题',
  `keywords` varchar(255) DEFAULT '' COMMENT '关键字',
  `description` varchar(255) DEFAULT '' COMMENT '描述',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '数据状态'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='分类表';

--
-- 转存表中的数据 `yii2_category`
--

INSERT INTO `yii2_category` (`id`, `pid`, `name`, `title`, `link`, `extend`, `meta_title`, `keywords`, `description`, `create_time`, `update_time`, `sort`, `status`) VALUES
(1, 0, 'about', '关于我们', '', '', '', '', '', 1379474947, 1476341718, 2, 1),
(3, 0, 'event', '活动', '', 'a:2:{s:2:"sd";s:2:"11";s:4:"sdfs";s:3:"222";}', '测试标题', '测试seo关键词', '测试描述', 1471947194, 1473604631, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_config`
--

CREATE TABLE IF NOT EXISTS `yii2_config` (
  `id` int(10) unsigned NOT NULL COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `value` text COMMENT '配置值',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yii2_config`
--

INSERT INTO `yii2_config` (`id`, `name`, `title`, `group`, `type`, `value`, `extra`, `remark`, `create_time`, `update_time`, `sort`, `status`) VALUES
(1, 'WEB_SITE_TITLE', '网站标题', 1, 1, '内容管理框架', '', '网站标题前台显示标题', 1378898976, 1476342120, 0, 1),
(2, 'WEB_SITE_DESCRIPTION', '网站描述', 1, 2, '内容管理框架', '', '网站搜索引擎描述', 1378898976, 1472528403, 1, 1),
(3, 'WEB_SITE_KEYWORD', '网站关键字', 1, 2, '黄龙飞11', '', '网站搜索引擎关键字', 1378898976, 1472528403, 8, 1),
(4, 'WEB_SITE_CLOSE', '关闭站点', 4, 4, '1', '0:关闭,1:开启', '站点关闭后其他用户不能访问，管理员可以正常访问', 1378898976, 1463024280, 1, 0),
(9, 'CONFIG_TYPE_LIST', '配置类型列表', 3, 3, '0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举', '', '主要用于数据解析和页面表单的生成', 1378898976, 1463024244, 2, 1),
(10, 'WEB_SITE_ICP', '网站备案号', 1, 1, '沪ICP备12007941号-2', '', '设置在网站底部显示的备案号，如“沪ICP备12007941号-2', 1378900335, 1472528403, 9, 1),
(11, 'DATA_BACKUP_PATH', '数据库备份路径', 4, 1, '/storage/web/database/', '', '路径必须以 / 结尾', 1379053380, 1476448404, 3, 1),
(12, 'DOCUMENT_DISPLAY', '文档可见性', 2, 3, '0:所有人可见\r\n1:仅注册会员可见\r\n2:仅管理员可见', '', '文章可见性仅影响前台显示，后台不收影响', 1379056370, 1463041605, 4, 1),
(13, 'COLOR_STYLE', '后台色系', 1, 4, 'default_color', 'default_color:默认\r\nblue_color:紫罗兰', '后台颜色风格', 1379122533, 1472528403, 10, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_log`
--

CREATE TABLE IF NOT EXISTS `yii2_log` (
  `id` int(8) NOT NULL,
  `uid` int(8) NOT NULL COMMENT '用户uid',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `controller` varchar(50) NOT NULL COMMENT '控制器',
  `action` varchar(50) NOT NULL COMMENT '动作',
  `querystring` varchar(255) NOT NULL COMMENT '查询字符串',
  `remark` varchar(255) NOT NULL COMMENT '备注',
  `ip` varchar(15) NOT NULL DEFAULT '0.0.0.0' COMMENT 'IP',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台日志';

--
-- 转存表中的数据 `yii2_log`
--

INSERT INTO `yii2_log` (`id`, `uid`, `title`, `controller`, `action`, `querystring`, `remark`, `ip`, `create_time`, `status`) VALUES
(1, 2, '修改菜单', 'menu', 'index', '/admin.php/menu/index?id=4', '用户修改了菜单', '192.168.0.101', 1435658950, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_menu`
--

CREATE TABLE IF NOT EXISTS `yii2_menu` (
  `id` int(10) unsigned NOT NULL COMMENT '文档ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态'
) ENGINE=MyISAM AUTO_INCREMENT=170 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `yii2_menu`
--

INSERT INTO `yii2_menu` (`id`, `title`, `pid`, `sort`, `url`, `hide`, `group`, `status`) VALUES
(1, '首页', 0, 1, 'index/index', 0, '', 1),
(2, '内容', 0, 2, 'article/index', 0, '', 1),
(3, '文章管理', 2, 1, 'article/index', 0, '文章管理|icon-note', 1),
(4, '新增', 3, 0, 'article/add', 0, '', 1),
(5, '编辑', 3, 0, 'article/edit', 0, '', 1),
(6, '改变状态', 3, 0, 'article/setStatus', 0, '', 1),
(7, '保存', 3, 0, 'article/update', 0, '', 1),
(8, '保存草稿', 3, 0, 'article/autoSave', 0, '', 1),
(9, '移动', 3, 0, 'article/move', 0, '', 1),
(139, '潜水管理', 2, 22, 'shop/index?type=3', 0, '商城管理|icon-basket', 1),
(13, '回收站', 2, 99, 'article/recycle', 1, '内容', 1),
(14, '还原', 13, 0, 'article/permit', 0, '', 1),
(15, '清空', 13, 0, 'article/clear', 0, '', 1),
(16, '用户', 0, 4, 'admin/index', 0, '', 1),
(17, '管理员管理', 16, 1, 'admin/index', 0, '后台用户|icon-user', 1),
(18, '新增管理员', 17, 0, 'admin/add', 0, '', 1),
(137, '更新', 17, 0, 'admin/edit', 0, '', 1),
(144, '商城套餐', 2, 29, 'group/index', 0, '商城管理|icon-basket', 1),
(155, '删除', 144, 0, 'group/delete', 0, '', 1),
(156, '添加培训', 2, 0, 'train/add', 1, '', 1),
(157, '编辑培训', 2, 0, 'train/edit', 1, '', 1),
(27, '权限管理', 16, 2, 'auth/index', 0, '后台用户|icon-user', 1),
(28, '删除', 27, 0, 'auth/delete', 0, '', 1),
(29, '编辑', 27, 0, 'auth/edit', 0, '', 1),
(30, '恢复', 27, 0, 'auth/add', 0, '', 1),
(154, '编辑', 144, 0, 'group/edit', 0, '', 1),
(153, '添加', 144, 0, 'group/add', 0, '', 1),
(152, '删除商品', 2, 0, 'shop/delete', 1, '', 1),
(34, '授权', 27, 0, 'auth/auth', 0, '', 1),
(35, '访问授权', 27, 0, 'auth/access', 0, '', 1),
(36, '成员授权', 27, 0, 'auth/user', 0, '', 1),
(145, '添加', 142, 0, 'user/add', 0, '', 1),
(146, '编辑', 142, 0, 'user/edit', 0, '', 1),
(147, '删除', 142, 0, 'user/delete', 0, '', 1),
(150, '添加商品', 2, 0, 'shop/add', 1, '', 1),
(151, '编辑商品', 2, 0, 'shop/edit', 1, '', 1),
(43, '订单', 0, 3, 'order/index', 0, '', 1),
(44, '订单列表', 43, 1, 'order/index', 0, '订单管理|fa fa-cny', 1),
(143, '海钓管理', 2, 23, 'shop/index?type=4', 0, '商城管理|icon-basket', 1),
(142, '前台用户', 16, 20, 'user/index', 0, '前台用户|icon-users', 1),
(141, '帆船管理', 2, 21, 'shop/index?type=2', 0, '商城管理|icon-basket', 1),
(55, '添加', 44, 0, 'order/add', 0, '', 1),
(56, '编辑', 44, 0, 'order/edit', 0, '', 1),
(148, '删除', 44, 0, 'order/delete', 0, '', 1),
(63, '属性管理', 68, 0, 'attribute/index1', 1, '', 1),
(64, '新增', 63, 0, 'attribute/add', 0, '', 1),
(65, '编辑', 63, 0, 'attribute/edit', 0, '', 1),
(66, '改变状态', 63, 0, 'attribute/setStatus', 0, '', 1),
(67, '保存数据', 63, 0, 'attribute/update', 0, '', 1),
(68, '系统', 0, 5, 'config/group', 0, '', 1),
(69, '网站设置', 68, 1, 'config/group', 0, '系统设置|icon-settings', 1),
(70, '配置管理', 68, 1, 'config/index', 0, '系统设置|icon-settings', 1),
(71, '编辑', 70, 0, 'config/edit', 0, '', 1),
(72, '删除', 70, 0, 'config/del', 0, '', 1),
(73, '新增', 70, 0, 'config/add', 0, '', 1),
(74, '保存', 70, 0, 'config/save', 0, '', 1),
(75, '菜单管理', 68, 5, 'menu/index', 0, '系统设置|icon-settings', 1),
(80, '分类管理', 2, 2, 'category/index', 0, '文章管理|icon-note', 1),
(81, '编辑', 80, 0, 'category/edit', 0, '', 1),
(82, '新增', 80, 0, 'category/add', 0, '', 1),
(83, '删除', 80, 0, 'category/remove', 0, '', 1),
(84, '移动', 80, 0, 'category/operate/type/move', 0, '', 1),
(85, '合并', 80, 0, 'category/operate/type/merge', 0, '', 1),
(86, '备份数据库', 68, 10, 'database/index?type=export', 0, '数据备份|fa fa-database', 1),
(87, '备份', 86, 0, 'database/export', 0, '', 1),
(88, '优化表', 86, 0, 'database/optimize', 0, '', 1),
(89, '修复表', 86, 0, 'database/repair', 0, '', 1),
(90, '还原数据库', 68, 11, 'database/index?type=import', 0, '数据备份|fa fa-database', 1),
(91, '恢复', 90, 0, 'database/import', 0, '', 1),
(92, '删除', 90, 0, 'database/del', 0, '', 1),
(93, '其他栏目', 0, 5, 'other', 1, '', 1),
(96, '新增', 75, 0, 'menu/add', 0, '系统设置|icon-legal', 1),
(98, '编辑', 75, 0, 'menu/edit', 0, '', 1),
(106, '行为日志', 16, 30, 'log/index', 0, '用户日志|icon-check', 1),
(108, '修改密码', 16, 0, 'user/updatePassword', 1, '', 1),
(109, '修改昵称', 16, 0, 'user/updateNickname', 1, '', 1),
(110, '查看行为日志', 106, 0, 'log/view', 1, '', 1),
(114, '导入', 75, 0, 'Menu/import', 0, '', 1),
(149, '培训课程', 2, 51, 'train/index', 0, '培训管理|fa fa-certificate', 1),
(138, '酒店管理', 2, 20, 'shop/index?type=1', 0, '商城管理|icon-basket', 1),
(119, '排序', 70, 0, 'Config/sort', 1, '', 1),
(120, '排序', 75, 0, 'Menu/sort', 1, '', 1),
(129, '管理员授权', 17, 0, 'admin/auth', 0, '', 0),
(131, '待完成任务', 1, 0, 'index/index', 0, '任务列表|icon-speech', 0),
(158, '删除培训', 2, 0, 'train/delete', 1, '', 1),
(159, '广告管理', 2, 0, 'ad/index', 0, '广告管理|icon-target', 1),
(160, '添加', 159, 0, 'ad/add', 0, '', 1),
(161, '编辑', 159, 0, 'ad/edit', 0, '', 1),
(162, '删除', 159, 0, 'ad/delete', 0, '', 1),
(163, '证书管理', 2, 0, 'certificate/index', 0, '培训管理|fa fa-certificate', 1),
(164, '添加/修改证书', 163, 0, 'certificate/edit', 0, '', 1),
(165, '删除证书', 163, 0, 'certificate/delete', 0, '', 1),
(166, '培训类型', 2, 0, 'traintype/index', 0, '培训管理|fa fa-certificate', 1),
(167, '添加/修改类型', 166, 0, 'traintype/edit', 0, '', 1),
(168, '删除类型', 166, 0, 'traintype/delete', 0, '', 1),
(169, '商城管理', 2, 0, 'shop/index', 1, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_order`
--

CREATE TABLE IF NOT EXISTS `yii2_order` (
  `order_id` int(8) NOT NULL,
  `order_sn` char(10) NOT NULL COMMENT '订单号',
  `uid` int(8) DEFAULT '0' COMMENT '用户id',
  `name` char(30) DEFAULT '' COMMENT '姓名',
  `tel` char(20) DEFAULT '' COMMENT '电话',
  `sfz` char(20) DEFAULT '' COMMENT '身份证号',
  `type` char(10) NOT NULL COMMENT '订单类型 shop或train',
  `aid` int(8) NOT NULL COMMENT '商品或培训ID',
  `title` varchar(100) NOT NULL COMMENT '商品名称',
  `start_time` int(10) NOT NULL COMMENT '起租时间',
  `end_time` int(10) NOT NULL COMMENT '退租时间',
  `num` int(4) NOT NULL DEFAULT '1' COMMENT '数量',
  `pay_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付状态 0未支付 1已支付',
  `pay_time` int(10) NOT NULL COMMENT '支付时间',
  `pay_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '支付类型 1微信 2支付宝 3银联',
  `pay_source` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '支付途径 1网站 2微信 3后台',
  `create_time` int(10) NOT NULL COMMENT '订单创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='订单表';

--
-- 转存表中的数据 `yii2_order`
--

INSERT INTO `yii2_order` (`order_id`, `order_sn`, `uid`, `name`, `tel`, `sfz`, `type`, `aid`, `title`, `start_time`, `end_time`, `num`, `pay_status`, `pay_time`, `pay_type`, `pay_source`, `create_time`, `status`) VALUES
(1, '135555111', 6, '', '', '', 'shop', 1, '商品名称', 1345678940, 1345688940, 1, 0, 1345668940, 1, 1, 1345678940, 1),
(2, '135555111', 7, '', '', '', 'shop', 1, '商品名称1111', 1345678940, 1345688940, 1, 1, 1365668940, 2, 2, 1365678940, 1),
(3, '1473787901', 0, '', '', '', 'shop', 1, '大床双人房特价', 1473811200, 1474416000, 1, 1, 1473787901, 1, 1, 1473787924, 1),
(4, '1473788097', 0, '龙凤', '15956985698', '', 'train', 3, '帆船培训2', 1473811200, 1474416000, 1, 0, 1473788097, 1, 1, 1473788126, 1),
(5, '1474094023', 0, '', '', '', 'shop', 3, '大床双人房特价', 1474529400, 1344600, 1, 1, 1476165960, 1, 1, 1474094061, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_picture`
--

CREATE TABLE IF NOT EXISTS `yii2_picture` (
  `id` int(10) unsigned NOT NULL COMMENT '主键id自增',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yii2_shop`
--

CREATE TABLE IF NOT EXISTS `yii2_shop` (
  `id` int(8) unsigned NOT NULL,
  `type` int(4) NOT NULL COMMENT '房间类型',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `cover` varchar(255) NOT NULL DEFAULT '' COMMENT '封面图',
  `images` text NOT NULL COMMENT '图组',
  `num` int(3) NOT NULL COMMENT '房间总数量',
  `price` decimal(8,2) NOT NULL COMMENT '通常价格，格式231.02',
  `extend` text COMMENT '扩展数据',
  `sort` int(4) NOT NULL DEFAULT '0' COMMENT '排序值',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='酒店表';

--
-- 转存表中的数据 `yii2_shop`
--

INSERT INTO `yii2_shop` (`id`, `type`, `title`, `description`, `cover`, `images`, `num`, `price`, `extend`, `sort`, `create_time`, `update_time`, `status`) VALUES
(1, 1, '大床双人房特价', '111111', '/upload/image/201609/1473947300137.jpg', '/upload/image/201608/1472638058196.jpg,/upload/image/201608/1472638060470.jpg', 111, '520.12', 'a:3:{i:111;s:3:"111";i:222;s:3:"222";i:333;s:3:"333";}', 1, 1472638475, 1473947302, 1),
(2, 4, '海钓管理测试测试测试', '测试测试测试', '', '/upload/image/201608/1472639208479.jpg,/upload/image/201608/1472639210113.jpg', 133, '421.00', 'a:3:{i:11;s:2:"11";i:22;s:2:"22";i:33;s:2:"33";}', 3, 1472639234, NULL, 1),
(3, 1, '测试酒店1', '测试酒店1', '201610/1476449933440.jpg', '201610/147645012347.jpg,201610/1476450125874.jpg,201610/1476450127892.jpg', 4, '420.23', 'a:1:{s:3:"sss";s:5:"sadfa";}', 0, 1473835350, 1476450135, 1),
(4, 2, '测试帆船标题', '测试商品描述测试商品描述测试商品描述测试商品描述测试商品描述', '/storage/web/image/201610/147642695750.jpg', '/upload/image/201609/1474176211761.jpg,/upload/image/201609/1474176213249.jpg,/upload/image/201609/1474176215379.jpg', 111, '333.00', 'a:1:{i:0;s:0:"";}', 0, 1474176248, 1476426960, 1),
(5, 3, '测试潜水标题', '商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述商品描述', '/upload/image/201609/1474176263443.jpg', '/upload/image/201609/1474176285287.jpg,/upload/image/201609/1474176289221.jpg,/upload/image/201609/1474176293497.jpg,/upload/image/201609/1474176299382.jpg', 200, '900.00', 'a:1:{i:0;s:0:"";}', 0, 1474176308, NULL, 1),
(6, 1, '666666', '666666666666', '/upload/image/201609/1474213186190.png', '/upload/image/201609/1474213195722.jpg', 6, '2288.00', 'a:1:{i:0;s:15:"dssdfsfsdfdsfsa";}', 1, 1474213219, 1474213264, 0);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_shop_group`
--

CREATE TABLE IF NOT EXISTS `yii2_shop_group` (
  `id` int(8) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '套餐标题',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `groups` text NOT NULL COMMENT '商品组合，数字逗号分隔',
  `cover` varchar(255) NOT NULL COMMENT '封面图',
  `images` text NOT NULL COMMENT '图组',
  `total` decimal(8,2) NOT NULL COMMENT '总价',
  `price` decimal(8,2) NOT NULL COMMENT '套餐价格',
  `sort` int(4) NOT NULL DEFAULT '0' COMMENT '排序值',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='套餐设置';

--
-- 转存表中的数据 `yii2_shop_group`
--

INSERT INTO `yii2_shop_group` (`id`, `title`, `description`, `groups`, `cover`, `images`, `total`, `price`, `sort`, `status`) VALUES
(2, '阿斯顿发顺丰', '沙发沙发啊 沙发阿斯顿发是放大师傅', 'a:1:{i:1;a:1:{i:3;a:3:{s:4:"days";s:1:"6";s:3:"num";s:1:"6";s:2:"id";s:1:"3";}}}', '', '', '0.00', '600.00', 0, 1),
(4, '房1天2人潜水1天2人', '房1天2人潜水1天2人', 'a:2:{i:1;a:1:{i:1;a:3:{s:4:"days";s:1:"1";s:3:"num";s:1:"2";s:2:"id";s:1:"1";}}i:3;a:1:{i:5;a:3:{s:4:"days";s:1:"1";s:3:"num";s:1:"2";s:2:"id";s:1:"5";}}}', '201610/1476522207185.jpg', '201610/1476522209446.jpg', '2840.24', '998.00', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_shop_price`
--

CREATE TABLE IF NOT EXISTS `yii2_shop_price` (
  `id` int(8) NOT NULL,
  `shop_id` int(8) NOT NULL,
  `day` int(10) NOT NULL,
  `price` decimal(8,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='每日价格列表';

-- --------------------------------------------------------

--
-- 表的结构 `yii2_shop_type`
--

CREATE TABLE IF NOT EXISTS `yii2_shop_type` (
  `id` int(4) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '类型名称'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='房间类型表';

--
-- 转存表中的数据 `yii2_shop_type`
--

INSERT INTO `yii2_shop_type` (`id`, `name`) VALUES
(1, '房间'),
(2, '帆船'),
(3, '潜水'),
(4, '海钓');

-- --------------------------------------------------------

--
-- 表的结构 `yii2_train`
--

CREATE TABLE IF NOT EXISTS `yii2_train` (
  `id` int(8) unsigned NOT NULL,
  `type` int(11) NOT NULL COMMENT '培训类型',
  `title` varchar(100) NOT NULL COMMENT '排序标题',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `price` decimal(8,2) NOT NULL COMMENT '价格',
  `num` tinyint(3) NOT NULL DEFAULT '1' COMMENT '最少人数',
  `cover` varchar(255) NOT NULL COMMENT '封面',
  `sort` int(4) NOT NULL DEFAULT '0' COMMENT '排序值',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='培训表';

--
-- 转存表中的数据 `yii2_train`
--

INSERT INTO `yii2_train` (`id`, `type`, `title`, `description`, `price`, `num`, `cover`, `sort`, `create_time`, `update_time`, `status`) VALUES
(1, 1, '测试培训标题1', '测试培训标题1：\r\n\r\n帆海汇码头里停泊着单体竞赛帆船TEN，龙骨帆船DC22，丁级帆船DC15，\r\n双体帆船JE28，三体帆船JE27。无论您是出海游玩钓鱼，海上派对，\r\n\r\n还是商务洽谈等都可以满足您的需要。\r\n帆海汇培训中心室内拥有设施齐全的超大会议室，可以满足不同公司组织的业内会议\r\n或不同领域的年度盛会。帆海汇培训中心为美国ASA权威帆船培训体系授权分校，\r\n将为帆船运动爱好者提供专业的帆船培训，并颁发美国ASA帆船驾驶证书。 ', '523.23', 127, '/storage/web/image/201610/1476351848393.jpg', 0, 1472643081, 1476351850, 1),
(2, 2, '测试培训标题', '帆海汇码头里停泊着单体竞赛帆船TEN，龙骨帆船DC22，丁级帆船DC15，\r\n双体帆船JE28，三体帆船JE27。无论您是出海游玩钓鱼，海上派对，\r\n\r\n还是商务洽谈等都可以满足您的需要。\r\n帆海汇培训中心室内拥有设施齐全的超大会议室，可以满足不同公司组织的业内会议\r\n或不同领域的年度盛会。帆海汇培训中心为美国ASA权威帆船培训体系授权分校，\r\n将为帆船运动爱好者提供专业的帆船培训，并颁发美国ASA帆船驾驶证书。 ', '231.12', 100, '/upload/image/201609/1474529428934.jpg', 1, 1472643186, 1474529429, 1),
(3, 1, '帆船培训2', '帆海汇码头里停泊着单体竞赛帆船TEN，龙骨帆船DC22，丁级帆船DC15，\r\n双体帆船JE28，三体帆船JE27。无论您是出海游玩钓鱼，海上派对，\r\n\r\n还是商务洽谈等都可以满足您的需要。\r\n帆海汇培训中心室内拥有设施齐全的超大会议室，可以满足不同公司组织的业内会议\r\n或不同领域的年度盛会。帆海汇培训中心为美国ASA权威帆船培训体系授权分校，\r\n将为帆船运动爱好者提供专业的帆船培训，并颁发美国ASA帆船驾驶证书。 ', '322.20', 1, '/upload/image/201609/1474529316531.jpg', 0, 1473611927, 1474529318, 1),
(4, 1, '帆船培训3', '帆海汇码头里停泊着单体竞赛帆船TEN，龙骨帆船DC22，丁级帆船DC15，\r\n双体帆船JE28，三体帆船JE27。无论您是出海游玩钓鱼，海上派对，\r\n\r\n还是商务洽谈等都可以满足您的需要。\r\n帆海汇培训中心室内拥有设施齐全的超大会议室，可以满足不同公司组织的业内会议\r\n或不同领域的年度盛会。帆海汇培训中心为美国ASA权威帆船培训体系授权分校，\r\n将为帆船运动爱好者提供专业的帆船培训，并颁发美国ASA帆船驾驶证书。 ', '222.22', 122, '/upload/image/201609/1474529339380.jpg', 0, 1473611964, 1474529341, 1),
(5, 2, '潜水培训2', '帆海汇码头里停泊着单体竞赛帆船TEN，龙骨帆船DC22，丁级帆船DC15，\r\n双体帆船JE28，三体帆船JE27。无论您是出海游玩钓鱼，海上派对，\r\n\r\n还是商务洽谈等都可以满足您的需要。\r\n帆海汇培训中心室内拥有设施齐全的超大会议室，可以满足不同公司组织的业内会议\r\n或不同领域的年度盛会。帆海汇培训中心为美国ASA权威帆船培训体系授权分校，\r\n将为帆船运动爱好者提供专业的帆船培训，并颁发美国ASA帆船驾驶证书。 ', '100.02', 100, '/upload/image/201609/147452937679.jpg', 0, 1473612010, 1474529378, 1),
(6, 2, '潜水培训3', '帆海汇码头里停泊着单体竞赛帆船TEN，龙骨帆船DC22，丁级帆船DC15，\r\n双体帆船JE28，三体帆船JE27。无论您是出海游玩钓鱼，海上派对，\r\n\r\n还是商务洽谈等都可以满足您的需要。\r\n帆海汇培训中心室内拥有设施齐全的超大会议室，可以满足不同公司组织的业内会议\r\n或不同领域的年度盛会。帆海汇培训中心为美国ASA权威帆船培训体系授权分校，\r\n将为帆船运动爱好者提供专业的帆船培训，并颁发美国ASA帆船驾驶证书。 ', '123.23', 100, '/upload/image/201609/1474529402375.jpg', 0, 1473612026, 1474529403, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_train_certificate`
--

CREATE TABLE IF NOT EXISTS `yii2_train_certificate` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '证书名',
  `cover` varchar(255) NOT NULL DEFAULT '' COMMENT '证书图片',
  `description` varchar(1000) NOT NULL DEFAULT '' COMMENT '证书简介',
  `ctime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='培训证书表';

--
-- 转存表中的数据 `yii2_train_certificate`
--

INSERT INTO `yii2_train_certificate` (`id`, `title`, `cover`, `description`, `ctime`) VALUES
(1, 'AAA认证证书', '/storage/web/image/201610/1476425843601.jpg', '证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明', 0),
(2, 'BBB认证证书', '/upload/image/201609/147451603391.jpg', '证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明', 0),
(3, 'CCC认证证书', '/upload/image/201609/1474516376670.jpg', '证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明证书说明 ', 0);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_train_price`
--

CREATE TABLE IF NOT EXISTS `yii2_train_price` (
  `id` int(8) NOT NULL,
  `train_id` int(8) NOT NULL,
  `day` int(10) NOT NULL,
  `price` decimal(8,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='每日价格列表';

-- --------------------------------------------------------

--
-- 表的结构 `yii2_train_type`
--

CREATE TABLE IF NOT EXISTS `yii2_train_type` (
  `id` int(4) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '类型名称',
  `cover` varchar(255) NOT NULL DEFAULT '' COMMENT '封面',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `certif_ids` varchar(100) NOT NULL DEFAULT '' COMMENT '证书id',
  `description` varchar(255) NOT NULL COMMENT '内容描述'
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='房间类型表';

--
-- 转存表中的数据 `yii2_train_type`
--

INSERT INTO `yii2_train_type` (`id`, `name`, `cover`, `ctime`, `certif_ids`, `description`) VALUES
(1, '帆船', '/storage/web/image/201610/1476436438382.jpg', 0, '1,2,3', '阿迪法师打发多少阿斯顿发生的发生的发达asd'),
(2, '海钓', '/upload/image/201609/1474523644381.jpg', 0, '1,2,3', '阿斯顿法师打发规划法国恢复电话打工行');

-- --------------------------------------------------------

--
-- 表的结构 `yii2_user`
--

CREATE TABLE IF NOT EXISTS `yii2_user` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(60) NOT NULL COMMENT '密码',
  `salt` char(32) NOT NULL COMMENT '密码干扰字符',
  `email` char(32) DEFAULT NULL COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL DEFAULT '' COMMENT '用户手机',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `tuid` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '推荐人uid',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '头像路径',
  `score` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '当前积分',
  `score_all` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '总积分',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态 1正常 0禁用'
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `yii2_user`
--

INSERT INTO `yii2_user` (`uid`, `username`, `password`, `salt`, `email`, `mobile`, `reg_time`, `reg_ip`, `last_login_time`, `last_login_ip`, `update_time`, `tuid`, `image`, `score`, `score_all`, `status`) VALUES
(6, 'e282486518', '$2y$13$oO.xRlrKjMMF/bykb7476.zBIH2RkR6rtv8j5jrYgSxi71AvV3lFG', 'kXGkWeNSeoK7vakqRfUAviocq-5uy0cN', 'phphome@qq.com', '13656568989', 1456568652, 13654444444, 1456568652, 13556464888, 1473605683, 7, '/upload/image/201609/1473605673521.png', 10, 0, 1),
(7, '282486518', '$2y$13$KIAenVWuR2Tgi1VCKiPegeVsQAHXyDcp9rUmzhqK6TNjL4Cqc3YPa', 'n9uguceYCqn_jQNd8F6-JRHOj21yltUo', 'phphome@qq.coms', '13645685421', 1472626509, 2130706433, 0, 2130706433, 1472626719, 0, '/upload/image/201608/1472626502486.jpg', 1, 1, 0),
(8, '135232323232', '$2y$13$UVA5264Qic4g8BDl940x1e0ZefVI3QqpH8tH6bttL/cF8GcU1C7Rm', 'Dg36PS0QshZ-Y2zhQJa559RSKJULGO_8', NULL, '', 1474112224, 2130706433, 0, 2130706433, 0, 0, '', 0, 0, 0),
(13, 'aabbcc', '$2y$13$46n16kagedYUXx6WXZ2QkuSGJKm3FDr6iI.KPNzAkHYRHmplqgAiC', 'OblZ1QuXGGGiXZWTPqfDrCoF_qXVIN3b', NULL, '13421839870', 1474114459, 2130706433, 0, 2130706433, 0, 0, '', 0, 0, 1),
(14, 'bvbvbv', '$2y$13$Jm2bfhSnqcSMTaPxRRWiReqrclkApB1Dc20kLTxVNHAzl7J8DH60K', 'jrYKEga9jbp2H6bsdLjvnEd5mqsRgMMD', NULL, '13013013330', 1474115843, 2130706433, 0, 2130706433, 0, 0, '', 0, 0, 1),
(15, 'hahaha', '$2y$13$NsuZra9Z/DBaRk3R7tzvnuYrbmV5mIAKTKoksFcYHu3wUyJDaLPz.', 'BsDuGjz20Uexw6Kq_iw-s8AiqNmtec2u', NULL, '13636363636', 1474192435, 2130706433, 0, 2130706433, 0, 13, '', 0, 0, 1),
(16, 'huanglala', '$2y$13$FJGFsH1fls8m3DWuxUrN9eJcDQZScQLyYaQIXVeSPK0WMlpT1C.Ze', '7EpKjeEwVqYQS7oV0QW7-JNy-UFchvY1', NULL, '13631639420', 1474197294, 2130706433, 0, 2130706433, 0, 13, '', 0, 0, 1),
(17, 'binbin', '$2y$13$fbFtBRQgoH2PZ3wfCG1KIu8qdXeah.4KFZWI7kAE.4fDxM4lMuJ4q', 'tjCK1O9VaCtnvlNzRobRlnNHmbADlXPM', NULL, '18665354960', 1474334566, 1946572948, 0, 1946572948, 0, 6, '', 0, 0, 1),
(18, 'lasek001', '$2y$13$qMb7n1rslyltgaCDNvy/mOcBuTfOmidi8.zXvnURHMqKkVydCj3h2', 'Fx-LBkD34aXdGkYt8a2S_6Vq991TrW6S', NULL, '13316922246', 1474380169, 1902700390, 0, 1902700390, 0, 0, '', 0, 0, 1),
(19, 'feifeifei', '$2y$13$MRvZElUImZ.8gMsNV5ZEKuIkdkEamyc1tw/FHoPgQdp5x.WIPOroi', 'KWzNd8A57uVSMeLpDUB_ol1egfLPJ58C', NULL, '13631539420', 1474444147, 3070991720, 0, 3070991720, 0, 0, '', 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `yii2_user_data`
--

CREATE TABLE IF NOT EXISTS `yii2_user_data` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(3) unsigned NOT NULL COMMENT '类型标识',
  `target_id` int(10) unsigned NOT NULL COMMENT '目标id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `yii2_user_rank`
--

CREATE TABLE IF NOT EXISTS `yii2_user_rank` (
  `id` int(3) NOT NULL,
  `title` varchar(30) NOT NULL COMMENT '等级名称',
  `score` int(8) NOT NULL COMMENT '积分界限',
  `discount` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '折扣百分比',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='会员等级配置';

--
-- 转存表中的数据 `yii2_user_rank`
--

INSERT INTO `yii2_user_rank` (`id`, `title`, `score`, `discount`, `status`) VALUES
(1, '普通会员', 0, '0.00', 1),
(2, '一级会员', 2000, '3.00', 1),
(3, '二级会员', 5000, '6.00', 1),
(4, 'VIP会员', 10000, '10.00', 1),
(5, '钻石会员', 100000, '20.00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `yii2_ad`
--
ALTER TABLE `yii2_ad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yii2_admin`
--
ALTER TABLE `yii2_admin`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `yii2_article`
--
ALTER TABLE `yii2_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category_status` (`category_id`,`status`),
  ADD KEY `idx_status_type_pid` (`status`);

--
-- Indexes for table `yii2_auth_assignment`
--
ALTER TABLE `yii2_auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `yii2_auth_item`
--
ALTER TABLE `yii2_auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `yii2_auth_item_child`
--
ALTER TABLE `yii2_auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `yii2_auth_rule`
--
ALTER TABLE `yii2_auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `yii2_captcha`
--
ALTER TABLE `yii2_captcha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yii2_category`
--
ALTER TABLE `yii2_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_name` (`name`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `yii2_config`
--
ALTER TABLE `yii2_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_name` (`name`),
  ADD KEY `type` (`type`),
  ADD KEY `group` (`group`);

--
-- Indexes for table `yii2_log`
--
ALTER TABLE `yii2_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `yii2_menu`
--
ALTER TABLE `yii2_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `yii2_order`
--
ALTER TABLE `yii2_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `yii2_picture`
--
ALTER TABLE `yii2_picture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yii2_shop`
--
ALTER TABLE `yii2_shop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `yii2_shop_group`
--
ALTER TABLE `yii2_shop_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yii2_shop_price`
--
ALTER TABLE `yii2_shop_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`shop_id`);

--
-- Indexes for table `yii2_shop_type`
--
ALTER TABLE `yii2_shop_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yii2_train`
--
ALTER TABLE `yii2_train`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yii2_train_certificate`
--
ALTER TABLE `yii2_train_certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yii2_train_price`
--
ALTER TABLE `yii2_train_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`train_id`);

--
-- Indexes for table `yii2_train_type`
--
ALTER TABLE `yii2_train_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yii2_user`
--
ALTER TABLE `yii2_user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `yii2_user_data`
--
ALTER TABLE `yii2_user_data`
  ADD UNIQUE KEY `uid` (`uid`,`type`,`target_id`);

--
-- Indexes for table `yii2_user_rank`
--
ALTER TABLE `yii2_user_rank`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `yii2_ad`
--
ALTER TABLE `yii2_ad`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `yii2_admin`
--
ALTER TABLE `yii2_admin`
  MODIFY `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `yii2_article`
--
ALTER TABLE `yii2_article`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `yii2_captcha`
--
ALTER TABLE `yii2_captcha`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `yii2_category`
--
ALTER TABLE `yii2_category`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `yii2_config`
--
ALTER TABLE `yii2_config`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `yii2_log`
--
ALTER TABLE `yii2_log`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `yii2_menu`
--
ALTER TABLE `yii2_menu`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',AUTO_INCREMENT=170;
--
-- AUTO_INCREMENT for table `yii2_order`
--
ALTER TABLE `yii2_order`
  MODIFY `order_id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `yii2_picture`
--
ALTER TABLE `yii2_picture`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增';
--
-- AUTO_INCREMENT for table `yii2_shop`
--
ALTER TABLE `yii2_shop`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `yii2_shop_group`
--
ALTER TABLE `yii2_shop_group`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `yii2_shop_price`
--
ALTER TABLE `yii2_shop_price`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `yii2_shop_type`
--
ALTER TABLE `yii2_shop_type`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `yii2_train`
--
ALTER TABLE `yii2_train`
  MODIFY `id` int(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `yii2_train_certificate`
--
ALTER TABLE `yii2_train_certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `yii2_train_price`
--
ALTER TABLE `yii2_train_price`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `yii2_train_type`
--
ALTER TABLE `yii2_train_type`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `yii2_user`
--
ALTER TABLE `yii2_user`
  MODIFY `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `yii2_user_rank`
--
ALTER TABLE `yii2_user_rank`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- 限制导出的表
--

--
-- 限制表 `yii2_auth_assignment`
--
ALTER TABLE `yii2_auth_assignment`
  ADD CONSTRAINT `yii2_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `yii2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `yii2_auth_item_child`
--
ALTER TABLE `yii2_auth_item_child`
  ADD CONSTRAINT `yii2_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `yii2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `yii2_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `yii2_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
