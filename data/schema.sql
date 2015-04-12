CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cover_media_id` int(11) DEFAULT NULL,
  `authors` varchar(250) DEFAULT NULL,
  `title` varchar(250) NOT NULL DEFAULT '',
  `teaser` text,
  `body` text NOT NULL,
  `tags` varchar(250) DEFAULT NULL,
  `source` varchar(250) DEFAULT NULL,
  `is_promoted` tinyint(1) DEFAULT '0',
  `is_published` tinyint(1) DEFAULT '0',
  `published` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `is_published` (`is_published`),
  KEY `is_promoted` (`is_promoted`),
  KEY `published` (`published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;