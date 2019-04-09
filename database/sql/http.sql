/*
 Navicat Premium Data Transfer

 Source Server         : 开发
 Source Server Type    : MySQL
 Source Server Version : 50720
 Source Host           : 192.168.0.238:3306
 Source Schema         : laravel-package

 Target Server Type    : MySQL
 Target Server Version : 50720
 File Encoding         : 65001

 Date: 09/04/2019 14:31:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for e_request_1
-- ----------------------------
DROP TABLE IF EXISTS `e_request_1`;
CREATE TABLE `e_request_1` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id-61',
  `relation_id` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '类型 1、资源请求 2、第三方请求 3、第三方回调结果',
  `method` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `query` text CHARACTER SET utf8mb4 NOT NULL,
  `status` char(10) CHARACTER SET utf8mb4 NOT NULL,
  `body` mediumtext CHARACTER SET utf8mb4 NOT NULL,
  `cookies` text CHARACTER SET utf8mb4 NOT NULL,
  `headers` text CHARACTER SET utf8mb4 NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL ON UPDATE CURRENT_TIMESTAMP(6),
  `finish_time` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6119040900000080 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for id_61
-- ----------------------------
DROP TABLE IF EXISTS `id_61`;
CREATE TABLE `id_61` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stub` tinyint(1) NOT NULL COMMENT '该值不允许修改变更',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_stub` (`stub`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='订单ID';

SET FOREIGN_KEY_CHECKS = 1;
