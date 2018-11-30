<?php
    include "database.php";

    try {
        $dbh = new PDO("mysql:host=$DB_DNS", $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->exec("CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;")
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

        $dbh->exec("INSERT INTO `camagru`.`comments` (`comment_id`, `user_img_id`, `friend_id`, `comment`, `time_stamp`, `img_id`) VALUES
        (12, 5, 5, 'Like my picture dude', '2018-11-27 08:20:02', 11),
        (13, 5, 3, 'bitch ass', '2018-11-27 08:20:38', 10),
        (14, 5, 1, '☹️', '2018-11-27 12:42:03', 14),
        (15, 7, 7, 'ghost face killer', '2018-11-28 06:30:50', 16),
        (16, 7, 7, 'werwrwer', '2018-11-28 06:39:03', 17),
        (17, 7, 7, '', '2018-11-28 06:39:04', 17)");
        $dbh->exec("INSERT INTO `camagru`.`gallery` (`img_id`, `img_name`, `user_id`, `time_stamp`) VALUES
        (9, 'images/gallary/user_5_image_1.png', 5, '2018-11-27 08:19:19'),
        (10, 'images/gallary/user_5_image_2.png', 5, '2018-11-27 08:19:33'),
        (11, 'images/gallary/user_5_image_3.png', 5, '2018-11-27 08:19:42'),
        (12, 'images/gallary/user_5_image_4.png', 5, '2018-11-27 08:27:15'),
        (13, 'images/gallary/user_5_image_5.png', 5, '2018-11-27 08:39:30'),
        (14, 'images/gallary/user_5_image_6.png', 5, '2018-11-27 08:39:37'),
        (15, 'images/gallary/user_7_image_1.png', 7, '2018-11-28 06:05:21'),
        (16, 'images/gallary/user_7_image_2.png', 7, '2018-11-28 06:05:31'),
        (17, 'images/gallary/user_7_image_3.png', 7, '2018-11-28 06:05:42')");
        $dbh->exec("INSERT INTO `camagru`.`likes` (`img_id`, `likers_id`, `like_status`) VALUES
        (15, 7, 1),
        (16, 7, 1),
        (17, 7, 1)");
        $dbh->exec("INSERT INTO `camagru`.`users` (`user_id`, `username`, `passwd`, `email`, `joined`, `active`, `ver_code`, `notify`) VALUES
        (3, 'test', 'e75a071d19d6f149291d69ab0b075a1a25241878b19f39061d075ea6e66042d9e11b6fb50deef64110d059273e4c50929e222342b2d5398493500cd1c2c69eea', 'tidilotsotlhe@gmail.com', '2018-11-27 08:46:32', 1, '', 0),
        (4, 'Claudz', 'f2ee4da48059ae73696a1d21fd0732f040b11f7d44252cf9295c77d4c742ff7002f09953d41410b65c385a30ddfbdeb2d4a187054e95138c83193fa01a384cc2', 'claudiamabuza0@gmail.com', '2018-11-27 08:47:26', 1, '', 0),
        (5, 'Blue', 'c540ab51cd38dd645beb61242d274988934279be0447a48a25c77d17dbb43fb409324a6fb25de8b269263259991999fca6c42bf7ce52ff22b7fba37a436aae3d', 'makwakwa.lunga9712@gmail.com', '2018-11-27 10:17:30', 1, '', 0),
        (7, 'Tyler', '3de1244694191a92f1b0a516df476cb6df269aa1b9047643fdd671dde008a80433ab9aa5d6b7cdd940fd7535c51b8fb0c53c60c320a65a2c7fa08514008d00f9', 'zahoxudule@rsvhr.com', '2018-11-28 08:03:45', 1, '', 1)");

        $dbh->exec("ALTER TABLE
        `camagru`.`likes` ADD UNIQUE(`img_id`, `likers_id`)");
        $dbh->exec("ALTER TABLE
        `camagru`.`comments` ADD CONSTRAINT `del_com` FOREIGN KEY(`img_id`) REFERENCES `camagru`.`gallery`(`img_id`) ON DELETE CASCADE ON UPDATE NO ACTION");
        $dbh->exec("ALTER TABLE
        `camagru`.`likes` ADD CONSTRAINT `del_likes` FOREIGN KEY(`img_id`) REFERENCES `camagru`.`gallery`(`img_id`) ON DELETE CASCADE ON UPDATE NO ACTION");

       
        
        header('Location: ../index.php');
    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }

?>
