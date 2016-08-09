-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 04 Août 2016 à 21:00
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `coodmin`
--

-- --------------------------------------------------------

--
-- Structure de la table `bids`
--

CREATE TABLE IF NOT EXISTS `bids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seller` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `descriptive` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `estimated_price` int(11) NOT NULL,
  `mini_price` int(11) NOT NULL,
  `duration_bid` int(11) NOT NULL,
  `end_bid` int(11) NOT NULL DEFAULT '0',
  `image` varchar(100) NOT NULL DEFAULT '../img/bids/0.jpg',
  `verified` tinyint(1) DEFAULT '0',
  `sold` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `bids`
--

INSERT INTO `bids` (`id`, `seller`, `title`, `descriptive`, `category`, `estimated_price`, `mini_price`, `duration_bid`, `end_bid`, `image`, `verified`, `sold`) VALUES
(3, 10, 'Peugoeot', 'Dsvfskvsvkjwnvkwjnvwkjvnwkrvbjn wkvbjn wknj 21', 2, 2147483647, 959846626, 120, 1469185244, '../img/bids/0.jpg', 1, 0),
(4, 10, 'Slut', 'Sutltultutl', 4, 5145, 1541, 3600, 1469185303, '../img/bids/0.jpg', 1, 0),
(5, 10, 'Sasas', 'Sasasasasasas', 2, 54, 41, 3600, 1469189108, '../img/bids/0.jpg', 1, 0),
(7, 10, 'Ekehvrjh', 'Vwjhrwjh', 1, 5656, 669, 3600, 1469194466, '../img/bids/0.jpg', 1, 0),
(8, 10, 'Parvati', 'Msi neuf importante', 3, 2147483647, 2147483647, 3600, 1469193004, '../img/bids/0.jpg', 1, 0),
(9, 10, 'Bjkjvnlkejlbovki', 'Vjknewbvnkewjnvkwjentv', 3, 57, 57, 3600, 1469194465, '../img/bids/0.jpg', 1, 0),
(10, 10, 'Test 1', 'Test 1', 1, 1, 1, 86400, 1469297717, '../img/bids/0.jpg', 1, 0),
(11, 10, 'Test 2', 'Test 2', 1, 2, 2, 172800, 1469384118, '../img/bids/0.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `bid_user`
--

CREATE TABLE IF NOT EXISTS `bid_user` (
  `id` int(11) NOT NULL,
  `id_bid` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `bet_money` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'V&eacutehicule'),
(2, 'Immobilier'),
(3, 'Multimedia'),
(4, 'Maison'),
(5, 'Loisirs'),
(6, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(4) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `password` char(60) NOT NULL,
  `access_token` char(32) NOT NULL,
  `admin` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `type`, `surname`, `name`, `pseudo`, `email`, `tel`, `password`, `access_token`, `admin`) VALUES
(1, 'Mme', 'Pute', 'Asas', 'salutsalut', 'salut@salut.fr', '', '$2y$10$m671YPW9P.2AQLbnNfeZtOLFirQCiiQi6Kxqf/05.JPsZBtHO4uwS', '8a89029280f8fcb0c77ad7358f0cd834', 0),
(2, 'Mr', 'Monsieur', 'Monsiedu', 'Monon', 'monmon@htoa.fr', '0695688618', '$2y$10$ZFjwQKIa.LBSBfebde8dcOV93mjkfd41bCbENzbW3bfZLYZeFI5jK', '4bd5b938bb6a821ac9a88c97fff9c2ba', 0),
(3, 'Mr', 'Monsieur', 'Monsiedu', 'Monon', 'monmon@htoa.fr', '0695688618', '$2y$10$HLydjZhlxjT3goZPd69oR.zS4x2Zxu1nSh1Kb8gIv.Ghl9.UMrDTi', '3d5344e70fb1b68726b8c4b4b62cafaf', 0),
(4, 'Mr', 'Monsieur', 'Monsiedu', 'Monon', 'monmon@htoa.fr', '0695688618', '$2y$10$E8kUoSe4JoRI8tBoOAPUieBgyVrZEanhxRecnhccyMF2AAJp5gH4e', '497062f43996bb69f80bf2a435d1d6c4', 0),
(5, 'Mme', 'Qeffe', 'Qfdf', 'Qfdqfqf', 'monmon@htoa.fr', '0695688618', '$2y$10$rgMfDmJ6XZBmTqCVH1izs.h4hAa1PRu7DcNJYzP7fTH8Ru4vNJZHC', '75df34f1feaa23bebb4076a8fd1213e8', 0),
(6, 'Mr', 'Wew', 'Wef', 'Wfwe', 'salut@salut.fr', '0695688618', '$2y$10$ADKEdN6oKbX/pVii3RZKw.iZF4.8q6WyLwNarWtsrkEefxrxvhrZe', '8a89029280f8fcb0c77ad7358f0cd834', 0),
(7, 'Mme', 'Wew', 'Wef', 'Wfwe', 'salut@salut.fr', '0695688618', '$2y$10$mNKzZdYGi60yW2kyzIpKyuZRc3LCxVNlRM.xGkDBQOswAFnSP.e1m', '8a89029280f8fcb0c77ad7358f0cd834', 0),
(8, 'Mr', 'Salut', 'Salut', 'Salut', 'salut@salut.fr', '0695688618', '$2y$10$As0IGqpg2/190i.PogqIfOuvZwxgJofnU2556kPwsnLey6n1m/mEe', '8a89029280f8fcb0c77ad7358f0cd834', 0),
(9, 'Mr', 'Salut', 'Salut', 'Salut', 'salut@salut.fr', '0695688618', '$2y$10$jCktlx7rJgWwti.BXgNSCeec5TEHuaYYeI/WhXLF4JVKHEBsn1jx.', '8a89029280f8fcb0c77ad7358f0cd834', 0),
(10, 'Mr.', 'Swann', 'Kaulanjan', 'Gildarytzs', 'swann.kaulanjan@laposte.net', '0695688618', '$2y$10$mQRJEeqnGfTimoTPzg57Xe/zl8UXAS.9UwoTncHVuULLwY0J5HwPK', '55cb125e48065bc82b3588b66f36aff7', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
