/*
Navicat MySQL Data Transfer

Source Server         : 123
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : tp

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-07-28 17:44:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_admin
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(50) DEFAULT NULL COMMENT '用户名',
  `password` varchar(60) DEFAULT NULL COMMENT '密码',
  `status` enum('0','1') DEFAULT '1' COMMENT '状态:0=隐藏,1=显示',
  `realname` varchar(60) DEFAULT NULL COMMENT '真实名称',
  `image` varchar(255) DEFAULT NULL COMMENT '图片',
  `tel` varchar(20) DEFAULT NULL COMMENT '电话',
  `email` varchar(60) DEFAULT NULL COMMENT '邮箱',
  `info` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `delete_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES ('1', 'admin', '4297f44b13955235245b2497399d7a93', '1', null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for t_adminlog
-- ----------------------------
DROP TABLE IF EXISTS `t_adminlog`;
CREATE TABLE `t_adminlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '操作用户id',
  `content` varchar(255) DEFAULT NULL COMMENT '操作事项',
  `create_time` int(10) DEFAULT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_adminlog
-- ----------------------------

-- ----------------------------
-- Table structure for t_art
-- ----------------------------
DROP TABLE IF EXISTS `t_art`;
CREATE TABLE `t_art` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_art
-- ----------------------------
INSERT INTO `t_art` VALUES ('1', 'aaa', '1');
INSERT INTO `t_art` VALUES ('2', 'bbb', '2');
INSERT INTO `t_art` VALUES ('3', 'ccc', '1');
INSERT INTO `t_art` VALUES ('4', 'ddd', '1');
INSERT INTO `t_art` VALUES ('5', 'ewr', '3');
INSERT INTO `t_art` VALUES ('6', 'eww', '2');
INSERT INTO `t_art` VALUES ('7', 'qweqwe', '3');
INSERT INTO `t_art` VALUES ('8', 'qweweweww', '1');

-- ----------------------------
-- Table structure for t_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `t_auth_group`;
CREATE TABLE `t_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_auth_group
-- ----------------------------

-- ----------------------------
-- Table structure for t_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `t_auth_group_access`;
CREATE TABLE `t_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_auth_group_access
-- ----------------------------

-- ----------------------------
-- Table structure for t_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `t_auth_rule`;
CREATE TABLE `t_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `icon` varchar(50) DEFAULT NULL COMMENT 'icon',
  `pid` mediumint(8) DEFAULT NULL COMMENT '父id',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_auth_rule
-- ----------------------------
INSERT INTO `t_auth_rule` VALUES ('1', '控制面板', 'console', 'mdi-home', '0', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('2', '查看', '/console/index', null, '1', '1', '0', '');
INSERT INTO `t_auth_rule` VALUES ('3', '权限管理', 'auth', 'mdi-human-male', '0', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('4', '管理员管理', '/auth/admin', 'mdi-account', '3', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('5', '查看', '/auth/admin/index', null, '4', '1', '0', '');
INSERT INTO `t_auth_rule` VALUES ('6', '添加', '/auth/admin/add', null, '4', '1', '0', '');
INSERT INTO `t_auth_rule` VALUES ('7', '编辑', '/auth/admin/edit', null, '4', '1', '0', '');
INSERT INTO `t_auth_rule` VALUES ('8', '删除', '/auth/admin/del', null, '4', '1', '0', '');
INSERT INTO `t_auth_rule` VALUES ('9', '角色管理', '/auth/role', 'mdi-account-multiple', '3', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('10', '查看', '/auth/role/index', null, '9', '1', '0', '');
INSERT INTO `t_auth_rule` VALUES ('11', '添加', '/auth/role/add', null, '9', '1', '0', '');
INSERT INTO `t_auth_rule` VALUES ('12', '编辑', '/auth/role/edit', null, '9', '1', '0', '');
INSERT INTO `t_auth_rule` VALUES ('13', '删除', '/auth/role/del', null, '9', '1', '0', '');
INSERT INTO `t_auth_rule` VALUES ('14', '菜单管理', '/auth/rule', 'mdi-menu', '3', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('15', '查看', '/auth/rule/index', null, '14', '1', '0', '');
INSERT INTO `t_auth_rule` VALUES ('16', '添加', '/auth/rule/add', null, '14', '1', '0', '');
INSERT INTO `t_auth_rule` VALUES ('17', '编辑', '/auth/rule/edit', null, '14', '1', '0', '');
INSERT INTO `t_auth_rule` VALUES ('18', '删除', '/auth/rule/del', null, '14', '1', '0', '');

-- ----------------------------
-- Table structure for t_category
-- ----------------------------
DROP TABLE IF EXISTS `t_category`;
CREATE TABLE `t_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_category
-- ----------------------------
INSERT INTO `t_category` VALUES ('1', 'class1');
INSERT INTO `t_category` VALUES ('2', 'class2');
INSERT INTO `t_category` VALUES ('3', 'class3');
