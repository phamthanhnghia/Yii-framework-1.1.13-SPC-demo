-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2016 at 11:19 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `muradvn`
--

-- --------------------------------------------------------

--
-- Table structure for table `gas_actions_roles`
--

CREATE TABLE IF NOT EXISTS `gas_actions_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `roles_id` smallint(11) unsigned DEFAULT NULL,
  `controller_id` int(11) unsigned DEFAULT NULL,
  `actions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `can_access` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_id` (`roles_id`),
  KEY `controller_id` (`controller_id`),
  KEY `can_access` (`can_access`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1141 ;

--
-- Dumping data for table `gas_actions_roles`
--

INSERT INTO `gas_actions_roles` (`id`, `roles_id`, `controller_id`, `actions`, `can_access`) VALUES
(55, 2, 111, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(56, 2, 112, 'News, Index, Create, View, Update, AjaxActivateField, AjaxDeactivateField, AjaxActivate, AjaxDeactivate', 'allow'),
(57, 2, 113, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(58, 2, 114, 'View, Edit, Create, Update, Delete, Index, Group, User, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(59, 2, 115, 'View, Create, Update, Delete, Index, Admin, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(60, 2, 116, 'GetActionsName, RolesSession, Test, Index', 'allow'),
(63, 2, 119, 'ExportExcel, View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(64, 2, 120, 'View, Create, Getcheckbox, Update, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(65, 2, 121, 'Create, View, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(66, 2, 122, 'View, Create, Imagepaging, Imageurl, Imageupload, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(69, 2, 125, 'View, Create, Update, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(71, 2, 127, 'Update, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(72, 2, 128, 'ForgotPassword, ResetPassword, ChangePassword, Error, Index, Login, Logout, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(73, 2, 129, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(77, 2, 133, 'Error, View', 'allow'),
(78, 2, 134, 'Index, ListProblem, ListSpecialty', 'allow'),
(79, 2, 135, 'Index, Unsubscribe, Error, Contact, ThankYou, GuestSubscriber, UnderConstruction, Test', 'allow'),
(113, 2, 114, '', 'deny'),
(123, 2, 122, '', 'deny'),
(125, 2, 120, 'Delete', 'deny'),
(128, 2, 141, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(129, 2, 141, '', 'deny'),
(141, 2, 142, 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove', 'allow'),
(142, 2, 142, '', 'deny'),
(155, 2, 147, 'Index, Create, View, Update', 'allow'),
(156, 2, 147, '', 'deny'),
(171, 2, 151, 'Index, Create, View, Update', 'allow'),
(172, 2, 151, '', 'deny'),
(201, 2, 162, 'Index, Create, View, Update, Add_customer_of_agent, Delete_customer_agent', 'allow'),
(202, 2, 162, '', 'deny'),
(211, 2, 166, 'Employees, Employees_create, Employees_update, Employees_view, AjaxActivate, AjaxDeactivate, Index, Create, View, Update, Mail_reset_password', 'allow'),
(212, 2, 166, 'Export_list_employees, Delete', 'deny'),
(267, 2, 112, 'Delete', 'deny'),
(276, 2, 169, 'Index, Create, View, Update', 'allow'),
(277, 2, 169, '', 'deny'),
(278, 2, 170, 'Index, Create, View, Update', 'allow'),
(279, 2, 170, '', 'deny'),
(342, 2, 125, 'Delete', 'deny'),
(363, 2, 178, 'ResetRoleCustomOfUser, Group, User', 'allow'),
(364, 2, 178, '', 'deny'),
(1021, 2, 185, 'Index, Create, Reply, Close_ticket, Pick_ticket', 'allow'),
(1022, 2, 185, 'Delete', 'deny'),
(1125, 2, 186, 'Index', 'allow'),
(1126, 2, 186, 'View, Create, Update, Delete', 'deny'),
(1127, 2, 187, 'Delete, Index', 'allow'),
(1128, 2, 187, 'View, Create, Update', 'deny'),
(1129, 2, 188, 'View, Create, Update, Delete, Index', 'allow'),
(1130, 2, 188, '', 'deny'),
(1131, 2, 189, 'View, Create, Update, Delete, Index', 'allow'),
(1132, 2, 189, '', 'deny'),
(1133, 2, 190, 'View, Create, Update, Delete, Index', 'allow'),
(1134, 2, 190, '', 'deny'),
(1135, 2, 191, 'View, Create, Update, Delete, Index', 'allow'),
(1136, 2, 191, '', 'deny'),
(1137, 2, 192, 'View, Create, Update, Delete, Index', 'allow'),
(1138, 2, 192, '', 'deny'),
(1139, 2, 193, 'View, Create, Update, Delete, Index', 'allow'),
(1140, 2, 193, '', 'deny');

-- --------------------------------------------------------

--
-- Table structure for table `gas_actions_users`
--

CREATE TABLE IF NOT EXISTS `gas_actions_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(11) unsigned DEFAULT NULL,
  `controller_id` int(11) unsigned DEFAULT NULL,
  `actions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `can_access` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `controller_id` (`controller_id`),
  KEY `can_access` (`can_access`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_api_check_signup`
--

