
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- post
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `slug` VARCHAR(500) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `published_dt` DATETIME,
    `created_dt` DATETIME NOT NULL,
    `updated_dt` DATETIME,
    `deleted_dt` DATETIME,
    `user_id` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `slug_UNIQUE` (`slug`),
    INDEX `fk_post_user1_idx` (`user_id`),
    CONSTRAINT `fk_post_user1`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- token
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `token`;

CREATE TABLE `token`
(
    `id` CHAR(22) NOT NULL,
    `type` VARCHAR(10) DEFAULT 'access' NOT NULL,
    `details` TEXT,
    `expire_dt` DATETIME NOT NULL,
    `created_dt` DATETIME NOT NULL,
    `updated_dt` DATETIME,
    `user_id` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `id_UNIQUE` (`id`),
    INDEX `fk_token_user_idx` (`user_id`),
    CONSTRAINT `fk_token_user`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(45) NOT NULL,
    `last_name` VARCHAR(45),
    `password` VARCHAR(45) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `created_dt` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email_UNIQUE` (`email`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
