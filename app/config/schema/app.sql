#App sql generated on: 2011-10-11 15:48:28 : 1318340908

DROP TABLE IF EXISTS `changes`;
DROP TABLE IF EXISTS `customers`;
DROP TABLE IF EXISTS `states`;
DROP TABLE IF EXISTS `tickets`;
DROP TABLE IF EXISTS `users`;


CREATE TABLE `changes` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`ticket_id` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
	`change` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`created` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY `ticket_id` (`ticket_id`),
	KEY `user_id` (`user_id`))	DEFAULT CHARSET=latin1,
	COLLATE=latin1_swedish_ci,
	ENGINE=InnoDB;

CREATE TABLE `customers` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`phone` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY `name` (`name`))	DEFAULT CHARSET=latin1,
	COLLATE=latin1_swedish_ci,
	ENGINE=InnoDB;

CREATE TABLE `states` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,	PRIMARY KEY  (`id`))	DEFAULT CHARSET=latin1,
	COLLATE=latin1_swedish_ci,
	ENGINE=InnoDB;

CREATE TABLE `tickets` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
	`assigned_to` int(11) NOT NULL,
	`state_id` int(11) DEFAULT NULL,
	`customer_id` int(11) DEFAULT NULL,
	`subject` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`notes` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`items` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`amount_owed` float(16,2) NOT NULL,
	`amount_paid` float(16,2) NOT NULL,
	`created` datetime DEFAULT NULL,
	`due` date DEFAULT NULL,
	`modified` datetime DEFAULT NULL,
	`closed` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY `customer_id` (`customer_id`),
	KEY `state_id` (`state_id`),
	KEY `user_id` (`user_id`),
	KEY `assigned_to` (`assigned_to`))	DEFAULT CHARSET=latin1,
	COLLATE=latin1_swedish_ci,
	ENGINE=InnoDB;

CREATE TABLE `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`password` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY `username` (`username`))	DEFAULT CHARSET=latin1,
	COLLATE=latin1_swedish_ci,
	ENGINE=InnoDB;

