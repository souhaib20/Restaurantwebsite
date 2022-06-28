-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 25 mai 2021 à 09:54
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `restaurant_website`
--

-- --------------------------------------------------------

--
-- Structure de la table `chefs`
--

DROP TABLE IF EXISTS `chefs`;
CREATE TABLE IF NOT EXISTS `chefs` (
  `chef_id` int(2) NOT NULL,
  `chef_name` varchar(30) NOT NULL,
  PRIMARY KEY (`chef_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chefs`
--

INSERT INTO `chefs` (`chef_id`, `chef_name`) VALUES
(1, 'Souhaib halli'),
(2, 'Youssef lachguer'),
(3, 'Hamza rafik');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(5) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(50) NOT NULL,
  `client_phone` varchar(20) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `client_phone`, `client_email`) VALUES
(9, 'Idriss Jairi', '0634308303', 'qsdqsdq@gmail.com'),
(10, 'Khalid Lee', '0638383933', 'khalid.lee@gmail.com'),
(11, 'Keltoum', '06242556272', 'keltoum.ar@gmail.com'),
(13, 'Shukhrat Nayimov', '030303030202', 'shukh.nayi@gmail.com'),
(14, 'Khalid Essaidani', '030303030', 'khalid.essaidani@yahoo.fr'),
(15, 'souhaib halli', '0624583391', 'souhaib.halli19@gmail.com'),
(16, 'hamza rafik', '06764769589598', 'rafikrafik@gmail.com'),
(17, 'halli souhaib', '09379635796785', 'hallisouhaib67@gmail.com'),
(18, 'amine', '09379635796567', 'amine2000@gmail.com'),
(19, 'halli souhaib', '09379635796785', 'hallisouhaib67@gmail.com'),
(20, 'halli souhaib', '09379635796785', 'hallisouhaib67@gmail.com'),
(21, 'amine', '093796357957', 'amine@gmail.com'),
(22, 'amine bagui', '0937963579645', 'aminebagui@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE IF NOT EXISTS `deliveries` (
  `delivery_id` int(2) NOT NULL,
  `delivery_name` varchar(30) NOT NULL,
  `delivery_statuts` tinyint(1) NOT NULL,
  `delivery_photo` varchar(200) NOT NULL,
  PRIMARY KEY (`delivery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `deliveries`
--

INSERT INTO `deliveries` (`delivery_id`, `delivery_name`, `delivery_statuts`, `delivery_photo`) VALUES
(1, 'amine', 0, ''),
(2, 'samir', 0, ''),
(3, 'ahmed', 0, ''),
(4, 'achraf', 0, ''),
(5, 'mourad', 0, ''),
(6, 'said', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `details_ordes`
--

DROP TABLE IF EXISTS `details_ordes`;
CREATE TABLE IF NOT EXISTS `details_ordes` (
  `quantity` int(3) NOT NULL,
  `menu_id` int(5) NOT NULL,
  `order_id` int(5) NOT NULL,
  KEY `fk_menu` (`menu_id`),
  KEY `fk_order` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `image_gallery`
--

DROP TABLE IF EXISTS `image_gallery`;
CREATE TABLE IF NOT EXISTS `image_gallery` (
  `image_id` int(2) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image_gallery`
--

INSERT INTO `image_gallery` (`image_id`, `image_name`, `image`) VALUES
(1, 'moroccan tajine', '58146_Moroccan Chicken Tagine.jpeg'),
(2, 'Italian Pasta', 'img_1.jpg'),
(3, 'Cook', 'img_2.jpg'),
(4, 'Pizza', 'img_3.jpg'),
(5, 'Burger', 'burger.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `in_order`
--

DROP TABLE IF EXISTS `in_order`;
CREATE TABLE IF NOT EXISTS `in_order` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `order_id` int(5) NOT NULL,
  `menu_id` int(5) NOT NULL,
  `quantity` int(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_menu` (`menu_id`),
  KEY `fk_order` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `in_order`
--

INSERT INTO `in_order` (`id`, `order_id`, `menu_id`, `quantity`) VALUES
(3, 7, 13, 1),
(4, 7, 11, 1),
(5, 8, 1, 1),
(6, 8, 2, 1),
(7, 9, 11, 1),
(8, 10, 1, 1),
(9, 10, 6, 1),
(10, 10, 8, 1),
(11, 10, 10, 1),
(12, 11, 1, 1),
(13, 11, 4, 1),
(14, 11, 6, 1),
(15, 11, 8, 1),
(16, 11, 15, 1),
(17, 12, 17, 1),
(18, 12, 3, 1),
(19, 12, 6, 1),
(20, 12, 9, 1),
(21, 13, 5, 1),
(22, 14, 17, 1),
(23, 14, 3, 1),
(24, 14, 6, 1),
(25, 14, 9, 1),
(26, 15, 17, 1),
(27, 15, 3, 1),
(28, 15, 6, 1),
(29, 15, 9, 1),
(30, 16, 1, 1),
(31, 16, 5, 1),
(32, 16, 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `menu_id` int(2) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(20) NOT NULL,
  `menu_description` varchar(255) NOT NULL,
  `menu_price` decimal(4,2) NOT NULL,
  `menu_image` varchar(255) NOT NULL,
  `category_id` int(2) NOT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `FK_menu_category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_name`, `menu_description`, `menu_price`, `menu_image`, `category_id`) VALUES
(1, 'Xincent Burger', 'Classic marinara sauce', '14.00', '59211_lunch-9.jpg', 1),
(2, 'Margherita', 'Classic marinara sauce, authentic old-world pepperoni.', '3.80', 'burger.jpeg', 1),
(3, 'Amarretti', 'Classic marinara sauce, authentic old-world pepperoni.', '7.50', 'summer-dessert-sweet-ice-cream.jpg', 2),
(4, 'Bostrengo', 'Classic marinara sauce, authentic old-world pepperoni.', '4.50', 'summer-dessert-sweet-ice-cream.jpg', 2),
(5, 'Late Vegetale', 'Classic marinara sauce, authentic old-world pepperoni.', '10.00', 'coffee.jpeg', 3),
(6, 'Ice Tea', 'Classic marinara sauce, authentic old-world pepperoni.', '3.20', 'coffee.jpeg', 3),
(7, 'Bucatini', 'Classic marinara sauce, authentic old-world pepperoni.', '20.00', 'macaroni.jpeg', 4),
(8, 'Cannelloni', 'Classic marinara sauce, authentic old-world pepperoni.', '10.00', 'cooked_pasta.jpeg', 4),
(9, 'Margherita', 'Classic marinara sauce, authentic old-world pepperoni.', '24.00', 'pizza.jpeg', 5),
(10, 'Diablo', 'Classic marinara sauce, authentic old-world pepperoni.', '10.00', 'pizza_plate.jpeg', 5),
(11, 'Tajine', 'Moroccan Tagine in China', '20.00', '58146_Moroccan Chicken Tagine.jpeg', 1),
(13, 'COUSCOUS', 'COUSCOUS BIL ADASS', '99.99', '68526_57738_w1024h768c1cx256cy192.jpg', 4),
(15, 'TEST NAME', 'TETTE TSTSTSTS', '20.00', '61131_1200px-Flag_of_Morocco.svg.png', 5),
(16, 'Couscous', 'Moroccan Couscous', '20.00', '76635_57738_w1024h768c1cx256cy192.jpg', 1),
(17, 'tacos', 'tacos dinde', '23.00', '1391_breakfast-1.jpg', 1),
(18, 'fraise', 'fraise cool', '20.00', '6763_dessert-4.jpg', 1),
(19, 'Olmeca', 'Dark chocolate', '50.00', '33730_wine-8.jpg', 7),
(20, 'Beer', 'heinkein // spéciale', '12.00', '18088_drink-4.jpg', 7);

-- --------------------------------------------------------

--
-- Structure de la table `menu_categories`
--

DROP TABLE IF EXISTS `menu_categories`;
CREATE TABLE IF NOT EXISTS `menu_categories` (
  `category_id` int(2) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(15) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `menu_categories`
--

INSERT INTO `menu_categories` (`category_id`, `category_name`) VALUES
(1, 'burgers'),
(2, 'desserts'),
(3, 'drinks'),
(4, 'pasta'),
(5, 'pizzas'),
(6, 'Diner'),
(7, 'Apero');

-- --------------------------------------------------------

--
-- Structure de la table `placed_orders`
--

DROP TABLE IF EXISTS `placed_orders`;
CREATE TABLE IF NOT EXISTS `placed_orders` (
  `order_id` int(5) NOT NULL AUTO_INCREMENT,
  `order_time` datetime NOT NULL,
  `client_id` int(5) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `delivered` tinyint(1) NOT NULL DEFAULT '0',
  `canceled` tinyint(1) NOT NULL DEFAULT '0',
  `cancellation_reason` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `fk_client` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `placed_orders`
--

INSERT INTO `placed_orders` (`order_id`, `order_time`, `client_id`, `delivery_address`, `delivered`, `canceled`, `cancellation_reason`) VALUES
(7, '2020-06-22 12:01:00', 9, 'Bloc A Nr 80000 Hay El Houda Agadir', 0, 1, 'Sorry! I changed my mind!'),
(8, '2020-06-23 06:07:00', 10, 'Chengdu, China', 1, 0, ''),
(9, '2020-06-24 16:40:00', 11, 'Hay El Houda Agadir', 1, 0, NULL),
(10, '2021-04-22 07:54:00', 15, 'Hay assaka bloc D numero 276, tikiouine, agadir', 0, 1, 'busy'),
(11, '2021-04-23 20:52:00', 16, 'agadir ekasbah', 1, 0, NULL),
(12, '2021-04-25 12:52:00', 17, 'agadir hay el houda', 1, 0, NULL),
(13, '2021-04-25 17:42:00', 18, 'agadir salam', 1, 0, NULL),
(14, '2021-04-25 18:17:00', 19, 'agadir hay el houda', 1, 0, NULL),
(15, '2021-04-26 05:19:00', 20, 'agadir hay el houda', 0, 1, 'off'),
(16, '2021-04-27 07:51:00', 21, 'agadir lhouda', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `reservation_id` int(5) NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `client_id` int(5) NOT NULL,
  `selected_time` datetime NOT NULL,
  `nbr_guests` int(2) NOT NULL,
  `table_id` int(3) NOT NULL,
  `liberated` tinyint(1) NOT NULL DEFAULT '0',
  `canceled` tinyint(1) NOT NULL DEFAULT '0',
  `cancellation_reason` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `date_created`, `client_id`, `selected_time`, `nbr_guests`, `table_id`, `liberated`, `canceled`, `cancellation_reason`) VALUES
(1, '2020-07-18 09:07:00', 13, '2020-07-30 09:07:00', 0, 1, 0, 0, NULL),
(2, '2020-07-18 09:11:00', 14, '2020-07-29 13:00:00', 4, 1, 0, 0, NULL),
(3, '2021-05-10 21:39:00', 22, '2021-05-11 21:37:00', 1, 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tables`
--

DROP TABLE IF EXISTS `tables`;
CREATE TABLE IF NOT EXISTS `tables` (
  `table_id` int(3) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tables`
--

INSERT INTO `tables` (`table_id`) VALUES
(1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `full_name`, `password`) VALUES
(1, 'jairi', 'test_test@gmail.com', 'Idriss Jairi', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441');

-- --------------------------------------------------------

--
-- Structure de la table `website_settings`
--

DROP TABLE IF EXISTS `website_settings`;
CREATE TABLE IF NOT EXISTS `website_settings` (
  `option_id` int(5) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL,
  `option_value` varchar(255) NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `website_settings`
--

INSERT INTO `website_settings` (`option_id`, `option_name`, `option_value`) VALUES
(1, 'restaurant_name', 'VINCENT PIZZA'),
(2, 'restaurant_email', 'vincent.pizza@gmail.com'),
(3, 'admin_email', 'drissjiri@gmail.com'),
(4, 'restaurant_phonenumber', '088866777555'),
(5, 'restaurant_address', '1580  Boone Street, Corpus Christi, TX, 78476 - USA');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `in_order`
--
ALTER TABLE `in_order`
  ADD CONSTRAINT `fk_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`menu_id`),
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`order_id`) REFERENCES `placed_orders` (`order_id`);

--
-- Contraintes pour la table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `FK_menu_category_id` FOREIGN KEY (`category_id`) REFERENCES `menu_categories` (`category_id`);

--
-- Contraintes pour la table `placed_orders`
--
ALTER TABLE `placed_orders`
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
