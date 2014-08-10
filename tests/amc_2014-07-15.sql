# ************************************************************
# Sequel Pro SQL dump
# Versión 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.12)
# Base de datos: amc
# Tiempo de Generación: 2014-07-15 10:06:26 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla article
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `content_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `intro` varchar(500) DEFAULT NULL,
  `fulltext` text,
  PRIMARY KEY (`content_id`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;

INSERT INTO `article` (`content_id`, `section_id`, `intro`, `fulltext`)
VALUES
	(1,3,'intro [1]','fulltext [1]'),
	(2,3,'intro [2]','fulltext [2]'),
	(3,1,'intro [3]','fulltext [3]'),
	(4,3,'intro [4]','fulltext [4]'),
	(6,3,'intro [6]','fulltext [6]'),
	(7,2,'intro [7]','fulltext [7]'),
	(8,3,'intro [8]','fulltext [8]'),
	(9,3,'intro [9]','fulltext [9]'),
	(10,4,'intro [10]','fulltext [10]'),
	(11,3,'intro [11]','fulltext [11]'),
	(12,4,'intro [12]','fulltext [12]'),
	(14,1,'[1] Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','<strong>[1] El pasaje estÃ¡ndar Lorem Ipsum, usado desde el aÃ±o 1500.</strong>\n<p>\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n</p>\n<strong>SecciÃ³n 1.10.32 de \"de Finibus Bonorum et Malorum\", escrito por Cicero en el 45 antes de Cristo</strong>\n<p>\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\n</p>\n<strong>TraducciÃ³n hecha por H. Rackham en 1914</strong>\n<p>\nBut I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\n</p>'),
	(16,1,'[1] Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','<strong>[1] El pasaje estÃ¡ndar Lorem Ipsum, usado desde el aÃ±o 1500.</strong>\n<p>\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n</p>\n<strong>SecciÃ³n 1.10.32 de \"de Finibus Bonorum et Malorum\", escrito por Cicero en el 45 antes de Cristo</strong>\n<p>\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\n</p>\n<strong>TraducciÃ³n hecha por H. Rackham en 1914</strong>\n<p>\nBut I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\n</p>'),
	(26,2,NULL,NULL),
	(77,3,NULL,NULL),
	(86,3,NULL,NULL),
	(89,3,NULL,NULL),
	(90,3,NULL,NULL),
	(91,3,NULL,NULL),
	(92,3,NULL,NULL),
	(95,4,NULL,NULL),
	(96,2,NULL,NULL),
	(108,2,NULL,NULL),
	(113,5,NULL,NULL),
	(116,3,NULL,NULL);

/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla content
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` tinyint(11) NOT NULL,
  `status` tinyint(11) NOT NULL DEFAULT '0',
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `publish_date_from` date DEFAULT NULL,
  `publish_date_to` date DEFAULT NULL,
  `view_count` int(11) DEFAULT '0',
  `share_count` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `text` varchar(500) DEFAULT NULL,
  `expires` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;

