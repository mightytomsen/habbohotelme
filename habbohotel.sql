/*
Navicat MySQL Data Transfer

Source Server         : Habbo
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : habbohotel

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-02-13 20:05:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `forum`
-- ----------------------------
DROP TABLE IF EXISTS `forum`;
CREATE TABLE `forum` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `username` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `avatar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of forum
-- ----------------------------
INSERT INTO `forum` VALUES ('1', 'hallo', 'bro', 'bin', 'community', 'http://i.imgur.com/ARi0uBW.png');
INSERT INTO `forum` VALUES ('2', 'Sicherheitsupdates 09.02.16', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'holyfuture', 'announcement', 'http://img.wi.to/2016/02/08/holyfuture00356.png');

-- ----------------------------
-- Table structure for `maintance`
-- ----------------------------
DROP TABLE IF EXISTS `maintance`;
CREATE TABLE `maintance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `work` varchar(255) DEFAULT NULL,
  `avatar` text,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of maintance
-- ----------------------------
INSERT INTO `maintance` VALUES ('1', 'Firesky', 'Design', 'http://i.imgur.com/ARi0uBW.png', 'Anfertigung des Design', 'Hallo Leute, die Arbeiten an unserem Habbo Design fangen so langsam an. Der Wartungsmodus ist unser aktuelles Beispiel :)');
INSERT INTO `maintance` VALUES ('2', 'Holyfuture', 'Webdeveloper', 'http://img.wi.to/2016/02/08/holyfuture00356.png', 'Es geht los!', 'Moin Moin, die Arbeiten an unserem CMS gehen nun los.  Unser aktuellstes Beispiel wäre wohl der Wartungsmodus. Lass doch ein Feedback da!');
INSERT INTO `maintance` VALUES ('3', 'INCepted', 'Webdeveloper', 'http://img.wi.to/2016/02/08/nzuCRchTpx1ozInRX0jANAsAhC1vgriDKkKILp3vByIyCZ9Y6zqcxkghWGgJ0vPdhYv1OMy3zu39G2NATgNxOEiCcQE2Md7QpTQH4TVt0Y2kS57boEKCfsCcGQioxEEC3AbrxxQvwH7CoqS43gIuuAAAAAElFTkSuQmCC99ccd.png', 'Deine Lieblingsfarbe!', 'Hey Leute, ich habe zusammen mit Firesky einen Stylechooser angefertigt. Ihr könnt nun eure eigenen Farbe auswählen.');

-- ----------------------------
-- Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `content` text,
  `avatar` text,
  `date` varchar(255) DEFAULT NULL,
  `thread_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('8', 'Holyfuture', 'gdfgd', 'http://i.imgur.com/ARi0uBW.png', '13.02.2016', '1');
INSERT INTO `posts` VALUES ('9', 'Holyfuture', 'Hey, voll geile Budhe, mach mal cool!', 'http://i.imgur.com/ARi0uBW.png', '13.02.2016', '1');
INSERT INTO `posts` VALUES ('14', 'Marco', 'Marco beitrag', 'https://picr.ws/images/daa898f415e55fe72a2cc09d10d60b0a.png', '13.02.2016', '1');
INSERT INTO `posts` VALUES ('16', 'Marco', 'sadsad', 'https://picr.ws/images/daa898f415e55fe72a2cc09d10d60b0a.png', '13.02.2016', '2');
INSERT INTO `posts` VALUES ('17', 'Marco', '&lt;script&gt;alert(&quot;test&quot;);&lt;/script&gt;', 'https://picr.ws/images/daa898f415e55fe72a2cc09d10d60b0a.png', '13.02.2016', '2');
INSERT INTO `posts` VALUES ('18', 'Justino', 'Hallo, ich bin ein kleiner Hurensohn namens Justin. Danke das Sie mich jeden Tag anspucken!', 'https://picr.ws/images/daa898f415e55fe72a2cc09d10d60b0a.png', '13.02.2016', '1');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mail` text,
  `avatar` varchar(255) DEFAULT 'https://picr.ws/images/daa898f415e55fe72a2cc09d10d60b0a.png',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Holyfuture', 'dfe4e054e943e4cc5b920f8f38bbc945317c4861100a5d431479f8d0', 'Holyfuture@habbohotel.me', 'http://i.imgur.com/ARi0uBW.png');
INSERT INTO `users` VALUES ('3', 'Marco', 'e42b1d97dbe9ce53ec926e3360ab2f6ef7f2d1499104195fe6d33511', 'sadasfd@live.de', 'https://picr.ws/images/daa898f415e55fe72a2cc09d10d60b0a.png');
INSERT INTO `users` VALUES ('4', 'Justino', '97be2122943b15830fdc3951071ae132f37f3a67d0d8f732d433dcb4', 'justino@live.de', 'https://picr.ws/images/daa898f415e55fe72a2cc09d10d60b0a.png');
