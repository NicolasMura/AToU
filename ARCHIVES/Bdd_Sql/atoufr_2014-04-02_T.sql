-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 02 Avril 2014 à 12:42
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
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `actions_culturelles`
--

INSERT INTO `actions_culturelles` (`ID`, `titre`, `titreBloc`, `chapo`, `interTitre`, `auteur`, `resume`, `resumeMobile`, `accroche`, `anneeCreation`, `duree`, `statut`, `notesTitre`, `notesTexte`, `notesAuteur`, `urlVideo`, `urlPresse`, `urlFiche`, `photosID`, `articlesID`, `representationsID`) VALUES
(1, 'Backoffice Office', 'rfregrtgr', '        Votre message ici\r\n        ', '        Votre message ici\r\n        ', 'Moi MOI', '        Votre message ici\r\n        ', '        Votre message ici\r\n        ', '        Votre message ici\r\n        ', 2015, '62 minutes', '', 'grtegertg', '       rezergvbvzve\r\n        ', 'rgertg', 'gtregrteg', 'rtgrtg', 'egrtgerg', 0, 0, 0),
(3, 'News', 'erhrth', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', 'rtehrt', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', 2015, '60 mionutes', 'actionAvenir', 'rhreht', '    Votre message ici\r\n    ', 'rthrthet', 'rthrtyhe', 'rheerh', 'rhther', 0, 0, 0);

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
(1, 'Mise en ligne', '                Fingers in the nose\r\nFingers in the nose                    ', '                yhfghrgh                   ');

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
  `nubesID` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `adherents`
--

INSERT INTO `adherents` (`ID`, `nom`, `prenom`, `adresse`, `ville`, `telephone`, `mail`, `numeroAdherent`, `login`, `motDePasse`, `atelier`, `niveau`, `nubesID`) VALUES
(1, 'Adam', 'Anne', '4 rue des Maraichers', 'Vaulx', '06 51 20 22 02', 'anadam22@hotmail.fr', '13/14-005', '', 'azer', 'adultes Vaulx', 'adherent', 0),
(2, 'Arthus', 'Corinne', '29 rue Jean Jaurès ', 'Vaulx', '06 31 78 11 73', 'fayararthus@free.fr', '13/14-016', '', 'qsdf', 'adultes Vaulx', 'adherent', 0),
(3, 'Benchke', 'Marie Jo', '10 rue du 8 mai', 'Sainte Foy', '06 74 78 42 20', 'mjob633@orange.fr', '13/14-001', '', '', 'adultes Ste Foy', 'adherent', 0),
(29, 'Fiorèse', 'Jérôme', '12, rue des lilas', 'Paris', '064645454', 'jerome@fiorese.fr', '3546544564', 'Toto', '1234', 'Nubes', 'adherent', 0);

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
  `creationsID` smallint(6) NOT NULL,
  `actions_culturellesID` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`ID`, `articlePresse`, `titre`, `creationsID`, `actions_culturellesID`) VALUES
