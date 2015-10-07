ALTER TABLE `posts` CHANGE `title` `title` VARCHAR(250)  CHARACTER SET utf8  COLLATE utf8_general_ci  NULL  DEFAULT '';
ALTER TABLE `posts` CHANGE `body` `body` TEXT  CHARACTER SET utf8  COLLATE utf8_general_ci  NULL;
ALTER TABLE `posts` CHANGE `cover_media_id` `cover_media_id` INT(11)  NULL;