CREATE TABLE IF NOT EXISTS `gas_api_check_signup` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `count_post_request` smallint(5) unsigned DEFAULT '0' COMMENT 'đếm số lần submit của 1 signup_code ( tương đương 1 user )',
  `code` varchar(100) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_api_request_logs`
--

CREATE TABLE IF NOT EXISTS `gas_api_request_logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` bigint(11) DEFAULT NULL,
  `method` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `response` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `responsed_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_api_users_tokens`
--

CREATE TABLE IF NOT EXISTS `gas_api_users_tokens` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'never delete this record, just only exprired because of using APNs device token',
  `user_id` int(11) unsigned NOT NULL COMMENT 'FK',
  `agent_id` bigint(11) unsigned DEFAULT NULL COMMENT 'xác định user của đại lý nào, hiện tại mới dành cho sub agent',
  `mobile_number` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'as session for the first time login to app via mobile number',
  `apns_device_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'APNs device token to push notification',
  `gcm_device_token` varchar(350) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'GCM device token to push notification',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `agent_id` (`agent_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `gas_api_users_tokens`
--

INSERT INTO `gas_api_users_tokens` (`id`, `user_id`, `agent_id`, `mobile_number`, `token`, `apns_device_token`, `gcm_device_token`, `created_date`) VALUES
(23, 259, NULL, '', '98985e3ae4f0b83b46ac9b8fbbb00e4d', NULL, NULL, '2015-07-15 01:34:22'),
(33, 120, NULL, 'hue@yahoo.com', '1932b96d70093cf895329b4c46f07fc4', '61bf940b4777917c7bef4a05887a6571ae91be730ec730187e3f66e6ec969e3e', NULL, '2015-07-15 03:25:05'),
(34, 120, NULL, 'hue@yahoo.com', 'dc36cc6fb2db91e515372db1821b6275', '', NULL, '2015-07-15 03:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `gas_cms`
--

CREATE TABLE IF NOT EXISTS `gas_cms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `banner` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cms_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_date` datetime NOT NULL,
  `display_order` tinyint(11) unsigned NOT NULL,
  `show_in_menu` tinyint(4) unsigned DEFAULT '0',
  `place_holder_id` tinyint(2) unsigned NOT NULL,
  `creator_id` int(5) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `short_content` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `meta_desc` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gas_cms`
--

INSERT INTO `gas_cms` (`id`, `title`, `slug`, `banner`, `cms_content`, `created_date`, `display_order`, `show_in_menu`, `place_holder_id`, `creator_id`, `status`, `short_content`, `link`, `meta_keywords`, `meta_desc`) VALUES
(1, 'Thông báo hết thử nghiệm', '', '', '<h4>\r\n	<strong><span style="color: rgb(255, 0, 0);"><span style="font-size: 20px;">Th&ocirc;ng B&aacute;o:</span></span></strong></h4>\r\n<ul>\r\n	<li>\r\n		<span style="font-size: 18px;">Hệ thống đ&atilde; qua một tuần thử nghiệm cho c&aacute;c đại l&yacute; l&agrave;m quen với phần mềm.</span></li>\r\n	<li>\r\n		<span style="font-size: 18px;">Tất cả dữ liệu trong tuần thử nghiệm sẽ bị x&oacute;a.</span></li>\r\n	<li>\r\n		<font size="4">Bắt đầu từ ng&agrave;y 21/10/2013 phần mềm ch&iacute;nh thức đi v&agrave;o sử dụng.</font></li>\r\n	<li>\r\n		<span style="font-size: 18px;">Mọi thắc mắc vui l&ograve;ng gọi điện về c&ocirc;ng ty.</span></li>\r\n</ul>\r\n<p>\r\n	&nbsp;</p>\r\n', '2014-06-03 13:09:57', 2, 0, 1, 5, 0, '', '', '', ''),
(2, 'Hướng dẫn nhập danh mục khách hàng', '', '', '<p style="text-align: justify;">\n	<span style="color:#ff0000;"><strong>Th&ocirc;ng b&aacute;o</strong></span></p>\n<p style="text-align: justify;">\n	Để tr&aacute;nh t&igrave;nh trạng xảy ra trong việc nhập liệu l&ecirc;n phần mềm bảo tr&igrave; của một số đại l&yacute; trong mấy ng&agrave;y vừa qua, bộ phận gi&aacute;m s&aacute;t hướng dẫn lại c&aacute;ch nhập liệu v&agrave; chỉnh sửa tr&ecirc;n phần mềm bảo tr&igrave; như sau:</p>\n<ul>\n	<li style="text-align: justify;">\n		Chỉ nhập l&ecirc;n phần mềm danh s&aacute;ch kh&aacute;ch h&agrave;ng đồng &yacute; cho nh&acirc;n vi&ecirc;n xuống bảo tr&igrave; (tr&aacute;nh trường hợp nhập trước l&ecirc;n phần mềm rồi mới gọi).</li>\n	<li style="text-align: justify;">\n		Nhập&nbsp;T&ecirc;n kh&aacute;ch h&agrave;ng: Anh Nguyễn Ngọc Ki&ecirc;n (ghi đầy đủ họ t&ecirc;n,<span style="color:#ff0000;"> th&ecirc;m chức danh</span>: anh, chị, c&ocirc;, ch&uacute;.... để bộ phận gi&aacute;m s&aacute;t tiện trong c&aacute;ch xưng h&ocirc; với kh&aacute;ch h&agrave;ng).</li>\n	<li style="text-align: justify;">\n		Nhập Địa chỉ: ghi đầy đủ, kh&ocirc;ng ghi tắt.</li>\n	<li style="text-align: justify;">\n		Nhập Số điện thoại: 0988 18 03 86 or 061 38 38 386, c&aacute;c bạn c&oacute; <span style="color:#ff0000;">thể nhập c&aacute;ch ra giữa c&aacute;c số </span>để dễ nh&igrave;n v&agrave; tr&aacute;nh trường hợp&nbsp;ghi nhầm hoặc thiếu số, lưu &yacute; ghi th&ecirc;m m&atilde; v&ugrave;ng.</li>\n	<li style="text-align: justify;">\n		Trong trường hợp c&aacute;c bạn nhập sai hoặc nhầm th&ocirc;ng tin kh&aacute;ch h&agrave;ng th&igrave; c&oacute; thể v&agrave;o chỉnh sửa lại (nhập chuột v&agrave;o <span style="color:#ff0000;">h&igrave;nh c&aacute;i b&uacute;t b&ecirc;n g&oacute;c phải m&agrave;n h&igrave;nh nằm&nbsp;c&ugrave;ng d&ograve;ng với th&ocirc;ng tin kh&aacute;ch h&agrave;ng). C&aacute;c bạn chỉ được chỉnh sửa trong ng&agrave;y, cho n&ecirc;n ch&uacute; &yacute; kiểm tra thật ch&iacute;nh x&aacute;c th&ocirc;ng tin kh&aacute;ch h&agrave;ng (kh&aacute;ch h&agrave;ng nhập ng&agrave;y 23/10/2013 th&igrave;&nbsp;được chỉnh sửa th&ocirc;ng tin trong ng&agrave;y 23, sang ng&agrave;y 24 l&agrave; kh&ocirc;ng được chỉnh sửa nữa).</span></li>\n</ul>\n<p style="text-align: justify;">\n	Nếu c&aacute;c bạn c&oacute; thắc mắc g&igrave; th&igrave; tổng hợp rồi gửi cho kế to&aacute;n khu vực.</p>\n', '2012-06-27 16:22:20', 1, 0, 1, 5, 1, '<ul>\r\n	<li>\r\n		Read more about BMI</li>\r\n	<li>\r\n		Calculate your BMI</li>\r\n	<li>\r\n		BMI chart</li>\r\n</ul>\r\n', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `gas_controllers`
--

CREATE TABLE IF NOT EXISTS `gas_controllers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `controller_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `module_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `actions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=194 ;

--
-- Dumping data for table `gas_controllers`
--

INSERT INTO `gas_controllers` (`id`, `controller_name`, `module_name`, `actions`) VALUES
(111, 'Categories', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(112, 'Cms', 'admin', 'View, Create, Update, Delete, Index, UploadFile, AjaxActivateField, AjaxDeactivateField, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(113, 'Contactus', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(114, 'Controllers', 'admin', 'View, Edit, Create, Update, Delete, Index, Group, User, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(115, 'Emailtemplates', 'admin', 'View, Create, Update, Delete, Index, Admin, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(116, 'GetActions', 'admin', 'GetActionsName, RolesSession, Test, Index'),
(119, 'Member', 'admin', 'ExportExcel, View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(120, 'Menus', 'admin', 'View, Create, Getcheckbox, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(121, 'Newsletter', 'admin', 'Create, View, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(122, 'Pages', 'admin', 'View, Create, Imagepaging, Imageurl, Imageupload, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(125, 'Roles', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(127, 'Setting', 'admin', 'Update, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(128, 'Site', 'admin', 'ForgotPassword, ResetPassword, ChangePassword, Error, Index, Login, Logout, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(129, 'Subscriber', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(141, 'seo', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(142, 'Subscribergroup', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(147, 'gasprovince', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(151, 'Gasdistrict', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(162, 'gasagent', 'admin', 'View, Create, Update, Delete, Index, Add_customer_of_agent, Delete_customer_agent, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(166, 'Gasmember', 'admin', 'View, Create, Update, Delete, Index, Employees, Employees_create, Employees_update, Employees_view, Export_list_employees, AjaxActivate, AjaxDeactivate, Mail_reset_password'),
(169, 'gasstreet', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(170, 'gasward', 'admin', 'View, Create, Update, Delete, Index, AjaxActivate, AjaxDeactivate, AjaxShow, AjaxNotShow, AjaxApprove'),
(178, 'RolesAuth', 'admin', 'ResetRoleCustomOfUser, Group, User'),
(185, 'Tickets', 'admin', 'View, Create, Update, Delete, Index, Reply, Close_ticket, Pick_ticket'),
(186, 'GasTrackLogin', 'admin', 'View, Create, Update, Delete, Index'),
(187, 'lognb', 'admin', 'View, Create, Update, Delete, Index'),
(188, 'MuradBanner', 'admin', 'View, Create, Update, Delete, Index'),
(189, 'MuradCategory', 'admin', 'View, Create, Update, Delete, Index'),
(190, 'MuradProduct', 'admin', 'View, Create, Update, Delete, Index'),
(191, 'MuradBrand', 'admin', 'View, Create, Update, Delete, Index'),
(192, 'MuradNews', 'admin', 'View, Create, Update, Delete, Index'),
(193, 'MuradVideo', 'admin', 'View, Create, Update, Delete, Index');

-- --------------------------------------------------------

--
-- Table structure for table `gas_email_templates`
--

CREATE TABLE IF NOT EXISTS `gas_email_templates` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `email_subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `parameter_description` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `gas_email_templates`
--

INSERT INTO `gas_email_templates` (`id`, `email_subject`, `email_body`, `parameter_description`, `type`) VALUES
(1, 'Request Reset Password Account Admin', '<p>\r\n	Dear {NAME},<br />\r\n	Someone requested that the password be reset for the following account in verzdesign website:<br />\r\n	<br />\r\n	Email: {EMAIL}</p>\r\n<p>\r\n	Username: {USERNAME}</p>\r\n<p>\r\n	<br />\r\n	If this was a mistake, just ignore this email and nothing will happen.<br />\r\n	<br />\r\n	To reset your password, visit the following address: {LINK}<br />\r\n	&nbsp;</p>\r\n<p>\r\n	Thank&nbsp; you and Regards,</p>\r\n<p>\r\n	Verzdesign</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '{NAME}: name of user.\r\n{EMAIL}: Email of user\r\n{LINK}: link reset\r\n', NULL),
(2, 'Reset Password Account Admin', '<p>\r\n	Dear {NAME},</p>\r\n<p>\r\n	You have requested a new password for verzdesign website</p>\r\n<p>\r\n	Your new password is:&nbsp; {PASSWORD}</p>\r\n<p>\r\n	Please click this link:&nbsp;&nbsp;{LINK_LOGIN}&nbsp;to login.</p>\r\n<p>\r\n	Thank&nbsp; you and Regards,</p>\r\n<p>\r\n	Verzdesign</p>\r\n', '{NAME}: name of user.\r\n{PASSWORD}: new password\r\n{LINK_LOGIN}: link login', NULL),
(3, 'Đổi mật khẩu ngày {DATE_APPLY}', '<p>\r\n	<span style="font-size:16px;">Xin ch&agrave;o: {NAME}</span></p>\r\n<p>\r\n	<span style="font-size:16px;">Mật khẩu mới của bạn ng&agrave;y {DATE_APPLY}&nbsp; l&agrave;: {PASSWORD_NEW}</span></p>\r\n<p>\r\n	Gửi từ daukhimiennam.com</p>\r\n', '{NAME}: tên user\r\n{DATE_APPLY}: ngày đổi mật khẩu\r\n{PASSWORD_NEW}: mật khẩu mới\r\n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_agent_customer`
--

CREATE TABLE IF NOT EXISTS `gas_gas_agent_customer` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `agent_id` bigint(11) unsigned DEFAULT NULL,
  `customer_id` bigint(11) unsigned DEFAULT NULL,
  `employee_maintain_id` bigint(11) unsigned DEFAULT NULL COMMENT 'vì ngại tách bảng nên sẽ dùng chung thằng này vs thằng khách hàng của đại lý.mã nhân viên check bảo trì ( người ngồi gọi điện check lại)',
  `maintain_agent_id` bigint(11) unsigned DEFAULT NULL COMMENT 'mã đại lý mà nhân viên check bảo trì theo dõi. phân cho mỗi người gọi check bảo trì 1 số đại lý để gọi, nhưng hiện tại không làm nữa',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `agent_id` (`agent_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_comment`
--

CREATE TABLE IF NOT EXISTS `gas_gas_comment` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned DEFAULT NULL COMMENT '1: spancop comment, 2 ... update',
  `belong_id` bigint(11) unsigned DEFAULT NULL COMMENT 'id bảng mà phụ thuộc, một nhiều',
  `status` tinyint(4) DEFAULT NULL COMMENT 'Now 02: for support agent: 1: new, 2: approved, 3: cancel',
  `uid_login` bigint(11) unsigned DEFAULT NULL,
  `content` text,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_district`
--

CREATE TABLE IF NOT EXISTS `gas_gas_district` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `province_id` smallint(5) unsigned DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `short_name` varchar(150) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '1',
  `slug` varchar(150) NOT NULL,
  `user_id_create` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_file`
--

CREATE TABLE IF NOT EXISTS `gas_gas_file` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned DEFAULT NULL,
  `belong_id` bigint(11) unsigned DEFAULT NULL COMMENT 'id bảng mà file phụ thuộc',
  `file_name` varchar(200) DEFAULT NULL,
  `order_number` tinyint(1) unsigned DEFAULT NULL COMMENT 'số thứ tự',
  `created_date` date DEFAULT NULL COMMENT 'sẽ lấy theo ngày tạo của root record, vì liên quan đến phần lưu và xóa file',
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`type`),
  KEY `order_number` (`order_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_leave`
--

CREATE TABLE IF NOT EXISTS `gas_gas_leave` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `agent_id` bigint(11) unsigned DEFAULT NULL,
  `uid_login` bigint(11) unsigned DEFAULT NULL COMMENT 'người tạo phép ',
  `to_uid_approved` bigint(11) unsigned DEFAULT NULL COMMENT 'gửi đến user approved',
  `uid_leave` bigint(11) unsigned NOT NULL COMMENT 'người nghỉ ',
  `leave_date_from` date NOT NULL,
  `leave_date_to` date DEFAULT NULL,
  `leave_content` varchar(500) DEFAULT NULL,
  `leave_days_real` tinyint(2) unsigned DEFAULT NULL COMMENT 'ngày nghỉ thực tế tính phép ',
  `leave_days_holidays` tinyint(2) unsigned DEFAULT NULL COMMENT 'số ngày nghỉ lễ ',
  `status` tinyint(2) unsigned DEFAULT '0' COMMENT '0: new, 1: approved by cấp quản lý, 2: appove by giám đốc, 3: reject',
  `need_manage_approved` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1: nhom user can quan ly approve',
  `manage_approved_uid` bigint(11) unsigned DEFAULT NULL COMMENT 'id cấp quản lý khi approved + rejected',
  `manage_approved_date` datetime DEFAULT NULL COMMENT 'ngày cấp quản lý duyệt ',
  `manage_approved_status` tinyint(1) unsigned DEFAULT NULL COMMENT 'trang thai cua quan ly khi duyet',
  `manage_note` varchar(300) DEFAULT NULL,
  `approved_director_id` bigint(11) unsigned DEFAULT NULL COMMENT 'id giám đốc khi approved + rejected',
  `approved_director_date` datetime DEFAULT NULL COMMENT 'ngày giám đốc approved ',
  `director_note` varchar(300) DEFAULT NULL COMMENT 'ghi chú cấp giám đốc khi update status',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `c_name` varchar(250) DEFAULT NULL COMMENT 'Tên user tại thời điểm đóđó',
  PRIMARY KEY (`id`),
  KEY `uid_leave` (`uid_leave`,`agent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_leave_holidays`
--

CREATE TABLE IF NOT EXISTS `gas_gas_leave_holidays` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_master_lookup`
--

CREATE TABLE IF NOT EXISTS `gas_gas_master_lookup` (
  `id` mediumint(5) NOT NULL AUTO_INCREMENT COMMENT 'bảng chung cho các table có tên để look up',
  `name` varchar(200) NOT NULL,
  `display_order` tinyint(3) NOT NULL COMMENT 'Số thứ tự',
  `type` tinyint(2) DEFAULT NULL COMMENT '1: brand of product, 2: update sau nếu phát sinh',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `name_vi` varchar(200) NOT NULL COMMENT 'tiếng việt ko dấu',
  `slug` varchar(350) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gas_gas_master_lookup`
--

INSERT INTO `gas_gas_master_lookup` (`id`, `name`, `display_order`, `type`, `status`, `name_vi`, `slug`) VALUES
(1, 'Murad 1', 5, 1, 1, 'murad 1', 'murad-1');

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_one_many_big`
--

CREATE TABLE IF NOT EXISTS `gas_gas_one_many_big` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'xử lý trường hợp 1 user dc gán cho nhiều user liên quan, vd 1 đại lý có nhiều bảo trì, kế toán,',
  `one_id` bigint(11) unsigned NOT NULL COMMENT 'xử lý trường hợp 1 user dc gán cho nhiều user liên quan, vd 1 đại lý có nhiều bảo trì, kế toán,',
  `many_id` bigint(11) unsigned NOT NULL COMMENT 'xử lý trường hợp 1 user dc gán cho nhiều user liên quan, vd 1 đại lý có nhiều bảo trì, kế toán,',
  `type` tinyint(3) unsigned NOT NULL COMMENT 'type là loại Kết Nối: 1: agent_id(one)--bảo trì id(many), 2: agent_id(one)-- Kế Toán id(many)... update sau nếu phát sinh thêm',
  PRIMARY KEY (`id`),
  KEY `one_id` (`one_id`),
  KEY `many_id` (`many_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='xử lý trường hợp 1 user dc gán cho nhiều user liên quan, vd ' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_province`
--

CREATE TABLE IF NOT EXISTS `gas_gas_province` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `short_name` varchar(150) DEFAULT NULL,
  `status` tinyint(2) unsigned DEFAULT '1',
  `slug` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `gas_gas_province`
--

INSERT INTO `gas_gas_province` (`id`, `name`, `short_name`, `status`, `slug`) VALUES
(1, 'TP Hồ Chí Minh', 'tp ho chi minh', 1, 'tp-ho-chi-minh'),
(2, 'Bình Dương', 'binh duong', 1, 'binh-duong'),
(3, 'Đồng Nai', 'dong nai', 1, 'dong-nai'),
(4, 'Long An', 'long an', 1, 'long-an'),
(5, 'Gia Lai', 'gia lai', 1, 'gia-lai'),
(6, 'Kon Tum', 'kon tum', 1, 'kon-tum'),
(7, 'Vĩnh Long', 'vinh long', 1, 'vinh-long'),
(8, 'Cần Thơ', 'can tho', 1, 'can-tho'),
(9, 'Tiền Giang', 'tien giang', 1, 'tien-giang'),
(10, 'Tây Ninh', 'tay ninh', 1, 'tay-ninh'),
(11, 'Đồng Tháp', 'dong thap', 1, 'dong-thap'),
(12, 'Trà Vinh', 'tra vinh', 1, 'tra-vinh'),
(13, 'Bến Tre', 'ben tre', 1, 'ben-tre'),
(14, 'An Giang', 'an giang', 1, 'an-giang'),
(15, 'Quảng Ngãi', 'quang ngai', 1, 'quang-ngai'),
(16, 'Kiên Giang', 'kien giang', 1, 'kien-giang'),
(17, 'Sóc Trăng', 'soc trang', 1, 'soc-trang');

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_schedule_email`
--

CREATE TABLE IF NOT EXISTS `gas_gas_schedule_email` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) DEFAULT NULL COMMENT '1: reset pass, 2: van ban alert, 3:  loai lap lich de gui',
  `email_template_id` mediumint(11) unsigned DEFAULT NULL,
  `obj_id` bigint(11) unsigned DEFAULT NULL COMMENT 'hiện tại là id văn bản, hoặc id của 1 cái gì đó chưa rõ',
  `user_id` bigint(11) unsigned DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `time_send` datetime DEFAULT NULL COMMENT 'dành cho type=3 , hiện tại chưa có dùng',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_schedule_notify`
--

CREATE TABLE IF NOT EXISTS `gas_gas_schedule_notify` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(11) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL COMMENT '1: 10'' BT su co, 2: bt dinh ky trc 1 ngay ',
  `obj_id` bigint(11) unsigned NOT NULL COMMENT ' type=1,2 thi object id la id cua Uphold... ',
  `time_send` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(100) NOT NULL,
  `title` varchar(350) DEFAULT NULL,
  `json_var` text NOT NULL COMMENT 'array variable ',
  `count_run` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'đếm số lần run notify cho record, để order',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_schedule_notify_history`
--

CREATE TABLE IF NOT EXISTS `gas_gas_schedule_notify_history` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL COMMENT '1: new, 2: view',
  `user_id` bigint(11) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL COMMENT '1: 10'' BT su co, 2: bt dinh ky trc 1 ngay ',
  `obj_id` bigint(11) unsigned NOT NULL COMMENT ' type=1,2 thi object id la id cua Uphold... ',
  `time_send` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `created_date_on_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'time created on history',
  `username` varchar(100) NOT NULL,
  `title` varchar(350) DEFAULT NULL,
  `json_var` text NOT NULL COMMENT 'array variable ',
  `count_run` int(11) unsigned NOT NULL COMMENT 'đếm số lần run notify cho record, để order',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `user_id` (`user_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_schedule_sms`
--

CREATE TABLE IF NOT EXISTS `gas_gas_schedule_sms` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `smsid` bigint(11) unsigned NOT NULL COMMENT 'id sms cua eSMS',
  `code_response` smallint(6) NOT NULL COMMENT 'cua eSMS',
  `phone` varchar(50) NOT NULL,
  `user_id` bigint(11) unsigned NOT NULL,
  `username` varchar(100) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL COMMENT '1: 10'' BT su co, 2: bt dinh ky trc 1 ngay ',
  `obj_id` bigint(11) unsigned NOT NULL COMMENT ' type=1,2 thi object id la id cua Uphold... ',
  `title` text,
  `json_var` text NOT NULL,
  `count_run` int(11) unsigned NOT NULL DEFAULT '0',
  `time_send` datetime NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_schedule_sms_history`
--

CREATE TABLE IF NOT EXISTS `gas_gas_schedule_sms_history` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `smsid` bigint(11) unsigned NOT NULL COMMENT 'id sms cua eSMS',
  `code_response` smallint(6) NOT NULL COMMENT 'cua eSMS',
  `phone` varchar(50) NOT NULL,
  `user_id` bigint(11) unsigned NOT NULL,
  `username` varchar(100) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL COMMENT '1: 10'' BT su co, 2: bt dinh ky trc 1 ngay ',
  `obj_id` bigint(11) unsigned NOT NULL COMMENT ' type=1,2 thi object id la id cua Uphold... ',
  `title` text,
  `json_var` text NOT NULL,
  `count_run` int(11) unsigned NOT NULL DEFAULT '0',
  `time_send` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `created_date_on_history` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_street`
--

CREATE TABLE IF NOT EXISTS `gas_gas_street` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `province_id` smallint(5) unsigned NOT NULL COMMENT 'mã tỉnh, đường thuộc tỉnh nào',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name_vi` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ten tieng viet khong dau',
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_id_create` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_tickets`
--

CREATE TABLE IF NOT EXISTS `gas_gas_tickets` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `code_no` varchar(30) DEFAULT NULL,
  `agent_id` bigint(11) unsigned NOT NULL COMMENT 'id đại lý nếu có',
  `uid_login` bigint(11) unsigned DEFAULT NULL COMMENT 'người tạo ticket',
  `title` varchar(250) DEFAULT NULL,
  `send_to_id` bigint(11) unsigned DEFAULT NULL COMMENT 'nghĩa là gửi cho user nào, có thể là admin gửi cho 1 user trên hệ thống,sẽ làm chức năng này sau',
  `admin_new_message` tinyint(1) DEFAULT '0' COMMENT '1: có nghĩa là message send from admin, 0 là send bt của hệ thống',
  `status` tinyint(1) DEFAULT '1' COMMENT '1: open, 2: close',
  `process_status` tinyint(1) DEFAULT '1' COMMENT 'trạng thái free của ticker: 1: new, 2: user pick, 3: finish',
  `process_time` datetime DEFAULT NULL,
  `process_user_id` bigint(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `agent_id` (`agent_id`),
  KEY `uid_login` (`uid_login`),
  KEY `send_to_id` (`send_to_id`),
  KEY `admin_new_message` (`admin_new_message`),
  KEY `status` (`status`),
  KEY `process_status` (`process_status`),
  KEY `process_user_id` (`process_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_tickets_detail`
--

CREATE TABLE IF NOT EXISTS `gas_gas_tickets_detail` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(11) unsigned DEFAULT NULL,
  `message` text,
  `uid_post` bigint(11) unsigned DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '1: sent, 2: received',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `c_name` varchar(200) DEFAULT NULL COMMENT 'Tên user tại thời điểm đóđó',
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_track_login`
--

CREATE TABLE IF NOT EXISTS `gas_gas_track_login` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid_login` bigint(11) unsigned DEFAULT NULL,
  `role_id` tinyint(2) unsigned DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL COMMENT 'empty là login, Admin Inactive User',
  `type` tinyint(2) DEFAULT '1' COMMENT '1:Login , 2:Admin Inactive',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_gas_ward`
--

CREATE TABLE IF NOT EXISTS `gas_gas_ward` (
  `id` mediumint(7) unsigned NOT NULL AUTO_INCREMENT COMMENT 'phường, xã',
  `province_id` smallint(5) unsigned NOT NULL COMMENT 'thuộc tỉnh',
  `district_id` mediumint(7) unsigned NOT NULL COMMENT 'thuộc quận huyện',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name_vi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_id_create` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_ip_logins`
--

CREATE TABLE IF NOT EXISTS `gas_ip_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_login` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_logger`
--

CREATE TABLE IF NOT EXISTS `gas_logger` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `message` text,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(250) DEFAULT NULL,
  `level` varchar(128) DEFAULT NULL,
  `logtime` int(11) DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gas_menus`
--

CREATE TABLE IF NOT EXISTS `gas_menus` (
  `id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `menu_link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `module_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `controller_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_order` smallint(3) unsigned NOT NULL,
  `show_in_menu` tinyint(3) unsigned NOT NULL,
  `place_holder_id` tinyint(3) unsigned NOT NULL,
  `application_id` tinyint(3) unsigned NOT NULL,
  `parent_id` mediumint(6) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module_name` (`module_name`),
  KEY `controller_name` (`controller_name`),
  KEY `action_name` (`action_name`),
  KEY `show_in_menu` (`show_in_menu`),
  KEY `place_holder_id` (`place_holder_id`),
  KEY `application_id` (`application_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gas_menus`
--

INSERT INTO `gas_menus` (`id`, `menu_name`, `menu_link`, `module_name`, `controller_name`, `action_name`, `display_order`, `show_in_menu`, `place_holder_id`, `application_id`, `parent_id`) VALUES
(1, 'Email Templates', 'admin/emailtemplates', 'admin', 'emailtemplates', 'index', 5, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gas_murad_banner`
--

CREATE TABLE IF NOT EXISTS `gas_murad_banner` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1:home big banner, 2 update ...',
  `name` varchar(350) DEFAULT NULL,
  `description` text,
  `file_name` varchar(350) DEFAULT NULL,
  `link` text,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `order_display` tinyint(1) unsigned DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `gas_murad_banner`
--

INSERT INTO `gas_murad_banner` (`id`, `type`, `name`, `description`, `file_name`, `link`, `status`, `order_display`, `created_date`) VALUES
(1, 1, '123', '', '', '', 1, NULL, '2016-02-17 16:27:44'),
(2, 1, '123', '', '1456241001-0-easyrates-pakage-eligibility.jpg', '', 1, 1, '2016-02-17 16:27:55'),
(3, 1, '123', '', '1456241017-0-screenshot-from-2015-12-21-11-00-32.png', '', 1, 1, '2016-02-17 16:28:02'),
(6, 1, '123', '34', '1455761574-0-easyrates-pakage-rate.jpg', 'http://localhost/muradvn/admin/muradBanner/update/id/6', 1, 20, '2016-02-17 16:34:22'),
(7, 1, '11', '111', '1456240982-0-screenshot-from-2015-12-21-11-01-21.png', '', 1, 1, '2016-02-23 15:21:30'),
(8, 1, '11', '111', '1456240972-0-easyrates-pakage-rate.jpg', '', 1, 1, '2016-02-23 15:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `gas_murad_category`
--

CREATE TABLE IF NOT EXISTS `gas_murad_category` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(350) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `category_type` tinyint(1) unsigned DEFAULT NULL COMMENT '1: product, 2: news, 3: video',
  `type` tinyint(1) unsigned DEFAULT NULL COMMENT '1: mun, 2: nam & lao hoa, 3: Cellulite, 4: Van de da khac',
  `name_vi` varchar(350) DEFAULT NULL,
  `slug` varchar(450) DEFAULT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `gas_murad_category`
--

INSERT INTO `gas_murad_category` (`id`, `name`, `status`, `category_type`, `type`, `name_vi`, `slug`, `meta_keywords`, `meta_description`) VALUES
(1, 'Da Lão Hóa Do Nội Tiết', 1, 1, 2, 'Da Lao Hoa Do Noi Tiet', 'da-lao-hoa-do-noi-tiet', 'Hai đường bị cấm dừng xe sau tin nhắn gửi ông Đinh La Thăng', 'Hai đường bị cấm dừng xe sau tin nhắn gửi ông Đinh La Thăng'),
(2, 'Mụn Tổng Thể', 1, 1, 1, 'Mun Tong The', 'mun-tong-the', '111', '222'),
(3, 'Da Lão Hóa Do Di Truyền: Nếp Nhăn & Chân Chim', 1, 1, 2, 'Da Lao Hoa Do Di Truyen: Nep Nhan & Chan Chim', 'da-lao-hoa-do-di-truyen-nep-nhan-chan-chim', 'Da Lão Hóa Do Di Truyền: Nếp Nhăn & Chân Chim', 'Da Lão Hóa Do Di Truyền: Nếp Nhăn & Chân Chim'),
(4, 'Nám & Lão Hóa Do Môi Trường', 1, 1, 2, 'Nam & Lao Hoa Do Moi Truong', 'nam-lao-hoa-do-moi-truong', '', ''),
(5, 'Cellulite và Rạn Nứt Da', 1, 1, 3, 'Cellulite va Ran Nut Da', 'cellulite-va-ran-nut-da', '', ''),
(6, 'Da Hỗn Hợp / Mụn Cám', 1, 1, 4, 'Da Hon Hop / Mun Cam', 'da-hon-hop-mun-cam', '', ''),
(7, 'Da nhạy cảm / Tấy Đỏ', 1, 1, 4, 'Da nhay cam / Tay Do', 'da-nhay-cam-tay-do', '', ''),
(8, 'Hệ Thống Chống Nắng', 1, 1, 4, 'He Thong Chong Nang', 'he-thong-chong-nang', '', ''),
(9, 'Tin tức chung', 1, 2, NULL, 'Tin tuc chung', 'tin-tuc-chung', '', ''),
(10, 'Video 1', 1, 3, NULL, 'Video 1', 'video-1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `gas_murad_news`
--

CREATE TABLE IF NOT EXISTS `gas_murad_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(350) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `category_id` smallint(3) unsigned DEFAULT NULL,
  `feature_image` varchar(350) DEFAULT NULL,
  `name_vi` varchar(350) DEFAULT NULL,
  `slug` varchar(450) DEFAULT NULL,
  `content` text,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gas_murad_news`
--

INSERT INTO `gas_murad_news` (`id`, `name`, `status`, `category_id`, `feature_image`, `name_vi`, `slug`, `content`, `created_date`) VALUES
(1, 'TẠO MỚI TIN TỨC', 1, 9, '0', 'TAO MOI TIN TUC', 'tao-moi-tin-tuc', 'TẠO MỚI TIN TỨC', '2016-02-23 15:13:05'),
(2, 'fsdf', 1, 9, '255', 'fsdf', 'fsdf', '', '2016-02-23 15:27:25'),
(3, '3333', 1, 9, '1456243388-0-easyrates-pakage-type.jpg', '3333', '3333', '<br>', '2016-02-23 15:31:04'),
(4, '3333', 1, 9, '1456242111-0-screenshot-from-2016-02-07-22-00-43.png', '3333', '3333-2', '<div class="relative_new">\r\n                <h2><ul class="list_news_dot_3x3_300"><li><a tabindex="1" href="http://vnexpress.net/tin-tuc/thoi-su/ong-hoang-trung-hai-nham-chuc-bi-thu-ha-noi-3353215.html"><b>Ông Hoà<font face="trebuchet ms">ng Trung Hải nhậm chức Bí thư Hà Nội</font></b></a></li></ul></h2><ul class="list_news_dot_3x3_300">\r\n                <li><b>sdfd</b></li><li><b>sfds</b></li><li><b>ff</b></li><li><b><u>sdf</u></b></li><li><b><u>dsf</u></b></li><li><b><u>sdf</u></b></li><li><b><u>sd</u></b></li><li><b><u>sdf</u></b></li><li><u>sdf</u></li><li><u>sdf</u></li><li>sdf</li><li>sdf22 2233</li><li>3</li><li>3</li><li>4</li></ul><div>4</div><div>54</div><div>5</div><ul class="list_news_dot_3x3_300"><li>fsdfsd</li>                </ul>\r\n                </div>', '2016-02-23 15:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `gas_murad_product`
--

CREATE TABLE IF NOT EXISTS `gas_murad_product` (
  `id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `code_real` varchar(100) DEFAULT NULL,
  `category_id` smallint(3) unsigned DEFAULT NULL,
  `name` varchar(350) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `type` tinyint(1) unsigned DEFAULT NULL COMMENT '1: Sữa rửa mặt, 2: Điều trị, 3: Kem dưỡng, chống nắng',
  `price_retail` decimal(16,2) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL COMMENT 'đơn vị:chai, lọ, cái',
  `unit_use` varchar(50) DEFAULT NULL COMMENT 'đơn vị sử dụng: l, ml, gram...',
  `size` varchar(50) DEFAULT NULL COMMENT '1 chai bao nhiêu ml:vd 200ml',
  `name_vi` varchar(350) DEFAULT NULL,
  `slug` varchar(450) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `status` (`status`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gas_murad_product`
--

INSERT INTO `gas_murad_product` (`id`, `code_real`, `category_id`, `name`, `status`, `type`, `price_retail`, `unit`, `unit_use`, `size`, `name_vi`, `slug`, `short_description`, `description`, `created_date`) VALUES
(1, '123456', 4, '11', 1, 3, 1500000.00, 'chai', 'gram', '500', '11', '11', 'Hậu thuẫn các phe đối nghịch tại Syria và liên tục đưa ra những lời cảnh báo mạnh mẽ, Nga và Thổ Nhĩ Kỳ đang đứng trước nguy đối đầu trực diện.\r\n\r\nđang đứng trước nguy đối đầu tr\r\nđang đứng trước nguy đối đầu tr', 'Hậu thuẫn các phe đối nghịch tại Syria và liên tục đưa ra những lời cảnh báo mạnh mẽ, Nga và Thổ Nhĩ Kỳ đang đứng trước nguy đối đầu trực diện.\r\nđang đứng trước nguy đối đầu tr\r\nđang đứng trước nguy đối đầu tr', '2016-02-18 16:27:33'),
(2, '4567547', 3, 'TẠO MỚI PRODUCTS', 1, 1, 987785415.00, 'cai', 'ml', '6500', 'TAO MOI PRODUCTS', 'tao-moi-products', 'g tạo ra một "quả bom trực chờ phát nổ", trong chuỗ', 'g tạo ra một "quả bom trực chờ phát nổ", trong chuỗ', '2016-02-18 17:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `gas_murad_product_image`
--

CREATE TABLE IF NOT EXISTS `gas_murad_product_image` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned DEFAULT NULL,
  `product_id` mediumint(11) unsigned DEFAULT NULL,
  `file_name` varchar(350) DEFAULT NULL,
  `order_number` tinyint(1) unsigned DEFAULT NULL COMMENT 'số thứ tự',
  `created_date` date DEFAULT NULL COMMENT 'sẽ lấy theo ngày tạo của root record, vì liên quan đến phần lưu và xóa file',
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`type`),
  KEY `order_number` (`order_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `gas_murad_product_image`
--

INSERT INTO `gas_murad_product_image` (`id`, `type`, `product_id`, `file_name`, `order_number`, `created_date`) VALUES
(3, NULL, 1, '1455814143-0-screenshot-from-2016-02-07-22-00-43.png', 6, '2016-02-18'),
(4, NULL, 1, '1455814202-0-screenshot-from-2015-03-19-14-11-04.png', 5, '2016-02-18'),
(5, NULL, 2, '1455815688-0-paypal-2015-01-14-09-02-38.png', 1, '2016-02-19'),
(6, NULL, 2, '1455815689-1-bien-hoa-dong-nai.png', 2, '2016-02-19');

-- --------------------------------------------------------

--
-- Table structure for table `gas_murad_video`
--

CREATE TABLE IF NOT EXISTS `gas_murad_video` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` smallint(3) unsigned DEFAULT NULL,
  `type` tinyint(1) unsigned DEFAULT NULL COMMENT '1: video, 2: audio',
  `name` varchar(350) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `is_feature` tinyint(1) unsigned DEFAULT NULL,
  `name_vi` varchar(350) DEFAULT NULL,
  `slug` varchar(450) DEFAULT NULL,
  `link` text,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `type` (`type`),
  KEY `status` (`status`),
  KEY `is_feature` (`is_feature`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gas_murad_video`
--

INSERT INTO `gas_murad_video` (`id`, `category_id`, `type`, `name`, `status`, `is_feature`, `name_vi`, `slug`, `link`, `created_date`) VALUES
(1, 10, 1, 'TẠO MỚI VIDEO + AUDIO', 1, 1, 'TAO MOI VIDEO + AUDIO', 'tao-moi-video-audio', 'TẠO MỚI VIDEO + AUDIO', '2016-02-23 16:14:15'),
(2, 10, 2, '222 22 ', 0, 0, '222 22', '222-22', '', '2016-02-23 16:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `gas_roles`
--

CREATE TABLE IF NOT EXISTS `gas_roles` (
  `id` smallint(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role_short_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `application_id` tinyint(11) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gas_roles`
--

INSERT INTO `gas_roles` (`id`, `role_name`, `role_short_name`, `application_id`, `status`) VALUES
(2, 'Administrator', 'Administrator', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gas_seo`
--

CREATE TABLE IF NOT EXISTS `gas_seo` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `sample_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `variable` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `default_page_name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `keyword` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `gas_seo`
--

INSERT INTO `gas_seo` (`id`, `module`, `controller`, `action`, `title`, `sample_link`, `page_name`, `variable`, `default_page_name`, `keyword`, `description`) VALUES
(1, 'front_end', 'search', 'listcat', '{JOB_CATEGORY_NAME} Smiles Recruitment Singapore {JOB_CATEGORY_NAME}', 'http://verzview.com/verzsr/demo/job-category/flexible-time', 'Search category ', '{JOB_CATEGORY_NAME}: name of category', '', 'Smiles Recruitment Singapore ', 'Smiles Recruitment Singapore '),
(14, 'front_end', 'search', 'QuickSearch', '{NAME_SEARCH} ccds', 'http://localhost/ccds/search/QuickSearch?search_type=company&search_text=a', 'Search company', '{NAME_SEARCH}', '', 'ccds/search', 'ccds/search'),
(15, 'front_end', 'search', 'CompanyDetail', '{NAME_COMPANY} ccds', 'http://localhost/ccds/search/CompanyDetail?slug=test-slug-c', 'View Company Detail', '{NAME_COMPANY}', '', 'View Company Detail ccds', 'View Company Detail ccds');

-- --------------------------------------------------------

--
-- Table structure for table `gas_settings`
--

CREATE TABLE IF NOT EXISTS `gas_settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `gas_settings`
--

INSERT INTO `gas_settings` (`id`, `updated`, `key`, `value`) VALUES
(1, '2014-08-17 17:44:56', 'transportType', 's:4:"smtp";'),
(2, '2013-01-02 19:13:27', 'smtpHost', 's:14:"smtp.gmail.com";'),
(3, '2014-08-16 19:57:15', 'smtpUsername', 's:21:"nkhuongminh@gmail.com";'),
(4, '2014-08-16 19:57:15', 'smtpPassword', 's:15:"!%456!!19*&CaRe";'),
(5, '2012-01-31 22:01:43', 'smtpPort', 's:3:"465";'),
(6, '2012-07-03 02:29:14', 'encryption', 's:3:"ssl";'),
(7, '2014-08-16 20:12:05', 'adminEmail', 's:27:"webmaster@daukhimiennam.com";'),
(17, '2014-11-02 23:35:01', 'meta_description', 's:13:"Hướng Minh";'),
(18, '2014-11-02 23:35:01', 'meta_keywords', 's:13:"Hướng Minh";'),
(19, '2013-12-30 18:49:28', 'title', 's:16:"Hướng Minh | ";'),
(20, '2014-03-08 19:00:01', 'last_working', 's:19:"2014-03-09 09:00:01";'),
(21, '2014-08-16 20:12:05', 'autoEmail', 's:29:"auto_mailer@daukhimiennam.com";'),
(32, '2012-06-13 03:52:30', 'image_watermark', 's:21:"bg_13395847462753.gif";'),
(33, '2014-09-28 23:57:58', 'login_limit_times', 's:1:"5";'),
(34, '2012-10-07 20:44:28', 'time_refresh_login', 's:1:"8";'),
(35, '2014-08-16 19:48:01', 'title_all_mail', 's:17:"daukhimiennam.com";'),
(40, '2013-04-15 00:28:39', 'server_name', 's:25:"http://localhost/yii_core";'),
(41, '2013-07-13 07:03:53', 'note_type_pay', 's:411:"<em>\r\nGiá trị để nhập cho ô quy định ngày thanh toán bên dưới<br/>\r\nLoai 1: 1,2,3...100...<br/>\r\nLoai 2: chỉ nhận các giá trị 2,3,4,5,6,7 (tương ứng với các ngày trong tuần)<br/>\r\nLoai 3: là chuỗi 1-15-25-0: từ ngày 1 đến ngày 15, thanh toán vào ngày 25, số cuối cùng có giá trị 0 là trong tháng, 1 là tháng sau. <br/>\r\nLoai 4:để trống\r\n\r\n</em>";'),
(42, '2014-05-12 22:23:08', 'enable_limit_customer_of_agent', 'N;'),
(43, '2013-12-18 21:28:24', 'limit_update_maintain', 's:1:"1";'),
(44, '2014-01-31 18:48:14', 'can_update_customer_maintain', 's:2:"no";'),
(45, '2014-12-25 05:40:18', 'server_maintenance', 's:2:"no";'),
(46, '2014-12-25 05:37:56', 'server_maintenance_message', 's:124:"Hệ thống tạm thời bảo trì.\r\nThời gian bảo trì: Từ  19:30 ngày 25-12-2014  đến 20:00  ngày 25-12-2014.";'),
(47, '2014-03-04 06:14:19', 'time_disable_login', 's:0:"";'),
(48, '2016-01-24 09:21:20', 'allow_session_menu', 's:2:"no";'),
(49, '2014-09-28 06:03:43', 'show_popup_news', 'N;'),
(50, '2014-12-14 23:20:59', 'delete_global_days', 's:3:"200";'),
(51, '2015-04-06 09:20:23', 'storecard_admin_update', 's:4:"2000";'),
(52, '2014-11-13 01:02:08', 'storecard_admin_delete', 's:3:"200";'),
(53, '2014-06-13 22:01:19', 'storecard_agent_updateCollectionCustomer', 's:2:"60";'),
(54, '2014-06-13 22:30:33', 'gas_remain_admin_delete', 'N;'),
(55, '2015-09-02 03:20:42', 'gas_remain_agent_update', 'N;'),
(56, '2014-07-07 18:36:44', 'gas_remain_agent_update_remain2_3', 's:1:"5";'),
(57, '2014-12-14 19:07:38', 'PTTT_update_file_scan', 's:3:"200";'),
(58, '2014-06-30 20:32:29', 'PTTT_SELL_update_file_scan', 's:1:"1";'),
(59, '2014-11-18 06:03:48', 'days_update_bussiness_contract', 's:1:"1";'),
(60, '2014-08-03 08:44:55', 'month_limit_search_pttt', 's:1:"3";'),
(61, '2014-08-10 01:31:13', 'limit_post_ticket', 's:3:"200";'),
(62, '2014-08-10 01:29:34', 'ticket_page_size', 's:2:"50";'),
(63, '2014-12-26 18:06:41', 'cookie_days', 's:2:"30";'),
(64, '2014-12-18 03:53:31', 'days_keep_track_login', 's:3:"100";'),
(65, '2014-12-05 18:19:57', 'days_update_text_file', 's:1:"5";'),
(66, '2014-12-19 17:42:50', 'days_update_profile_scan', 's:2:"10";'),
(67, '2014-09-05 19:45:16', 'days_update_manage_tool', 's:1:"5";'),
(68, '2015-02-25 07:59:51', 'enable_delete', 's:3:"yes";'),
(69, '2014-11-10 00:12:54', 'days_update_leave', 's:1:"1";'),
(70, '2014-11-10 00:12:54', 'days_update_meeting_minutes', 's:1:"1";'),
(71, '2014-11-10 23:40:32', 'days_update_maintain_sell', 's:1:"2";'),
(72, '2014-11-17 07:03:25', 'days_update_guide_help', 's:1:"1";'),
(73, '2014-11-18 04:10:36', 'month_limit_update_thuong_luong', 's:1:"3";'),
(74, '2015-04-20 01:23:50', 'days_update_customer_check', 's:3:"200";'),
(75, '2014-11-23 19:00:49', 'days_update_customer_check_report', 's:2:"30";'),
(76, '2014-12-29 00:10:24', 'allow_admin_login', 's:3:"yes";'),
(77, '2014-11-30 23:21:22', 'profile_day_alert_expiry', 's:3:"100";'),
(78, '2014-12-26 18:27:06', 'allow_use_admin_cookie', 's:2:"no";'),
(79, '2014-12-14 05:51:10', 'days_update_break_task', 's:2:"30";'),
(80, '2014-12-20 18:37:26', 'month_update_first_purchase', 's:1:"1";'),
(81, '2015-09-15 09:20:32', 'days_update_support_customer', 's:3:"200";'),
(82, '2015-09-02 03:20:42', 'month_statistic_output_customer', 's:1:"6";'),
(83, '2015-02-25 07:59:51', 'check_login_same_account', 's:3:"yes";'),
(84, '2015-02-25 07:59:51', 'days_update_customer_bo_moi', 's:0:"";'),
(85, '2015-04-06 09:20:12', 'days_update_PTTT_daily_goback', 's:0:"";'),
(86, '2015-04-20 01:23:50', 'max_van_ban_create_in_day', 's:0:"";'),
(87, '2015-09-02 03:20:42', 'days_update_support_customer_to_print', 's:1:"2";'),
(88, '2015-11-13 02:47:39', 'days_update_uphold', 's:0:"";'),
(89, '2015-11-13 02:47:39', 'days_update_support_agent', 's:0:"";'),
(90, '2015-11-13 02:47:39', 'days_update_order_promotion', 's:1:"1";');

-- --------------------------------------------------------

--
-- Table structure for table `gas_users`
--

CREATE TABLE IF NOT EXISTS `gas_users` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `temp_password` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(150) DEFAULT NULL,
  `last_name` varchar(2) NOT NULL DEFAULT '0',
  `name_agent` varchar(10) DEFAULT NULL,
  `province_id` smallint(5) unsigned DEFAULT NULL,
  `channel_id` smallint(5) unsigned DEFAULT NULL,
  `district_id` mediumint(5) unsigned DEFAULT NULL,
  `ward_id` mediumint(7) unsigned NOT NULL,
  `street_id` mediumint(7) unsigned NOT NULL,
  `storehouse_id` mediumint(10) unsigned DEFAULT NULL,
  `sale_id` bigint(11) unsigned DEFAULT NULL,
  `code_bussiness` varchar(30) DEFAULT NULL,
  `code_account` varchar(30) DEFAULT NULL,
  `payment_day` smallint(3) unsigned DEFAULT NULL,
  `house_numbers` varchar(150) NOT NULL,
  `beginning` decimal(14,2) unsigned DEFAULT NULL,
  `first_char` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `login_attemp` tinyint(3) unsigned DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_logged_in` datetime DEFAULT NULL,
  `ip_address` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role_id` tinyint(3) unsigned NOT NULL,
  `application_id` tinyint(3) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `gender` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify_code` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_code_id` int(11) unsigned DEFAULT '0',
  `parent_id` bigint(11) unsigned DEFAULT '0',
  `slug` varchar(300) DEFAULT NULL,
  `is_maintain` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `address_temp` varchar(500) NOT NULL,
  `last_purchase` date DEFAULT NULL,
  `created_by` bigint(11) DEFAULT NULL,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `address_vi` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `name_agent` (`name_agent`),
  KEY `code_account` (`code_account`),
  KEY `code_bussiness` (`code_bussiness`),
  KEY `address_vi` (`address_vi`(255)),
  KEY `province_id` (`province_id`),
  KEY `district_id` (`district_id`),
  KEY `ward_id` (`ward_id`),
  KEY `street_id` (`street_id`),
  KEY `sale_id` (`sale_id`),
  KEY `first_char` (`first_char`),
  KEY `role_id` (`role_id`),
  KEY `application_id` (`application_id`),
  KEY `status` (`status`),
  KEY `gender` (`gender`),
  KEY `phone` (`phone`),
  KEY `area_code_id` (`area_code_id`),
  KEY `parent_id` (`parent_id`),
  KEY `is_maintain` (`is_maintain`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gas_users`
--

INSERT INTO `gas_users` (`id`, `username`, `temp_password`, `password_hash`, `first_name`, `last_name`, `name_agent`, `province_id`, `channel_id`, `district_id`, `ward_id`, `street_id`, `storehouse_id`, `sale_id`, `code_bussiness`, `code_account`, `payment_day`, `house_numbers`, `beginning`, `first_char`, `login_attemp`, `created_date`, `last_logged_in`, `ip_address`, `role_id`, `application_id`, `status`, `gender`, `phone`, `verify_code`, `area_code_id`, `parent_id`, `slug`, `is_maintain`, `type`, `address_temp`, `last_purchase`, `created_by`, `email`, `address`, `address_vi`) VALUES
(2, 'muradvn', '123123', '4297f44b13955235245b2497399d7a93', 'admin', '0', 'admin', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, '', NULL, '', 0, '2012-06-18 17:00:00', '2016-02-23 21:00:17', '::1', 2, 1, 1, '', '0909999999', 'cdae70771709ed2329cd7dc85d9d80d0', 0, 0, NULL, 0, 0, '', NULL, NULL, 'ngockien12312@yahoo.com', '', 'admin 0909999999');

-- --------------------------------------------------------

--
-- Table structure for table `gas_users_ref`
--

CREATE TABLE IF NOT EXISTS `gas_users_ref` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(11) unsigned NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: dung cho kh khong lay hang, 2: dung cho image chu ky cua user ...',
  `image_sign` varchar(100) DEFAULT NULL COMMENT 'ảnh chứ ký của user',
  `reason_leave` text COMMENT 'lý do không lấy hàng',
  `contact_person` text COMMENT 'type =1, tên người liên hệ KH bò mối',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
