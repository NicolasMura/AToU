-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 06 Avril 2014 à 18:04
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
(29, 'Fiorèse', 'Jérôme', '12, rue des lilas', 'Paris', '064645454', 'jerome@fiorese.fr', '3546544564', 'toto', '1234', 'Nubes', 'adherent', 0);

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
  `texteMobile` text NOT NULL,
  `lieu` varchar(60) NOT NULL,
  `adresse` varchar(60) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `ateliers`
--

INSERT INTO `ateliers` (`ID`, `titre`, `texte`, `texteMobile`, `lieu`, `adresse`) VALUES
(1, 'Autour de Nubes', '<!--[if gte mso 9]><xml> <w:WordDocument>  <w:View>Normal</w:View>  <w:Zoom>0</w:Zoom>  <w:TrackMoves></w:TrackMoves>  <w:TrackFormatting></w:TrackFormatting>  <w:HyphenationZone>21</w:HyphenationZone>  <w:PunctuationKerning></w:PunctuationKerning>  <w:ValidateAgainstSchemas></w:ValidateAgainstSchemas>  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>  <w:DoNotPromoteQF></w:DoNotPromoteQF>  <w:LidThemeOther>FR</w:LidThemeOther>  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>  <w:Compatibility>   <w:BreakWrappedTables></w:BreakWrappedTables>   <w:SnapToGridInCell></w:SnapToGridInCell>   <w:WrapTextWithPunct></w:WrapTextWithPunct>   <w:UseAsianBreakRules></w:UseAsianBreakRules>   <w:DontGrowAutofit></w:DontGrowAutofit>   <w:SplitPgBreakAndParaMark></w:SplitPgBreakAndParaMark>   <w:EnableOpenTypeKerning></w:EnableOpenTypeKerning>   <w:DontFlipMirrorIndents></w:DontFlipMirrorIndents>   <w:OverrideTableStyleHps></w:OverrideTableStyleHps>   <w:UseFELayout></w:UseFELayout>  </w:Compatibility>  <w:DoNotOptimizeForBrowser></w:DoNotOptimizeForBrowser>  <m:mathPr>   <m:mathFont m:val="Cambria Math"></m:mathFont>   <m:brkBin m:val="before"></m:brkBin>   <m:brkBinSub m:val="--"></m:brkBinSub>   <m:smallFrac m:val="off"></m:smallFrac>   <m:dispDef></m:dispDef>   <m:lMargin m:val="0"></m:lMargin>   <m:rMargin m:val="0"></m:rMargin>   <m:defJc m:val="centerGroup"></m:defJc>   <m:wrapIndent m:val="1440"></m:wrapIndent>   <m:intLim m:val="subSup"></m:intLim>   <m:naryLim m:val="undOvr"></m:naryLim>  </m:mathPr></w:WordDocument></xml><![endif]--><!--[if gte mso 9]><xml> <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="true"  DefSemiHidden="true" DefQFormat="false" DefPriority="99"  LatentStyleCount="267">  <w:LsdException Locked="false" Priority="0" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Normal"></w:LsdException>  <w:LsdException Locked="false" Priority="9" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="heading 1"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 2"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 3"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 4"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 5"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 6"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 7"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 8"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 9"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 1"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 2"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 3"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 4"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 5"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 6"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 7"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 8"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 9"></w:LsdException>  <w:LsdException Locked="false" Priority="35" QFormat="true" Name="caption"></w:LsdException>  <w:LsdException Locked="false" Priority="10" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Title"></w:LsdException>  <w:LsdException Locked="false" Priority="1" Name="Default Paragraph Font"></w:LsdException>  <w:LsdException Locked="false" Priority="11" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Subtitle"></w:LsdException>  <w:LsdException Locked="false" Priority="22" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Strong"></w:LsdException>  <w:LsdException Locked="false" Priority="20" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Emphasis"></w:LsdException>  <w:LsdException Locked="false" Priority="59" SemiHidden="false"   UnhideWhenUsed="false" Name="Table Grid"></w:LsdException>  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Placeholder Text"></w:LsdException>  <w:LsdException Locked="false" Priority="1" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="No Spacing"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 1"></w:LsdException>  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Revision"></w:LsdException>  <w:LsdException Locked="false" Priority="34" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="List Paragraph"></w:LsdException>  <w:LsdException Locked="false" Priority="29" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Quote"></w:LsdException>  <w:LsdException Locked="false" Priority="30" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Intense Quote"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="19" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Subtle Emphasis"></w:LsdException>  <w:LsdException Locked="false" Priority="21" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Intense Emphasis"></w:LsdException>  <w:LsdException Locked="false" Priority="31" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Subtle Reference"></w:LsdException>  <w:LsdException Locked="false" Priority="32" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Intense Reference"></w:LsdException>  <w:LsdException Locked="false" Priority="33" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Book Title"></w:LsdException>  <w:LsdException Locked="false" Priority="37" Name="Bibliography"></w:LsdException>  <w:LsdException Locked="false" Priority="39" QFormat="true" Name="TOC Heading"></w:LsdException> </w:LatentStyles></xml><![endif]--><!--[if gte mso 10]><style> /* Style Definitions */ table.MsoNormalTable{mso-style-name:"Table Normal";mso-tstyle-rowband-size:0;mso-tstyle-colband-size:0;mso-style-noshow:yes;mso-style-priority:99;mso-style-parent:"";mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-para-margin:0cm;mso-para-margin-bottom:.0001pt;mso-pagination:widow-orphan;font-size:10.0pt;font-family:"Cambria","serif";}</style><![endif]--><br><span style="font-size:12.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:"MS Mincho";mso-ansi-language:FR;mso-fareast-language:FR;mso-bidi-language:AR-SA">AToU vous invite a participer à une session dedanse-improvisation une fois par mois, au studio Carmagnole. Cette sessions’adresse à tous ceux qui, par l’expression du corps, veulent apprendre sureux-mêmes et sur les autres, que vous soyez professionnels, amateurs ou sansexperience de la danse. Ces sessions seront guidées par Anan Atoyama, lachorégraphe d’AToU</span>', '<!--[if gte mso 9]><xml> <w:WordDocument>  <w:View>Normal</w:View>  <w:Zoom>0</w:Zoom>  <w:TrackMoves></w:TrackMoves>  <w:TrackFormatting></w:TrackFormatting>  <w:HyphenationZone>21</w:HyphenationZone>  <w:PunctuationKerning></w:PunctuationKerning>  <w:ValidateAgainstSchemas></w:ValidateAgainstSchemas>  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>  <w:DoNotPromoteQF></w:DoNotPromoteQF>  <w:LidThemeOther>FR</w:LidThemeOther>  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>  <w:Compatibility>   <w:BreakWrappedTables></w:BreakWrappedTables>   <w:SnapToGridInCell></w:SnapToGridInCell>   <w:WrapTextWithPunct></w:WrapTextWithPunct>   <w:UseAsianBreakRules></w:UseAsianBreakRules>   <w:DontGrowAutofit></w:DontGrowAutofit>   <w:SplitPgBreakAndParaMark></w:SplitPgBreakAndParaMark>   <w:EnableOpenTypeKerning></w:EnableOpenTypeKerning>   <w:DontFlipMirrorIndents></w:DontFlipMirrorIndents>   <w:OverrideTableStyleHps></w:OverrideTableStyleHps>   <w:UseFELayout></w:UseFELayout>  </w:Compatibility>  <w:DoNotOptimizeForBrowser></w:DoNotOptimizeForBrowser>  <m:mathPr>   <m:mathFont m:val="Cambria Math"></m:mathFont>   <m:brkBin m:val="before"></m:brkBin>   <m:brkBinSub m:val="--"></m:brkBinSub>   <m:smallFrac m:val="off"></m:smallFrac>   <m:dispDef></m:dispDef>   <m:lMargin m:val="0"></m:lMargin>   <m:rMargin m:val="0"></m:rMargin>   <m:defJc m:val="centerGroup"></m:defJc>   <m:wrapIndent m:val="1440"></m:wrapIndent>   <m:intLim m:val="subSup"></m:intLim>   <m:naryLim m:val="undOvr"></m:naryLim>  </m:mathPr></w:WordDocument></xml><![endif]--><!--[if gte mso 9]><xml> <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="true"  DefSemiHidden="true" DefQFormat="false" DefPriority="99"  LatentStyleCount="267">  <w:LsdException Locked="false" Priority="0" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Normal"></w:LsdException>  <w:LsdException Locked="false" Priority="9" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="heading 1"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 2"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 3"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 4"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 5"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 6"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 7"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 8"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 9"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 1"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 2"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 3"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 4"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 5"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 6"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 7"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 8"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 9"></w:LsdException>  <w:LsdException Locked="false" Priority="35" QFormat="true" Name="caption"></w:LsdException>  <w:LsdException Locked="false" Priority="10" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Title"></w:LsdException>  <w:LsdException Locked="false" Priority="1" Name="Default Paragraph Font"></w:LsdException>  <w:LsdException Locked="false" Priority="11" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Subtitle"></w:LsdException>  <w:LsdException Locked="false" Priority="22" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Strong"></w:LsdException>  <w:LsdException Locked="false" Priority="20" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Emphasis"></w:LsdException>  <w:LsdException Locked="false" Priority="59" SemiHidden="false"   UnhideWhenUsed="false" Name="Table Grid"></w:LsdException>  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Placeholder Text"></w:LsdException>  <w:LsdException Locked="false" Priority="1" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="No Spacing"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 1"></w:LsdException>  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Revision"></w:LsdException>  <w:LsdException Locked="false" Priority="34" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="List Paragraph"></w:LsdException>  <w:LsdException Locked="false" Priority="29" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Quote"></w:LsdException>  <w:LsdException Locked="false" Priority="30" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Intense Quote"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="19" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Subtle Emphasis"></w:LsdException>  <w:LsdException Locked="false" Priority="21" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Intense Emphasis"></w:LsdException>  <w:LsdException Locked="false" Priority="31" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Subtle Reference"></w:LsdException>  <w:LsdException Locked="false" Priority="32" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Intense Reference"></w:LsdException>  <w:LsdException Locked="false" Priority="33" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Book Title"></w:LsdException>  <w:LsdException Locked="false" Priority="37" Name="Bibliography"></w:LsdException>  <w:LsdException Locked="false" Priority="39" QFormat="true" Name="TOC Heading"></w:LsdException> </w:LatentStyles></xml><![endif]--><!--[if gte mso 10]><style> /* Style Definitions */ table.MsoNormalTable{mso-style-name:"Table Normal";mso-tstyle-rowband-size:0;mso-tstyle-colband-size:0;mso-style-noshow:yes;mso-style-priority:99;mso-style-parent:"";mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-para-margin:0cm;mso-para-margin-bottom:.0001pt;mso-pagination:widow-orphan;font-size:10.0pt;font-family:"Cambria","serif";}</style><![endif]--><br><span style="font-size:12.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:"MS Mincho";mso-ansi-language:FR;mso-fareast-language:FR;mso-bidi-language:AR-SA">AToU vous invite a participer à une session dedanse-improvisation une fois par mois, au studio Carmagnole. Cette sessions’adresse à tous ceux qui, par l’expression du corps, veulent apprendre sureux-mêmes et sur les autres, que vous soyez professionnels, amateurs ou sansexperience de la danse. Ces sessions seront guidées par Anan Atoyama, lachorégraphe d’AToU</span>', 'Studio Carmagnole ', '4 avenue Bataillon Carmagnole – 69120 Vaulx en Velin');
INSERT INTO `ateliers` (`ID`, `titre`, `texte`, `texteMobile`, `lieu`, `adresse`) VALUES
(6, 'Autour de TransFORME 2014', '<!--[if gte mso 9]><xml> <w:WordDocument>  <w:View>Normal</w:View>  <w:Zoom>0</w:Zoom>  <w:TrackMoves/>  <w:TrackFormatting/>  <w:HyphenationZone>21</w:HyphenationZone>  <w:PunctuationKerning/>  <w:ValidateAgainstSchemas/>  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>  <w:DoNotPromoteQF/>  <w:LidThemeOther>FR</w:LidThemeOther>  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>  <w:Compatibility>   <w:BreakWrappedTables/>   <w:SnapToGridInCell/>   <w:WrapTextWithPunct/>   <w:UseAsianBreakRules/>   <w:DontGrowAutofit/>   <w:SplitPgBreakAndParaMark/>   <w:EnableOpenTypeKerning/>   <w:DontFlipMirrorIndents/>   <w:OverrideTableStyleHps/>   <w:UseFELayout/>  </w:Compatibility>  <m:mathPr>   <m:mathFont m:val="Cambria Math"/>   <m:brkBin m:val="before"/>   <m:brkBinSub m:val="--"/>   <m:smallFrac m:val="off"/>   <m:dispDef/>   <m:lMargin m:val="0"/>   <m:rMargin m:val="0"/>   <m:defJc m:val="centerGroup"/>   <m:wrapIndent m:val="1440"/>   <m:intLim m:val="subSup"/>   <m:naryLim m:val="undOvr"/>  </m:mathPr></w:WordDocument></xml><![endif]--><!--[if gte mso 9]><xml> <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="true"  DefSemiHidden="true" DefQFormat="false" DefPriority="99"  LatentStyleCount="267">  <w:LsdException Locked="false" Priority="0" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Normal"/>  <w:LsdException Locked="false" Priority="9" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="heading 1"/>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 2"/>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 3"/>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 4"/>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 5"/>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 6"/>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 7"/>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 8"/>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 9"/>  <w:LsdException Locked="false" Priority="39" Name="toc 1"/>  <w:LsdException Locked="false" Priority="39" Name="toc 2"/>  <w:LsdException Locked="false" Priority="39" Name="toc 3"/>  <w:LsdException Locked="false" Priority="39" Name="toc 4"/>  <w:LsdException Locked="false" Priority="39" Name="toc 5"/>  <w:LsdException Locked="false" Priority="39" Name="toc 6"/>  <w:LsdException Locked="false" Priority="39" Name="toc 7"/>  <w:LsdException Locked="false" Priority="39" Name="toc 8"/>  <w:LsdException Locked="false" Priority="39" Name="toc 9"/>  <w:LsdException Locked="false" Priority="35" QFormat="true" Name="caption"/>  <w:LsdException Locked="false" Priority="10" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Title"/>  <w:LsdException Locked="false" Priority="1" Name="Default Paragraph Font"/>  <w:LsdException Locked="false" Priority="11" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Subtitle"/>  <w:LsdException Locked="false" Priority="22" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Strong"/>  <w:LsdException Locked="false" Priority="20" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Emphasis"/>  <w:LsdException Locked="false" Priority="59" SemiHidden="false"   UnhideWhenUsed="false" Name="Table Grid"/>  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Placeholder Text"/>  <w:LsdException Locked="false" Priority="1" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="No Spacing"/>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading"/>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List"/>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid"/>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1"/>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2"/>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1"/>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2"/>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1"/>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2"/>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3"/>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List"/>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading"/>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List"/>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid"/>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 1"/>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 1"/>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 1"/>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 1"/>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 1"/>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 1"/>  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Revision"/>  <w:LsdException Locked="false" Priority="34" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="List Paragraph"/>  <w:LsdException Locked="false" Priority="29" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Quote"/>  <w:LsdException Locked="false" Priority="30" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Intense Quote"/>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 1"/>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 1"/>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 1"/>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 1"/>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 1"/>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 1"/>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 1"/>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 1"/>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 2"/>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 2"/>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 2"/>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 2"/>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 2"/>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 2"/>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 2"/>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 2"/>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 2"/>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 2"/>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 2"/>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 2"/>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 2"/>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 2"/>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 3"/>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 3"/>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 3"/>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 3"/>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 3"/>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 3"/>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 3"/>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 3"/>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 3"/>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 3"/>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 3"/>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 3"/>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 3"/>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 3"/>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 4"/>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 4"/>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 4"/>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 4"/>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 4"/>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 4"/>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 4"/>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 4"/>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 4"/>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 4"/>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 4"/>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 4"/>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 4"/>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 4"/>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 5"/>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 5"/>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 5"/>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 5"/>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 5"/>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 5"/>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 5"/>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 5"/>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 5"/>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 5"/>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 5"/>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 5"/>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 5"/>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 5"/>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 6"/>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 6"/>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 6"/>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 6"/>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 6"/>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 6"/>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 6"/>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 6"/>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 6"/>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 6"/>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 6"/>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 6"/>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 6"/>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 6"/>  <w:LsdException Locked="false" Priority="19" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Subtle Emphasis"/>  <w:LsdException Locked="false" Priority="21" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Intense Emphasis"/>  <w:LsdException Locked="false" Priority="31" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Subtle Reference"/>  <w:LsdException Locked="false" Priority="32" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Intense Reference"/>  <w:LsdException Locked="false" Priority="33" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Book Title"/>  <w:LsdException Locked="false" Priority="37" Name="Bibliography"/>  <w:LsdException Locked="false" Priority="39" QFormat="true" Name="TOC Heading"/> </w:LatentStyles></xml><![endif]--><!--[if gte mso 10]><style> /* Style Definitions */ table.MsoNormalTable{mso-style-name:"Table Normal";mso-tstyle-rowband-size:0;mso-tstyle-colband-size:0;mso-style-noshow:yes;mso-style-priority:99;mso-style-parent:"";mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-para-margin-top:0cm;mso-para-margin-right:0cm;mso-para-margin-bottom:10.0pt;mso-para-margin-left:0cm;line-height:115%;mso-pagination:widow-orphan;font-size:11.0pt;font-family:"Calibri","sans-serif";mso-ascii-font-family:Calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:Calibri;mso-hansi-theme-font:minor-latin;}</style><![endif]--><p class="MsoNormal" style="margin-top:0cm;margin-right:-19.3pt;margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;line-height:normal;mso-pagination:none;mso-layout-grid-align:none;text-autospace:none"><span style="font-size:14.0pt;font-family:GillSans-Light;mso-bidi-font-family:GillSans-Light;color:#080808">La danse est souvent réduite dans l''opinion à une expressionformelle. Pourtant, au delà de l''esthétisme, cet art, dans sa pratique, serévèle un formidable vecteur d''émotions et un outil insoupçonné dedéveloppement personnel et d''ouverture à l''autre. En 2013, la compagnie de danseAToU de proposer la création d''un spectacle à 75 habitants de deux communes duGrand Lyon. Pendant 6 mois AToU accompagne ce groupe hétérogène, au traversd''ateliers hebdomadaires afin d''arriver jusqu''à l''aboutissement du processus :La scène.</span></p><span style="font-size:14.0pt;line-height:115%;font-family:GillSans-Light;mso-fareast-font-family:"Times New Roman";mso-fareast-theme-font:minor-fareast;mso-bidi-font-family:GillSans-Light;color:#080808;mso-ansi-language:FR;mso-fareast-language:FR;mso-bidi-language:AR-SA">"TransForme" est uneaventure artistique exceptionnelle, où les singularités de chacun nourrissent,au delà des milieux socio-culturels, des âges ou des capacités physiques, unpropos commun. Celui de croire que l''autre est avant tout une source derichesse et de partage plutôt qu''une menace pour soi.</span>', '', '', ''),
(7, 'test', 'qsdsc', '', '', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `ateliers_lieux`
--

INSERT INTO `ateliers_lieux` (`ID`, `lieu`, `adresse`, `adresseGps`, `infosMetro`, `infosBus`, `infosVoiture`) VALUES
(37, 'Studio Carmagnole', '4 avenue Bataillon Carmagnole – 69120 Vaulx en Vel', 'test', '', '', '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `nubes`
--

INSERT INTO `nubes` (`ID`, `dates`, `heureDebut`, `heureFin`, `lieuxAteliersID`) VALUES
(27, '2014-04-03', '00:00:00', '00:00:00', 0),
(28, '2014-04-15', '00:00:00', '00:00:00', 0),
(30, '2014-04-20', '00:00:00', '00:00:00', 0),
(31, '2014-04-29', '10:00:00', '12:00:00', 0),
(32, '2014-04-23', '10:05:00', '13:12:00', 0);

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
