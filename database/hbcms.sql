/*
Navicat MySQL Data Transfer

Source Server         : hbcms
Source Server Version : 80012
Source Host           : localhost:3306
Source Database       : hbcms

Target Server Type    : MYSQL
Target Server Version : 80012
File Encoding         : 65001

Date: 2019-09-12 13:20:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blocks
-- ----------------------------
DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '自定义资料标题',
  `type` char(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'F文字|I图片|E编辑',
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of blocks
-- ----------------------------

-- ----------------------------
-- Table structure for browser
-- ----------------------------
DROP TABLE IF EXISTS `browser`;
CREATE TABLE `browser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mould` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of browser
-- ----------------------------

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '栏目标题',
  `route` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '栏目路由名称',
  `mould_id` char(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '栏目类型',
  `target` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self' COMMENT '栏目打开方式',
  `icon_class` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '栏目图标',
  `color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '栏目颜色',
  `font_style` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字体样式 0加粗 1倾斜',
  `order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '栏目排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `template_list` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '栏目列表面',
  `template_show` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '栏目详细页面',
  `alias` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '调用别名',
  `seo_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO标题',
  `seo_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO关健字',
  `seo_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO描述',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'URL链接,填写后直接跳转到该网址',
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '封面图片',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '栏目描述',
  `_lft` int(10) unsigned NOT NULL DEFAULT '0',
  `_rgt` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('16', '医学软件', null, '3', '_parent', 'fa fa-file-zip-o', '#f3675a', null, '0', '1', 'list_download.blade.php', 'view_download.blade.php', 'medical-software', null, null, null, null, null, null, '217', '226', null, '2019-05-28 14:43:10', '2019-06-13 15:57:54');
INSERT INTO `categories` VALUES ('40', 'hfghfgh', null, '1', '_parent', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'hfghfgh', null, null, null, null, null, null, '23', '24', '28', '2019-06-14 15:14:01', '2019-06-14 15:19:23');
INSERT INTO `categories` VALUES ('15', '医学题库', null, '2', '_parent', 'fa fa-file-pdf-o', '#39a45c', null, '0', '1', 'list_picture.blade.php', 'view_picture.blade.php', 'medical-question-bank', null, null, null, null, null, null, '203', '216', null, '2019-05-28 14:43:02', '2019-06-13 15:58:02');
INSERT INTO `categories` VALUES ('14', '医学图片', null, '2', '_parent', 'fa fa-file-image-o', '#4babdd', null, '0', '1', 'list_picture.blade.php', 'view_picture.blade.php', 'medical-pictures', null, null, null, null, null, null, '201', '202', null, '2019-05-28 14:42:53', '2019-06-13 15:58:11');
INSERT INTO `categories` VALUES ('13', '医学课件', null, '2', '_parent', 'fa fa-file-powerpoint-o', '#a871ce', null, '0', '1', 'list_picture.blade.php', 'view_picture.blade.php', 'medical-courseware', null, null, null, null, null, null, '197', '200', null, '2019-05-28 14:42:44', '2019-06-13 15:58:22');
INSERT INTO `categories` VALUES ('12', '医学视听', null, '2', '_parent', 'fa fa-file-video-o', '#ef4e84', null, '0', '1', 'list_picture.blade.php', 'view_picture.blade.php', 'medical-audio-visual', null, null, null, null, null, null, '195', '196', null, '2019-05-28 14:42:34', '2019-06-13 15:58:41');
INSERT INTO `categories` VALUES ('11', '电子图书', null, '1', '_parent', 'fa fa-file-text-o', '#5190ef', null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'e-book', null, null, null, null, null, null, '1', '194', null, '2019-05-28 14:42:24', '2019-05-30 17:21:06');
INSERT INTO `categories` VALUES ('21', '一般理论', null, '1', '_parent', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'general-theory', null, null, null, null, null, null, '2', '3', '11', '2019-05-30 17:32:04', '2019-05-30 17:32:04');
INSERT INTO `categories` VALUES ('23', '医学研究方法', null, '1', '_parent', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'medical-research-methods', null, null, null, null, null, null, '4', '5', '11', '2019-05-30 18:28:08', '2019-05-30 18:28:08');
INSERT INTO `categories` VALUES ('24', '预防医学、卫生学', null, '1', '_parent', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'preventive-medicine-and-hygiene', null, null, null, null, null, null, '6', '7', '11', '2019-05-30 18:28:25', '2019-05-30 18:28:25');
INSERT INTO `categories` VALUES ('25', '中国医学', null, '1', '_parent', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'chinese-medicine', null, null, null, null, null, null, '8', '9', '11', '2019-05-30 18:28:39', '2019-05-30 18:28:39');
INSERT INTO `categories` VALUES ('26', '基础医学', null, '1', '_parent', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'basic-medicine', null, null, null, null, null, null, '10', '11', '11', '2019-05-30 18:28:48', '2019-05-30 18:28:48');
INSERT INTO `categories` VALUES ('27', '临床医学', null, '1', '_parent', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'clinical-medicine', null, null, null, null, null, null, '12', '17', '11', '2019-05-30 18:29:01', '2019-05-30 18:29:01');
INSERT INTO `categories` VALUES ('28', '内科学', null, '1', '_parent', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'medicine', null, null, null, null, null, null, '18', '25', '11', '2019-05-30 18:29:12', '2019-05-30 18:29:12');
INSERT INTO `categories` VALUES ('29', '内科学1', null, '1', '_parent', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'internal-medicine-1', null, null, null, null, null, null, '19', '20', '28', '2019-05-30 18:29:41', '2019-05-30 18:29:41');
INSERT INTO `categories` VALUES ('30', '内科学2', null, '1', '_parent', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'internal-medicine-2', null, null, null, null, null, null, '21', '22', '28', '2019-05-30 18:29:51', '2019-05-30 18:29:51');
INSERT INTO `categories` VALUES ('31', '测试信息', null, '2', '_parent', null, null, null, '0', '1', 'list_picture.blade.php', 'view_picture.blade.php', 'test-information', null, null, null, null, null, null, '198', '199', '13', '2019-06-13 15:30:49', '2019-06-13 15:58:31');
INSERT INTO `categories` VALUES ('32', '手机软件', null, '3', '_parent', null, null, null, '0', '1', 'list_download.blade.php', 'view_download.blade.php', 'mobile-phone-software', null, null, null, null, null, null, '218', '219', '16', '2019-06-13 16:39:09', '2019-06-13 16:39:09');
INSERT INTO `categories` VALUES ('33', '设计软件', null, '3', '_parent', null, null, null, '0', '1', 'list_download.blade.php', 'view_download.blade.php', 'design-software', null, null, null, null, null, null, '220', '223', '16', '2019-06-13 16:39:30', '2019-06-13 16:39:30');
INSERT INTO `categories` VALUES ('34', '小学英语', null, '2', '_parent', null, null, null, '0', '1', 'list_picture.blade.php', 'view_picture.blade.php', 'primary-english', null, null, null, null, null, null, '204', '205', '15', '2019-06-13 18:30:11', '2019-06-13 18:30:11');
INSERT INTO `categories` VALUES ('35', '中学英语', null, '2', '_parent', null, null, null, '0', '1', 'list_picture.blade.php', 'view_picture.blade.php', 'middle-school-english', null, null, null, null, null, null, '206', '207', '15', '2019-06-13 18:30:22', '2019-06-13 18:30:22');
INSERT INTO `categories` VALUES ('36', '5465465', null, '1', '_parent', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', '5465465', null, null, null, null, null, null, '13', '16', '27', '2019-06-14 14:44:33', '2019-06-14 14:44:33');
INSERT INTO `categories` VALUES ('37', 'tytyt', null, '1', '_parent', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'tytyt', null, null, null, null, null, null, '14', '15', '36', '2019-06-14 14:44:52', '2019-06-14 14:44:52');
INSERT INTO `categories` VALUES ('49', '联系我们', null, '2', '_self', null, null, null, '0', '1', 'list_picture.blade.php', 'view_picture.blade.php', 'contact-us', null, null, null, null, null, null, '214', '215', '15', '2019-06-16 18:56:37', '2019-06-16 18:56:37');
INSERT INTO `categories` VALUES ('48', '关于我们', null, '2', '_self', null, null, null, '0', '1', 'list_picture.blade.php', 'view_picture.blade.php', 'about-us', null, null, null, null, null, null, '212', '213', '15', '2019-06-16 18:56:37', '2019-06-16 18:56:37');
INSERT INTO `categories` VALUES ('47', '暗战历史', null, '2', '_self', null, null, null, '0', '1', 'list_picture.blade.php', 'view_picture.blade.php', 'secret-war-history', null, null, null, null, null, null, '210', '211', '15', '2019-06-16 18:56:37', '2019-06-16 18:56:37');
INSERT INTO `categories` VALUES ('46', '博客梓荣', null, '2', '_self', null, null, null, '0', '1', 'list_picture.blade.php', 'view_picture.blade.php', 'blog-zirong', null, null, null, null, null, null, '208', '209', '15', '2019-06-16 18:56:36', '2019-06-16 18:56:36');
INSERT INTO `categories` VALUES ('51', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '26', '27', '11', '2019-06-17 20:20:53', '2019-06-17 20:20:53');
INSERT INTO `categories` VALUES ('52', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '28', '29', '11', '2019-06-17 20:20:53', '2019-06-17 20:20:53');
INSERT INTO `categories` VALUES ('53', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '30', '31', '11', '2019-06-17 20:20:53', '2019-06-17 20:20:53');
INSERT INTO `categories` VALUES ('54', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '32', '33', '11', '2019-06-17 20:20:54', '2019-06-17 20:20:54');
INSERT INTO `categories` VALUES ('55', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '34', '35', '11', '2019-06-17 20:20:54', '2019-06-17 20:20:54');
INSERT INTO `categories` VALUES ('56', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '36', '37', '11', '2019-06-17 20:20:54', '2019-06-17 20:20:54');
INSERT INTO `categories` VALUES ('57', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '38', '39', '11', '2019-06-17 20:20:54', '2019-06-17 20:20:54');
INSERT INTO `categories` VALUES ('58', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '40', '41', '11', '2019-06-17 20:20:55', '2019-06-17 20:20:55');
INSERT INTO `categories` VALUES ('59', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '42', '43', '11', '2019-06-17 20:20:55', '2019-06-17 20:20:55');
INSERT INTO `categories` VALUES ('60', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '44', '45', '11', '2019-06-17 20:20:55', '2019-06-17 20:20:55');
INSERT INTO `categories` VALUES ('61', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '46', '47', '11', '2019-06-17 20:20:55', '2019-06-17 20:20:55');
INSERT INTO `categories` VALUES ('62', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '48', '49', '11', '2019-06-17 20:20:56', '2019-06-17 20:20:56');
INSERT INTO `categories` VALUES ('63', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '50', '51', '11', '2019-06-17 20:20:56', '2019-06-17 20:20:56');
INSERT INTO `categories` VALUES ('64', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '52', '53', '11', '2019-06-17 20:20:56', '2019-06-17 20:20:56');
INSERT INTO `categories` VALUES ('65', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '54', '55', '11', '2019-06-17 20:20:56', '2019-06-17 20:20:56');
INSERT INTO `categories` VALUES ('66', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '56', '57', '11', '2019-06-17 20:20:56', '2019-06-17 20:20:56');
INSERT INTO `categories` VALUES ('67', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '58', '59', '11', '2019-06-17 20:20:57', '2019-06-17 20:20:57');
INSERT INTO `categories` VALUES ('68', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '60', '61', '11', '2019-06-17 20:20:57', '2019-06-17 20:20:57');
INSERT INTO `categories` VALUES ('69', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '62', '63', '11', '2019-06-17 20:20:57', '2019-06-17 20:20:57');
INSERT INTO `categories` VALUES ('70', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '64', '65', '11', '2019-06-17 20:20:57', '2019-06-17 20:20:57');
INSERT INTO `categories` VALUES ('71', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '66', '67', '11', '2019-06-17 20:20:58', '2019-06-17 20:20:58');
INSERT INTO `categories` VALUES ('72', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '68', '69', '11', '2019-06-17 20:20:58', '2019-06-17 20:20:58');
INSERT INTO `categories` VALUES ('73', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '70', '71', '11', '2019-06-17 20:20:58', '2019-06-17 20:20:58');
INSERT INTO `categories` VALUES ('74', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '72', '73', '11', '2019-06-17 20:20:58', '2019-06-17 20:20:58');
INSERT INTO `categories` VALUES ('75', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '74', '75', '11', '2019-06-17 20:20:59', '2019-06-17 20:20:59');
INSERT INTO `categories` VALUES ('76', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '76', '77', '11', '2019-06-17 20:20:59', '2019-06-17 20:20:59');
INSERT INTO `categories` VALUES ('77', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '78', '79', '11', '2019-06-17 20:20:59', '2019-06-17 20:20:59');
INSERT INTO `categories` VALUES ('78', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '80', '81', '11', '2019-06-17 20:20:59', '2019-06-17 20:20:59');
INSERT INTO `categories` VALUES ('79', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '82', '83', '11', '2019-06-17 20:22:46', '2019-06-17 20:22:46');
INSERT INTO `categories` VALUES ('80', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '84', '85', '11', '2019-06-17 20:22:47', '2019-06-17 20:22:47');
INSERT INTO `categories` VALUES ('81', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '86', '87', '11', '2019-06-17 20:22:47', '2019-06-17 20:22:47');
INSERT INTO `categories` VALUES ('82', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '88', '89', '11', '2019-06-17 20:22:47', '2019-06-17 20:22:47');
INSERT INTO `categories` VALUES ('83', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '90', '91', '11', '2019-06-17 20:22:47', '2019-06-17 20:22:47');
INSERT INTO `categories` VALUES ('84', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '92', '93', '11', '2019-06-17 20:22:48', '2019-06-17 20:22:48');
INSERT INTO `categories` VALUES ('85', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '94', '95', '11', '2019-06-17 20:22:48', '2019-06-17 20:22:48');
INSERT INTO `categories` VALUES ('86', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '96', '97', '11', '2019-06-17 20:22:48', '2019-06-17 20:22:48');
INSERT INTO `categories` VALUES ('87', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '98', '99', '11', '2019-06-17 20:22:48', '2019-06-17 20:22:48');
INSERT INTO `categories` VALUES ('88', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '100', '101', '11', '2019-06-17 20:22:49', '2019-06-17 20:22:49');
INSERT INTO `categories` VALUES ('89', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '102', '103', '11', '2019-06-17 20:22:49', '2019-06-17 20:22:49');
INSERT INTO `categories` VALUES ('90', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '104', '105', '11', '2019-06-17 20:22:49', '2019-06-17 20:22:49');
INSERT INTO `categories` VALUES ('91', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '106', '107', '11', '2019-06-17 20:22:49', '2019-06-17 20:22:49');
INSERT INTO `categories` VALUES ('92', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '108', '109', '11', '2019-06-17 20:22:50', '2019-06-17 20:22:50');
INSERT INTO `categories` VALUES ('93', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '110', '111', '11', '2019-06-17 20:22:50', '2019-06-17 20:22:50');
INSERT INTO `categories` VALUES ('94', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '112', '113', '11', '2019-06-17 20:22:50', '2019-06-17 20:22:50');
INSERT INTO `categories` VALUES ('95', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '114', '115', '11', '2019-06-17 20:22:50', '2019-06-17 20:22:50');
INSERT INTO `categories` VALUES ('96', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '116', '117', '11', '2019-06-17 20:22:50', '2019-06-17 20:22:50');
INSERT INTO `categories` VALUES ('97', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '118', '119', '11', '2019-06-17 20:22:51', '2019-06-17 20:22:51');
INSERT INTO `categories` VALUES ('98', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '120', '121', '11', '2019-06-17 20:22:51', '2019-06-17 20:22:51');
INSERT INTO `categories` VALUES ('99', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '122', '123', '11', '2019-06-17 20:22:51', '2019-06-17 20:22:51');
INSERT INTO `categories` VALUES ('100', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '124', '125', '11', '2019-06-17 20:22:52', '2019-06-17 20:22:52');
INSERT INTO `categories` VALUES ('101', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '126', '127', '11', '2019-06-17 20:22:52', '2019-06-17 20:22:52');
INSERT INTO `categories` VALUES ('102', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '128', '129', '11', '2019-06-17 20:22:52', '2019-06-17 20:22:52');
INSERT INTO `categories` VALUES ('103', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '130', '131', '11', '2019-06-17 20:22:52', '2019-06-17 20:22:52');
INSERT INTO `categories` VALUES ('104', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '132', '133', '11', '2019-06-17 20:22:52', '2019-06-17 20:22:52');
INSERT INTO `categories` VALUES ('105', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '134', '135', '11', '2019-06-17 20:22:53', '2019-06-17 20:22:53');
INSERT INTO `categories` VALUES ('106', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '136', '137', '11', '2019-06-17 20:22:53', '2019-06-17 20:22:53');
INSERT INTO `categories` VALUES ('107', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '138', '139', '11', '2019-06-17 20:23:01', '2019-06-17 20:23:01');
INSERT INTO `categories` VALUES ('108', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '140', '141', '11', '2019-06-17 20:23:02', '2019-06-17 20:23:02');
INSERT INTO `categories` VALUES ('109', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '142', '143', '11', '2019-06-17 20:23:02', '2019-06-17 20:23:02');
INSERT INTO `categories` VALUES ('110', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '144', '145', '11', '2019-06-17 20:23:02', '2019-06-17 20:23:02');
INSERT INTO `categories` VALUES ('111', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '146', '147', '11', '2019-06-17 20:23:03', '2019-06-17 20:23:03');
INSERT INTO `categories` VALUES ('112', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '148', '149', '11', '2019-06-17 20:23:03', '2019-06-17 20:23:03');
INSERT INTO `categories` VALUES ('113', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '150', '151', '11', '2019-06-17 20:23:06', '2019-06-17 20:23:06');
INSERT INTO `categories` VALUES ('114', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '152', '153', '11', '2019-06-17 20:23:06', '2019-06-17 20:23:06');
INSERT INTO `categories` VALUES ('115', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '154', '155', '11', '2019-06-17 20:23:06', '2019-06-17 20:23:06');
INSERT INTO `categories` VALUES ('116', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '156', '157', '11', '2019-06-17 20:23:07', '2019-06-17 20:23:07');
INSERT INTO `categories` VALUES ('117', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '158', '159', '11', '2019-06-17 20:23:07', '2019-06-17 20:23:07');
INSERT INTO `categories` VALUES ('118', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '160', '161', '11', '2019-06-17 20:23:07', '2019-06-17 20:23:07');
INSERT INTO `categories` VALUES ('119', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '162', '163', '11', '2019-06-17 20:23:07', '2019-06-17 20:23:07');
INSERT INTO `categories` VALUES ('120', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '164', '165', '11', '2019-06-17 20:23:08', '2019-06-17 20:23:08');
INSERT INTO `categories` VALUES ('121', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '166', '167', '11', '2019-06-17 20:23:08', '2019-06-17 20:23:08');
INSERT INTO `categories` VALUES ('122', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '168', '169', '11', '2019-06-17 20:23:08', '2019-06-17 20:23:08');
INSERT INTO `categories` VALUES ('123', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '170', '171', '11', '2019-06-17 20:23:08', '2019-06-17 20:23:08');
INSERT INTO `categories` VALUES ('124', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '172', '173', '11', '2019-06-17 20:23:09', '2019-06-17 20:23:09');
INSERT INTO `categories` VALUES ('125', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '174', '175', '11', '2019-06-17 20:23:09', '2019-06-17 20:23:09');
INSERT INTO `categories` VALUES ('126', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '176', '177', '11', '2019-06-17 20:23:09', '2019-06-17 20:23:09');
INSERT INTO `categories` VALUES ('127', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '178', '179', '11', '2019-06-17 20:23:09', '2019-06-17 20:23:09');
INSERT INTO `categories` VALUES ('128', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '180', '181', '11', '2019-06-17 20:23:09', '2019-06-17 20:23:09');
INSERT INTO `categories` VALUES ('129', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '182', '183', '11', '2019-06-17 20:23:10', '2019-06-17 20:23:10');
INSERT INTO `categories` VALUES ('130', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '184', '185', '11', '2019-06-17 20:23:10', '2019-06-17 20:23:10');
INSERT INTO `categories` VALUES ('131', '博客梓荣', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'blog-zirong', null, null, null, null, null, null, '186', '187', '11', '2019-06-17 20:23:10', '2019-06-17 20:23:10');
INSERT INTO `categories` VALUES ('132', '暗战历史', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'secret-war-history', null, null, null, null, null, null, '188', '189', '11', '2019-06-17 20:23:10', '2019-06-17 20:23:10');
INSERT INTO `categories` VALUES ('133', '关于我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'about-us', null, null, null, null, null, null, '190', '191', '11', '2019-06-17 20:23:11', '2019-06-17 20:23:11');
INSERT INTO `categories` VALUES ('134', '联系我们', null, '1', '_self', null, null, null, '0', '1', 'list_post.blade.php', 'view_post.blade.php', 'contact-us', null, null, null, null, null, null, '192', '193', '11', '2019-06-17 20:23:11', '2019-06-17 20:23:11');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '评论的标题',
  `ip` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ip地址',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '评论的内容',
  `visitor` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP地址',
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '所在城市',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核状态',
  `member_id` int(10) unsigned DEFAULT NULL COMMENT '会员id',
  `mould_id` int(10) DEFAULT NULL COMMENT '模型id',
  `document_id` int(10) unsigned DEFAULT NULL COMMENT '文档id',
  `_lft` int(10) unsigned DEFAULT '0',
  `_rgt` int(10) unsigned DEFAULT '0',
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for download
-- ----------------------------
DROP TABLE IF EXISTS `download`;
CREATE TABLE `download` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类id',
  `mould_id` int(10) unsigned NOT NULL COMMENT '所属模型id',
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '文章标题',
  `alias` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '文章别名',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否发布',
  `thumb` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '封面图片',
  `order` int(10) unsigned DEFAULT '0' COMMENT '排序',
  `views` int(10) unsigned DEFAULT '0' COMMENT '浏览次数',
  `push_time` timestamp NULL DEFAULT NULL COMMENT '发布时间',
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'URL链接',
  `source` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '本站' COMMENT '信息来源',
  `author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '管理员' COMMENT '文章作者',
  `summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '内容摘要',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '内容描述',
  `seo_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO标题',
  `seo_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO关健字',
  `seo_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `m_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '上传附件',
  PRIMARY KEY (`id`),
  UNIQUE KEY `download_alias_unique` (`alias`),
  UNIQUE KEY `download_title_unique` (`title`),
  KEY `download_category_id_foreign` (`category_id`),
  KEY `download_mould_id_foreign` (`mould_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of download
-- ----------------------------

-- ----------------------------
-- Table structure for fields
-- ----------------------------
DROP TABLE IF EXISTS `fields`;
CREATE TABLE `fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mould_id` int(10) unsigned NOT NULL COMMENT '模型id',
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '字段标题',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '字段名称',
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '字段类型',
  `byte` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '默认单位',
  `order` int(11) DEFAULT '0' COMMENT '排序',
  `content` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '默认值',
  `tip_content` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '提示信息',
  `is_empty` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否可以为空 0不是 1是',
  `validate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '验证规则',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_system` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fields_mould_id_foreign` (`mould_id`)
) ENGINE=MyISAM AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of fields
-- ----------------------------
INSERT INTO `fields` VALUES ('1', '1', '书名', 'title', 'text', null, '0', null, null, '1', 'required|unique:post|max:300', '2019-05-22 15:01:31', '2019-06-01 14:40:01', '1');
INSERT INTO `fields` VALUES ('2', '1', '书别名', 'alias', 'text', null, '0', null, null, '1', 'required|unique:post|max:300', '2019-05-22 15:01:31', '2019-06-01 14:40:11', '1');
INSERT INTO `fields` VALUES ('3', '1', '是否发布', 'is_show', 'radio', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('4', '1', '允许评论', 'is_comment', 'radio', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('5', '1', '置顶', 'is_top', 'checkbox', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('6', '1', '热门', 'is_hot', 'checkbox', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('7', '1', '推荐', 'is_tuijian', 'checkbox', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('8', '1', '幻灯', 'is_slide', 'checkbox', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('9', '1', '封面图片', 'thumb', 'img', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('10', '1', '字体样式', 'font_style', 'checkbox', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('11', '1', '字体颜色', 'color', 'text', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('12', '1', '排序', 'order', 'int', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('13', '1', '浏览次数', 'views', 'int', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('14', '1', '发布时间', 'push_time', 'datetime', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('15', '1', 'URL链接', 'url', 'text', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('16', '1', '信息来源', 'source', 'text', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('133', '1', '缩略图', 'thumbs', 'imgs', null, '0', null, null, '0', null, '2019-06-01 15:26:18', '2019-06-01 15:26:18', '0');
INSERT INTO `fields` VALUES ('19', '1', '内容描述', 'description', 'htmltext', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('20', '1', 'SEO标题', 'seo_title', 'text', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('21', '1', 'SEO关健字', 'seo_key', 'multitext', null, '0', null, null, '0', null, '2019-05-22 15:01:31', '2019-05-22 15:01:31', '1');
INSERT INTO `fields` VALUES ('22', '1', 'SEO描述', 'seo_content', 'multitext', null, '0', null, null, '0', null, '2019-05-22 15:01:32', '2019-05-22 15:01:32', '1');
INSERT INTO `fields` VALUES ('23', '2', '文章标题', 'title', 'text', null, '0', null, null, '1', 'required', '2019-05-22 15:02:00', '2019-05-23 17:22:50', '1');
INSERT INTO `fields` VALUES ('24', '2', '文章别名', 'alias', 'text', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('25', '2', '是否发布', 'is_show', 'radio', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('26', '2', '允许评论', 'is_comment', 'radio', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('27', '2', '置顶', 'is_top', 'checkbox', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('28', '2', '热门', 'is_hot', 'checkbox', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('29', '2', '推荐', 'is_tuijian', 'checkbox', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('30', '2', '幻灯', 'is_slide', 'checkbox', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('31', '2', '封面图片', 'thumb', 'img', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('32', '2', '字体样式', 'font_style', 'checkbox', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('33', '2', '字体颜色', 'color', 'text', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('34', '2', '排序', 'order', 'int', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('35', '2', '浏览次数', 'views', 'int', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('36', '2', '发布时间', 'push_time', 'datetime', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('37', '2', 'URL链接', 'url', 'text', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('38', '2', '信息来源', 'source', 'text', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('39', '2', '文章作者', 'author', 'text', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('40', '2', '内容摘要', 'summary', 'htmltext', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('41', '2', '内容描述', 'description', 'htmltext', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('42', '2', 'SEO标题', 'seo_title', 'text', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('43', '2', 'SEO关健字', 'seo_key', 'multitext', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('44', '2', 'SEO描述', 'seo_content', 'multitext', null, '0', null, null, '0', null, '2019-05-22 15:02:00', '2019-05-22 15:02:00', '1');
INSERT INTO `fields` VALUES ('45', '3', '文章标题', 'title', 'text', null, '0', null, null, '1', 'required|unique:download|max:300', '2019-05-22 15:02:28', '2019-05-23 17:24:24', '1');
INSERT INTO `fields` VALUES ('46', '3', '文章别名', 'alias', 'text', null, '0', null, null, '1', 'required|unique:download', '2019-05-22 15:02:28', '2019-05-23 17:24:34', '1');
INSERT INTO `fields` VALUES ('47', '3', '是否发布', 'is_show', 'radio', null, '0', null, null, '0', null, '2019-05-22 15:02:28', '2019-05-22 15:02:28', '1');
INSERT INTO `fields` VALUES ('53', '3', '封面图片', 'thumb', 'img', null, '0', null, null, '0', null, '2019-05-22 15:02:28', '2019-05-22 15:02:28', '1');
INSERT INTO `fields` VALUES ('134', '2', '源文件', 'm_file', 'files', null, '10', null, null, '0', null, '2019-06-13 18:26:46', '2019-06-13 18:28:45', '0');
INSERT INTO `fields` VALUES ('56', '3', '排序', 'order', 'int', null, '0', null, null, '0', null, '2019-05-22 15:02:28', '2019-05-22 15:02:28', '1');
INSERT INTO `fields` VALUES ('57', '3', '浏览次数', 'views', 'int', null, '0', null, null, '0', null, '2019-05-22 15:02:28', '2019-05-22 15:02:28', '1');
INSERT INTO `fields` VALUES ('58', '3', '发布时间', 'push_time', 'datetime', null, '0', null, null, '0', null, '2019-05-22 15:02:28', '2019-05-22 15:02:28', '1');
INSERT INTO `fields` VALUES ('59', '3', 'URL链接', 'url', 'text', null, '0', null, null, '0', null, '2019-05-22 15:02:28', '2019-05-22 15:02:28', '1');
INSERT INTO `fields` VALUES ('60', '3', '信息来源', 'source', 'text', null, '0', null, null, '0', null, '2019-05-22 15:02:28', '2019-05-22 15:02:28', '1');
INSERT INTO `fields` VALUES ('61', '3', '文章作者', 'author', 'text', null, '0', null, null, '0', null, '2019-05-22 15:02:28', '2019-05-22 15:02:28', '1');
INSERT INTO `fields` VALUES ('62', '3', '内容摘要', 'summary', 'multitext', null, '0', null, null, '0', null, '2019-05-22 15:02:28', '2019-06-13 16:06:16', '1');
INSERT INTO `fields` VALUES ('63', '3', '内容描述', 'description', 'htmltext', null, '0', null, null, '0', null, '2019-05-22 15:02:28', '2019-05-22 15:02:28', '1');
INSERT INTO `fields` VALUES ('64', '3', 'SEO标题', 'seo_title', 'text', null, '0', null, null, '0', null, '2019-05-22 15:02:28', '2019-05-22 15:02:28', '1');
INSERT INTO `fields` VALUES ('65', '3', 'SEO关健字', 'seo_key', 'multitext', null, '0', null, null, '0', null, '2019-05-22 15:02:28', '2019-05-22 15:02:28', '1');
INSERT INTO `fields` VALUES ('66', '3', 'SEO描述', 'seo_content', 'multitext', null, '0', null, null, '0', null, '2019-05-22 15:02:28', '2019-05-22 15:02:28', '1');
INSERT INTO `fields` VALUES ('117', '4', '姓名', 'name', 'text', null, '0', null, null, '0', null, '2019-05-24 21:47:03', '2019-05-24 21:47:03', '0');
INSERT INTO `fields` VALUES ('118', '4', '邮箱', 'email', 'text', null, '0', null, null, '0', null, '2019-05-24 21:47:15', '2019-05-24 21:47:15', '0');
INSERT INTO `fields` VALUES ('119', '4', '手机号', 'phone', 'text', null, '0', null, null, '0', null, '2019-05-24 21:47:24', '2019-05-24 21:47:24', '0');
INSERT INTO `fields` VALUES ('120', '4', '留言内容', 'content', 'multitext', null, '0', null, null, '0', null, '2019-05-24 21:47:43', '2019-05-24 21:47:43', '0');
INSERT INTO `fields` VALUES ('121', '4', '备注', 'remark', 'multitext', null, '0', null, null, '0', null, '2019-05-24 21:48:25', '2019-05-24 21:48:25', '0');
INSERT INTO `fields` VALUES ('122', '4', 'IP地址', 'ip', 'text', null, '0', null, null, '0', null, '2019-05-24 21:48:43', '2019-05-24 21:48:43', '0');
INSERT INTO `fields` VALUES ('123', '4', '会员ID', 'member_id', 'int', null, '0', null, null, '0', null, '2019-05-24 21:50:36', '2019-05-24 21:50:36', '0');
INSERT INTO `fields` VALUES ('124', '4', '城市', 'city', 'text', null, '0', null, null, '0', null, '2019-05-24 21:52:01', '2019-05-24 21:52:01', '0');
INSERT INTO `fields` VALUES ('125', '1', '源文件', 'm_file', 'files', null, '0', null, null, '0', null, '2019-05-28 17:14:03', '2019-05-28 17:14:03', '0');
INSERT INTO `fields` VALUES ('127', '1', 'ISBN', 'isbn', 'text', null, '10', null, null, '0', null, '2019-05-30 20:03:14', '2019-06-14 21:05:08', '0');
INSERT INTO `fields` VALUES ('89', '5', '文章标题', 'title', 'text', null, '0', null, null, '0', null, '2019-05-22 15:03:18', '2019-05-22 15:03:18', '1');
INSERT INTO `fields` VALUES ('115', '2', '缩略图', 'thumbs', 'imgs', null, '0', null, '拖动可以排序，一次性最多可以上传5张', '0', null, '2019-05-23 17:22:35', '2019-06-13 18:04:07', '0');
INSERT INTO `fields` VALUES ('114', '3', '上传附件', 'm_file', 'files', null, '0', null, '只允许上传文件的类型：zip|gz|rar|iso|doc|xsl|ppt|wps', '0', null, '2019-05-23 17:20:16', '2019-06-14 12:29:57', '0');
INSERT INTO `fields` VALUES ('97', '5', '封面图片', 'thumb', 'img', null, '0', null, null, '0', null, '2019-05-22 15:03:18', '2019-05-22 15:03:18', '1');
INSERT INTO `fields` VALUES ('111', '5', '浏览次数', 'views', 'int', null, '0', null, null, '0', null, '2019-05-22 15:18:56', '2019-05-22 15:18:56', '1');
INSERT INTO `fields` VALUES ('102', '5', '发布时间', 'push_time', 'datetime', null, '0', null, null, '0', null, '2019-05-22 15:03:18', '2019-05-22 15:03:18', '1');
INSERT INTO `fields` VALUES ('104', '5', '信息来源', 'source', 'text', null, '0', null, null, '0', null, '2019-05-22 15:03:18', '2019-05-22 15:03:18', '1');
INSERT INTO `fields` VALUES ('105', '5', '文章作者', 'author', 'text', null, '0', null, null, '0', null, '2019-05-22 15:03:18', '2019-05-22 15:03:18', '1');
INSERT INTO `fields` VALUES ('107', '5', '内容描述', 'description', 'htmltext', null, '0', null, null, '0', null, '2019-05-22 15:03:18', '2019-05-22 15:03:18', '1');
INSERT INTO `fields` VALUES ('108', '5', 'SEO标题', 'seo_title', 'text', null, '0', null, null, '0', null, '2019-05-22 15:03:18', '2019-05-22 15:03:18', '1');
INSERT INTO `fields` VALUES ('109', '5', 'SEO关健字', 'seo_key', 'multitext', null, '0', null, null, '0', null, '2019-05-22 15:03:18', '2019-05-22 15:03:18', '1');
INSERT INTO `fields` VALUES ('110', '5', 'SEO描述', 'seo_content', 'multitext', null, '0', null, null, '0', null, '2019-05-22 15:03:18', '2019-05-22 15:03:18', '1');
INSERT INTO `fields` VALUES ('135', '5', 'CESHI', 'tttt', 'color', null, '0', null, 'zheshi', '0', null, '2019-06-14 21:10:02', '2019-06-14 21:10:02', '0');

-- ----------------------------
-- Table structure for guest_book
-- ----------------------------
DROP TABLE IF EXISTS `guest_book`;
CREATE TABLE `guest_book` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类id',
  `mould_id` int(10) unsigned NOT NULL COMMENT '所属模型id',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '姓名',
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机号',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '留言内容',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '备注',
  `ip` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP地址',
  `member_id` int(11) DEFAULT NULL COMMENT '会员ID',
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '城市',
  PRIMARY KEY (`id`),
  KEY `guest_book_category_id_foreign` (`category_id`),
  KEY `guest_book_mould_id_foreign` (`mould_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of guest_book
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for links
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '友情链接分类名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `links_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of links
-- ----------------------------

-- ----------------------------
-- Table structure for link_items
-- ----------------------------
DROP TABLE IF EXISTS `link_items`;
CREATE TABLE `link_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '友情链接标题',
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'url链接',
  `logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '链接的logo',
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '链接描述',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `user_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系人',
  `user_phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系人手机',
  `user_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系人邮箱',
  `order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `link_id` int(10) unsigned NOT NULL COMMENT '友情链接分类',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link_items_title_unique` (`title`),
  KEY `link_items_link_id_foreign` (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of link_items
-- ----------------------------

-- ----------------------------
-- Table structure for logs
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作节点,控制器和方法',
  `operator` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '操作员，管理员',
  `operate_ip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作ip',
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '描述',
  `operate_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '操作时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5834 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of logs
-- ----------------------------
INSERT INTO `logs` VALUES ('5328', 'backend.app', '', '127.0.0.1', '112312313', '2019-09-09 21:21:36');
INSERT INTO `logs` VALUES ('5329', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-09 21:21:36');
INSERT INTO `logs` VALUES ('5330', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-09 22:33:20');
INSERT INTO `logs` VALUES ('5331', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-09 22:33:22');
INSERT INTO `logs` VALUES ('5332', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-09 22:33:38');
INSERT INTO `logs` VALUES ('5333', 'backend.app', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:33:38');
INSERT INTO `logs` VALUES ('5334', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:33:38');
INSERT INTO `logs` VALUES ('5335', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:33:41');
INSERT INTO `logs` VALUES ('5336', 'backend.app', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:28');
INSERT INTO `logs` VALUES ('5337', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:28');
INSERT INTO `logs` VALUES ('5338', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:29');
INSERT INTO `logs` VALUES ('5339', 'download.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:30');
INSERT INTO `logs` VALUES ('5340', 'download.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:31');
INSERT INTO `logs` VALUES ('5341', 'download.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:39');
INSERT INTO `logs` VALUES ('5342', 'picture.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:40');
INSERT INTO `logs` VALUES ('5343', 'download.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:41');
INSERT INTO `logs` VALUES ('5344', 'post.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:42');
INSERT INTO `logs` VALUES ('5345', 'picture.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:42');
INSERT INTO `logs` VALUES ('5346', 'post.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:44');
INSERT INTO `logs` VALUES ('5347', 'member.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:44');
INSERT INTO `logs` VALUES ('5348', 'member.create', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:45');
INSERT INTO `logs` VALUES ('5349', 'block.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:48');
INSERT INTO `logs` VALUES ('5350', 'link.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:50');
INSERT INTO `logs` VALUES ('5351', 'tag.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:53');
INSERT INTO `logs` VALUES ('5352', 'page.contact_us', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:54');
INSERT INTO `logs` VALUES ('5353', 'page.create', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:54');
INSERT INTO `logs` VALUES ('5354', 'page.help', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:55');
INSERT INTO `logs` VALUES ('5355', 'page.create', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:55');
INSERT INTO `logs` VALUES ('5356', 'record.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:55');
INSERT INTO `logs` VALUES ('5357', 'user.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:34:58');
INSERT INTO `logs` VALUES ('5358', 'backend.app', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:36:08');
INSERT INTO `logs` VALUES ('5359', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:36:08');
INSERT INTO `logs` VALUES ('5360', 'role.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:36:10');
INSERT INTO `logs` VALUES ('5361', 'user.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:36:11');
INSERT INTO `logs` VALUES ('5362', 'user.create', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:36:12');
INSERT INTO `logs` VALUES ('5363', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:36:14');
INSERT INTO `logs` VALUES ('5364', 'backend.app', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:37:20');
INSERT INTO `logs` VALUES ('5365', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:37:21');
INSERT INTO `logs` VALUES ('5366', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:37:22');
INSERT INTO `logs` VALUES ('5367', 'template.info', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:37:25');
INSERT INTO `logs` VALUES ('5368', 'template.info', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:37:28');
INSERT INTO `logs` VALUES ('5369', 'mould.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:37:30');
INSERT INTO `logs` VALUES ('5370', 'mould.create', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:37:32');
INSERT INTO `logs` VALUES ('5371', 'database.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:37:34');
INSERT INTO `logs` VALUES ('5372', 'role.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-09 22:37:38');
INSERT INTO `logs` VALUES ('5373', 'backend.app', '', '127.0.0.1', '112312313', '2019-09-10 12:35:04');
INSERT INTO `logs` VALUES ('5374', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 12:35:05');
INSERT INTO `logs` VALUES ('5375', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 12:37:23');
INSERT INTO `logs` VALUES ('5376', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 12:38:59');
INSERT INTO `logs` VALUES ('5377', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 12:39:55');
INSERT INTO `logs` VALUES ('5378', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 12:40:51');
INSERT INTO `logs` VALUES ('5379', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 12:41:28');
INSERT INTO `logs` VALUES ('5380', 'backend.app', '', '127.0.0.1', '112312313', '2019-09-10 12:42:09');
INSERT INTO `logs` VALUES ('5381', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 12:42:09');
INSERT INTO `logs` VALUES ('5382', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 12:42:15');
INSERT INTO `logs` VALUES ('5383', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 12:45:07');
INSERT INTO `logs` VALUES ('5384', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:32:42');
INSERT INTO `logs` VALUES ('5385', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:32:54');
INSERT INTO `logs` VALUES ('5386', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:32:58');
INSERT INTO `logs` VALUES ('5387', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:33:00');
INSERT INTO `logs` VALUES ('5388', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:34:30');
INSERT INTO `logs` VALUES ('5389', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:34:33');
INSERT INTO `logs` VALUES ('5390', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:34:44');
INSERT INTO `logs` VALUES ('5391', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:35:46');
INSERT INTO `logs` VALUES ('5392', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 13:35:48');
INSERT INTO `logs` VALUES ('5393', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:35:48');
INSERT INTO `logs` VALUES ('5394', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:37:39');
INSERT INTO `logs` VALUES ('5395', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:37:44');
INSERT INTO `logs` VALUES ('5396', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:38:12');
INSERT INTO `logs` VALUES ('5397', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:38:14');
INSERT INTO `logs` VALUES ('5398', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:38:45');
INSERT INTO `logs` VALUES ('5399', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:39:08');
INSERT INTO `logs` VALUES ('5400', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:39:21');
INSERT INTO `logs` VALUES ('5401', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:39:38');
INSERT INTO `logs` VALUES ('5402', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:41:36');
INSERT INTO `logs` VALUES ('5403', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:41:38');
INSERT INTO `logs` VALUES ('5404', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:47:22');
INSERT INTO `logs` VALUES ('5405', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:47:25');
INSERT INTO `logs` VALUES ('5406', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:47:57');
INSERT INTO `logs` VALUES ('5407', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:47:59');
INSERT INTO `logs` VALUES ('5408', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:48:19');
INSERT INTO `logs` VALUES ('5409', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:48:34');
INSERT INTO `logs` VALUES ('5410', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:48:36');
INSERT INTO `logs` VALUES ('5411', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:48:55');
INSERT INTO `logs` VALUES ('5412', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:49:22');
INSERT INTO `logs` VALUES ('5413', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:49:24');
INSERT INTO `logs` VALUES ('5414', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:49:41');
INSERT INTO `logs` VALUES ('5415', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:50:18');
INSERT INTO `logs` VALUES ('5416', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:50:20');
INSERT INTO `logs` VALUES ('5417', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:50:46');
INSERT INTO `logs` VALUES ('5418', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:51:21');
INSERT INTO `logs` VALUES ('5419', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:51:40');
INSERT INTO `logs` VALUES ('5420', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:51:42');
INSERT INTO `logs` VALUES ('5421', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 13:51:50');
INSERT INTO `logs` VALUES ('5422', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:51:50');
INSERT INTO `logs` VALUES ('5423', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 13:51:52');
INSERT INTO `logs` VALUES ('5424', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:51:52');
INSERT INTO `logs` VALUES ('5425', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:53:33');
INSERT INTO `logs` VALUES ('5426', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 13:53:37');
INSERT INTO `logs` VALUES ('5427', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:00:49');
INSERT INTO `logs` VALUES ('5428', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:00:51');
INSERT INTO `logs` VALUES ('5429', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:00:51');
INSERT INTO `logs` VALUES ('5430', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:00:52');
INSERT INTO `logs` VALUES ('5431', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:00:53');
INSERT INTO `logs` VALUES ('5432', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:00:53');
INSERT INTO `logs` VALUES ('5433', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:00:54');
INSERT INTO `logs` VALUES ('5434', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:00:54');
INSERT INTO `logs` VALUES ('5435', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:00:54');
INSERT INTO `logs` VALUES ('5436', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:00:55');
INSERT INTO `logs` VALUES ('5437', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:00:55');
INSERT INTO `logs` VALUES ('5438', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:01:53');
INSERT INTO `logs` VALUES ('5439', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:01:57');
INSERT INTO `logs` VALUES ('5440', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:02:00');
INSERT INTO `logs` VALUES ('5441', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:02:00');
INSERT INTO `logs` VALUES ('5442', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:02:02');
INSERT INTO `logs` VALUES ('5443', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:02:02');
INSERT INTO `logs` VALUES ('5444', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:02:03');
INSERT INTO `logs` VALUES ('5445', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:02:03');
INSERT INTO `logs` VALUES ('5446', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:02:04');
INSERT INTO `logs` VALUES ('5447', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:02:04');
INSERT INTO `logs` VALUES ('5448', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:02:05');
INSERT INTO `logs` VALUES ('5449', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:02:05');
INSERT INTO `logs` VALUES ('5450', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:02:06');
INSERT INTO `logs` VALUES ('5451', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:02:06');
INSERT INTO `logs` VALUES ('5452', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:02:07');
INSERT INTO `logs` VALUES ('5453', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:02:08');
INSERT INTO `logs` VALUES ('5454', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:02:45');
INSERT INTO `logs` VALUES ('5455', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:02:48');
INSERT INTO `logs` VALUES ('5456', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:02:52');
INSERT INTO `logs` VALUES ('5457', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:02:52');
INSERT INTO `logs` VALUES ('5458', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:07:00');
INSERT INTO `logs` VALUES ('5459', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:07:01');
INSERT INTO `logs` VALUES ('5460', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:07:01');
INSERT INTO `logs` VALUES ('5461', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:07:05');
INSERT INTO `logs` VALUES ('5462', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:07:05');
INSERT INTO `logs` VALUES ('5463', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:07:07');
INSERT INTO `logs` VALUES ('5464', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:07:07');
INSERT INTO `logs` VALUES ('5465', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:07:16');
INSERT INTO `logs` VALUES ('5466', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:07:21');
INSERT INTO `logs` VALUES ('5467', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:07:21');
INSERT INTO `logs` VALUES ('5468', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:08:33');
INSERT INTO `logs` VALUES ('5469', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:08:34');
INSERT INTO `logs` VALUES ('5470', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:08:34');
INSERT INTO `logs` VALUES ('5471', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:08:36');
INSERT INTO `logs` VALUES ('5472', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:08:37');
INSERT INTO `logs` VALUES ('5473', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:08:39');
INSERT INTO `logs` VALUES ('5474', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:08:40');
INSERT INTO `logs` VALUES ('5475', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:08:40');
INSERT INTO `logs` VALUES ('5476', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:09:12');
INSERT INTO `logs` VALUES ('5477', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:09:14');
INSERT INTO `logs` VALUES ('5478', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:09:16');
INSERT INTO `logs` VALUES ('5479', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:09:17');
INSERT INTO `logs` VALUES ('5480', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:09:17');
INSERT INTO `logs` VALUES ('5481', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:10:02');
INSERT INTO `logs` VALUES ('5482', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:10:05');
INSERT INTO `logs` VALUES ('5483', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:10:06');
INSERT INTO `logs` VALUES ('5484', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:10:10');
INSERT INTO `logs` VALUES ('5485', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:10:10');
INSERT INTO `logs` VALUES ('5486', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:10:11');
INSERT INTO `logs` VALUES ('5487', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:10:12');
INSERT INTO `logs` VALUES ('5488', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:10:13');
INSERT INTO `logs` VALUES ('5489', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:10:14');
INSERT INTO `logs` VALUES ('5490', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:10:31');
INSERT INTO `logs` VALUES ('5491', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:10:32');
INSERT INTO `logs` VALUES ('5492', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:10:32');
INSERT INTO `logs` VALUES ('5493', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:10:35');
INSERT INTO `logs` VALUES ('5494', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:10:35');
INSERT INTO `logs` VALUES ('5495', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:10:36');
INSERT INTO `logs` VALUES ('5496', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:10:36');
INSERT INTO `logs` VALUES ('5497', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:10:37');
INSERT INTO `logs` VALUES ('5498', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:10:37');
INSERT INTO `logs` VALUES ('5499', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:10:37');
INSERT INTO `logs` VALUES ('5500', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:10:38');
INSERT INTO `logs` VALUES ('5501', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:24:42');
INSERT INTO `logs` VALUES ('5502', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:24:44');
INSERT INTO `logs` VALUES ('5503', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:24:44');
INSERT INTO `logs` VALUES ('5504', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:26:08');
INSERT INTO `logs` VALUES ('5505', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:26:12');
INSERT INTO `logs` VALUES ('5506', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:26:12');
INSERT INTO `logs` VALUES ('5507', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:34:07');
INSERT INTO `logs` VALUES ('5508', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:34:13');
INSERT INTO `logs` VALUES ('5509', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:34:15');
INSERT INTO `logs` VALUES ('5510', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:34:15');
INSERT INTO `logs` VALUES ('5511', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:34:41');
INSERT INTO `logs` VALUES ('5512', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:34:45');
INSERT INTO `logs` VALUES ('5513', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:34:46');
INSERT INTO `logs` VALUES ('5514', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:34:46');
INSERT INTO `logs` VALUES ('5515', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:35:57');
INSERT INTO `logs` VALUES ('5516', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:36:00');
INSERT INTO `logs` VALUES ('5517', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:36:01');
INSERT INTO `logs` VALUES ('5518', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:36:01');
INSERT INTO `logs` VALUES ('5519', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:36:30');
INSERT INTO `logs` VALUES ('5520', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:36:33');
INSERT INTO `logs` VALUES ('5521', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:36:34');
INSERT INTO `logs` VALUES ('5522', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:36:34');
INSERT INTO `logs` VALUES ('5523', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:36:43');
INSERT INTO `logs` VALUES ('5524', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:36:43');
INSERT INTO `logs` VALUES ('5525', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:36:47');
INSERT INTO `logs` VALUES ('5526', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:36:47');
INSERT INTO `logs` VALUES ('5527', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:37:01');
INSERT INTO `logs` VALUES ('5528', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:37:02');
INSERT INTO `logs` VALUES ('5529', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:37:02');
INSERT INTO `logs` VALUES ('5530', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:37:10');
INSERT INTO `logs` VALUES ('5531', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:37:10');
INSERT INTO `logs` VALUES ('5532', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:37:12');
INSERT INTO `logs` VALUES ('5533', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:37:12');
INSERT INTO `logs` VALUES ('5534', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:37:15');
INSERT INTO `logs` VALUES ('5535', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:37:15');
INSERT INTO `logs` VALUES ('5536', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:37:17');
INSERT INTO `logs` VALUES ('5537', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:55:55');
INSERT INTO `logs` VALUES ('5538', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:57:25');
INSERT INTO `logs` VALUES ('5539', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:57:28');
INSERT INTO `logs` VALUES ('5540', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:57:29');
INSERT INTO `logs` VALUES ('5541', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:57:29');
INSERT INTO `logs` VALUES ('5542', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:57:36');
INSERT INTO `logs` VALUES ('5543', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:57:37');
INSERT INTO `logs` VALUES ('5544', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:57:43');
INSERT INTO `logs` VALUES ('5545', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:57:44');
INSERT INTO `logs` VALUES ('5546', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:58:02');
INSERT INTO `logs` VALUES ('5547', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:58:03');
INSERT INTO `logs` VALUES ('5548', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:58:04');
INSERT INTO `logs` VALUES ('5549', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:58:04');
INSERT INTO `logs` VALUES ('5550', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:58:25');
INSERT INTO `logs` VALUES ('5551', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:58:25');
INSERT INTO `logs` VALUES ('5552', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:58:31');
INSERT INTO `logs` VALUES ('5553', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:58:53');
INSERT INTO `logs` VALUES ('5554', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:58:53');
INSERT INTO `logs` VALUES ('5555', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:59:06');
INSERT INTO `logs` VALUES ('5556', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 14:59:06');
INSERT INTO `logs` VALUES ('5557', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 14:59:17');
INSERT INTO `logs` VALUES ('5558', 'backend.app', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 14:59:18');
INSERT INTO `logs` VALUES ('5559', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 14:59:19');
INSERT INTO `logs` VALUES ('5560', 'backend.app', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 14:59:21');
INSERT INTO `logs` VALUES ('5561', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 14:59:22');
INSERT INTO `logs` VALUES ('5562', 'backend.login', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:14:41');
INSERT INTO `logs` VALUES ('5563', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:14:41');
INSERT INTO `logs` VALUES ('5564', 'backend.app', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:14:44');
INSERT INTO `logs` VALUES ('5565', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:14:46');
INSERT INTO `logs` VALUES ('5566', 'backend.app', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:33:57');
INSERT INTO `logs` VALUES ('5567', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:33:58');
INSERT INTO `logs` VALUES ('5568', 'backend.app', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:34:00');
INSERT INTO `logs` VALUES ('5569', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:34:02');
INSERT INTO `logs` VALUES ('5570', 'backend.app', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:35:33');
INSERT INTO `logs` VALUES ('5571', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:35:34');
INSERT INTO `logs` VALUES ('5572', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:37:09');
INSERT INTO `logs` VALUES ('5573', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:37:12');
INSERT INTO `logs` VALUES ('5574', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:38:25');
INSERT INTO `logs` VALUES ('5575', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:38:28');
INSERT INTO `logs` VALUES ('5576', 'member.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:38:43');
INSERT INTO `logs` VALUES ('5577', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:38:52');
INSERT INTO `logs` VALUES ('5578', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:40:19');
INSERT INTO `logs` VALUES ('5579', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:40:37');
INSERT INTO `logs` VALUES ('5580', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:42:21');
INSERT INTO `logs` VALUES ('5581', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:42:25');
INSERT INTO `logs` VALUES ('5582', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:42:29');
INSERT INTO `logs` VALUES ('5583', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:42:31');
INSERT INTO `logs` VALUES ('5584', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:43:03');
INSERT INTO `logs` VALUES ('5585', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:43:07');
INSERT INTO `logs` VALUES ('5586', 'mould.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:43:11');
INSERT INTO `logs` VALUES ('5587', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:43:14');
INSERT INTO `logs` VALUES ('5588', 'mould.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:43:49');
INSERT INTO `logs` VALUES ('5589', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:43:51');
INSERT INTO `logs` VALUES ('5590', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:44:24');
INSERT INTO `logs` VALUES ('5591', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:44:26');
INSERT INTO `logs` VALUES ('5592', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:45:01');
INSERT INTO `logs` VALUES ('5593', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:45:28');
INSERT INTO `logs` VALUES ('5594', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:47:32');
INSERT INTO `logs` VALUES ('5595', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:47:35');
INSERT INTO `logs` VALUES ('5596', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:47:36');
INSERT INTO `logs` VALUES ('5597', 'member.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:47:39');
INSERT INTO `logs` VALUES ('5598', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:47:42');
INSERT INTO `logs` VALUES ('5599', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:47:43');
INSERT INTO `logs` VALUES ('5600', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:47:46');
INSERT INTO `logs` VALUES ('5601', 'member.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:47:47');
INSERT INTO `logs` VALUES ('5602', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:47:49');
INSERT INTO `logs` VALUES ('5603', 'mould.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:47:54');
INSERT INTO `logs` VALUES ('5604', 'database.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:47:58');
INSERT INTO `logs` VALUES ('5605', 'mould.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:47:59');
INSERT INTO `logs` VALUES ('5606', 'mould.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:49:26');
INSERT INTO `logs` VALUES ('5607', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:49:28');
INSERT INTO `logs` VALUES ('5608', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:49:30');
INSERT INTO `logs` VALUES ('5609', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:49:31');
INSERT INTO `logs` VALUES ('5610', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:49:34');
INSERT INTO `logs` VALUES ('5611', 'backend.home', '', '127.0.0.1', '112312313', '2019-09-10 15:50:12');
INSERT INTO `logs` VALUES ('5612', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 15:50:12');
INSERT INTO `logs` VALUES ('5613', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 15:50:24');
INSERT INTO `logs` VALUES ('5614', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 15:50:50');
INSERT INTO `logs` VALUES ('5615', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:47:39');
INSERT INTO `logs` VALUES ('5616', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:47:42');
INSERT INTO `logs` VALUES ('5617', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:47:51');
INSERT INTO `logs` VALUES ('5618', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:47:55');
INSERT INTO `logs` VALUES ('5619', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:47:58');
INSERT INTO `logs` VALUES ('5620', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:48:00');
INSERT INTO `logs` VALUES ('5621', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:48:01');
INSERT INTO `logs` VALUES ('5622', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:48:03');
INSERT INTO `logs` VALUES ('5623', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:48:17');
INSERT INTO `logs` VALUES ('5624', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:48:50');
INSERT INTO `logs` VALUES ('5625', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:48:52');
INSERT INTO `logs` VALUES ('5626', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:48:56');
INSERT INTO `logs` VALUES ('5627', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:49:01');
INSERT INTO `logs` VALUES ('5628', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:49:07');
INSERT INTO `logs` VALUES ('5629', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:49:09');
INSERT INTO `logs` VALUES ('5630', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:50:16');
INSERT INTO `logs` VALUES ('5631', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:50:18');
INSERT INTO `logs` VALUES ('5632', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:50:19');
INSERT INTO `logs` VALUES ('5633', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:50:21');
INSERT INTO `logs` VALUES ('5634', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:50:23');
INSERT INTO `logs` VALUES ('5635', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:50:25');
INSERT INTO `logs` VALUES ('5636', 'block.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:50:29');
INSERT INTO `logs` VALUES ('5637', 'role.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:50:33');
INSERT INTO `logs` VALUES ('5638', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:53:17');
INSERT INTO `logs` VALUES ('5639', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:53:22');
INSERT INTO `logs` VALUES ('5640', 'member.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:53:25');
INSERT INTO `logs` VALUES ('5641', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:53:26');
INSERT INTO `logs` VALUES ('5642', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:53:27');
INSERT INTO `logs` VALUES ('5643', 'mould.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:53:32');
INSERT INTO `logs` VALUES ('5644', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:53:34');
INSERT INTO `logs` VALUES ('5645', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:53:43');
INSERT INTO `logs` VALUES ('5646', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:57:17');
INSERT INTO `logs` VALUES ('5647', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:57:56');
INSERT INTO `logs` VALUES ('5648', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:58:47');
INSERT INTO `logs` VALUES ('5649', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:58:53');
INSERT INTO `logs` VALUES ('5650', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:58:54');
INSERT INTO `logs` VALUES ('5651', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:58:55');
INSERT INTO `logs` VALUES ('5652', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:58:56');
INSERT INTO `logs` VALUES ('5653', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:58:57');
INSERT INTO `logs` VALUES ('5654', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:58:58');
INSERT INTO `logs` VALUES ('5655', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:58:58');
INSERT INTO `logs` VALUES ('5656', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:58:59');
INSERT INTO `logs` VALUES ('5657', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:59:00');
INSERT INTO `logs` VALUES ('5658', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 16:59:05');
INSERT INTO `logs` VALUES ('5659', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:00:09');
INSERT INTO `logs` VALUES ('5660', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:00:11');
INSERT INTO `logs` VALUES ('5661', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:00:12');
INSERT INTO `logs` VALUES ('5662', 'database.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:00:14');
INSERT INTO `logs` VALUES ('5663', 'database.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:00:17');
INSERT INTO `logs` VALUES ('5664', 'database.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:00:18');
INSERT INTO `logs` VALUES ('5665', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:40:36');
INSERT INTO `logs` VALUES ('5666', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:45:40');
INSERT INTO `logs` VALUES ('5667', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:46:12');
INSERT INTO `logs` VALUES ('5668', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:46:14');
INSERT INTO `logs` VALUES ('5669', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:47:06');
INSERT INTO `logs` VALUES ('5670', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:47:16');
INSERT INTO `logs` VALUES ('5671', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:47:17');
INSERT INTO `logs` VALUES ('5672', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:47:30');
INSERT INTO `logs` VALUES ('5673', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:47:31');
INSERT INTO `logs` VALUES ('5674', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:47:33');
INSERT INTO `logs` VALUES ('5675', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:47:35');
INSERT INTO `logs` VALUES ('5676', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:48:01');
INSERT INTO `logs` VALUES ('5677', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:48:12');
INSERT INTO `logs` VALUES ('5678', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:48:23');
INSERT INTO `logs` VALUES ('5679', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:48:24');
INSERT INTO `logs` VALUES ('5680', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:48:29');
INSERT INTO `logs` VALUES ('5681', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:48:31');
INSERT INTO `logs` VALUES ('5682', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:48:33');
INSERT INTO `logs` VALUES ('5683', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:48:34');
INSERT INTO `logs` VALUES ('5684', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:48:36');
INSERT INTO `logs` VALUES ('5685', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:48:37');
INSERT INTO `logs` VALUES ('5686', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:48:44');
INSERT INTO `logs` VALUES ('5687', 'mould.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:49:20');
INSERT INTO `logs` VALUES ('5688', 'mould.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:54:29');
INSERT INTO `logs` VALUES ('5689', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:54:31');
INSERT INTO `logs` VALUES ('5690', 'user.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:54:53');
INSERT INTO `logs` VALUES ('5691', 'page.contact_us', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:54:56');
INSERT INTO `logs` VALUES ('5692', 'page.create', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 17:54:56');
INSERT INTO `logs` VALUES ('5693', 'page.create', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 18:39:49');
INSERT INTO `logs` VALUES ('5694', 'user.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 18:39:52');
INSERT INTO `logs` VALUES ('5695', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 18:39:58');
INSERT INTO `logs` VALUES ('5696', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:47:40');
INSERT INTO `logs` VALUES ('5697', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:47:42');
INSERT INTO `logs` VALUES ('5698', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:48:13');
INSERT INTO `logs` VALUES ('5699', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:48:47');
INSERT INTO `logs` VALUES ('5700', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:49:09');
INSERT INTO `logs` VALUES ('5701', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:51:19');
INSERT INTO `logs` VALUES ('5702', 'menu.create', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:51:36');
INSERT INTO `logs` VALUES ('5703', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:52:55');
INSERT INTO `logs` VALUES ('5704', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:53:40');
INSERT INTO `logs` VALUES ('5705', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:54:11');
INSERT INTO `logs` VALUES ('5706', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:54:17');
INSERT INTO `logs` VALUES ('5707', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:54:25');
INSERT INTO `logs` VALUES ('5708', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:55:14');
INSERT INTO `logs` VALUES ('5709', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:55:15');
INSERT INTO `logs` VALUES ('5710', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:56:07');
INSERT INTO `logs` VALUES ('5711', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:56:16');
INSERT INTO `logs` VALUES ('5712', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:56:47');
INSERT INTO `logs` VALUES ('5713', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:56:49');
INSERT INTO `logs` VALUES ('5714', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:56:58');
INSERT INTO `logs` VALUES ('5715', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:57:00');
INSERT INTO `logs` VALUES ('5716', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:57:29');
INSERT INTO `logs` VALUES ('5717', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:59:35');
INSERT INTO `logs` VALUES ('5718', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 19:59:37');
INSERT INTO `logs` VALUES ('5719', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 20:49:09');
INSERT INTO `logs` VALUES ('5720', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 20:51:09');
INSERT INTO `logs` VALUES ('5721', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 20:51:11');
INSERT INTO `logs` VALUES ('5722', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 20:52:05');
INSERT INTO `logs` VALUES ('5723', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 20:52:08');
INSERT INTO `logs` VALUES ('5724', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 20:52:09');
INSERT INTO `logs` VALUES ('5725', 'member.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 20:52:11');
INSERT INTO `logs` VALUES ('5726', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 20:52:14');
INSERT INTO `logs` VALUES ('5727', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:29:18');
INSERT INTO `logs` VALUES ('5728', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:31:51');
INSERT INTO `logs` VALUES ('5729', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:31:55');
INSERT INTO `logs` VALUES ('5730', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:33:22');
INSERT INTO `logs` VALUES ('5731', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:33:24');
INSERT INTO `logs` VALUES ('5732', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:34:25');
INSERT INTO `logs` VALUES ('5733', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:34:42');
INSERT INTO `logs` VALUES ('5734', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:36:56');
INSERT INTO `logs` VALUES ('5735', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:36:57');
INSERT INTO `logs` VALUES ('5736', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:41:40');
INSERT INTO `logs` VALUES ('5737', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:42:24');
INSERT INTO `logs` VALUES ('5738', 'template.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:44:03');
INSERT INTO `logs` VALUES ('5739', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:46:50');
INSERT INTO `logs` VALUES ('5740', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:48:03');
INSERT INTO `logs` VALUES ('5741', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:49:08');
INSERT INTO `logs` VALUES ('5742', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:49:11');
INSERT INTO `logs` VALUES ('5743', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:49:28');
INSERT INTO `logs` VALUES ('5744', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:49:32');
INSERT INTO `logs` VALUES ('5745', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:49:34');
INSERT INTO `logs` VALUES ('5746', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:49:36');
INSERT INTO `logs` VALUES ('5747', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:50:20');
INSERT INTO `logs` VALUES ('5748', 'database.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:50:32');
INSERT INTO `logs` VALUES ('5749', 'member.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:50:34');
INSERT INTO `logs` VALUES ('5750', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:50:34');
INSERT INTO `logs` VALUES ('5751', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:51:14');
INSERT INTO `logs` VALUES ('5752', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:51:16');
INSERT INTO `logs` VALUES ('5753', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:51:22');
INSERT INTO `logs` VALUES ('5754', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:51:32');
INSERT INTO `logs` VALUES ('5755', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:51:36');
INSERT INTO `logs` VALUES ('5756', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:52:01');
INSERT INTO `logs` VALUES ('5757', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:52:04');
INSERT INTO `logs` VALUES ('5758', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:52:06');
INSERT INTO `logs` VALUES ('5759', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:52:07');
INSERT INTO `logs` VALUES ('5760', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:52:36');
INSERT INTO `logs` VALUES ('5761', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:52:41');
INSERT INTO `logs` VALUES ('5762', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:52:44');
INSERT INTO `logs` VALUES ('5763', 'backend.home', '', '127.0.0.1', '112312313', '2019-09-10 21:53:04');
INSERT INTO `logs` VALUES ('5764', 'backend.login', '', '127.0.0.1', '112312313', '2019-09-10 21:53:05');
INSERT INTO `logs` VALUES ('5765', 'backend.login.form', '', '127.0.0.1', '112312313', '2019-09-10 21:53:17');
INSERT INTO `logs` VALUES ('5766', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:53:29');
INSERT INTO `logs` VALUES ('5767', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:53:32');
INSERT INTO `logs` VALUES ('5768', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:53:37');
INSERT INTO `logs` VALUES ('5769', 'content.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:53:38');
INSERT INTO `logs` VALUES ('5770', 'member.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:53:40');
INSERT INTO `logs` VALUES ('5771', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:53:44');
INSERT INTO `logs` VALUES ('5772', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:54:24');
INSERT INTO `logs` VALUES ('5773', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:54:28');
INSERT INTO `logs` VALUES ('5774', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-10 21:55:38');
INSERT INTO `logs` VALUES ('5775', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:16:27');
INSERT INTO `logs` VALUES ('5776', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:16:33');
INSERT INTO `logs` VALUES ('5777', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:18:44');
INSERT INTO `logs` VALUES ('5778', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:19:09');
INSERT INTO `logs` VALUES ('5779', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:19:48');
INSERT INTO `logs` VALUES ('5780', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:20:48');
INSERT INTO `logs` VALUES ('5781', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:21:33');
INSERT INTO `logs` VALUES ('5782', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:22:43');
INSERT INTO `logs` VALUES ('5783', 'member.create', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:22:48');
INSERT INTO `logs` VALUES ('5784', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:23:19');
INSERT INTO `logs` VALUES ('5785', 'member.create', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:23:22');
INSERT INTO `logs` VALUES ('5786', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:25:37');
INSERT INTO `logs` VALUES ('5787', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:28:01');
INSERT INTO `logs` VALUES ('5788', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:28:03');
INSERT INTO `logs` VALUES ('5789', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:28:10');
INSERT INTO `logs` VALUES ('5790', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:28:13');
INSERT INTO `logs` VALUES ('5791', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:28:22');
INSERT INTO `logs` VALUES ('5792', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:28:56');
INSERT INTO `logs` VALUES ('5793', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:28:58');
INSERT INTO `logs` VALUES ('5794', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:30:47');
INSERT INTO `logs` VALUES ('5795', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:31:12');
INSERT INTO `logs` VALUES ('5796', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:32:35');
INSERT INTO `logs` VALUES ('5797', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:36:26');
INSERT INTO `logs` VALUES ('5798', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:39:29');
INSERT INTO `logs` VALUES ('5799', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:39:35');
INSERT INTO `logs` VALUES ('5800', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:40:48');
INSERT INTO `logs` VALUES ('5801', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:45:35');
INSERT INTO `logs` VALUES ('5802', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 14:45:41');
INSERT INTO `logs` VALUES ('5803', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:12:36');
INSERT INTO `logs` VALUES ('5804', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:13:30');
INSERT INTO `logs` VALUES ('5805', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:13:36');
INSERT INTO `logs` VALUES ('5806', 'backend.home', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:18:29');
INSERT INTO `logs` VALUES ('5807', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:18:33');
INSERT INTO `logs` VALUES ('5808', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:19:07');
INSERT INTO `logs` VALUES ('5809', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:20:06');
INSERT INTO `logs` VALUES ('5810', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:35:57');
INSERT INTO `logs` VALUES ('5811', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:40:23');
INSERT INTO `logs` VALUES ('5812', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:41:26');
INSERT INTO `logs` VALUES ('5813', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:41:30');
INSERT INTO `logs` VALUES ('5814', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:41:39');
INSERT INTO `logs` VALUES ('5815', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:41:42');
INSERT INTO `logs` VALUES ('5816', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:43:29');
INSERT INTO `logs` VALUES ('5817', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:44:38');
INSERT INTO `logs` VALUES ('5818', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:48:14');
INSERT INTO `logs` VALUES ('5819', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:53:45');
INSERT INTO `logs` VALUES ('5820', 'menu.destroy', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 15:53:53');
INSERT INTO `logs` VALUES ('5821', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 18:01:09');
INSERT INTO `logs` VALUES ('5822', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 18:01:13');
INSERT INTO `logs` VALUES ('5823', 'menu.destroy', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 18:01:17');
INSERT INTO `logs` VALUES ('5824', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 18:01:20');
INSERT INTO `logs` VALUES ('5825', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 18:01:26');
INSERT INTO `logs` VALUES ('5826', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 18:01:51');
INSERT INTO `logs` VALUES ('5827', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 18:01:56');
INSERT INTO `logs` VALUES ('5828', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 18:02:01');
INSERT INTO `logs` VALUES ('5829', 'member.create', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 18:02:30');
INSERT INTO `logs` VALUES ('5830', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 18:02:38');
INSERT INTO `logs` VALUES ('5831', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 18:03:00');
INSERT INTO `logs` VALUES ('5832', 'menu.create', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 18:03:03');
INSERT INTO `logs` VALUES ('5833', 'menu.index', 'hcweb', '127.0.0.1', '112312313', '2019-09-11 18:03:12');

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '会员名称',
  `avatar` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '会员头像',
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '会员邮箱',
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '密码',
  `tel` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '会员手机',
  `ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '最后登录IP',
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '登录城市',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '会员状态',
  `platform` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '注册平台',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_enabled` tinyint(4) DEFAULT NULL COMMENT '是否可用',
  `openid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '注册平台ID',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of members
-- ----------------------------

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '菜单标题',
  `route` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单路由名称',
  `target` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self' COMMENT '菜单打开方式',
  `icon_class` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单图标',
  `color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '菜单颜色',
  `order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜单排序',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `_lft` int(10) unsigned NOT NULL DEFAULT '0',
  `_rgt` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_title_unique` (`title`),
  KEY `menus__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('5', '后台菜单', 'menu.index', '_self', null, '#54667a', '0', '1', '2', '3', '6', '2019-01-05 16:37:49', '2019-01-05 16:39:41');
INSERT INTO `menus` VALUES ('6', '站点管理', '', '_self', 'fa fa-globe', '#54667a', '0', '1', '1', '8', null, '2019-01-05 16:38:32', '2019-01-05 16:38:32');
INSERT INTO `menus` VALUES ('7', '栏目管理', 'category.index', '_self', null, '#54667a', '0', '1', '4', '5', '6', '2019-01-05 16:40:11', '2019-05-28 18:40:41');
INSERT INTO `menus` VALUES ('8', '系统配置', 'system.index', '_self', null, '#54667a', '0', '1', '6', '7', '6', '2019-01-05 16:40:29', '2019-01-05 19:22:10');
INSERT INTO `menus` VALUES ('29', '模板管理', 'template.index', '_self', 'fa fa-file', null, '0', '1', '43', '44', null, '2019-05-18 13:39:19', '2019-05-18 13:39:19');
INSERT INTO `menus` VALUES ('10', '模型管理', 'mould.index', '_self', 'fa fa-sitemap', '#54667a', '0', '1', '9', '10', null, '2019-01-05 16:41:08', '2019-03-31 05:24:27');
INSERT INTO `menus` VALUES ('11', '控制面板', 'backend.home', '_self', 'fa fa-home', '#54667a', '101', '1', '11', '12', null, '2019-01-05 16:41:58', '2019-05-23 17:36:24');
INSERT INTO `menus` VALUES ('12', '数据库管理', 'database.index', '_self', 'fa fa-database', '#54667a', '0', '1', '13', '14', null, '2019-01-05 16:46:39', '2019-02-16 08:15:07');
INSERT INTO `menus` VALUES ('30', '会员管理', 'member.index', '_self', 'fa fa-user-plus', null, '10', '1', '47', '48', null, '2019-05-27 13:50:14', '2019-05-27 13:52:49');
INSERT INTO `menus` VALUES ('14', '系统用户', null, '_self', 'fa fa-users', '#54667a', '3', '1', '15', '24', null, '2019-01-05 16:47:53', '2019-01-05 20:12:01');
INSERT INTO `menus` VALUES ('15', '管理员管理', 'user.index', '_self', null, '#54667a', '0', '1', '16', '17', '14', '2019-01-05 16:48:12', '2019-01-05 20:14:36');
INSERT INTO `menus` VALUES ('16', '角色管理', 'role.index', '_self', null, '#54667a', '0', '1', '18', '19', '14', '2019-01-05 16:48:23', '2019-01-05 20:14:49');
INSERT INTO `menus` VALUES ('17', '权限管理', 'permission.index', '_self', null, '#54667a', '0', '1', '20', '21', '14', '2019-01-05 16:48:37', '2019-02-15 16:47:04');
INSERT INTO `menus` VALUES ('18', '内容管理', null, '_self', 'fa fa-book', '#54667a', '4', '1', '25', '42', null, '2019-01-05 16:49:30', '2019-01-05 16:52:37');
INSERT INTO `menus` VALUES ('19', '自定义资料管理', 'block.index', '_self', null, '#54667a', '0', '1', '26', '27', '18', '2019-01-05 16:49:51', '2019-01-05 16:58:18');
INSERT INTO `menus` VALUES ('20', '资源管理', 'content.index', '_self', 'fa fa-clipboard', '#54667a', '20', '1', '45', '46', null, '2019-01-05 16:50:03', '2019-05-28 18:22:05');
INSERT INTO `menus` VALUES ('21', '友情链接', 'link.index', '_self', null, '#54667a', '0', '1', '28', '29', '18', '2019-01-05 16:50:15', '2019-01-05 17:12:34');
INSERT INTO `menus` VALUES ('22', '标签管理', 'tag.index', '_self', null, '#54667a', '0', '1', '30', '31', '18', '2019-01-05 16:50:24', '2019-01-05 20:00:29');
INSERT INTO `menus` VALUES ('32', '联系我们', 'page.contact_us', '_self', null, null, '0', '1', '32', '33', '18', '2019-05-28 18:38:56', '2019-05-29 12:59:57');
INSERT INTO `menus` VALUES ('31', '管理员日志', 'log.index', '_self', null, null, '0', '1', '22', '23', '14', '2019-05-28 09:42:50', '2019-05-28 09:42:50');
INSERT INTO `menus` VALUES ('33', '意见建议', 'message.index', '_self', null, null, '0', '1', '34', '35', '18', '2019-05-28 18:39:16', '2019-07-20 18:08:53');
INSERT INTO `menus` VALUES ('34', '使用帮助', 'page.help', '_self', null, null, '0', '1', '36', '37', '18', '2019-05-28 18:45:24', '2019-05-29 12:59:44');
INSERT INTO `menus` VALUES ('35', '工具软件', 'tool.index', '_self', null, null, '0', '1', '38', '39', '18', '2019-05-28 18:45:42', '2019-05-28 20:16:06');
INSERT INTO `menus` VALUES ('36', '图书索引管理', 'record.index', '_self', null, null, '0', '1', '40', '41', '18', '2019-05-30 21:52:40', '2019-05-31 15:14:22');
INSERT INTO `menus` VALUES ('37', '数据安全管理', 'role.index', '_self', 'fa fa-cogs', null, '0', '1', '49', '50', null, '2019-06-14 15:48:48', '2019-06-14 15:50:00');

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '姓名',
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '手机号',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '留言内容',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '备注',
  `ip` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'IP地址',
  `member_id` int(11) DEFAULT NULL COMMENT '会员ID',
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '城市',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of message
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES ('1', 'App\\Models\\User', '1');
INSERT INTO `model_has_roles` VALUES ('1', 'App\\User', '1');
INSERT INTO `model_has_roles` VALUES ('1', 'App\\Models\\User', '5');
INSERT INTO `model_has_roles` VALUES ('1', 'App\\Models\\User', '7');
INSERT INTO `model_has_roles` VALUES ('2', 'App\\Models\\User', '9');

-- ----------------------------
-- Table structure for model_tag
-- ----------------------------
DROP TABLE IF EXISTS `model_tag`;
CREATE TABLE `model_tag` (
  `tag_id` int(10) NOT NULL,
  `post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `picture_id` int(10) unsigned NOT NULL DEFAULT '0',
  `download_id` int(10) unsigned NOT NULL DEFAULT '0',
  `guest_book_id` int(10) unsigned NOT NULL DEFAULT '0',
  `single_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tag_id`,`post_id`,`picture_id`,`download_id`,`guest_book_id`,`single_id`),
  KEY `model_tag_post_id_foreign` (`post_id`),
  KEY `model_tag_picture_id_foreign` (`picture_id`),
  KEY `model_tag_download_id_foreign` (`download_id`),
  KEY `model_tag_guest_book_id_foreign` (`guest_book_id`),
  KEY `model_tag_single_id_foreign` (`single_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_tag
-- ----------------------------
INSERT INTO `model_tag` VALUES ('5', '0', '0', '7', '0', '0');
INSERT INTO `model_tag` VALUES ('5', '0', '1', '0', '0', '0');
INSERT INTO `model_tag` VALUES ('6', '0', '0', '2', '0', '0');
INSERT INTO `model_tag` VALUES ('6', '0', '0', '7', '0', '0');
INSERT INTO `model_tag` VALUES ('6', '0', '1', '0', '0', '0');
INSERT INTO `model_tag` VALUES ('7', '0', '0', '1', '0', '0');
INSERT INTO `model_tag` VALUES ('7', '0', '0', '7', '0', '0');
INSERT INTO `model_tag` VALUES ('7', '0', '1', '0', '0', '0');
INSERT INTO `model_tag` VALUES ('8', '0', '0', '7', '0', '0');
INSERT INTO `model_tag` VALUES ('8', '0', '1', '0', '0', '0');
INSERT INTO `model_tag` VALUES ('9', '0', '0', '7', '0', '0');
INSERT INTO `model_tag` VALUES ('9', '0', '1', '0', '0', '0');
INSERT INTO `model_tag` VALUES ('9', '20', '0', '0', '0', '0');
INSERT INTO `model_tag` VALUES ('11', '0', '0', '7', '0', '0');
INSERT INTO `model_tag` VALUES ('11', '0', '1', '0', '0', '0');
INSERT INTO `model_tag` VALUES ('12', '0', '0', '7', '0', '0');
INSERT INTO `model_tag` VALUES ('12', '0', '1', '0', '0', '0');
INSERT INTO `model_tag` VALUES ('12', '20', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for moulds
-- ----------------------------
DROP TABLE IF EXISTS `moulds`;
CREATE TABLE `moulds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模型名称',
  `ctr_name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '控制器名称',
  `table_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '模型附加表名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '模型状态1启用|0禁用',
  `is_system` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是系统模型',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `des` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '模型描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `repeat` tinyint(1) NOT NULL DEFAULT '1' COMMENT '标题是否可以重复',
  PRIMARY KEY (`id`),
  UNIQUE KEY `moulds_name_unique` (`name`),
  UNIQUE KEY `moulds_table_name_unique` (`table_name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of moulds
-- ----------------------------
INSERT INTO `moulds` VALUES ('1', '图书模型', 'PostController', 'post', '1', '0', '0', '图书模型', '2019-05-22 15:01:31', '2019-06-01 12:39:40', '1');
INSERT INTO `moulds` VALUES ('2', '多媒体模型', 'PictureController', 'picture', '1', '0', '0', '多媒体模型', '2019-05-22 15:02:00', '2019-06-13 15:45:37', '1');
INSERT INTO `moulds` VALUES ('3', '软件模型', 'DownloadController', 'download', '1', '0', '0', '软件模型', '2019-05-22 15:02:28', '2019-06-13 15:45:15', '1');
INSERT INTO `moulds` VALUES ('4', '留言模型', 'GuestBookController', 'guest_book', '1', '0', '0', '留言模型', '2019-05-22 15:02:56', '2019-05-22 15:02:56', '1');
INSERT INTO `moulds` VALUES ('5', '单页模型', 'SingleController', 'single', '1', '0', '0', '单页模型', '2019-05-22 15:03:18', '2019-05-22 15:03:18', '1');

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '单页内容',
  `alias` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '单页别名',
  `push_time` timestamp NULL DEFAULT NULL COMMENT '发布时间',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='单页';

-- ----------------------------
-- Records of page
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` int(10) unsigned NOT NULL COMMENT '所属分类id',
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`),
  UNIQUE KEY `permissions_display_name_unique` (`display_name`),
  UNIQUE KEY `permissions_url_unique` (`url`),
  KEY `permissions_menu_id_foreign` (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('4', 'backend_home', '控制面板', 'web', 'backend.home', '11', '控制面板', '2019-02-11 01:23:51', '2019-02-11 01:23:51');
INSERT INTO `permissions` VALUES ('5', 'user_index', '用户列表', 'web', 'user.index', '15', null, '2019-02-11 01:33:32', '2019-07-22 16:12:57');
INSERT INTO `permissions` VALUES ('6', 'block_index', '资料列表', 'web', 'block.index', '19', null, '2019-07-22 16:09:08', '2019-07-22 16:12:47');
INSERT INTO `permissions` VALUES ('7', 'block_create', '创建', 'web', 'block.create', '19', null, '2019-07-22 16:10:11', '2019-07-22 16:10:11');

-- ----------------------------
-- Table structure for picture
-- ----------------------------
DROP TABLE IF EXISTS `picture`;
CREATE TABLE `picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类id',
  `mould_id` int(10) unsigned NOT NULL COMMENT '所属模型id',
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '文章标题',
  `alias` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章别名',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否发布',
  `is_comment` tinyint(1) DEFAULT '0' COMMENT '允许评论',
  `is_top` tinyint(1) DEFAULT '0' COMMENT '推荐类型 置顶',
  `is_hot` tinyint(1) DEFAULT '0' COMMENT '推荐类型 热门',
  `is_tuijian` tinyint(1) DEFAULT '0' COMMENT '推荐类型 推荐',
  `is_slide` tinyint(1) DEFAULT '0' COMMENT '推荐类型 幻灯片',
  `thumb` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '封面图片',
  `font_style` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字体样式 b加粗 i倾斜',
  `color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字体颜色',
  `order` int(10) unsigned DEFAULT '0' COMMENT '排序',
  `views` int(10) unsigned DEFAULT '0' COMMENT '浏览次数',
  `push_time` timestamp NULL DEFAULT NULL COMMENT '发布时间',
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'URL链接',
  `source` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '本站' COMMENT '信息来源',
  `author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '管理员' COMMENT '文章作者',
  `summary` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '内容摘要',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '内容描述',
  `seo_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO标题',
  `seo_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO关健字',
  `seo_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `thumbs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '缩略图',
  `m_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '源文件',
  PRIMARY KEY (`id`),
  UNIQUE KEY `picture_alias_unique` (`alias`),
  UNIQUE KEY `picture_title_unique` (`title`),
  KEY `picture_category_id_foreign` (`category_id`),
  KEY `picture_mould_id_foreign` (`mould_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of picture
-- ----------------------------

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类id',
  `mould_id` int(10) unsigned NOT NULL COMMENT '所属模型id',
  `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '书名',
  `alias` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '书别名',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '是否发布',
  `is_comment` tinyint(1) DEFAULT '0' COMMENT '允许评论',
  `is_top` tinyint(1) DEFAULT '0' COMMENT '推荐类型 置顶',
  `is_hot` tinyint(1) DEFAULT '0' COMMENT '推荐类型 热门',
  `is_tuijian` tinyint(1) DEFAULT '0' COMMENT '推荐类型 推荐',
  `is_slide` tinyint(1) DEFAULT '0' COMMENT '推荐类型 幻灯片',
  `thumb` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '封面图片',
  `font_style` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字体样式 b加粗 i倾斜',
  `color` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '字体颜色',
  `order` int(10) unsigned DEFAULT '0' COMMENT '排序',
  `views` int(10) unsigned DEFAULT '0' COMMENT '浏览次数',
  `push_time` timestamp NULL DEFAULT NULL COMMENT '发布时间',
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'URL链接',
  `source` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '本站' COMMENT '信息来源',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '内容描述',
  `seo_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO标题',
  `seo_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO关健字',
  `seo_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `m_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '源文件',
  `isbn` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ISBN',
  `thumbs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '缩略图',
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_alias_unique` (`alias`),
  UNIQUE KEY `post_title_unique` (`title`),
  KEY `post_category_id_foreign` (`category_id`),
  KEY `post_mould_id_foreign` (`mould_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of post
-- ----------------------------

-- ----------------------------
-- Table structure for record
-- ----------------------------
DROP TABLE IF EXISTS `record`;
CREATE TABLE `record` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `b_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '书名',
  `b_auther` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '作者',
  `b_house` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '出版社',
  `b_push_time` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '出版日期',
  `b_isbn` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ISBN',
  `b_theme_word` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '主题词',
  `b_page_number` int(11) DEFAULT '10' COMMENT '页码',
  `b_cate_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '中图分类号',
  `b_series_name` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '丛书名',
  `b_price` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '价格',
  `b_summary` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '摘要',
  PRIMARY KEY (`id`),
  UNIQUE KEY `record_b_isbn_uindex` (`b_isbn`)
) ENGINE=MyISAM AUTO_INCREMENT=812 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='导入放入数据表';

-- ----------------------------
-- Records of record
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_display_name_unique` (`display_name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'admin', '超级管理员', 'web', '拥有网站的最高管理权限', '2019-02-11 02:20:07', '2019-02-11 02:20:07');
INSERT INTO `roles` VALUES ('2', 'czxczx', 'zxczxc', 'web', null, '2019-02-12 02:42:53', '2019-02-12 02:42:53');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES ('4', '1');
INSERT INTO `role_has_permissions` VALUES ('5', '1');

-- ----------------------------
-- Table structure for single
-- ----------------------------
DROP TABLE IF EXISTS `single`;
CREATE TABLE `single` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类id',
  `mould_id` int(10) unsigned NOT NULL COMMENT '所属模型id',
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章标题',
  `thumb` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '封面图片',
  `push_time` timestamp NULL DEFAULT NULL COMMENT '发布时间',
  `source` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '本站' COMMENT '信息来源',
  `author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '管理员' COMMENT '文章作者',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '内容描述',
  `seo_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO标题',
  `seo_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO关健字',
  `seo_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SEO描述',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `views` int(11) DEFAULT NULL COMMENT '浏览次数',
  `tttt` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'CESHI',
  PRIMARY KEY (`id`),
  UNIQUE KEY `single_title_unique` (`title`),
  KEY `single_category_id_foreign` (`category_id`),
  KEY `single_mould_id_foreign` (`mould_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of single
-- ----------------------------

-- ----------------------------
-- Table structure for systems
-- ----------------------------
DROP TABLE IF EXISTS `systems`;
CREATE TABLE `systems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '内容',
  `tabType` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '配置类型',
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '类型',
  `value` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '数值',
  `is_system` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是系统模型',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `systems_title_unique` (`title`),
  UNIQUE KEY `systems_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of systems
-- ----------------------------
INSERT INTO `systems` VALUES ('1', '关闭网站', 'is_close', '开启', 'base', 'radio', '关闭|开启', '1', '2019-05-27 19:57:12', '2019-05-27 19:57:12');
INSERT INTO `systems` VALUES ('2', '网站简称', 'site_alias', '锦茂数字图书馆 V5.0', 'base', 'input', null, '1', '2019-05-27 19:58:59', '2019-06-14 22:11:40');
INSERT INTO `systems` VALUES ('3', '网站LOGO', 'site_logo', '/uploads/images/picture/201905/27/site__1558958391_elES0cvwxu.png', 'base', 'image', null, '1', '2019-05-27 19:59:54', '2019-05-27 19:59:54');
INSERT INTO `systems` VALUES ('4', '地址栏图标', 'site_ico', '/medkd_resource/thumbs/201906//site_20190614222850.ico', 'base', 'image', null, '1', '2019-05-27 20:05:43', '2019-06-14 22:28:52');
INSERT INTO `systems` VALUES ('5', '网站网址', 'site_url', 'a-nan.cn', 'base', 'input', null, '1', '2019-05-27 20:06:07', '2019-05-27 20:06:07');
INSERT INTO `systems` VALUES ('6', '网站标题', 'site_title', '锦茂数字图书馆（医学版）——医学多媒体电子图书数据库', 'base', 'input', null, '1', '2019-05-27 20:06:27', '2019-05-28 14:55:16');
INSERT INTO `systems` VALUES ('7', '网站关键词', 'site_keywords', '医学电子图书、医学视频|医学课件|医学图片|医学考试题库|医学软件', 'base', 'input', null, '1', '2019-05-27 20:07:14', '2019-05-28 14:55:16');
INSERT INTO `systems` VALUES ('8', '网站描述', 'site_description', '锦茂数字图书馆（医学版）包含45000册中外文电子图书，10000个医学视频，10000个医学课件、10000个医学图片，上千套医学考试题库几医学精品软件', 'base', 'textarea', null, '1', '2019-05-27 20:07:48', '2019-05-28 14:55:16');
INSERT INTO `systems` VALUES ('9', '版权信息', 'site_copyright', '锦茂数字图书馆 医学版 © 2018', 'base', 'textarea', null, '1', '2019-05-27 20:08:51', '2019-06-08 18:55:31');
INSERT INTO `systems` VALUES ('10', '备案号', 'site_icp', null, 'base', 'input', null, '1', '2019-05-27 20:09:18', '2019-05-27 20:09:18');
INSERT INTO `systems` VALUES ('11', '允许上传的图片类型', 'site_img_type', 'jpg|gif|png|bmp|jpeg|ico', 'file', 'textarea', null, '1', '2019-05-27 20:10:29', '2019-05-27 20:10:29');
INSERT INTO `systems` VALUES ('12', '允许上传的软件类型', 'site_file_type', 'zip|gz|rar|iso|doc|xsl|ppt|wps|pdf|apk|docx|txt', 'file', 'textarea', null, '1', '2019-05-27 20:11:01', '2019-06-14 09:50:22');
INSERT INTO `systems` VALUES ('13', '允许多媒体文件类型', 'site_media_type', 'swf|mpg|mp3|rm|rmvb|wmv|wma|wav|mid|mov|mp4|flv', 'file', 'textarea', null, '1', '2019-05-27 20:12:15', '2019-06-14 16:44:04');
INSERT INTO `systems` VALUES ('14', '附件上传大小', 'site_file_size', '2M', 'file', 'select', '1M|2M|3M|5M|10M|50M|100M|300M|500M|1000M', '1', '2019-05-27 20:14:29', '2019-05-27 20:14:29');
INSERT INTO `systems` VALUES ('15', '邮件发送服务器(SMTP)', 'site_email_smtp', null, 'email', 'input', null, '1', '2019-05-27 20:37:09', '2019-05-27 20:37:09');
INSERT INTO `systems` VALUES ('16', '保存路径', 'site_file_path', '/medkd_resource', 'file', 'input', null, '0', '2019-06-01 19:09:56', '2019-06-01 19:09:56');
INSERT INTO `systems` VALUES ('17', '登录背景', 'login_bg', '/medkd_resource/thumbs/201906//site_20190617110652.jpg', 'base', 'image', null, '0', '2019-06-14 22:05:03', '2019-06-17 11:06:55');
INSERT INTO `systems` VALUES ('18', '昆华医院', 'site_user_name', '昆华医院', 'base', 'input', null, '0', '2019-06-14 22:10:57', '2019-06-14 22:11:13');

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标签名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tags_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tags
-- ----------------------------
INSERT INTO `tags` VALUES ('6', 'jquery465', '2019-02-12 12:37:44', '2019-02-13 11:59:41');
INSERT INTO `tags` VALUES ('5', 'laravel', '2019-02-12 12:37:38', '2019-02-12 12:37:38');
INSERT INTO `tags` VALUES ('7', 'jlkjkl', '2019-02-13 11:59:34', '2019-02-13 11:59:34');
INSERT INTO `tags` VALUES ('8', 'jlkjkl465456', '2019-02-25 04:05:14', '2019-02-25 04:05:31');
INSERT INTO `tags` VALUES ('9', 'fdgdf', '2019-05-17 11:02:09', '2019-05-17 11:02:09');
INSERT INTO `tags` VALUES ('11', 'fhfghfgh', '2019-05-20 14:50:19', '2019-05-20 14:50:19');
INSERT INTO `tags` VALUES ('12', 'fghfgh', '2019-05-20 14:50:22', '2019-05-20 14:50:22');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户邮箱',
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户密码',
  `avatar` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '/backend/images/default.jpg' COMMENT '用户头像',
  `tel` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '用户手机号',
  `real_name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '真实姓名',
  `is_enabled` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用户是否可用',
  `last_login_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '上次登录ip',
  `last_login_ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '最后登录ip',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'hcweb', '871328529@qq.com', '$2y$10$RNOyrNRtwGNsWKqIfLtjpebMjutYXAMOiUbIGj6e7GkOLN2y3IgRW', '/uploads/images/picture/201906/01/site__1559364203_IIeMNJFCkC.jpg', '13577069756', '谢天南', '1', null, null, null, null, 'Rbthu3jG5LtX9WDSsyRndMYJJ4LgbzNLTSLqcaA0O6TFMxIhjngAe296xSZn', '2019-02-10 12:44:48', '2019-06-01 12:43:25');
INSERT INTO `users` VALUES ('5', 'gdfgdfgdf', '13588888888@qq.com', '$2y$10$UK96wZmlHeC1xLR6B6/.zOe157NlmIhO1R.LNS7YO1CVfwAQE9802', '/uploads/images/picture/201902/12/site__1549986318_WamTakK72J.jpg', '13588888888', null, '1', null, null, null, null, null, '2019-02-11 08:46:17', '2019-02-12 15:45:21');
INSERT INTO `users` VALUES ('7', 'test', '13222222222@qq.com', '$2y$10$XQ3S2ic9TlnV4/CjdDzPCOBc/7fscLMubCDZKC4PQTvwwq39.mh.u', '/uploads/images/picture/201902/12/site__1549986328_NdzNtWCke9.jpg', '13222222222', null, '1', null, null, null, null, null, '2019-02-12 02:02:22', '2019-02-12 15:45:29');
INSERT INTO `users` VALUES ('9', 'lirui', '8713289@qq.com', '$2y$10$BLSFHDpv/10MdYy0CFrCnOJK3oAJoxRbYd2pABYaRbryRPSejgBTa', '/uploads/images/picture/201902/12/site__1549975135_2MHkbNKH3L.jpg', '13533333333', null, '1', null, null, null, null, null, '2019-02-12 12:39:41', '2019-02-12 12:39:41');

-- ----------------------------
-- Table structure for visitortracker_visits
-- ----------------------------
DROP TABLE IF EXISTS `visitortracker_visits`;
CREATE TABLE `visitortracker_visits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_ajax` tinyint(1) NOT NULL DEFAULT '0',
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `referer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_agent` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_desktop` tinyint(1) NOT NULL DEFAULT '0',
  `is_mobile` tinyint(1) NOT NULL DEFAULT '0',
  `is_bot` tinyint(1) NOT NULL DEFAULT '0',
  `bot` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os_family` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `os` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `browser_family` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `browser` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `is_login_attempt` tinyint(1) NOT NULL DEFAULT '0',
  `country` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `country_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `lat` double DEFAULT NULL,
  `long` double DEFAULT NULL,
  `browser_language_family` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `browser_language` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of visitortracker_visits
-- ----------------------------
