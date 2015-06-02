

DROP TABLE IF EXISTS `users_details`;
CREATE TABLE `users_details` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `job` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

