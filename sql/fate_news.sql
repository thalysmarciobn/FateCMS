/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : nemesis

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-05-16 02:43:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for fate_news
-- ----------------------------
DROP TABLE IF EXISTS `fate_news`;
CREATE TABLE `fate_news` (
  `id` int(11) NOT NULL,
  `Title` varchar(25) NOT NULL,
  `SubTitle` varchar(25) NOT NULL,
  `Date` datetime NOT NULL,
  `Text` varchar(255) NOT NULL,
  `Author` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
