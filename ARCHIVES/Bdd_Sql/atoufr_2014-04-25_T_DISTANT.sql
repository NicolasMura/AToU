-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Client: mysql.atou.fr
-- Généré le: Ven 25 Avril 2014 à 16:08
-- Version du serveur: 5.5.35-log
-- Version de PHP: 5.4.27

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
  `statut` enum('actionPresente','actionActuelle','actionAvenir','actionPrecedente') NOT NULL,
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
  `filenamePhotoMobile` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `actions_culturelles`
--

INSERT INTO `actions_culturelles` (`ID`, `titre`, `titreBloc`, `chapo`, `interTitre`, `auteur`, `resume`, `resumeMobile`, `accroche`, `verbatim`, `verbatimAuteur`, `anneeCreation`, `duree`, `statut`, `notesTitre`, `notesTexte`, `notesAuteur`, `urlVideo`, `urlPresse`, `urlFiche`, `photosID`, `articlesID`, `representationsID`, `active`, `filenamePhotoMobile`) VALUES
(4, 'TransFORME', '', 'La danse est souvent réduite dans l''opinion à une expression formelle. Pourtant, au delà de l''esthétisme, cet art, dans sa pratique, se révèle un formidable vecteur d''émotions et un outil insoupçonné de développement personnel et d''ouverture à l''autre.', '"TransForme", une aventure artistique exceptionnelle et hors norme', '', '<!--[if gte mso 9]><xml> <o:OfficeDocumentSettings>  <o:AllowPNG></o:AllowPNG> </o:OfficeDocumentSettings></xml><![endif]--><!--[if gte mso 9]><xml> <w:WordDocument>  <w:View>Normal</w:View>  <w:Zoom>0</w:Zoom>  <w:TrackMoves></w:TrackMoves>  <w:TrackFormatting></w:TrackFormatting>  <w:HyphenationZone>21</w:HyphenationZone>  <w:PunctuationKerning></w:PunctuationKerning>  <w:ValidateAgainstSchemas></w:ValidateAgainstSchemas>  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>  <w:DoNotPromoteQF></w:DoNotPromoteQF>  <w:LidThemeOther>FR</w:LidThemeOther>  <w:LidThemeAsian>JA</w:LidThemeAsian>  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>  <w:Compatibility>   <w:BreakWrappedTables></w:BreakWrappedTables>   <w:SnapToGridInCell></w:SnapToGridInCell>   <w:WrapTextWithPunct></w:WrapTextWithPunct>   <w:UseAsianBreakRules></w:UseAsianBreakRules>   <w:DontGrowAutofit></w:DontGrowAutofit>   <w:SplitPgBreakAndParaMark></w:SplitPgBreakAndParaMark>   <w:EnableOpenTypeKerning></w:EnableOpenTypeKerning>   <w:DontFlipMirrorIndents></w:DontFlipMirrorIndents>   <w:OverrideTableStyleHps></w:OverrideTableStyleHps>  </w:Compatibility>  <m:mathPr>   <m:mathFont m:val="Cambria Math"></m:mathFont>   <m:brkBin m:val="before"></m:brkBin>   <m:brkBinSub m:val="--"></m:brkBinSub>   <m:smallFrac m:val="off"></m:smallFrac>   <m:dispDef></m:dispDef>   <m:lMargin m:val="0"></m:lMargin>   <m:rMargin m:val="0"></m:rMargin>   <m:defJc m:val="centerGroup"></m:defJc>   <m:wrapIndent m:val="1440"></m:wrapIndent>   <m:intLim m:val="subSup"></m:intLim>   <m:naryLim m:val="undOvr"></m:naryLim>  </m:mathPr></w:WordDocument></xml><![endif]--><!--[if gte mso 9]><xml> <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="true"  DefSemiHidden="true" DefQFormat="false" DefPriority="99"  LatentStyleCount="276">  <w:LsdException Locked="false" Priority="0" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Normal"></w:LsdException>  <w:LsdException Locked="false" Priority="9" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="heading 1"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 2"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 3"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 4"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 5"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 6"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 7"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 8"></w:LsdException>  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 9"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 1"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 2"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 3"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 4"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 5"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 6"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 7"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 8"></w:LsdException>  <w:LsdException Locked="false" Priority="39" Name="toc 9"></w:LsdException>  <w:LsdException Locked="false" Priority="35" QFormat="true" Name="caption"></w:LsdException>  <w:LsdException Locked="false" Priority="10" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Title"></w:LsdException>  <w:LsdException Locked="false" Priority="1" Name="Default Paragraph Font"></w:LsdException>  <w:LsdException Locked="false" Priority="11" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Subtitle"></w:LsdException>  <w:LsdException Locked="false" Priority="22" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Strong"></w:LsdException>  <w:LsdException Locked="false" Priority="20" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Emphasis"></w:LsdException>  <w:LsdException Locked="false" Priority="59" SemiHidden="false"   UnhideWhenUsed="false" Name="Table Grid"></w:LsdException>  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Placeholder Text"></w:LsdException>  <w:LsdException Locked="false" Priority="1" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="No Spacing"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 1"></w:LsdException>  <w:LsdException Locked="false" UnhideWhenUsed="false" Name="Revision"></w:LsdException>  <w:LsdException Locked="false" Priority="34" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="List Paragraph"></w:LsdException>  <w:LsdException Locked="false" Priority="29" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Quote"></w:LsdException>  <w:LsdException Locked="false" Priority="30" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Intense Quote"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 1"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 2"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 3"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 4"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 5"></w:LsdException>  <w:LsdException Locked="false" Priority="60" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Shading Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="61" SemiHidden="false"   UnhideWhenUsed="false" Name="Light List Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="62" SemiHidden="false"   UnhideWhenUsed="false" Name="Light Grid Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="63" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 1 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="64" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Shading 2 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="65" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 1 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="66" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium List 2 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="67" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 1 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="68" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 2 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="69" SemiHidden="false"   UnhideWhenUsed="false" Name="Medium Grid 3 Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="70" SemiHidden="false"   UnhideWhenUsed="false" Name="Dark List Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="71" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Shading Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="72" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful List Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="73" SemiHidden="false"   UnhideWhenUsed="false" Name="Colorful Grid Accent 6"></w:LsdException>  <w:LsdException Locked="false" Priority="19" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Subtle Emphasis"></w:LsdException>  <w:LsdException Locked="false" Priority="21" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Intense Emphasis"></w:LsdException>  <w:LsdException Locked="false" Priority="31" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Subtle Reference"></w:LsdException>  <w:LsdException Locked="false" Priority="32" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Intense Reference"></w:LsdException>  <w:LsdException Locked="false" Priority="33" SemiHidden="false"   UnhideWhenUsed="false" QFormat="true" Name="Book Title"></w:LsdException>  <w:LsdException Locked="false" Priority="37" Name="Bibliography"></w:LsdException>  <w:LsdException Locked="false" Priority="39" QFormat="true" Name="TOC Heading"></w:LsdException> </w:LatentStyles></xml><![endif]--><!--[if gte mso 10]><style> /* Style Definitions */table.MsoNormalTable{mso-style-name:"Tableau Normal";mso-tstyle-rowband-size:0;mso-tstyle-colband-size:0;mso-style-noshow:yes;mso-style-priority:99;mso-style-parent:"";mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-para-margin:0cm;mso-para-margin-bottom:.0001pt;mso-pagination:widow-orphan;font-size:10.0pt;font-family:"Times New Roman";}</style><![endif]--><!--StartFragment--><p class="MsoNormal"><span style="font-size:12.0pt;font-family:Arial;color:#080808">En 2012, la compagnie de danse AToU décide d''embarquer dans la création d''un spectacle une soixantaine d''habitants de Vaulx-en-Velin et de Ste Foy-lès-Lyon, deux communes du Grand Lyon. Pendant six mois, la chorégraphe japonaise Anan Atoyama et le danseur Marc Ribault accompagnent ce groupe hétérogène, au travers d''ateliers hebdomadaires mêlant apprentissage technique et création chorégraphique, afin d''arriver à l''aboutissement du processus : la scène.</span></p><p class="MsoNormal">« TransForme » est une aventure artistique exceptionnelle et hors norme, où les singularités de chacun nourrissent, au-delà des milieux socio-culturels, des âges ou des capacités physiques, un propos commun : celui de croire que l''autre est avant tout une source de richesse et de partage plutôt qu''une menace pour soi.</p><p class="MsoNormal"><span style="line-height: 15pt;">TransForme a germé lorsque des participants de la Biennale 2012ont fait part de leur envie de prolonger l''aventure avec AToU (qui avait chorégraphié le Défilé pour la ville de Vaulx-en-Velin) et de continuer à danser ensemble.</span><span style="line-height: 20px;"><br></span></p><p class="MsoNormal" style="line-height:15.0pt;mso-pagination:none;mso-layout-grid-align:none;text-autospace:none"><span style="font-size:12.0pt;font-family:Arial;color:#080808"><b style="font-size:12.0pt;font-family:Arial;color:#080808">L''idée fondatrice de TransForme est de faire connaître et partager la force de la danse. </b></span></p><p class="MsoNormal" style="line-height:15.0pt;mso-pagination:none;mso-layout-grid-align:none;text-autospace:none"><span style="font-size:12.0pt;font-family:Arial;color:#080808">Pour cela, trois axes de travail ont été développés :<o:p></o:p></span></p><p class="MsoNormal" style="line-height:15.0pt;mso-pagination:none;mso-layout-grid-align:none;text-autospace:none"><span style="font-size:12.0pt;font-family:Arial;color:#080808">- Rassembler des danseurs venus de tout horizon autour d''un objectif commun ;<o:p></o:p></span></p><p class="MsoNormal" style="line-height:15.0pt;mso-pagination:none;mso-layout-grid-align:none;text-autospace:none"><span style="font-size:12.0pt;font-family:Arial;color:#080808">- Démontrer qu''au-delà d''une forme esthétique, cet art est un puissant vecteur d''émotions ;<o:p></o:p></span></p><p class="MsoNormal" style="line-height:15.0pt;mso-pagination:none;mso-layout-grid-align:none;text-autospace:none"><span style="font-size:12.0pt;font-family:Arial;color:#080808">- Connaître les joies liées à la scène.</span></p><p class="MsoNormal" style="line-height:15.0pt;mso-pagination:none;mso-layout-grid-align:none;text-autospace:none"><span style="line-height: 15pt;">L''expérience de TransForme fut très enrichissante, à de multiples niveaux, à la fois pour les participants ainsi que pour AToU. Le documentaire « Transforme », réalisé par une équipe vidéo qui a suivi le projet sur les trois derniers mois, retrace parfaitement l''intensité et l''état d''esprit du projet.</span></p><p class="MsoNormal" style="line-height:15.0pt;mso-pagination:none;mso-layout-grid-align:none;text-autospace:none"></p><p class="MsoNormal" style="line-height:15.0pt;mso-pagination:none;mso-layout-grid-align:none;text-autospace:none"><b style="color: rgb(8, 8, 8); font-family: Arial; font-size: 12pt; line-height: 15pt;"><b style="color: rgb(8, 8, 8); font-family: Arial; font-size: 12pt; line-height: 15pt;">Une nouvelle création, avec les mêmes principes, est d''ailleurs lancée pour l''année 2014.</b></b></p><!--EndFragment-->', '', 'L''idée fondatrice de TransForme est de faire connaître et partager la force de la danse.', 'Je kiffe TRansform', 'Fio', 2012, '120 min', 'actionPresente', 'A travers la forme', 'L''expérience de TransForme fut très enrichissante, à de multiples niveaux, à la fois pour les participants ainsi que pour AToU. Le documentaire " Transforme", réalisé par une équipe vidéo qui a suivi le projet sur les trois derniers mois, retrace parfaitement l''intensité et l''état d''esprit du projet.', 'Anan Atoyama et le danseur Marc Ribault ', '90169845', '', '', 0, 0, 0, 1, NULL),
(5, 'ICHIGO ICHIE', '', 'Cette expression japonaise est empruntée à la tradition ancestrale de la cérémonie du thé. Traduite littéralement par “Une chance, une rencontre”, elle signifie “Chéris chaque rencontre car elle n''aura lieu qu''une seule fois”.', 'Votre message ici', '', 'Votre message ici', 'Votre message ici', 'Votre message ici', '“Sous la caresse magique du beau s''éveillent les cordes secrètes de notre être”\r\n', '', 2014, '', 'actionActuelle', 'Pourquoi proposer ces soirées Ichigo Ichie ?', 'Travailler dans le milieu artistique et permettre à une équipe de vivre de ce travail demande beaucoup d''engagements, de coopération et parfois de compromis avec les acteurs du milieu, que ce soient avec les artistes, les techniciens, les directeurs de théâtre ou les subventionneurs publics et privés. J''ai eu l''envie d''équilibrer cette complexité avec une action beaucoup plus simple, où les contraintes et mises en oeuvre sont réduites au minimum : Un espace vide, un peu de lumière, deux artistes qui créent ensemble sur l''instant, des personnes qui assistent à l''événement, rien de plus. L expression de l''énergie créative à l''état brut et concentré, sans détours ni artifices.', '', '78464265', '', '', 0, 0, 0, 1, NULL),
(7, 'AToU Tohoku Project', '', 'L''art et la culture restent des lieux de création, mais aussi de questionnement et de réflexion pour aider à comprendre et redonner du sens au monde qui nous entoure.  Les évènements qui secouent le monde actuellement rendent cette tâche encore plus indispensable.', '« AToU Tohoku Project », projet entièrement bénévole, ', '', 'La motivation de la compagnie était triple. D''une part, la chorégraphie proposée pour le Défilé était fortement inspirée des défilés folkloriques japonais. Il était donc intéressant d''un point de vue artistique de faire participer des danseurs qui ont une grande habitude des manifestations de ce style. Le thème étant Babel, intégrer une communauté non française au projet avait tout son sens. D''autre part, c''était l''occasion d''apporter son soutien aux victimes du tsunami de mars 2011 qui avait frappé la région de Fukushima, entrainant la mort de 40 000 japonais et l''évacuation et le relogement de millions d''autres. Enfin, la ville de Vaulx-en-Velin, ville qui accueille AToU, est un haut lieu français du brassage culturel avec plus de 55 nationalités représentées. Il était donc de tradition de profiter de l''occasion pour faire connaître un peu mieux la culture japonaise aux vaudais, en multipliant les rencontres avec les jeunes japonais. \r\nLe projet fut présenté à la Fondation de France qui apporta son soutien financier pour les transports. AToU Tohoku Project se déroula en trois volets : le premier au Japon et les deux suivants en Rhône Alpes.\r\n\r\n1/ Le volet japonais\r\n\r\nEn janvier 2012, la chorégraphe japonaise Anan Atoyama est partie deux semaines au Japon afin de rencontrer les membres de Wonder Namié, une compagnie de danse folklorique ayant reçu plusieurs prix au cours des dix dernières années, grâce au développement de son répertoire avec une soixantaine de danseurs. La troupe était originaire de Namié, dans la préfecture de Fukushima. Cette ville est située à une vingtaine de kilomètres de la centrale nucléaire qui a explosé le 11 mars 2011. Tous les habitants des environs ont dû se reloger dans les quatre autres villes de la région. Anan Atoyama avait lu dans la presse japonaise que les jeunes danseurs de Wander Namié avaient depuis des difficultés à se retrouver et à continuer à répéter et à danser ensemble. Certains de ses jeunes membres souffraient de la disparition de leur famille et éprouvaient de grandes difficultés pour s’intégrer à un nouveau rythme de vie, un nouvel environnement, loin de leurs amis. Des ateliers furent organisés afin qu’Anan transmette la chorégraphie du Défilé et apprenne à les connaître et une sélection, malheureusement nécessaire, de huit danseurs, fut effectuée sur des critères d''âge et de motivation.\r\n\r\n2/ Les dix jours à Vaulx-en-Velin et dans la région\r\n\r\nLes huit danseurs, âgés de 12 à 17 ans et accompagnés du président de Wonder Namié, sont arrivés en France le 30 août 2012. Chacun d''entre eux fut hébergé par une famille vaudaise ou fidésienne, afin de multiplier les échanges culturels. Le groupe avait, parallèlement à la chorégraphie du Défilé, préparé un programme de danse folklorique japonaise, avec instruments de percussion et costumes. Le programme jusqu''au Défilé était chargé :\r\n\r\n- 31 août 2012 : Répétition du Défilé sur Vaulx-en-Velin. Pot d’accueil organisé à l’Espace Carco en leur honneur. \r\n- 1er septembre 2012 : Répétition sur Vaulx-en-Velin.\r\n- 2 septembre : visite de la ville médiévale de Pérouges et de l''exposition de kimonos aux soieries Bonnet.\r\n- 3 septembre 2012 : Spectacles du groupe Wander Namie à Vaulx-en-Velin, dans une maison de retraite et deux écoles primaires.\r\n- 4 septembre 2012 : Répétition sur Vaulx-en-Velin et participation à une après-midi « Découverte des arts japonais » avec un atelier origami, un atelier calligraphie, un atelier cuisine et un atelier ikebana .\r\n- 5 septembre 2012 : Jeu de piste organisé dans les rues de Lyon en partenariat avec la maison des jeunes de Ste Foy-Lès-Lyon. Nouveau spectacle du groupe sur Vaulx-en-Velin, en partenariat avec la MJC de la ville.\r\n- 6 septembre 2012 : Sortie culturelle a Annecy.\r\n- 7 septembre 2012 : Spectacle du groupe Wander Namie à Sainte-Foy-lès-Lyon dans un foyer pour déficients mentaux.\r\n- 8 septembre 2012 : Répétition générale à Vaulx-en-Velin.\r\n\r\n3/ Le Grand Jour\r\n \r\nLe 9 septembre 2012 se déroula le Défilé de la Biennale de Lyon. Les huit danseurs japonais avaient participé aux dernières répétitions générales et se trouvaient parfaitement intégrés au groupe de Vaulx-Ste Foy, composé de 150 danseurs. Ce fut évidemment un moment inoubliable de danse avec plus de 2 000 autres danseurs et devant 120 000 spectateurs.\r\nLes rires et les larmes de la dernière soirée témoignent de l''intensité de ces dix jours et les moments inoubliables qui y ont été gravés, autant du côté de Wonder Namié que des français qui ont participé à l''aventure.\r\n\r\n\r\nCe projet fut symbolique de la fraternité que peuvent témoigner les êtres humains. L''accueil de ces jeunes, confrontés au Japon à une situation précaire, fut exemplaire dans sa générosité et sa dignité. De nombreuses personnes se sont mobilisées bénévolement afin que toutes ces rencontres deviennent possibles. AToU espère que cet échange a planté une graine dans le cœur des Français et des jeunes Japonais, une graine qui un jour fleurira à sa façon.\r\nLa chorégraphe Anan Atoyama continue de s''impliquer pour Fukushima au travers de l''association " Nos voisins lointains 311 », dont elle est la trésorière. La population de la région de Fukushima, dont la traduction littérale est paradoxalement « l''île de la fortune », doivent affronter une situation alarmante, dont les répercutions  devront être endurées encore pour des décennies.\r\n', 'Votre message ici', '« AToU Tohoku Project », projet entièrement bénévole, fut lancé lors du Défilé de la Biennale 2012 p', '', '', 0000, '', 'actionActuelle', '', '', '', 'Votre message ici', '', '', 0, 0, 0, 1, NULL),
(6, 'Bab el Bal', 'Un projet réunissant plus de 300 participants pour le défilé de la Biennale de Lyon.', 'Votre message ici', 'Votre message ici', 'Auteur', 'Votre message ici', 'Votre message ici', 'Votre message ici', '', '', 2009, '', 'actionPrecedente', '', 'Votre message ici', '', '', '', '', 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `actualites`
--

CREATE TABLE IF NOT EXISTS `actualites` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `texte` text NOT NULL,
  `filenamePhotoMobile` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `actualites`
--

INSERT INTO `actualites` (`ID`, `titre`, `texte`, `filenamePhotoMobile`) VALUES
(1, 'Actualité n°1', 'Texte de l''actualité n°1', 'yhfghrgh'),
(3, 'Les ateliers Atou', 'Les ateliers Atou\r\nFestiv'' Amphis\r\nVen. 27 juin - 19h30', 'mobile_actu_les-ateliers-atou.jpg'),
(4, 'Actualité n°2', 'Texte de la 2ème actu', '');

-- --------------------------------------------------------

--
-- Structure de la table `adherents`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `adherents`
--

INSERT INTO `adherents` (`ID`, `nom`, `prenom`, `adresse`, `ville`, `telephone`, `mail`, `numeroAdherent`, `login`, `motDePasse`, `atelier`, `niveau`, `nubesDate`) VALUES
(1, 'Adam', 'Anne', '4 rue des Maraichers', 'Vaulx', '06 51 20 22 02', 'anadam22@hotmail.fr', '13/14-005', '', 'azer', 'adultes Vaulx', 'adherent', '2014-04-29'),
(2, 'Arthus', 'Corinne', '29 rue Jean Jaurès ', 'Vaulx', '06 31 78 11 73', 'fayararthus@free.fr', '13/14-016', '', 'qsdf', 'adultes Vaulx', 'adherent', '0000-00-00'),
(3, 'Benchke', 'Marie Jo', '10 rue du 8 mai', 'Sainte Foy', '06 74 78 42 20', 'mjob633@orange.fr', '13/14-001', '', '', 'adultes Ste Foy', 'adherent', '2014-04-16'),
(29, 'Fiorèse', 'Jérôme', '12, rue des lilas', 'Paris', '064645454', 'jerome@fiorese.fr', '3546544564', 'jerome', 'fiorese', 'Nubes', 'adherent', '2014-04-28'),
(30, 'Mura', 'Nicolas', '', '', '', 'nicolas.mura@gmail.com', '', 'nicolas', 'mura', '', 'adherent', '2014-04-26'),
(32, 'Vagne', 'Cécile', '', '', '', 'cecile.vagne@hotmail.fr', '', 'cecile', 'vagne', '', 'adherent', '2014-05-17'),
(33, 'Bellon-Gronnier', 'Roger', '', '', '', 'rbellongronnier@gmail.com', '', 'roger', 'bellon', '', 'adherent', '2014-05-17'),
(34, 'Dubois', 'Manon', '', '', '', 'manondubois@hotmail.fr', '', 'manon', 'dubois', '', 'adherent', '2014-04-26');

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

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

CREATE TABLE IF NOT EXISTS `articles` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `articlePresse` text NOT NULL,
  `titre` varchar(100) NOT NULL,
  `dates` date NOT NULL,
  `urlArticle` varchar(60) NOT NULL,
  `creationsID` smallint(6) NOT NULL,
  `actions_culturellesID` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`ID`, `articlePresse`, `titre`, `dates`, `urlArticle`, `creationsID`, `actions_culturellesID`) VALUES
