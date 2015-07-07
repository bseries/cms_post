ALTER TABLE `posts` ADD `owner_id` INT(11)  UNSIGNED  NOT NULL  AFTER `id`;
UPDATE `posts` SET `owner_id` = 1 WHERE `owner_id` = 0;
