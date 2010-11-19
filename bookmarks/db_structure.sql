CREATE TABLE `bookmarks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `date_added` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link` (`link`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
