<?php
    include "database.php";

    try {
        $dbh = new PDO("mysql:host=$DB_DNS", $DB_USER, $DB_PASSWORD);

        $dbh->exec("CREATE DATABASE IF NOT EXISTS $DB_NAME;")
        or die(print_r($dbh->errorInfo(), true));
        // $dbh->use($DB_NAME) or die(print_r($dbh->errorInfo(), true));
        $dbh->exec("CREATE TABLE `camagru`.`users`(
            `id` INT NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(20) NOT NULL,
            `password` VARCHAR(64) NOT NULL,
            `salt` VARCHAR(32) NOT NULL,
            `name` VARCHAR(50) NOT NULL,
            `joined` DATETIME NOT NULL,
            `group` INT NOT NULL,
            PRIMARY KEY(`id`)
        )");
        $dbh->exec("CREATE TABLE `camagru`.`group`(
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(20) NOT NULL,
            `permissions` TEXT NOT NULL,
            PRIMARY KEY(`id`)
        )");
        $dbh->exec("CREATE TABLE `camagru`.`users_session`(
            `id` INT NOT NULL AUTO_INCREMENT,
            `user_id` INT NOT NULL,
            `hash` VARCHAR(50) NOT NULL,
            PRIMARY KEY(`id`)
        )");
        $dbh->exec("INSERT INTO `camagru`.`group`(`id`, `name`, `permissions`)
            VALUES(NULL, 'Standard user', '')");
        $dbh->exec("INSERT INTO `camagru`.`group`(`id`, `name`, `permissions`)
        VALUES(
            NULL,
            'Administrator',
            '{\"admin\": 1}'
        )");
    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }

?>