INSERT INTO `content` (`id`, `type_id`, `status`, `creation_date`, `publish_date_from`, `publish_date_to`, `view_count`, `share_count`, `title`, `text`, `expires`)
VALUES
	(1,1,1,'2014-06-24 16:24:24','2014-09-30','2014-07-01',0,0,'Antes de ir a Ikea [1]','el texto de ikea 1',0),
	(2,1,1,'2014-06-24 16:24:24','2016-02-02','2017-01-03',0,0,'Como tomar medidas de una habitacion?','2004-12-31',1),
	(3,1,1,'2014-06-24 16:24:24','2011-12-31','2007-12-31',0,0,'Materiales saludables para tu casa [3]','el texto [3]',0),
	(4,1,2,'2014-06-24 16:24:24','2014-09-10','2014-07-01',0,0,'Cambiar los muebles de lugar [4]','el texto [4]',0),
	(6,1,2,'2014-06-24 16:24:24','2015-01-07','2007-12-31',0,0,'DÃ³nde meto a las visitas','el texto [6]',0),
	(7,1,1,'2014-06-24 16:24:24','2011-12-31','2007-12-31',0,0,'Seguridad infantil y accidentes en casa [7]','el texto [7]',0),
	(8,1,0,'2014-06-24 16:24:24','2014-12-03','2015-01-29',0,0,'Donde meto los cables [8]','el texto [8]',0),
	(9,1,1,'2014-06-24 16:24:24','2014-12-03','2015-01-29',0,0,'No encuentro mis cosas [9]','el texto [9]',0),
	(10,1,2,'2014-06-24 16:24:24','2014-09-01','2014-11-12',0,0,'Como busco un piso para comprar o alquilar [10]','el texto [10]',0),
	(11,1,1,'2014-06-24 16:24:24','2013-12-31','2007-12-31',0,0,'Para que uso mis muebles [11]','el texto [11]',0),
	(12,1,2,'2014-06-24 16:24:24','2014-12-31','2015-10-01',0,0,'Las nuevas ciudades inteligentes [12]','el texto [12]',0),
	(14,1,1,'2014-06-30 13:02:13','2014-09-19','2014-11-06',0,0,'Antes de ir a Ikea [2]','2014-07-20',1),
	(16,1,2,'2014-06-30 13:22:48','2014-10-07','2014-11-12',0,0,'Antes de ir a Ikea [3]','[1] Text: Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',0),
	(17,1,0,'2014-07-08 10:22:47',NULL,NULL,0,0,NULL,NULL,0),
	(22,1,0,'2014-07-08 10:43:22',NULL,NULL,0,0,'articulo de mi mundo',NULL,0),
	(23,1,0,'2014-07-08 10:43:58',NULL,NULL,0,0,'articulo mi cuerpo',NULL,0),
	(24,1,0,'2014-07-08 10:45:07',NULL,NULL,0,0,'aaaa',NULL,0),
	(26,1,0,'2014-07-08 10:46:26',NULL,NULL,0,0,'nuevo mis hijos',NULL,0),
	(77,1,0,'2014-07-08 12:47:35',NULL,NULL,0,0,'Interpol',NULL,0),
	(80,1,0,'2014-07-08 12:52:31',NULL,NULL,0,0,'asdasdasd asd addsad as',NULL,0),
	(86,1,2,'2014-07-08 12:55:02','2014-08-01',NULL,0,0,'Quiero vender mi aspiradora','y meto el texto',0),
	(89,1,2,'2014-07-08 12:59:24','2014-07-23',NULL,0,0,'Dime Rebeca x',NULL,0),
	(90,1,0,'2014-07-08 12:59:24',NULL,NULL,0,0,'Dime Rebeca',NULL,0),
	(91,1,2,'2014-07-08 13:00:13','2014-07-23',NULL,0,0,'Dime Francisco',NULL,0),
	(92,1,2,'2014-07-08 13:00:37','2014-07-15','2015-06-16',0,0,'Dime Damaris',NULL,1),
	(95,1,0,'2014-07-08 13:02:38',NULL,NULL,0,0,'Tell me Robert',NULL,0),
	(96,1,1,'2014-07-08 13:02:59',NULL,NULL,0,0,'Are you Jacobson?','in this place',0),
	(108,1,1,'2014-07-10 13:42:24',NULL,'2014-11-14',0,0,'00 00 00 00 00 00 hola si','text me my friend',1),
	(109,2,0,'2014-07-13 09:26:44',NULL,NULL,0,0,'diapo 1 bis','el texto de la diapo',0),
	(110,2,1,'2014-07-13 09:26:50',NULL,NULL,0,0,'diapo 2',NULL,0),
	(111,2,2,'2014-07-13 09:26:56','2014-08-02',NULL,0,0,'diapo 3',NULL,0),
	(113,1,1,'2014-07-13 11:35:10',NULL,NULL,0,0,'000 en mi mundo si',NULL,0),
	(114,2,0,'2014-07-13 11:35:24',NULL,NULL,0,0,'diapo 4 la cuatro si','y su texto tambien',0),
	(115,2,0,'2014-07-13 12:31:00',NULL,NULL,0,0,'nou diapo',NULL,0),
	(116,1,0,'2014-07-13 12:31:15',NULL,NULL,0,0,'0000 nou article',NULL,0);

/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla content_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content_type`;

CREATE TABLE `content_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `content_type` WRITE;
/*!40000 ALTER TABLE `content_type` DISABLE KEYS */;

INSERT INTO `content_type` (`id`, `name`)
VALUES
	(1,'Article'),
	(2,'Diapo'),
	(3,'Link');

/*!40000 ALTER TABLE `content_type` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla diapo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `diapo`;

CREATE TABLE `diapo` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `diapo` WRITE;
/*!40000 ALTER TABLE `diapo` DISABLE KEYS */;

INSERT INTO `diapo` (`content_id`)
VALUES
	(109),
	(110),
	(111),
	(114),
	(115);

/*!40000 ALTER TABLE `diapo` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla link
# ------------------------------------------------------------

DROP TABLE IF EXISTS `link`;

CREATE TABLE `link` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla section
# ------------------------------------------------------------

DROP TABLE IF EXISTS `section`;

CREATE TABLE `section` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `section` WRITE;
/*!40000 ALTER TABLE `section` DISABLE KEYS */;

INSERT INTO `section` (`id`, `name`)
VALUES
	(1,'Mi cuerpo'),
	(2,'Mis hijos'),
	(3,'Mi casa'),
	(4,'Mi ciudad'),
	(5,'Mi mundo');

/*!40000 ALTER TABLE `section` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `password` char(35) NOT NULL DEFAULT '',
  `status` int(11) DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `password`, `status`, `email`)
VALUES
	(2,'sidiar','4b64faf979470b8a405cbf3801179751',1,'ariel@sidiar.net');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
