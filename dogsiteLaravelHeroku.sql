/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 5.6.50-log : Database - heroku_b17ac9867860da2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`heroku_b17ac9867860da2` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `heroku_b17ac9867860da2`;

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dog_id` int(11) NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `comments` */

insert  into `comments`(`id`,`user_id`,`dog_id`,`content`,`created_at`,`updated_at`) values 
(24,1,63,'Comment 1','2018-09-17 13:42:09','2018-09-28 09:51:26'),
(25,1,64,'<script>alert(\"D\");</script>','2018-09-17 13:42:16','2018-09-17 16:59:02'),
(26,1,60,'dsadsada','2018-09-17 13:42:40','2018-09-17 13:42:40'),
(29,2,64,'cogica moj mali, mladji ticbrale, programer moj... aj lav ju <3','2018-09-17 17:32:43','2018-09-17 17:32:43'),
(31,1,63,'Comment 2','2018-09-18 04:59:55','2018-09-28 09:51:34'),
(32,1,63,'dsadsadas','2018-09-18 06:06:41','2018-09-18 06:06:41'),
(33,1,63,'dsadsa','2018-09-18 07:07:38','2018-09-18 07:07:38'),
(38,2,60,'Coja','2018-09-19 15:18:46','2018-09-19 15:18:46'),
(40,1,67,'Comment 2','2018-09-23 11:53:57','2018-09-23 11:53:57'),
(42,1,68,'Comment 1','2018-09-28 09:48:33','2018-09-28 09:48:50'),
(43,1,68,'Comment 2','2018-09-28 09:48:43','2018-09-28 09:48:43');

/*Table structure for table `contact_us` */

DROP TABLE IF EXISTS `contact_us`;

CREATE TABLE `contact_us` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `contact_us` */

insert  into `contact_us`(`id`,`name`,`email`,`phone`,`content`,`created_at`,`updated_at`) values 
(38,'dasdsada','dsadsa@dsa','0652844000','dsadsa','2018-09-12 15:16:33','2018-09-12 15:16:33'),
(39,'GaGi J.','dragoslav.gagi8@gmail.com','652844000','dsadsa','2018-09-12 15:23:09','2018-09-12 15:23:09'),
(40,'GaGi J.','dragoslav.gagi8@gmail.com','652844000','dsadas','2018-09-12 15:24:27','2018-09-12 15:24:27'),
(41,'GaGi J.','dragoslav.gagi8@gmail.com','652844000','dsadsad','2018-09-13 08:18:20','2018-09-13 08:18:20'),
(42,'GaGi J.','dragoslav.gagi8@gmail.com','652844000','dsadasdas','2018-09-13 16:43:26','2018-09-13 16:43:26'),
(43,'GaGi J.','dragoslav.gagi8@gmail.com','652844000','12321321313','2018-09-23 11:34:22','2018-09-23 11:34:22'),
(52,'Ga','ga@ga.com','21321','312321','2019-03-17 13:54:55','2019-03-17 13:54:55'),
(62,'Мужское','fgh@gmail.com','87694562354','проба','2019-05-11 19:59:19','2019-05-11 19:59:19'),
(72,'dasdsa','dsadsa@dsadas.com','381652844000','dsadasdsa','2019-11-24 20:19:51','2019-11-24 20:19:51'),
(82,'GaGi','dragoslav.gagi8@yahoo.com','381652844006','dasdasda','2020-01-21 13:50:59','2020-01-21 13:50:59'),
(92,'d','dragoslav.gagi8@gmail.com','456456','asdadas','2020-01-21 13:52:33','2020-01-21 13:52:33'),
(96,'ssigcekgp','agrtmvf@outlook.com','http://www.gy82c0wti0ot2p8952h52s1mfhi96m96s.org/','DogSite\r\nssigcekgp http://www.gy82c0wti0ot2p8952h52s1mfhi96m96s.org/\r\n[url=http://www.gy82c0wti0ot2p8952h52s1mfhi96m96s.org/]ussigcekgp[/url]\r\n<a href=\"http://www.gy82c0wti0ot2p8952h52s1mfhi96m96s.org/\">assigcekgp</a>','2021-09-15 02:29:28','2021-09-15 02:29:28');

/*Table structure for table `dogs` */

DROP TABLE IF EXISTS `dogs`;

CREATE TABLE `dogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `breed` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `breed_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `dogs` */

insert  into `dogs`(`id`,`breed`,`description`,`created_at`,`updated_at`,`user_id`,`breed_image`) values 
(1,'DOBERMAN','<p>The Dobermann, or Doberman Pinscher in the United States and Canada, is a medium-large breed of domestic dog originally developed around 1890 by Karl Friedrich Louis Dobermann, a tax collector from Germany. Life span: 10 &ndash; 13 years Origin: Germany Weight: Male: 40&ndash;45 kg, Female: 32&ndash;35 kg Temperament: Fearless, Energetic, Loyal, Alert, Obedient, Confident, Intelligent Height: Male: 66&ndash;72 cm, Female: 61&ndash;68 cm Colors: White, Black, Fawn, Blue, Black &amp; Rust, Red &amp; Rust, Red, Blue &amp; Rust, Fawn &amp; Rust</p>','2018-09-09 07:42:23','2018-09-28 09:51:01',1,'ZOYT9bb_1538124661.jpg'),
(2,'POODLE','<p>The poodle is a group of formal dog breeds, the Standard Poodle, Miniature Poodle and Toy Poodle. The origin of the breed is still discussed, with a prominent dispute over whether the poodle descends ... Hypoallergenic: Yes Life span: 12 &ndash; 15 years Height: Toy Poodle: 24 &ndash; 28 cm, Miniature Poodle: 28 &ndash; 35 cm, Standard Poodle: 45 &ndash; 60 cm, Medium Poodle: 35 &ndash; 45 cm Temperament: Alert, Intelligent, Faithful, Instinctual, Active, Trainable Colors: Black, Apricot, White, Cream, Black &amp; White, Blue, Silver, Sable, Brown, Red, Grey Origin: France, Germany</p>','2018-09-09 07:43:34','2018-09-28 09:50:37',1,'kzZPoLo_1538124637.jpg'),
(59,'GREAT DANE','<p>The Great Dane is a large German breed of domestic dog known for its giant size. The German name of the breed is Deutsche Dogge, or German Mastiff. The French name is Dogue Allemand. The Great Dane is one of the tallest dog breeds. Wikipedia Life span: 8 &ndash; 10 years Origin: Germany Height: Female: 71&ndash;81 cm, Male: 76&ndash;86 cm Temperament: Devoted, Reserved, Gentle, Confident, Loving, Friendly Colors: Black, Brindle, Fawn, Harlequin, Blue, Mantle Weight: Female: 45&ndash;59 kg, Male: 54&ndash;90 kg</p>','2018-09-14 14:34:59','2018-09-28 09:48:07',1,'Great-Dane-Dog-Pictures-HD-Wallpapers_1538124486.jpg'),
(60,'LABRADOR','<p>The Labrador Retriever, or just Labrador, is a type of retriever-gun dog. The Labrador is one of the most popular breeds of dog in Canada, the United Kingdom and the United States. Wikipedia Life span: 10 &ndash; 14 years Temperament: Kind, Outgoing, Agile, Gentle, Intelligent, Even Tempered, Trusting Height: Male: 57&ndash;62 cm, Female: 55&ndash;60 cm Weight: Male: 29&ndash;36 kg, Female: 25&ndash;32 kg Colors: Black, Chocolate, Yellow Did you know: Labrador Retriever is the most popular dog breed by registrations (191,988) worldwide.</p>','2018-09-14 14:47:46','2018-09-28 09:53:46',2,'168582_1538124826.jpg'),
(63,'BULLDOG','<p>A Bulldog is a medium-sized breed of dog commonly referred to as the English Bulldog or British Bulldog. It is a muscular, hefty dog with a wrinkled face and a distinctive pushed-in nose. Wikipedia Life span: 8 &ndash; 10 years Temperament: Docile, Willful, Friendly, Gregarious Weight: Female: 18&ndash;23 kg, Male: 23&ndash;25 kg Colors: White, Fawn, Piebald, Brindle &amp; White, Red &amp; White, Fawn &amp; White, Red Brindle, Red Height: Female: 31&ndash;40 cm, Male: 31&ndash;40 cm Origin: United Kingdom, England</p>','2018-09-17 05:15:20','2018-09-28 09:49:46',1,'American-Bulldog-HD-Desktop_1538124586.jpg'),
(64,'GOLDEN RETRIEVER','<p>The Golden Retriever is a large-sized breed of dog bred as gun dogs to retrieve shot waterfowl such as ducks and upland game birds during hunting and shooting parties, and were named &#39;retriever&#39; because ... Wikipedia Life span: 10 &ndash; 12 years Weight: Female: 25&ndash;32 kg, Male: 30&ndash;34 kg Colors: Cream, Golden, Dark Golden, Light Golden Temperament: Intelligent, Kind, Reliable, Trustworthy, Confident, Friendly Height: Female: 51&ndash;56 cm, Male: 56&ndash;61 cm Did you know: Golden Retriever is the fifth-most popular dog breed by registrations (92,994) worldwide.</p>','2018-09-17 05:20:03','2018-09-28 09:46:55',1,'golden-retriever-dog_1538124415.jpg'),
(67,'ROTTWEILER','<p>The Rottweiler is a breed of domestic dog, regarded as medium-to-large or large. The dogs were known in German as Rottweiler Metzgerhund, meaning Rottweil butchers&#39; dogs, because their main use was to ... Wikipedia Life span: 8 &ndash; 10 years Origin: Germany Temperament: Steady, Good-natured, Fearless, Devoted, Obedient, Alert, Confident, Self-assured, Calm, Courageous Weight: Female: 35&ndash;48 kg, Male: 50&ndash;60 kg Height: Female: 56&ndash;63 cm, Male: 61&ndash;69 cm Colors: Black, Blue, Tan, Mahogany</p>','2018-09-23 11:53:24','2018-09-28 09:46:17',1,'vnpeusv_1538124377.jpg'),
(68,'GERMAN SHEPHERD','<p>The German Shepherd is a breed of medium to large-sized working dog that originated in Germany. The breed&#39;s officially recognized name is German Shepherd Dog in the English language. The breed was once known as the Alsatian in Britain and Ireland. Wikipedia Life span: 9 &ndash; 13 years Temperament: Obedient, Curious, Loyal, Alert, Confident, Intelligent, Watchful, Courageous Weight: Male: 30&ndash;40 kg, Female: 22&ndash;32 kg Colors: Black, Black &amp; Tan, Red &amp; Black, Black &amp; Silver, Sable, Grey Height: Male: 60&ndash;65 cm, Female: 55&ndash;60 cm Did you know: German Shepherd is the second-most popular dog breed by registrations (129,186) worldwide.</p>','2018-09-23 13:14:17','2018-09-28 09:45:28',1,'maxresdefault_1538124328.jpg'),
(102,'ca','<p>sdasdasdaaaaaaaaaaaaaaaaaaaaasdasdasdaaaaaaaaaaaaaaaaaaaaasdasdasdaaaaaaaaaaaaaaaaaaaaasdasdasdaaaaaaaaaaaaaaaaaaaaasdasdasdaaaaaaaaaaaaaaaaaaaaasdasdasdaaaaaaaaaaaaaaaaaaaaasdasdasdaaaaaaaaaaaaaaaaaaaaasdasdasdaaaaaaaaaaaaaaaaaaaaasdasdasdaaaaaaaaaaaaaaaaaaaaasdasdasdaaaaaaaaaaaaaaaaaaaaasdasdasdaaaaaaaaaaaaaaaaaaaaa</p>','2019-08-10 15:52:17','2019-08-10 15:52:17',12,'husky.jpg'),
(112,'Dangerous dog','<p>&nbsp;ne boj se, nece da ujeda.ne boj se, nece da ujeda.ne boj se, nece da ujeda.ne boj se, nece da ujeda.ne boj se, nece da ujeda.</p>','2020-12-12 13:53:16','2020-12-12 15:25:41',32,'angry.jpg'),
(132,'Most dangerous dog,','<p>Izuzetno opasan, Ja mu se ne bi zameraoIzuzetno opasan, Ja mu se ne bi zameraoIzuzetno opasan, Ja mu se ne bi zameraoIzuzetno opasan, Ja mu se ne bi zameraoIzuzetno opasan, Ja mu se ne bi zameraoIzuzetno opasan, Ja mu se ne bi zameraoIzuzetno opasan, Ja mu se ne bi zameraoIzuzetno opasan, Ja mu se ne bi zameraoIzuzetno opasan, Ja mu se ne bi zameraoIzuzetno opasan, Ja mu se ne bi zameraoIzuzetno opasan, Ja mu se ne bi zameraoIzuzetno opasan, Ja mu se ne bi zamerao</p>','2020-12-29 01:35:25','2020-12-29 01:35:25',42,'angry_1609202125.jpg');

/*Table structure for table `likes` */

DROP TABLE IF EXISTS `likes`;

CREATE TABLE `likes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `likes` */

