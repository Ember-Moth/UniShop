
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
                              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                              `parent_id` bigint(20) NOT NULL DEFAULT '0',
                              `order` int(11) NOT NULL DEFAULT '0',
                              `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                              `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                              `extension` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
                              `show` tinyint(4) NOT NULL DEFAULT '1',
                              `created_at` timestamp NULL DEFAULT NULL,
                              `updated_at` timestamp NULL DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
BEGIN;
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (1, 0, 1, 'Index', 'feather icon-bar-chart-2', '/', '', 1, '2021-05-16 02:06:08', NULL);
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (2, 0, 2, 'Admin', 'feather icon-settings', '', '', 1, '2021-05-16 02:06:08', NULL);
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (3, 2, 3, 'Users', '', 'auth/users', '', 1, '2021-05-16 02:06:08', NULL);
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (4, 2, 4, 'Roles', '', 'auth/roles', '', 1, '2021-05-16 02:06:08', NULL);
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (5, 2, 5, 'Permission', '', 'auth/permissions', '', 1, '2021-05-16 02:06:08', NULL);
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (6, 2, 6, 'Menu', '', 'auth/menu', '', 1, '2021-05-16 02:06:08', NULL);
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (7, 2, 7, 'Extensions', '', 'auth/extensions', '', 1, '2021-05-16 02:06:08', NULL);
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (11, 0, 9, 'Goods_Manage', 'fa-shopping-bag', NULL, '', 1, '2021-05-16 11:39:55', '2021-05-23 20:44:20');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (12, 11, 11, 'Goods', 'fa-shopping-bag', '/goods', '', 1, '2021-05-16 11:44:35', '2021-05-23 20:44:20');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (13, 11, 10, 'Goods_Group', 'fa-star-half-o', '/goods-group', '', 1, '2021-05-16 17:08:43', '2021-05-23 20:44:20');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (14, 0, 12, 'Carmis_Manage', 'fa-credit-card-alt', NULL, '', 1, '2021-05-17 21:29:50', '2021-05-23 20:44:20');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (15, 14, 13, 'Carmis', 'fa-credit-card', '/carmis', '', 1, '2021-05-17 21:37:59', '2021-05-23 20:44:20');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (16, 14, 14, 'Import_Carmis', 'fa-plus-circle', '/import-carmis', '', 1, '2021-05-18 14:46:35', '2021-05-23 20:44:20');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (17, 18, 16, 'Coupon', 'fa-dollar', '/coupon', '', 1, '2021-05-18 17:29:53', '2021-05-23 20:44:20');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (18, 0, 15, 'Coupon_Manage', 'fa-diamond', NULL, '', 1, '2021-05-18 17:32:03', '2021-05-18 17:32:03');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (19, 0, 17, 'Configuration', 'fa-wrench', NULL, '', 1, '2021-05-20 20:06:47', '2021-05-23 20:44:20');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (20, 19, 18, 'Email_Template_Configuration', 'fa-envelope', '/emailtpl', '', 1, '2021-05-20 20:17:07', '2021-05-23 20:44:20');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (21, 19, 19, 'Pay_Configuration', 'fa-cc-visa', '/payment', '', 1, '2021-05-20 20:41:24', '2025-09-04 12:19:17');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (22, 0, 8, 'Order_Manage', 'fa-table', NULL, '', 1, '2021-05-23 20:43:43', '2021-05-23 20:44:20');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (23, 22, 20, 'Order', 'fa-heart', '/order', '', 1, '2021-05-23 20:46:13', '2021-05-23 20:47:16');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (24, 19, 21, 'System_Setting', 'fa-cogs', '/system-setting', '', 1, '2021-05-26 10:26:34', '2021-05-26 10:26:34');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (25, 19, 22, 'Email_Test', 'fa-envelope', '/email-test', '', 1, '2022-07-26 12:09:34', '2022-07-26 12:17:21');
INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES (26, 19, 23, 'Supplier_Configuration', 'fa-anchor', '/supplier', '', 1, '2025-09-18 09:56:38', '2025-09-18 09:56:38');
COMMIT;

