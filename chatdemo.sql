/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50721
 Source Host           : localhost:3306
 Source Schema         : chatdemo

 Target Server Type    : MySQL
 Target Server Version : 50721
 File Encoding         : 65001

 Date: 16/11/2018 14:46:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, '屁桃', 'e10adc3949ba59abbe56e057f20f883e', '2018-11-13 18:13:21', '2018-11-13 18:13:21');
INSERT INTO `users` VALUES (2, '乱序', 'e10adc3949ba59abbe56e057f20f883e', '2018-11-14 08:21:45', '2018-11-14 08:21:45');
INSERT INTO `users` VALUES (3, 'aaa', 'e10adc3949ba59abbe56e057f20f883e', '2018-11-14 10:28:14', '2018-11-14 10:28:14');
INSERT INTO `users` VALUES (4, 'ccc', 'e10adc3949ba59abbe56e057f20f883e', '2018-11-14 10:28:17', '2018-11-14 10:28:17');

SET FOREIGN_KEY_CHECKS = 1;
