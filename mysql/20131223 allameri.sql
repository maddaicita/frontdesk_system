-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Dec 23, 2013 at 10:28 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `allameri`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `contacts`
-- 

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL auto_increment,
  `contact_first` varchar(255) character set latin1 default NULL,
  `contact_last` varchar(255) character set latin1 default NULL,
  `contact_email` varchar(255) character set latin1 default NULL,
  PRIMARY KEY  (`contact_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `contacts`
-- 

INSERT INTO `contacts` VALUES (1, 'Jim', 'Smith', 'jim@tester.com');
INSERT INTO `contacts` VALUES (2, 'Joe', 'Tester', 'joe@tester.com');

-- --------------------------------------------------------

-- 
-- Table structure for table `locations`
-- 

CREATE TABLE `locations` (
  `loc_id` smallint(3) NOT NULL auto_increment,
  `location` varchar(60) collate utf8_unicode_ci NOT NULL,
  `address` varchar(80) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`loc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `locations`
-- 

INSERT INTO `locations` VALUES (1, 'Design Place', '5175 NE 2nd court - Miami, Florida 33137');
INSERT INTO `locations` VALUES (2, 'Cynergi', '2700 N. Miami Avenue. Suite 208 Miami, FL 33127');
INSERT INTO `locations` VALUES (3, 'All American Office', '3043 NW 7th Street, Miami FL 33125');
INSERT INTO `locations` VALUES (4, ' No defined', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `locations_shifts`
-- 

CREATE TABLE `locations_shifts` (
  `shift_id` smallint(3) unsigned NOT NULL auto_increment,
  `shift_time` varchar(14) collate utf8_unicode_ci NOT NULL,
  `loc_id` smallint(3) unsigned NOT NULL,
  `users_id` smallint(3) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`shift_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `locations_shifts`
-- 

INSERT INTO `locations_shifts` VALUES (1, '07:00 to 15:00', 1, 1, 1);
INSERT INTO `locations_shifts` VALUES (2, '15:00 to 23:00', 1, 1, 1);
INSERT INTO `locations_shifts` VALUES (3, '23:00 to 07:00', 1, 1, 1);
INSERT INTO `locations_shifts` VALUES (4, '08:00 to 16:00', 3, 1, 1);
INSERT INTO `locations_shifts` VALUES (5, '22:00 to 06:00', 2, 1, 1);
INSERT INTO `locations_shifts` VALUES (6, '06:00 to 22:00', 2, 1, 1);
INSERT INTO `locations_shifts` VALUES (7, '06:00 to 14:00', 2, 1, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `positions`
-- 

CREATE TABLE `positions` (
  `position_id` tinyint(1) unsigned NOT NULL auto_increment,
  `position` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`position_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `positions`
-- 

INSERT INTO `positions` VALUES (1, 'Security Officer');
INSERT INTO `positions` VALUES (2, 'Supervisor');
INSERT INTO `positions` VALUES (3, 'District Manager');
INSERT INTO `positions` VALUES (4, 'Office Staff');
INSERT INTO `positions` VALUES (5, ' ');

-- --------------------------------------------------------

-- 
-- Table structure for table `schedule`
-- 

CREATE TABLE `schedule` (
  `sch_id` int(8) unsigned NOT NULL auto_increment,
  `users_id` smallint(6) unsigned NOT NULL,
  `shift_id` smallint(6) unsigned NOT NULL,
  `sch_date` date NOT NULL,
  `week` tinyint(2) unsigned NOT NULL,
  `shc_set` datetime NOT NULL,
  `admin_id` smallint(6) NOT NULL,
  PRIMARY KEY  (`sch_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='schedule table' AUTO_INCREMENT=23 ;

-- 
-- Dumping data for table `schedule`
-- 

INSERT INTO `schedule` VALUES (1, 1, 1, '2013-11-15', 46, '2013-11-15 11:13:40', 1);
INSERT INTO `schedule` VALUES (2, 1, 4, '2013-11-18', 47, '2013-11-15 11:45:03', 1);
INSERT INTO `schedule` VALUES (3, 1, 4, '2013-11-25', 48, '2013-11-15 11:47:06', 1);
INSERT INTO `schedule` VALUES (4, 1, 4, '2013-11-19', 47, '2013-11-19 12:08:27', 1);
INSERT INTO `schedule` VALUES (5, 1, 3, '2013-11-20', 47, '2013-11-19 12:23:36', 1);
INSERT INTO `schedule` VALUES (6, 27, 5, '2013-12-18', 51, '2013-12-18 13:12:20', 1);
INSERT INTO `schedule` VALUES (7, 27, 5, '2013-12-19', 51, '2013-12-18 13:12:58', 1);
INSERT INTO `schedule` VALUES (8, 27, 5, '2013-12-20', 51, '2013-12-18 13:13:14', 1);
INSERT INTO `schedule` VALUES (9, 27, 5, '2013-12-02', 49, '2013-12-18 13:15:11', 1);
INSERT INTO `schedule` VALUES (10, 27, 5, '2013-12-03', 49, '2013-12-18 13:15:44', 1);
INSERT INTO `schedule` VALUES (11, 27, 5, '2013-12-04', 49, '2013-12-18 13:15:59', 1);
INSERT INTO `schedule` VALUES (12, 27, 5, '2013-12-05', 49, '2013-12-18 13:16:13', 1);
INSERT INTO `schedule` VALUES (13, 27, 5, '2013-12-06', 49, '2013-12-18 13:16:28', 1);
INSERT INTO `schedule` VALUES (14, 28, 6, '2013-12-01', 48, '2013-12-23 09:42:17', 1);
INSERT INTO `schedule` VALUES (15, 28, 6, '2013-12-02', 49, '2013-12-23 09:48:31', 1);
INSERT INTO `schedule` VALUES (16, 28, 6, '2013-12-03', 49, '2013-12-23 09:48:56', 1);
INSERT INTO `schedule` VALUES (17, 28, 6, '2013-12-07', 49, '2013-12-23 09:49:32', 1);
INSERT INTO `schedule` VALUES (18, 28, 6, '2013-12-08', 49, '2013-12-23 09:49:52', 1);
INSERT INTO `schedule` VALUES (19, 28, 6, '2013-12-09', 50, '2013-12-23 09:52:11', 1);
INSERT INTO `schedule` VALUES (20, 28, 6, '2013-12-10', 50, '2013-12-23 09:52:32', 1);
INSERT INTO `schedule` VALUES (21, 28, 7, '2013-12-14', 50, '2013-12-23 10:21:48', 1);
INSERT INTO `schedule` VALUES (22, 28, 6, '2013-12-15', 50, '2013-12-23 10:24:35', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_admins`
-- 

CREATE TABLE `tbl_admins` (
  `users_id` tinyint(2) unsigned NOT NULL auto_increment,
  `first_name` varchar(20) collate utf8_unicode_ci NOT NULL,
  `middle_name` varchar(20) collate utf8_unicode_ci default NULL,
  `last_name` varchar(20) collate utf8_unicode_ci NOT NULL,
  `username` varchar(20) collate utf8_unicode_ci NOT NULL,
  `password` varchar(20) collate utf8_unicode_ci NOT NULL,
  `user_admin` tinyint(1) unsigned NOT NULL default '1',
  `active` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`users_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='admins table' AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `tbl_admins`
-- 

INSERT INTO `tbl_admins` VALUES (1, 'Luis', 'V', 'Leon', 'lleon', 'targus25', 1, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_cities`
-- 

CREATE TABLE `tbl_cities` (
  `city_id` smallint(3) NOT NULL auto_increment,
  `city` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`city_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `tbl_cities`
-- 

INSERT INTO `tbl_cities` VALUES (1, 'Miami');
INSERT INTO `tbl_cities` VALUES (2, 'Miami Beach');
INSERT INTO `tbl_cities` VALUES (3, 'Hialeah');
INSERT INTO `tbl_cities` VALUES (4, 'Doral');
INSERT INTO `tbl_cities` VALUES (5, 'Miami Gardens');
INSERT INTO `tbl_cities` VALUES (6, 'Miramar');
INSERT INTO `tbl_cities` VALUES (7, 'North Miami');
INSERT INTO `tbl_cities` VALUES (8, 'Fort Lauderdale');
INSERT INTO `tbl_cities` VALUES (9, 'OpaLocka');
INSERT INTO `tbl_cities` VALUES (10, 'North Miami Beach');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_fingerprint`
-- 

CREATE TABLE `tbl_fingerprint` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `id_loc` varchar(40) collate utf8_unicode_ci NOT NULL,
  `names` varchar(100) collate utf8_unicode_ci NOT NULL,
  `id_emp` smallint(4) unsigned NOT NULL,
  `date_finger` datetime NOT NULL,
  `date_import` date NOT NULL,
  `user_id` smallint(3) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

-- 
-- Dumping data for table `tbl_fingerprint`
-- 

INSERT INTO `tbl_fingerprint` VALUES (1, '2', 'Raul Velazquez', 100, '2013-12-01 06:36:17', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (2, '2', 'Raul Velazquez', 100, '2013-12-01 22:13:17', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (3, '2', 'Raul Velazquez', 100, '2013-12-02 06:05:32', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (4, '2', 'Raul Velazquez', 100, '2013-12-02 21:58:42', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (5, '2', 'Raul Velazquez', 100, '2013-12-03 06:01:24', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (6, '2', 'Raul Velazquez', 100, '2013-12-07 05:52:12', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (7, '2', 'Raul Velazquez', 100, '2013-12-07 14:07:37', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (8, '2', 'Raul Velazquez', 100, '2013-12-08 05:53:15', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (9, '2', 'Raul Velazquez', 100, '2013-12-08 22:01:15', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (10, '2', 'Raul Velazquez', 100, '2013-12-09 05:58:12', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (11, '2', 'Raul Velazquez', 100, '2013-12-10 00:35:00', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (12, '2', 'Raul Velazquez', 100, '2013-12-10 08:34:48', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (13, '2', 'Raul Velazquez', 100, '2013-12-10 21:58:36', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (14, '2', 'Raul Velazquez', 100, '2013-12-14 05:55:45', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (15, '2', 'Raul Velazquez', 100, '2013-12-14 14:03:59', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (16, '2', 'Raul Velazquez', 100, '2013-12-15 05:53:16', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (17, '2', 'Raul Velazquez', 100, '2013-12-15 22:24:53', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (18, '2', 'Raul Velazquez', 100, '2013-12-16 05:55:56', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (19, '2', 'Jan Zavala', 101, '2013-12-02 21:58:46', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (20, '2', 'Jan Zavala', 101, '2013-12-03 06:01:27', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (21, '2', 'Jan Zavala', 101, '2013-12-03 22:42:46', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (22, '2', 'Jan Zavala', 101, '2013-12-04 05:57:18', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (23, '2', 'Jan Zavala', 101, '2013-12-04 05:57:19', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (24, '2', 'Jan Zavala', 101, '2013-12-04 21:53:23', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (25, '2', 'Jan Zavala', 101, '2013-12-05 06:00:58', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (26, '2', 'Jan Zavala', 101, '2013-12-05 21:55:17', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (27, '2', 'Jan Zavala', 101, '2013-12-06 05:56:43', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (28, '2', 'Jan Zavala', 101, '2013-12-06 22:00:09', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (29, '2', 'Jan Zavala', 101, '2013-12-10 21:53:30', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (30, '2', 'Jan Zavala', 101, '2013-12-11 22:11:03', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (31, '2', 'Jan Zavala', 101, '2013-12-12 06:02:15', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (32, '2', 'Jan Zavala', 101, '2013-12-12 22:11:14', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (33, '2', 'Jan Zavala', 101, '2013-12-13 06:00:53', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (34, '2', 'Jan Zavala', 101, '2013-12-13 21:59:46', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (35, '2', 'Jan Zavala', 101, '2013-12-14 05:55:07', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (36, '2', 'Sean Oliver', 102, '2013-12-04 05:57:03', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (37, '2', 'Sean Oliver', 102, '2013-12-04 21:55:23', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (38, '2', 'Sean Oliver', 102, '2013-12-05 06:01:29', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (39, '2', 'Sean Oliver', 102, '2013-12-05 21:55:12', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (40, '2', 'Sean Oliver', 102, '2013-12-10 00:35:05', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (41, '2', 'Sean Oliver', 102, '2013-12-10 08:34:55', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (42, '2', 'Sean Oliver', 102, '2013-12-11 22:11:11', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (43, '2', 'Sean Oliver', 102, '2013-12-13 06:18:50', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (44, '2', 'Roy Cordova', 105, '2013-12-01 22:03:33', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (45, '2', 'Roy Cordova', 105, '2013-12-07 13:59:28', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (46, '2', 'Roy Cordova', 105, '2013-12-07 22:22:44', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (47, '2', 'Roy Cordova', 105, '2013-12-08 21:56:02', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (48, '2', 'Roy Cordova', 105, '2013-12-09 05:58:09', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (49, '2', 'Roy Cordova', 105, '2013-12-13 14:04:56', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (50, '2', 'Roy Cordova', 105, '2013-12-13 21:59:10', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (51, '2', 'Roy Cordova', 105, '2013-12-14 14:03:56', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (52, '2', 'Roy Cordova', 105, '2013-12-14 21:57:59', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (53, '2', 'Roy Cordova', 105, '2013-12-15 21:54:02', '2013-12-18', 1, 0);
INSERT INTO `tbl_fingerprint` VALUES (54, '2', 'Roy Cordova', 105, '2013-12-16 05:58:58', '2013-12-18', 1, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_fingerprint_status`
-- 

CREATE TABLE `tbl_fingerprint_status` (
  `id` int(1) unsigned NOT NULL auto_increment,
  `label` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `tbl_fingerprint_status`
-- 

INSERT INTO `tbl_fingerprint_status` VALUES (0, 'Pending');
INSERT INTO `tbl_fingerprint_status` VALUES (1, 'OK');
INSERT INTO `tbl_fingerprint_status` VALUES (3, 'Late');
INSERT INTO `tbl_fingerprint_status` VALUES (2, 'Early');
INSERT INTO `tbl_fingerprint_status` VALUES (4, 'Needs review');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_hours`
-- 

CREATE TABLE `tbl_hours` (
  `hours_id` mediumint(10) NOT NULL auto_increment,
  `users_id` smallint(4) NOT NULL,
  `shift_start` datetime NOT NULL,
  `shift_end` datetime NOT NULL,
  `loc_id` tinyint(2) NOT NULL,
  `comments` varchar(255) collate utf8_unicode_ci default NULL,
  `hours` varchar(4) collate utf8_unicode_ci NOT NULL,
  `admin_id` smallint(2) NOT NULL,
  `approved` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`hours_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Worked hours table' AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `tbl_hours`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_id_print`
-- 

CREATE TABLE `tbl_id_print` (
  `id_print` smallint(4) NOT NULL auto_increment,
  `user_id` smallint(4) NOT NULL,
  `admin_id` smallint(4) NOT NULL,
  `fecha` date NOT NULL,
  `status` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_print`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Id print table' AUTO_INCREMENT=35 ;

-- 
-- Dumping data for table `tbl_id_print`
-- 

INSERT INTO `tbl_id_print` VALUES (4, 3, 1, '2013-09-11', 1);
INSERT INTO `tbl_id_print` VALUES (3, 1, 1, '2013-09-11', 1);
INSERT INTO `tbl_id_print` VALUES (5, 6, 1, '2013-09-11', 1);
INSERT INTO `tbl_id_print` VALUES (6, 9, 1, '2013-09-18', 1);
INSERT INTO `tbl_id_print` VALUES (7, 10, 1, '2013-09-18', 1);
INSERT INTO `tbl_id_print` VALUES (8, 2, 1, '2013-09-18', 1);
INSERT INTO `tbl_id_print` VALUES (9, 8, 1, '2013-09-18', 1);
INSERT INTO `tbl_id_print` VALUES (10, 6, 1, '2013-09-18', 1);
INSERT INTO `tbl_id_print` VALUES (11, 4, 1, '2013-10-28', 1);
INSERT INTO `tbl_id_print` VALUES (12, 9, 1, '2013-11-11', 1);
INSERT INTO `tbl_id_print` VALUES (13, 8, 1, '2013-11-11', 1);
INSERT INTO `tbl_id_print` VALUES (14, 21, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (15, 20, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (16, 19, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (17, 18, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (18, 17, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (19, 16, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (20, 15, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (21, 14, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (22, 13, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (23, 12, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (24, 11, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (25, 22, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (26, 23, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (27, 24, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (28, 25, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (29, 26, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (30, 20, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (31, 18, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (32, 1, 1, '2013-11-22', 1);
INSERT INTO `tbl_id_print` VALUES (33, 20, 1, '2013-11-22', 0);
INSERT INTO `tbl_id_print` VALUES (34, 18, 1, '2013-11-22', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_incident_type`
-- 

CREATE TABLE `tbl_incident_type` (
  `incident_id` tinyint(3) unsigned NOT NULL auto_increment,
  `incident_text` varchar(40) collate utf8_unicode_ci NOT NULL,
  `users_id` smallint(4) NOT NULL,
  PRIMARY KEY  (`incident_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tbl_incident_type`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_users`
-- 

CREATE TABLE `tbl_users` (
  `users_id` smallint(6) unsigned NOT NULL auto_increment,
  `id_finger` smallint(6) unsigned default NULL,
  `last_name` varchar(15) collate utf8_unicode_ci NOT NULL,
  `middle_name` varchar(15) collate utf8_unicode_ci default NULL,
  `first_name` varchar(15) collate utf8_unicode_ci NOT NULL,
  `picture` varchar(50) collate utf8_unicode_ci default NULL,
  `email` varchar(40) collate utf8_unicode_ci default NULL,
  `ssn` varchar(11) collate utf8_unicode_ci NOT NULL,
  `address` varchar(100) collate utf8_unicode_ci NOT NULL,
  `city` varchar(25) collate utf8_unicode_ci NOT NULL,
  `state` varchar(2) collate utf8_unicode_ci NOT NULL,
  `zipcode` varchar(5) collate utf8_unicode_ci NOT NULL,
  `cellphone` varchar(10) collate utf8_unicode_ci default NULL,
  `homephone` varchar(10) collate utf8_unicode_ci default NULL,
  `position` tinyint(1) NOT NULL,
  `pay_rate` decimal(4,2) NOT NULL default '0.00',
  `loc_id` smallint(3) default NULL,
  `license_class` varchar(1) collate utf8_unicode_ci default NULL,
  `license_number` varchar(7) collate utf8_unicode_ci default NULL,
  `license_training` tinyint(1) unsigned NOT NULL default '0',
  `exp_license` date default NULL,
  `date_hired` varchar(10) collate utf8_unicode_ci NOT NULL,
  `date_fired` date default NULL,
  `username` varchar(20) collate utf8_unicode_ci default NULL,
  `password` varchar(20) collate utf8_unicode_ci default NULL,
  `user_enabled` tinyint(1) NOT NULL default '1',
  `user_admin` tinyint(1) NOT NULL,
  PRIMARY KEY  (`users_id`),
  UNIQUE KEY `ssn` (`ssn`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `tbl_users`
-- 

INSERT INTO `tbl_users` VALUES (1, NULL, 'Leon', 'V', 'Luis', '', 'luisleonv@hotmail.com', '733167390', '4501 NW 3RD AVE2', '1', 'FL', '33127', '3054015393', NULL, 4, 10.00, 3, 'D', NULL, 1, '2013-08-30', '02/25/2010', NULL, 'lleon', 'targus25', 1, 0);
INSERT INTO `tbl_users` VALUES (2, NULL, 'Smith', NULL, 'John', '', NULL, '589-23-951', '1021 NW 45 STREET', '1', 'FL', '33127', '7867041918', '7865153133', 1, 0.00, 4, 'D', '1121155', 0, NULL, '05/03/2012', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (3, NULL, 'Pierre charles', NULL, 'Benjamin', '', NULL, '770-38-827', '15620 NE 4TH CT', '1', 'FL', '33162', '7187958618', NULL, 1, 0.00, 4, 'D', '1315966', 0, NULL, '07/18/2013', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (4, NULL, 'Rables', NULL, 'Deosdany', '', NULL, '592-84-016', '2775 WEST OKEECHOBEE LOT 55', '3', 'FL', '33010', '7862633374', NULL, 1, 0.00, 4, 'D', '1231473', 0, '2015-01-03', '12/26/2012', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (6, NULL, 'Valdes', NULL, 'Rafael', '', NULL, '593-64-289', '7500 SW 16 TERRACE', '1', 'FL', '33155', '7864394646', NULL, 1, 0.00, 4, 'D', '1302202', 0, NULL, '2011-08-17', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (5, NULL, 'Youance', 'J', 'Hermann', '', NULL, '884-87-841', '850 NE 207 TERRACE', '1', 'FL', '33179', '7863794340', '7865522057', 1, 0.00, 4, 'D', '1132684', 0, '2013-11-28', '08/27/2013', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (7, NULL, 'DIAZ HERRERA', NULL, 'ALAIN', NULL, NULL, '766-42-554', '415 SW 32 AVE APT3', '1', 'FL', '33135', '7862631584', NULL, 1, 0.00, 4, 'D', '112715', 0, NULL, '2013-09-17', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (8, NULL, 'Garcia', 'A', 'Miguel', NULL, NULL, '064-68-645', '1550 N. MIAMI AVE', '1', 'FL', '33136', '7864397414', NULL, 1, 0.00, 4, 'D', NULL, 1, '2013-11-19', '2013-09-13', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (9, NULL, 'Aaron', NULL, 'Christopher', NULL, NULL, '594-48-540', '1340 NW 191 ST', '5', 'FL', '33169', '3059232608', NULL, 1, 0.00, 4, 'D', NULL, 1, '2013-12-04', '2013-09-10', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (10, NULL, 'Foster', NULL, 'Jeff', NULL, NULL, '036-36-0366', '10330 SW 164TH STREET', '1', 'FL', '33157', '7864261148', NULL, 1, 7.68, 4, 'D', NULL, 1, '2013-09-18', '2013-09-09', NULL, NULL, NULL, 1, 0);
INSERT INTO `tbl_users` VALUES (11, NULL, 'RONDACIOUS', 'LEKWAN', 'BRYANT', NULL, NULL, '595924755', '3230 NW 13TH AVE', '1', 'FL', '33142', '7863717819', NULL, 1, 0.00, 4, 'D', '1322027', 0, '2015-09-19', '2013-10-29', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (12, NULL, 'DELAO', 'JOHN', 'DAVID', NULL, NULL, '387110573', '79 NW 10TH ST APT5', '1', 'FL', '33030', '7862052588', NULL, 1, 0.00, 4, 'D', '1206569', 0, '2014-03-13', '2013-11-19', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (13, NULL, 'BARRERAS', NULL, 'MIGUEL', NULL, NULL, '264979874', '1070 NW 95TERR', '1', 'FL', '33150', '7862325912', NULL, 1, 0.00, 4, 'D', '9513355', 0, '2015-08-22', '2013-10-03', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (14, NULL, 'RODRIGUEZ', NULL, 'ANTHONY', NULL, NULL, '592375853', '7375 SW 39 TERR', '1', 'FL', '33155', '7863570885', NULL, 1, 0.00, 4, 'D', NULL, 1, '2014-01-29', '2013-11-14', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (15, NULL, 'LOPEZ', NULL, 'JAVIER', NULL, NULL, '767388311', '1644SW 14TH TERR', '1', 'FL', '33145', '7863809352', NULL, 1, 0.00, 4, 'D', NULL, 1, '2013-11-22', '2013-11-13', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (16, NULL, 'SHELDON', 'LAMAR', 'JACQUES', NULL, NULL, '589964193', '1230 NE 146TH ST', '1', 'FL', '33161', '7868735256', NULL, 1, 0.00, 4, 'D', '1231461', 0, '2015-04-06', '2013-11-06', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (17, NULL, 'TORRES', 'JUNIOR', 'RAYMON', NULL, NULL, '595138621', '2320 NW 24TH AVE', '1', 'FL', '33142', '7869757554', NULL, 1, 0.00, 4, 'D', '1217683', 0, '2014-07-23', '2013-11-21', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (18, NULL, 'KENNETH', 'ANDRES', 'DAVIES', NULL, NULL, '594358911', '6004 SW 146 CT', '1', 'FL', '33183', '7863508589', NULL, 1, 0.00, 4, 'D', '1301644', 0, '2015-02-19', '2013-11-20', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (19, NULL, 'HENRIQUEZ', 'JOHN', 'DAVID', NULL, NULL, '594049073', '3700 SW 60TH PLACE', '1', 'FL', '33155', '3057487918', NULL, 1, 0.00, 4, 'D', '1218137', 0, '2014-07-24', '2013-11-19', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (20, NULL, 'CLINT', 'TERRENCE', 'KNIGHTS', NULL, NULL, '578139612', '2529 NE 191 ST APT4', '10', 'FL', '33179', '7862347681', NULL, 1, 0.00, 4, 'D', '2610101', 0, '2014-05-23', '2013-11-12', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (21, NULL, 'LEON', NULL, 'ALEJANDRO', NULL, NULL, '767228331', '676 W 40TH PL', '3', 'FL', '33012', '7863836250', NULL, 1, 0.00, 4, 'D', '1108003', 0, '2015-03-19', '2013-11-14', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (22, NULL, 'STRAGENE', NULL, 'MERZIUS', NULL, NULL, '590031984', '1780 NW 129TH TERR', '1', 'FL', '33167', '9547087190', NULL, 1, 0.00, 4, 'D', '2705682', 0, '2015-03-05', '2013-11-12', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (23, NULL, 'GOSIER', 'TERRY', 'WILLIAM', NULL, NULL, '591963199', '1340 NW 82ND ST', '1', 'FL', '33147', '3862642214', NULL, 1, 0.00, 4, 'D', '1210921', 0, '2014-05-15', '2013-11-19', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (24, NULL, 'PELAEZ', 'CARLOS', 'JUAN', NULL, NULL, '592272226', '1777 NW 19TH TER', '1', 'FL', '33125', '3059876947', NULL, 1, 0.00, 4, 'D', '1321786', 0, '2015-11-01', '2013-10-24', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (25, NULL, 'WILLIAMS', 'CLIFFORD', 'MARQUEZE', NULL, NULL, '591114153', '2011 NW 24ST', '1', 'FL', '33142', '7866639674', NULL, 1, 0.00, 4, 'D', '1113782', 0, '2015-05-09', '2013-11-19', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (26, NULL, 'HOYOS', NULL, 'MICHAEL', NULL, NULL, '595417558', '400 NW 32ST', '1', 'FL', '33127', '7864437798', NULL, 1, 0.00, 4, 'D', '1327802', 0, '2013-12-29', '2013-11-15', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (27, 101, 'ZAVALA', 'C', 'JAN', NULL, NULL, '592894960', '1945 CALAIS DR # 4', '2', 'FL', '33141', '7862617226', NULL, 1, 0.00, 2, 'D', '1001470', 0, '2014-01-19', '2010-02-23', NULL, NULL, NULL, 1, 1);
INSERT INTO `tbl_users` VALUES (28, 100, 'VELASQUEZ', NULL, 'RAUL', NULL, NULL, '053687437', '3498 NW 32ND AVE 2 FLOOR', '1', 'FL', '33142', '3054570944', NULL, 1, 0.00, 2, 'D', '1105996', 0, '2013-12-18', '2012-04-23', NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `warnings`
-- 

CREATE TABLE `warnings` (
  `war_id` smallint(6) NOT NULL auto_increment,
  `user_id` smallint(6) NOT NULL,
  `war_type` tinyint(3) NOT NULL,
  `war_date` varchar(10) collate utf8_unicode_ci NOT NULL,
  `war_time` varchar(5) collate utf8_unicode_ci NOT NULL,
  `war_case` text collate utf8_unicode_ci NOT NULL,
  `war_solution` text collate utf8_unicode_ci,
  `location_id` tinyint(3) unsigned NOT NULL,
  `admin_id` tinyint(3) NOT NULL,
  PRIMARY KEY  (`war_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Warnings for guards' AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `warnings`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `warning_type`
-- 

CREATE TABLE `warning_type` (
  `war_id` tinyint(2) NOT NULL auto_increment,
  `war_type` varchar(60) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`war_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `warning_type`
-- 

INSERT INTO `warning_type` VALUES (1, 'Verbal Warning');
INSERT INTO `warning_type` VALUES (2, '1st Written Warning');
INSERT INTO `warning_type` VALUES (3, '2nd Written Warning');