(23, '', 'test article', '2014-04-01', 'action_transforme_article_presse_1.pdf', 0, 4),
(24, '', 'Le Progrès', '2013-09-16', 'creation_shinmu_article_presse_1.pdf', 1, 0),
(25, '', 'Lyon PLus', '2013-10-10', 'creation_shinmu_article_presse_25.pdf', 1, 0),
(26, '', 'Lyon Capitale', '2013-10-09', 'creation_shinmu_article_presse_26.pdf', 1, 0),
(27, '', 'Le Progrès', '2013-10-10', 'creation_shinmu_article_presse_27.pdf', 1, 0),
(28, '', 'Vaulx-en-Velin Journal', '2013-10-02', 'creation_shinmu_article_presse_28.pdf', 1, 0),
(29, '', 'Radio Pluriel', '2012-10-18', 'creation_welcome_article_presse_1.pdf', 23, 0),
(30, '', 'Artist up ', '2012-10-18', 'creation_welcome_article_presse_30.pdf', 23, 0),
(31, '', 'Vaul-en-Velin Journal', '2012-10-17', 'creation_welcome_article_presse_31.pdf', 23, 0),
(32, '', 'Centre Charlie-Chaplin', '2013-03-13', 'creation_welcome_article_presse_32.pdf', 23, 0),
(33, '', 'Le progrès', '2012-10-19', 'creation_welcome_article_presse_33.pdf', 23, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ateliers`
--

CREATE TABLE IF NOT EXISTS `ateliers` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `salle` varchar(250) NOT NULL,
  `texte` text NOT NULL,
  `texteMobile` text NOT NULL,
  `dates` date NOT NULL DEFAULT '0000-00-00',
  `infos` varchar(100) NOT NULL,
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL,
  `adresse` varchar(60) NOT NULL,
  `codePostal` varchar(5) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `adresseGpsDuLieu` varchar(100) NOT NULL,
  `filenamePhotoMobile` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `ateliers`
--

INSERT INTO `ateliers` (`ID`, `titre`, `salle`, `texte`, `texteMobile`, `dates`, `infos`, `heureDebut`, `heureFin`, `adresse`, `codePostal`, `ville`, `adresseGpsDuLieu`, `filenamePhotoMobile`) VALUES
(10, 'Malval', 'Salle Edith Piaf ', 'Xxx', 'Toujours poussée par son envie de faire partager la richesse de la danse à tous, un atelier hebdomadaire est mené par Anan Atoyama avec des résidents du foyer Malval, au centre de Vaulx-en-Velin. Le foyer d''hébergement Malval accueille des personnes handicapées physiques, souvent en fauteuils. Les résidents sont initiés aux techniques de danse et explorent leur créativité chorégraphique sur les indications de la chorégraphe, en petits groupes ou individuellement. Ces danseurs amateurs présenteront leur travail collectif en juin.\r\n', '0000-00-00', 'Tous les mercredis', '18:30:00', '19:45:00', '41, rue Gabriel Péri ', '69120', 'Vaulx-en- Velin', '45.777611,4.916006', 'mobile_atelier_malval.jpg'),
(2, 'TransFORME', 'Ce champ n''est pas utilisé', 'Xxx', 'La danse est souvent réduite dans l''opinion à une expression esthétique. Pourtant cet art, dans sa pratique, se révèle un formidable vecteur d''émotions et un outil insoupçonné de développement personnel et d''ouverture à l''autre. En 2013, la compagnie de danse AToU décide de proposer la création d''un spectacle à 75 habitants de deux communes du Grand Lyon. Pendant 6 mois AToU accompagne ce groupe hétérogène, au travers d''ateliers hebdomadaires afin d''arriver jusqu''à l''aboutissement du processus : la scène. « TransForme » est une aventure artistique exceptionnelle, où les singularités de chacun nourrissent un propos commun : Celui de croire que l''autre est avant tout une source de richesse et de partage plutôt qu''une menace pour soi.\r\n', '0000-00-00', '', '00:00:00', '00:00:00', 'Rien', 'Rien', 'Rien', 'Rien', 'mobile_atelier_autour-de-transforme-2014.jpg'),
(9, 'Neruda', 'Gymnase de l''école Neruda', 'Xxx', 'Toujours poussée par son envie de faire partager la richesse de la danse à tous, un atelier hebdomadaire est mené par Anan Atoyama avec une classe de CE1 de l''école Neruda au sud de Vaulx-en-Velin. Les enfants sont initiés aux techniques de danse et explorent leur créativité chorégraphique sur les indications de la chorégraphe, en  petits groupes ou individuellement. Les danseurs en herbe présenteront leur travail collectif en juin.\r\n', '0000-00-00', 'Tous les mardis', '16:30:00', '17:30:00', '19, avenue Roger Salengro', '69120', 'Vaulx-en-Velin', '45.764604,4.929664', 'mobile_atelier_neruda.jpg'),
(8, 'Transforme répétitions générales', 'Gymnase Blondin', 'Xxx', 'La danse est souvent réduite dans l''opinion à une expression esthétique. Pourtant cet art, dans sa pratique, se révèle un formidable vecteur d''émotions et un outil insoupçonné de développement personnel et d''ouverture à l''autre. En 2013, la compagnie de danse AToU décide de proposer la création d''un spectacle à 75 habitants de deux communes du Grand Lyon. Pendant 6 mois AToU accompagne ce groupe hétérogène, au travers d''ateliers hebdomadaires afin d''arriver jusqu''à l''aboutissement du processus : la scène. « TransForme » est une aventure artistique exceptionnelle, où les singularités de chacun nourrissent un propos commun : Celui de croire que l''autre est avant tout une source de richesse et de partage plutôt qu''une menace pour soi.\r\n', '2014-05-24', '', '10:00:00', '18:00:00', '1, rue Maximilien de Robespierre', '69120', 'Vaulx-en-Velin', '45.776384,4.917586', 'mobile_atelier_transforme-repetitions-generales.jpg'),
(7, 'Transforme WitThévSteFoy', 'Ramdam', 'Xxx', 'La danse est souvent réduite dans l''opinion à une expression esthétique. Pourtant cet art, dans sa pratique, se révèle un formidable vecteur d''émotions et un outil insoupçonné de développement personnel et d''ouverture à l''autre. En 2013, la compagnie de danse AToU décide de proposer la création d''un spectacle à 75 habitants de deux communes du Grand Lyon. Pendant 6 mois AToU accompagne ce groupe hétérogène, au travers d''ateliers hebdomadaires afin d''arriver jusqu''à l''aboutissement du processus : la scène. « TransForme » est une aventure artistique exceptionnelle, où les singularités de chacun nourrissent un propos commun : Celui de croire que l''autre est avant tout une source de richesse et de partage plutôt qu''une menace pour soi.\r\n', '2014-05-22', '', '18:45:00', '20:45:00', '16, chemin des Santons', '69110', 'Sainte-Foy-lès-Lyon', '45.724742,4.785031', 'mobile_atelier_transforme-witthevstefoy.jpg'),
(6, 'Transforme Vaulx-en-Velin', 'Maison Carmagnole', 'Xxx', 'La danse est souvent réduite dans l''opinion à une expression esthétique. Pourtant cet art, dans sa pratique, se révèle un formidable vecteur d''émotions et un outil insoupçonné de développement personnel et d''ouverture à l''autre. En 2013, la compagnie de danse AToU décide de proposer la création d''un spectacle à 75 habitants de deux communes du Grand Lyon. Pendant 6 mois AToU accompagne ce groupe hétérogène, au travers d''ateliers hebdomadaires afin d''arriver jusqu''à l''aboutissement du processus : la scène. « TransForme » est une aventure artistique exceptionnelle, où les singularités de chacun nourrissent un propos commun : Celui de croire que l''autre est avant tout une source de richesse et de partage plutôt qu''une menace pour soi.\r\n', '0000-00-00', 'Tous les vendredis', '18:15:00', '20:00:00', '8, avenue Bataillon Carmagnole-Liberté', '69120', 'Vaulx-en-Velin', '45.758976,4.922618', 'mobile_atelier_transforme-vaulx-en-velin.jpg'),
(5, 'Transforme Sainte-Foy-lès-Lyon', 'Maison communale des Bruyères', 'Xxx', 'La danse est souvent réduite dans l''opinion à une expression esthétique. Pourtant cet art, dans sa pratique, se révèle un formidable vecteur d''émotions et un outil insoupçonné de développement personnel et d''ouverture à l''autre. En 2013, la compagnie de danse AToU décide de proposer la création d''un spectacle à 75 habitants de deux communes du Grand Lyon. Pendant 6 mois AToU accompagne ce groupe hétérogène, au travers d''ateliers hebdomadaires afin d''arriver jusqu''à l''aboutissement du processus : la scène. « TransForme » est une aventure artistique exceptionnelle, où les singularités de chacun nourrissent un propos commun : Celui de croire que l''autre est avant tout une source de richesse et de partage plutôt qu''une menace pour soi.\r\n', '0000-00-00', 'Tous les jeudis', '19:30:00', '21:15:00', '55, boulevard des Provinces', '69110', 'Sainte-Foy-lès-Lyon', '45.747125,4.799912', 'mobile_atelier_transforme-sainte-foy-les-lyon.jpg'),
(4, 'Transforme Line Thévenin', 'Maison communale des Bruyères', 'Xxx', 'La danse est souvent réduite dans l''opinion à une expression esthétique. Pourtant cet art, dans sa pratique, se révèle un formidable vecteur d''émotions et un outil insoupçonné de développement personnel et d''ouverture à l''autre. En 2013, la compagnie de danse AToU décide de proposer la création d''un spectacle à 75 habitants de deux communes du Grand Lyon. Pendant 6 mois AToU accompagne ce groupe hétérogène, au travers d''ateliers hebdomadaires afin d''arriver jusqu''à l''aboutissement du processus : la scène. « TransForme » est une aventure artistique exceptionnelle, où les singularités de chacun nourrissent un propos commun : Celui de croire que l''autre est avant tout une source de richesse et de partage plutôt qu''une menace pour soi.\r\n', '0000-00-00', 'Tous les jeudis', '18:15:00', '19:30:00', '55, boulevard des Provinces', '69110', 'Sainte-Foy-lès-Lyon', '45.747125,4.799912', 'mobile_atelier_transforme-line-thevenin.jpg'),
(3, 'Transforme Witkowska', 'Salle de réunion du Centre Witkowska', 'Xxx', 'La danse est souvent réduite dans l''opinion à une expression esthétique. Pourtant cet art, dans sa pratique, se révèle un formidable vecteur d''émotions et un outil insoupçonné de développement personnel et d''ouverture à l''autre. En 2013, la compagnie de danse AToU décide de proposer la création d''un spectacle à 75 habitants de deux communes du Grand Lyon. Pendant 6 mois AToU accompagne ce groupe hétérogène, au travers d''ateliers hebdomadaires afin d''arriver jusqu''à l''aboutissement du processus : la scène. « TransForme » est une aventure artistique exceptionnelle, où les singularités de chacun nourrissent un propos commun : Celui de croire que l''autre est avant tout une source de richesse et de partage plutôt qu''une menace pour soi.\r\n', '0000-00-00', 'Tous les lundis', '17:30:00', '18:45:00', '10, rue Simon Jallade', '69110', 'Sainte-Foy-lès-Lyon', '45.747028,4.779529', 'mobile_atelier_transforme-witkowska.jpg'),
(21, 'test', 'test', 'test', 'test', '2014-04-24', '', '00:00:00', '00:00:00', 'test', 'test', 'test', 'test', 'mobile_atelier_test.jpg'),
(1, 'Nubes', '', 'Xxx', 'Ouvert à tous - Niveau débutant\r\n« AToU vous invite à participer à une session de danse-improvisation une fois par mois, au studio Carmagnole. Cette session s’adresse à tous ceux qui, par l’expression du corps, veulent apprendre sur eux-mêmes et sur les autres, que vous soyez professionnels, amateurs ou sans expérience de la danse. Ces sessions seront guidées par Anan Atoyama, la chorégraphe d’AToU. »\r\n', '2014-04-26', '', '00:00:00', '00:00:00', '4 avenue Bataillon Carmagnole – 69120 Vaulx en Velin', '', '', '', 'mobile_atelier_autour-de-nubes.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `ateliers_lieux`
--

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
-- Structure de la table `autres_ateliers`
--

CREATE TABLE IF NOT EXISTS `autres_ateliers` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `collaborateurs`
--

CREATE TABLE IF NOT EXISTS `collaborateurs` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Contenu de la table `collaborateurs`
--

INSERT INTO `collaborateurs` (`ID`, `nom`, `prenom`) VALUES
(1, 'Atoyama', 'Anan'),
(2, 'Ribault', 'Marc'),
(3, 'Hue', 'Edouard'),
(4, 'Marion-Gallois', 'Aurélien'),
(32, 'Gray', 'Macy'),
(31, 'Finch', 'Catrin'),
(17, 'Centre Culturel Charlie Chaplin', ''),
(30, 'Zordan ', 'Sabine'),
(29, 'Zordan', 'Boris'),
(16, 'AToU', ''),
(18, 'Théoriz Crew', ''),
(19, 'Vallart', 'Sébastien'),
(20, 'Douzet', 'Alexane'),
(21, 'Cezette', 'Nadège'),
(22, 'Mbayo', 'Charlotte'),
(23, 'Soros', 'Antoine'),
(24, 'Rimasauskas', 'Stéphane'),
(25, 'Lefievre', 'Adeline'),
(26, 'Ilkawa', 'Shinya'),
(27, 'Matsumoto', 'Miho '),
(28, 'Bertheau', 'Jean-Loup '),
(33, 'Les Monocles', ''),
(34, 'Alain Corneau', '(extrait de « Tous les matins du monde »)'),
(35, 'T.I.N.A.', 'Avec la participation du groupe de rap '),
(36, 'Eymeri', 'Maya '),
(37, 'Hamimouch', 'Nordine '),
(38, 'Nuage', 'S.'),
(39, 'Fous ', 'Adeline '),
(40, 'Charbonneau ', 'Loïc '),
(41, 'Olry', 'Emeline '),
(42, 'Daulin', 'Sylvain '),
(43, 'Faure', 'Anthony '),
(44, 'Guichard', 'Romain '),
(45, 'Ljungkvist', 'Ellinor ');

-- --------------------------------------------------------

--
-- Structure de la table `creations`
--

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
  `statut` enum('creationPresente','creationActuelle','creationPrecedente','creationAvenir','creationArchivee') NOT NULL,
  `notesTitre` varchar(50) NOT NULL,
  `notesTexte` text NOT NULL,
  `notesAuteur` varchar(50) NOT NULL,
  `urlVideo` varchar(250) NOT NULL,
  `urlPresse` varchar(250) NOT NULL,
  `urlFiche` varchar(250) NOT NULL,
  `active` tinyint(1) DEFAULT '0',
  `filenamePhotoMobile` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `creations`
--

INSERT INTO `creations` (`ID`, `titre`, `titreBloc`, `chapo`, `interTitre`, `type`, `auteur`, `resume`, `resumeMobile`, `accroche`, `verbatim`, `verbatimAuteur`, `anneeCreation`, `duree`, `statut`, `notesTitre`, `notesTexte`, `notesAuteur`, `urlVideo`, `urlPresse`, `urlFiche`, `active`, `filenamePhotoMobile`) VALUES
(1, 'ShiNMu', '', '« SHiNMu » emmène le spectateur flotter dans un univers irréel, poétique, et parfois brutal, assis dans une barque dérivant sur le fleuve de son inconscience.                              ', 'Un monde imaginaire, même fou, que le spectateur aura l''impression d''avoir rêvé', 'Trio', 'Anan Atoyama', 'Le rêve est une expérience à la fois très personnelle mais aussi universelle car tout le monde rêve. Aborder le sujet de l’inconscience en utilisant le langage du corps, à travers un processus créatif collectif, est l’ambition de SHiNMu. La chorégraphe débusque, en interrogeant les corps, une parole libérée des contextes sociétal et culturel dans lesquels ils ont été façonnés.\r\n\r\nDes mouvements se révèlent, illogiques et hors normes, faisant ainsi éclater, à fleur de peau, des bulles d’inconscience.\r\n\r\nLe plateau ne s’habille que de tulle sur cette pièce, pour mieux se draper de projections numériques, accentuant l’imaginaire et l’irréel des corps des trois danseurs en mouvement.', '« Nous ne sommes pas d''aujourd''hui ni d''hier, nous sommes d''un âge immense »CG Jung\r\n«SHiNMu» emmène le spectateur flotter dans un univers irréel, poétique, et parfois brutal, assis dans une barque dérivant sur le fleuve de son inconscience. \r\n\r\nUn monde imaginaire, même fou, qu’il aura traversé en délestant, au fil du spectacle, tout repère du monde réel pour se laisser submerger par les voilures de son imagination.\r\nChaque page de ce récit possède de multiples interlignes, et c’est l’inconscient de chacun qui en choisit l’ordre de lecture. Il y a autant de SHiNMu qu’il y a d’imaginaires…\r\n\r\nLe plateau ne s’habille que de tulle sur cette pièce, pour mieux se draper de projections numériques, accentuant l’irréel des corps des deux danseurs en mouvement.\r\n', 'SHiNMu navigue sur l’inconscient corporel de chacun', '« Nous ne sommes pas d''aujourd''hui ni d''hier, nous sommes d''un âge immense. »', 'C.-G. Jung', 2013, '60 minutes', 'creationPresente', 'Intention musicale', '« La musique est le langage de l''indétermination, parce qu''elle conduit avec elle plusieurs lignes de sens sans nous obliger à choisir. Elle ouvre par conséquent un horizon infini, indéfini. La musique est un rêve. » Vladimir Jankélévich\r\nNotre collaboration est née d''une rencontre à travers laquelle la chorégraphe Anan Atoyama a exprimé son désir de plonger dans le monde du rêve. Le rêve qui habite l''idée, le geste, le souffle... la musique. Le rêve, prenant racine dans l''inconscient, va nous amener dans le chemin d''une réalité... probablement la nôtre. Dans cette création, musique et corps, abstraction et matière, s''enlacent afin de créer une certaine ouverture sur un ensemble infini et indéfini de possibilités. La musique rejoint la danse non pas en tant que déterminateur du geste mais plutôt en tant que continuité sonore naissante du sens de ce geste. La musique, véhiculant différents sens, proposera à chacun des clés pour ouvrir les portes de sa propre mémoire.', ' Aurélien Marion-Gallois', '78464265', '', '', 1, 'mobile_creation_shinmu.jpg'),
(2, 'Avant qu''elle ne se fâne', '', '« Il était une foi, Qui, Située dans les tripes, Abreuvait une fleur de vie Avant qu’elle ne se fane »', 'Un monde imaginaire, même fou, que le spectateur aura l''impression d''avoir rêvé', 'Solo', '  ', '« Il était une foi,\r\nQui, \r\nSituée dans les tripes,\r\nAbreuvait une fleur de vie\r\nAvant qu’elle ne se fane »\r\n\r\nCette pièce est le témoignage dansé d’un homme prenant conscience que depuis son enfance, son comportement lui a été dicté par des normes sociétales basées sur la peur de lui-même et de l’autre.\r\nL’effondrement de ses fondations le précipite dans un espace chaotique, fait de libertés et de possibles. \r\nQuels repères alors choisir pour se reconstruire autrement, quelles racines doit-il à nouveau déployer pour puiser l’essence de son existence ?\r\n', '', 'Avant qu''elle ne se fane témoigne de la confrontation d''un homme avec ses peurs profondes', '« Le décès brutal de mon père et le voyage en Inde qui a suivi ont déclenché en moi ce questionnement universel : la mort t’attend au bout de la route, alors comment décides-tu de voyager jusque-là ? »', 'Marc Ribault', 2013, '30 minutes', 'creationActuelle', 'Interview Marc Ribault', 'Anan Atoyama : Marc, pourquoi avoir créé ce solo ?\r\nMarc Ribault : Mon père a été foudroyé d’une crise cardiaque il y a quelques années. Sans que je puisse m’en rendre compte à l’époque, cet événement a déclenché dans mon subconscient une lame de fond qui est devenue une vague déferlant sur ma conscience deux ans plus tard, au retour d’un voyage en Inde. Cette vague noya tous les repères fondamentaux sur lesquels je m’étais construit jusqu’alors. Le mélange d’une crise d’adolescence retardée et d’une crise de la quarantaine avancée… C’est une expérience que j’ai eu besoin de partager, car même si elle est intime et personnelle, le questionnement qu’elle contient, celui du sens de notre existence, est universel et intemporel. C’est un questionnement qui entre facilement en résonance avec le travail de AToU.\r\nA.A : Ce n’est d’ailleurs pas tout à fait un solo…\r\nM.R : En effet, j’ai voulu témoigner d’un cheminement psychologique et émotionnel : c’est un récit. Je ne pense pas que la danse soit faite pour les histoires, je suis plus sensible pour cela à l’écriture, au cinéma ou au théâtre. J’ai donc fait le choix de mêler la puissance de l’indicible, caractéristique de la danse, à des scènes de théâtre avec le comédien et rappeur Boris Zordan, à de la musique Live avec le groupe T.I.N.A et à  des projections vidéos. Tous interprètent une facette différente de mon psychisme, C’est pourquoi je considère cette pièce comme un solo. Mais ne vous inquiétez pas, tout le monde est crédité sur le programme !\r\n Tout cela semble bien riche… Comment as-tu donc « condansé » toutes ces approches ?\r\nJe me suis appliqué à respecter trois règles. \r\nLa première est de n’avoir utilisé que trois musiques dont l’une, la fameuse Toccata en Ré mineur de Bach, interprétée à la harpe, sert de fil conducteur car elle revient tout au long du solo. \r\nLa deuxième règle est d’avoir confié à Boris Zordan, mon inconscient, le rôle d’expliciter par la parole et le jeu le déroulement du récit. Je suis, en dansant, le corps en réaction aux sentiments et aux émotions qui me traversent : l’inconscient, lui, connaît les causes, anticipe les conséquences et maîtrise chaque étape de ce qu’il m’arrive et il prend le public à témoin, comme une sorte de montreur de foire. \r\nEnfin, la troisième règle est de clarifier les étapes. J’ai, en partie, retrouvé mon cheminement dans le Zarathoustra de Nietzsche. Je me suis donc appuyé sur ce texte pour mes propres étapes : celle du chameau, respect de la norme ; celle du lion, la rébellion et le trouble ; et celle de l’enfant, la reconstruction dans la spontanéité.\r\nLes spectateurs ne vont pas forcément saisir tous les degrés de lecture en une seule fois, mais l’essentiel est qu’ils trouvent le propos authentique afin de pouvoir y construire des ponts entre leur histoire et la mienne.\r\nJustement, quels ponts ? Que cherches-tu à partager avec le spectateur, ou à provoquer ?\r\nJe vois chacune de nos existences comme une fleur, qui peut se faner avant que nous ayons pu nous enrichir de sa beauté. Nous vivons dans un pays riche et avons pour la plupart la chance de pouvoir décider de notre vie. Il est facile de confier cette responsabilité à autrui ou de laisser la société décider pour nous et un jour : Pouf ! On n’est plus là ! Nos angoisses et nos peurs sont légitimes, mais les fuir constamment nous fait passer à côté de notre existence. Il faut bien de l’ombre pour qu’il y est de la lumière. Une balançoire ne fait pas que monter ou descendre, sinon, comment vivre la joie de ce moment de suspension entre les deux, ou tous les potentiels se rassemblent dans ce mystère hors de l’espace et du temps ? Avec ce spectacle, j’espère inciter les spectateurs à ne plus avoir peur de se poser la question de leur propre mort. C’est actuellement libérateur pour moi, peut-être le sera-t-il pour eux aussi.\r\n', '', '74579861', '', '', 1, NULL),
(25, 'Râga', 'Râga sonde le désir, au travers du couple Macbeth et de la culture indienne.', '', '', 'Solo', '', '', '', '', '', '', 2011, '30 minutes', 'creationPrecedente', '', '', '', '', '', '', 1, NULL),
(23, 'WelCOME', '', ' ', 'Accueillir ou rejeter ?', 'Quatuor', '', 'Accepter ou refuser ? Un mur se construit, un mur s’effondre. Deux dynamiques que l’on retrouve inévitablement lorsque l’on souhaite la bienvenue à un inconnu ou au changement en nous-mêmes. Accueillir ou rejeter ? Par la poésie des corps, WelCOME exprime, au cœur d’un monde en ébullition, nos expériences autour de cette question, dont la réponse ponctue à la fois la marche de chaque individu mais aussi celle de toute communauté.', '', 'WelCOME questionne les sentiments d’accueil et de rejet', '', '', 2012, '75 minutes', 'creationActuelle', 'Interview Anan Atoyama', 'Marc Ribault : Anan, qu’est-ce qui est à l’origine de la pièce WelCOME ?\r\nAnan Atoyama : Une phrase m’a fortement frappée à la lecture d’un article de voyage par une japonaise qui revenait d’une contrée instable : « J’ai reçu d’innombrables “welcome” exclamés par les habitants. J’ai ressenti à ce moment-là beaucoup de peine ». Alors que “welcome” véhicule généralement un sentiment de paix, de sécurité et de chaleur humaine, il se transforma en tristesse dans l’oreille de cette japonaise.\r\nJ’imagine que cette dernière a vécu ce mot d’accueil comme une invitation des habitants à partager leur histoire, à devenir le témoin de leur situation, sans toutefois qu’elle puisse agir ou changer quoi que ce soit. Ce mot “welcome” avait alors résonné comme le symbole d’une fatalité d’existence, comme le symbole du décalage de condition entre un être et d’autres. Cette lecture m’a rappelé l’ambiguïté du mot “welcome”, et les émotions diverses qui s’en dégagent. Il m’a semblé intéressant d’explorer ses riches symboliques à travers une pièce.\r\n\r\nM.R : Comment as-tu travaillé sur cette pièce avec les danseurs ?\r\nA.A : Je crois que nos histoires individuelles et collectives sont emmagasinées dans nos chairs, et souvent nous n’écoutons pas ce qu’elles ont à nous offrir. C’est ce cadeau précieux que je tente de faire émerger chez les danseurs avec qui je travaille. Cela demande de court-circuiter le mental pour laisser parler l’inconscient et la mémoire au travers du corps. Je cherche, par delà les couches sociétales et culturelles qui nous modèlent à tous les niveaux, la puissance et la voix cachée du corps avec les danseurs.\r\nEt puis, je travaille avec les danseurs sur la notion « être » en opposition à « paraître » et sur l’expression des émotions et des sentiments de manière minimale et concentrée. Evidement, le travail du corps est influencé par ma propre culture, japonaise. \r\n\r\nPourquoi avoir choisi d’utiliser sur scène des caisses en bois ?\r\nLes caisses peuvent tout à la fois nous protéger d’un environnement hostile, et nous empêcher de pénétrer un lieu de refuge. C’est la symbolique du mur, dont l’histoire de l’Humanité est pétrie, qui joue simultanément les deux rôles, protection et rejet, suivant les perspectives. Elles symbolisent aussi la construction, et par là même l’effondrement. On retrouve inévitablement ces deux notions quand on souhaite la bienvenue à l’inconnu ou au changement en nous-mêmes.\r\nEnfin, la matière de ces caisses, le bois, a une portée symbolique très forte pour l’Humanité. L’arbre est dans de nombreuses cultures porteur de bienveillance, de protection, de refuge, du temps qui passe et change… mais il est aussi symbole  d’immobilisme et de dureté. Des associations d’idées qui interfèrent avec celles autour de l’acceptation et du refus, thématiques de WelCOME.\r\n', '', '55804990', '', '', 1, NULL),
(26, 'Daichi', 'Danser linvisible : à la recherche du rêve et de l’inconscient...', '', '', 'Solo', '', '', '', '', '', '', 2008, '30 minutes', 'creationPrecedente', '', '', '', '', '', '', 1, NULL),
(27, 'madness, love & mysticism', 'Les révoltes intimes d’une femme, rythmées par l’album éponyme de John Zorn.', '', '', 'Quatuor', '', '', '', '', '', '', 2010, '75 minutes', 'creationPrecedente', '', '', '', '', '', '', 1, NULL),
(28, 'Ichigo-Ichié', '', 'chapo', '', 'Xxx', '  ', 'resume', 'Cette expression japonaise est empruntée à la tradition ancestrale de la cérémonie du thé. Traduite littéralement par “ Une chance, une rencontre”, elle signifie " Chéris chaque rencontre car elle n''aura lieu qu''une seule fois".\r\n AToU fait une proposition artistique simple et osée : La même soirée, proposer  à un danseur et à un musicien de se rencontrer pour la première fois, de créer un duo sur l''instant en le partageant simultanément avec le public : une seule et unique fois donc. Le tatami devient tapis de danse, le thé se meut en énergie créatrice et ensemble, nous “écoutons l''indicible et contemplons l''invisible”.\r\nLes soirées Ichigo Ichie de AtoU s''organisent une fois par trimestre, avec 4 duos conviés pour chaque session.\r\n', 'Accroche', 'Votre message ici', '', 0000, 'Xxx', 'creationActuelle', '', 'Votre message ici', '', '', '', '', 1, 'mobile_creation_ichigo-ichie.jpg'),
(29, 'Black Rain', '', '« Pluie noire » fut utilisée pour décrire les retombées nucléaires des bombes américaines subies par les Japonais. ', 'Ce solo, énoncé du cœur', 'Solo', '  ', 'Votre message ici', 'Votre message ici', 'Un solo, énoncé du cœur, qui donne corps aux voix éteintes des conflits internationaux.', 'Votre message ici', '', 2008, '30 minutes', 'creationActuelle', '', 'Votre message ici', '', '41615022', '', '', 1, NULL),
(30, 'Mille Oasis', '', 'Un endroit, semblable en apparence à des milliers d’autres. De celui-ci jaillit pourtant une ressource indispensable à la vie. ', 'Votre message ici', ' ', ' ', '<style><!-- /* Font Definitions */@font-face{font-family:"ＭＳ 明朝";mso-font-charset:78;mso-generic-font-family:auto;mso-font-pitch:variable;mso-font-signature:1 134676480 16 0 131072 0;}@font-face{font-family:"Cambria Math";panose-1:2 4 5 3 5 4 6 3 2 4;mso-font-charset:0;mso-generic-font-family:auto;mso-font-pitch:variable;mso-font-signature:3 0 0 0 1 0;}@font-face{font-family:Cambria;panose-1:2 4 5 3 5 4 6 3 2 4;mso-font-charset:0;mso-generic-font-family:auto;mso-font-pitch:variable;mso-font-signature:-536870145 1073743103 0 0 415 0;} /* Style Definitions */p.MsoNormal, li.MsoNormal, div.MsoNormal{mso-style-unhide:no;mso-style-qformat:yes;mso-style-parent:"";margin:0cm;margin-bottom:.0001pt;mso-pagination:widow-orphan;font-size:12.0pt;font-family:Cambria;mso-ascii-font-family:Cambria;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:"ＭＳ 明朝";mso-fareast-theme-font:minor-fareast;mso-hansi-font-family:Cambria;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:minor-bidi;}.MsoChpDefault{mso-style-type:export-only;mso-default-props:yes;font-family:Cambria;mso-ascii-font-family:Cambria;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:"ＭＳ 明朝";mso-fareast-theme-font:minor-fareast;mso-hansi-font-family:Cambria;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:"Times New Roman";mso-bidi-theme-font:minor-bidi;}@page WordSection1{size:612.0pt 792.0pt;margin:70.85pt 70.85pt 70.85pt 70.85pt;mso-header-margin:36.0pt;mso-footer-margin:36.0pt;mso-paper-source:0;}div.WordSection1{page:WordSection1;}--></style><p class="MsoNormal"><span style="font-size:9.0pt;font-family:Helvetica;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman"">Cettedernière ne tarde pas à se manifester et mettre en place les moyens d’exploitercette manne énergétique. Il y a parmi les formes de vie diverses quis’accumulent subitement à cet endroit des êtres humains primitifs, encore sansculture, sans loi ni coutumes.</span></p><p class="MsoNormal"><span style="font-size:9.0pt;font-family:Helvetica;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman"">Commentcet écosystème naissant va-t-il s’organiser et exploiter une ressourceinestimable, mais épuisable.</span></p><p class="MsoNormal"><span style="font-size:9.0pt;font-family:Helvetica;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman""> </span></p><p class="MsoNormal"><span style="font-size:9.0pt;font-family:Helvetica;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman"">Cettenouvelle création continue d’explorer les questionnements abordés dans WelCOMEet SHiNMu : Quel universalisme dans la culture humaine ? Quellesrelations profondes entretient l’être humain avec son environnement ?Qu’est-ce qui nous motive au fond de nous-même ?</span></p><span style="font-size:9.0pt;font-family:Helvetica;mso-fareast-font-family:"Times New Roman";mso-bidi-font-family:"Times New Roman";mso-ansi-language:FR;mso-fareast-language:FR;mso-bidi-language:AR-SA">A nouveau laissant unegrande part d’expérimentation au spectateur, cette pièce s’inspire de laculture traditionnelle japonaise et notamment du Nô, lequel s’appuie sur lechant, la danse, la musique et le théâtre. Le récit de « MilleOasis » se conte au rythme de ces expressions, entremêlé d’interactionsnumériques et humaines.</span>', 'Votre message ici', 'Quelles relations profondes entretient l’être humain avec son environnement ?', 'Votre message ici', '', 2014, '60 minutes', 'creationAvenir', '', 'Votre message ici', '', '', '', '', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

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

CREATE TABLE IF NOT EXISTS `dossier_presse` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `urlDossier` varchar(60) NOT NULL,
  `creationsID` smallint(6) NOT NULL,
  `actions_culturellesID` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `dossier_presse`
--

INSERT INTO `dossier_presse` (`ID`, `titre`, `urlDossier`, `creationsID`, `actions_culturellesID`) VALUES
(19, 'Dossier de presse', 'action_transforme_dossier_presse.pdf', 0, 4);

-- --------------------------------------------------------

--
-- Structure de la table `fiche`
--

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

CREATE TABLE IF NOT EXISTS `fonctions` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `metiers` varchar(50) NOT NULL,
  `creationsID` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

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
(24, 'Artistes infographistes', 0),
(21, 'Texte', 0),
(22, 'Mise en scène des textes', 0),
(25, 'Danseurs collaborateurs', 0),
(27, 'Musique', 0),
(28, 'Vidéos', 0),
(29, 'Décors', 0),
(30, 'Collaborateurs', 0);

-- --------------------------------------------------------

--
-- Structure de la table `fo_col`
--

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
(1, 2, 1),
(1, 2, 23),
(1, 4, 21),
(1, 4, 22),
(1, 5, 26),
(1, 5, 27),
(1, 5, 28),
(1, 6, 16),
(1, 7, 17),
(1, 8, 1),
(1, 9, 1),
(1, 9, 2),
(1, 10, 4),
(1, 11, 24),
(1, 13, 18),
(1, 14, 2),
(2, 1, 2),
(2, 6, 16),
(2, 9, 2),
(2, 9, 29),
(2, 9, 35),
(21, 2, 1),
(21, 2, 2),
(23, 1, 1),
(23, 2, 1),
(23, 2, 23),
(23, 2, 24),
(23, 4, 38),
(23, 4, 39),
(23, 6, 16),
(23, 7, 17),
(23, 9, 1),
(23, 9, 2),
(23, 9, 36),
(23, 9, 37);

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

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

CREATE TABLE IF NOT EXISTS `messages` (
  `ID` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `dates` datetime NOT NULL,
  `commentaires` text NOT NULL,
  `discussionsID` tinyint(3) unsigned NOT NULL,
  `adherentsID` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

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
(12, '2014-04-06 18:16:51', 'Coucou Julie', 5, 29),
(13, '2014-04-23 15:16:06', 'zez', 5, 29),
(14, '2014-04-23 15:16:11', 'zez', 5, 29),
(15, '2014-04-24 17:06:08', 'edede', 5, 29),
(16, '2014-04-24 17:08:21', 'frfrf', 5, 29),
(17, '2014-04-24 17:08:36', 'OoO', 5, 29),
(18, '2014-04-25 10:01:19', 'jiji', 5, 29);

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

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

CREATE TABLE IF NOT EXISTS `nubes` (
  `ID` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `dates` date NOT NULL,
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL,
  `lieuxAteliersID` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Contenu de la table `nubes`
--

INSERT INTO `nubes` (`ID`, `dates`, `heureDebut`, `heureFin`, `lieuxAteliersID`) VALUES
(58, '2014-06-14', '10:00:00', '13:00:00', 0),
(57, '2014-05-17', '10:00:00', '13:00:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `partenaires`
--

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

CREATE TABLE IF NOT EXISTS `photos` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `creationsID` smallint(6) NOT NULL,
  `actions_culturellesID` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=197 ;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`ID`, `nom`, `filename`, `creationsID`, `actions_culturellesID`) VALUES
(130, 'Photo de la création Avant qu''elle ne se fâne', 'creation_avant-qu-elle-ne-se-fane_1.jpg', 2, 0),
(153, 'Photo de l''action culturelle transforme', 'action_transforme_153.jpg', 0, 4),
(144, 'Photo de la création Râga', 'creation_raga_1.jpg', 25, 0),
(131, 'Photo de la création Avant qu''elle ne se fâne', 'creation_avant-qu-elle-ne-se-fane_131.jpg', 2, 0),
(133, 'Photo de la création WelCOME', 'creation_welcome_1.jpg', 23, 0),
(84, 'Photo de la création ShiNMu', 'creation_shinmu_1.jpg', 1, 0),
(152, 'Photo de l''action culturelle transforme', 'action_transforme_152.jpg', 0, 4),
(151, 'Photo de l''action culturelle transforme', 'action_transforme_151.jpg', 0, 4),
(177, 'Photo de la création ShiNMu', 'creation_shinmu_130.jpg', 1, 0),
(178, 'Photo de la création Mille Oasis', 'creation_mille-oasis_1.jpg', 30, 0),
(149, 'Photo de l''action culturelle transforme', 'action_transforme_149.jpg', 0, 4),
(147, 'Photo de l''action culturelle AToU Tohoku Project', 'action_atou-tohoku-project_1.jpg', 0, 7),
(146, 'Photo de l''action culturelle ICHIGO ICHIE', 'action_ichigo-ichie_146.jpg', 0, 5),
(129, 'Photo de la création ShiNMu', 'creation_shinmu_85.jpg', 1, 0),
(179, 'Photo de la création Avant qu''elle ne se fâne', 'creation_avant-qu-elle-ne-se-fane_133.jpg', 2, 0),
(132, 'Photo de la création Avant qu''elle ne se fâne', 'creation_avant-qu-elle-ne-se-fane_132.jpg', 2, 0),
(134, 'Photo de la création WelCOME', 'creation_welcome_134.jpg', 23, 0),
(135, 'Photo de la création WelCOME', 'creation_welcome_135.jpg', 23, 0),
(136, 'Photo de la création WelCOME', 'creation_welcome_136.jpg', 23, 0),
(137, 'Photo de la création Ichigo-Ichié', 'creation_ichigo-ichie_1.jpg', 28, 0),
(138, 'Photo de la création Black Rain', 'creation_black-rain_1.jpg', 29, 0),
(139, 'Photo de la création Black Rain', 'creation_black-rain_139.jpg', 29, 0),
(140, 'Photo de la création Daichi', 'creation_daichi_1.jpg', 26, 0),
(141, 'Photo de la création Daichi', 'creation_daichi_141.jpg', 26, 0),
(142, 'Photo de la création madness, love & mysticism', 'creation_madness-love-mysticism_1.jpg', 27, 0),
(143, 'Photo de la création madness, love & mysticism', 'creation_madness-love-mysticism_143.jpg', 27, 0),
(145, 'Photo de l''action culturelle ICHIGO ICHIE', 'action_ichigo-ichie_126.jpg', 0, 5),
(154, 'Photo de l''action culturelle transforme', 'action_transforme_154.jpg', 0, 4),
(155, 'Photo de l''action culturelle transforme', 'action_transforme_155.jpg', 0, 4),
(156, 'Photo de l''action culturelle transforme', 'action_transforme_156.jpg', 0, 4),
(157, 'Photo de l''action culturelle transforme', 'action_transforme_157.jpg', 0, 4),
(158, 'Photo de l''action culturelle transforme', 'action_transforme_158.jpg', 0, 4),
(159, 'Photo de l''action culturelle transforme', 'action_transforme_159.jpg', 0, 4),
(160, 'Photo de l''action culturelle transforme', 'action_transforme_160.jpg', 0, 4),
(161, 'Photo de l''action culturelle transforme', 'action_transforme_161.jpg', 0, 4),
(162, 'Photo de l''action culturelle transforme', 'action_transforme_162.jpg', 0, 4),
(163, 'Photo de l''action culturelle transforme', 'action_transforme_163.jpg', 0, 4),
(164, 'Photo de l''action culturelle transforme', 'action_transforme_164.jpg', 0, 4),
(165, 'Photo de l''action culturelle transforme', 'action_transforme_165.jpg', 0, 4),
(166, 'Photo de l''action culturelle transforme', 'action_transforme_166.jpg', 0, 4),
(167, 'Photo de l''action culturelle transforme', 'action_transforme_167.jpg', 0, 4),
(168, 'Photo de l''action culturelle transforme', 'action_transforme_168.jpg', 0, 4),
(169, 'Photo de l''action culturelle transforme', 'action_transforme_169.jpg', 0, 4),
(170, 'Photo de l''action culturelle transforme', 'action_transforme_170.jpg', 0, 4),
(171, 'Photo de l''action culturelle transforme', 'action_transforme_171.jpg', 0, 4),
(172, 'Photo de l''action culturelle transforme', 'action_transforme_172.jpg', 0, 4),
(173, 'Photo de l''action culturelle transforme', 'action_transforme_173.jpg', 0, 4),
(174, 'Photo de l''action culturelle transforme', 'action_transforme_174.jpg', 0, 4),
(175, 'Photo de l''action culturelle transforme', 'action_transforme_175.jpg', 0, 4),
(180, 'Photo de la création Avant qu''elle ne se fâne', 'creation_avant-qu-elle-ne-se-fane_180.jpg', 2, 0),
(181, 'Photo de la création Avant qu''elle ne se fâne', 'creation_avant-qu-elle-ne-se-fane_181.jpg', 2, 0),
(182, 'Photo de la création Avant qu''elle ne se fâne', 'creation_avant-qu-elle-ne-se-fane_182.jpg', 2, 0),
(183, 'Photo de la création Avant qu''elle ne se fâne', 'creation_avant-qu-elle-ne-se-fane_183.jpg', 2, 0),
(184, 'Photo de la création Avant qu''elle ne se fâne', 'creation_avant-qu-elle-ne-se-fane_184.jpg', 2, 0),
(185, 'Photo de la création Avant qu''elle ne se fâne', 'creation_avant-qu-elle-ne-se-fane_185.jpg', 2, 0),
(186, 'Photo de la création Avant qu''elle ne se fâne', 'creation_avant-qu-elle-ne-se-fane_186.jpg', 2, 0),
(187, 'Photo de la création WelCOME', 'creation_welcome_137.jpg', 23, 0),
(188, 'Photo de la création WelCOME', 'creation_welcome_188.jpg', 23, 0),
(189, 'Photo de la création WelCOME', 'creation_welcome_189.jpg', 23, 0),
(190, 'Photo de la création WelCOME', 'creation_welcome_190.jpg', 23, 0),
(191, 'Photo de la création WelCOME', 'creation_welcome_191.jpg', 23, 0),
(192, 'Photo de la création WelCOME', 'creation_welcome_192.jpg', 23, 0),
(193, 'Photo de la création WelCOME', 'creation_welcome_193.jpg', 23, 0),
(194, 'Photo de la création WelCOME', 'creation_welcome_194.jpg', 23, 0),
(195, 'Photo de la création WelCOME', 'creation_welcome_195.jpg', 23, 0),
(196, 'Photo de la création WelCOME', 'creation_welcome_196.jpg', 23, 0);

-- --------------------------------------------------------

--
-- Structure de la table `prospects`
--

CREATE TABLE IF NOT EXISTS `prospects` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `representations`
--

CREATE TABLE IF NOT EXISTS `representations` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `salle` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `dates` date NOT NULL,
  `heureDebut` time NOT NULL,
  `infos` varchar(100) NOT NULL,
  `adresseGpsDuLieu` varchar(100) NOT NULL,
  `infosMetro` text NOT NULL,
  `infosBus` text NOT NULL,
  `infosVoiture` text NOT NULL,
  `creationsID` smallint(6) NOT NULL,
  `actions_culturellesID` smallint(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Contenu de la table `representations`
--

INSERT INTO `representations` (`ID`, `salle`, `ville`, `pays`, `dates`, `heureDebut`, `infos`, `adresseGpsDuLieu`, `infosMetro`, `infosBus`, `infosVoiture`, `creationsID`, `actions_culturellesID`) VALUES
(29, 'Salut', 'Tours', 'France', '0000-00-00', '00:00:00', '', '', '', '', '', 10, 0),
(23, 'reggrth', 'rheerh', 'hrethre', '0000-00-00', '00:00:00', '', '', '', '', '', 9, 0),
(22, 'rzebrn', 'enrenrten', 'neryn', '0000-00-00', '00:00:00', '', '', '', '', '', 9, 0),
(30, 'Tintin', 'Tobet', 'Tibet', '0000-00-00', '00:00:00', '', '', '', '', '', 14, 0),
(28, 'Testo', 'Amiens', 'France', '2014-12-15', '00:00:00', '', '', '', '', '', 10, 0),
(27, 'ergrg', 'greegr', 'egeg', '0000-00-00', '00:00:00', '', '', '', '', '', 21, 0),
(25, 'bbgfgb', 'bffgfgb', 'fbgfb', '0000-00-00', '00:00:00', '', '', '', '', '', 9, 0),
(24, '''(gt''g', 'g''g''', 'gt''tg', '0000-00-00', '00:00:00', '', '', '', '', '', 9, 0),
(48, 'Le Théâtre – Scène conventionnée', 'Auxerre', 'France', '2015-02-03', '20:30:00', 'Réservation sur le site www.auxerreletheatre.com  54 rue Joubert 89000 Auxerre', '47.795038,3.57345', '', '', '', 1, 0),
(49, 'Théâtre Louis Jouvet', 'Rethel', 'France', '2015-02-06', '20:30:00', 'Réservation sur le site : www.theatrelouisjouvet.fr 16 place de Caen 08300 Rethel', 'zsfdv', '', '', '', 1, 0),
(50, 'le Zénith ', 'Paris', 'France', '2014-04-23', '00:00:00', 'BOU', 'zszsz', '', '', '', 0, 4),
(51, 'le Zénith ', 'Paris', 'France', '2014-04-23', '00:00:00', '', 'GPS', '', '', '', 0, 4),
(52, 'Cinéma Les Amphis', 'Vaulx-en-Velin', 'France', '2014-06-28', '19:30:00', 'Spectacle gratuit sans réservation Festival Festiv’Amphis  Cinema les Amphis Rue Pierre Cot – 69120 ', '45.788445, 4.918138', '', '', '', 28, 0),
(53, 'Bientôt dans vos salles', '', '', '2014-04-30', '19:00:00', '', 'gps', '', '', '', 24, 0),
(54, 'Centre culturel Charlie Chaplin', 'Vaulx-en-Velin', 'France', '2014-11-05', '00:00:00', 'Place de la Nation - 69120 Vaulx-en-Velin Réservation: Tél. : 04 72 04 81 18 ou 04 72 04 81 19 ou en', ' ', '', '', '', 30, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
