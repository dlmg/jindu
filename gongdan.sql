/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : gongdan

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-03-13 17:51:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for think_client
-- ----------------------------
DROP TABLE IF EXISTS `think_client`;
CREATE TABLE `think_client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `khName` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '客户登录名',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `truename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of think_client
-- ----------------------------
INSERT INTO `think_client` VALUES ('1', 'kh1', '123456', '客户');

-- ----------------------------
-- Table structure for think_limit
-- ----------------------------
DROP TABLE IF EXISTS `think_limit`;
CREATE TABLE `think_limit` (
  `limit_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`limit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of think_limit
-- ----------------------------
INSERT INTO `think_limit` VALUES ('1', '管理员');
INSERT INTO `think_limit` VALUES ('2', '前端开发');
INSERT INTO `think_limit` VALUES ('3', '后端开发');
INSERT INTO `think_limit` VALUES ('4', '项目经理');
INSERT INTO `think_limit` VALUES ('5', '客户');
INSERT INTO `think_limit` VALUES ('6', 'UI设计');

-- ----------------------------
-- Table structure for think_profile
-- ----------------------------
DROP TABLE IF EXISTS `think_profile`;
CREATE TABLE `think_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `truename` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of think_profile
-- ----------------------------
INSERT INTO `think_profile` VALUES ('1', '管理员', '1');
INSERT INTO `think_profile` VALUES ('14', '王晨光', '6');
INSERT INTO `think_profile` VALUES ('15', '张文静', '7');

-- ----------------------------
-- Table structure for think_project
-- ----------------------------
DROP TABLE IF EXISTS `think_project`;
CREATE TABLE `think_project` (
  `id` int(11) NOT NULL COMMENT '项目编号',
  `proName` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '项目名称',
  `user_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT '项目成员ID',
  `client_id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '''暂无描述''',
  `status` smallint(6) DEFAULT '0',
  `buzhou` int(11) unsigned DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of think_project
-- ----------------------------
INSERT INTO `think_project` VALUES ('1', '员工宿舍管理系统', '1,6,7', '1', '信息管理', '0', '1', '2020-03-01 15:56:46');
INSERT INTO `think_project` VALUES ('2', '信息管理', '6,8,1', '1', '哈哈哈', '0', '1', '2020-02-07 16:21:26');

-- ----------------------------
-- Table structure for think_user
-- ----------------------------
DROP TABLE IF EXISTS `think_user`;
CREATE TABLE `think_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '3',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of think_user
-- ----------------------------
INSERT INTO `think_user` VALUES ('1', 'admin', 'admin', '1', '2020-03-04 16:46:22', '2020-03-13 11:54:45');
INSERT INTO `think_user` VALUES ('6', 'test', 'test', '3', '2020-03-13 14:57:23', '2020-03-13 14:57:23');
INSERT INTO `think_user` VALUES ('7', 'zwj', 'zwj', '3', '2020-03-13 14:57:48', '2020-03-13 14:57:48');
