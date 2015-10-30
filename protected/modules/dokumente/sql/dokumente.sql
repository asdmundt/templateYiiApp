-- phpMyAdmin SQL Dump
-- version 2.11.3deb1ubuntu1.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 25. August 2011 um 21:52
-- Server Version: 5.0.51
-- PHP-Version: 5.2.4-2ubuntu5.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `asd`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dokumente`
--

CREATE TABLE IF NOT EXISTS `dokumente` (
  `id` bigint(20) NOT NULL auto_increment,
  `ref_id` bigint(20) NOT NULL default '0',
  `pfad` text,
  `name` varchar(40) NOT NULL,
  `endung` varchar(5) default ' ',
  `groesse` int(11) NOT NULL,
  `erfassdatum` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `erfassid` bigint(20) NOT NULL default '0',
  `status` int(1) NOT NULL default '0' COMMENT 'Sichtbarkeit',
  `status_id` bigint(20) default '0' COMMENT 'id z.b. usergroup',
  `ref_table` varchar(30) NOT NULL,
  `beschr` text,
  `tree_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

-

CREATE TABLE IF NOT EXISTS `dokumente_has_usergroup` (
  `dokumente_id` bigint(20) NOT NULL,
  `usergroup_id` bigint(20) NOT NULL,
  `jointime` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`dokumente_id`,`usergroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `dokumente_has_usergroup`
--

INSERT INTO `dokumente_has_usergroup` VALUES(2, 1, '2011-08-03 01:46:26');
INSERT INTO `dokumente_has_usergroup` VALUES(3, 2, '2011-08-03 01:48:34');
INSERT INTO `dokumente_has_usergroup` VALUES(2, 2, '2011-08-03 01:49:03');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tree`
--

CREATE TABLE IF NOT EXISTS `tree` (
  `id` int(11) NOT NULL auto_increment,
  `id_parent` int(11) default NULL,
  `title` varchar(25) character set utf8 collate utf8_unicode_ci NOT NULL,
  `position` int(2) NOT NULL,
  `url` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `icon` varchar(50) character set utf8 collate utf8_unicode_ci default NULL,
  `model` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_parent` (`id_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `tree`
--

INSERT INTO `tree` VALUES(1, NULL, 'root', 0, '', NULL, '');
INSERT INTO `tree` VALUES(2, 1, 'kontakte', 2, '/kontacts/kontakt/index', 'Dokumente24', 'kontakte');
INSERT INTO `tree` VALUES(3, 1, 'Dokumente', 3, '/dokumente/dokumente/index', 'Dokumente24', 'dokumente');
INSERT INTO `tree` VALUES(4, 2, 'Eingang', 1, '/kontacts/kontakt/index', NULL, 'kontakte');
INSERT INTO `tree` VALUES(5, 2, 'Postausgang', 2, '/kontacts/kontakt/index', NULL, 'kontakte');
INSERT INTO `tree` VALUES(6, 3, 'mp3', 1, '/dokumente/dokumente/index', NULL, 'dokumente');
INSERT INTO `tree` VALUES(7, 3, 'avi', 2, '/dokumente/dokumente/index', NULL, 'dokumente');