(1, 'Contrairement à une opinion répandue, le Lorem Ipsum n''est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av', 'Article autre', 0, 0),
(2, 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500', 'Article Shinmu', 0, 0),
(3, 'Plusieurs variations de Lorem Ipsum peuvent être trouvées ici ou là, mais la majeure partie d''entre elles a été altérée par l''addition d''humour ou de mots aléatoires qui ne ressemblent pas une seconde à du texte standard.', 'Un article nouveau', 0, 0),
(4, 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500,', 'Un nouveau tintin', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ateliers`
--

DROP TABLE IF EXISTS `ateliers`;
CREATE TABLE IF NOT EXISTS `ateliers` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `ateliers`
--

INSERT INTO `ateliers` (`ID`, `titre`, `texte`) VALUES
(1, 'Autour de Nubes', 'TRANSFORM 2014 emmène lespectateur flotter dans un universirréel, poétique, et parfois violent,assis dans une barque dérivant surle fleuve de son inconscience.TRANSFORM 2014 emmène lespectateur flotter dans un universirréel, poétique, et parfois violent.<br>');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

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
(12, 'Vagne', 'Cécile'),
(13, 'Mura', 'Nicolas');

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
  `anneeCreation` year(4) NOT NULL,
  `duree` varchar(20) NOT NULL,
  `statut` enum('creationActuelle','creationPresente','creationPrecedente','creationAvenir') NOT NULL,
  `notesTitre` varchar(50) NOT NULL,
  `notesTexte` text NOT NULL,
  `notesAuteur` varchar(50) NOT NULL,
  `urlVideo` varchar(250) NOT NULL,
  `urlPresse` varchar(250) NOT NULL,
  `urlFiche` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `creations`
--

INSERT INTO `creations` (`ID`, `titre`, `titreBloc`, `chapo`, `interTitre`, `type`, `auteur`, `resume`, `resumeMobile`, `accroche`, `verbatim`, `anneeCreation`, `duree`, `statut`, `notesTitre`, `notesTexte`, `notesAuteur`, `urlVideo`, `urlPresse`, `urlFiche`) VALUES
(1, 'ShiNMu', 'Danser l''invisible', '', '', 'Trio', 'Anan Atoyama', '«SHiNMu» emmène le spectateur flotter dans un univers irréel, poétique, et parfois violent, assis dans une barque dérivant sur le fleuve de son inconscience. Un monde imaginaire, même fou, que le spectateur aura l’impression d’avoir rêvé.\r\nLe rêve est une expérience à la fois très personnelle mais aussi universelle car tout le monde rêve.\r\nAborder le sujet de l’inconscience en utilisant le langage du corps, à travers un processus créatif collectif, est l’ambition de « SHiNMu ». \r\n\r\nLa chorégraphe débusque, en interrogeant les corps, une parole libérée des contextes de société et culturel dans lesquels ils ont été façonnés. Des mouvements se révèlent, illogiques et hors normes, faisant ainsi éclater, à fleur de peau, des bulles d’inconscience.\r\nLe plateau ne s’habille que de tulle sur cette pièce, pour mieux se draper de projections numériques, accentuant l’imaginaire et l’irréel des corps des trois danseurs en mouvement.', '', 'SHiNMu plonge dans l’inconscient du corps de chacun', '« Quand je cherche les rêves de mon corps, je suis a la fois perdue et troublée par ces nouvelles connections. Comme si, de nuit, je plongeais dans l’océan et attendais que le soleil se lève pour éclairer un nouveau monde, avec lequel une toute nouvelle relation s’établirait »\r\n\r\nAnan Atoyama', 2013, '60 minutes', 'creationActuelle', '', '', '', 'http://vimeo.com/78464265', '', ''),
(2, 'Test création', 'Test 2', '', '', '', '', '        Mon message iciLe Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte     ', '        ', '        ', '        ', 0000, '', 'creationPrecedente', '', '', '', '', '', ''),
(11, 'hyfhrhrt', 'rthrhrthtr', '    Votre message ici\r\n    rthrhrthrthtr', '    Votre message ici\r\n    thrrthhtrhtrtrh', 'rthrtrth', '', '    Votre message ici\r\n    hrthrthrthrtrht', '    Votre message ici\r\n    htrrhthrthrt', '    Votre message ici\r\n    rhthrthrthrth', '    Votre message ici\r\n    rthhrthrtrth', 0000, 'rhtthhrhrt', 'creationAvenir', '', '', '', 'rthrthrtrth', 'hrtrhtrht', 'rthrthrht'),
(5, 'samedi', 'gertgtg', '', '', '', '', '    Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte\r\n        ', '', '', '', 0000, '', 'creationActuelle', '', '', '', '', '', ''),
(8, 'Selection new', 'gcehfhfeghf', '', '', '', '', '        Mon message ici    Mon message ici    Mon message ici    Mon message ici    Mon message ici    Mon message ici    Mon message ici    Mon message ici    Mon message ici    Mon message ici    Mon message ici    Mon message ici    Mon message ici    Mon message ici\r\n        ', '', '', '', 0000, '', 'creationPresente', '', '', '', '', '', ''),
(9, 'Creation de la balle', 'Sous creation', 'Chapi chapo', 'Inter inter', 'Quatuor', 'Roger Bellon', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500\r\n    ', '  Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500', '   Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.\r\n    ', '  " Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression."\r\n    ', 2014, '60 minutes', 'creationAvenir', '', '', '', 'ebrethjteyjtj', 'ythjtyjtyjrtj', 'tyjrtyjtyjtj'),
(10, 'Encore une création', 'Encore un test', '                        Cho cho cho                        ', '                        Pourquoi pas                        ', 'Solo', 'RBG', '                        Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500\r\n                            ', '                        Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500\r\n                            ', '                        Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500                        ', '                         Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500\r\n                            ', 2015, '125 minutes', 'creationAvenir', '', '', '', 'thrjteyj', 'tyjtyrjrtj', 'tjrtjtyjr'),
(16, 'Test21', 'ytufuytf', '    Votre message ici\r\n    jygjg', '    Votre message ici\r\n    gjj', 'tyutyf', '', '    Votre message ici\r\n    gjh', '    Votre message ici\r\n    jgh', 'jgh', '    Votre message ici\r\n    gjh', 0000, 'yftuutf', 'creationActuelle', 'jg', '    Votre message ici\r\n    j', 'gjh', 'gj', 'gjh', 'gjh'),
(17, 'test erreur PDO', 'rjdyj', '    Votre message ici\r\n    drjdy', '    Votre message ici\r\n    ', 'thjjdr', '', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', 0000, 'jyrdr', 'creationActuelle', 'djjdy', '    Votre message ici\r\n    ', 'jddyjtt', 'jrydj', 'jdy', 'jdy'),
(14, 'Bueno', 'fkgerlkhzltkr', '    Votre message ici\r\n    rngerhlheklhjtmlhwkdm,smyejmojy', 'jdklhjkldrtjhkjhmkdj    Votre message ici\r\n    ', 'Solo', 'ljerkmhjklrtjhlk', 'tlhkjrljmrymlryj    Votre message ici\r\n    ', '    Votre message ici\r\n        Votre message ici\r\n    rngerhlheklhjtmlhwkdm,smyejmojy', '    Votre message ici\r\n        Votre message ici\r\n    rngerhlheklhjtmlhwkdm,smyejmojy', '    Votre message ici\r\n        Votre message ici\r\n    rngerhlheklhjtmlhwkdm,smyejmojy', 0000, '4554', 'creationPrecedente', 'tejhtyjty', '    Votre message ici\r\n    trjekteè§llr!§èl', 'rtzuetykeuty', 'trhtrjr', 'rtjryj', 'rjryjetyj'),
(18, 'teste virgule', 'jyt', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', 'hc,y', '', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', 0000, 'ygjytj', 'creationActuelle', 'yjv', '    Votre message ici\r\n    ', 'vjy', 'jytj', 'ytjjyttyjtjyytvj', 'jv'),
(20, 'Modif', 'utyi', '    Votre message ici\r\n    tiyt', '    Votre message ici\r\n    itit', '(u§ru', '', '    Votre message ici\r\n    ityti', '    Votre message ici\r\n    itytiy', '    Votre message ici\r\n    itytyi', '    Votre message ici\r\n    itytiy', 0000, 'tuyty', 'creationActuelle', 'tyity', '    Votre message ici\r\n    ', 'ityiy', 'itytyi', 'tyii', 'ityiy'),
(21, 'Tintin', 'rtrnrt', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', 'Milou', 'nrtnetnren', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', '    Votre message ici\r\n    ', 0000, '555 minutes', 'creationPrecedente', 'neentnt', '    Votre message ici\r\n    neenretyn', 'nernert', 'enen', 'ene', 'neneyn');

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
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(1, 'choregraphe', 1),
(2, 'lumiere', 1),
(3, 'effets video', 2),
(4, 'costumes', 4),
(5, 'photographie', 19),
(6, 'production', 0),
(7, 'co-production', 0),
(8, 'direction artistique', 0),
(9, 'interpretes', 0),
(10, 'composition musicale', 0),
(11, 'regisseur general', 0),
(12, 'effets speciaux', 0),
(13, 'programmation numerique', 0),
(14, 'artiste associe', 0),
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
(1, 1, 1),
(1, 1, 2),
(1, 2, 13),
(1, 3, 4),
(1, 4, 3),
(21, 2, 1),
(21, 2, 2);

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
  `dates` date NOT NULL,
  `commentaires` text NOT NULL,
  `discussionsID` tinyint(3) unsigned NOT NULL,
  `adherentsID` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `nubes`
--

INSERT INTO `nubes` (`ID`, `dates`) VALUES
(26, '2014-04-18'),
(27, '2014-04-03');

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
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`ID`, `nom`, `filename`, `creationsID`) VALUES
(1, 'Photo de la création Shinmu', 'compagnie1.jpg', 1),
(2, 'Photo de la création Shinmu', 'compagnie3.JPG', 1);

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
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `representations`
--

INSERT INTO `representations` (`ID`, `salle`, `ville`, `pays`, `dates`, `adresseGpsDuLieu`, `infosMetro`, `infosBus`, `infosVoiture`, `creationsID`) VALUES
(2, 'uuuuuuu', 'uuuuuu', 'France', '0000-00-00', '', '', '', '', 1),
(3, 'ca va marcher', 'reryhyuttr', 'Francert', '0000-00-00', '', '', '', '', 1),
(29, 'Salut', 'Tours', 'France', '0000-00-00', '', '', '', '', 10),
(23, 'reggrth', 'rheerh', 'hrethre', '0000-00-00', '', '', '', '', 9),
(22, 'rzebrn', 'enrenrten', 'neryn', '0000-00-00', '', '', '', '', 9),
(30, 'Tintin', 'Tobet', 'Tibet', '0000-00-00', '', '', '', '', 14),
(28, 'Testo', 'Amiens', 'France', '2014-12-15', '', '', '', '', 10),
(27, 'ergrg', 'greegr', 'egeg', '0000-00-00', '', '', '', '', 21),
(25, 'bbgfgb', 'bffgfgb', 'fbgfb', '0000-00-00', '', '', '', '', 9),
(24, '''(gt''g', 'g''g''', 'gt''tg', '0000-00-00', '', '', '', '', 9),
(31, 'gkezhfg', 'jhzrakjghek', 'jhregjze', '0000-00-00', '', '', '', '', 1),
(32, 'iyjyjt', 'hgfghfh', 'kujj', '0000-00-00', '', '', '', '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