insert  into `likes`(`id`,`user_id`,`comment_id`,`created_at`,`updated_at`) values 
(132,1,24,'2018-09-21 15:04:08','2018-09-21 15:04:08'),
(142,1,43,'2019-03-17 13:00:49','2019-03-17 13:00:49'),
(152,1,29,'2019-03-17 18:21:06','2019-03-17 18:21:06'),
(172,1,25,'2019-05-24 19:45:14','2019-05-24 19:45:14'),
(182,12,42,'2019-08-10 15:56:58','2019-08-10 15:56:58'),
(192,1,26,'2019-10-06 22:37:25','2019-10-06 22:37:25'),
(212,1,42,'2021-01-05 12:02:32','2021-01-05 12:02:32');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2018_09_09_091844_create_dogs_table',1),
(4,'2018_09_09_132624_create_comments_table',2),
(5,'2018_09_12_152151_create_contact_us_table',3),
(6,'2018_09_13_164945_add_user_id_to_breeds',4),
(7,'2018_09_15_155133_add_breed_image_to_dogs',5),
(8,'2018_09_17_065545_create_comments_table',6),
(9,'2018_09_19_165006_create_likes_table',7);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values 
('dragoslav.gagi8@gmail.com','$2y$10$5PVaqUjL8TdX8yRqaWfZW.IOYwvBJQX0npVxmBZ3oVWUdtZdKMy4q','2018-09-13 13:53:48');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`profile_image`) values 
(1,'GaGiiiii','dragoslav.gagi8@yahoo.com',NULL,'$2y$10$f8bcg7fErWUbIUZ7WE43c.V55//v9UkXv6PG9.7dcuoFWUXNjVs7W','pIv4bZbZHLQS7bF9jkWTTacTlZRLQpEqm9b1GhoYxe6eW0s7rVSoPIuBPKRG','2018-09-13 13:08:55','2018-09-13 13:08:55','boy-dog-names_1537780487.jpg'),
(2,'Coja','coja@coja.com',NULL,'$2y$10$K2yR3NqPXC0RbhVUCcX2p.JtkiF0U1W9Efmwu3KCUt2vWQeAVDCAC','5giaYhC8pgghkV554bVHzM4unAN5gUtyF0KX6NVUtacop9HDyqfzsuriKEhw','2018-09-14 14:45:21','2018-09-14 14:45:21','boy-dog-names_1537780487.jpg'),
(6,'Martin','martin@jgaard.com',NULL,'$2y$10$xpXvpyW.4ia0c3f.jf6xHeLt3NdRSi1tAf/ydv8Ek6kzcMl9O0bUy',NULL,'2018-09-23 20:07:47','2018-09-23 20:07:47',''),
(8,'test','test@test.com',NULL,'$2y$10$7IJUm.5vln9E7MTmpEngUuzryOv8e8bUn4KoNER3KFr3P9qhWF4ea',NULL,'2018-09-24 10:29:53','2018-09-24 10:29:53','boy-dog-names_1537781393.jpg'),
(9,'Agatha','agatha@tmp.com',NULL,'$2y$10$X6.59mfctoyasQcyokz7EugpKXtfxBz.YRk.iJG4.xGAiAg1guQsG','1RZbggK1r0cBrOEqIswZecNFIb5r5fadMy5Ooi7ZuHOfhVBFomcDBxWBXZxO','2018-12-10 16:19:09','2018-12-10 16:19:09','carita-feliz_1544455149.gif'),
(12,'leonxn05','carlosleon@transportespakatnamu.com',NULL,'$2y$10$PQOwYpeR9EaS9x0X8Czunur/peK/ZZivqZQZyDvxcB8KzXIDJGniG',NULL,'2019-08-10 15:51:43','2019-08-10 15:51:43','Diagram 1_1565445103.png'),
(22,'Kandi','kg123@yandex.ru',NULL,'$2y$10$rcwyUfK4DkWY1Q45i3xN1.gYrh2BxNZDULdvj/wavFWFuuYd5F6ay',NULL,'2020-06-18 19:28:09','2020-06-18 19:28:09','default-avatar_1592501289.jpeg'),
(32,'Mike','mike@gmailcin.com',NULL,'$2y$10$v6Ng4nQRVQ6Huu7TZZ1iaed2OamqUMxN65abmpH93Cdk4o8E5CxjO','GaLh53loKJ0AyQF84LlO2KDLrzorxs4GelGxhDkThclGMai4ErqRapwMxHev','2020-12-12 13:51:27','2020-12-12 13:51:27','Miroljub-Petrovic_1607777487.jpg'),
(42,'teee','e@e.com',NULL,'$2y$10$bN1wXG4YzcbMG/6MSjJaM.wRFVCN3/S/Fwn/XgpGuwC7cIcAh9t.q','GuLhSJoBjEUdQRn9LgPu1Jpp4XDSOXUvGFErttjnaWwbDt8QPD74FCfi8CJo','2020-12-29 01:32:36','2020-12-29 01:32:36','1lcjvu_1609201956.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
