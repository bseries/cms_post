ALTER TABLE `posts` CHANGE `cover_media_id` `cover_media_id` INT(11)  NULL;
UPDATE `posts` SET `cover_media_id` = NULL WHERE `cover_media_id` = 0;

