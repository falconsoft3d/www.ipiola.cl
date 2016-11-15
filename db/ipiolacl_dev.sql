-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-11-2016 a las 17:25:33
-- Versión del servidor: 5.6.34
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ipiolacl_dev`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `budget`
--

CREATE TABLE IF NOT EXISTS `budget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `building_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `totalCost` decimal(3,0) NOT NULL,
  `materialCost` decimal(3,0) NOT NULL,
  `labourCost` decimal(3,0) NOT NULL,
  `machineryCost` decimal(3,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_73F2F77B4D2A7E12` (`building_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `building`
--

CREATE TABLE IF NOT EXISTS `building` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `architect` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comments` longtext COLLATE utf8_unicode_ci,
  `image_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E16F61D47E3C61F9` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `building`
--

INSERT INTO `building` (`id`, `owner_id`, `name`, `date`, `architect`, `comments`, `image_name`) VALUES
(19, 23, 'Obra1 Obra1 Obra1', '2016-11-14', 'NombreArquitecto PrimerApellido Segundo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et dui vestibulum, bibendum purus sit amet, vulputate mauris. Ut adipiscing gravida tincidunt. Duis euismod placerat rhoncus. Phasellus mollis imperdiet placerat. Sed ac turpis nisl. Mauris at ante mauris. Aliquam posuere fermentum lorem, a aliquam mauris rutrum a. Curabitur sit amet pretium lectus, nec consequat orci.\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis et metus in libero sollicitudin venenatis eu sed enim. Nam felis lorem, suscipit ac nisl ac, iaculis dapibus tellus. Cras ante justo, aliquet quis placerat nec, molestie id turpis. Cras at tincidunt magna. Mauris aliquam sem sit amet dapibus venenatis. Sed metus orci, tincidunt sed fermentum non, ornare non quam. Aenean nec turpis at libero lobortis pretium.', 'demo/1.jpg'),
(20, 23, 'Obra2 Obra2 Obra2', '2016-11-14', 'NombreArquitecto PrimerApellido Segundo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et dui vestibulum, bibendum purus sit amet, vulputate mauris. Ut adipiscing gravida tincidunt. Duis euismod placerat rhoncus. Phasellus mollis imperdiet placerat. Sed ac turpis nisl. Mauris at ante mauris. Aliquam posuere fermentum lorem, a aliquam mauris rutrum a. Curabitur sit amet pretium lectus, nec consequat orci.\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis et metus in libero sollicitudin venenatis eu sed enim. Nam felis lorem, suscipit ac nisl ac, iaculis dapibus tellus. Cras ante justo, aliquet quis placerat nec, molestie id turpis. Cras at tincidunt magna. Mauris aliquam sem sit amet dapibus venenatis. Sed metus orci, tincidunt sed fermentum non, ornare non quam. Aenean nec turpis at libero lobortis pretium.', 'demo/2.jpg'),
(21, 24, 'Obra3 Obra3 Obra3', '2016-11-14', 'NombreArquitecto PrimerApellido Segundo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et dui vestibulum, bibendum purus sit amet, vulputate mauris. Ut adipiscing gravida tincidunt. Duis euismod placerat rhoncus. Phasellus mollis imperdiet placerat. Sed ac turpis nisl. Mauris at ante mauris. Aliquam posuere fermentum lorem, a aliquam mauris rutrum a. Curabitur sit amet pretium lectus, nec consequat orci.\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis et metus in libero sollicitudin venenatis eu sed enim. Nam felis lorem, suscipit ac nisl ac, iaculis dapibus tellus. Cras ante justo, aliquet quis placerat nec, molestie id turpis. Cras at tincidunt magna. Mauris aliquam sem sit amet dapibus venenatis. Sed metus orci, tincidunt sed fermentum non, ornare non quam. Aenean nec turpis at libero lobortis pretium.', 'demo/1.jpg'),
(23, 25, 'Hospital Norte', '2016-11-09', 'Juan Maria', 'Ejemplo', 'Desert.jpg'),
(24, 25, 'Edificio 23', '2016-11-24', 'Yohana', NULL, 'tiendaonlineacolor.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fos_user`
--

CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(22, 'dev', 'dev', 'dev@localhost.com', 'dev@localhost.com', 1, 'oh825j7iryo8ccgsgogs8ckws0cggoc', '$2y$13$oh825j7iryo8ccgsgogs8OWXsrqwyKipD3eN27H003pPKgxLR5dIe', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', 0, NULL),
(23, 'user1', 'user1', 'user1@localhost.com', 'user1@localhost.com', 1, 'qmi8k5z1vk008ggc8swc8wsk840g8c0', '$2y$13$qmi8k5z1vk008ggc8swc8uT.z3K54sXU1ia/5ZS8OphM8I3HqzphO', '2016-11-14 18:43:09', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL),
(24, 'user2', 'user2', 'user2@localhost.com', 'user2@localhost.com', 1, 'ej5pyk5sxy8ks4ss8ws0g0sccw0osw8', '$2y$13$ej5pyk5sxy8ks4ss8ws0guGTHKdJOAYj1wBf0n0t7pplDo183spCe', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL),
(25, 'falconsoft.3d', 'falconsoft.3d', 'falconsoft.3d@gmail.com', 'falconsoft.3d@gmail.com', 1, '84eu3b283i80g8g8swsg80k4gksss8k', '$2y$13$84eu3b283i80g8g8swsg8uqp2Dq3xsrcJC8a0A08HWtzktlXyoI5K', '2016-11-15 17:22:24', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `FK_73F2F77B4D2A7E12` FOREIGN KEY (`building_id`) REFERENCES `building` (`id`);

--
-- Filtros para la tabla `building`
--
ALTER TABLE `building`
  ADD CONSTRAINT `FK_E16F61D47E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
