CREATE  TABLE `subjects` 
(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


CREATE TABLE `payments` 
(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `city` 
(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);



create table `authorizations` 
(
	`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`lastname` varchar(255) NOT NULL,
	`age` int(3) NOT NULL,
	`city_id` int(10) NOT NULL,
	`phone` varchar(15) NOT NULL,
	`email` varchar(255) NOT NULL,
	`subject_id` int(10) NOT NULL,
	`payment_id` int(10) NOT NULL,
	`agree` varchar(10) NOT NULL,
	`deleted_at` TIMESTAMP NULL DEFAULT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY(`id`),
	KEY `subject_id` (`subject_id`),
	KEY `payment_id` (`payment_id`),
	KEY `updated_at` (`updated_at`),
	KEY `deleted_at` (`deleted_at`)
);



INSERT INTO `subjects` (`name`) VALUES
('Бизнес и коммуникации'), 
('Технологии'), 
('Реклама и Маркетинг');


INSERT INTO `payments` (`name`) VALUES
('WebMoney'),
('Yandex.money'),
('PayPal'),
('Credit Card');

INSERT INTO `city` (`name`) VALUES
('yes'),
('no');