-- ----------------------------
-- Table structure for admin_permission_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_permission_menu`;
CREATE TABLE `admin_permission_menu` (
                                         `permission_id` bigint(20) NOT NULL,
                                         `menu_id` bigint(20) NOT NULL,
                                         `created_at` timestamp NULL DEFAULT NULL,
                                         `updated_at` timestamp NULL DEFAULT NULL,
                                         UNIQUE KEY `admin_permission_menu_permission_id_menu_id_unique` (`permission_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_permission_menu
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions` (
                                     `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                     `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `http_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                     `http_path` text COLLATE utf8mb4_unicode_ci,
                                     `order` int(11) NOT NULL DEFAULT '0',
                                     `parent_id` bigint(20) NOT NULL DEFAULT '0',
                                     `created_at` timestamp NULL DEFAULT NULL,
                                     `updated_at` timestamp NULL DEFAULT NULL,
                                     PRIMARY KEY (`id`),
                                     UNIQUE KEY `admin_permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
BEGIN;
INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES (1, 'Auth management', 'auth-management', '', '', 1, 0, '2021-05-16 02:06:08', NULL);
INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES (2, 'Users', 'users', '', '/auth/users*', 2, 1, '2021-05-16 02:06:08', NULL);
INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES (3, 'Roles', 'roles', '', '/auth/roles*', 3, 1, '2021-05-16 02:06:08', NULL);
INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES (4, 'Permissions', 'permissions', '', '/auth/permissions*', 4, 1, '2021-05-16 02:06:08', NULL);
INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES (5, 'Menu', 'menu', '', '/auth/menu*', 5, 1, '2021-05-16 02:06:08', NULL);
INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES (6, 'Extension', 'extension', '', '/auth/extensions*', 6, 1, '2021-05-16 02:06:08', NULL);
COMMIT;

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu` (
                                   `role_id` bigint(20) NOT NULL,
                                   `menu_id` bigint(20) NOT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL,
                                   UNIQUE KEY `admin_role_menu_role_id_menu_id_unique` (`role_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for admin_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_permissions`;
CREATE TABLE `admin_role_permissions` (
                                          `role_id` bigint(20) NOT NULL,
                                          `permission_id` bigint(20) NOT NULL,
                                          `created_at` timestamp NULL DEFAULT NULL,
                                          `updated_at` timestamp NULL DEFAULT NULL,
                                          UNIQUE KEY `admin_role_permissions_role_id_permission_id_unique` (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_role_permissions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for admin_role_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_users`;
CREATE TABLE `admin_role_users` (
                                    `role_id` bigint(20) NOT NULL,
                                    `user_id` bigint(20) NOT NULL,
                                    `created_at` timestamp NULL DEFAULT NULL,
                                    `updated_at` timestamp NULL DEFAULT NULL,
                                    UNIQUE KEY `admin_role_users_role_id_user_id_unique` (`role_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_role_users
-- ----------------------------
BEGIN;
INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES (1, 1, '2021-05-16 02:06:08', '2021-05-16 02:06:08');
COMMIT;

-- ----------------------------
-- Table structure for admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles` (
                               `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                               `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `created_at` timestamp NULL DEFAULT NULL,
                               `updated_at` timestamp NULL DEFAULT NULL,
                               PRIMARY KEY (`id`),
                               UNIQUE KEY `admin_roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_roles
-- ----------------------------
BEGIN;
INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES (1, 'Administrator', 'administrator', '2021-05-16 02:06:08', '2021-05-16 02:06:08');
COMMIT;

-- ----------------------------
-- Table structure for admin_settings
-- ----------------------------
DROP TABLE IF EXISTS `admin_settings`;
CREATE TABLE `admin_settings` (
                                  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `created_at` timestamp NULL DEFAULT NULL,
                                  `updated_at` timestamp NULL DEFAULT NULL,
                                  PRIMARY KEY (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_settings
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
                               `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                               `username` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                               `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                               `created_at` timestamp NULL DEFAULT NULL,
                               `updated_at` timestamp NULL DEFAULT NULL,
                               PRIMARY KEY (`id`),
                               UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
BEGIN;
INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'admin', '$2y$10$e7z99Mhxm9BOHL55xHZTx.QcNTZJC6ftRXHCR/ZkBja/jBeasVeBy', 'Administrator', NULL, 'tirO2MHaeTMwsOXLa2BNRPD0AUMItutwyN0PQAUfPD7w9TYJ1eu0bYkH1siH', '2021-05-16 02:06:08', '2021-05-16 02:06:08');
COMMIT;

-- ----------------------------
-- Table structure for balance_logs
-- ----------------------------
DROP TABLE IF EXISTS `balance_logs`;
CREATE TABLE `balance_logs` (
                                `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                `log_sn` varchar(150) NOT NULL COMMENT '变动流水号',
                                `user_id` bigint(20) NOT NULL COMMENT '用户ID',
                                `type` tinyint(4) NOT NULL COMMENT '变动类型:1-充值,2-消费,3-退款,4-奖励,5-扣除,6-转账转入,7-转账转出',
                                `amount` decimal(10,2) NOT NULL COMMENT '变动金额(正数为增加，负数为减少)',
                                `balance_before` decimal(10,2) NOT NULL COMMENT '变动前余额',
                                `balance_after` decimal(10,2) NOT NULL COMMENT '变动后余额',
                                `source_type` varchar(100) DEFAULT NULL COMMENT '来源类型:recharge_order,order,refund,reward,manual',
                                `source_id` bigint(20) DEFAULT NULL COMMENT '来源ID',
                                `title` varchar(200) NOT NULL COMMENT '变动标题',
                                `description` text COMMENT '变动描述',
                                `admin_user` varchar(100) DEFAULT NULL COMMENT '操作管理员(手动操作时)',
                                `extra_data` json DEFAULT NULL COMMENT '扩展数据',
                                `created_at` timestamp NULL DEFAULT NULL,
                                `updated_at` timestamp NULL DEFAULT NULL,
                                PRIMARY KEY (`id`),
                                UNIQUE KEY `log_sn` (`log_sn`),
                                KEY `idx_user_id` (`user_id`),
                                KEY `idx_type` (`type`),
                                KEY `idx_source_type_id` (`source_type`,`source_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;


-- ----------------------------
-- Table structure for carmis
-- ----------------------------
DROP TABLE IF EXISTS `carmis`;
CREATE TABLE `carmis` (
                          `id` bigint(20) NOT NULL AUTO_INCREMENT,
                          `goods_id` int(11) NOT NULL COMMENT '所属商品',
                          `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1未售出 2已售出',
                          `is_loop` tinyint(1) NOT NULL DEFAULT '0' COMMENT '循环卡密 1是 0否',
                          `carmi` text COLLATE utf8_unicode_ci NOT NULL COMMENT '卡密',
                          `created_at` timestamp NULL DEFAULT NULL,
                          `updated_at` timestamp NULL DEFAULT NULL,
                          `deleted_at` timestamp NULL DEFAULT NULL,
                          PRIMARY KEY (`id`),
                          KEY `idx_goods_id` (`goods_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='卡密表';

-- ----------------------------
-- Records of carmis
-- ----------------------------
BEGIN;
INSERT INTO `carmis` (`id`, `goods_id`, `status`, `is_loop`, `carmi`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 1, 2, 0, '111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111\r\n111111', '2025-09-04 10:40:38', '2025-09-23 16:03:19', '2025-09-23 16:03:19');
INSERT INTO `carmis` (`id`, `goods_id`, `status`, `is_loop`, `carmi`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 5, 2, 0, 'dsfdsfdsfdsf\r\nsdfdsfdsfds\r\nsdfdsfdsfdsf\r\nsdfdsfdsfdsf', '2025-09-24 22:22:56', '2025-09-25 14:17:10', NULL);
INSERT INTO `carmis` (`id`, `goods_id`, `status`, `is_loop`, `carmi`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 5, 2, 0, 'SDFSDFDSF\r\nSDFSDFSDFDS\r\nSDFSDFDS\r\nSDFDSFDS\r\nSDFDSFDSF\r\nSDFSDF\r\nSDFSDF', '2025-09-25 14:18:54', '2025-09-25 14:19:05', NULL);
INSERT INTO `carmis` (`id`, `goods_id`, `status`, `is_loop`, `carmi`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 5, 1, 0, 'sdfsdfdsf\r\nsdfdsafadsaf\r\nsdfsdafadsf\r\nsdfdsfds', '2025-09-28 07:56:04', '2025-09-28 07:56:04', NULL);
COMMIT;

-- ----------------------------
-- Table structure for coupons
-- ----------------------------
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
                           `id` int(11) NOT NULL AUTO_INCREMENT,
                           `discount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '优惠金额',
                           `is_use` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否已经使用 1未使用 2已使用',
                           `is_open` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用 1是 0否',
                           `coupon` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT '优惠码',
                           `ret` int(11) NOT NULL DEFAULT '0' COMMENT '剩余使用次数',
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL,
                           `deleted_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`),
                           UNIQUE KEY `idx_coupon` (`coupon`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='优惠码表';

-- ----------------------------
-- Records of coupons
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for coupons_goods
-- ----------------------------
DROP TABLE IF EXISTS `coupons_goods`;
CREATE TABLE `coupons_goods` (
                                 `id` int(11) NOT NULL AUTO_INCREMENT,
                                 `goods_id` int(11) NOT NULL COMMENT '商品id',
                                 `coupons_id` int(11) NOT NULL COMMENT '优惠码id',
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='优惠码关联商品表';

-- ----------------------------
-- Records of coupons_goods
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for email_otp_log
-- ----------------------------
DROP TABLE IF EXISTS `email_otp_log`;
CREATE TABLE `email_otp_log` (
                                 `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
                                 `type` varchar(64) DEFAULT NULL COMMENT '类型',
                                 `user_id` bigint(20) NOT NULL DEFAULT '0',
                                 `email` varchar(255) NOT NULL DEFAULT '' COMMENT 'Email',
                                 `code` varchar(10) DEFAULT '' COMMENT '验证码',
                                 `error_msg` varchar(255) DEFAULT NULL COMMENT '发送短信异常内容',
                                 `status` tinyint(4) DEFAULT '0' COMMENT '1:发送成功,0:发送失败',
                                 `is_used` tinyint(4) DEFAULT '0' COMMENT '1:已使用,0:待用',
                                 `resend_time` int(11) NOT NULL DEFAULT '0' COMMENT '重新发送时间（秒） 建议60-300',
                                 `expire_time` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间(秒）  建议300-1200',
                                 `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
                                 `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
                                 `deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除时间',
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COMMENT='email otp表';


-- ----------------------------
-- Table structure for emailtpls
-- ----------------------------
DROP TABLE IF EXISTS `emailtpls`;
CREATE TABLE `emailtpls` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `tpl_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '邮件标题',
                             `tpl_content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '邮件内容',
                             `tpl_token` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '邮件标识',
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL,
                             `deleted_at` timestamp NULL DEFAULT NULL,
                             PRIMARY KEY (`id`),
                             UNIQUE KEY `mail_token` (`tpl_token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of emailtpls
-- ----------------------------
BEGIN;
INSERT INTO `emailtpls` (`id`, `tpl_name`, `tpl_content`, `tpl_token`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, '【{webname}】感谢您的购买，请查收您的收据', '<!DOCTYPE html>\r\n<html\r\n    style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<head>\r\n    <meta name=\"viewport\" content=\"width=device-width\"/>\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/>\r\n    <title>Billing e.g. invoices and receipts</title>\r\n\r\n    <style type=\"text/css\">\r\n        img {\r\n            max-width: 100%;\r\n        }\r\n\r\n        body {\r\n            -webkit-font-smoothing: antialiased;\r\n            -webkit-text-size-adjust: none;\r\n            width: 100% !important;\r\n            height: 100%;\r\n            line-height: 1.6em;\r\n        }\r\n\r\n        body {\r\n            background-color: #f6f6f6;\r\n        }\r\n\r\n        @media only screen and (max-width: 640px) {\r\n            body {\r\n                padding: 0 !important;\r\n            }\r\n\r\n            h1 {\r\n                font-weight: 800 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            h2 {\r\n                font-weight: 800 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            h3 {\r\n                font-weight: 800 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            h4 {\r\n                font-weight: 800 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            h1 {\r\n                font-size: 22px !important;\r\n            }\r\n\r\n            h2 {\r\n                font-size: 18px !important;\r\n            }\r\n\r\n            h3 {\r\n                font-size: 16px !important;\r\n            }\r\n\r\n            .container {\r\n                padding: 0 !important;\r\n                width: 100% !important;\r\n            }\r\n\r\n            .content {\r\n                padding: 0 !important;\r\n            }\r\n\r\n            .content-wrap {\r\n                padding: 10px !important;\r\n            }\r\n\r\n            .invoice {\r\n                width: 100% !important;\r\n            }\r\n        }\r\n    </style>\r\n</head>\r\n\r\n<body itemscope itemtype=\"http://schema.org/EmailMessage\"\r\n      style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;\"\r\n      bgcolor=\"#f6f6f6\">\r\n\r\n<table class=\"body-wrap\"\r\n       style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;\"\r\n       bgcolor=\"#f6f6f6\">\r\n    <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n        <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\"\r\n            valign=\"top\"></td>\r\n        <td class=\"container\" width=\"600\"\r\n            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;\"\r\n            valign=\"top\">\r\n            <div class=\"content\"\r\n                 style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;\">\r\n                <table class=\"main\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"\r\n                       style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;\"\r\n                       bgcolor=\"#fff\">\r\n                    <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                        <td class=\"content-wrap aligncenter\"\r\n                            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 20px;\"\r\n                            align=\"center\" valign=\"top\">\r\n                            <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"\r\n                                   style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\"\r\n                                        valign=\"top\">\r\n                                        <h1 class=\"aligncenter\"\r\n                                            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,\'Lucida Grande\',sans-serif; box-sizing: border-box; font-size: 32px; color: #000; line-height: 1.2em; font-weight: 500; text-align: center; margin: 40px 0 0;\"\r\n                                            align=\"center\"> {ord_title} </h1>\r\n                                    </td>\r\n                                </tr>\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\"\r\n                                        valign=\"top\">\r\n                                        <h2 class=\"aligncenter\"\r\n                                            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,\'Lucida Grande\',sans-serif; box-sizing: border-box; font-size: 24px; color: #000; line-height: 1.2em; font-weight: 400; text-align: center; margin: 40px 0 0;\"\r\n                                            align=\"center\">感谢您的购买。</h2>\r\n                                    </td>\r\n                                </tr>\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block aligncenter\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;\"\r\n                                        align=\"center\" valign=\"top\">\r\n                                        <table class=\"invoice\"\r\n                                               style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 80%; margin: 40px auto;\">\r\n                                            <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                                <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;\" valign=\"top\">\r\n                                                    订单号: {order_id}<br style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"/>\r\n                                                    {created_at}<br style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"/>\r\n                                                    以下是您的卡密信息：<br style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"/>\r\n                                                    {ord_info}\r\n                                                </td>\r\n                                            </tr>\r\n                                            <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                                <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;\"\r\n                                                    valign=\"top\">\r\n                                                    <table class=\"invoice-items\" cellpadding=\"0\" cellspacing=\"0\"\r\n                                                           style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0;\">\r\n                                                        <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                                            <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;\"\r\n                                                                valign=\"top\">{product_name}\r\n                                                            </td>\r\n                                                            <td class=\"alignright\"\r\n                                                                style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;\"\r\n                                                                align=\"right\" valign=\"top\">x {buy_amount}\r\n                                                            </td>\r\n                                                        </tr>\r\n\r\n                                                        <tr class=\"total\"\r\n                                                            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                                            <td class=\"alignright\" width=\"80%\"\r\n                                                                style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;\"\r\n                                                                align=\"right\" valign=\"top\">总价\r\n                                                            </td>\r\n                                                            <td class=\"alignright\"\r\n                                                                style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;\"\r\n                                                                align=\"right\" valign=\"top\">{ord_price} ¥\r\n                                                            </td>\r\n                                                        </tr>\r\n                                                    </table>\r\n                                                </td>\r\n                                            </tr>\r\n                                        </table>\r\n                                    </td>\r\n                                </tr>\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block aligncenter\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;\"\r\n                                        align=\"center\" valign=\"top\">\r\n                                        <a href=\"{weburl}\"\r\n                                           style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #348eda; text-decoration: underline; margin: 0;\">{webname}</a>\r\n                                    </td>\r\n                                </tr>\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block aligncenter\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;\"\r\n                                        align=\"center\" valign=\"top\">\r\n                                        {webname} Inc. {created_at}\r\n                                    </td>\r\n                                </tr>\r\n                            </table>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                <div class=\"footer\"\r\n                     style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;\">\r\n                    <table width=\"100%\"\r\n                           style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                        <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n\r\n                        </tr>\r\n                    </table>\r\n                </div>\r\n            </div>\r\n        </td>\r\n        <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\"\r\n            valign=\"top\"></td>\r\n    </tr>\r\n</table>\r\n</body>\r\n</html>', 'card_send_user_email', '2020-04-06 13:27:56', '2021-05-20 20:24:42', NULL);
INSERT INTO `emailtpls` (`id`, `tpl_name`, `tpl_content`, `tpl_token`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, '【{webname}】新订单等待处理！', '<p><span style=\"\">尊敬的管理员：</span></p><p><span style=\"\">客户购买的商品：<span style=\"\"><span style=\"\">【{product_name}】</span></span> 已支付成功，请及时处理。</span></p><p>订单号：{order_id}<br></p><p>数量：{buy_amount}<br></p><p>金额：{ord_price}<br></p><p>时间：<span style=\"\">{created_at}</span><br></p><hr><p>{ord_info}</p><hr><p style=\"margin-left: 40px;\"><b>来自{webname} -{weburl}</b></p>', 'manual_send_manage_mail', '2020-04-06 13:32:03', '2020-04-06 13:32:18', NULL);
INSERT INTO `emailtpls` (`id`, `tpl_name`, `tpl_content`, `tpl_token`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, '【{webname}】订单处理失败！', '<!DOCTYPE html>\r\n<html\r\n    style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<head>\r\n    <meta name=\"viewport\" content=\"width=device-width\"/>\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/>\r\n    <title>Billing e.g. invoices and receipts</title>\r\n\r\n    <style type=\"text/css\">\r\n        img {\r\n            max-width: 100%;\r\n        }\r\n\r\n        body {\r\n            -webkit-font-smoothing: antialiased;\r\n            -webkit-text-size-adjust: none;\r\n            width: 100% !important;\r\n            height: 100%;\r\n            line-height: 1.6em;\r\n        }\r\n\r\n        body {\r\n            background-color: #f6f6f6;\r\n        }\r\n\r\n        @media only screen and (max-width: 640px) {\r\n            body {\r\n                padding: 0 !important;\r\n            }\r\n\r\n            h1 {\r\n                font-weight: 800 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            h2 {\r\n                font-weight: 800 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            h3 {\r\n                font-weight: 800 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            h4 {\r\n                font-weight: 800 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            h1 {\r\n                font-size: 22px !important;\r\n            }\r\n\r\n            h2 {\r\n                font-size: 18px !important;\r\n            }\r\n\r\n            h3 {\r\n                font-size: 16px !important;\r\n            }\r\n\r\n            .container {\r\n                padding: 0 !important;\r\n                width: 100% !important;\r\n            }\r\n\r\n            .content {\r\n                padding: 0 !important;\r\n            }\r\n\r\n            .content-wrap {\r\n                padding: 10px !important;\r\n            }\r\n\r\n            .invoice {\r\n                width: 100% !important;\r\n            }\r\n        }\r\n    </style>\r\n</head>\r\n\r\n<body itemscope itemtype=\"http://schema.org/EmailMessage\"\r\n      style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;\"\r\n      bgcolor=\"#f6f6f6\">\r\n\r\n<table class=\"body-wrap\"\r\n       style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;\"\r\n       bgcolor=\"#f6f6f6\">\r\n    <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n        <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\"\r\n            valign=\"top\"></td>\r\n        <td class=\"container\" width=\"600\"\r\n            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;\"\r\n            valign=\"top\">\r\n            <div class=\"content\"\r\n                 style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;\">\r\n                <table class=\"main\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"\r\n                       style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;\"\r\n                       bgcolor=\"#fff\">\r\n                    <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                        <td class=\"content-wrap aligncenter\"\r\n                            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 20px;\"\r\n                            align=\"center\" valign=\"top\">\r\n                            <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"\r\n                                   style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\"\r\n                                        valign=\"top\">\r\n                                        <h1 class=\"aligncenter\"\r\n                                            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,\'Lucida Grande\',sans-serif; box-sizing: border-box; font-size: 32px; color: #000; line-height: 1.2em; font-weight: 500; text-align: center; margin: 40px 0 0;\"\r\n                                            align=\"center\"> {ord_title} </h1>\r\n                                    </td>\r\n                                </tr>\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\"\r\n                                        valign=\"top\">\r\n                                        <h2 class=\"aligncenter\"\r\n                                            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,\'Lucida Grande\',sans-serif; box-sizing: border-box; font-size: 24px; color: #000; line-height: 1.2em; font-weight: 400; text-align: center; margin: 40px 0 0;\"\r\n                                            align=\"center\">非常遗憾，您的订单处理失败(╥﹏╥).</h2>\r\n                                    </td>\r\n                                </tr>\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block aligncenter\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;\"\r\n                                        align=\"center\" valign=\"top\">\r\n                                        <table class=\"invoice\"\r\n                                               style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 80%; margin: 40px auto;\">\r\n                                            <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                                <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;\" valign=\"top\">\r\n                                                    订单号: {order_id}<br style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"/>\r\n                                                    {created_at}<br style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"/>\r\n                                                    尊敬的客户，十分抱歉，订单处理失败，请联系网站工作人员核查原因。\r\n                                                </td>\r\n                                            </tr>\r\n                                            <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                                <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;\"\r\n                                                    valign=\"top\">\r\n                                                    <table class=\"invoice-items\" cellpadding=\"0\" cellspacing=\"0\"\r\n                                                           style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0;\">\r\n                                                        <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                                            <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;\"\r\n                                                                valign=\"top\">{ord_title}\r\n                                                            </td>\r\n                                                            <td class=\"alignright\"\r\n                                                                style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;\"\r\n                                                                align=\"right\" valign=\"top\">\r\n                                                            </td>\r\n                                                        </tr>\r\n\r\n                                                        <tr class=\"total\"\r\n                                                            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                                            <td class=\"alignright\" width=\"80%\"\r\n                                                                style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;\"\r\n                                                                align=\"right\" valign=\"top\">总价\r\n                                                            </td>\r\n                                                            <td class=\"alignright\"\r\n                                                                style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;\"\r\n                                                                align=\"right\" valign=\"top\">{ord_price} ¥\r\n                                                            </td>\r\n                                                        </tr>\r\n                                                    </table>\r\n                                                </td>\r\n                                            </tr>\r\n                                        </table>\r\n                                    </td>\r\n                                </tr>\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block aligncenter\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;\"\r\n                                        align=\"center\" valign=\"top\">\r\n                                        <a href=\"{weburl}\"\r\n                                           style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #348eda; text-decoration: underline; margin: 0;\">{webname}</a>\r\n                                    </td>\r\n                                </tr>\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block aligncenter\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;\"\r\n                                        align=\"center\" valign=\"top\">\r\n                                        {webname} Inc. {created_at}\r\n                                    </td>\r\n                                </tr>\r\n                            </table>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                <div class=\"footer\"\r\n                     style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;\">\r\n                    <table width=\"100%\"\r\n                           style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                        <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n\r\n                        </tr>\r\n                    </table>\r\n                </div>\r\n            </div>\r\n        </td>\r\n        <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\"\r\n            valign=\"top\"></td>\r\n    </tr>\r\n</table>\r\n</body>\r\n</html>', 'failed_order', '2020-06-30 09:54:58', '2020-06-30 10:47:21', NULL);
INSERT INTO `emailtpls` (`id`, `tpl_name`, `tpl_content`, `tpl_token`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, '【{webname}】您的订单已经处理完成！', '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<table class=\"body-wrap\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;\" bgcolor=\"#f6f6f6\">\r\n<tbody>\r\n<tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\" valign=\"top\">&nbsp;</td>\r\n<td class=\"container\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;\" valign=\"top\" width=\"600\">\r\n<div class=\"content\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;\">\r\n<table class=\"main\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#fff\">\r\n<tbody>\r\n<tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<td class=\"content-wrap aligncenter\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 20px;\" align=\"center\" valign=\"top\">\r\n<table style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<td class=\"content-block\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\" valign=\"top\">\r\n<h1 class=\"aligncenter\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,\'Lucida Grande\',sans-serif; box-sizing: border-box; font-size: 32px; color: #000; line-height: 1.2em; font-weight: 500; text-align: center; margin: 40px 0 0;\" align=\"center\">{ord_title}</h1>\r\n</td>\r\n</tr>\r\n<tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<td class=\"content-block\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\" valign=\"top\">\r\n<h2 class=\"aligncenter\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,\'Lucida Grande\',sans-serif; box-sizing: border-box; font-size: 24px; color: #000; line-height: 1.2em; font-weight: 400; text-align: center; margin: 40px 0 0;\" align=\"center\">您的订单已完成。</h2>\r\n</td>\r\n</tr>\r\n<tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<td class=\"content-block aligncenter\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;\" align=\"center\" valign=\"top\">\r\n<table class=\"invoice\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 80%; margin: 40px auto;\">\r\n<tbody>\r\n<tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;\" valign=\"top\">订单号: {order_id}<br style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\" />{created_at}<br style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\" />尊敬的客户，您的订单已经处理完毕，请及时前往网站核对处理结果，如有疑问请联系网站工作人员！</td>\r\n</tr>\r\n<tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;\" valign=\"top\">\r\n<table class=\"invoice-items\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0;\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;\" valign=\"top\"><span style=\"font-size: 14pt;\">{ord_title}</span></td>\r\n<td class=\"alignright\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;\" align=\"right\" valign=\"top\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top: 1px solid #eeeeee; margin: 0px; padding: 5px 0px;\">{ord_info}</td>\r\n<td style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top: 1px solid #eeeeee; margin: 0px; padding: 5px 0px;\">&nbsp;</td>\r\n</tr>\r\n<tr class=\"total\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<td class=\"alignright\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: bold; margin: 0; padding: 5px 0;\" align=\"right\" valign=\"top\" width=\"80%\">总价</td>\r\n<td class=\"alignright\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: bold; margin: 0; padding: 5px 0;\" align=\"right\" valign=\"top\">{ord_price} &yen;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<td class=\"content-block aligncenter\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;\" align=\"center\" valign=\"top\"><a style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #348eda; text-decoration: underline; margin: 0;\" href=\"{weburl}\">{webname}</a></td>\r\n</tr>\r\n<tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<td class=\"content-block aligncenter\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;\" align=\"center\" valign=\"top\">{webname} Inc. {created_at}</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<div class=\"footer\" style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;\">&nbsp;</div>\r\n</div>\r\n</td>\r\n<td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\" valign=\"top\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'completed_order', '2022-05-08 15:41:49', '2022-05-08 15:47:26', NULL);
INSERT INTO `emailtpls` (`id`, `tpl_name`, `tpl_content`, `tpl_token`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, '【{webname}】已收到您的订单，请等候处理', '<!DOCTYPE html>\r\n<html\r\n    style=\"font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n<head>\r\n    <meta name=\"viewport\" content=\"width=device-width\"/>\r\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/>\r\n    <title>Billing e.g. invoices and receipts</title>\r\n\r\n    <style type=\"text/css\">\r\n        img {\r\n            max-width: 100%;\r\n        }\r\n\r\n        body {\r\n            -webkit-font-smoothing: antialiased;\r\n            -webkit-text-size-adjust: none;\r\n            width: 100% !important;\r\n            height: 100%;\r\n            line-height: 1.6em;\r\n        }\r\n\r\n        body {\r\n            background-color: #f6f6f6;\r\n        }\r\n\r\n        @media only screen and (max-width: 640px) {\r\n            body {\r\n                padding: 0 !important;\r\n            }\r\n\r\n            h1 {\r\n                font-weight: 800 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            h2 {\r\n                font-weight: 800 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            h3 {\r\n                font-weight: 800 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            h4 {\r\n                font-weight: 800 !important;\r\n                margin: 20px 0 5px !important;\r\n            }\r\n\r\n            h1 {\r\n                font-size: 22px !important;\r\n            }\r\n\r\n            h2 {\r\n                font-size: 18px !important;\r\n            }\r\n\r\n            h3 {\r\n                font-size: 16px !important;\r\n            }\r\n\r\n            .container {\r\n                padding: 0 !important;\r\n                width: 100% !important;\r\n            }\r\n\r\n            .content {\r\n                padding: 0 !important;\r\n            }\r\n\r\n            .content-wrap {\r\n                padding: 10px !important;\r\n            }\r\n\r\n            .invoice {\r\n                width: 100% !important;\r\n            }\r\n        }\r\n    </style>\r\n</head>\r\n\r\n<body itemscope itemtype=\"http://schema.org/EmailMessage\"\r\n      style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;\"\r\n      bgcolor=\"#f6f6f6\">\r\n\r\n<table class=\"body-wrap\"\r\n       style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;\"\r\n       bgcolor=\"#f6f6f6\">\r\n    <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n        <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\"\r\n            valign=\"top\"></td>\r\n        <td class=\"container\" width=\"600\"\r\n            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;\"\r\n            valign=\"top\">\r\n            <div class=\"content\"\r\n                 style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;\">\r\n                <table class=\"main\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"\r\n                       style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;\"\r\n                       bgcolor=\"#fff\">\r\n                    <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                        <td class=\"content-wrap aligncenter\"\r\n                            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 20px;\"\r\n                            align=\"center\" valign=\"top\">\r\n                            <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"\r\n                                   style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\"\r\n                                        valign=\"top\">\r\n                                        <h1 class=\"aligncenter\"\r\n                                            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,\'Lucida Grande\',sans-serif; box-sizing: border-box; font-size: 32px; color: #000; line-height: 1.2em; font-weight: 500; text-align: center; margin: 40px 0 0;\"\r\n                                            align=\"center\"> {ord_title} </h1>\r\n                                    </td>\r\n                                </tr>\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\"\r\n                                        valign=\"top\">\r\n                                        <h2 class=\"aligncenter\"\r\n                                            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,\'Lucida Grande\',sans-serif; box-sizing: border-box; font-size: 24px; color: #000; line-height: 1.2em; font-weight: 400; text-align: center; margin: 40px 0 0;\"\r\n                                            align=\"center\">感谢您的惠顾。</h2>\r\n                                    </td>\r\n                                </tr>\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block aligncenter\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;\"\r\n                                        align=\"center\" valign=\"top\">\r\n                                        <table class=\"invoice\"\r\n                                               style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 80%; margin: 40px auto;\">\r\n                                            <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                                <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;\" valign=\"top\">\r\n                                                    订单号: {order_id}<br style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"/>\r\n                                                    {created_at}<br style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"/>\r\n                                                    系统已向工作人员发送订单通知，代充类商品需要工作人员手动处理，请耐心等待通知！\r\n                                                </td>\r\n                                            </tr>\r\n                                            <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                                <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0;\"\r\n                                                    valign=\"top\">\r\n                                                    <table class=\"invoice-items\" cellpadding=\"0\" cellspacing=\"0\"\r\n                                                           style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0;\">\r\n                                                        <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                                            <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;\"\r\n                                                                valign=\"top\">{ord_title}\r\n                                                            </td>\r\n                                                            <td class=\"alignright\"\r\n                                                                style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0;\"\r\n                                                                align=\"right\" valign=\"top\">\r\n                                                            </td>\r\n                                                        </tr>\r\n\r\n                                                        <tr class=\"total\"\r\n                                                            style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                                            <td class=\"alignright\" width=\"80%\"\r\n                                                                style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;\"\r\n                                                                align=\"right\" valign=\"top\">总价\r\n                                                            </td>\r\n                                                            <td class=\"alignright\"\r\n                                                                style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0;\"\r\n                                                                align=\"right\" valign=\"top\">{ord_price} ¥\r\n                                                            </td>\r\n                                                        </tr>\r\n                                                    </table>\r\n                                                </td>\r\n                                            </tr>\r\n                                        </table>\r\n                                    </td>\r\n                                </tr>\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block aligncenter\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;\"\r\n                                        align=\"center\" valign=\"top\">\r\n                                        <a href=\"{weburl}\"\r\n                                           style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #348eda; text-decoration: underline; margin: 0;\">{webname}</a>\r\n                                    </td>\r\n                                </tr>\r\n                                <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                                    <td class=\"content-block aligncenter\"\r\n                                        style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px;\"\r\n                                        align=\"center\" valign=\"top\">\r\n                                        {webname} Inc. {created_at}\r\n                                    </td>\r\n                                </tr>\r\n                            </table>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                <div class=\"footer\"\r\n                     style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;\">\r\n                    <table width=\"100%\"\r\n                           style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n                        <tr style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">\r\n\r\n                        </tr>\r\n                    </table>\r\n                </div>\r\n            </div>\r\n        </td>\r\n        <td style=\"font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\"\r\n            valign=\"top\"></td>\r\n    </tr>\r\n</table>\r\n</body>\r\n</html>', 'pending_order', '2020-06-30 09:55:55', '2020-06-30 10:45:40', NULL);
INSERT INTO `emailtpls` (`id`, `tpl_name`, `tpl_content`, `tpl_token`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, '注册验证码', '<p>你的验证码：{code}</p>', 'mail_otp_register', '2020-06-30 09:55:55', '2020-06-30 09:55:55', NULL);
INSERT INTO `emailtpls` (`id`, `tpl_name`, `tpl_content`, `tpl_token`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, '忘记密码验证码', '<p>你的验证码：{code}</p>', 'mail_otp_forget', '2020-06-30 09:55:55', '2020-06-30 09:55:55', NULL);
COMMIT;

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
                               `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `group_id` int(11) NOT NULL COMMENT '所属分类id',
                         `gd_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名称',
                         `gd_description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品描述',
                         `gd_keywords` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品关键字',
                         `picture` text COLLATE utf8_unicode_ci COMMENT '商品图片',
                         `retail_price` decimal(10,2) DEFAULT '0.00' COMMENT '零售价',
                         `actual_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际售价',
                         `in_stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
                         `sales_volume` int(11) DEFAULT '0' COMMENT '销量',
                         `ord` int(11) DEFAULT '1' COMMENT '排序权重 越大越靠前',
                         `buy_limit_num` int(11) NOT NULL DEFAULT '0' COMMENT '限制单次购买最大数量，0为不限制',
                         `buy_prompt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '购买提示',
                         `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '商品描述',
                         `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '商品类型  1自动发货 2人工处理',
                         `wholesale_price_cnf` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '批发价配置',
                         `other_ipu_cnf` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '其他输入框配置',
                         `api_hook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '回调事件',
                         `is_open` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用，1是 0否',
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         `deleted_at` timestamp NULL DEFAULT NULL,
                         `supplier_id` bigint(20) DEFAULT '0' COMMENT '货源:0-自营',
                         `supplier_group_id` bigint(20) DEFAULT '0' COMMENT '货源商品分组编号',
                         `supplier_group_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '货源商品分组名字',
                         `supplier_goods_id` bigint(20) DEFAULT '0' COMMENT '货源商品编号',
                         `supplier_goods_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '货源商品名称',
                         `supplier_price` decimal(10,2) DEFAULT NULL COMMENT '货源商品价格',
                         `supplier_price_type` tinyint(1) DEFAULT '0' COMMENT '货源加价模式:1-定额加价；2-比例加价;',
                         `supplier_price_type_rule` decimal(10,2) DEFAULT '0.00' COMMENT ' 定额加价（如：上游价 + ¥30）;比例加价（如：上游价 × 1.3）',
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='商品表';


-- ----------------------------
-- Table structure for goods_group
-- ----------------------------
DROP TABLE IF EXISTS `goods_group`;
CREATE TABLE `goods_group` (
                               `id` int(11) NOT NULL AUTO_INCREMENT,
                               `gp_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '分类名称',
                               `is_open` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用，1是 0否',
                               `ord` int(11) NOT NULL DEFAULT '1' COMMENT '排序权重 越大越靠前',
                               `created_at` timestamp NULL DEFAULT NULL,
                               `updated_at` timestamp NULL DEFAULT NULL,
                               `deleted_at` timestamp NULL DEFAULT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='商品分类表';


-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                              `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `batch` int(11) NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '2019_12_14_000001_create_personal_access_tokens_table', 1);
COMMIT;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
                          `id` bigint(20) NOT NULL AUTO_INCREMENT,
                          `user_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '用户编号',
                          `order_sn` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT '订单号',
                          `goods_id` int(11) NOT NULL COMMENT '关联商品id',
                          `coupon_id` int(11) DEFAULT '0' COMMENT '关联优惠码id',
                          `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单名称',
                          `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1自动发货 2人工处理',
                          `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品单价',
                          `buy_amount` int(11) NOT NULL DEFAULT '1' COMMENT '购买数量',
                          `coupon_discount_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '优惠码优惠价格',
                          `wholesale_discount_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '批发价优惠',
                          `total_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单总价',
                          `actual_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '实际支付价格',
                          `search_pwd` varchar(200) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '查询密码',
                          `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '下单邮箱',
                          `info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '订单详情',
                          `pay_id` int(11) DEFAULT NULL COMMENT '支付通道id',
                          `buy_ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '购买者下单IP地址',
                          `trade_no` varchar(200) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '第三方支付订单号',
                          `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1待支付 2待处理 3处理中 4已完成 5处理失败 6异常 -1过期',
                          `coupon_ret_back` tinyint(1) NOT NULL DEFAULT '0' COMMENT '优惠码使用次数是否已经回退 0否 1是',
                          `created_at` timestamp NULL DEFAULT NULL,
                          `updated_at` timestamp NULL DEFAULT NULL,
                          `deleted_at` timestamp NULL DEFAULT NULL,
                          `is_agent` tinyint(1) NOT NULL DEFAULT '0' COMMENT '代理商订单1-是,0-否',
                          `agent_order_sn` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '代理订单号',
                          `agent_data` text COLLATE utf8_unicode_ci COMMENT '代理数据',
                          `is_supplier` tinyint(1) NOT NULL DEFAULT '0' COMMENT '供应商订单1-是,0-否',
                          `supplier_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '供应商编号',
                          `supplier_order_sn` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '供应商订单',
                          PRIMARY KEY (`id`),
                          UNIQUE KEY `idx_order_sn` (`order_sn`) USING BTREE,
                          KEY `idx_goods_id` (`goods_id`) USING BTREE,
                          KEY `idex_email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='订单表';


-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
                           `id` int(11) NOT NULL AUTO_INCREMENT,
                           `uuid` char(32) NOT NULL,
                           `payment` varchar(16) NOT NULL,
                           `name` varchar(255) NOT NULL,
                           `icon` varchar(255) DEFAULT NULL,
                           `config` text NOT NULL,
                           `notify_domain` varchar(128) DEFAULT NULL,
                           `handling_fee_fixed` int(11) DEFAULT NULL,
                           `handling_fee_percent` decimal(5,2) DEFAULT NULL,
                           `enable` tinyint(1) NOT NULL DEFAULT '0',
                           `sort` int(11) DEFAULT NULL,
                           `created_at` int(11) NOT NULL,
                           `updated_at` int(11) NOT NULL,
                           `deleted_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for pays
-- ----------------------------
DROP TABLE IF EXISTS `pays`;
CREATE TABLE `pays` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `pay_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支付名称',
                        `pay_check` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支付标识',
                        `pay_method` tinyint(1) NOT NULL COMMENT '支付方式 1跳转 2扫码',
                        `pay_client` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付场景：1电脑pc 2手机 3全部',
                        `merchant_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '商户 ID',
                        `merchant_key` text COLLATE utf8mb4_unicode_ci COMMENT '商户 KEY',
                        `merchant_pem` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商户密钥',
                        `pay_handleroute` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '支付处理路由',
                        `is_open` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用 1是 0否',
                        `created_at` timestamp NULL DEFAULT NULL,
                        `updated_at` timestamp NULL DEFAULT NULL,
                        `deleted_at` timestamp NULL DEFAULT NULL,
                        PRIMARY KEY (`id`),
                        UNIQUE KEY `idx_pay_check` (`pay_check`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
                                          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                          `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `tokenable_id` bigint(20) unsigned NOT NULL,
                                          `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `abilities` text COLLATE utf8mb4_unicode_ci,
                                          `last_used_at` timestamp NULL DEFAULT NULL,
                                          `created_at` timestamp NULL DEFAULT NULL,
                                          `updated_at` timestamp NULL DEFAULT NULL,
                                          PRIMARY KEY (`id`),
                                          UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
                                          KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ----------------------------
-- Table structure for recharge_orders
-- ----------------------------
DROP TABLE IF EXISTS `recharge_orders`;
CREATE TABLE `recharge_orders` (
                                   `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                   `order_sn` varchar(150) NOT NULL COMMENT '充值订单号',
                                   `user_id` bigint(20) NOT NULL COMMENT '用户ID',
                                   `amount` decimal(10,2) NOT NULL COMMENT '充值金额',
                                   `actual_amount` decimal(10,2) DEFAULT '0.00' COMMENT '实际到账金额',
                                   `bonus_amount` decimal(10,2) DEFAULT '0.00' COMMENT '赠送金额',
                                   `payment_method` varchar(50) NOT NULL COMMENT '支付方式',
                                   `pay_id` int(11) DEFAULT NULL COMMENT '支付通道ID',
                                   `trade_no` varchar(200) DEFAULT '' COMMENT '第三方支付订单号',
                                   `buy_ip` varchar(50) NOT NULL COMMENT '充值IP地址',
                                   `status` tinyint(4) DEFAULT '1' COMMENT '状态:1-待支付,2-已支付,3-已完成,4-已失败,5-已取消,-1-已过期',
                                   `remark` text COMMENT '备注',
                                   `payment_data` json DEFAULT NULL COMMENT '支付相关数据',
                                   `paid_at` timestamp NULL DEFAULT NULL COMMENT '支付时间',
                                   `completed_at` timestamp NULL DEFAULT NULL COMMENT '完成时间',
                                   `expired_at` timestamp NULL DEFAULT NULL COMMENT '过期时间',
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL,
                                   `deleted_at` timestamp NULL DEFAULT NULL,
                                   PRIMARY KEY (`id`),
                                   UNIQUE KEY `order_sn` (`order_sn`),
                                   KEY `idx_user_id` (`user_id`),
                                   KEY `idx_status` (`status`),
                                   KEY `idx_payment_method` (`payment_method`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;


-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
                             `id` bigint(20) NOT NULL AUTO_INCREMENT,
                             `method` varchar(16) NOT NULL,
                             `name` varchar(255) NOT NULL,
                             `config` text NOT NULL,
                             `enable` tinyint(1) NOT NULL DEFAULT '0',
                             `sort` int(11) DEFAULT '0',
                             `created_at` timestamp NOT NULL,
                             `updated_at` timestamp NOT NULL,
                             `deleted_at` timestamp NULL DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10002 DEFAULT CHARSET=utf8mb4 COMMENT='供货商配置表';


-- ----------------------------
-- Table structure for system_configs
-- ----------------------------
DROP TABLE IF EXISTS `system_configs`;
CREATE TABLE `system_configs` (
                                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                                  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '配置键',
                                  `value` text COLLATE utf8mb4_unicode_ci COMMENT '配置值',
                                  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '配置描述',
                                  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'text' COMMENT '配置类型：text,textarea,select,switch,number',
                                  `options` text COLLATE utf8mb4_unicode_ci COMMENT '选项配置（JSON格式）',
                                  `group` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'general' COMMENT '配置分组',
                                  `sort_order` int(11) DEFAULT '0' COMMENT '排序',
                                  `is_public` tinyint(1) DEFAULT '1' COMMENT '是否公开（前端可访问）',
                                  `created_at` timestamp NULL DEFAULT NULL,
                                  `updated_at` timestamp NULL DEFAULT NULL,
                                  PRIMARY KEY (`id`),
                                  UNIQUE KEY `system_configs_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='系统配置表';

-- ----------------------------
-- Records of system_configs
-- ----------------------------
BEGIN;
INSERT INTO `system_configs` (`id`, `key`, `value`, `description`, `type`, `options`, `group`, `sort_order`, `is_public`, `created_at`, `updated_at`) VALUES (1, 'currency_unit', 'CNY', NULL, 'select', '{\"CNY\":\"人民币\",\"USD\":\"美元\",\"USDT\":\"USDT\",\"AUD\":\"澳元\",\"EUR\":\"欧元\",\"JPY\":\"日元\",\"GBP\":\"英镑\"}', 'currency', 1, 1, '2025-09-03 02:30:25', '2025-09-11 15:25:33');
INSERT INTO `system_configs` (`id`, `key`, `value`, `description`, `type`, `options`, `group`, `sort_order`, `is_public`, `created_at`, `updated_at`) VALUES (2, 'currency_symbol', '¥', NULL, 'select', '{\"¥\":\"¥ (人民币)\",\"$\":\"$ (美元)\",\"€\":\"€ (欧元)\",\"£\":\"£ (英镑)\",\"¥\":\"¥ (日元)\",\"A$\":\"A$ (澳元)\"}', 'currency', 2, 1, '2025-09-03 02:30:25', '2025-09-11 15:25:33');
INSERT INTO `system_configs` (`id`, `key`, `value`, `description`, `type`, `options`, `group`, `sort_order`, `is_public`, `created_at`, `updated_at`) VALUES (3, 'supported_currencies', '[\"CNY\",\"USD\",\"USDT\",\"AUD\"]', '支持的货币列表', 'textarea', NULL, 'currency', 3, 1, '2025-09-03 02:30:25', '2025-09-03 02:30:25');
INSERT INTO `system_configs` (`id`, `key`, `value`, `description`, `type`, `options`, `group`, `sort_order`, `is_public`, `created_at`, `updated_at`) VALUES (4, 'currency_symbols', '{\"CNY\":\"¥\",\"USD\":\"$\",\"USDT\":\"$\",\"AUD\":\"A$\"}', NULL, 'textarea', NULL, 'currency', 4, 1, '2025-09-03 02:30:25', '2025-09-11 15:25:33');
INSERT INTO `system_configs` (`id`, `key`, `value`, `description`, `type`, `options`, `group`, `sort_order`, `is_public`, `created_at`, `updated_at`) VALUES (5, 'exchange_rate_api_key', NULL, NULL, 'text', NULL, 'exchange', 1, 0, '2025-09-03 02:30:25', '2025-09-11 15:25:33');
INSERT INTO `system_configs` (`id`, `key`, `value`, `description`, `type`, `options`, `group`, `sort_order`, `is_public`, `created_at`, `updated_at`) VALUES (6, 'exchange_rate_api_url', 'https://api.exchangerate.host', NULL, 'text', NULL, 'exchange', 2, 0, '2025-09-03 02:30:25', '2025-09-11 15:25:33');
INSERT INTO `system_configs` (`id`, `key`, `value`, `description`, `type`, `options`, `group`, `sort_order`, `is_public`, `created_at`, `updated_at`) VALUES (7, 'exchange_rate_update_interval', '3600', NULL, 'number', NULL, 'exchange', 3, 0, '2025-09-03 02:30:25', '2025-09-11 15:25:33');
INSERT INTO `system_configs` (`id`, `key`, `value`, `description`, `type`, `options`, `group`, `sort_order`, `is_public`, `created_at`, `updated_at`) VALUES (8, 'exchange_rate_cache_time', '3600', NULL, 'number', NULL, 'exchange', 4, 0, '2025-09-03 02:30:25', '2025-09-11 15:25:33');
INSERT INTO `system_configs` (`id`, `key`, `value`, `description`, `type`, `options`, `group`, `sort_order`, `is_public`, `created_at`, `updated_at`) VALUES (9, 'system_name', '独居客', '系统名称', 'text', NULL, 'general', 1, 1, '2025-09-03 02:30:25', '2025-09-03 02:30:25');
INSERT INTO `system_configs` (`id`, `key`, `value`, `description`, `type`, `options`, `group`, `sort_order`, `is_public`, `created_at`, `updated_at`) VALUES (10, 'system_version', '1.0.0', '系统版本', 'text', NULL, 'general', 2, 1, '2025-09-03 02:30:25', '2025-09-03 02:30:25');
INSERT INTO `system_configs` (`id`, `key`, `value`, `description`, `type`, `options`, `group`, `sort_order`, `is_public`, `created_at`, `updated_at`) VALUES (11, 'maintenance_mode', '0', '维护模式', 'switch', NULL, 'general', 3, 1, '2025-09-03 02:30:25', '2025-09-03 02:30:25');
INSERT INTO `system_configs` (`id`, `key`, `value`, `description`, `type`, `options`, `group`, `sort_order`, `is_public`, `created_at`, `updated_at`) VALUES (12, 'maintenance_message', '系统维护中，请稍后再试', '维护模式消息', 'textarea', NULL, 'general', 4, 1, '2025-09-03 02:30:25', '2025-09-03 02:30:25');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                         `email` varchar(255) NOT NULL,
                         `password` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `amount` decimal(16,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
                         `status` smallint(5) NOT NULL DEFAULT '1' COMMENT '状态:1正常 2禁用',
                         `secret_key` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         `deleted_at` timestamp NULL DEFAULT NULL COMMENT '删除时间',
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';


SET FOREIGN_KEY_CHECKS = 1;
