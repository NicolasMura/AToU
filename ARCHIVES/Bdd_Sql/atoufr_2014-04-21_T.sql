-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 21 Avril 2014 à 11:02
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `atoufr`
--
CREATE DATABASE IF NOT EXISTS `atoufr` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `atoufr`;

-- --------------------------------------------------------

--
-- Structure de la table `actions_culturelles`
--

DROP TABLE IF EXISTS `actions_culturelles`;
CREATE TABLE IF NOT EXISTS `actions_culturelles` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `titreBloc` varchar(250) NOT NULL,
  `chapo` text NOT NULL,
  `interTitre` text NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `resume` text NOT NULL,
  `resumeMobile` text NOT NULL,
  `accroche` text NOT NULL,
  `verbatim` text NOT NULL,
  `verbatimAuteur` varchar(30) NOT NULL,
  `anneeCreation` year(4) NOT NULL,
  `duree` varchar(20) NOT NULL,
  `statut` enum('actionActuelle','actionPresente','actionAvenir','actionPrecedente') NOT NULL,
  `notesTitre` varchar(50) NOT NULL,
  `notesTexte` text NOT NULL,
  `notesAuteur` varchar(50) NOT NULL,
  `urlVideo` varchar(100) NOT NULL,
  `urlPresse` varchar(100) NOT NULL,
  `urlFiche` varchar(100) NOT NULL,
  `photosID` smallint(5) unsigned NOT NULL,
  `articlesID` smallint(5) unsigned NOT NULL,
  `representationsID` smallint(5) unsigned NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `actions_culturelles`
--

