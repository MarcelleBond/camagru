<?php
    include "database.php";

    try {
        $dbh = new PDO("mysql:host=$DB_DNS", $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $dbh->exec("CREATE DATABASE IF NOT EXISTS camagru;")
        or die(print_r($dbh->errorInfo(), true));
        $dbh->exec("CREATE TABLE `camagru`.`users`(
            `user_id` INT(255) NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(255) NOT NULL,
            `passwd` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `joined` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `groups` INT(255) NOT NULL,
            PRIMARY KEY(`user_id`)
        )");
        $dbh->exec("CREATE TABLE `camagru`.`group`(
            `group_id` INT(255) NOT NULL AUTO_INCREMENT,
            `group_name` VARCHAR(255) NOT NULL,
            `permissions` TEXT NOT NULL,
            PRIMARY KEY(`group_id`)
        )");
        $dbh->exec("CREATE TABLE `camagru`.`users_session`(
            `session_id` INT(255) NOT NULL AUTO_INCREMENT,
            `user_id` INT(255) NOT NULL,
            `hash` VARCHAR(255) NOT NULL,
            PRIMARY KEY(`session_id`)
        )");
        $dbh->exec("INSERT INTO `camagru`.`group`(`group_id`, `group_name`, `permissions`)
            VALUES(NULL, 'Standard user', '')");
        $dbh->exec("INSERT INTO `camagru`.`group`(`group_id`, `group_name`, `permissions`)
        VALUES(
            NULL,
            'Administrator',
            '{\"admin\": 1}'
        )");
        $dbh->exec("CREATE TABLE `camagru`.`gallery`(
            `img_id` INT(255) NOT NULL AUTO_INCREMENT,
            `img_name` VARCHAR(255) NOT NULL,
            `user_id` INT(255) NOT NULL,
            `comments_id` INT(255) NOT NULL,
            `time_stamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY(`img_id`)  
        )");
        $dbh->exec("CREATE TABLE `camagru`.`comments`(
            `comment_id` INT(255) NOT NULL AUTO_INCREMENT,
            `user_img_id` INT(255) NOT NULL,
            `friend_id` INT(255) NOT NULL,
            `comment` VARCHAR(255) NOT NULL,
            `time_stamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `img_id` INT(255) NOT NULL,
            PRIMARY KEY(`comment_id`)
        )");
    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }

?>
