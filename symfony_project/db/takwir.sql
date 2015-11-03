-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.6.21-log - MySQL Community Server (GPL)
-- Serveur OS:                   Win64
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de table takwir. match
CREATE TABLE IF NOT EXISTS `match` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `buts` int(11) NOT NULL,
  `terrain` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `type` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `classe` int(11) NOT NULL,
  `res` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `note` float NOT NULL DEFAULT '0',
  `comment` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `saison` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `injury` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Export de données de la table takwir.match: ~85 rows (environ)
/*!40000 ALTER TABLE `match` DISABLE KEYS */;
INSERT INTO `match` (`id`, `date`, `buts`, `terrain`, `type`, `classe`, `res`, `note`, `comment`, `saison`, `injury`) VALUES
	(1, '2014-08-01', 0, 's', 'm', 2, 'd', 3, NULL, '14-15', 0),
	(2, '2014-08-15', 3, 's', 'm', 2, 'd', 6, 'Attaquant', '14-15', 0),
	(3, '2014-08-24', 0, 's', 't', 2, 'd', 4, NULL, '14-15', 0),
	(4, '2014-08-26', 0, 's', 't', 3, 'd', 3, NULL, '14-15', 0),
	(5, '2014-08-29', 0, 's', 'm', 2, 'd', 4, NULL, '14-15', 0),
	(6, '2014-09-03', 2, 'b', 'b', 1, 'd', 6, NULL, '14-15', 0),
	(7, '2014-09-05', 0, 's', 'm', 3, 'd', 4, NULL, '14-15', 0),
	(8, '2014-09-08', 0, 'l', 'c', 2, 'd', 7, NULL, '14-15', 0),
	(9, '2014-09-10', 5, 's', 'b', 1, 'd', 7, NULL, '14-15', 0),
	(10, '2014-09-11', 2, 'o', 'm', 2, 'd', 6, NULL, '14-15', 0),
	(11, '2014-09-12', 1, 's', 'm', 2, 'v', 7, NULL, '14-15', 0),
	(12, '2014-09-15', 2, 'o', 'm', 4, 'v', 7, 'Défenseur central gauche', '14-15', 0),
	(13, '2014-09-17', 2, 'b', 'b', 1, 'd', 4, 'physiquement très épuisé', '14-15', 0),
	(14, '2014-09-19', 2, 's', 'm', 2, 'v', 5, NULL, '14-15', 0),
	(15, '2014-09-22', 3, 'l', 'm', 3, 'v', 6, 'équipe adverse manque un joueur;plusieurs assists ', '14-15', 0),
	(16, '2014-09-25', 1, 'l', 'm', 3, 'v', 6, 'aillier gauche;discipline tactique;pas efficace dans la récupération;plusieurs montées et retour;pas de tirs;perdu quelques balles sur des dribbles non réussis et deux mauvais contrôles', '14-15', 0),
	(17, '2014-09-26', 4, 's', 'm', 2, 'v', 6, NULL, '14-15', 0),
	(18, '2014-09-29', 0, 'o', 'm', 4, 'd', 6, NULL, '14-15', 0),
	(19, '2014-09-30', 1, 's', 'm', 1, 'd', 4, 'pas de motivation et physiquement épuisé', '14-15', 0),
	(20, '2014-10-04', 2, 'o', 'm', 4, 'd', 6, 'premier but avec la tête;les deux buts suite à des corners;défenseur central gauche;jour de l\'aid', '14-15', 0),
	(21, '2014-10-10', 4, 'o', 'b', 1, 'v', 6, NULL, '14-15', 0),
	(22, '2014-10-11', 0, 'o', 'm', 4, 'd', 5, 'notre équipe manque beaucoup de joueurs;qq dribbles réussis', '14-15', 0),
	(23, '2014-10-13', 0, 'l', 'c', 3, 'v', 6, NULL, '14-15', 0),
	(24, '2014-10-17', 1, 's', 'm', 2, 'd', 5, NULL, '14-15', 0),
	(25, '2014-10-20', 0, 'l', 'c', 3, 'v', 6, NULL, '14-15', 0),
	(26, '2014-10-27', 0, 'l', 'c', 3, 'v', 7, 'bonne prestation sur le plan défensif avec 3 passes décisives de buts;contre ariana 7-0', '14-15', 0),
	(27, '2014-10-24', 1, 's', 'm', 2, 'd', 6, 'match très faible, manque de joueurs', '14-15', 0),
	(28, '2014-11-03', 0, 'l', 'c', 3, 'v', 7, 'victoire contre équipe jbal', '14-15', 0),
	(29, '2014-10-30', 2, 'l', 'c', 3, 'v', 6, 'victoire contre équipe jbal', '14-15', 0),
	(30, '2014-10-29', 2, 's', 'b', 1, 'd', 5, NULL, '14-15', 0),
	(31, '2014-11-10', 4, 'l', 'c', 3, 'v', 8, 'bonne prestation et victoire convaincante de 14-1; contre bab assal', '14-15', 0),
	(32, '2014-11-17', 0, 'l', 'c', 4, 'v', 6, 'victoire contre hay el Intilaka de 7-3; bonne prestation sur le plan défensif; beaucoup de précipité sur le plan offensif et des fautes commises', '14-15', 0),
	(33, '2014-11-13', 3, 'l', 'c', 1, 'v', 6, 'match très faible avec citroen', '14-15', 0),
	(34, '2014-11-24', 1, 'l', 'c', 4, 'v', 7, 'contre hay ibn khaldoun 2-0', '14-15', 0),
	(35, '2014-11-27', 2, 'l', 'c', 3, 'v', 6, 'contre calimero 15-0', '14-15', 0),
	(36, '2014-11-19', 4, 'o', 'b', 1, 'd', 6, NULL, '14-15', 0),
	(37, '2014-12-12', 1, 's', 'm', 4, 'v', 8, 'arrière droit-contre el gass', '14-15', 0),
	(38, '2014-12-15', 3, 'l', 'c', 4, 'v', 8, 'contre zahrouni,bonne prestation sur le plan offensif', '14-15', 0),
	(39, '2014-12-19', 2, 's', 'm', 2, 'd', 6, NULL, '14-15', 0),
	(40, '2014-12-22', 0, 'l', 'c', 4, 'v', 7, 'contre zahrouni-victoire 3-0-dribbles réussis', '14-15', 0),
	(41, '2014-12-27', 4, 's', 'm', 2, 'v', 7, 'retrouver les réflexes de dribbles', '14-15', 0),
	(42, '2014-12-30', 4, 's', 'm', 1, 'v', 8, 'plusieurs dribbles réussis', '14-15', 0),
	(43, '2015-01-02', 5, 's', 'm', 2, 'd', 8, 'un but en cout de ciseaux magistral, 5 buts de haute qualité, plusieurs dribbles réussis', '14-15', 0),
	(44, '2015-01-05', 0, 'l', 'c', 4, 'd', 6, 'première défaite conte bab assal 1-0', '14-15', 0),
	(45, '2015-01-28', 3, 'o', 'b', 1, 'v', 7, '', '14-15', 0),
	(46, '2015-01-23', 1, 's', 'm', 2, 'd', 6, '', '14-15', 0),
	(47, '2015-01-12', 1, 'l', 'c', 3, 'v', 8, 'contre agence citroen;plusieurs dribbles réussis , des passes décisives.', '14-15', 0),
	(48, '2015-02-05', 7, 'o', 'b', 2, 'd', 8, '', '14-15', 0),
	(49, '2015-02-09', 0, 'l', 'c', 4, 'v', 4, 'Victoire contre bab assal 2-0; match médiocre vu changements dans la formation', '14-15', 0),
	(50, '2015-02-11', 3, 'o', 'b', 1, 'd', 7, '', '14-15', 0),
	(51, '2015-02-20', 2, 's', 'm', 2, 'v', 6, 'très jolie buts tir enveloppé', '14-15', 0),
	(52, '2015-02-16', 0, 'l', 'c', 2, 'v', 7, 'citroen prépare son tournoi;deux passes de buts de très haute qualité', '14-15', 0),
	(53, '2015-02-24', 3, 'l', 'c', 2, 'd', 7, '', '14-15', 0),
	(54, '2015-03-02', 2, 'l', 'c', 3, 'n', 8, '', '14-15', 0),
	(55, '2015-02-27', 1, 's', 'm', 2, 'v', 7, '', '14-15', 0),
	(56, '2015-03-30', 2, 'l', 'c', 3, 'v', 7, '', '14-15', 0),
	(57, '2015-03-23', 0, 'l', 'c', 3, 'd', 7, '', '14-15', 0),
	(58, '2015-03-20', 3, 's', 'm', 2, 'd', 7, '', '14-15', 0),
	(59, '2015-04-03', 3, 's', 'm', 2, 'v', 7, '', '14-15', 0),
	(60, '2015-04-13', 1, 'l', 'c', 2, 'v', 7, 'plusieurs matchs de petite durée', '14-15', 0),
	(61, '2015-04-10', 3, 's', 'm', 3, 'v', 8, '', '14-15', 0),
	(62, '2015-04-06', 0, 'l', 'c', 4, 'd', 7, 'deux passes décisifs pour deux buts;contre jbal;arrière droit', '14-15', 0),
	(63, '2015-04-17', 0, 's', 'm', 2, 'd', 6, '', '14-15', 0),
	(64, '2015-04-15', 2, 'o', 'b', 1, 'd', 6, '', '14-15', 0),
	(65, '2015-04-19', 2, 's', 'm', 3, 'v', 8, 'Contre ariana,Meilleur match de la saison, plusieurs passes décisives et récupération dans le milieu', '14-15', 0),
	(66, '2015-04-23', 5, 'o', 'b', 2, 'v', 7, 'Contre Focus', '14-15', 0),
	(67, '2015-04-26', 1, 's', 'm', 4, 'n', 8, 'Contre ariana, défaite 1-0, évolué en tant qu\'arrière central, but sur coup de franc directe', '14-15', 0),
	(68, '2015-04-24', 3, 's', 'm', 3, 'v', 8, '', '14-15', 0),
	(69, '2015-05-18', 1, 'l', 'c', 3, 'v', 7, '', '14-15', 0),
	(70, '2015-05-11', 0, 'l', 'c', 3, 'v', 6, '', '14-15', 0),
	(71, '2015-05-14', 3, 'o', 'b', 2, 'd', 7, '', '14-15', 0),
	(72, '2015-05-01', 1, 's', 'm', 2, 'd', 6, '', '14-15', 0),
	(73, '2015-06-16', 6, 'o', 'b', 2, 'v', 7, 'victoire après 8 buts de retard', '14-15', 0),
	(74, '2015-06-11', 5, 's', 'b', 3, 'n', 7, 'Contre Focus, match null', '14-15', 0),
	(75, '2015-06-08', 0, 'l', 'c', 4, 'd', 6, 'défaite humiliante contre équipe Sou;pas de gardien;équipe manque de joueurs de qualité', '14-15', 0),
	(76, '2015-07-23', 6, 's', 'b', 2, 'v', 7, 'match contre focus, victoire de 8 à 0', '15-16', 0),
	(77, '2015-07-24', 2, 's', 'm', 3, 'v', 6, 'deux jolie buts + débordement de l\'aile et passe de but', '15-16', 0),
	(78, '2015-07-29', 5, 's', 'b', 2, 'v', 7, 'contre focus 10-0, physiquement pas toujours prêt', '15-16', 0),
	(79, '2015-08-05', 2, 's', 'b', 1, 'v', 6, 'douleur au niveau du cuisse', '15-16', 0),
	(80, '2015-08-04', 1, 's', 'm', 3, 'v', 5, 'douleru au niveau du cuisse;jouer en tant que défenseur central', '15-16', 0),
	(81, '2015-07-31', 2, 's', 'm', 2, 'v', 6, 'physqieuemnt pas prêt ;douleur au niveau du cuisse', '15-16', 0),
	(82, '2015-08-21', 1, 's', 'm', 2, 'd', 6, 'but sur coup de front directe;joué avec 5 + goal;équipe médiocre', '15-16', 0),
	(83, '2015-08-11', 3, 's', 'b', 1, 'v', 6, 'match durant le congé', '15-16', 0),
	(84, '2015-08-28', 1, 's', 'm', 3, 'd', 6.75, 'jolie but , tir enveloppé en 90', '15-16', 0),
	(89, '2015-09-01', 0, 's', 'm', 3, 'v', 8, 'défence central', '15-16', 0);
/*!40000 ALTER TABLE `match` ENABLE KEYS */;


-- Export de la structure de table takwir. terrain
CREATE TABLE IF NOT EXISTS `terrain` (
  `id` char(1) NOT NULL,
  `lib` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table takwir.terrain: ~0 rows (environ)
/*!40000 ALTER TABLE `terrain` DISABLE KEYS */;
INSERT INTO `terrain` (`id`, `lib`) VALUES
	('b', 'Borj Touil'),
	('l', 'Lac'),
	('o', 'Orange'),
	('s', 'Soccer');
/*!40000 ALTER TABLE `terrain` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