INSERT INTO `actions_culturelles` (`ID`, `titre`, `titreBloc`, `chapo`, `interTitre`, `auteur`, `resume`, `resumeMobile`, `accroche`, `verbatim`, `verbatimAuteur`, `anneeCreation`, `duree`, `statut`, `notesTitre`, `notesTexte`, `notesAuteur`, `urlVideo`, `urlPresse`, `urlFiche`, `photosID`, `articlesID`, `representationsID`, `active`) VALUES
(4, 'TransFORME', 'Créer, sensibiliser, tisser du lien', 'Soixante amateurs autour d’une pièce chorégraphique sur le thème de la transmission.', 'Votre message ici', '', 'Au delà d’une recherche esthétique dans laquelle trop souvent elle se retrouve enfermée, la danse est un solide outil de recherche personnelle, d’expression intime et de partage. AToU s’attache à faire découvrir cette facette au plus grand nombre, sous forme de rencontres publiques, d’ateliers hebdomadaires ou de stages sur plusieurs jours. Les séances sont toujours en lien avec le travail artistique de la compagnie et conduisent généralement à une création collective avec les participants.', 'Votre message ici', 'Votre message ici', '« C''est seulement la combinaison de 126 atomes qui constituent les milliards d''éléments de notre univers. Le flux vital traverse les formes, destinées à un perpétuel changement. Ainsi est régi notre corps, ainsi est régi notre mental : aucun des deux n''est semblable d''une seconde à l''autre. »', 'Anan Atoyama', 2010, '', 'actionPresente', 'Autour de la création', '« La musique est le langage de l''indétermination, parce qu''elle conduit avec elle plusieurs lignes de sens sans nous obliger à choisir. Elle ouvre par conséquent un horizon infini, indéfini. La musique est un rêve. »', 'Aurélien Marion-Gallois', '84222615', '', '', 0, 0, 0, 1),
(5, 'AC actuelle n°1', 'Créer, sensibiliser, tisser du lien', 'Votre message ici', 'Votre message ici', '', 'Votre message ici', 'Votre message ici', 'Votre message ici', '', '', 2013, '', 'actionActuelle', '', 'Votre message ici', '', '', '', '', 0, 0, 0, 1),
(6, 'Bab el Bal', 'Un projet réunissant plus de 300 participants pour le défilé de la Biennale de Lyon.', 'Votre message ici', 'Votre message ici', 'Auteur', 'Votre message ici', 'Votre message ici', 'Votre message ici', '', '', 2009, '', 'actionPrecedente', '', 'Votre message ici', '', '', '', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `actualites`
--

DROP TABLE IF EXISTS `actualites`;
CREATE TABLE IF NOT EXISTS `actualites` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `texte` text NOT NULL,
  `accroche` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `actualites`
--

INSERT INTO `actualites` (`ID`, `titre`, `texte`, `accroche`) VALUES
(1, 'Mise en ligne', 'Fingers in the nose', 'yhfghrgh');

-- --------------------------------------------------------

--
-- Structure de la table `adherents`
--

DROP TABLE IF EXISTS `adherents`;
CREATE TABLE IF NOT EXISTS `adherents` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `numeroAdherent` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `motDePasse` varchar(50) NOT NULL,
  `atelier` varchar(50) NOT NULL,
  `niveau` varchar(50) NOT NULL DEFAULT 'adherent',
  `nubesDate` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `adherents`
--

INSERT INTO `adherents` (`ID`, `nom`, `prenom`, `adresse`, `ville`, `telephone`, `mail`, `numeroAdherent`, `login`, `motDePasse`, `atelier`, `niveau`, `nubesDate`) VALUES
(1, 'Adam', 'Anne', '4 rue des Maraichers', 'Vaulx', '06 51 20 22 02', 'anadam22@hotmail.fr', '13/14-005', '', 'azer', 'adultes Vaulx', 'adherent', '2014-04-29'),
(2, 'Arthus', 'Corinne', '29 rue Jean Jaurès ', 'Vaulx', '06 31 78 11 73', 'fayararthus@free.fr', '13/14-016', '', 'qsdf', 'adultes Vaulx', 'adherent', '0000-00-00'),
(3, 'Benchke', 'Marie Jo', '10 rue du 8 mai', 'Sainte Foy', '06 74 78 42 20', 'mjob633@orange.fr', '13/14-001', '', '', 'adultes Ste Foy', 'adherent', '2014-04-16'),
(29, 'Fiorèse', 'Jérôme', '12, rue des lilas', 'Paris', '064645454', 'jerome@fiorese.fr', '3546544564', 'toto', '1234', 'Nubes', 'adherent', '2014-04-28'),
(30, 'Mura', 'Nicolas', '', '', '', 'nicolas.mura@gmail.com', '', 'Nikouz', 'moimeme', '', 'adherent', '2014-04-29');

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE IF NOT EXISTS `administrateurs` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `motDePasse` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `niveau` varchar(50) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `administrateurs`
--

INSERT INTO `administrateurs` (`ID`, `nom`, `prenom`, `login`, `motDePasse`, `mail`, `niveau`) VALUES
(1, 'Milou', 'Tintin', 'toto', '1234', 'rbellongronnier@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `articlePresse` text NOT NULL,
  `titre` varchar(100) NOT NULL,
  `dates` date NOT NULL,
  `urlArticle` varchar(60) NOT NULL,
  `creationsID` smallint(6) NOT NULL,
  `actions_culturellesID` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Structure de la table `ateliers`
--

DROP TABLE IF EXISTS `ateliers`;
CREATE TABLE IF NOT EXISTS `ateliers` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  `texteMobile` text NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL,
  `adresse` varchar(60) NOT NULL,
  `codePostal` varchar(5) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `adresseGpsDuLieu` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `ateliers`
--

INSERT INTO `ateliers` (`ID`, `titre`, `texte`, `texteMobile`, `date`, `heureDebut`, `heureFin`, `adresse`, `codePostal`, `ville`, `adresseGpsDuLieu`) VALUES
(1, 'Autour de Nubes', 'Description', 'Description mobile', '0000-00-00', '00:00:00', '00:00:00', '4 avenue Bataillon Carmagnole – 69120 Vaulx en Velin', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `ateliers_lieux`
--

DROP TABLE IF EXISTS `ateliers_lieux`;
CREATE TABLE IF NOT EXISTS `ateliers_lieux` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `lieu` varchar(50) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `adresseGps` varchar(100) NOT NULL,
  `infosMetro` text NOT NULL,
  `infosBus` text NOT NULL,
  `infosVoiture` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `ateliers_lieux`
--

INSERT INTO `ateliers_lieux` (`ID`, `lieu`, `adresse`, `adresseGps`, `infosMetro`, `infosBus`, `infosVoiture`) VALUES
(37, 'Studio Carmagnole', '4 avenue Bataillon Carmagnole – 69120 Vaulx en Vel', 'test', '', '', ''),
(38, 'test', 'test', 'test', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `collaborateurs`
--

DROP TABLE IF EXISTS `collaborateurs`;
CREATE TABLE IF NOT EXISTS `collaborateurs` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `collaborateurs`
--

INSERT INTO `collaborateurs` (`ID`, `nom`, `prenom`) VALUES
(1, 'Atoyama', 'Anan'),
(2, 'Ribault', 'Marc'),
(3, 'Hue', 'Edouard'),
(4, 'Marion-Gallois', 'Aurélien'),
(5, 'Bellon Gronnier', 'Roger'),
(6, 'Dubois', 'Manon'),
(7, 'Tintin', 'Milou'),
(10, 'Bonaldy', 'Jerome'),
(11, 'Fiorèse', 'Jérôme'),
(13, 'Mura', 'Nikouz'),
(15, 'Vagne', 'Cécile');

-- --------------------------------------------------------

--
-- Structure de la table `creations`
--

DROP TABLE IF EXISTS `creations`;
CREATE TABLE IF NOT EXISTS `creations` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `titreBloc` varchar(250) NOT NULL,
  `chapo` text NOT NULL,
  `interTitre` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `resume` text NOT NULL,
  `resumeMobile` text NOT NULL,
  `accroche` text NOT NULL,
  `verbatim` text NOT NULL,
  `verbatimAuteur` varchar(30) NOT NULL,
  `anneeCreation` year(4) NOT NULL,
  `duree` varchar(20) NOT NULL,
  `statut` enum('creationActuelle','creationPresente','creationPrecedente','creationAvenir') NOT NULL,
  `notesTitre` varchar(50) NOT NULL,
  `notesTexte` text NOT NULL,
  `notesAuteur` varchar(50) NOT NULL,
  `urlVideo` varchar(250) NOT NULL,
  `urlPresse` varchar(250) NOT NULL,
  `urlFiche` varchar(250) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `creations`
--

INSERT INTO `creations` (`ID`, `titre`, `titreBloc`, `chapo`, `interTitre`, `type`, `auteur`, `resume`, `resumeMobile`, `accroche`, `verbatim`, `verbatimAuteur`, `anneeCreation`, `duree`, `statut`, `notesTitre`, `notesTexte`, `notesAuteur`, `urlVideo`, `urlPresse`, `urlFiche`, `active`) VALUES
(1, 'ShiNMu', 'Danser l''invisible : à la recherche du rêve et de l''inconscient...', 'SHiNMu emmène le spectateur flotter dans un univers irréel, poétique, et parfois violent, assis dans une barque dérivant sur le fleuve de son inconscience.                                        ', 'Un monde imaginaire, même fou, que le spectateur aura l''impression d''avoir rêvé.                                        ', 'Trio', 'Anan Atoyama', 'Le rêve est une expérience à la fois très personnelle mais aussi universelle car tout le monde rêve. Aborder le sujet de l’inconscience en utilisant le langage du corps, à travers un processus créatif collectif, est l’ambition de SHiNMu. La chorégraphe débusque, en interrogeant les corps, une parole libérée des contextes sociétal et culturel dans lesquels ils ont été façonnés.\r\n\r\nDes mouvements se révèlent, illogiques et hors normes, faisant ainsi éclater, à fleur de peau, des bulles d’inconscience.\r\n\r\nLe plateau ne s’habille que de tulle sur cette pièce, pour mieux se draper de projections numériques, accentuant l’imaginaire et l’irréel des corps des trois danseurs en mouvement.', '', 'SHiNMu plonge dans l’inconscient du corps de chacun                                                ', '« Quand je cherche les rêves de mon corps, je suis a la fois perdue et troublée par ces nouvelles connections. Comme si, de nuit, je plongeais dans l’océan et attendais que le soleil se lève pour éclairer un nouveau monde, avec lequel une toute nouvelle relation s’établirait »                        ', 'Anan Atoyama', 2013, '60 minutes', 'creationPresente', 'Autour de SHiNMu', 'Notre collaboration est née d''une rencontre à travers laquelle la chorégraphe Anan Atoyama m''a exprimé son désir de plonger dans le monde du rêve. Le rêve qui habite l''idée, le geste, le souffle… la musique. Le rêve, prenant racine dans l''inconscient, va nous amener dans le chemin d''une réalité... probablement la nôtre. Dans cette création, musique et corps, abstraction et matière, s''enlacent afin de créer une certaine ouverture sur un ensemble infini et indéfini de possibilités. La musique rejoint la danse non pas en tant que déterminateur du geste mais plutôt en tant que continuité sonore naissante du sens de ce geste.La musique, véhiculant différents sens, proposera à chacun des clés pour ouvrir les portes de sa propre mémoire.                    ', 'Aurélien Marion-Gallois', '78464265', '', '', 1),
(2, 'Avant qu''elle ne se fâne', 'La confrontation d''un homme avec ses peurs profondes.', 'sdqfsdfv', 'sqdsd', 'Duo', '', 'Mon message iciLe Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte             ', '', '', 'Mon message iciLe Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte  ', '', 2010, '92 minutes', 'creationActuelle', '', '', '', '78464265', '', '', 1),
(25, 'Râga', 'Râga sonde le désir, au travers du couple Macbeth et de la culture indienne.', '', '', 'Solo', '', '', '', '', '', '', 2011, '30 minutes', 'creationPrecedente', '', '', '', '', '', '', 1),
(23, 'Création actuelle n°2', 'Titre bloc création actuelle n°2', '', 'Un monde imaginaire, même fou, que le spectateur aura l''impression d''avoir rêvé. ', 'Uno', 'Lui', '', '', '', '', '', 2013, '12mn', 'creationActuelle', '', '', '', '78464265', '', '', 1),
(24, 'Le Sacre', 'Danser l''invisible : à la recherche du rêve et de l''inconscient...', '', '', 'Trio', '', '', '', '', '', '', 2013, '60 minutes', 'creationAvenir', '', '', '', '', '', '', 1),
(26, 'Daichi', 'Danser linvisible : à la recherche du rêve et de l’inconscient...', '', '', 'Solo', '', '', '', '', '', '', 2008, '30 minutes', 'creationPrecedente', '', '', '', '', '', '', 0),
(27, 'madness, love & mysticism', 'Les révoltes intimes d’une femme, rythmées par l’album éponyme de John Zorn.', '', '', 'Quatuor', '', '', '', '', '', '', 2010, '75 minutes', 'creationPrecedente', '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

DROP TABLE IF EXISTS `discussions`;
CREATE TABLE IF NOT EXISTS `discussions` (
  `ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `texte` text NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `discussions`
--

INSERT INTO `discussions` (`ID`, `titre`, `texte`, `auteur`, `active`) VALUES
(1, 'Que signifie SHinMu ?', 'C''est une association de deux mots japonais que j''ai créée, « Shin » est un\r\nhomonyme qui peut signifier corps, profond, vrai, nouveau et « Mu » signifie\r\n« rêve ». Je voulais évoquer le thème central qui anime cette nouvelle création,\r\ncelui des rêves et de l''inconscient. Le rêve est une expérience à la fois très\r\npersonnelle mais aussi universelle car tout le monde rêve. Aborder le sujet de\r\nl''inconscience en utilisant le langage du corps, à travers un processus créatif\r\ncollectif, c''est l''ambition de « SHiNMu ».\r\nÀ noter dans vos agenda, trois représentations de SHiNMu au Centre Charlie\r\nChaplin les 23, 24 et 25 mars à 20h30.', 'Anan Atoyama', 0),
(2, 'Discussion n°2', 'Blabla', 'Moi', 0),
(3, 'Discussion n°3', '<blockquote><blockquote>Modifs<br></blockquote></blockquote>', 'ba', 0),
(4, 'Discussion n°10000.', 'zmduvhqmdvljk', 'Nikouz', 0),
(5, 'Discussion test', 'test', 'fsdq,vmlsd', 0);

-- --------------------------------------------------------

--
-- Structure de la table `dossier_presse`
--

DROP TABLE IF EXISTS `dossier_presse`;
CREATE TABLE IF NOT EXISTS `dossier_presse` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `urlDossier` varchar(60) NOT NULL,
  `creationsID` smallint(6) NOT NULL,
  `actions_culturellesID` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Structure de la table `fiche`
--

DROP TABLE IF EXISTS `fiche`;
CREATE TABLE IF NOT EXISTS `fiche` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `urlFiche` varchar(60) NOT NULL,
  `creationsID` smallint(6) NOT NULL,
  `actions_culturellesID` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Structure de la table `fonctions`
--

DROP TABLE IF EXISTS `fonctions`;
CREATE TABLE IF NOT EXISTS `fonctions` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `metiers` varchar(50) NOT NULL,
  `creationsID` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `fonctions`
--

INSERT INTO `fonctions` (`ID`, `metiers`, `creationsID`) VALUES
(1, 'Chorégraphe', 1),
(2, 'Lumières', 1),
(3, 'Effets vidéo', 2),
(4, 'Costumes', 4),
(5, 'Photographie', 19),
(6, 'Production', 0),
(7, 'Co-production', 0),
(8, 'Direction artistique', 0),
(9, 'Interprètes', 0),
(10, 'Composition musicale', 0),
(11, 'Régisseur général', 0),
(12, 'Effets spéciaux', 0),
(13, 'Programmation numérique', 0),
(14, 'Artiste associé', 0),
(15, 'Saltimbanque', 0);

-- --------------------------------------------------------

--
-- Structure de la table `fo_col`
--

DROP TABLE IF EXISTS `fo_col`;
CREATE TABLE IF NOT EXISTS `fo_col` (
  `creationsID` smallint(5) unsigned NOT NULL,
  `fonctionsID` smallint(5) unsigned NOT NULL,
  `collaborateursID` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`creationsID`,`fonctionsID`,`collaborateursID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `fo_col`
--

INSERT INTO `fo_col` (`creationsID`, `fonctionsID`, `collaborateursID`) VALUES
(21, 2, 1),
(21, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

DROP TABLE IF EXISTS `langues`;
CREATE TABLE IF NOT EXISTS `langues` (
  `statut` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`statut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `langues`
--

INSERT INTO `langues` (`statut`) VALUES
(1);

-- --------------------------------------------------------

--
-- Structure de la table `liens_amis`
--

DROP TABLE IF EXISTS `liens_amis`;
CREATE TABLE IF NOT EXISTS `liens_amis` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `dates` datetime NOT NULL,
  `commentaires` text NOT NULL,
  `discussionsID` tinyint(3) unsigned NOT NULL,
  `adherentsID` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`ID`, `dates`, `commentaires`, `discussionsID`, `adherentsID`) VALUES
(4, '0000-00-00 00:00:00', 'Coucou !', 0, 0),
(5, '2014-04-01 00:00:00', 'Coucou !', 1, 1),
(3, '2014-04-02 10:30:30', 'Ceci est un commentaire.', 3, 1),
(6, '2014-04-21 00:00:00', 'Recoucou !', 1, 2),
(7, '0000-00-00 00:00:00', '2ème message !', 1, 1),
(8, '2014-04-02 10:30:31', '3ème message !', 3, 2),
(9, '2014-04-02 10:30:32', '4ème message d''Adam', 3, 3),
(10, '2014-04-06 18:01:05', 'Je suis Toto', 5, 29),
(11, '2014-04-06 18:02:19', 'Deuxième message !', 5, 29),
(12, '2014-04-06 18:16:51', 'Coucou Julie', 5, 29);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `titre` varchar(50) NOT NULL,
  `auteur` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `notes`
--

INSERT INTO `notes` (`ID`, `texte`, `titre`, `auteur`) VALUES
(1, 'e Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500', 'Testostérone', 'Moi'),
(2, 'e Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500', 'Test 2', 'Moi Moi'),
(3, '   Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.\r\n   Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.\r\n    ', 'Super note', 'Roger Bellon'),
(4, '                              Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500gtzgetgtrzgrtg\r\n                            ', 'krgfrkghjfdhgj', 'lrhgdfhgkjg'),
(5, '    Votre message ici\r\n    hrtrhthrtrth', 'rtrthrht', 'rhtrhtrht'),
(6, '    Votre message ici\r\n    ', '', ''),
(7, '    Votre message ici\r\n    ', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `nubes`
--

DROP TABLE IF EXISTS `nubes`;
CREATE TABLE IF NOT EXISTS `nubes` (
  `ID` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `dates` date NOT NULL,
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL,
  `lieuxAteliersID` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Contenu de la table `nubes`
--

INSERT INTO `nubes` (`ID`, `dates`, `heureDebut`, `heureFin`, `lieuxAteliersID`) VALUES
(45, '2014-04-28', '00:00:00', '00:00:00', 0),
(46, '2014-04-22', '00:00:00', '00:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `partenaires`
--

DROP TABLE IF EXISTS `partenaires`;
CREATE TABLE IF NOT EXISTS `partenaires` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `logoNb` varchar(50) NOT NULL,
  `logoCouleur` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `creationsID` smallint(6) NOT NULL,
  `actions_culturellesID` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`ID`, `nom`, `filename`, `creationsID`, `actions_culturellesID`) VALUES
(105, 'Photo de la création Avant qu''elle ne se fâne', 'creation_avant-qu-elle-ne-se-fane_101.jpg', 2, 0),
(98, 'Photo de la création Le Sacre', 'creation_le-sacre_1.jpg', 24, 0),
(99, 'Photo de la création Râga', 'creation_raga_1.jpg', 25, 0),
(100, 'Photo de la création Avant qu''elle ne se fâne', 'creation_avant-qu-elle-ne-se-fane_1.jpg', 2, 0),
(91, 'Photo de la création Création actuelle n°2', 'creation_creation-actuelle-n-2_1.jpg', 23, 0),
(84, 'Photo de la création ShiNMu', 'creation_shinmu_1.jpg', 1, 0),
(113, 'Photo de la galerie', 'galerie_1.jpg', 0, 0),
(123, 'Photo de l''action culturelle AC actuelle n°1', 'action_ac-actuelle-n-1_1.jpg', 0, 5),
(116, 'Photo de la galerie', 'galerie_116.jpg', 0, 0),
(115, 'Photo de la galerie', 'galerie_115.jpg', 0, 0),
(114, 'Photo de la galerie', 'galerie_114.jpg', 0, 0),
(117, 'Photo de la galerie', 'galerie_117.jpg', 0, 0),
(118, 'Photo de la galerie', 'galerie_118.jpg', 0, 0),
(119, 'Photo de la galerie', 'galerie_119.jpg', 0, 0),
(120, 'Photo de la galerie', 'galerie_120.jpg', 0, 0),
(121, 'Photo de l''action culturelle TransFORME', 'action_transforme_1.jpg', 0, 4),
(122, 'Photo de l''action culturelle transforme', 'action_transforme_122.jpg', 0, 4),
(124, 'Photo de l''action culturelle ac-actuelle-n-1', 'action_ac-actuelle-n-1_124.jpg', 0, 5),
(125, 'Photo de l''action culturelle ac-actuelle-n-1', 'action_ac-actuelle-n-1_125.jpg', 0, 5),
(126, 'Photo de la création ShiNMu', 'creation_shinmu_85.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `prospects`
--

DROP TABLE IF EXISTS `prospects`;
CREATE TABLE IF NOT EXISTS `prospects` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `representations`
--

DROP TABLE IF EXISTS `representations`;
CREATE TABLE IF NOT EXISTS `representations` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `salle` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `dates` date NOT NULL,
  `adresseGpsDuLieu` varchar(100) NOT NULL,
  `infosMetro` text NOT NULL,
  `infosBus` text NOT NULL,
  `infosVoiture` text NOT NULL,
  `creationsID` smallint(6) NOT NULL,
  `actions_culturellesID` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Contenu de la table `representations`
--

INSERT INTO `representations` (`ID`, `salle`, `ville`, `pays`, `dates`, `adresseGpsDuLieu`, `infosMetro`, `infosBus`, `infosVoiture`, `creationsID`, `actions_culturellesID`) VALUES
(29, 'Salut', 'Tours', 'France', '0000-00-00', '', '', '', '', 10, 0),
(23, 'reggrth', 'rheerh', 'hrethre', '0000-00-00', '', '', '', '', 9, 0),
(22, 'rzebrn', 'enrenrten', 'neryn', '0000-00-00', '', '', '', '', 9, 0),
(30, 'Tintin', 'Tobet', 'Tibet', '0000-00-00', '', '', '', '', 14, 0),
(28, 'Testo', 'Amiens', 'France', '2014-12-15', '', '', '', '', 10, 0),
(27, 'ergrg', 'greegr', 'egeg', '0000-00-00', '', '', '', '', 21, 0),
(25, 'bbgfgb', 'bffgfgb', 'fbgfb', '0000-00-00', '', '', '', '', 9, 0),
(24, '''(gt''g', 'g''g''', 'gt''tg', '0000-00-00', '', '', '', '', 9, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
