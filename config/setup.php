<?php
    include "database.php";

    try {
        $dbh = new PDO("mysql:host=$DB_DNS", $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $dbh->exec("CREATE DATABASE IF NOT EXISTS camagru;")
        or die(print_r($dbh->errorInfo(), true));
        $dbh->exec("CREATE TABLE IF NOT EXISTS `camagru`.`users`(
            `user_id` INT(255) NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(255) NOT NULL,
            `passwd` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `joined` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `active` INT(255) NOT NULL DEFAULT '0',
            `ver_code` VARCHAR(255) NOT NULL,
            `notify` INT(255) NOT NULL DEFAULT '0',
            PRIMARY KEY(`user_id`),
            UNIQUE `username`(`username`),
            UNIQUE `email`(`email`)
        )");
        $dbh->exec("CREATE TABLE IF NOT EXISTS `camagru`.`gallery`(
            `img_id` INT(255) NOT NULL AUTO_INCREMENT,
            `img_name` VARCHAR(255) NOT NULL,
            `user_id` INT(255) NOT NULL,
            `time_stamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY(`img_id`)
        )");
        $dbh->exec("CREATE TABLE IF NOT EXISTS `camagru`.`comments`(
            `comment_id` INT(255) NOT NULL AUTO_INCREMENT,
            `user_img_id` INT(255) NOT NULL,
            `friend_id` INT(255) NOT NULL,
            `comment` VARCHAR(255) NOT NULL,
            `time_stamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `img_id` INT(255) NOT NULL,
            PRIMARY KEY(`comment_id`)
        )");
        $dbh->exec("CREATE TABLE IF NOT EXISTS `camagru`.`likes`(
            `img_id` INT NOT NULL,
            `likers_id` INT NOT NULL,
            `like_status` INT NOT NULL
        )");
        $dbh->exec("ALTER TABLE
        `camagru`.`likes` ADD UNIQUE(`img_id`, `likers_id`)");
        $dbh->exec("ALTER TABLE
        `camagru`.`comments` ADD CONSTRAINT `del_com` FOREIGN KEY(`img_id`) REFERENCES `camagru`.`gallery`(`img_id`) ON DELETE CASCADE ON UPDATE NO ACTION");
        $dbh->exec("ALTER TABLE
        `camagru`.`likes` ADD CONSTRAINT `del_likes` FOREIGN KEY(`img_id`) REFERENCES `camagru`.`gallery`(`img_id`) ON DELETE CASCADE ON UPDATE NO ACTION");
        
        // header('Location: ../index.php');
    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }

?>
