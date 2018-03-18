SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` text DEFAULT NULL,
  `whitelist` int(1) DEFAULT 0,
  `isadmin` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
