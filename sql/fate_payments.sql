/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : nemesis

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-05-16 06:41:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for fate_payments
-- ----------------------------
DROP TABLE IF EXISTS `fate_payments`;
CREATE TABLE `fate_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_status` varchar(255) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `custom` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
