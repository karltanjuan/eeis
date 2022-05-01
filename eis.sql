/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 100411
Source Host           : localhost:3306
Source Database       : eis

Target Server Type    : MYSQL
Target Server Version : 100411
File Encoding         : 65001

Date: 2021-05-11 21:31:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for activity_log
-- ----------------------------
DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of activity_log
-- ----------------------------

-- ----------------------------
-- Table structure for audits
-- ----------------------------
DROP TABLE IF EXISTS `audits`;
CREATE TABLE `audits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) unsigned NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_values` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(1023) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of audits
-- ----------------------------
INSERT INTO `audits` VALUES ('1', 'App\\User', '1', 'created', 'App\\CSSItem', '3', '[]', '{\"item_name\":\"css 3\",\"item_quantity\":\"19\",\"expired_at\":\"0000-00-00\",\"item_type\":\"Type 2\",\"item_status\":\"Defective\",\"id\":3}', 'http://localhost:8000/admin/css', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-08 19:48:44', '2021-05-08 19:48:44');
INSERT INTO `audits` VALUES ('2', 'App\\User', '1', 'updated', 'App\\CSSItem', '3', '{\"item_quantity\":19,\"expired_at\":\"0000-00-00 00:00:00\"}', '{\"item_quantity\":\"19.1\",\"expired_at\":null}', 'http://localhost:8000/admin/css/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-08 19:49:21', '2021-05-08 19:49:21');
INSERT INTO `audits` VALUES ('3', 'App\\User', '1', 'deleted', 'App\\CSSItem', '3', '{\"id\":3,\"item_name\":\"css 3\",\"item_quantity\":19,\"item_type\":\"Type 2\",\"item_status\":\"Defective\",\"expired_at\":\"0000-00-00 00:00:00\"}', '[]', 'http://localhost:8000/admin/css/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-08 19:53:22', '2021-05-08 19:53:22');
INSERT INTO `audits` VALUES ('4', 'App\\User', '1', 'created', 'App\\CSSItem', '4', '[]', '{\"item_name\":\"css 4\",\"item_quantity\":\"1\",\"expired_at\":\"0000-00-00\",\"item_type\":\"Type 1\",\"item_status\":\"Good\",\"id\":4}', 'http://localhost:8000/admin/css', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-08 19:57:38', '2021-05-08 19:57:38');
INSERT INTO `audits` VALUES ('5', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":5}', '{\"item_quantity\":3}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-08 20:01:11', '2021-05-08 20:01:11');
INSERT INTO `audits` VALUES ('6', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-08 20:01:11', '2021-05-08 20:01:11');
INSERT INTO `audits` VALUES ('7', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":3}', '{\"item_quantity\":5}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-08 20:01:42', '2021-05-08 20:01:42');
INSERT INTO `audits` VALUES ('8', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-08 20:01:42', '2021-05-08 20:01:42');
INSERT INTO `audits` VALUES ('9', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":5}', '{\"item_quantity\":4}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:12:44', '2021-05-09 12:12:44');
INSERT INTO `audits` VALUES ('10', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"4\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:12:44', '2021-05-09 12:12:44');
INSERT INTO `audits` VALUES ('11', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":4}', '{\"item_quantity\":3}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:17:47', '2021-05-09 12:17:47');
INSERT INTO `audits` VALUES ('12', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:17:47', '2021-05-09 12:17:47');
INSERT INTO `audits` VALUES ('13', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":3}', '{\"item_quantity\":2}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:18:28', '2021-05-09 12:18:28');
INSERT INTO `audits` VALUES ('14', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":2}', '{\"item_quantity\":1}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:18:55', '2021-05-09 12:18:55');
INSERT INTO `audits` VALUES ('15', 'App\\User', '1', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":5}', '{\"item_quantity\":3}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:21:03', '2021-05-09 12:21:03');
INSERT INTO `audits` VALUES ('16', 'App\\User', '1', 'updated', 'App\\BorrowItem', '1', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:21:03', '2021-05-09 12:21:03');
INSERT INTO `audits` VALUES ('17', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":1}', '{\"item_quantity\":0}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:24:11', '2021-05-09 12:24:11');
INSERT INTO `audits` VALUES ('18', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":0}', '{\"item_quantity\":-1}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:24:28', '2021-05-09 12:24:28');
INSERT INTO `audits` VALUES ('19', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":-1}', '{\"item_quantity\":-2}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:26:57', '2021-05-09 12:26:57');
INSERT INTO `audits` VALUES ('20', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":100}', '{\"item_quantity\":99}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:27:28', '2021-05-09 12:27:28');
INSERT INTO `audits` VALUES ('21', 'App\\User', '1', 'updated', 'App\\BorrowItem', '2', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:27:28', '2021-05-09 12:27:28');
INSERT INTO `audits` VALUES ('22', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":5}', '{\"item_quantity\":3}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:28:17', '2021-05-09 12:28:17');
INSERT INTO `audits` VALUES ('23', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:28:17', '2021-05-09 12:28:17');
INSERT INTO `audits` VALUES ('24', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":50}', '{\"item_quantity\":49}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:28:27', '2021-05-09 12:28:27');
INSERT INTO `audits` VALUES ('25', 'App\\User', '1', 'updated', 'App\\BorrowItem', '2', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:28:27', '2021-05-09 12:28:27');
INSERT INTO `audits` VALUES ('26', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":3}', '{\"item_quantity\":5}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:29:48', '2021-05-09 12:29:48');
INSERT INTO `audits` VALUES ('27', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:29:48', '2021-05-09 12:29:48');
INSERT INTO `audits` VALUES ('28', 'App\\User', '1', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":3}', '{\"item_quantity\":5}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:29:51', '2021-05-09 12:29:51');
INSERT INTO `audits` VALUES ('29', 'App\\User', '1', 'updated', 'App\\BorrowItem', '1', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:29:51', '2021-05-09 12:29:51');
INSERT INTO `audits` VALUES ('30', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":50}', '{\"item_quantity\":49}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:31:39', '2021-05-09 12:31:39');
INSERT INTO `audits` VALUES ('31', 'App\\User', '1', 'updated', 'App\\BorrowItem', '2', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:31:39', '2021-05-09 12:31:39');
INSERT INTO `audits` VALUES ('32', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":5}', '{\"item_quantity\":3}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:32:08', '2021-05-09 12:32:08');
INSERT INTO `audits` VALUES ('33', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:32:08', '2021-05-09 12:32:08');
INSERT INTO `audits` VALUES ('34', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":49}', '{\"item_quantity\":50}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:32:23', '2021-05-09 12:32:23');
INSERT INTO `audits` VALUES ('35', 'App\\User', '1', 'updated', 'App\\BorrowItem', '2', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:32:23', '2021-05-09 12:32:23');
INSERT INTO `audits` VALUES ('36', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":3}', '{\"item_quantity\":5}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:32:33', '2021-05-09 12:32:33');
INSERT INTO `audits` VALUES ('37', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:32:33', '2021-05-09 12:32:33');
INSERT INTO `audits` VALUES ('38', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"1\"}', '{\"status\":\"3\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:35:45', '2021-05-09 12:35:45');
INSERT INTO `audits` VALUES ('39', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"1\"}', '{\"status\":\"3\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:36:08', '2021-05-09 12:36:08');
INSERT INTO `audits` VALUES ('40', 'App\\User', '1', 'updated', 'App\\BorrowItem', '2', '{\"status\":\"1\"}', '{\"status\":\"3\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:37:39', '2021-05-09 12:37:39');
INSERT INTO `audits` VALUES ('41', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":5}', '{\"item_quantity\":3}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:38:03', '2021-05-09 12:38:03');
INSERT INTO `audits` VALUES ('42', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:38:03', '2021-05-09 12:38:03');
INSERT INTO `audits` VALUES ('43', 'App\\User', '1', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":3}', '{\"item_quantity\":5}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:38:38', '2021-05-09 12:38:38');
INSERT INTO `audits` VALUES ('44', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 12:38:38', '2021-05-09 12:38:38');
INSERT INTO `audits` VALUES ('45', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":50}', '{\"item_quantity\":49}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 13:44:26', '2021-05-09 13:44:26');
INSERT INTO `audits` VALUES ('46', 'App\\User', '1', 'updated', 'App\\BorrowItem', '2', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 13:44:26', '2021-05-09 13:44:26');
INSERT INTO `audits` VALUES ('47', 'App\\User', '3', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":49}', '{\"item_quantity\":-8}', 'http://localhost:8000/epas_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 16:36:11', '2021-05-09 16:36:11');
INSERT INTO `audits` VALUES ('48', 'App\\User', '3', 'updated', 'App\\BorrowItem', '1', '{\"status\":\"4\"}', '{\"status\":1}', 'http://localhost:8000/epas_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 16:36:11', '2021-05-09 16:36:11');
INSERT INTO `audits` VALUES ('49', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":49}', '{\"item_quantity\":48}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 16:53:52', '2021-05-09 16:53:52');
INSERT INTO `audits` VALUES ('50', 'App\\User', '1', 'updated', 'App\\BorrowItem', '2', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 16:53:52', '2021-05-09 16:53:52');
INSERT INTO `audits` VALUES ('51', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"1\"}', '{\"status\":\"3\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 16:53:59', '2021-05-09 16:53:59');
INSERT INTO `audits` VALUES ('52', 'App\\User', '3', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":48}', '{\"item_quantity\":-8}', 'http://localhost:8000/epas_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 16:57:18', '2021-05-09 16:57:18');
INSERT INTO `audits` VALUES ('53', 'App\\User', '3', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":48}', '{\"item_quantity\":40}', 'http://localhost:8000/epas_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 16:58:03', '2021-05-09 16:58:03');
INSERT INTO `audits` VALUES ('54', 'App\\User', '3', 'created', 'App\\BorrowItem', '4', '[]', '{\"user_id\":3,\"item_id\":\"1\",\"quantity\":\"8\",\"category\":\"EPAS\",\"status\":1,\"is_returned\":0,\"id\":4}', 'http://localhost:8000/epas_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 16:58:03', '2021-05-09 16:58:03');
INSERT INTO `audits` VALUES ('55', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":40}', '{\"item_quantity\":41}', 'http://localhost:8000/admin/borrow/4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:01:21', '2021-05-09 17:01:21');
INSERT INTO `audits` VALUES ('56', 'App\\User', '1', 'updated', 'App\\BorrowItem', '2', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:01:21', '2021-05-09 17:01:21');
INSERT INTO `audits` VALUES ('57', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":41}', '{\"item_quantity\":33}', 'http://localhost:8000/admin/borrow/4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:01:51', '2021-05-09 17:01:51');
INSERT INTO `audits` VALUES ('58', 'App\\User', '1', 'updated', 'App\\BorrowItem', '4', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:01:51', '2021-05-09 17:01:51');
INSERT INTO `audits` VALUES ('59', 'App\\User', '3', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":33}', '{\"item_quantity\":0}', 'http://localhost:8000/epas_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:02:19', '2021-05-09 17:02:19');
INSERT INTO `audits` VALUES ('60', 'App\\User', '3', 'created', 'App\\BorrowItem', '5', '[]', '{\"user_id\":3,\"item_id\":\"1\",\"quantity\":\"33\",\"category\":\"EPAS\",\"status\":1,\"is_returned\":0,\"id\":5}', 'http://localhost:8000/epas_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:02:19', '2021-05-09 17:02:19');
INSERT INTO `audits` VALUES ('61', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":0}', '{\"item_quantity\":-33}', 'http://localhost:8000/admin/borrow/5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:02:47', '2021-05-09 17:02:47');
INSERT INTO `audits` VALUES ('62', 'App\\User', '1', 'updated', 'App\\BorrowItem', '5', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:02:47', '2021-05-09 17:02:47');
INSERT INTO `audits` VALUES ('63', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":-33}', '{\"item_quantity\":0}', 'http://localhost:8000/admin/borrow/5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:02:53', '2021-05-09 17:02:53');
INSERT INTO `audits` VALUES ('64', 'App\\User', '1', 'updated', 'App\\BorrowItem', '5', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:02:53', '2021-05-09 17:02:53');
INSERT INTO `audits` VALUES ('65', 'App\\User', '3', 'updated', 'App\\EPASItem', '2', '{\"item_quantity\":5}', '{\"item_quantity\":0}', 'http://localhost:8000/epas_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:04:34', '2021-05-09 17:04:34');
INSERT INTO `audits` VALUES ('66', 'App\\User', '3', 'created', 'App\\BorrowItem', '6', '[]', '{\"user_id\":3,\"item_id\":\"2\",\"quantity\":\"5\",\"category\":\"EPAS\",\"status\":1,\"is_returned\":0,\"id\":6}', 'http://localhost:8000/epas_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:04:34', '2021-05-09 17:04:34');
INSERT INTO `audits` VALUES ('67', 'App\\User', '3', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":50}', '{\"item_quantity\":40}', 'http://localhost:8000/epas_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:09:43', '2021-05-09 17:09:43');
INSERT INTO `audits` VALUES ('68', 'App\\User', '3', 'created', 'App\\BorrowItem', '1', '[]', '{\"user_id\":3,\"item_id\":\"1\",\"quantity\":\"10\",\"category\":\"EPAS\",\"status\":1,\"is_returned\":0,\"id\":1}', 'http://localhost:8000/epas_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:09:43', '2021-05-09 17:09:43');
INSERT INTO `audits` VALUES ('69', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":40}', '{\"item_quantity\":30}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:31:20', '2021-05-09 17:31:20');
INSERT INTO `audits` VALUES ('70', 'App\\User', '1', 'updated', 'App\\BorrowItem', '1', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:31:20', '2021-05-09 17:31:20');
INSERT INTO `audits` VALUES ('71', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":30}', '{\"item_quantity\":40}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:32:29', '2021-05-09 17:32:29');
INSERT INTO `audits` VALUES ('72', 'App\\User', '1', 'updated', 'App\\BorrowItem', '1', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:32:29', '2021-05-09 17:32:29');
INSERT INTO `audits` VALUES ('73', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":40}', '{\"item_quantity\":30}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:38:55', '2021-05-09 17:38:55');
INSERT INTO `audits` VALUES ('74', 'App\\User', '1', 'updated', 'App\\BorrowItem', '1', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:38:55', '2021-05-09 17:38:55');
INSERT INTO `audits` VALUES ('75', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":30}', '{\"item_quantity\":40}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:40:21', '2021-05-09 17:40:21');
INSERT INTO `audits` VALUES ('76', 'App\\User', '1', 'updated', 'App\\BorrowItem', '1', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-09 17:40:21', '2021-05-09 17:40:21');
INSERT INTO `audits` VALUES ('77', 'App\\User', '2', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":5}', '{\"item_quantity\":3}', 'http://localhost:8000/css_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:09:25', '2021-05-10 19:09:25');
INSERT INTO `audits` VALUES ('78', 'App\\User', '2', 'created', 'App\\BorrowItem', '2', '[]', '{\"user_id\":2,\"item_id\":\"1\",\"quantity\":\"2\",\"category\":\"CSS\",\"status\":1,\"is_returned\":0,\"id\":2}', 'http://localhost:8000/css_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:09:25', '2021-05-10 19:09:25');
INSERT INTO `audits` VALUES ('79', 'App\\User', '2', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":3}', '{\"item_quantity\":1}', 'http://localhost:8000/css_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:16:44', '2021-05-10 19:16:44');
INSERT INTO `audits` VALUES ('80', 'App\\User', '2', 'created', 'App\\BorrowItem', '3', '[]', '{\"user_id\":2,\"item_id\":\"1\",\"quantity\":\"2\",\"category\":\"CSS\",\"status\":1,\"is_returned\":0,\"id\":3}', 'http://localhost:8000/css_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:16:44', '2021-05-10 19:16:44');
INSERT INTO `audits` VALUES ('81', 'App\\User', '1', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":1}', '{\"item_quantity\":-1}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:17:06', '2021-05-10 19:17:06');
INSERT INTO `audits` VALUES ('82', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:17:06', '2021-05-10 19:17:06');
INSERT INTO `audits` VALUES ('83', 'App\\User', '1', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":-1}', '{\"item_quantity\":1}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:17:13', '2021-05-10 19:17:13');
INSERT INTO `audits` VALUES ('84', 'App\\User', '1', 'updated', 'App\\BorrowItem', '3', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:17:13', '2021-05-10 19:17:13');
INSERT INTO `audits` VALUES ('85', 'App\\User', '2', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":3}', '{\"item_quantity\":1}', 'http://localhost:8000/css_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:20:53', '2021-05-10 19:20:53');
INSERT INTO `audits` VALUES ('86', 'App\\User', '2', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":3}', '{\"item_quantity\":1}', 'http://localhost:8000/css_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:21:24', '2021-05-10 19:21:24');
INSERT INTO `audits` VALUES ('87', 'App\\User', '2', 'created', 'App\\BorrowItem', '4', '[]', '{\"user_id\":2,\"item_id\":\"1\",\"quantity\":\"2\",\"category\":\"CSS\",\"status\":1,\"is_returned\":0,\"id\":4}', 'http://localhost:8000/css_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:21:24', '2021-05-10 19:21:24');
INSERT INTO `audits` VALUES ('88', 'App\\User', '2', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":3}', '{\"item_quantity\":1}', 'http://localhost:8000/css_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:22:32', '2021-05-10 19:22:32');
INSERT INTO `audits` VALUES ('89', 'App\\User', '2', 'created', 'App\\BorrowItem', '5', '[]', '{\"user_id\":2,\"item_id\":\"1\",\"quantity\":\"2\",\"category\":\"CSS\",\"status\":1,\"is_returned\":0,\"id\":5}', 'http://localhost:8000/css_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:22:32', '2021-05-10 19:22:32');
INSERT INTO `audits` VALUES ('90', 'App\\User', '1', 'updated', 'App\\BorrowItem', '5', '{\"status\":\"1\"}', '{\"status\":\"3\"}', 'http://localhost:8000/admin/borrow/5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:23:12', '2021-05-10 19:23:12');
INSERT INTO `audits` VALUES ('91', 'App\\User', '1', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":3}', '{\"item_quantity\":1}', 'http://localhost:8000/admin/borrow/5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:24:28', '2021-05-10 19:24:28');
INSERT INTO `audits` VALUES ('92', 'App\\User', '1', 'updated', 'App\\BorrowItem', '5', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:24:28', '2021-05-10 19:24:28');
INSERT INTO `audits` VALUES ('93', 'App\\User', '1', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":1}', '{\"item_quantity\":3}', 'http://localhost:8000/admin/borrow/5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:25:00', '2021-05-10 19:25:00');
INSERT INTO `audits` VALUES ('94', 'App\\User', '1', 'updated', 'App\\BorrowItem', '5', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:25:00', '2021-05-10 19:25:00');
INSERT INTO `audits` VALUES ('95', 'App\\User', '2', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":3}', '{\"item_quantity\":0}', 'http://localhost:8000/css_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:25:40', '2021-05-10 19:25:40');
INSERT INTO `audits` VALUES ('96', 'App\\User', '2', 'created', 'App\\BorrowItem', '6', '[]', '{\"user_id\":2,\"item_id\":\"1\",\"quantity\":\"3\",\"category\":\"CSS\",\"status\":1,\"is_returned\":0,\"id\":6}', 'http://localhost:8000/css_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:25:40', '2021-05-10 19:25:40');
INSERT INTO `audits` VALUES ('97', 'App\\User', '1', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":0}', '{\"item_quantity\":-3}', 'http://localhost:8000/admin/borrow/6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:25:48', '2021-05-10 19:25:48');
INSERT INTO `audits` VALUES ('98', 'App\\User', '1', 'updated', 'App\\BorrowItem', '6', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:25:48', '2021-05-10 19:25:48');
INSERT INTO `audits` VALUES ('99', 'App\\User', '1', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":-3}', '{\"item_quantity\":0}', 'http://localhost:8000/admin/borrow/6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:25:57', '2021-05-10 19:25:57');
INSERT INTO `audits` VALUES ('100', 'App\\User', '1', 'updated', 'App\\BorrowItem', '6', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:25:57', '2021-05-10 19:25:57');
INSERT INTO `audits` VALUES ('101', 'App\\User', '2', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":5}', '{\"item_quantity\":3}', 'http://localhost:8000/css_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:26:41', '2021-05-10 19:26:41');
INSERT INTO `audits` VALUES ('102', 'App\\User', '2', 'created', 'App\\BorrowItem', '7', '[]', '{\"user_id\":2,\"item_id\":\"1\",\"quantity\":\"2\",\"category\":\"CSS\",\"status\":1,\"is_returned\":0,\"id\":7}', 'http://localhost:8000/css_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:26:41', '2021-05-10 19:26:41');
INSERT INTO `audits` VALUES ('103', 'App\\User', '1', 'updated', 'App\\BorrowItem', '7', '{\"status\":\"1\"}', '{\"status\":\"3\"}', 'http://localhost:8000/admin/borrow/7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:27:19', '2021-05-10 19:27:19');
INSERT INTO `audits` VALUES ('104', 'App\\User', '1', 'updated', 'App\\BorrowItem', '1', '{\"status\":\"1\"}', '{\"status\":\"3\"}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:29:20', '2021-05-10 19:29:20');
INSERT INTO `audits` VALUES ('105', 'App\\User', '1', 'updated', 'App\\BorrowItem', '1', '{\"status\":\"1\"}', '{\"status\":\"3\"}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:31:41', '2021-05-10 19:31:41');
INSERT INTO `audits` VALUES ('106', 'App\\User', '1', 'updated', 'App\\BorrowItem', '1', '{\"status\":\"1\"}', '{\"status\":\"3\"}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:32:30', '2021-05-10 19:32:30');
INSERT INTO `audits` VALUES ('107', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":40}', '{\"item_quantity\":50}', 'http://localhost:8000/admin/borrow/1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:32:30', '2021-05-10 19:32:30');
INSERT INTO `audits` VALUES ('108', 'App\\User', '1', 'updated', 'App\\BorrowItem', '6', '{\"status\":\"1\"}', '{\"status\":\"3\"}', 'http://localhost:8000/admin/borrow/6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:33:11', '2021-05-10 19:33:11');
INSERT INTO `audits` VALUES ('109', 'App\\User', '1', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":7}', '{\"item_quantity\":10}', 'http://localhost:8000/admin/borrow/6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-10 19:33:11', '2021-05-10 19:33:11');
INSERT INTO `audits` VALUES ('110', 'App\\User', '3', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":50}', '{\"item_quantity\":37}', 'http://localhost:8000/epas_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-11 20:26:24', '2021-05-11 20:26:24');
INSERT INTO `audits` VALUES ('111', 'App\\User', '3', 'created', 'App\\BorrowItem', '8', '[]', '{\"user_id\":3,\"item_id\":\"1\",\"quantity\":\"13\",\"category\":\"EPAS\",\"status\":1,\"is_returned\":0,\"id\":8}', 'http://localhost:8000/epas_user/available', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-11 20:26:24', '2021-05-11 20:26:24');
INSERT INTO `audits` VALUES ('112', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":37}', '{\"item_quantity\":24}', 'http://localhost:8000/admin/borrow/8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-11 20:28:36', '2021-05-11 20:28:36');
INSERT INTO `audits` VALUES ('113', 'App\\User', '1', 'updated', 'App\\BorrowItem', '8', '{\"status\":\"1\"}', '{\"status\":\"2\"}', 'http://localhost:8000/admin/borrow/8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-11 20:28:36', '2021-05-11 20:28:36');
INSERT INTO `audits` VALUES ('114', 'App\\User', '1', 'updated', 'App\\EPASItem', '1', '{\"item_quantity\":24}', '{\"item_quantity\":37}', 'http://localhost:8000/admin/borrow/8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-11 20:29:50', '2021-05-11 20:29:50');
INSERT INTO `audits` VALUES ('115', 'App\\User', '1', 'updated', 'App\\BorrowItem', '8', '{\"status\":\"2\",\"is_returned\":0}', '{\"status\":\"4\",\"is_returned\":1}', 'http://localhost:8000/admin/borrow/8', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-11 20:29:50', '2021-05-11 20:29:50');
INSERT INTO `audits` VALUES ('116', 'App\\User', '1', 'created', 'App\\CSSItem', '5', '[]', '{\"item_name\":\"css inventory 1\",\"item_quantity\":\"25\",\"expired_at\":\"2021-05-11\",\"item_type\":\"Type 1\",\"item_status\":\"Brand New\",\"id\":5}', 'http://localhost:8000/admin/css', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-11 20:30:47', '2021-05-11 20:30:47');
INSERT INTO `audits` VALUES ('117', 'App\\User', '1', 'updated', 'App\\CSSItem', '5', '{\"item_name\":\"css inventory 1\",\"expired_at\":\"2021-05-11 00:00:00\"}', '{\"item_name\":\"css inventory 1.5\",\"expired_at\":\"2021-05-11\"}', 'http://localhost:8000/admin/css/5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-11 20:31:02', '2021-05-11 20:31:02');
INSERT INTO `audits` VALUES ('118', 'App\\User', '1', 'deleted', 'App\\CSSItem', '5', '{\"id\":5,\"item_name\":\"css inventory 1.5\",\"item_quantity\":25,\"item_type\":\"Type 1\",\"item_status\":\"Brand New\",\"expired_at\":\"2021-05-11 00:00:00\"}', '[]', 'http://localhost:8000/admin/css/5', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-11 20:31:08', '2021-05-11 20:31:08');
INSERT INTO `audits` VALUES ('119', 'App\\User', '1', 'updated', 'App\\BorrowItem', '7', '{\"status\":\"1\"}', '{\"status\":\"3\"}', 'http://localhost:8080/admin/borrow/7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-11 21:02:40', '2021-05-11 21:02:40');
INSERT INTO `audits` VALUES ('120', 'App\\User', '1', 'updated', 'App\\CSSItem', '1', '{\"item_quantity\":10}', '{\"item_quantity\":12}', 'http://localhost:8080/admin/borrow/7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36', null, '2021-05-11 21:02:40', '2021-05-11 21:02:40');

-- ----------------------------
-- Table structure for borrow_items
-- ----------------------------
DROP TABLE IF EXISTS `borrow_items`;
CREATE TABLE `borrow_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_returned` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of borrow_items
-- ----------------------------
INSERT INTO `borrow_items` VALUES ('1', '3', '1', '10', 'EPAS', '3', '0', '2021-05-09 17:09:43', '2021-05-10 19:32:30');
INSERT INTO `borrow_items` VALUES ('5', '2', '1', '2', 'CSS', '4', '1', '2021-05-10 19:22:32', '2021-05-10 19:25:00');
INSERT INTO `borrow_items` VALUES ('6', '2', '1', '3', 'CSS', '3', '0', '2021-05-10 19:25:40', '2021-05-10 19:33:11');
INSERT INTO `borrow_items` VALUES ('7', '2', '1', '2', 'CSS', '3', '0', '2021-05-10 19:26:41', '2021-05-11 21:02:40');
INSERT INTO `borrow_items` VALUES ('8', '3', '1', '13', 'EPAS', '4', '1', '2021-05-11 20:26:24', '2021-05-11 20:29:50');

-- ----------------------------
-- Table structure for c_s_s_items
-- ----------------------------
DROP TABLE IF EXISTS `c_s_s_items`;
CREATE TABLE `c_s_s_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of c_s_s_items
-- ----------------------------
INSERT INTO `c_s_s_items` VALUES ('1', 'css 1', '12', 'Type 1', 'Brand New', '0000-00-00 00:00:00', '2021-05-08 15:48:41', '2021-05-11 21:02:40');
INSERT INTO `c_s_s_items` VALUES ('2', 'css 2', '6', 'Type 1', 'Brand New', '0000-00-00 00:00:00', '2021-05-08 15:48:48', '2021-05-08 15:48:48');
INSERT INTO `c_s_s_items` VALUES ('4', 'css 4', '1', 'Type 1', 'Good', '0000-00-00 00:00:00', '2021-05-08 19:57:38', '2021-05-08 19:57:38');

-- ----------------------------
-- Table structure for epas_items
-- ----------------------------
DROP TABLE IF EXISTS `epas_items`;
CREATE TABLE `epas_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `item_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of epas_items
-- ----------------------------
INSERT INTO `epas_items` VALUES ('1', 'epas 1', '37', 'Type 1', 'Brand New', '0000-00-00 00:00:00', '2021-05-08 15:48:59', '2021-05-11 20:29:50');
INSERT INTO `epas_items` VALUES ('2', 'epas 2', '25', 'Type 1', 'Good', '0000-00-00 00:00:00', '2021-05-08 15:49:07', '2021-05-09 17:04:34');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('4', '2021_05_01_084543_create_c_s_s_items_table', '1');
INSERT INTO `migrations` VALUES ('5', '2021_05_04_145107_create_epas_items_table', '1');
INSERT INTO `migrations` VALUES ('6', '2021_05_05_160847_create_activity_log_table', '1');
INSERT INTO `migrations` VALUES ('7', '2021_05_08_135714_create_borrow_items_table', '1');
INSERT INTO `migrations` VALUES ('8', '2021_05_08_193612_create_audits_table', '2');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('epas@test.com', '$2y$10$GAc5ENkAp8sQEKOQDknR.eQ3KGS6PIO.h1biSkDf82s7gx0Mr8yzS', '2021-05-11 20:32:28');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_epas` tinyint(1) NOT NULL,
  `is_css` tinyint(1) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Admin', 'admin@test.com', '1', '0', '0', null, '$2y$10$xeUU1wAd2aMZtz29KHBfWegFtBER/Hp1zUFEaUI303104Y9FJnFZW', null, '2021-05-08 15:47:51', '2021-05-08 15:47:51');
INSERT INTO `users` VALUES ('2', 'CSS User 1', 'css@test.com', '0', '0', '1', null, '$2y$10$3kVdF2PAXMORSoPMd73.bOVBQZN3Uw9uOULUBx5HQrNKXlr3EjStq', null, '2021-05-08 15:47:51', '2021-05-11 21:01:31');
INSERT INTO `users` VALUES ('3', 'EPAS User 1', 'epas@test.com', '0', '1', '0', null, '$2y$10$Yp9NptGOKKcma8v9l/7RJ.lcDGTJQNFGBJjoYo9zYCxsM59JF20cG', null, '2021-05-08 15:47:51', '2021-05-09 14:57:25');
SET FOREIGN_KEY_CHECKS=1;
