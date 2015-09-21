-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 09. Juli 2013 um 00:45
-- Server Version: 5.1.66
-- PHP-Version: 5.3.2-1ubuntu4.19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `yiistudio`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `comment` text,
  `subject` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `action`
--

INSERT INTO `action` (`id`, `title`, `comment`, `subject`) VALUES
(1, 'message_write', NULL, NULL),
(2, 'message_receive', NULL, NULL),
(3, 'user_create', NULL, NULL),
(4, 'user_update', NULL, NULL),
(5, 'user_remove', NULL, NULL),
(6, 'user_admin', NULL, NULL),
(7, 'file_filebrowser', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `attachment`
--

CREATE TABLE IF NOT EXISTS `attachment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email_id` bigint(20) NOT NULL,
  `content` longblob NOT NULL,
  `filename` varchar(30) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `filesize` decimal(10,0) NOT NULL,
  `filetype` varchar(10) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `attachment`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `root` (`root`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id`, `root`, `lft`, `rgt`, `level`) VALUES
(1, NULL, 0, 0, 0);

-- --------------------------------------------------------


--
-- Tabellenstruktur für Tabelle `dokumente`
--

CREATE TABLE IF NOT EXISTS `dokumente` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` bigint(20) NOT NULL DEFAULT '0',
  `pfad` text,
  `name` varchar(40) NOT NULL,
  `endung` varchar(5) DEFAULT ' ',
  `groesse` int(11) NOT NULL,
  `erfassdatum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `erfassid` bigint(20) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT 'Sichtbarkeit',
  `status_id` bigint(20) DEFAULT '0' COMMENT 'id z.b. usergroup',
  `ref_table` varchar(30) NOT NULL,
  `beschr` text,
  `tree_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_id` (`ref_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

--
-- Daten für Tabelle `dokumente`
--

INSERT INTO `dokumente` (`id`, `ref_id`, `pfad`, `name`, `endung`, `groesse`, `erfassdatum`, `erfassid`, `status`, `status_id`, `ref_table`, `beschr`, `tree_id`) VALUES
(3, 129, '', 'daten.txt', ' ', 0, '2011-08-16 00:00:00', 1, 0, 0, 'kontakte', NULL, 4),
(73, 132, '/var/www/upload/mandant10/kontakte/132/73/', 'daten.txt', ' ', 0, '2011-08-16 00:00:00', 2, 0, 0, 'kontakte', NULL, 5),
(74, 129, '', 'Desert.jpg', ' ', 0, '2011-08-16 00:00:00', 2, 0, 0, 'kontakte', NULL, 4),
(93, 1, NULL, 'versInfo.txt', ' ', 0, '2012-02-08 00:00:00', 0, 0, 0, 'kontakte', NULL, 5),
(94, 3, '', 'Lighthouse.jpg', ' ', 0, '2005-01-20 00:00:00', 1, 0, 0, '', NULL, NULL),
(95, 0, NULL, 'ghg', ' ', 0, '0000-00-00 00:00:00', 1, 0, 0, '', NULL, NULL),
(96, 0, NULL, 'ghg', ' ', 0, '0000-00-00 00:00:00', 1, 0, 0, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dokumente_has_usergroup`
--

CREATE TABLE IF NOT EXISTS `dokumente_has_usergroup` (
  `dokumente_id` bigint(20) NOT NULL,
  `usergroup_id` bigint(20) NOT NULL,
  `jointime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`dokumente_id`,`usergroup_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `dokumente_has_usergroup`
--

INSERT INTO `dokumente_has_usergroup` (`dokumente_id`, `usergroup_id`, `jointime`) VALUES
(2, 1, '2011-08-03 01:46:26'),
(3, 2, '2011-08-03 01:48:34'),
(2, 2, '2011-08-03 01:49:03');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dokumente_template`
--

CREATE TABLE IF NOT EXISTS `dokumente_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pfad` text,
  `name` varchar(40) NOT NULL,
  `erfassdatum` datetime NOT NULL,
  `erfassid` int(10) unsigned NOT NULL DEFAULT '0',
  `ref_table` varchar(30) NOT NULL,
  `beschr` text,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `dokumente_template`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `friendship`
--

CREATE TABLE IF NOT EXISTS `friendship` (
  `inviter_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `acknowledgetime` int(11) DEFAULT NULL,
  `requesttime` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`inviter_id`,`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `friendship`
--


-- --------------------------------------------------------


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `listestatus`
--

CREATE TABLE IF NOT EXISTS `listestatus` (
  `id` bigint(20) NOT NULL,
  `txt` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `listestatus`
--

INSERT INTO `listestatus` (`id`, `txt`) VALUES
(1, 'offen'),
(2, 'in Bearbeitung'),
(3, 'in weiter Bearbeitung'),
(4, 'in Problem Bearbeitung'),
(5, 'Problem geschlossen'),
(6, 'abgeschlossen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mailbox_conversation`
--

CREATE TABLE IF NOT EXISTS `mailbox_conversation` (
  `conversation_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `initiator_id` int(10) NOT NULL,
  `interlocutor_id` int(10) NOT NULL,
  `subject` varchar(100) NOT NULL DEFAULT '',
  `bm_read` tinyint(3) NOT NULL DEFAULT '0',
  `bm_deleted` tinyint(3) NOT NULL DEFAULT '0',
  `modified` int(10) unsigned NOT NULL,
  `is_system` enum('yes','no') NOT NULL DEFAULT 'no',
  `initiator_del` tinyint(1) unsigned DEFAULT '0',
  `interlocutor_del` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`conversation_id`),
  KEY `initiator_id` (`initiator_id`),
  KEY `interlocutor_id` (`interlocutor_id`),
  KEY `conversation_ts` (`modified`),
  KEY `subject` (`subject`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `mailbox_conversation`
--

INSERT INTO `mailbox_conversation` (`conversation_id`, `initiator_id`, `interlocutor_id`, `subject`, `bm_read`, `bm_deleted`, `modified`, `is_system`, `initiator_del`, `interlocutor_del`) VALUES
(1, 1, 3, 'test', 1, 0, 1370352896, 'no', 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mailbox_message`
--

CREATE TABLE IF NOT EXISTS `mailbox_message` (
  `message_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `conversation_id` int(10) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL DEFAULT '0',
  `sender_id` int(10) unsigned NOT NULL DEFAULT '0',
  `recipient_id` int(10) unsigned NOT NULL DEFAULT '0',
  `text` mediumtext NOT NULL,
  `crc64` bigint(20) NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `sender_profile_id` (`sender_id`),
  KEY `recipient_profile_id` (`recipient_id`),
  KEY `conversation_id` (`conversation_id`),
  KEY `timestamp` (`created`),
  KEY `crc64` (`crc64`),
  FULLTEXT KEY `text` (`text`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `mailbox_message`
--

INSERT INTO `mailbox_message` (`message_id`, `conversation_id`, `created`, `sender_id`, `recipient_id`, `text`, `crc64`) VALUES
(1, 1, 1370352896, 1, 3, 'jkhkhjkhjhjkh', 144);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `membership_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `order_date` int(11) NOT NULL,
  `end_date` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `payment_date` int(11) DEFAULT NULL,
  `subscribed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `membership`
--

INSERT INTO `membership` (`id`, `membership_id`, `user_id`, `payment_id`, `order_date`, `end_date`, `name`, `street`, `zipcode`, `city`, `payment_date`, `subscribed`) VALUES
(1, 3, 3, 1, 1370036136, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` int(10) unsigned NOT NULL,
  `from_user_id` int(10) unsigned NOT NULL,
  `to_user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `message_read` tinyint(1) NOT NULL,
  `answered` tinyint(1) DEFAULT NULL,
  `draft` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `message`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `payment`
--

INSERT INTO `payment` (`id`, `title`, `text`) VALUES
(1, 'Prepayment', NULL),
(2, 'Paypal', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `principal_id` int(11) NOT NULL,
  `subordinate_id` int(11) NOT NULL DEFAULT '0',
  `type` enum('user','role') NOT NULL,
  `action` int(11) NOT NULL,
  `template` tinyint(1) NOT NULL,
  `comment` text,
  PRIMARY KEY (`principal_id`,`subordinate_id`,`type`,`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `permission`
--

INSERT INTO `permission` (`principal_id`, `subordinate_id`, `type`, `action`, `template`, `comment`) VALUES
(1, 0, 'user', 7, 0, ''),
(1, 0, 'role', 4, 0, ''),
(1, 0, 'role', 5, 0, ''),
(1, 0, 'role', 6, 0, ''),
(1, 0, 'role', 7, 0, ''),
(2, 0, 'role', 1, 0, 'Users can write messages'),
(2, 0, 'role', 2, 0, 'Users can receive messages'),
(2, 0, 'role', 3, 0, 'Users are able to view visits of his profile'),
(6, 5, 'role', 1, 0, ''),
(6, 5, 'role', 3, 0, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `privacysetting`
--

CREATE TABLE IF NOT EXISTS `privacysetting` (
  `user_id` int(10) unsigned NOT NULL,
  `message_new_friendship` tinyint(1) NOT NULL DEFAULT '1',
  `message_new_message` tinyint(1) NOT NULL DEFAULT '1',
  `message_new_profilecomment` tinyint(1) NOT NULL DEFAULT '1',
  `appear_in_search` tinyint(1) NOT NULL DEFAULT '1',
  `show_online_status` tinyint(1) NOT NULL DEFAULT '1',
  `log_profile_visits` tinyint(1) NOT NULL DEFAULT '1',
  `ignore_users` varchar(255) DEFAULT NULL,
  `public_profile_fields` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `privacysetting`
--

INSERT INTO `privacysetting` (`user_id`, `message_new_friendship`, `message_new_message`, `message_new_profilecomment`, `appear_in_search`, `show_online_status`, `log_profile_visits`, `ignore_users`, `public_profile_fields`) VALUES
(1, 1, 1, 1, 1, 1, 1, '', NULL),
(2, 1, 1, 1, 1, 1, 1, NULL, NULL),
(3, 1, 1, 1, 1, 1, 1, '', NULL),
(4, 1, 1, 1, 1, 1, 1, '', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `problem`
--

CREATE TABLE IF NOT EXISTS `problem` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `beschr` text,
  `art` varchar(30) DEFAULT NULL,
  `art_id` varchar(30) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `problem`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `privacy` enum('protected','private','public') NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `show_friends` tinyint(1) DEFAULT '1',
  `allow_comments` tinyint(1) DEFAULT '1',
  `email` varchar(255) NOT NULL DEFAULT '',
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `about` text,
  `mandant` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (id),
  INDEX (user_id),
  FOREIGN KEY (user_id) 
        REFERENCES user(id)
        ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `timestamp`, `privacy`, `lastname`, `firstname`, `show_friends`, `allow_comments`, `email`, `street`, `city`, `about`, `mandant`) VALUES
(1, 1, '2013-05-18 20:29:28', 'protected', 'admin', 'admin', 1, 1, 'webmaster@example.com', '', '', '', ''),
(2, 2, '2013-05-18 20:29:28', 'protected', 'demo', 'demo', 1, 1, 'demo@example.com', NULL, NULL, NULL, ''),
(3, 3, '0000-00-00 00:00:00', 'protected', 'mundt', 'asd', 1, 1, 'asdmundt@gmail.com', '', '', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `profile_comment`
--

CREATE TABLE IF NOT EXISTS `profile_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `profile_comment`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `profile_field`
--

CREATE TABLE IF NOT EXISTS `profile_field` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `hint` text NOT NULL,
  `field_type` varchar(50) NOT NULL DEFAULT '',
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(255) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  `related_field_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `profile_field`
--

INSERT INTO `profile_field` (`id`, `varname`, `title`, `hint`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `position`, `visible`, `related_field_name`) VALUES
(1, 'email', 'E-Mail', '', 'VARCHAR', 255, 0, 1, '', '', '', 'CEmailValidator', '', 0, 3, ''),
(2, 'firstname', 'First name', '', 'VARCHAR', 255, 0, 1, '', '', '', '', '', 0, 3, ''),
(3, 'lastname', 'Last name', '', 'VARCHAR', 255, 0, 1, '', '', '', '', '', 0, 3, ''),
(4, 'street', 'Street', '', 'VARCHAR', 255, 0, 0, '', '', '', '', '', 0, 3, ''),
(5, 'city', 'City', '', 'VARCHAR', 255, 0, 0, '', '', '', '', '', 0, 3, ''),
(6, 'about', 'About', '', 'TEXT', 255, 0, 0, '', '', '', '', '', 0, 3, ''),
(7, 'mandant', 'Mandant', '', 'VARCHAR', 30, 0, 0, '', '', '', '', '', 0, 2, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `profile_visit`
--

CREATE TABLE IF NOT EXISTS `profile_visit` (
  `visitor_id` int(11) NOT NULL,
  `visited_id` int(11) NOT NULL,
  `timestamp_first_visit` int(11) NOT NULL,
  `timestamp_last_visit` int(11) NOT NULL,
  `num_of_visits` int(11) NOT NULL,
  PRIMARY KEY (`visitor_id`,`visited_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `profile_visit`
--

INSERT INTO `profile_visit` (`visitor_id`, `visited_id`, `timestamp_first_visit`, `timestamp_last_visit`, `num_of_visits`) VALUES
(1, 4, 1369349822, 1369349822, 1),
(3, 1, 1370553012, 1370553012, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_project_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `desc` text,
  `startDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `endDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `art` enum('main','template','sub') NOT NULL DEFAULT 'main',
  `projectmanager_id` int(10) NOT NULL,
  `liveurl` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci DEFAULT NULL,
  `livepath` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci DEFAULT NULL,
  `stgurl` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci DEFAULT NULL,
  `stgpath` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci DEFAULT NULL,
  `testurl` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci DEFAULT NULL,
  `testpath` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci DEFAULT NULL,
  `devurl` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci DEFAULT NULL,
  `devpath` varchar(50) CHARACTER SET latin1 COLLATE latin1_german1_ci DEFAULT NULL,
  `projectstatus` enum('development','support') NOT NULL DEFAULT 'development',
  `envstatus` enum('dev','test','stge','live') NOT NULL DEFAULT 'dev',
  `version` varchar(30) DEFAULT ' ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `project`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `membership_priority` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL COMMENT 'Price (when using membership module)',
  `duration` int(11) DEFAULT NULL COMMENT 'How long a membership is valid',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `role`
--

INSERT INTO `role` (`id`, `title`, `description`, `membership_priority`, `price`, `duration`) VALUES
(1, 'UserManager', 'These users can manage Users', 0, 0, 0),
(2, 'Demo', 'Users having the demo role', 0, 0, 0),
(3, 'Business', 'Example Business account', 1, 9.99, 7),
(4, 'Premium', 'Example Premium account', 2, 19.99, 28),
(5, 'Developer', 'Darf Workingcopy editieren', NULL, NULL, NULL),
(6, 'Projectleader', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Daten für Tabelle `state`
--

INSERT INTO `state` (`id`, `name`) VALUES
(1, 'Bayern'),
(2, 'Baden-Württemberg'),
(3, 'Rheinland-Pfalz'),
(4, 'Mecklenburg-Vorpommern'),
(5, 'Sachsen-Anhalt'),
(6, 'Brandenburg'),
(7, 'Niedersachsen'),
(8, 'Schleswig-Holstein'),
(9, 'Nordrhein-Westfalen'),
(10, 'Thüringen'),
(11, 'Hessen'),
(12, 'Sachsen'),
(13, 'Berlin'),
(14, 'Saarland'),
(15, 'Bremen'),
(16, 'Hamburg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `termin`
--

CREATE TABLE IF NOT EXISTS `termin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `vorgangsid` int(10) NOT NULL DEFAULT '0',
  `kundennr` int(10) NOT NULL DEFAULT '0',
  `viewtext` text CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `desctext` text CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `terminartid` int(11) NOT NULL DEFAULT '0',
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alarmid` int(10) DEFAULT NULL,
  `erfassdatum` timestamp NULL DEFAULT NULL,
  `erfassid` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `termin`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `terminart`
--

CREATE TABLE IF NOT EXISTS `terminart` (
  `id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `terminart`
--

INSERT INTO `terminart` (`id`, `title`, `user_id`) VALUES
(1, 'Treffen', 0),
(2, 'Verkaufsgespräch', 0),
(3, 'Telefonat', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `todouser`
--

CREATE TABLE IF NOT EXISTS `todouser` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `title` text CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `desc` text CHARACTER SET latin1 COLLATE latin1_german1_ci,
  `startdatum` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_id` int(11) NOT NULL DEFAULT '0',
  `erfass_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `todouser`
--

INSERT INTO `todouser` (`id`, `user_id`, `title`, `desc`, `startdatum`, `status_id`, `erfass_id`) VALUES
(1, 1233, 'Mit IHK Telefonieren ', 'ffwefeffsdfsdf\r\nsdfsdfsdfsdf\r\nsdfsdfsdfsdfsdfsdf\r\nsdfsdf', '2006-10-10 00:00:00', 1, 1233),
(2, 1233, 'Kunden anrufen', 'adsfefwefef\r\nwfwefewfwefew\r\nfwefwefwefewf', '2006-10-10 00:00:00', 1, 1233),
(3, 1233, 'Kontakte sort.', 'grsgrwgwrfge\r\nwefwefwewefrwe\r\nwefwefwef\r\nwefwefwefwefwef', '2006-10-10 00:00:00', 1, 1233);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `translation`
--

CREATE TABLE IF NOT EXISTS `translation` (
  `message` varbinary(255) NOT NULL,
  `translation` varchar(255) NOT NULL,
  `language` varchar(5) NOT NULL,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`message`,`language`,`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `translation`
--

INSERT INTO `translation` (`message`, `translation`, `language`, `category`) VALUES
('About', 'Über', 'de', 'yum'),
('About', 'Acerca', 'es', 'yum'),
('About', 'me concernant ??', 'fr', 'yum'),
('About', 'Info', 'it', 'yum'),
('About', 'Info', 'pl', 'yum'),
('Access control', 'Zugangskontrolle', 'de', 'yum'),
('Access control', 'Control de acceso', 'es', 'yum'),
('Access control', 'Controle d acces', 'fr', 'yum'),
('Access control', 'Controllo accesso', 'it', 'yum'),
('Action', 'Aktion', 'de', 'yum'),
('Action', 'Acción', 'es', 'yum'),
('Action', 'Action', 'fr', 'yum'),
('Action', 'Azione', 'it', 'yum'),
('Actions', 'Aktionen', 'de', 'yum'),
('Actions', 'Acciones', 'es', 'yum'),
('Actions', 'Actions', 'fr', 'yum'),
('Actions', 'Azioni', 'it', 'yum'),
('Activated', 'erstmalig Aktiviert', 'de', 'yum'),
('Activated', 'Activado', 'es', 'yum'),
('Activated', 'Premiere activation de votre compte', 'fr', 'yum'),
('Activated', 'Attivato', 'it', 'yum'),
('Active', 'Aktiv', 'de', 'yum'),
('Active', 'Activo', 'es', 'yum'),
('Active', 'Actif', 'fr', 'yum'),
('Active', 'Attiv', 'it', 'yum'),
('Active', 'Aktiv', 'pl', 'yum'),
('Active', 'Активирован', 'ru', 'yum'),
('Active - First visit', 'Aktiv - erster Besuch', 'de', 'yum'),
('Active - First visit', 'Activo - Primera visita', 'es', 'yum'),
('Active - First visit', 'Actif - premiere visite', 'fr', 'yum'),
('Active - First visit', 'Attivo - Priva visita', 'it', 'yum'),
('Active users', 'Aktive Benutzer', 'de', 'yum'),
('Active users', 'Usuarios activos', 'es', 'yum'),
('Active users', 'Utiliateurs actifs', 'fr', 'yum'),
('Active users', 'Utenti attivi', 'it', 'yum'),
('Active users', 'Aktywni uzytkownicy', 'pl', 'yum'),
('Activities', 'Aktivitäten', 'de', 'yum'),
('Activities', 'Actividades', 'es', 'yum'),
('Activities', 'Activites', 'fr', 'yum'),
('Activities', 'Attivita', 'it', 'yum'),
('Add as a friend', 'Zur Kontaktliste hinzufügen', 'de', 'yum'),
('Add as a friend', 'Agregar como amigo', 'es', 'yum'),
('Add as a friend', 'Ajouter a ma liste de contact', 'fr', 'yum'),
('Add as a friend', 'Aggiungi un contatto', 'it', 'yum'),
('Admin inbox', 'Administratorposteingang', 'de', 'yum'),
('Admin inbox', 'Bandeja de entrada de Admin', 'es', 'yum'),
('Admin inbox', 'Boite e-mail de l administrateur', 'fr', 'yum'),
('Admin inbox', 'Admin - Posta in arrivo', 'it', 'yum'),
('Admin inbox', 'Zarzadzaj skrzynka odbiorcza', 'pl', 'yum'),
('Admin sent messages', 'Gesendete Nachrichten des Administrators', 'de', 'yum'),
('Admin sent messages', 'Mensajes enviados de Admin', 'es', 'yum'),
('Admin sent messages', 'E-mail envoye par l administrateur', 'fr', 'yum'),
('Admin sent messages', 'Admin - Messaggi inviati', 'it', 'yum'),
('Admin sent messages', 'Wiadomosci wyslane przez administratora', 'pl', 'yum'),
('Admin users', 'Administratoren', 'de', 'yum'),
('Admin users', 'Usuarios administradores', 'es', 'yum'),
('Admin users', 'Administrateur', 'fr', 'yum'),
('Admin users', 'Utenti admin', 'it', 'yum'),
('Admin users', 'Administratorzy', 'pl', 'yum'),
('Admin users can not be deleted!', 'Administratoren können nicht gelöscht werden', 'de', 'yum'),
('Admin users can not be deleted!', '¡No se pueden eliminar los usuarios Administradores!', 'es', 'yum'),
('Admin users can not be deleted!', 'UN compte administrateur ne peut pas etre supprime', 'fr', 'yum'),
('Admin users can not be deleted!', 'Utente admin non cancellabile!', 'it', 'yum'),
('Admin users can not be deleted!', 'Nie mozna usunac konta administratora', 'pl', 'yum'),
('All', 'Alle', 'de', 'yum'),
('All', 'Todos', 'es', 'yum'),
('All', 'Ade tous', 'fr', 'yum'),
('All', 'Tutto', 'it', 'yum'),
('Allow profile comments', 'Profilkommentare erlauben', 'de', 'yum'),
('Allow profile comments', 'Permitir comentarios en perfiles', 'es', 'yum'),
('Allow profile comments', 'Autoriser les commentaires de profil', 'fr', 'yum'),
('Allow profile comments', 'Consenti commenti profili', 'it', 'yum'),
('Allowed are lowercase letters and digits.', 'Erlaubt sind Kleinbuchstaben und Ziffern.', 'de', 'yum'),
('Allowed are lowercase letters and digits.', 'Se permiten letras minúsculas y dígitos', 'es', 'yum'),
('Allowed are lowercase letters and digits.', 'Seules les minuscule et les chiffres sont autorises.', 'fr', 'yum'),
('Allowed are lowercase letters and digits.', 'Sono consentiti lettere minuscole e numeri.', 'it', 'yum'),
('Allowed are lowercase letters and digits.', 'Erlaubt sind Kleinbuchstaben und Ziffern.', 'pl', 'yum'),
('Allowed lowercase letters and digits.', 'Consenti lettere minuscole e numeri.', 'it', 'yum'),
('Allowed lowercase letters and digits.', 'Допускаются строчные буквы и цифры.', 'ru', 'yum'),
('Allowed roles', 'Erlaubte Rollen', 'de', 'yum'),
('Allowed roles', 'Roles permitidos', 'es', 'yum'),
('Allowed roles', 'Permission role', 'fr', 'yum'),
('Allowed roles', 'Ruoli autorizzati', 'it', 'yum'),
('Allowed roles', 'Dostepne role', 'pl', 'yum'),
('Allowed users', 'Erlaubte Benutzer', 'de', 'yum'),
('Allowed users', 'Usuarios permitidos', 'es', 'yum'),
('Allowed users', 'Permission utilisateur', 'fr', 'yum'),
('Allowed users', 'Utenti autorizzati', 'it', 'yum'),
('Allowed users', 'Dostepni uzytkownicy', 'pl', 'yum'),
('Already exists.', 'Existiert bereits.', 'de', 'yum'),
('Already exists.', 'Ya existe.', 'es', 'yum'),
('Already exists.', 'Existe deja.', 'fr', 'yum'),
('Already exists.', 'Gia esistente', 'it', 'yum'),
('Already exists.', 'Existiert bereits.', 'pl', 'yum'),
('Already exists.', 'Уже существует.', 'ru', 'yum'),
('An error occured while saving your changes', 'Es ist ein Fehler aufgetreten.', 'de', 'yum'),
('An error occured while saving your changes', 'Ocurrió un error al guardar los cambios', 'es', 'yum'),
('An error occured while saving your changes', 'Une erreur est survenue.', 'fr', 'yum'),
('An error occured while saving your changes', 'Si e verificato un errore durante il salvataggio delle modifiche.', 'it', 'yum'),
('An error occured while saving your changes', 'Wystapil blad podczas zapisywania Twoich zmian.', 'pl', 'yum'),
('An error occured while uploading your avatar image', 'Ein Fehler ist beim hochladen ihres Profilbildes aufgetreten', 'de', 'yum'),
('An error occured while uploading your avatar image', 'Ha ocurrido un error al cargar una imagen de tu avatar', 'es', 'yum'),
('An error occured while uploading your avatar image', 'Une erreur est survenue lors du chargement de votre photo de profil', 'fr', 'yum'),
('An error occured while uploading your avatar image', 'Si e verificato un errore durante il caricamento dell''immagine', 'it', 'yum'),
('Answer', 'Antworten', 'de', 'yum'),
('Answer', 'Respuesta ', 'es', 'yum'),
('Appear in search', 'In der Suche erscheinen', 'de', 'yum'),
('Appear in search', 'Aparecen en la b', 'es', 'yum'),
('Appear in search', 'Je souhaite apparaitre dans les resultats de recherche', 'fr', 'yum'),
('Appear in search', 'Mostra nelle ricerche', 'it', 'yum'),
('Are you really sure you want to delete your Account?', 'Sind Sie Sicher, dass Sie Ihren Zugang löschen wollen?', 'de', 'yum'),
('Are you really sure you want to delete your Account?', '¿Seguro que desea eliminar su cuenta?', 'es', 'yum'),
('Are you really sure you want to delete your Account?', 'Etes vous sur de vouloir supprimer votre compte?', 'fr', 'yum'),
('Are you really sure you want to delete your Account?', 'Sicuro di voler cancellare il tuo account?', 'it', 'yum'),
('Are you really sure you want to delete your Account?', 'Czy jestes pewien, ze chcesz usunac konto?', 'pl', 'yum'),
('Are you sure to delete this item?', 'Sind Sie sicher, dass Sie dieses Element wirklich löschen wollen? ', 'de', 'yum'),
('Are you sure to delete this item?', '¿Seguro desea eliminar este elemento?', 'es', 'yum'),
('Are you sure to delete this item?', 'Etes vous sur de supprime cet element?', 'fr', 'yum'),
('Are you sure to delete this item?', 'Sicuro di cancellare questo elemento?', 'it', 'yum'),
('Are you sure to delete this item?', 'Вы действительно хотите удалить пользователя?', 'ru', 'yum'),
('Are you sure to remove this comment from your profile?', 'Sind Sie sicher, dass sie diesen Kommentar entfernen wollen?', 'de', 'yum'),
('Are you sure to remove this comment from your profile?', '¿Estás seguro que deseas borrar este comentario?', 'es', 'yum'),
('Are you sure to remove this comment from your profile?', 'Etes vous sur de vouloir supprimer ce commentaire?', 'fr', 'yum'),
('Are you sure to remove this comment from your profile?', 'Sicuro di voler eliminare il commento dal tuo profilo?', 'it', 'yum'),
('Are you sure you want to remove this friend?', 'Sind Sie sicher, dass Sie diesen Kontakt aus ihrer Liste entfernen wollen?', 'de', 'yum'),
('Are you sure you want to remove this friend?', '', 'es', 'yum'),
('Are you sure you want to remove this friend?', 'Etes vous sur de vouloir suprimer ce membre de votre liste de contact?', 'fr', 'yum'),
('Are you sure you want to remove this friend?', 'Sicuro di voler rimuovere questo contatto?', 'it', 'yum'),
('Assign this role to new users automatically', 'Rolle automatisch an neue Benutzer zuweisen', 'de', 'yum'),
('Assign this role to new users automatically', 'Asignar esta funci', 'es', 'yum'),
('Assign this role to new users automatically', 'Role automatique pour un nouveau membre', 'fr', 'yum'),
('Assign this role to new users automatically', 'Assegna questo ruolo automaticamente ai nuovi utenti', 'it', 'yum'),
('Automatically extend subscription', 'Mitgliedschaft automatisch verlängern', 'de', 'yum'),
('Avatar image', 'Profilbild', 'de', 'yum'),
('Avatar image', 'Tu Avatar', 'es', 'yum'),
('Avatar image', 'Image de profil', 'fr', 'yum'),
('Avatar image', 'Avatar', 'it', 'yum'),
('Back', 'Zurück', 'de', 'yum'),
('Back', 'Volver', 'es', 'yum'),
('Back', 'Retour', 'fr', 'yum'),
('Back', 'Indietro', 'it', 'yum'),
('Back to inbox', 'Zurück zum Posteingang', 'de', 'yum'),
('Back to inbox', 'Volver a la bandeja de entrada', 'es', 'yum'),
('Back to inbox', 'Retour a la boite mail', 'fr', 'yum'),
('Back to inbox', 'Torna alla posta in arrivo', 'it', 'yum'),
('Back to my Profile', 'Zurück zu meinem Profil', 'de', 'yum'),
('Back to my Profile', 'Volver a mi Perfil', 'es', 'yum'),
('Back to my Profile', 'Retour a mon profil', 'fr', 'yum'),
('Back to my Profile', 'Torna al mio profilo', 'it', 'yum'),
('Back to profile', 'Zurück zum Profil', 'de', 'yum'),
('Back to profile', 'Volver a perfil', 'es', 'yum'),
('Back to profile', 'Retour au profil', 'fr', 'yum'),
('Back to profile', 'Torna al mio profilo', 'it', 'yum'),
('Back to profile', 'Zuruck zum Profil', 'pl', 'yum'),
('Banned', 'Verbannt', 'de', 'yum'),
('Banned', 'Excluido', 'es', 'yum'),
('Banned', 'Membre banni', 'fr', 'yum'),
('Banned', 'Bannato', 'it', 'yum'),
('Banned', 'Verbannt', 'pl', 'yum'),
('Banned', 'Заблокирован', 'ru', 'yum'),
('Banned users', 'Gesperrte Benuter', 'de', 'yum'),
('Banned users', 'Usuarios excluidos', 'es', 'yum'),
('Banned users', 'Utilisateur bloque', 'fr', 'yum'),
('Banned users', 'Utenti bannati', 'it', 'yum'),
('Banned users', 'Zbanowani uzytkownicy', 'pl', 'yum'),
('Browse', 'Durchsuchen', 'de', 'yum'),
('Browse', 'Navegar', 'es', 'yum'),
('Browse groups', 'Buscar grupos', 'es', 'yum'),
('Browse logged user activities', 'Benutzeraktivitäten', 'de', 'yum'),
('Browse logged user activities', 'Consultar bitácora de actividades del usuario', 'es', 'yum'),
('Browse logged user activities', 'Activite des membres', 'fr', 'yum'),
('Browse logged user activities', 'Naviga attivita utenti loggati', 'it', 'yum'),
('Browse memberships', 'Mitgliedschaften kaufen', 'de', 'yum'),
('Browse memberships', 'Ver membres', 'es', 'yum'),
('Browse memberships', 'Mitgliedschaften kaufen ??', 'fr', 'yum'),
('Browse memberships', 'Naviga iscrizioni', 'it', 'yum'),
('Browse user activities', 'Tätigkeitenhistorie', 'de', 'yum'),
('Browse user activities', 'Examinar las actividades del usuario', 'es', 'yum'),
('Browse user activities', 'Activite de mon compte', 'fr', 'yum'),
('Browse user activities', 'Naviga attivita utenti', 'it', 'yum'),
('Browse user groups', 'Benutzergruppen durchsuchen', 'de', 'yum'),
('Browse user groups', 'Buscar grupos de usuarios', 'es', 'yum'),
('Browse user groups', 'Rechercher dans un grouppe d utilisateurs', 'fr', 'yum'),
('Browse user groups', 'Naviga gruppi utenti', 'it', 'yum'),
('Browse usergroups', 'Gruppen durchsuchen', 'de', 'yum'),
('Browse usergroups', 'Ver Grupos de Usuarios', 'es', 'yum'),
('Browse usergroups', 'Rechercher dans les grouppes', 'fr', 'yum'),
('Browse usergroups', 'Naviga gruppi utenti', 'it', 'yum'),
('Browse users', 'Benutzer durchsuchen', 'de', 'yum'),
('Browse users', 'Buscar usuarios', 'es', 'yum'),
('Browse users', 'Rechercher dans la liste des membres', 'fr', 'yum'),
('Browse users', 'Naviga utenti', 'it', 'yum'),
('Cancel', 'Abbrechen', 'de', 'yum'),
('Cancel', 'Cancelar', 'es', 'yum'),
('Cancel', 'Annuler', 'fr', 'yum'),
('Cancel', 'Cancella', 'it', 'yum'),
('Cancel deletion', 'Löschvorgang abbrechen', 'de', 'yum'),
('Cancel deletion', 'Cancelar eliminación', 'es', 'yum'),
('Cancel deletion', 'Stopper la suppression', 'fr', 'yum'),
('Cancel deletion', 'Annulla cancellazione', 'it', 'yum'),
('Cancel deletion', 'Anuluj usuwanie', 'pl', 'yum'),
('Cancel request', 'Anfrage zurückziehen', 'de', 'yum'),
('Cancel request', 'Cancelar pedido', 'es', 'yum'),
('Cancel request', 'Annuler la demande de contact', 'fr', 'yum'),
('Cancel request', 'Cancella richiesta', 'it', 'yum'),
('Cancel subscription', 'Mitgliedschaft beenden', 'de', 'yum'),
('Cannot set password. Try again.', 'No pudimos guardar tu contraseña. Inténtalo otra vez', 'es', 'yum'),
('Category', 'Kategorie', 'de', 'yum'),
('Category', 'Categor', 'es', 'yum'),
('Change Password', 'Изменить пароль', 'ru', 'yum'),
('Change admin Password', 'Administratorpasswort ändern', 'de', 'yum'),
('Change admin Password', 'Cambiar contraseña de Admin', 'es', 'yum'),
('Change admin Password', 'Changer le mot de passe de l administrateur', 'fr', 'yum'),
('Change admin Password', 'Modifica password admin', 'it', 'yum'),
('Change admin Password', 'Zmien haslo administratora', 'pl', 'yum'),
('Change password', 'Passwort ändern', 'de', 'yum'),
('Change password', 'Cambiar contraseña', 'es', 'yum'),
('Change password', 'Modification du mot de', 'fr', 'yum'),
('Change password', 'Cambia password', 'it', 'yum'),
('Change password', 'Passwort andern', 'pl', 'yum'),
('Changes', 'Änderungen', 'de', 'yum'),
('Changes', 'Cambios', 'es', 'yum'),
('Changes', 'Modification', 'fr', 'yum'),
('Changes', 'Modifiche', 'it', 'yum'),
('Changes', 'Zmiany', 'pl', 'yum'),
('Changes are saved', 'Änderungen wurden gespeichert.', 'de', 'yum'),
('Changes are saved', 'Cambios guardados', 'es', 'yum'),
('Changes are saved', 'Les modifications ont bien ete enregistrees.', 'fr', 'yum'),
('Changes are saved', 'Modifiche salvate.', 'it', 'yum'),
('Changes are saved', 'Zmiany zostaly zapisane.', 'pl', 'yum'),
('Changes is saved.', 'Änderungen wurde gespeichert.', 'de', 'yum'),
('Changes is saved.', 'Cambio guardado', 'es', 'yum'),
('Changes is saved.', 'Modifications memorisees.', 'fr', 'yum'),
('Changes is saved.', 'Modifiche salvate', 'it', 'yum'),
('Changes is saved.', 'Изменения сохранены.', 'ru', 'yum'),
('Choose All', 'Alle auswählen', 'de', 'yum'),
('Choose All', 'Seleccionar todos', 'es', 'yum'),
('Choose All', 'Selectioner tout', 'fr', 'yum'),
('Choose All', 'Scegli tutti', 'it', 'yum'),
('Choose All', 'Wybierz wszystkie', 'pl', 'yum'),
('City', 'Stadt', 'de', 'yum'),
('City', 'Ciudad', 'es', 'yum'),
('City', 'Ville', 'fr', 'yum'),
('City', 'Citta', 'it', 'yum'),
('City', 'Miasto', 'pl', 'yum'),
('Click here to respond to {username}', 'Klicke hier, um {username} zu antworten', 'de', 'yum'),
('Column Field type in the database.', 'Spaltentyp in der Datenbank', 'de', 'yum'),
('Column Field type in the database.', 'Columna tipo de Campo en la base de datos', 'es', 'yum'),
('Column Field type in the database.', 'Type de la colone dans la banque de donnee', 'fr', 'yum'),
('Column Field type in the database.', 'Tipo di colonna nel database', 'it', 'yum'),
('Column Field type in the database.', 'Spaltentyp in der Datenbank', 'pl', 'yum'),
('Comment', 'Kommentar', 'de', 'yum'),
('Comment', 'Comentario', 'es', 'yum'),
('Comment', 'Commentaire', 'fr', 'yum'),
('Comment', 'Commento', 'it', 'yum'),
('Compose', 'Nachricht schreiben', 'de', 'yum'),
('Compose', 'Componer', 'es', 'yum'),
('Compose', 'Ecrire un message', 'fr', 'yum'),
('Compose', 'Scrivi', 'it', 'yum'),
('Compose new message', 'Nachricht schreiben', 'de', 'yum'),
('Compose new message', 'Crear mensaje nuevo', 'es', 'yum'),
('Compose new message', 'Ecrire un nouveau message', 'fr', 'yum'),
('Compose new message', 'Scrivi nuovo messaggio', 'it', 'yum'),
('Composing new message', 'Nachricht schreiben', 'de', 'yum'),
('Composing new message', 'Creando mensaje nuevo', 'es', 'yum'),
('Composing new message', 'Ecrire un nouveau message', 'fr', 'yum'),
('Composing new message', 'Scrittura nuovo messaggio', 'it', 'yum'),
('Confirm', 'Bestätigen', 'de', 'yum'),
('Confirm', 'Confirmar', 'es', 'yum'),
('Confirm', 'Confirmer', 'fr', 'yum'),
('Confirm', 'Conferma', 'it', 'yum'),
('Confirm deletion', 'Löschvorgang bestätigen', 'de', 'yum'),
('Confirm deletion', 'Confirmar eliminación', 'es', 'yum'),
('Confirm deletion', 'Confirmation de suppression', 'fr', 'yum'),
('Confirm deletion', 'Conferma cancellazione', 'it', 'yum'),
('Confirm deletion', 'Potwierdz usuwanie', 'pl', 'yum'),
('Confirmation pending', 'Bestätigung ausstehend', 'de', 'yum'),
('Confirmation pending', 'Esperando confirmación', 'es', 'yum'),
('Confirmation pending', 'Confirmation en attente', 'fr', 'yum'),
('Confirmation pending', 'In attesa di conferma', 'it', 'yum'),
('Content', 'Inhalt', 'de', 'yum'),
('Content', 'Contenido', 'es', 'yum'),
('Content', 'Texte du message', 'fr', 'yum'),
('Content', 'Contenuto', 'it', 'yum'),
('Create', 'Anlegen', 'de', 'yum'),
('Create', 'Crear', 'es', 'yum'),
('Create', 'Ceer', 'fr', 'yum'),
('Create', 'Aggiungi', 'it', 'yum'),
('Create', 'Dodaj', 'pl', 'yum'),
('Create', 'Новый', 'ru', 'yum'),
('Create Action', 'Crea azione', 'it', 'yum'),
('Create Profile Field', 'Profilfeld anlegen', 'de', 'yum'),
('Create Profile Field', 'Crear Campo de Perfil', 'es', 'yum'),
('Create Profile Field', 'Nouveau champ de profil', 'fr', 'yum'),
('Create Profile Field', 'Aggiungi campo Profilo', 'it', 'yum'),
('Create Profile Field', 'Dodaj pole profilu', 'pl', 'yum'),
('Create Profile Field', 'Добавить', 'ru', 'yum'),
('Create Role', 'Rolle anlegen', 'de', 'yum'),
('Create Role', 'Crear Rol', 'es', 'yum'),
('Create Role', 'Creer un role', 'fr', 'yum'),
('Create Role', 'Crea ruolo', 'it', 'yum'),
('Create Role', 'Dodaj role', 'pl', 'yum'),
('Create User', 'Benutzer anlegen', 'de', 'yum'),
('Create User', 'Crear Usuario', 'es', 'yum'),
('Create User', 'Creer un nouvel utilisateur', 'fr', 'yum'),
('Create User', 'Nuovo utente', 'it', 'yum'),
('Create User', 'Новый', 'ru', 'yum'),
('Create Usergroup', 'Neue Gruppe erstellen', 'de', 'yum'),
('Create Usergroup', 'Crear un grupo de usuarios', 'es', 'yum'),
('Create Usergroup', 'Crea gruppo utenti', 'it', 'yum'),
('Create my profile', 'Mein Profil anlegen', 'de', 'yum'),
('Create my profile', 'Crear mi perfil', 'es', 'yum'),
('Create my profile', 'Crea profilo', 'it', 'yum'),
('Create new Translation', 'Neue Übersetzung erstellen', 'de', 'yum'),
('Create new Translation', 'Crear nueva traducción', 'es', 'yum'),
('Create new User', 'Neuen Benutzer anlegen', 'de', 'yum'),
('Create new User', 'Crear nuevo usuario', 'es', 'yum'),
('Create new Usergroup', 'Neue Gruppe erstellen', 'de', 'yum'),
('Create new Usergroup', 'Crear nuevo grupo de usuarios', 'es', 'yum'),
('Create new action', 'Neue Aktion', 'de', 'yum'),
('Create new action', 'Crear acción nueva', 'es', 'yum'),
('Create new action', 'Nouvelle action', 'fr', 'yum'),
('Create new action', 'Nuova azione', 'it', 'yum'),
('Create new field group', 'Neue Feldgruppe erstellen', 'de', 'yum'),
('Create new field group', 'Crear campo de grupo nuevo', 'es', 'yum'),
('Create new field group', 'Creer un nouveau champs dans le groupe', 'fr', 'yum'),
('Create new field group', 'Nuovo campo gruppo', 'it', 'yum'),
('Create new field group', 'Dodaj nowa grupe pol', 'pl', 'yum'),
('Create new payment type', 'Neue Zahlungsart hinzufügen', 'de', 'yum'),
('Create new payment type', 'Crear nueva forma de pago', 'es', 'yum'),
('Create new payment type', 'Creer un nouveau mode de paiement', 'fr', 'yum'),
('Create new payment type', 'Nuovo tipo pagamento', 'it', 'yum'),
('Create new role', 'Neue Rolle anlegen', 'de', 'yum'),
('Create new role', 'Crear rol nuevo', 'es', 'yum'),
('Create new role', 'Creer un nouveau role', 'fr', 'yum'),
('Create new role', 'Nuovo ruolo', 'it', 'yum'),
('Create new role', 'Dodaj nowa role', 'pl', 'yum'),
('Create new settings profile', 'Neues Einstellungsprofil erstellen', 'de', 'yum'),
('Create new settings profile', 'Crear ajuste de perfil nuevo', 'es', 'yum'),
('Create new settings profile', 'creer une nouvelle configuration de profil.', 'fr', 'yum'),
('Create new settings profile', 'Nuova opzion profilo', 'it', 'yum'),
('Create new settings profile', 'Dodaj nowe ustawienia profilu', 'pl', 'yum'),
('Create new user', 'Crear usuario nuevo', 'es', 'yum'),
('Create new user', 'Creer un nouveau membre', 'fr', 'yum'),
('Create new user', 'Nuovo utente', 'it', 'yum'),
('Create new user', 'Dodaj nowego uzytkownika', 'pl', 'yum'),
('Create new usergroup', 'Neue Gruppe erstellen', 'de', 'yum'),
('Create new usergroup', 'Crear un nuevo grupo de usuarios', 'es', 'yum'),
('Create new usergroup', 'Creer un nouveau grouppe', 'fr', 'yum'),
('Create new usergroup', 'Nuovo usergroup', 'it', 'yum'),
('Create payment type', 'Zahlungsart anlegen', 'de', 'yum'),
('Create payment type', 'Crear el tipo de pago', 'es', 'yum'),
('Create payment type', 'Crea tipo pagamento', 'it', 'yum'),
('Create profile field', 'Ein neues Profilfeld erstellen', 'de', 'yum'),
('Create profile field', 'Crear campo de perfil', 'es', 'yum'),
('Create profile field', 'Creer un nouveau champ de profil', 'fr', 'yum'),
('Create profile field', 'Crea campo profilo', 'it', 'yum'),
('Create profile field', 'Dodaj pole do profilu', 'pl', 'yum'),
('Create profile fields group', 'Crear grupo de campos de perfil', 'es', 'yum'),
('Create profile fields group', 'Nuovo gruppo di campi profilo', 'it', 'yum'),
('Create profile fields group', 'Dodaj grupe pol do profilu', 'pl', 'yum'),
('Create role', 'Neue Rolle anlegen', 'de', 'yum'),
('Create role', 'Crear rol', 'es', 'yum'),
('Create role', 'Creer un nouveau role', 'fr', 'yum'),
('Create role', 'Crea ruolo', 'it', 'yum'),
('Create role', 'Dodaj role', 'pl', 'yum'),
('Create user', 'Benutzer anlegen', 'de', 'yum'),
('Create user', 'Crear usuario', 'es', 'yum'),
('Create user', 'Creer un membre', 'fr', 'yum'),
('Create user', 'Crea utente', 'it', 'yum'),
('Create user', 'Dodaj uzytkownika', 'pl', 'yum'),
('Date', 'Datum', 'de', 'yum'),
('Date', 'Fecha', 'es', 'yum'),
('Date', 'Date', 'fr', 'yum'),
('Date', 'Data', 'it', 'yum'),
('Date', 'Data', 'pl', 'yum'),
('Default', 'Default', 'de', 'yum'),
('Default', 'Predeterminado', 'es', 'yum'),
('Default', 'Default', 'fr', 'yum'),
('Default', 'Predefinito', 'it', 'yum'),
('Default', 'По умолчанию', 'ru', 'yum'),
('Delete Account', 'Zugang löschen', 'de', 'yum'),
('Delete Account', 'Eliminar Cuenta', 'es', 'yum'),
('Delete Account', 'Supprimer le compte', 'fr', 'yum'),
('Delete Account', 'Cancella account', 'it', 'yum'),
('Delete Profile Field', 'Cancella campo Profilo', 'it', 'yum'),
('Delete Profile Field', 'Удалить', 'ru', 'yum'),
('Delete User', 'Benutzer löschen', 'de', 'yum'),
('Delete User', 'Eliminar Usuario', 'es', 'yum'),
('Delete User', 'Supprimer le membre', 'fr', 'yum'),
('Delete User', 'Cancella utente', 'it', 'yum'),
('Delete User', 'Удалить', 'ru', 'yum'),
('Delete account', 'Zugang löschen', 'de', 'yum'),
('Delete account', 'Eliminar cuenta', 'es', 'yum'),
('Delete account', 'Supprimer ce compte', 'fr', 'yum'),
('Delete account', 'Cancella account', 'it', 'yum'),
('Delete account', 'Usun konto', 'pl', 'yum'),
('Delete file', 'Cancella file', 'it', 'yum'),
('Delete message', 'Nachricht löschen', 'de', 'yum'),
('Delete message', 'Eliminar mensaje', 'es', 'yum'),
('Delete message', 'Supprimer le message', 'fr', 'yum'),
('Delete message', 'Cancella messaggio', 'it', 'yum'),
('Deleted', 'Gelöscht', 'de', 'yum'),
('Deleted', 'Eliminado', 'es', 'yum'),
('Deleted', 'Supprime', 'fr', 'yum'),
('Deleted', 'Cancella', 'it', 'yum'),
('Deny', 'Ablehnen', 'de', 'yum'),
('Deny', 'Negar', 'es', 'yum'),
('Deny', 'Refuser', 'fr', 'yum'),
('Deny', 'Vietao', 'it', 'yum'),
('Description', 'Beschreibung', 'de', 'yum'),
('Description', 'Descripción', 'es', 'yum'),
('Description', 'Description', 'fr', 'yum'),
('Description', 'Descrizione', 'it', 'yum'),
('Description', 'Opis', 'pl', 'yum'),
('Different users logged in today', 'Anzahl der heute angemeldeten Benutzer', 'de', 'yum'),
('Different users logged in today', 'Diferentes usuarios iniciaron sesión hoy', 'es', 'yum'),
('Different users logged in today', 'Nombre d utilisateurs inscrits/connectes aujourd hui.', 'fr', 'yum'),
('Different users logged in today', 'Numero di utenti connessi oggi', 'it', 'yum'),
('Different users logged in today', 'Liczba dzisiejszych unikalnych logowan', 'pl', 'yum'),
('Different viewn Profiles', 'Insgesamt betrachtete Profile', 'de', 'yum'),
('Different viewn Profiles', 'Perfiles diferentes vistos', 'es', 'yum'),
('Different viewn Profiles', 'Total des profils consultes', 'fr', 'yum'),
('Different viewn Profiles', 'Visualizzazioni profilo', 'it', 'yum'),
('Display order of fields.', 'Reihenfolgenposition, in der das Feld angezeigt wird', 'de', 'yum'),
('Display order of fields.', 'Mostrar orden de los campos', 'es', 'yum'),
('Display order of fields.', 'Ordre de position dans laquelle le champ apparaitra', 'fr', 'yum'),
('Display order of fields.', 'Mostra ordine dei campi.', 'it', 'yum'),
('Display order of fields.', 'Kolejnosc wyswietlania pol.', 'pl', 'yum'),
('Display order of fields.', 'Порядок отображения полей.', 'ru', 'yum'),
('Display order of group.', 'Anzeigereihenfolge der Gruppe.', 'de', 'yum'),
('Display order of group.', 'Mostrar orden del grupo', 'es', 'yum'),
('Display order of group.', 'Annonces ordonnees du grouppe.', 'fr', 'yum'),
('Display order of group.', 'Ordine di visualizzazione del gruppo.', 'it', 'yum'),
('Display order of group.', 'Wyswietl kolejnosc grup.', 'pl', 'yum'),
('Do not appear in search', 'Nicht in der Suche erscheinen', 'de', 'yum'),
('Do not appear in search', 'No aparecer en la b', 'es', 'yum'),
('Do not appear in search', 'Ne pas paraitre dans les resultat de recherche', 'fr', 'yum'),
('Do not appear in search', 'Non mostrare nelle ricerche', 'it', 'yum'),
('Do not show my online status', 'Status verstecken', 'de', 'yum'),
('Do not show my online status', 'No mostrar mi estado de conexi', 'es', 'yum'),
('Do not show my online status', 'Ne pas rendre mon profil visible lorsque je suis en ligne', 'fr', 'yum'),
('Do not show my online status', 'Non mostrare il mio stato online', 'it', 'yum'),
('Do not show the owner of a profile when i visit him', 'Niemandem zeigen, wen ich besucht habe', 'de', 'yum'),
('Do not show the owner of a profile when i visit him', 'No se repite el due', 'es', 'yum'),
('Do not show the owner of a profile when i visit him', 'Ne pas montrer les profils que j ai visite', 'fr', 'yum'),
('Do not show the owner of a profile when i visit him', 'Non mostrare al proprietario quando visito il suo profilo', 'it', 'yum'),
('Downgrade to {role}', 'Wechsle auf {role}', 'de', 'yum'),
('Duration in days', 'Gültigkeitsdauer in Tagen', 'de', 'yum'),
('Duration in days', 'Duraci', 'es', 'yum'),
('Duration in days', 'Validite en jours', 'fr', 'yum'),
('Duration in days', 'Durata in giorni', 'it', 'yum'),
('E-Mail address', 'E-Mail Adresse', 'de', 'yum'),
('E-Mail address', 'Correo electrónico', 'es', 'yum'),
('E-Mail address', 'Adresse e-mail', 'fr', 'yum'),
('E-Mail address', 'Indirizzo email', 'it', 'yum'),
('E-Mail already in use. If you have not registered before, please contact our System administrator.', 'Este correo ya está siendo usado por alguien. Si no te habías registrado antes entonces contáctanos', 'es', 'yum'),
('E-mail', 'E-mail', 'de', 'yum'),
('E-mail', 'Correo electrónico', 'es', 'yum'),
('E-mail', 'E-mail', 'fr', 'yum'),
('E-mail', 'E-mail', 'it', 'yum'),
('E-mail', 'Mejl', 'pl', 'yum'),
('E-mail', 'Электронная почта', 'ru', 'yum'),
('Edit', 'Bearbeiten', 'de', 'yum'),
('Edit', 'Editar', 'es', 'yum'),
('Edit', 'Editer', 'fr', 'yum'),
('Edit', 'Modifica', 'it', 'yum'),
('Edit', 'Bearbeiten', 'pl', 'yum'),
('Edit', 'Редактировать', 'ru', 'yum'),
('Edit personal data', 'Persönliche Daten bearbeiten', 'de', 'yum'),
('Edit personal data', 'Editar datos personales', 'es', 'yum'),
('Edit personal data', 'Modifier mes donnees personnelles', 'fr', 'yum'),
('Edit personal data', 'Modifica dati personali', 'it', 'yum'),
('Edit profile', 'Profil bearbeiten', 'de', 'yum'),
('Edit profile', 'Editar perfil', 'es', 'yum'),
('Edit profile', 'Editer le profil', 'fr', 'yum'),
('Edit profile', 'Modifica profilo', 'it', 'yum'),
('Edit profile', 'Meine Profildaten bearbeiten', 'pl', 'yum'),
('Edit profile', 'Редактирование профиля', 'ru', 'yum'),
('Edit profile field', 'Profilfeld bearbeiten', 'de', 'yum'),
('Edit profile field', 'Editar campo del perfil', 'es', 'yum'),
('Edit profile field', 'Editer les champ du profil', 'fr', 'yum'),
('Edit profile field', 'Modifica campi profilo', 'it', 'yum'),
('Edit profile field', 'Profilfeld bearbeiten', 'pl', 'yum'),
('Edit text', 'Modifica testo', 'it', 'yum'),
('Edit this role', 'Diese Rolle bearbeiten', 'de', 'yum'),
('Edit this role', 'Editar este rol', 'es', 'yum'),
('Edit this role', 'Modifier ce role', 'fr', 'yum'),
('Edit this role', 'Modifica questo ruolo', 'it', 'yum'),
('Edit this role', 'Zmien te role', 'pl', 'yum'),
('Email is incorrect.', 'E-Mail ist nicht korrekt.', 'de', 'yum'),
('Email is incorrect.', 'Email incorrecto', 'es', 'yum'),
('Email is incorrect.', 'L adresse e-mail est incorrecte.', 'fr', 'yum'),
('Email is incorrect.', 'Email non corretta.', 'it', 'yum'),
('Email is incorrect.', 'Mejl jest niepoprawny.', 'pl', 'yum'),
('Email is incorrect.', 'Пользователь с таким электроным адресом не зарегистрирован.', 'ru', 'yum'),
('Email is not set when trying to send Registration Email', 'Debes colocar el correo electrónico para enviar el correo de registro', 'es', 'yum'),
('Enable Captcha', 'Captcha Überprüfung aktivieren', 'de', 'yum'),
('Enable Captcha', 'Habilitar Captcha', 'es', 'yum'),
('Enable Captcha', 'Activer le controle par Captcha', 'fr', 'yum'),
('Enable Captcha', 'Attiva Captcha', 'it', 'yum'),
('Enable Captcha', 'Wlacz Captcha', 'pl', 'yum'),
('Enable Email Activation', 'Aktivierung per E-Mail einschalten', 'de', 'yum'),
('Enable Email Activation', 'Habilitar Activación por Email', 'es', 'yum'),
('Enable Email Activation', 'Activer l activation par e-mail', 'fr', 'yum'),
('Enable Email Activation', 'Attiva attivazione via Email', 'it', 'yum'),
('Enable Email Activation', 'Wlacz aktywacje mejlem', 'pl', 'yum'),
('Enable Profile History', 'Profilhistorie einschalten', 'de', 'yum'),
('Enable Profile History', 'Habilitar Historial de Perfil', 'es', 'yum'),
('Enable Profile History', 'Activer le protocole des profils', 'fr', 'yum'),
('Enable Profile History', 'Attiva storico Profilo', 'it', 'yum'),
('Enable Profile History', 'Wlacz historie profilow', 'pl', 'yum'),
('Enable Recovery', 'Wiederherstellung einschalten', 'de', 'yum'),
('Enable Recovery', 'Habilitar Recuperación', 'es', 'yum'),
('Enable Recovery', 'Activer la restauration', 'fr', 'yum'),
('Enable Recovery', 'Attiva rispristino', 'it', 'yum'),
('Enable Recovery', 'Wlacz odzyskiwanie hasel', 'pl', 'yum'),
('Enable Registration', 'Registrierung einschalten', 'de', 'yum'),
('Enable Registration', 'Habilitar Registro', 'es', 'yum'),
('Enable Registration', 'Activer l enregistrement', 'fr', 'yum'),
('Enable Registration', 'Attiva registrazione', 'it', 'yum'),
('Enable Registration', 'Wlacz rejestracje', 'pl', 'yum'),
('End date', 'Enddatum', 'de', 'yum'),
('End date', 'Fecha final', 'es', 'yum'),
('End date', 'Data scadenza', 'it', 'yum'),
('Ends at', 'Endet am', 'de', 'yum'),
('Ends at', 'Termina en', 'es', 'yum'),
('Ends at', 'Scade il', 'it', 'yum'),
('Error Message', 'Fehlermeldung', 'de', 'yum'),
('Error Message', 'Mensaje de Error', 'es', 'yum'),
('Error Message', 'Message d erreur', 'fr', 'yum'),
('Error Message', 'Messaggio d''errore', 'it', 'yum'),
('Error Message', 'Сообщение об ошибке', 'ru', 'yum'),
('Error message when Validation fails.', 'Fehlermeldung falls die Validierung fehlschlägt', 'de', 'yum'),
('Error message when Validation fails.', 'Mensaje de error cuando la Validación falla', 'es', 'yum'),
('Error message when Validation fails.', 'Message d erreur pour le cas ou la validation echoue', 'fr', 'yum'),
('Error message when Validation fails.', 'Messaggio d''errore se fallisce la validazione', 'it', 'yum'),
('Error message when you validate the form.', 'Messaggio d''errore durante la validazione del form.', 'it', 'yum'),
('Error message when you validate the form.', 'Сообщение об ошибке при проверке формы.', 'ru', 'yum'),
('Error while processing new avatar image : {error_message}; File was uploaded without resizing', 'Das Bild konnte nicht richtig skaliert werden: {error_message}. Es wurde trotzdem erfolgreich hochgeladen und in ihrem Profil aktiviert.', 'de', 'yum'),
('Error while processing new avatar image : {error_message}; File was uploaded without resizing', 'Error al procesar la imagen nuevo avatar: {mensaje_error}; El archivo se ha subido sin cambiar el tama', 'es', 'yum'),
('Error while processing new avatar image : {error_message}; File was uploaded without resizing', 'L image n a pas pu etre retaillee automatiquement lors du chargement. : {error_message}. elle a ete cependant chargee avec succes et activee dans votre profil', 'fr', 'yum'),
('Error while processing new avatar image : {error_message}; File was uploaded without resizing', 'Errore processando il nuovo avatar: {error_message}. File caricato senza ridimensionamento.', 'it', 'yum'),
('Expired', 'Abgelaufen', 'de', 'yum'),
('Expired', 'Caducado', 'es', 'yum'),
('Field', 'Feld', 'de', 'yum'),
('Field', 'Campo', 'es', 'yum'),
('Field', 'Champ', 'fr', 'yum'),
('Field', 'Campo', 'it', 'yum'),
('Field', 'Pole', 'pl', 'yum'),
('Field Size', 'Feldgröße', 'de', 'yum'),
('Field Size', 'Tamaño del Campo', 'es', 'yum'),
('Field Size', 'Longueur du champ', 'fr', 'yum'),
('Field Size', 'Dimensione campo', 'it', 'yum'),
('Field Size', 'Размер поля', 'ru', 'yum'),
('Field Size min', 'min Feldgröße', 'de', 'yum'),
('Field Size min', 'Tamaño mínimo del campo', 'es', 'yum'),
('Field Size min', 'longueur du champ minimum', 'fr', 'yum'),
('Field Size min', 'Dimesione minima campo', 'it', 'yum'),
('Field Size min', 'Минимальное значение', 'ru', 'yum'),
('Field Type', 'Feldtyp', 'de', 'yum'),
('Field Type', 'Tipo de Campo', 'es', 'yum'),
('Field Type', 'Type du champ', 'fr', 'yum'),
('Field Type', 'Tipo campo', 'it', 'yum'),
('Field Type', 'Тип поля', 'ru', 'yum'),
('Field group', 'Feldgruppe', 'de', 'yum'),
('Field group', 'Grupo de Campos', 'es', 'yum'),
('Field group', 'Champ des groupes', 'fr', 'yum'),
('Field group', 'Campi gruppo', 'it', 'yum'),
('Field group', 'Grupa pol', 'pl', 'yum'),
('Field name on the language of "sourceLanguage".', 'Feldname in der Ursprungssprache', 'de', 'yum'),
('Field name on the language of "sourceLanguage".', 'Nombre del campo en el idioma "sourceLanguage".', 'es', 'yum'),
('Field name on the language of &quot;sourceLanguage&quot;.', 'Non du champ dans la langue standard', 'fr', 'yum'),
('Field name on the language of &quot;sourceLanguage&quot;.', 'Nome campo per il linguaggio di "sourceLanguage".', 'it', 'yum'),
('Field name on the language of &quot;sourceLanguage&quot;.', 'Feldname in der Ursprungssprache', 'pl', 'yum'),
('Field name on the language of &quot;sourceLanguage&quot;.', 'Название поля на языке "sourceLanguage".', 'ru', 'yum'),
('Field size', 'Feldgröße', 'de', 'yum'),
('Field size', 'Tamaño del campo', 'es', 'yum'),
('Field size', 'Longueur du champ', 'fr', 'yum'),
('Field size', 'Dimensione campo', 'it', 'yum'),
('Field size', 'Feldgro?e', 'pl', 'yum'),
('Field size column in the database.', 'Dimensione campo nel database', 'it', 'yum'),
('Field size column in the database.', 'Размер поля колонки в базе данных', 'ru', 'yum'),
('Field size in the database.', 'Feldgröße in der Datenbank', 'de', 'yum'),
('Field size in the database.', 'Tamaño del campo en la base de datos', 'es', 'yum'),
('Field size in the database.', 'Longueur du champ dans la banque de donnee', 'fr', 'yum'),
('Field size in the database.', 'Dimensione campo nel database', 'it', 'yum'),
('Field size in the database.', 'Feldgro?e in der Datenbank', 'pl', 'yum'),
('Field type', 'Feldtyp', 'de', 'yum'),
('Field type', 'Tipo de campo', 'es', 'yum'),
('Field type', 'Type de champ', 'fr', 'yum'),
('Field type', 'Tipo campo', 'it', 'yum'),
('Field type', 'Feldtyp', 'pl', 'yum'),
('Field type column in the database.', 'Tipo campo nel database.', 'it', 'yum'),
('Field type column in the database.', 'Тип поля колонки в базе данных.', 'ru', 'yum'),
('Fields with * are required.', 'Los campos con * son obligatorios', 'es', 'yum'),
('Fields with <span class="required">*</span> are required.', 'Felder mit <span class="required">*</span> sind Pflichtfelder.', 'de', 'yum'),
('First Name', 'Nome', 'it', 'yum'),
('First Name', 'Имя', 'ru', 'yum'),
('First name', 'Vorname', 'de', 'yum'),
('First name', 'Nombre', 'es', 'yum'),
('First name', 'Prenom', 'fr', 'yum'),
('First name', 'Cognome', 'it', 'yum'),
('First name', 'Vorname', 'pl', 'yum'),
('For all', 'Für alle', 'de', 'yum'),
('For all', 'Para todos', 'es', 'yum'),
('For all', 'Pour tous', 'fr', 'yum'),
('For all', 'Per tutti', 'it', 'yum'),
('For all', 'Для всех', 'ru', 'yum'),
('Form validation error', 'Error en la validación del formulario', 'es', 'yum'),
('Friends', 'Kontakte', 'de', 'yum'),
('Friends', 'Amigos', 'es', 'yum'),
('Friends', 'Mes contacts', 'fr', 'yum'),
('Friends', 'Contatti', 'it', 'yum'),
('Friends of {username}', 'Kontakte von {username}', 'de', 'yum'),
('Friends of {username}', 'Amigos de {username}', 'es', 'yum'),
('Friends of {username}', 'Contact de {username}', 'fr', 'yum'),
('Friends of {username}', 'Contatti di {username}', 'it', 'yum'),
('Friendship', 'Kontakt', 'de', 'yum'),
('Friendship', 'Amistades', 'es', 'yum'),
('Friendship', 'Contact', 'fr', 'yum'),
('Friendship', 'Contatto', 'it', 'yum'),
('Friendship confirmed', 'Freundschaft bestätigt', 'de', 'yum'),
('Friendship confirmed', 'Amistad confirmada', 'es', 'yum'),
('Friendship confirmed', 'Demande de contact confirmee', 'fr', 'yum'),
('Friendship confirmed', 'Contatto confermato', 'it', 'yum'),
('Friendship rejected', 'Kontaktanfrage abgelehnt', 'de', 'yum'),
('Friendship rejected', 'La amistad rechazada', 'es', 'yum'),
('Friendship rejected', 'Demande de contact refusee', 'fr', 'yum'),
('Friendship rejected', 'Amizicia rigettata', 'it', 'yum'),
('Friendship request already sent', 'Kontaktbestätigung ausstehend', 'de', 'yum'),
('Friendship request already sent', 'Ya se envió la solicitud de amistad', 'es', 'yum'),
('Friendship request already sent', 'En attente de confirmation', 'fr', 'yum'),
('Friendship request already sent', 'Richiesta di contatto gia inviata', 'it', 'yum'),
('Friendship request for {username} has been sent', 'Kontaktanfrage an {username} gesendet', 'de', 'yum'),
('Friendship request for {username} has been sent', 'La solicitud de amistad a {username} ha sido enviada', 'es', 'yum'),
('Friendship request for {username} has been sent', 'Demande de contact envoyee a {username}', 'fr', 'yum'),
('Friendship request for {username} has been sent', 'Inviata richiesta di contatto a {username}', 'it', 'yum'),
('Friendship request has been rejected', 'Kontaktanfrage zurückgewiesen', 'de', 'yum'),
('Friendship request has been rejected', 'Solicitud de amistad rechazada', 'es', 'yum'),
('Friendship request has been rejected', 'Votre demande de contact a ete rejetee', 'fr', 'yum'),
('Friendship request has been rejected', 'Richiesta di contatto respinta', 'it', 'yum'),
('From', 'Von', 'de', 'yum'),
('From', 'Desde', 'es', 'yum'),
('From', 'De', 'fr', 'yum'),
('From', 'Da', 'it', 'yum'),
('From', 'Od', 'pl', 'yum'),
('General', 'Allgemein', 'de', 'yum'),
('General', ' General ', 'es', 'yum'),
('General', 'Generale', 'it', 'yum'),
('Generate Demo Data', 'Zufallsbenutzer erzeugen', 'de', 'yum'),
('Generate Demo Data', 'Genera datos de prueba', 'es', 'yum'),
('Generate Demo Data', 'Generer un compte membre-demo', 'fr', 'yum'),
('Generate Demo Data', 'Genera dati demo', 'it', 'yum'),
('Go to profile of {username}', 'Zum Profil von {username}', 'de', 'yum'),
('Go to profile of {username}', 'Ir al perfil de {username}', 'es', 'yum'),
('Go to profile of {username}', 'Voir le profil de {username}', 'fr', 'yum'),
('Go to profile of {username}', 'Vai al profilo di {username}', 'it', 'yum'),
('Grant permission', 'Berechtigung zuweisen', 'de', 'yum'),
('Grant permission', 'Otorgar permiso', 'es', 'yum'),
('Grant permission', 'Attribuer une permission', 'fr', 'yum'),
('Grant permission', 'Assegna permesso', 'it', 'yum'),
('Group Name', 'Gruppenname', 'de', 'yum'),
('Group Name', 'Nombre de grupo', 'es', 'yum'),
('Group Name', 'Nom du groupe', 'fr', 'yum'),
('Group Name', 'Nome gruppo', 'it', 'yum'),
('Group Name', 'Nazwa grupy', 'pl', 'yum'),
('Group name on the language of "sourceLanguage".', 'Gruppenname in der Basissprache.', 'de', 'yum'),
('Group name on the language of "sourceLanguage".', 'Nombre del grupo en el idioma "sourceLanguage".', 'es', 'yum'),
('Group name on the language of &quot;sourceLanguage&quot;.', 'Nom du groupe dans la langue principale.', 'fr', 'yum'),
('Group name on the language of &quot;sourceLanguage&quot;.', 'Il nome del gruppo nella lingua di base.', 'it', 'yum'),
('Group name on the language of &quot;sourceLanguage&quot;.', 'Nazwa grupy w jezyku uzytkownika.', 'pl', 'yum'),
('Group owner', 'Gruppeneigentümer', 'de', 'yum'),
('Group owner', 'Dueño del grupo', 'es', 'yum'),
('Group owner', 'Proprietaire du grouppe', 'fr', 'yum'),
('Group owner', 'Proprietario gruppo', 'it', 'yum'),
('Group title', 'Titel der Gruppe', 'de', 'yum'),
('Group title', 'Título del grupo', 'es', 'yum'),
('Group title', 'Titre du grouppe', 'fr', 'yum'),
('Group title', 'Titolo gruppo', 'it', 'yum'),
('Having', 'Anzeigen', 'de', 'yum'),
('Having', 'Teniendo', 'es', 'yum'),
('Having', 'Annonce', 'fr', 'yum'),
('Having', 'Visualizza', 'it', 'yum'),
('Hidden', 'Verstecken', 'de', 'yum'),
('Hidden', 'Escondido', 'es', 'yum'),
('Hidden', 'Cache', 'fr', 'yum'),
('Hidden', 'Nascosto', 'it', 'yum'),
('Hidden', 'Скрыт', 'ru', 'yum'),
('How expensive is a membership?', 'Preis der Mitgliedschaft', 'de', 'yum'),
('How expensive is a membership?', '', 'es', 'yum'),
('How expensive is a membership?', 'Prix de l abbonement', 'fr', 'yum'),
('How expensive is a membership?', 'Quanto costa l''iscrizione?', 'it', 'yum'),
('How many days will the membership be valid after payment?', 'Wie viele Tage ist die Mitgliedschaft nach Zahlungseingang gültig?', 'de', 'yum'),
('How many days will the membership be valid after payment?', '', 'es', 'yum'),
('How many days will the membership be valid after payment?', 'Nombre de jours pour la validite d un abbonement apres paiement?', 'fr', 'yum'),
('How many days will the membership be valid after payment?', 'Quanti giorni e valida l''iscrizione dopo il pagamento?', 'it', 'yum'),
('Ignore', 'Ignorieren', 'de', 'yum'),
('Ignore', 'Ignorar', 'es', 'yum'),
('Ignore', 'Ignorer', 'fr', 'yum'),
('Ignore', 'Ignora', 'it', 'yum'),
('Ignored users', 'Ignorierliste', 'de', 'yum'),
('Ignored users', 'Usuarios ignorados', 'es', 'yum'),
('Ignored users', 'Liste noire', 'fr', 'yum'),
('Ignored users', 'Utenti ignorati', 'it', 'yum'),
('Inactive users', 'Inaktive Benutzer', 'de', 'yum'),
('Inactive users', 'Usuarios inactivos', 'es', 'yum'),
('Inactive users', 'Utilisateur inactif', 'fr', 'yum'),
('Inactive users', 'Utenti inattivi', 'it', 'yum'),
('Inactive users', 'Nieaktywni uzytkownicy', 'pl', 'yum'),
('Incorrect activation URL', 'El enlace de activación que usaste es incorrecto', 'es', 'yum'),
('Incorrect activation URL.', 'Falsche Aktivierungs URL.', 'de', 'yum'),
('Incorrect activation URL.', 'URL de activación incorrecta.', 'es', 'yum'),
('Incorrect activation URL.', 'Le lien d activation de votre compte est incorrect ou perime. Consultez notre FAQ: mot cle= inscription ou contactez gratuitement notre Help-Center en ligne sur la page d aide.', 'fr', 'yum'),
('Incorrect activation URL.', 'URL di attivazione incorretto', 'it', 'yum'),
('Incorrect activation URL.', 'Falsche Aktivierungs URL.', 'pl', 'yum'),
('Incorrect activation URL.', 'Неправильная ссылка активации учетной записи.', 'ru', 'yum'),
('Incorrect password (minimal length 4 symbols).', 'Falsches Passwort (minimale Länge 4 Zeichen).', 'de', 'yum'),
('Incorrect password (minimal length 4 symbols).', 'Contraseña incorrecta (debe tener mínimo 4 caracteres).', 'es', 'yum'),
('Incorrect password (minimal length 4 symbols).', 'Mot de passe incorrect (longueur minimal de 4 characteres).', 'fr', 'yum'),
('Incorrect password (minimal length 4 symbols).', 'Password sbagliata (lunga almeno 4 caratteri).', 'it', 'yum'),
('Incorrect password (minimal length 4 symbols).', 'Falsches Passwort (minimale Lange 4 Zeichen).', 'pl', 'yum'),
('Incorrect password (minimal length 4 symbols).', 'Минимальная длина пароля 4 символа.', 'ru', 'yum'),
('Incorrect recovery link.', 'Recovery link ist falsch.', 'de', 'yum'),
('Incorrect recovery link.', 'Enlace de recuperación que usaste es incorrecto', 'es', 'yum'),
('Incorrect recovery link.', 'Le lien de restauration est incorrect ou perime.', 'fr', 'yum'),
('Incorrect recovery link.', 'Link ripristino incorretto.', 'it', 'yum'),
('Incorrect recovery link.', 'Recovery link ist falsch.', 'pl', 'yum'),
('Incorrect recovery link.', 'Неправильная ссылка востановления пароля.', 'ru', 'yum'),
('Incorrect symbol''s. (A-z0-9)', 'Im Benutzernamen sind nur Buchstaben und Zahlen erlaubt.', 'de', 'yum'),
('Incorrect symbol''s. (A-z0-9)', 'Caracteres incorrectos. (A-z0-9)', 'es', 'yum'),
('Incorrect symbol''s. (A-z0-9)', 'Pour le choix de votre nom d utilisateur seules les lettres de l alphabet et les chiffres sont acceptes .', 'fr', 'yum'),
('Incorrect symbol''s. (A-z0-9)', 'Sono consentiti solo lettere e numeri', 'it', 'yum'),
('Incorrect symbol''s. (A-z0-9)', 'Im Benutzernamen sind nur Buchstaben und Zahlen erlaubt.', 'pl', 'yum'),
('Incorrect symbol''s. (A-z0-9)', 'В имени пользователя допускаются только латинские буквы и цифры.', 'ru', 'yum'),
('Incorrect username (length between 3 and 20 characters).', 'Falscher Benutzername (Länge zwischen 3 und 20 Zeichen).', 'de', 'yum'),
('Incorrect username (length between 3 and 20 characters).', 'Nombre de usuario incorrecto (debe tener longitud entre 3 y 20 caracteres)', 'es', 'yum'),
('Incorrect username (length between 3 and 20 characters).', 'Nom d utilisateur incorrect (Longueur comprise entre 3 et 20 characteres).', 'fr', 'yum'),
('Incorrect username (length between 3 and 20 characters).', 'Username errato (lunghezza tra i 3 e i 20 caratteri).', 'it', 'yum'),
('Incorrect username (length between 3 and 20 characters).', 'Falscher Benutzername (Lange zwischen 3 und 20 Zeichen).', 'pl', 'yum'),
('Incorrect username (length between 3 and 20 characters).', 'Длина имени пользователя от 3 до 20 символов.', 'ru', 'yum'),
('Instructions have been sent to you. Please check your email.', 'Weitere Anweisungen wurden an ihr E-Mail Postfach geschickt. Bitte prüfen Sie ihre E-Mails', 'de', 'yum'),
('Instructions have been sent to you. Please check your email.', 'Se enviarion instrucciones a tu correo. Por favor, ve tu cuenta de correo.', 'es', 'yum'),
('Instructions have been sent to you. Please check your email.', 'Merci pour votre inscription.Controlez votre boite e-mail, le code d activation de votre compte vous a ete envoye par e-mail. *IMPORTANT:pour le cas ou notre e-mail ne vous serais pas parvenu, il est possible que notre e-mail ai ete filtre par votre', 'fr', 'yum'),
('Instructions have been sent to you. Please check your email.', 'Istruzioni inviate per email. Controlla la tua casella di posta elettronica.', 'it', 'yum'),
('Invalid recovery key', 'Fehlerhafter Wiederherstellungsschlüssel', 'de', 'yum'),
('Invalid recovery key', 'Clave de recuperaci', 'es', 'yum'),
('Invitation', 'Einladung', 'de', 'yum'),
('Invitation', 'Invitaciones', 'es', 'yum'),
('Invitation', 'Invitation', 'fr', 'yum'),
('Invitation', 'Invito', 'it', 'yum'),
('Is membership possible', 'Mitgliedschaft möglich?', 'de', 'yum'),
('Is membership possible', '', 'es', 'yum'),
('Is membership possible', 'Inscription possible?', 'fr', 'yum'),
('Is membership possible', 'Iscrizione possibile?', 'it', 'yum'),
('Join group', 'Beitreten', 'de', 'yum'),
('Join group', 'Unirse al grupo', 'es', 'yum'),
('Join group', 'Collega al gruppo', 'it', 'yum'),
('Jump to profile', 'Zum Profil', 'de', 'yum'),
('Jump to profile', 'Ir al perfil', 'es', 'yum'),
('Jump to profile', 'Consulter le profil', 'fr', 'yum'),
('Jump to profile', 'Vai al profilo', 'it', 'yum'),
('Language', 'Sprache', 'de', 'yum'),
('Language', 'Idioma', 'es', 'yum'),
('Language', '   Langue', 'fr', 'yum'),
('Language', 'Lingua', 'it', 'yum'),
('Last Name', 'Cognome', 'it', 'yum'),
('Last Name', 'Фамилия', 'ru', 'yum'),
('Last name', 'Nachname', 'de', 'yum'),
('Last name', 'Apellido', 'es', 'yum'),
('Last name', 'Nom de famille', 'fr', 'yum'),
('Last name', 'Nome', 'it', 'yum'),
('Last name', 'Nachname', 'pl', 'yum'),
('Last visit', 'Letzter Besuch', 'de', 'yum'),
('Last visit', 'òltima visita', 'es', 'yum'),
('Last visit', 'Dernere visite', 'fr', 'yum'),
('Last visit', 'Ultima visita', 'it', 'yum'),
('Last visit', 'Letzter Besuch', 'pl', 'yum'),
('Last visit', 'Последний визит', 'ru', 'yum'),
('Leave group', 'Gruppe verlassen', 'de', 'yum'),
('Let me appear in the search', 'Ich möchte in der Suche erscheinen', 'de', 'yum'),
('Let me appear in the search', 'Perm', 'es', 'yum'),
('Let me appear in the search', 'Je ne souhaite pas apparaitre dans les resultats des moteurs de recherche', 'fr', 'yum'),
('Let me appear in the search', 'Mostrami nei risultati', 'it', 'yum');
INSERT INTO `translation` (`message`, `translation`, `language`, `category`) VALUES
('Let the user choose in privacy settings', 'Den Benutzer entscheiden lassen', 'de', 'yum'),
('Let the user choose in privacy settings', 'Permita que el usuario elija en la configuraci', 'es', 'yum'),
('Let the user choose in privacy settings', 'Laisser l utilisateur choisir lui-meme', 'fr', 'yum'),
('Let the user choose in privacy settings', 'Consentire all''utente di scegliere le impostazioni della privacy', 'it', 'yum'),
('Letters are not case-sensitive.', 'Zwischen Groß-und Kleinschreibung wird nicht unterschieden.', 'de', 'yum'),
('Letters are not case-sensitive.', 'Las letras nos son sensibles a mayúsculas y minúsculas.', 'es', 'yum'),
('Letters are not case-sensitive.', 'Aucune importance ne sera apportee aux minuscules ou majuscules.', 'fr', 'yum'),
('Letters are not case-sensitive.', 'La ricerca non e case sensitive.', 'it', 'yum'),
('Letters are not case-sensitive.', 'Zwischen Gro?-und Kleinschreibung wird nicht unterschieden.', 'pl', 'yum'),
('Letters are not case-sensitive.', 'Регистр значение не имеет.', 'ru', 'yum'),
('List Profile Field', 'Lista campi Profilo', 'it', 'yum'),
('List Profile Field', 'Список', 'ru', 'yum'),
('List User', 'Lista utenti', 'it', 'yum'),
('List User', 'Список пользователей', 'ru', 'yum'),
('List roles', 'Rollen anzeigen', 'de', 'yum'),
('List roles', 'Listar roles', 'es', 'yum'),
('List roles', 'liste des roles', 'fr', 'yum'),
('List roles', 'Lista ruoli', 'it', 'yum'),
('List roles', 'Lista rol', 'pl', 'yum'),
('List user', 'Benutzer auflisten', 'de', 'yum'),
('List user', 'Listar usuario', 'es', 'yum'),
('List user', 'Liste completes des membres', 'fr', 'yum'),
('List user', 'Lista utenti', 'it', 'yum'),
('List user', 'Benutzer auflisten', 'pl', 'yum'),
('List users', 'Benutzer anzeigen', 'de', 'yum'),
('List users', 'Listar usuarios', 'es', 'yum'),
('List users', 'Liste des membres', 'fr', 'yum'),
('List users', 'Lista utenti', 'it', 'yum'),
('List users', 'Lista uzytkownikow', 'pl', 'yum'),
('Log profile visits', 'Meine Profilbesuche anzeigen', 'de', 'yum'),
('Log profile visits', 'Registrarse visitas al perfil', 'es', 'yum'),
('Log profile visits', 'Voir les statistiques des visiteurs de mon profil', 'fr', 'yum'),
('Log profile visits', 'Log visite profilo', 'it', 'yum'),
('Logged in as', 'Angemeldet als', 'de', 'yum'),
('Logged in as', 'Conectado como', 'es', 'yum'),
('Logged in as', 'Connecte en tant que', 'fr', 'yum'),
('Logged in as', 'Loggato come', 'it', 'yum'),
('Login', 'Anmeldung', 'de', 'yum'),
('Login', 'Iniciar sesión', 'es', 'yum'),
('Login', 'Inscription', 'fr', 'yum'),
('Login', 'Entra', 'it', 'yum'),
('Login', 'Logowanie', 'pl', 'yum'),
('Login', 'Вход', 'ru', 'yum'),
('Login Type', 'Anmeldungsart', 'de', 'yum'),
('Login Type', 'Tipo de inicio de sesión', 'es', 'yum'),
('Login Type', 'Mode de connection', 'fr', 'yum'),
('Login Type', 'Tipo login', 'it', 'yum'),
('Login Type', 'Rodzaj logowania', 'pl', 'yum'),
('Login allowed by Email and Username', 'Anmeldung per Benutzername oder E-Mail adresse', 'de', 'yum'),
('Login allowed by Email and Username', 'Inicio de sesión por Email y Nombre de usuario', 'es', 'yum'),
('Login allowed by Email and Username', 'Connection avec le nom d utilisateur ou adresse e-mail.', 'fr', 'yum'),
('Login allowed by Email and Username', 'Login con il nome utente o l''indirizzo e-mail', 'it', 'yum'),
('Login allowed by Email and Username', 'Logowanie przez nazwe lub mejl', 'pl', 'yum'),
('Login allowed only by Email', 'Anmeldung nur per E-Mail adresse', 'de', 'yum'),
('Login allowed only by Email', 'Inicio de sesión sólo por Email', 'es', 'yum'),
('Login allowed only by Email', 'COnnection avec l adresse e-mail seulement', 'fr', 'yum'),
('Login allowed only by Email', 'Login solo tramite email', 'it', 'yum'),
('Login allowed only by Email', 'Logowanie poprzez mejl', 'pl', 'yum'),
('Login allowed only by Username', 'Anmeldung nur per Benutzername', 'de', 'yum'),
('Login allowed only by Username', 'Inicio de sesión sólo por Nombre de usuario', 'es', 'yum'),
('Login allowed only by Username', 'Connection avec le nom d utilisateur seulement', 'fr', 'yum'),
('Login allowed only by Username', 'Login solo tramite username', 'it', 'yum'),
('Login allowed only by Username', 'Logowanie poprzez nazwe', 'pl', 'yum'),
('Login is not possible with the given credentials', 'Anmeldung mit den angegebenen Werten nicht möglich', 'de', 'yum'),
('Login is not possible with the given credentials', 'Inicio de sesi', 'es', 'yum'),
('Logout', 'Abmelden', 'de', 'yum'),
('Logout', 'Cerrar sesión', 'es', 'yum'),
('Logout', 'Deconnection', 'fr', 'yum'),
('Logout', 'Esci', 'it', 'yum'),
('Logout', 'Wyloguj', 'pl', 'yum'),
('Logout', 'Выйти', 'ru', 'yum'),
('Lost Password?', 'Password dimenticata?', 'it', 'yum'),
('Lost Password?', 'Забыли пароль?', 'ru', 'yum'),
('Lost password?', 'Passwort vergessen?', 'de', 'yum'),
('Lost password?', '¿Olvidó la contraseña?', 'es', 'yum'),
('Lost password?', 'Mot de passe oublie?', 'fr', 'yum'),
('Lost password?', 'Password dimenticata?', 'it', 'yum'),
('Lost password?', 'Passwort vergessen?', 'pl', 'yum'),
('Mail send method', 'Nachrichtenversandmethode', 'de', 'yum'),
('Mail send method', 'Método de envío de correo', 'es', 'yum'),
('Mail send method', 'Mode d envoie des messages', 'fr', 'yum'),
('Mail send method', 'Metodo invio mail', 'it', 'yum'),
('Mail send method', 'Metoda wysylania mejli', 'pl', 'yum'),
('Make {field} public available', 'Das Feld {field} öffentlich machen', 'de', 'yum'),
('Make {field} public available', 'Haga {field} disponible al p', 'es', 'yum'),
('Make {field} public available', 'Rendre publique le champ {field}', 'fr', 'yum'),
('Make {field} public available', 'Rendi pubblico il campo {field}', 'it', 'yum'),
('Manage', 'Verwalten', 'de', 'yum'),
('Manage', 'Administrar', 'es', 'yum'),
('Manage', 'Gestion', 'fr', 'yum'),
('Manage', 'Gestione', 'it', 'yum'),
('Manage', 'Управление', 'ru', 'yum'),
('Manage Actions', 'Gestione azioni', 'it', 'yum'),
('Manage Profile Field', 'Profilfeld verwalten', 'de', 'yum'),
('Manage Profile Field', 'Administrar Campos de Perfil', 'es', 'yum'),
('Manage Profile Field', 'Gerer le champ de profil', 'fr', 'yum'),
('Manage Profile Field', 'Gestione campi profilo', 'it', 'yum'),
('Manage Profile Field', 'Zarzadzaj polem profilu', 'pl', 'yum'),
('Manage Profile Field', 'Настройка полей', 'ru', 'yum'),
('Manage Profile Fields', 'Profilfelder verwalten', 'de', 'yum'),
('Manage Profile Fields', 'Administrar Campos de Perfil', 'es', 'yum'),
('Manage Profile Fields', 'Gerer les champs de profils', 'fr', 'yum'),
('Manage Profile Fields', 'Gestione campi Profilo', 'it', 'yum'),
('Manage Profile Fields', 'Zarzadzaj polami profilu', 'pl', 'yum'),
('Manage Profile Fields', 'Настройка полей', 'ru', 'yum'),
('Manage Profiles', 'Profile verwalten', 'de', 'yum'),
('Manage Profiles', 'Administrar Perfiles', 'es', 'yum'),
('Manage Profiles', 'Gerer les profils', 'fr', 'yum'),
('Manage Profiles', 'Gestione profili', 'it', 'yum'),
('Manage Roles', 'Rollenverwaltung', 'de', 'yum'),
('Manage Roles', 'Administrar Roles', 'es', 'yum'),
('Manage Roles', 'Gestion des roles', 'fr', 'yum'),
('Manage Roles', 'Gestione Ruoli', 'it', 'yum'),
('Manage Roles', 'Zarzadzaj rolami', 'pl', 'yum'),
('Manage User', 'Benutzerverwaltung', 'de', 'yum'),
('Manage User', 'Administrar Usuario', 'es', 'yum'),
('Manage User', 'Gestion utilisateur', 'fr', 'yum'),
('Manage User', 'Gestione utente', 'it', 'yum'),
('Manage User', 'Benutzerverwaltung', 'pl', 'yum'),
('Manage User', 'Управление пользователями', 'ru', 'yum'),
('Manage Users', 'Benutzerverwaltung', 'de', 'yum'),
('Manage Users', 'Administrar Usuarios', 'es', 'yum'),
('Manage Users', 'Gestion des membres', 'fr', 'yum'),
('Manage Users', 'Gestione utenti', 'it', 'yum'),
('Manage field groups', 'Feldgruppen verwalten', 'de', 'yum'),
('Manage field groups', 'Administrar grupos de campos', 'es', 'yum'),
('Manage field groups', 'Gerer les champs des groupes', 'fr', 'yum'),
('Manage field groups', 'Gestione campo gruppi', 'it', 'yum'),
('Manage field groups', 'Zarzadzaj grupami pol', 'pl', 'yum'),
('Manage friends', 'Freundschaftsverwaltung', 'de', 'yum'),
('Manage friends', 'Administrar amigos', 'es', 'yum'),
('Manage friends', 'Gestion des contacts', 'fr', 'yum'),
('Manage friends', 'Gestione contatti', 'it', 'yum'),
('Manage my users', 'Meine Benutzer verwalten', 'de', 'yum'),
('Manage my users', 'Administrar mis usuarios', 'es', 'yum'),
('Manage my users', 'Gerer mes membres', 'fr', 'yum'),
('Manage my users', 'Gestione utenti', 'it', 'yum'),
('Manage my users', 'Zarzadzaj moimi uzytkownikami', 'pl', 'yum'),
('Manage payments', 'Zahlungsarten verwalten', 'de', 'yum'),
('Manage payments', 'Gesti', 'es', 'yum'),
('Manage payments', 'Gestione pagamenti', 'it', 'yum'),
('Manage permissions', 'Berechtigungen verwalten', 'de', 'yum'),
('Manage permissions', 'Administrar los permisos', 'es', 'yum'),
('Manage permissions', 'Gestione permessi', 'it', 'yum'),
('Manage profile Fields', 'Profilfelder verwalten', 'de', 'yum'),
('Manage profile Fields', 'Administrar Campos de Perfil', 'es', 'yum'),
('Manage profile Fields', 'Gerer les champs du profil', 'fr', 'yum'),
('Manage profile Fields', 'Gestione campi profilo', 'it', 'yum'),
('Manage profile Fields', 'Profilfelder verwalten', 'pl', 'yum'),
('Manage profile field groups', 'Administrar grupos de campos de perfiles', 'es', 'yum'),
('Manage profile field groups', 'Gerer les champs des profils de grouppes', 'fr', 'yum'),
('Manage profile field groups', 'Gestione campo profilo gruppi', 'it', 'yum'),
('Manage profile field groups', 'Zarzadzaj grupami pol w profilu', 'pl', 'yum'),
('Manage profile fields', 'Profilfelder verwalten', 'de', 'yum'),
('Manage profile fields', 'Gesti', 'es', 'yum'),
('Manage profile fields', 'Gerer les champs de profils', 'fr', 'yum'),
('Manage profile fields', 'Gestione campi profilo', 'it', 'yum'),
('Manage profile fields', 'Zarzadzaj polami profilu', 'pl', 'yum'),
('Manage profile fields groups', 'Gestione campi profilo gruppi', 'it', 'yum'),
('Manage profile fields groups', 'Zarzadzaj grupami pol w profilu', 'pl', 'yum'),
('Manage profiles', 'Profile verwalten', 'de', 'yum'),
('Manage profiles', 'Administrar perfiles', 'es', 'yum'),
('Manage profiles', 'Gerer les profils', 'fr', 'yum'),
('Manage profiles', 'Gestione profili', 'it', 'yum'),
('Manage profiles', 'Zarzadzaj profilem', 'pl', 'yum'),
('Manage roles', 'Rollen verwalten', 'de', 'yum'),
('Manage roles', 'Adminsitrar roles', 'es', 'yum'),
('Manage roles', 'Gerer les roles', 'fr', 'yum'),
('Manage roles', 'Gestione Ruoli', 'it', 'yum'),
('Manage roles', 'Zarzadzaj rolami', 'pl', 'yum'),
('Manage text settings', 'Texteinstellungen', 'de', 'yum'),
('Manage text settings', 'Administrar configuración de texto', 'es', 'yum'),
('Manage text settings', 'Option de texte', 'fr', 'yum'),
('Manage text settings', 'Impostazioni di testo', 'it', 'yum'),
('Manage this profile', 'dieses Profil bearbeiten', 'de', 'yum'),
('Manage this profile', 'Administrar este perfil', 'es', 'yum'),
('Manage this profile', 'Modifier ce profil', 'fr', 'yum'),
('Manage this profile', 'Modifica profilo', 'it', 'yum'),
('Manage this profile', 'Zarzadzaj tym profilem', 'pl', 'yum'),
('Manage user Groups', 'Benutzergruppen verwalten', 'de', 'yum'),
('Manage user Groups', 'Administrar Grupos de usuario', 'es', 'yum'),
('Manage user Groups', 'Gerer les utilisateurs des grouppes', 'fr', 'yum'),
('Manage user Groups', 'Gestine gruppi', 'it', 'yum'),
('Manage users', 'Benutzer verwalten', 'de', 'yum'),
('Manage users', 'Administrar usuarios', 'es', 'yum'),
('Manage users', 'Gerer les membres', 'fr', 'yum'),
('Manage users', 'Gestione utenti', 'it', 'yum'),
('Manage users', 'Zarzadzaj uzytkownikaki', 'pl', 'yum'),
('Mange Profile Field', 'Mange Profil Field', 'de', 'yum'),
('Mange Profile Field', 'Administrar Campo del Perfil', 'es', 'yum'),
('Mange Profile Field', 'Gestione campo profilo', 'it', 'yum'),
('Mark as read', 'Als gelesen markieren', 'de', 'yum'),
('Mark as read', 'Marcar como le', 'es', 'yum'),
('Mark as read', 'Marquer comme lu', 'fr', 'yum'),
('Mark as read', 'Segna come letto', 'it', 'yum'),
('Match', 'Treffer', 'de', 'yum'),
('Match', 'Combinar', 'es', 'yum'),
('Match', 'Resultat', 'fr', 'yum'),
('Match', 'Corrispondenza (RegExp)', 'it', 'yum'),
('Match', 'Совпадение (RegExp)', 'ru', 'yum'),
('Membership', 'Mitgliedschaft', 'de', 'yum'),
('Membership', 'Membres', 'es', 'yum'),
('Membership', 'Devenir membre', 'fr', 'yum'),
('Membership', 'Iscrizione', 'it', 'yum'),
('Membership ends at: {date}', 'Mitgliedschaft endet am: {date}', 'de', 'yum'),
('Membership ends at: {date}', 'Membres', 'es', 'yum'),
('Membership ends at: {date}', 'Iscrizione termina il: {date}', 'it', 'yum'),
('Membership has not been payed yet', 'Zahlungseingang noch nicht erfolgt', 'de', 'yum'),
('Membership has not been payed yet', 'La membres', 'es', 'yum'),
('Membership has not been payed yet', 'Iscrizione non pagata', 'it', 'yum'),
('Membership payed at: {date}', 'Zahlungseingang erfolgt am: {date}', 'de', 'yum'),
('Membership payed at: {date}', 'Membres', 'es', 'yum'),
('Membership payed at: {date}', 'Iscrizione pagata il: {date}', 'it', 'yum'),
('Memberships', 'Mitgliedschaften', 'de', 'yum'),
('Memberships', 'Membres', 'es', 'yum'),
('Memberships', 'Iscrizioni', 'it', 'yum'),
('Message', 'Nachricht', 'de', 'yum'),
('Message', 'Mensaje', 'es', 'yum'),
('Message', 'Message', 'fr', 'yum'),
('Message', 'Messaggio', 'it', 'yum'),
('Message "{message}" has been sent to {to}', 'Nachricht "{message}" wurde an {to} gesendet', 'de', 'yum'),
('Message "{message}" has been sent to {to}', 'Mensaje "{message}" ha sido enviada a {to}', 'es', 'yum'),
('Message "{message}" was marked as read', 'Nachricht "{message}" wurde als gelesen markiert.', 'de', 'yum'),
('Message "{message}" was marked as read', 'Mensaje "{message}" se ha marcado como le', 'es', 'yum'),
('Message &quot;{message}&quot; has been sent to {to}', 'Message "{message}" a ete envoye {to}', 'fr', 'yum'),
('Message &quot;{message}&quot; has been sent to {to}', 'Messaggio "{message}" e stato inviato a {to}', 'it', 'yum'),
('Message &quot;{message}&quot; was marked as read', 'Message "{message}" marquer comme lu.', 'fr', 'yum'),
('Message &quot;{message}&quot; was marked as read', 'Messaggio "{message}" e stato contrassegnato come letto.', 'it', 'yum'),
('Message count', 'Anzahl Nachrichten', 'de', 'yum'),
('Message count', 'Recuento de mensajes', 'es', 'yum'),
('Message from', 'Nachricht von', 'de', 'yum'),
('Message from', 'Mensaje del', 'es', 'yum'),
('Message from', 'Message de', 'fr', 'yum'),
('Message from', 'Messaggio da', 'it', 'yum'),
('Message from', 'Nachricht von', 'pl', 'yum'),
('Message from ', 'Nachricht von ', 'de', 'yum'),
('Message from ', 'Mensaje de', 'es', 'yum'),
('Messages', 'Nachrichten', 'de', 'yum'),
('Messages', 'Mensajes', 'es', 'yum'),
('Messages', 'Message', 'fr', 'yum'),
('Messages', 'Messagi', 'it', 'yum'),
('Messages', 'Wiadomosci', 'pl', 'yum'),
('Messaging system', 'Nachrichtensystem', 'de', 'yum'),
('Messaging system', 'Sistema de mensajes', 'es', 'yum'),
('Messaging system', 'Message-Board', 'fr', 'yum'),
('Messaging system', 'Sistema messaggistica', 'it', 'yum'),
('Messaging system', 'System wiadomosci', 'pl', 'yum'),
('Minimal password length 4 symbols.', 'Minimale Länge des Passworts 4 Zeichen.', 'de', 'yum'),
('Minimal password length 4 symbols.', 'Mínimo 4 caracteres para la contraseña', 'es', 'yum'),
('Minimal password length 4 symbols.', 'La longueur de votre mot de passe doit comporter au moins quatre characteres.', 'fr', 'yum'),
('Minimal password length 4 symbols.', 'Lunghezza minima password di 4 caratteri.', 'it', 'yum'),
('Minimal password length 4 symbols.', 'Minimale Lange des Passworts 4 Zeichen.', 'pl', 'yum'),
('Minimal password length 4 symbols.', 'Минимальная длина пароля 4 символа.', 'ru', 'yum'),
('Module settings', 'Moduleinstellungen', 'de', 'yum'),
('Module settings', 'Ajustes del módulo', 'es', 'yum'),
('Module settings', 'Reglage des modules', 'fr', 'yum'),
('Module settings', 'Opzioni modulo', 'it', 'yum'),
('Module settings', 'Ustawienia modulu', 'pl', 'yum'),
('Module text settings', 'Ajustes de texto del módulo', 'es', 'yum'),
('Module text settings', 'Opzioni testo modulo', 'it', 'yum'),
('Module text settings', 'Ustawienia tekstow modulu', 'pl', 'yum'),
('My Inbox', 'Posteingang', 'de', 'yum'),
('My Inbox', 'Mi bandeja de entrada', 'es', 'yum'),
('My Inbox', 'Boite e-mail', 'fr', 'yum'),
('My Inbox', 'Moja skrzynka odbiorcza', 'pl', 'yum'),
('My friends', 'Meine Kontakte', 'de', 'yum'),
('My friends', 'Mis amigos', 'es', 'yum'),
('My friends', 'Mes contact', 'fr', 'yum'),
('My friends', 'Contatti', 'it', 'yum'),
('My groups', 'Meine Gruppen', 'de', 'yum'),
('My groups', 'Mis grupos', 'es', 'yum'),
('My groups', 'Mes grouppes', 'fr', 'yum'),
('My groups', 'Gruppi', 'it', 'yum'),
('My inbox', 'Mein Posteingang', 'de', 'yum'),
('My inbox', 'Mi bandeja de entrada', 'es', 'yum'),
('My inbox', 'Ma boite e-mail', 'fr', 'yum'),
('My inbox', 'Posta in arrivo', 'it', 'yum'),
('My memberships', 'Meine Mitgliedschaften', 'de', 'yum'),
('My memberships', 'Mis membres', 'es', 'yum'),
('My memberships', 'Options de mon compte', 'fr', 'yum'),
('My memberships', 'Iscrizioni', 'it', 'yum'),
('My profile', 'Mein Profil', 'de', 'yum'),
('My profile', 'Mi perfil', 'es', 'yum'),
('My profile', 'Mon profil', 'fr', 'yum'),
('My profile', 'Profilo', 'it', 'yum'),
('New friendship request', 'nueva solicitud de amistad', 'es', 'yum'),
('New friendship request from {username}', 'neue Kontaktanfrage von {username}', 'de', 'yum'),
('New friendship request from {username}', 'Nueva solicitud de amistad de {username}', 'es', 'yum'),
('New friendship request from {username}', 'Nouvelle demande de contact de {username}', 'fr', 'yum'),
('New friendship request from {username}', 'Nuova richiesta di contatto da {username}', 'it', 'yum'),
('New friendship requests', 'Neue Freundschaftsanfragen', 'de', 'yum'),
('New friendship requests', 'Nueva solicitud de amistad', 'es', 'yum'),
('New friendship requests', 'Nouvelle demande de contact', 'fr', 'yum'),
('New friendship requests', 'Nuova richiesta contatto', 'it', 'yum'),
('New message from {from}: {subject}', 'Neue Nachricht von {from}: {subject}', 'de', 'yum'),
('New messages', 'Neue Nachrichten', 'de', 'yum'),
('New messages', 'Nuevos mensajes', 'es', 'yum'),
('New messages', 'Nouveaux messages', 'fr', 'yum'),
('New messages', 'Nuovo messaggio', 'it', 'yum'),
('New password', 'Neues Passwort', 'de', 'yum'),
('New password', 'Nueva contrase', 'es', 'yum'),
('New password', 'Nouveau mot de passe', 'fr', 'yum'),
('New password', 'Nuovo Password', 'it', 'yum'),
('New password is saved.', 'Neues Passwort wird gespeichert.', 'de', 'yum'),
('New password is saved.', 'La contraseña nueva ha sido guardada', 'es', 'yum'),
('New password is saved.', 'Votre nouveau mot de passe a bien ete memorise.', 'fr', 'yum'),
('New password is saved.', 'Nuova passowrd salvata', 'it', 'yum'),
('New password is saved.', 'Neues Passwort wird gespeichert.', 'pl', 'yum'),
('New password is saved.', 'Новый пароль сохранен.', 'ru', 'yum'),
('New profile comment', 'Nuevo comentario de perfil', 'es', 'yum'),
('New profile comment from {username}', 'Neuer Profilkommentar von {username}', 'de', 'yum'),
('New profile comment from {username}', 'Comentario nuevo tu perfil de {username}', 'es', 'yum'),
('New profile comment from {username}', 'Nouveau commentaire pour le profil de {username}', 'fr', 'yum'),
('New profile comment from {username}', 'Nuovo commento per il profilo {username}', 'it', 'yum'),
('New settings profile', 'Neues Einstellungsprofil', 'de', 'yum'),
('New settings profile', 'Nuevos ajustes de perfil', 'es', 'yum'),
('New settings profile', 'Nouvelle configuration de profil', 'fr', 'yum'),
('New settings profile', 'Nuova preferenze profilo', 'it', 'yum'),
('New settings profile', 'Nowe ustawienia profilu', 'pl', 'yum'),
('New translation', 'Neue Übersetzung', 'de', 'yum'),
('New translation', 'Nueva traducción', 'es', 'yum'),
('New value', 'Neuer Wert', 'de', 'yum'),
('New value', 'Valor nuevo', 'es', 'yum'),
('New value', 'Nouvelle valeur', 'fr', 'yum'),
('New value', 'Nuovo valore', 'it', 'yum'),
('New value', 'Nowa wartosc', 'pl', 'yum'),
('No', 'Nein', 'de', 'yum'),
('No', 'No', 'es', 'yum'),
('No', 'Non', 'fr', 'yum'),
('No', 'No', 'it', 'yum'),
('No', 'Nein', 'pl', 'yum'),
('No', 'Нет', 'ru', 'yum'),
('No friendship requested', 'Keine Freundschaft angefragt', 'de', 'yum'),
('No friendship requested', 'No hay solicitud de amistad', 'es', 'yum'),
('No friendship requested', 'Pas de demande de contact', 'fr', 'yum'),
('No friendship requested', 'Contatto non richiesto', 'it', 'yum'),
('No new messages', 'Keine neuen Nachrichten', 'de', 'yum'),
('No new messages', 'No hay mensajes nuevos', 'es', 'yum'),
('No new messages', 'Pas de nouveaux messages', 'fr', 'yum'),
('No new messages', 'Nessun nuovo messaggio', 'it', 'yum'),
('No profile changes were made', 'Keine Profiländerungen stattgefunden', 'de', 'yum'),
('No profile changes were made', 'No se hicieron cambios en el perfil', 'es', 'yum'),
('No profile changes were made', 'pas de resultat pour les profils modifies', 'fr', 'yum'),
('No profile changes were made', 'Nessun cambiamento al profilo', 'it', 'yum'),
('No profile changes were made', 'Nie dokonano zmian w profilu', 'pl', 'yum'),
('No, but show on registration form', 'Ja, und auf Registrierungsseite anzeigen', 'de', 'yum'),
('No, but show on registration form', 'No, pero mostrar en formulario de registro', 'es', 'yum'),
('No, but show on registration form', 'non et charger le formulaire d inscription', 'fr', 'yum'),
('No, but show on registration form', 'No, ma mostra nel form di registrazione', 'it', 'yum'),
('No, but show on registration form', 'Nie, ale pokaz w formularzu rejestracji', 'pl', 'yum'),
('No, but show on registration form', 'Нет, но показать при регистрации', 'ru', 'yum'),
('Nobody has commented your profile yet', 'Bisher hat niemand mein Profil kommentiert', 'de', 'yum'),
('Nobody has commented your profile yet', 'Nadie ha comentado el perfil a', 'es', 'yum'),
('Nobody has commented your profile yet', 'Aucun commentaire pour votre profil', 'fr', 'yum'),
('Nobody has commented your profile yet', 'Nessuno ha commentato il tuo profilo', 'it', 'yum'),
('Nobody has visited your profile yet', 'Bisher hat noch niemand ihr Profil angesehen', 'de', 'yum'),
('Nobody has visited your profile yet', 'Nadie ha visitado tu perfil todavía', 'es', 'yum'),
('Nobody has visited your profile yet', 'Aucune visite recente de votre profil.', 'fr', 'yum'),
('Nobody has visited your profile yet', 'Fino ad ora nessuno ha visto il tuo profilo', 'it', 'yum'),
('None', 'Keine', 'de', 'yum'),
('None', 'Ninguno', 'es', 'yum'),
('None', 'Aucun', 'fr', 'yum'),
('None', 'Nessuno', 'it', 'yum'),
('None', 'Zaden', 'pl', 'yum'),
('Not active', 'Nicht aktiv', 'de', 'yum'),
('Not active', 'Innactivo', 'es', 'yum'),
('Not active', 'Non actif', 'fr', 'yum'),
('Not active', 'Non attivo', 'it', 'yum'),
('Not active', 'Nicht aktiv', 'pl', 'yum'),
('Not active', 'Не активирован', 'ru', 'yum'),
('Not assigned', 'Nicht zugewiesen', 'de', 'yum'),
('Not assigned', 'No asignado', 'es', 'yum'),
('Not assigned', 'Non assigne', 'fr', 'yum'),
('Not assigned', 'Non assegnato', 'it', 'yum'),
('Not assigned', 'Nie przypisano', 'pl', 'yum'),
('Not visited', 'Non visitato', 'it', 'yum'),
('Not yet payed', 'Noch nicht bezahlt', 'de', 'yum'),
('Not yet payed', 'Todav', 'es', 'yum'),
('Ok', 'Ok', 'de', 'yum'),
('Ok', 'Aceptar', 'es', 'yum'),
('Ok', 'Ok', 'fr', 'yum'),
('Ok', 'Ok', 'it', 'yum'),
('Ok', 'Ok', 'pl', 'yum'),
('Ok', 'Ok', 'ru', 'yum'),
('Old value', 'Alter Wert', 'de', 'yum'),
('Old value', 'Valor antiguo', 'es', 'yum'),
('Old value', 'Ancienne valeur', 'fr', 'yum'),
('Old value', 'Vecchio valore', 'it', 'yum'),
('Old value', 'Stara wartosc', 'pl', 'yum'),
('One of the recipients ({username}) has ignored you. Message will not be sent!', 'Einer der gewählten Benutzer ({username}) hat Sie auf seiner Ignorier-Liste. Die Nachricht wird nicht gesendet!', 'de', 'yum'),
('One of the recipients ({username}) has ignored you. Message will not be sent!', 'Uno de los destinatarios ({username}) te ha ignorado. ¡No se enviará el mensaje!', 'es', 'yum'),
('One of the recipients ({username}) has ignored you. Message will not be sent!', 'Un des membres selectionne vous a mis sur sa liste noire ({username}). Ce message ne sera pas envoye!', 'fr', 'yum'),
('One of the recipients ({username}) has ignored you. Message will not be sent!', 'Un destinatario ({username}) ti ha inserito nella lista degli ignorati. Messaggio non inviato!', 'it', 'yum'),
('Only owner', 'Nur Besitzer', 'de', 'yum'),
('Only owner', 'Sólo el dueño', 'es', 'yum'),
('Only owner', 'Proprietaire seulement', 'fr', 'yum'),
('Only owner', 'Solo proprietario', 'it', 'yum'),
('Only owner', 'Только владелец', 'ru', 'yum'),
('Only your friends are shown here', 'Nur ihre Kontakte werden hier angezeigt', 'de', 'yum'),
('Only your friends are shown here', 'S', 'es', 'yum'),
('Only your friends are shown here', 'Seuls vos contacts seront visibles ici', 'fr', 'yum'),
('Only your friends are shown here', 'Solo i tuoi contatti verranno visualizzati', 'it', 'yum'),
('Order confirmed', 'Bestellbestätigung', 'de', 'yum'),
('Order confirmed', 'Orden confirmada', 'es', 'yum'),
('Order confirmed', 'Ordini confermati', 'it', 'yum'),
('Order date', 'Bestelldatum', 'de', 'yum'),
('Order date', 'Fecha de pedido', 'es', 'yum'),
('Order date', 'Data ordine', 'it', 'yum'),
('Order membership', 'Mitgliedschaft bestellen', 'de', 'yum'),
('Order membership', 'Pedido de miembro', 'es', 'yum'),
('Order membership', 'Ordine iscrizione', 'it', 'yum'),
('Order number', 'Bestellnummer', 'de', 'yum'),
('Order number', 'N', 'es', 'yum'),
('Order number', 'Numero ordine', 'it', 'yum'),
('Ordered at', 'Bestellt am', 'de', 'yum'),
('Ordered at', 'Pedido en', 'es', 'yum'),
('Ordered at', 'Ordinato il', 'it', 'yum'),
('Ordered memberships', 'Bestellte Mitgliedschaften', 'de', 'yum'),
('Ordered memberships', 'Pedido de membres', 'es', 'yum'),
('Ordered memberships', 'Options complementaires', 'fr', 'yum'),
('Ordered memberships', 'Iscrizioni ordinate', 'it', 'yum'),
('Other', 'Verschiedenes', 'de', 'yum'),
('Other', 'Otro', 'es', 'yum'),
('Other', 'Divers', 'fr', 'yum'),
('Other', 'Altro', 'it', 'yum'),
('Other', 'Pozostale', 'pl', 'yum'),
('Other Validator', 'Otro validador', 'es', 'yum'),
('Other Validator', 'Autre validation', 'fr', 'yum'),
('Other Validator', 'Altro validatore', 'it', 'yum'),
('Other Validator', 'Другой валидатор', 'ru', 'yum'),
('Participant count', 'Anzahl Teilnehmer', 'de', 'yum'),
('Participant count', 'N', 'es', 'yum'),
('Participants', 'Teilnehmer', 'de', 'yum'),
('Participants', 'Participantes', 'es', 'yum'),
('Participants', 'Partecipanti', 'it', 'yum'),
('Password', 'Passwort', 'de', 'yum'),
('Password', 'Contraseña', 'es', 'yum'),
('Password', 'Passwort', 'fr', 'yum'),
('Password', 'Password', 'it', 'yum'),
('Password', 'Haslo', 'pl', 'yum'),
('Password Expiration Time', 'Ablaufzeit von Passwörtern', 'de', 'yum'),
('Password Expiration Time', 'Tiempo de expiración de la contraseña', 'es', 'yum'),
('Password Expiration Time', 'Duree de vie des mot de passe', 'fr', 'yum'),
('Password Expiration Time', 'Scadenza password', 'it', 'yum'),
('Password Expiration Time', 'Czas waznosci hasla', 'pl', 'yum'),
('Password is incorrect.', 'Passwort ist falsch.', 'de', 'yum'),
('Password is incorrect.', 'Contraseña incorrecta', 'es', 'yum'),
('Password is incorrect.', 'Le mot de passe est incorrect.', 'fr', 'yum'),
('Password is incorrect.', 'Password incorretta', 'it', 'yum'),
('Password is incorrect.', 'Niepoprawne haslo.', 'pl', 'yum'),
('Password is incorrect.', 'Неверный пароль.', 'ru', 'yum'),
('Password recovery', 'Passwort wiederherstellen', 'de', 'yum'),
('Password recovery', 'Recuperación de contraseña', 'es', 'yum'),
('Passwords do not match', 'Las contraseñas no coinciden', 'es', 'yum'),
('Payment', 'Zahlungsmethode', 'de', 'yum'),
('Payment', 'Pago', 'es', 'yum'),
('Payment', 'Pagamento', 'it', 'yum'),
('Payment arrived', 'Zahlungseingang bestätigt', 'de', 'yum'),
('Payment arrived', 'El pago lleg', 'es', 'yum'),
('Payment arrived', 'Pagamento arrivato', 'it', 'yum'),
('Payment date', 'Bezahlt am', 'de', 'yum'),
('Payment date', 'Fecha de pago', 'es', 'yum'),
('Payment date', 'Data pagamento', 'it', 'yum'),
('Payment type', 'Zahlungstyp', 'de', 'yum'),
('Payment types', 'Zahlungsarten', 'de', 'yum'),
('Payment types', 'Formas de pago', 'es', 'yum'),
('Payment types', 'Options de paiement', 'fr', 'yum'),
('Payment types', 'Tipi pagamento', 'it', 'yum'),
('Payments', 'Zahlungsarten', 'de', 'yum'),
('Payments', 'Pagos', 'es', 'yum'),
('Payments', 'Pagamenti', 'it', 'yum'),
('Permissions', 'Berechtigungen', 'de', 'yum'),
('Permissions', 'Permisos', 'es', 'yum'),
('Permissions', 'Permissions', 'fr', 'yum'),
('Permissions', 'Autorizzazioni', 'it', 'yum'),
('Please activate you account go to {activation_url}', 'Perfavore attiva il tuo accounto all''indirizzo {activation_url}', 'it', 'yum'),
('Please check your email. An instructions was sent to your email address.', 'Bitte überprüfen Sie Ihre E-Mails. Eine Anleitung wurde an Ihre E-Mail-Adresse geschickt.', 'de', 'yum'),
('Please check your email. An instructions was sent to your email address.', 'Por favor verifica tu e-mail a donde se han enviado más instrucciones.', 'es', 'yum'),
('Please check your email. An instructions was sent to your email address.', 'Controlez votre boite e-mail, d autres instructions vous ont ete envoyees par e-mail. *IMPORTANT:pour le cas ou notre e-mail ne vous serais pas parvenu, il est possible que notre e-mail ai ete filtre par votre fournisseur  d acces internet et plac?', 'fr', 'yum'),
('Please check your email. An instructions was sent to your email address.', 'Perfavore controlla la tua email con le istruzioni che ti abbiamo inviato', 'it', 'yum'),
('Please check your email. An instructions was sent to your email address.', 'Bitte uberprufen Sie Ihre E-Mails. Eine Anleitung wurde an Ihre E-Mail-Adresse geschickt.', 'pl', 'yum'),
('Please check your email. An instructions was sent to your email address.', 'На Ваш адрес электронной почты было отправлено письмо с инструкциями.', 'ru', 'yum'),
('Please check your email. Instructions have been sent to your email address.', 'Bitte schauen Sie in Ihr Postfach. Weitere Anweisungen wurden per E-Mail geschickt.', 'de', 'yum'),
('Please check your email. Instructions have been sent to your email address.', 'Por favor revisa tu e-mail. Hemos enviado intrusiones a tu dirección de e-mail.', 'es', 'yum'),
('Please check your email. Instructions have been sent to your email address.', 'Controlez votre boite e-mail. D autres instructions vous ont ete envoyees par e-mail. *IMPORTANT:pour le cas ou notre e-mail ne vous serais pas parvenu, il est possible que notre e-mail ai ete filtre par votre fournisseur  d acces internet et plac?', 'fr', 'yum'),
('Please check your email. Instructions have been sent to your email address.', 'Si prega di controllare la casella di posta. Ulteriori istruzioni sono state inviate via e-mail.', 'it', 'yum'),
('Please check your email. Instructions have been sent to your email address.', 'Prosze sprawdz Twoj mejl. Instrukcje zostaly wyslane na Twoj adres mejlowy.', 'pl', 'yum'),
('Please enter a request Message up to 255 characters', 'Bitte geben Sie eine Nachricht bis zu 255 Zeichen an, die dem Benutzer bei der Kontaktanfrage mitgegeben wird', 'de', 'yum'),
('Please enter a request Message up to 255 characters', 'Por favor escribe un mensaje no mayor a 255 caracteres', 'es', 'yum'),
('Please enter a request Message up to 255 characters', 'Vous pouvez ajouter un message personalise de 255 characteres a votre demande de contact', 'fr', 'yum'),
('Please enter a request Message up to 255 characters', 'Perfavore inserisci un messaggio di richiesta di massimo 255 caratteri', 'it', 'yum'),
('Please enter the letters as they are shown in the image above.', 'Bitte geben Sie die, oben im Bild angezeigten, Buchstaben ein.', 'de', 'yum'),
('Please enter the letters as they are shown in the image above.', 'Por favor escribe las letras que se muestran en la imagen.', 'es', 'yum'),
('Please enter the letters as they are shown in the image above.', 'Recopiez les characteres apparaissant dans l image au dessus.', 'fr', 'yum'),
('Please enter the letters as they are shown in the image above.', 'Perfavore inserire le lettere mostrate nella seguente immagine.', 'it', 'yum'),
('Please enter the letters as they are shown in the image above.', 'Bitte geben Sie die, oben im Bild angezeigten, Buchstaben ein.', 'pl', 'yum'),
('Please enter the letters as they are shown in the image above.', 'Пожалуйста, введите буквы, показанные на картинке выше.', 'ru', 'yum'),
('Please enter your login or email addres.', 'Perfavore inserisci il tuo username o l''indirizzo mail.', 'it', 'yum'),
('Please enter your login or email addres.', 'Пожалуйста, введите Ваш логин или адрес электронной почты.', 'ru', 'yum'),
('Please enter your login or email address.', 'Bitte geben Sie Ihren Benutzernamen oder E-Mail-Adresse ein.', 'de', 'yum'),
('Please enter your login or email address.', 'Por favor escribe tu nombre de usuario o dirección de e-mail.', 'es', 'yum'),
('Please enter your login or email address.', 'Indiquez dans ce champ, votre nom d utilisateur ou votre adresse e-mail.', 'fr', 'yum'),
('Please enter your login or email address.', 'Inserisci il tuo nome utente o indirizzo e-mail.', 'it', 'yum'),
('Please enter your login or email address.', 'Bitte geben Sie Ihren Benutzernamen oder E-Mail-Adresse ein.', 'pl', 'yum'),
('Please enter your password to confirm deletion:', 'Bitte geben Sie Ihr Passwort ein, um den Löschvorgang zu bestätigen:', 'de', 'yum'),
('Please enter your password to confirm deletion:', 'Por favor escribe tu contraseña para confirmar la eliminación:', 'es', 'yum'),
('Please enter your password to confirm deletion:', 'Renseignez votre mot de passe, pour confirmer la suppression:', 'fr', 'yum'),
('Please enter your password to confirm deletion:', 'Si prega di inserire la password per confermare l''eliminazione:', 'it', 'yum'),
('Please enter your password to confirm deletion:', 'Prosze wprowadz swoje haslo w celu potwierdzenia usuwania:', 'pl', 'yum'),
('Please enter your user name or email address.', 'Bitte geben Sie Ihren Benutzernamen oder E-mail Adresse ein', 'de', 'yum'),
('Please enter your user name or email address.', 'Por favor, ingrese su nombre de usuario o direcci', 'es', 'yum'),
('Please enter your user name or email address.', 'Renseignez votre nom d utilisateur ou votre adresse e-mail', 'fr', 'yum'),
('Please enter your user name or email address.', 'Inserisci il tuo nome utente o indirizzo e-mail', 'it', 'yum'),
('Please fill out the following form with your login credentials:', 'Bitte geben Sie ihre Login-Daten ein:', 'de', 'yum'),
('Please fill out the following form with your login credentials:', 'Por favor llena el formulario con tu información de inicio de sesión:', 'es', 'yum'),
('Please fill out the following form with your login credentials:', 'Entrez dans le champ vos donnees de connection:', 'fr', 'yum'),
('Please fill out the following form with your login credentials:', 'Perfavore inserisci le tue credenziali d''accesso:', 'it', 'yum'),
('Please fill out the following form with your login credentials:', 'Bitte geben Sie ihre Login-Daten ein:', 'pl', 'yum'),
('Please fill out the following form with your login credentials:', 'Пожалуйста, заполните следующую форму с вашими Логин и паролем:', 'ru', 'yum'),
('Please log in into the application.', 'Por favor, entra a la aplicación', 'es', 'yum'),
('Please verify your E-Mail address', 'Por favor verifica tu dirección de correo', 'es', 'yum'),
('Position', 'Position', 'de', 'yum'),
('Position', 'Posición', 'es', 'yum'),
('Position', 'Position', 'fr', 'yum'),
('Position', 'Posizioe', 'it', 'yum'),
('Position', 'Позиция', 'ru', 'yum'),
('Predefined values (example: 1, 2, 3, 4, 5;).', 'Vordefinierter Bereich (z.B. 1, 2, 3, 4, 5),', 'de', 'yum'),
('Predefined values (example: 1, 2, 3, 4, 5;).', 'Valores predefinidos (ejemplo: 1,2,3,4,5;).', 'es', 'yum'),
('Predefined values (example: 1, 2, 3, 4, 5;).', 'Valeur predefinie (z.B. 1, 2, 3, 4, 5),', 'fr', 'yum'),
('Predefined values (example: 1, 2, 3, 4, 5;).', 'Valori predefiniti (es. 1, 2, 3, 4, 5),', 'it', 'yum'),
('Predefined values (example: 1, 2, 3, 4, 5;).', 'Предопределенные значения (пример: 1;2;3;4;5;).', 'ru', 'yum'),
('Preseve Profiles', 'Profile aufbewahren', 'de', 'yum'),
('Preseve Profiles', 'Preservar Perfiles', 'es', 'yum'),
('Preseve Profiles', 'Profile aufbewahren ???', 'fr', 'yum'),
('Preseve Profiles', 'Mantieni profili', 'it', 'yum'),
('Preseve Profiles', 'Zachowaj profil', 'pl', 'yum'),
('Price', 'Preis', 'de', 'yum'),
('Price', 'Precio', 'es', 'yum'),
('Price', 'Prix', 'fr', 'yum'),
('Price', 'Prezzo', 'it', 'yum'),
('Privacy', 'Privatsphäre', 'de', 'yum'),
('Privacy', 'Privacidad', 'es', 'yum'),
('Privacy', 'Donnees privees', 'fr', 'yum'),
('Privacy', 'Privacy', 'it', 'yum'),
('Privacy', 'Privatsphare', 'pl', 'yum'),
('Privacy settings', 'Privatsphäre', 'de', 'yum'),
('Privacy settings', 'Configuración de Privacidad', 'es', 'yum'),
('Privacy settings', 'Vos donnees personnelles', 'fr', 'yum'),
('Privacy settings', 'Privacy', 'it', 'yum'),
('Privacy settings for {username}', 'Privatsphäreneinstellungen für {username}', 'de', 'yum'),
('Privacy settings for {username}', 'Configuración de Privacidad para {username}', 'es', 'yum'),
('Privacy settings for {username}', 'Configuration des donnees privees pour {username}', 'fr', 'yum'),
('Privacy settings for {username}', 'Opzioni Privacy per {username}', 'it', 'yum'),
('Privacysettings', 'Privatsphäre', 'de', 'yum'),
('Privacysettings', 'Configuración de Privacidad', 'es', 'yum'),
('Privacysettings', 'Donnees privees', 'fr', 'yum'),
('Privacysettings', 'Opzioni privacy', 'it', 'yum'),
('Profile', 'Profil', 'de', 'yum'),
('Profile', 'Perfil', 'es', 'yum'),
('Profile', 'Profil', 'fr', 'yum'),
('Profile', 'Profilo', 'it', 'yum'),
('Profile', 'Profil', 'pl', 'yum'),
('Profile', 'Профиль', 'ru', 'yum'),
('Profile Comments', 'Pinnwand', 'de', 'yum'),
('Profile Comments', 'COmentarios de perfil', 'es', 'yum'),
('Profile Comments', 'Pinnwand', 'fr', 'yum'),
('Profile Comments', 'Commenti profilo', 'it', 'yum'),
('Profile Fields', 'Profilfelder', 'de', 'yum'),
('Profile Fields', 'Campos de Perfil', 'es', 'yum'),
('Profile Fields', 'Champs des profils', 'fr', 'yum'),
('Profile Fields', 'Campi profilo', 'it', 'yum'),
('Profile Fields', 'Pola profilu', 'pl', 'yum'),
('Profile Fields', 'Поля профиля', 'ru', 'yum'),
('Profile field groups', 'Profilfeldgruppen', 'de', 'yum'),
('Profile field groups', 'Grupos de campos de perfil', 'es', 'yum'),
('Profile field groups', 'Champs des profils de groupes.', 'fr', 'yum'),
('Profile field groups', 'Campo profilo gruppi', 'it', 'yum'),
('Profile field public options', 'Einstellungen der Profilfelder', 'de', 'yum'),
('Profile field public options', 'Opciones de campo de perfil p', 'es', 'yum'),
('Profile field public options', 'Configuration des champs publique du profil', 'fr', 'yum'),
('Profile field public options', 'Opzioni pubbliche campi profilo', 'it', 'yum'),
('Profile field {fieldname}', 'Profilfeld {fieldname}', 'de', 'yum'),
('Profile field {fieldname}', 'Campo de perfil {fieldname}', 'es', 'yum'),
('Profile field {fieldname}', 'Camp de profil {fieldname}', 'fr', 'yum'),
('Profile field {fieldname}', '{fieldname} campo profilo', 'it', 'yum'),
('Profile field {fieldname}', 'Pole profilu {fieldname}', 'pl', 'yum'),
('Profile fields', 'Profilfeldverwaltung', 'de', 'yum'),
('Profile fields', 'Campos de perfil', 'es', 'yum'),
('Profile fields', 'Gestion des champs de profils', 'fr', 'yum'),
('Profile fields', 'Campi profilo', 'it', 'yum'),
('Profile fields', 'Pole profilu', 'pl', 'yum'),
('Profile fields groups', 'Profilfeldgruppen', 'de', 'yum'),
('Profile fields groups', 'Grupos de campos de perfil', 'es', 'yum'),
('Profile fields groups', 'Champ des profils de groupes', 'fr', 'yum'),
('Profile fields groups', 'Campi profilo gruppi', 'it', 'yum'),
('Profile fields groups', 'Grupy pol w profilu', 'pl', 'yum'),
('Profile history', 'Profilverlauf', 'de', 'yum'),
('Profile history', 'Historial del perfil', 'es', 'yum'),
('Profile history', 'Chronique du profil', 'fr', 'yum'),
('Profile history', 'Storico profilo', 'it', 'yum'),
('Profile history', 'Historia profilu', 'pl', 'yum'),
('Profile number', 'Profilnummer: ', 'de', 'yum'),
('Profile number', 'Número de perfil', 'es', 'yum'),
('Profile number', 'Numero du profil:', 'fr', 'yum'),
('Profile number', 'Numero profilo:', 'it', 'yum'),
('Profile number', 'Numer profilu:', 'pl', 'yum'),
('Profile of', 'Profil de', 'fr', 'yum'),
('Profile of', 'Profilo di', 'it', 'yum'),
('Profile of ', 'Profil von ', 'de', 'yum'),
('Profile of ', 'Perfil de', 'es', 'yum'),
('Profile visits', 'Profilbesuche', 'de', 'yum'),
('Profile visits', 'Visitas del perfil', 'es', 'yum'),
('Profile visits', 'Visiteurs de mon profil', 'fr', 'yum'),
('Profile visits', 'Visite profilo', 'it', 'yum'),
('Profiles', 'Profile', 'de', 'yum'),
('Profiles', 'Perfiles', 'es', 'yum'),
('Profiles', 'Profiles', 'fr', 'yum'),
('Profiles', 'Profili', 'it', 'yum'),
('Profiles', 'Profile', 'pl', 'yum'),
('Range', 'Bereich', 'de', 'yum'),
('Range', 'Rango', 'es', 'yum'),
('Range', 'Intervallo', 'it', 'yum'),
('Range', 'Ряд значений', 'ru', 'yum'),
('Read Only Profiles', 'Nur-Lese Profile', 'de', 'yum'),
('Read Only Profiles', 'Perfiles de Sólo Lectura', 'es', 'yum'),
('Read Only Profiles', 'Lecture seule des profil', 'fr', 'yum'),
('Read Only Profiles', 'Profilo sola lettura', 'it', 'yum'),
('Read Only Profiles', 'Profile tylko do odczytu', 'pl', 'yum'),
('Receive a Email for new Friendship request', 'E-Mail Benachrichtigung bei neuer Kontaktanfrage', 'de', 'yum'),
('Receive a Email for new Friendship request', 'Recibir un correo cuando recibas una nueva solicitud de amistad', 'es', 'yum'),
('Receive a Email for new Friendship request', 'Informez moi par e-mail pour les nouvelles demandes de contact.', 'fr', 'yum'),
('Receive a Email for new Friendship request', 'Email di notifica per nuovo contatto', 'it', 'yum'),
('Receive a Email when a new profile comment was made', 'E-Mail Benachrichtigung bei Profilkommentar', 'de', 'yum'),
('Receive a Email when a new profile comment was made', 'Recibir un correo cuando comenten en tu perfil', 'es', 'yum'),
('Receive a Email when a new profile comment was made', 'Informez moi par e-mail e-mail pour les nouveaux commentaire de mon profil', 'fr', 'yum'),
('Receive a Email when a new profile comment was made', 'Email di notifica per nuovo commento al profilo', 'it', 'yum'),
('Receive a Email when new Message arrives', 'E-Mail Benachrichtigung bei neuer interner Nachricht', 'de', 'yum'),
('Receive a Email when new Message arrives', 'Recibir un correo cuanto te llegue un nuevo mensaje', 'es', 'yum'),
('Receive a Email when new Message arrives', 'Informez moi par e-mail pour les nouveaux messages.', 'fr', 'yum'),
('Receive a Email when new Message arrives', 'Email di notifica per i nuovi messaggi', 'it', 'yum'),
('Registered users', 'Registrierte Benutzer', 'de', 'yum'),
('Registered users', 'Usuarios registrados', 'es', 'yum'),
('Registered users', 'Membre enregistre', 'fr', 'yum'),
('Registered users', 'Utenti registrati', 'it', 'yum'),
('Registered users', 'Зарегистрированные пользователи', 'ru', 'yum'),
('Registration', 'Registrierung', 'de', 'yum'),
('Registration', 'Registro', 'es', 'yum'),
('Registration', 'Inscription', 'fr', 'yum'),
('Registration', 'Reistrazione', 'it', 'yum'),
('Registration', 'Rejestracja', 'pl', 'yum'),
('Registration', 'Регистрация', 'ru', 'yum'),
('Registration date', 'Anmeldedatum', 'de', 'yum'),
('Registration date', 'Fecha de registro', 'es', 'yum'),
('Registration date', 'Date d inscription', 'fr', 'yum'),
('Registration date', 'Data registrazione', 'it', 'yum'),
('Registration date', 'Anmeldedatum', 'pl', 'yum'),
('Registration date', 'Дата регистрации', 'ru', 'yum'),
('Regular expression (example: "/^[A-Za-z0-9s,]+$/u").', 'Expresión regular (ejemplo: "/^[A-Za-z0-9s,]+$/u")', 'es', 'yum'),
('Regular expression (example: ''/^[A-Za-z0-9s,]+$/u'').', 'Regulärer Ausdruck (z. B.: ''/^[A-Za-z0-9s,]+$/u'')', 'de', 'yum'),
('Regular expression (example:''/^[A-Za-z0-9s,]+$/u'').', 'Expression regulaire (exemple.:''/^[A-Za-z0-9s,]+$/u'')', 'fr', 'yum'),
('Regular expression (example:''/^[A-Za-z0-9s,]+$/u'').', 'Espressione regolare (esempio:''/^[A-Za-z0-9s,]+$/u'')', 'it', 'yum'),
('Regular expression (example:''/^[A-Za-z0-9s,]+$/u'').', 'Регулярные выражения (пример:''/^[A-Za-z0-9s,]+$/u'')', 'ru', 'yum'),
('Remember me net time', 'Zapamietaj mnie nastepnym razem', 'pl', 'yum'),
('Remember me next time', 'Angemeldet bleiben', 'de', 'yum'),
('Remember me next time', 'Recordarme la próxima vez', 'es', 'yum'),
('Remember me next time', 'Rester connecte', 'fr', 'yum'),
('Remember me next time', 'Ricordami', 'it', 'yum'),
('Remember me next time', 'Запомнить меня', 'ru', 'yum'),
('Remove', 'Entfernen', 'de', 'yum'),
('Remove', 'Quitar', 'es', 'yum'),
('Remove', 'Supprimer', 'fr', 'yum'),
('Remove', 'Rimuovi', 'it', 'yum'),
('Remove Avatar', 'Profilbild entfernen', 'de', 'yum'),
('Remove Avatar', 'Borrar este Avatar', 'es', 'yum'),
('Remove Avatar', 'Supprimer l image de profil', 'fr', 'yum'),
('Remove Avatar', 'Rimuovi avatar', 'it', 'yum'),
('Remove comment', 'Kommentar entfernen', 'de', 'yum'),
('Remove comment', 'Borrar comentario', 'es', 'yum'),
('Remove comment', 'Supprimer ce commentaire', 'fr', 'yum'),
('Remove comment', 'Rimuovi commento', 'it', 'yum'),
('Remove friend', 'Freundschaft kündigen', 'de', 'yum'),
('Remove friend', 'Borrar amigo', 'es', 'yum'),
('Remove friend', 'Supprimer ce contact de ma liste', 'fr', 'yum'),
('Remove friend', 'Rimuovi contatto', 'it', 'yum'),
('Reply', 'Antwort', 'de', 'yum'),
('Reply', 'Responder', 'es', 'yum'),
('Reply', 'Repondre', 'fr', 'yum'),
('Reply', 'Rispondi', 'it', 'yum'),
('Reply', 'Odpowiedz', 'pl', 'yum'),
('Reply to Message', 'auf diese Nachricht antworten', 'de', 'yum'),
('Reply to Message', 'Responder al Mensaje', 'es', 'yum'),
('Reply to Message', 'Repondre a ce message', 'fr', 'yum'),
('Reply to Message', 'Rispondi al messaggio', 'it', 'yum'),
('Reply to Message', 'Odpowiedz', 'pl', 'yum'),
('Reply to message', 'Responder al mensaje', 'es', 'yum'),
('Reply to message', 'Rispondi al messaggio', 'it', 'yum'),
('Request friendship for user {username}', 'Kontaktanfrage für {username}', 'de', 'yum'),
('Request friendship for user {username}', 'Solicitar amistar al usuario {username}', 'es', 'yum'),
('Request friendship for user {username}', 'Demande de contact pour {username}', 'fr', 'yum'),
('Request friendship for user {username}', 'Richiesta contatto per {username}', 'it', 'yum'),
('Required', 'Benötigt', 'de', 'yum'),
('Required', 'Requerido', 'es', 'yum'),
('Required', 'Recquis', 'fr', 'yum'),
('Required', 'Obbligatorio', 'it', 'yum'),
('Required', 'Обязательность', 'ru', 'yum'),
('Required field (form validator).', 'Campo obbligatorio (validazione form).', 'it', 'yum'),
('Required field (form validator).', 'Обязательное поле (проверка формы).', 'ru', 'yum'),
('Restore', 'Wiederherstellen', 'de', 'yum'),
('Restore', 'Recuperar', 'es', 'yum'),
('Restore', 'Restaurer', 'fr', 'yum'),
('Restore', 'Ripristino', 'it', 'yum'),
('Restore', 'Wiederherstellen', 'pl', 'yum'),
('Restore', 'Восстановить', 'ru', 'yum'),
('Retype Password', 'Повторите пароль', 'ru', 'yum'),
('Retype Password is incorrect.', 'Пароли не совпадают.', 'ru', 'yum'),
('Retype password', 'Passwort wiederholen', 'de', 'yum'),
('Retype password', 'Repite la contraseña', 'es', 'yum'),
('Retype password', 'Redonnez votre mot de passe', 'fr', 'yum'),
('Retype password', 'Conferma password', 'it', 'yum'),
('Retype password', 'Passwort wiederholen', 'pl', 'yum'),
('Retype password is incorrect.', 'Wiederholtes Passwort ist falsch.', 'de', 'yum'),
('Retype password is incorrect.', 'Contraseña repetida incorrecta', 'es', 'yum'),
('Retype password is incorrect.', 'Le mot de passe est a nouveau incorrect.', 'fr', 'yum'),
('Retype password is incorrect.', 'Conferma password e errata.', 'it', 'yum'),
('Retype password is incorrect.', 'Wiederholtes Passwort ist falsch.', 'pl', 'yum'),
('Retype your new password', 'Wiederholen Sie Ihr neues Passwort', 'de', 'yum'),
('Retype your new password', 'Vuelva a escribir su nueva contrase', 'es', 'yum'),
('Retype your new password', 'Confirmez votre nouveau mot de passe', 'fr', 'yum'),
('Retype your new password', 'Confermare la nuova password', 'it', 'yum'),
('Retyped password is incorrect', 'Wiederholtes Passwort ist nicht identisch', 'de', 'yum'),
('Retyped password is incorrect', 'La contrase', 'es', 'yum'),
('Retyped password is incorrect', 'Le mot de passe renseigne n est pas identique au precedent', 'fr', 'yum'),
('Retyped password is incorrect', 'Password di conferma non identica', 'it', 'yum'),
('Role Administration', 'Rollenverwaltung', 'de', 'yum'),
('Role Administration', 'Administración de rol', 'es', 'yum'),
('Role Administration', 'Gestion des roles', 'fr', 'yum'),
('Role Administration', 'Gestione dei ruoli', 'it', 'yum'),
('Role Administration', 'Zarzadzanie rolami', 'pl', 'yum'),
('Roles', 'Rollen', 'de', 'yum'),
('Roles', 'Roles', 'es', 'yum'),
('Roles', 'Roles', 'fr', 'yum'),
('Roles', 'Ruoli', 'it', 'yum'),
('Roles', 'Role', 'pl', 'yum'),
('Roles / Access control', 'Rollen / Zugangskontrolle', 'de', 'yum'),
('Roles / Access control', 'Funciones y de control de acceso', 'es', 'yum'),
('Save', 'Sichern', 'de', 'yum'),
('Save', 'Guardar', 'es', 'yum'),
('Save', 'Memoriser', 'fr', 'yum'),
('Save', 'Salva', 'it', 'yum'),
('Save', 'Sichern', 'pl', 'yum'),
('Save', 'Сохранить', 'ru', 'yum'),
('Save payment type', 'Zahlungsart speichern', 'de', 'yum'),
('Save payment type', 'Guardar el tipo de pago', 'es', 'yum'),
('Save payment type', 'Salva tipo pagamento', 'it', 'yum'),
('Save profile changes', 'Profiländerungen speichern', 'de', 'yum'),
('Save profile changes', 'Guardar los cambios de perfil', 'es', 'yum');
INSERT INTO `translation` (`message`, `translation`, `language`, `category`) VALUES
('Save profile changes', 'Salva modifiche profilo', 'it', 'yum'),
('Save role', 'Rolle speichern', 'de', 'yum'),
('Save role', 'Guardar funci', 'es', 'yum'),
('Save role', 'Memoriser ce role', 'fr', 'yum'),
('Save role', 'Salva ruolo', 'it', 'yum'),
('Search for username', 'Suche nach Benutzer', 'de', 'yum'),
('Search for username', 'B', 'es', 'yum'),
('Search for username', 'Recherche par nom d''utilisateur', 'fr', 'yum'),
('Search for username', 'Cerca per username', 'it', 'yum'),
('Searchable', 'Suchbar', 'de', 'yum'),
('Searchable', 'Investigable', 'es', 'yum'),
('Searchable', 'visible', 'fr', 'yum'),
('Searchable', 'Ricercabile', 'it', 'yum'),
('Select a month', 'Monatsauswahl', 'de', 'yum'),
('Select a month', 'Seleccione un mes', 'es', 'yum'),
('Select a month', 'Seleziona un mese', 'it', 'yum'),
('Select multiple recipients by holding the CTRL key', 'Wählen Sie mehrere Empfänger mit der STRG-Taste aus', 'de', 'yum'),
('Select multiple recipients by holding the CTRL key', 'Selecciona varios destinatarios manteniendo presionada la tecla CTRL', 'es', 'yum'),
('Select multiple recipients by holding the CTRL key', 'Choix multiple en laissant la touche STRG de votre clavier enfoncee', 'fr', 'yum'),
('Select multiple recipients by holding the CTRL key', 'Seleziona destinatari multipli con il tasto CTRL', 'it', 'yum'),
('Select the fields that should be public', 'Diese Felder sind öffentlich einsehbar', 'de', 'yum'),
('Select the fields that should be public', 'Seleccione los campos que deben ser p', 'es', 'yum'),
('Select the fields that should be public', 'Ces champs sont publiques et seront visibles', 'fr', 'yum'),
('Select the fields that should be public', 'Scegli i campi da rendere publici', 'it', 'yum'),
('Selectable on registration', 'Während der Registrierung wählbar', 'de', 'yum'),
('Selectable on registration', 'Seleccionable en el registro', 'es', 'yum'),
('Selectable on registration', 'Option a selectionner au cours de l inscription', 'fr', 'yum'),
('Selectable on registration', 'Selezionabile durante la registrazione', 'it', 'yum'),
('Send', 'Senden', 'de', 'yum'),
('Send', 'Enviar', 'es', 'yum'),
('Send', 'Envoyer', 'fr', 'yum'),
('Send', 'Invia', 'it', 'yum'),
('Send', 'Senden', 'pl', 'yum'),
('Send a message to this User', 'Diesem Benutzer eine Nachricht senden', 'de', 'yum'),
('Send a message to this User', 'Enviar un mensaje a este Usuario', 'es', 'yum'),
('Send a message to this User', 'Faire parvenir un message a ce membre', 'fr', 'yum'),
('Send a message to this User', 'Invia messaggio all''utente', 'it', 'yum'),
('Send invitation', 'Kontaktanfrage senden', 'de', 'yum'),
('Send invitation', 'Enviar invitación', 'es', 'yum'),
('Send invitation', 'Envoyer la demande de contact', 'fr', 'yum'),
('Send invitation', 'Kontaktanfrage senden', 'it', 'yum'),
('Send message notifier emails', 'Benachrichtigungen schicken', 'de', 'yum'),
('Send message notifier emails', 'Enviar mensaje de e-mail de notificación', 'es', 'yum'),
('Send message notifier emails', 'Envoie d une notification', 'fr', 'yum'),
('Send message notifier emails', 'Notifiche e-mail', 'it', 'yum'),
('Sent at', 'Gesendet am', 'de', 'yum'),
('Sent at', 'Enviado al', 'es', 'yum'),
('Sent at', 'ENvoye le', 'fr', 'yum'),
('Sent at', 'Pubblicato il', 'it', 'yum'),
('Sent at', 'Wyslano', 'pl', 'yum'),
('Sent messages', 'Gesendete Nachrichten', 'de', 'yum'),
('Sent messages', 'Mensajes enviados', 'es', 'yum'),
('Sent messages', 'Message envoye', 'fr', 'yum'),
('Sent messages', 'Messaggi inviati', 'it', 'yum'),
('Sent messages', 'Wyslane wiadomosci', 'pl', 'yum'),
('Separate usernames with comma to ignore specified users', 'Benutzernamen mit Komma trennen, um sie zu ignorieren', 'de', 'yum'),
('Separate usernames with comma to ignore specified users', 'Separa con coma los nombres de los usuarios que deseas ignorar', 'es', 'yum'),
('Separate usernames with comma to ignore specified users', 'Ma liste noire, pour introduire plusieurs membres en une seule fois, separer les noms d utilisateur avec une virgule', 'fr', 'yum'),
('Separate usernames with comma to ignore specified users', 'Separa gli username con una virgola, per ignorare gli utenti specificati', 'it', 'yum'),
('Set payment date to today', 'Zahlungseingang bestätigen', 'de', 'yum'),
('Set payment date to today', 'Establecer fecha de pago el d', 'es', 'yum'),
('Set payment date to today', 'Imposta data pagamento ad oggi', 'it', 'yum'),
('Settings', 'Einstellungen', 'de', 'yum'),
('Settings', 'Ajustes', 'es', 'yum'),
('Settings', 'Reglage', 'fr', 'yum'),
('Settings', 'Impostazioni', 'it', 'yum'),
('Settings', 'Ustawienia', 'pl', 'yum'),
('Settings profiles', 'Einstellungsprofile', 'de', 'yum'),
('Settings profiles', 'Ajustes de perfiles', 'es', 'yum'),
('Settings profiles', 'Reglages des profiles', 'fr', 'yum'),
('Settings profiles', 'Impostazioni profili', 'it', 'yum'),
('Settings profiles', 'Ustawienia profili', 'pl', 'yum'),
('Show activities', 'Zeige Aktivitäten', 'de', 'yum'),
('Show activities', 'Mostrar las actividades', 'es', 'yum'),
('Show activities', 'Voir la chronique des activites', 'fr', 'yum'),
('Show activities', 'Mostra attivita', 'it', 'yum'),
('Show administration Hierarchy', 'Hierarchie', 'de', 'yum'),
('Show administration Hierarchy', 'Mostrar jerarquía de administración', 'es', 'yum'),
('Show administration Hierarchy', 'Hierarchie', 'fr', 'yum'),
('Show administration Hierarchy', 'Gerarchia', 'it', 'yum'),
('Show administration Hierarchy', 'Pokaz hierarchie administrowania', 'pl', 'yum'),
('Show all', 'Mostra tutti', 'it', 'yum'),
('Show friends', 'Kontaktliste veröffentlichen', 'de', 'yum'),
('Show friends', 'Mostrar amigos', 'es', 'yum'),
('Show friends', 'REndre ma liste de contacts visible', 'fr', 'yum'),
('Show friends', 'Mostra contatti', 'it', 'yum'),
('Show my online status to everyone', 'Meinen Online-Status veröffentlichen', 'de', 'yum'),
('Show my online status to everyone', 'Mostrar mi estado de conexi', 'es', 'yum'),
('Show my online status to everyone', 'Montrer lorsque je suis en ligne', 'fr', 'yum'),
('Show my online status to everyone', 'Mostra il mio stato a tutti', 'it', 'yum'),
('Show online status', 'Online-Status anzeigen', 'de', 'yum'),
('Show online status', 'Mostrar estado de conexi', 'es', 'yum'),
('Show online status', 'Status en ligne visible', 'fr', 'yum'),
('Show online status', 'Mostra lo stato online', 'it', 'yum'),
('Show permissions', 'Berechtigungen anzeigen', 'de', 'yum'),
('Show permissions', 'Mostrar permisos', 'es', 'yum'),
('Show permissions', 'Montrer les permissions', 'fr', 'yum'),
('Show permissions', 'Mostra autorizzazioni', 'it', 'yum'),
('Show profile visits', 'Profilbesuche anzeigen', 'de', 'yum'),
('Show profile visits', 'Mostrar perfil de visitas', 'es', 'yum'),
('Show profile visits', 'Montrer les visites de profils', 'fr', 'yum'),
('Show profile visits', 'Visualizza visite profilo', 'it', 'yum'),
('Show roles', 'Rollen anzeigen', 'de', 'yum'),
('Show roles', 'Mostrar roles', 'es', 'yum'),
('Show roles', 'Voir les roles', 'fr', 'yum'),
('Show roles', 'Mostra ruoli', 'it', 'yum'),
('Show roles', 'Pokaz role', 'pl', 'yum'),
('Show the owner when i visit his profile', 'Dem Profileigentümer erkenntlich machen, wenn ich sein Profil besuche', 'de', 'yum'),
('Show the owner when i visit his profile', 'Mostrar el due', 'es', 'yum'),
('Show the owner when i visit his profile', 'Montrer aux proprietaires des profils lorsque je consulte leur profil', 'fr', 'yum'),
('Show the owner when i visit his profile', 'Mostra al proprietario quando visito il suo profilo', 'it', 'yum'),
('Show users', 'Benutzer anzeigen', 'de', 'yum'),
('Show users', 'Mostrar usuarios', 'es', 'yum'),
('Show users', 'Voir les membres', 'fr', 'yum'),
('Show users', 'Mostra utenti', 'it', 'yum'),
('Show users', 'Pokaz uzytkownikow', 'pl', 'yum'),
('Statistics', 'Benutzerstatistik', 'de', 'yum'),
('Statistics', 'Estadísticas', 'es', 'yum'),
('Statistics', 'Statistiques des membres', 'fr', 'yum'),
('Statistics', 'Statistiche', 'it', 'yum'),
('Statistics', 'Statystyki', 'pl', 'yum'),
('Status', 'Status', 'de', 'yum'),
('Status', 'Estado', 'es', 'yum'),
('Status', 'Status', 'fr', 'yum'),
('Status', 'Stato', 'it', 'yum'),
('Status', 'Status', 'pl', 'yum'),
('Status', 'Статус', 'ru', 'yum'),
('Street', 'Straße', 'de', 'yum'),
('Street', 'Calle', 'es', 'yum'),
('Street', 'Rue', 'fr', 'yum'),
('Street', 'Indirizzo', 'it', 'yum'),
('Street', 'Ulica', 'pl', 'yum'),
('Subject', 'Titel', 'de', 'yum'),
('Subject', 'Tema', 'es', 'yum'),
('Subject', 'Sujet', 'fr', 'yum'),
('Subject', 'Oggetto', 'it', 'yum'),
('Success', 'Erfolgreich', 'de', 'yum'),
('Success', 'Exitoso', 'es', 'yum'),
('Success', 'Reussi', 'fr', 'yum'),
('Success', 'Successo', 'it', 'yum'),
('Superuser', 'Superuser', 'de', 'yum'),
('Superuser', 'Superusuario', 'es', 'yum'),
('Superuser', 'Superuser', 'fr', 'yum'),
('Superuser', 'Superuser', 'it', 'yum'),
('Superuser', 'Superuser', 'pl', 'yum'),
('Superuser', 'Супер пользователь', 'ru', 'yum'),
('Text Email Activation', 'Text Email Konto-Aktivierung', 'de', 'yum'),
('Text Email Activation', 'Texto de activación por correo', 'es', 'yum'),
('Text Email Activation', 'Texte contenu dans l e-mail d activation de compte', 'fr', 'yum'),
('Text Email Activation', 'Testo email d''attivazione account', 'it', 'yum'),
('Text Email Recovery', 'Text E-Mail Passwort wiederherstellen', 'de', 'yum'),
('Text Email Recovery', 'Texto de recuperación de contraseña por correo', 'es', 'yum'),
('Text Email Recovery', 'Texte contenu dans l e-Mail de renouvellement de mot de passe', 'fr', 'yum'),
('Text Email Recovery', 'Testo email recupero password', 'it', 'yum'),
('Text Email Registration', 'Text E-Mail Registrierung', 'de', 'yum'),
('Text Email Registration', 'Texto de registro por correo', 'es', 'yum'),
('Text Email Registration', 'Texte contenu dans l e-Mail d enregistrement', 'fr', 'yum'),
('Text Email Registration', 'Testo email di registrazione', 'it', 'yum'),
('Text Login Footer', 'Text im Login-footer', 'de', 'yum'),
('Text Login Footer', 'Text im Login-footer', 'es', 'yum'),
('Text Login Footer', 'Text im Login-footer', 'fr', 'yum'),
('Text Login Footer', 'Testo nel piepagina del login', 'it', 'yum'),
('Text Login Header', 'Text im Login-header', 'de', 'yum'),
('Text Login Header', 'Text im Login-header', 'es', 'yum'),
('Text Login Header', 'Texte de connection-header', 'fr', 'yum'),
('Text Login Header', 'Testo nell''intestazione del login', 'it', 'yum'),
('Text Registration Footer', 'Text im Registrierung-footer', 'de', 'yum'),
('Text Registration Footer', 'Text im Registrierung-footer', 'es', 'yum'),
('Text Registration Footer', 'Texte d enregistrement-footer', 'fr', 'yum'),
('Text Registration Footer', 'Testo nel piepagina della registrazione', 'it', 'yum'),
('Text Registration Header', 'Text im Registrierung-header', 'de', 'yum'),
('Text Registration Header', 'Text im Registrierung-header', 'es', 'yum'),
('Text Registration Header', 'Texte d enregistrement-header', 'fr', 'yum'),
('Text Registration Header', 'Testo nell''intestazione della registrazione', 'it', 'yum'),
('Text for new friendship request', 'Text für eine neue Kontaktanfrage', 'de', 'yum'),
('Text for new friendship request', 'Text für eine neue Kontaktanfrage', 'es', 'yum'),
('Text for new friendship request', 'Texte pour une nouvelle demande de contact', 'fr', 'yum'),
('Text for new friendship request', 'Testo per una nuova richiesta di contatto', 'it', 'yum'),
('Text for new profile comment', 'Text für neuen Profilkommentar', 'de', 'yum'),
('Text for new profile comment', 'Text für neuen Profilkommentar', 'es', 'yum'),
('Text for new profile comment', 'Texte pour un nouveau commentaire dans un profil', 'fr', 'yum'),
('Text for new profile comment', 'Testo per un nuovo commento al profilo', 'it', 'yum'),
('Text translations', 'Übersetzungstexte', 'de', 'yum'),
('Text translations', 'Traducciones de texto', 'es', 'yum'),
('Thank you for your registration. Contact Admin to activate your account.', 'Grazie per la tua registrazione. Contatta l''ammnistratore per attivare l''account', 'it', 'yum'),
('Thank you for your registration. Please check your email or login.', 'Vielen Dank für Ihre Anmeldung. Bitte überprüfen Sie Ihre E-Mails oder loggen Sie sich ein.', 'de', 'yum'),
('Thank you for your registration. Please check your email or login.', 'Gracias por su registro. Por favor, compruebe su correo electr', 'es', 'yum'),
('Thank you for your registration. Please check your email or login.', 'Merci pour votre inscription.Controlez votre boite e-mail, le code d activation de votre compte vous a ete envoye par e-mail.Attention! Par mesure de securite, le lien contenu dans ce mail, n est valable que 48h *IMPORTANT:pour le cas ou notre e-mail', 'fr', 'yum'),
('Thank you for your registration. Please check your email or login.', 'Grazie per la tua registrazione, controlla la tua email o effettua il login,', 'it', 'yum'),
('Thank you for your registration. Please check your email or login.', 'Vielen Dank fur Ihre Anmeldung. Bitte uberprufen Sie Ihre E-Mails oder loggen Sie sich ein.', 'pl', 'yum'),
('Thank you for your registration. Please check your email or login.', 'Регистрация завершена. Пожалуйста проверьте свой электронный ящик или выполните вход.', 'ru', 'yum'),
('Thank you for your registration. Please check your email.', 'Vielen Dank für Ihre Anmeldung. Bitte überprüfen Sie Ihre E-Mails.', 'de', 'yum'),
('Thank you for your registration. Please check your email.', 'Gracias por su registro. Por favor revise su email.', 'es', 'yum'),
('Thank you for your registration. Please check your email.', 'Merci pour votre inscription.Controlez votre boite e-mail, le code d activation de votre compte vous a ete envoye par e-mail. *IMPORTANT:pour le cas ou notre e-mail ne vous serais pas parvenu, il est possible que notre e-mail ai ete filtre par votre', 'fr', 'yum'),
('Thank you for your registration. Please check your email.', 'Grazie per la tua registrazione, controlla la tua email,', 'it', 'yum'),
('Thank you for your registration. Please check your email.', 'Vielen Dank fur Ihre Anmeldung. Bitte uberprufen Sie Ihre E-Mails.', 'pl', 'yum'),
('Thank you for your registration. Please check your email.', 'Регистрация завершена. Пожалуйста проверьте свой электронный ящик.', 'ru', 'yum'),
('Thank you for your registration. Please login.', 'Grazie per la tua registrazone. Effettua il login.', 'it', 'yum'),
('The comment has been saved', 'Der Kommentar wurde gespeichert', 'de', 'yum'),
('The comment has been saved', 'Der Kommentar wurde gespeichert', 'es', 'yum'),
('The comment has been saved', 'Le commentaire a bien ete memorise', 'fr', 'yum'),
('The comment has been saved', 'Il commento e stato salvato', 'it', 'yum'),
('The file "{file}" is not an image.', 'Die Datei {file} ist kein Bild.', 'de', 'yum'),
('The file "{file}" is not an image.', 'Este archivo {file} no es una imagen.', 'es', 'yum'),
('The file &quot;{file}&quot; is not an image.', 'DLe fichier {file} n est pas un fichier image.', 'fr', 'yum'),
('The file &quot;{file}&quot; is not an image.', 'Il file {file} non e un''immagine.', 'it', 'yum'),
('The friendship request has been sent', 'Die Kontaktanfrage wurde gesendet', 'de', 'yum'),
('The friendship request has been sent', 'La solicitud de amistad ha sido enviado', 'es', 'yum'),
('The friendship request has been sent', 'Votre demande de contact a bien ete envoyee', 'fr', 'yum'),
('The friendship request has been sent', 'La richiesta di contatto e stata inviata', 'it', 'yum'),
('The image "{file}" height should be "{height}px".', 'Die Datei {file} muss genau {height}px hoch sein.', 'de', 'yum'),
('The image "{file}" height should be "{height}px".', 'La imagen {file} debe tener {height}px de largo.', 'es', 'yum'),
('The image "{file}" width should be "{width}px".', 'Die Datei {file} muss genau {width}px breit sein.', 'de', 'yum'),
('The image "{file}" width should be "{width}px".', 'La imagen {file} debe tener {width}px de ancho.', 'es', 'yum'),
('The image &quot;{file}&quot; height should be &quot;{height}px&quot;.', 'La photo {file} doit avoir une hauteur maximum de {height}px .', 'fr', 'yum'),
('The image &quot;{file}&quot; height should be &quot;{height}px&quot;.', 'L''immagine {file} deve essere {height}px.', 'it', 'yum'),
('The image &quot;{file}&quot; width should be &quot;{width}px&quot;.', 'La photo {file} doit avoir une largeur maximum de {width}px .', 'fr', 'yum'),
('The image &quot;{file}&quot; width should be &quot;{width}px&quot;.', 'L''immagine {file} deve essere larga {width}px.', 'it', 'yum'),
('The image has been resized to {max_pixel}px width successfully', 'Das Bild wurde beim hochladen automatisch auf eine Breite von {max_pixel} skaliert', 'de', 'yum'),
('The image has been resized to {max_pixel}px width successfully', 'La imagen ha sido redimensionada a {max_pixel} px de ancho con ', 'es', 'yum'),
('The image has been resized to {max_pixel}px width successfully', 'Votre photo de profil a ete retaillee automatiquement a une taille de{max_pixel}', 'fr', 'yum'),
('The image has been resized to {max_pixel}px width successfully', 'Immagine ridimensionata a {max_pixel}px con successo.', 'it', 'yum'),
('The image should have at least 50px and a maximum of 200px in width and height. Supported filetypes are .jpg, .gif and .png', 'das Bild sollte mindestens 50px und maximal 200px in der Höhe und Breite betragen. Mögliche Dateitypen sind .jpg, .gif und .png', 'de', 'yum'),
('The image should have at least 50px and a maximum of 200px in width and height. Supported filetypes are .jpg, .gif and .png', 'La imagen debe tener un mínimo de 50px y un máximo de 200px de ancho y largo. Los tipos de archivo soportados son .jpg, .gif y .png', 'es', 'yum'),
('The image should have at least 50px and a maximum of 200px in width and height. Supported filetypes are .jpg, .gif and .png', 'La foto chargee doit avoir une largeur maximum de 50px  et une hauteur maximale de 200px. Les fichiers acceptes sont; .jpg, .gif und .png', 'fr', 'yum'),
('The image should have at least 50px and a maximum of 200px in width and height. Supported filetypes are .jpg, .gif and .png', 'L''immagine deve essere almeno 50px e massimo 200px in larghezza e altezza. Tipi di file supportati .jpg, .gif e .png', 'it', 'yum'),
('The image was uploaded successfully', 'Das Bild wurde erfolgreich hochgeladen', 'de', 'yum'),
('The image was uploaded successfully', 'La imagen se ha carregado correctamente', 'es', 'yum'),
('The image was uploaded successfully', 'L image a ete chargee avec succes', 'fr', 'yum'),
('The image was uploaded successfully', 'Immagine caricata con successo', 'it', 'yum'),
('The messages for your application language are not defined.', 'Los mensajes para el idioma de tu aplicación no están definidos', 'es', 'yum'),
('The minimum value of the field (form validator).', 'Minimalwert des Feldes (Form-Validierung', 'de', 'yum'),
('The minimum value of the field (form validator).', 'El valor mínimo del campo (validador de formulario)', 'es', 'yum'),
('The minimum value of the field (form validator).', 'Valeur minimum du champ (Validation du formulaire)', 'fr', 'yum'),
('The minimum value of the field (form validator).', 'Valore minimo del campo (validazione form).', 'it', 'yum'),
('The minimum value of the field (form validator).', 'Минимальное значение поля (проверка формы).', 'ru', 'yum'),
('The new password has been saved', 'Das neue Passwort wurde gespeichert.', 'de', 'yum'),
('The new password has been saved', 'La nueva contrase', 'es', 'yum'),
('The new password has been saved', 'Votre nouveau mot de passe a bien ete memorise.', 'fr', 'yum'),
('The new password has been saved', 'La nuova password e stata salvata.', 'it', 'yum'),
('The new password has been saved.', 'La nueva contraseña ha sido guardada', 'es', 'yum'),
('The value of the default field (database).', 'Standard-Wert für die Datenbank', 'de', 'yum'),
('The value of the default field (database).', 'El valor predeterminado del campo (base de datos).', 'es', 'yum'),
('The value of the default field (database).', 'Valeur standard pour la banque de donnee', 'fr', 'yum'),
('The value of the default field (database).', 'Valore del campo predefnito (database).', 'it', 'yum'),
('The value of the default field (database).', 'Domyslna wartosc pola (bazodanowego).', 'pl', 'yum'),
('The value of the default field (database).', 'Значение поля по умолчанию (база данных).', 'ru', 'yum'),
('There are a total of {messages} messages in your System.', 'Es gibt in ihrem System insgesamt {messages} Nachrichten.', 'de', 'yum'),
('There are a total of {messages} messages in your System.', 'Hay un total de {messages} mensajes en su sistema.', 'es', 'yum'),
('There are a total of {messages} messages in your System.', 'Il existe dans votre systeme {messages} messages.', 'fr', 'yum'),
('There are a total of {messages} messages in your System.', 'Ci sno un totale di {messages} messaggi nel Sistema.', 'it', 'yum'),
('There are a total of {messages} messages in your System.', 'Istnieje {messages} wiadomosci w Twoim systemie.', 'pl', 'yum'),
('There are {active_users} active and {inactive_users} inactive users in your System, from which {admin_users} are Administrators.', ' Es gibt {active_users} aktive und {inactive_users} inaktive Benutzer in ihrem System, von denen {admin_users} Benutzer Administratoren sind.', 'de', 'yum'),
('There are {active_users} active and {inactive_users} inactive users in your System, from which {admin_users} are Administrators.', 'Hay {active_users} usuarios activos y {inactive_users} usuarios inactivos en su sistema, de los cuales {admin_users} son Administradores.', 'es', 'yum'),
('There are {active_users} active and {inactive_users} inactive users in your System, from which {admin_users} are Administrators.', 'Il existe {active_users}  membres actifs et {inactive_users} membres inactifs dans votre systeme, pour lesquels {admin_users} membres sont designes en tant qu administrateurs.', 'fr', 'yum'),
('There are {active_users} active and {inactive_users} inactive users in your System, from which {admin_users} are Administrators.', 'Ci sono {active_users} utenti attivi e {inactive_users} utenti inattivi nel Sistema, di cui {admin_users} sono amministratori.', 'it', 'yum'),
('There are {active_users} active and {inactive_users} inactive users in your System, from which {admin_users} are Administrators.', 'Istnieja {active_users} aktywni i {inactive_users} nieaktywni uzytkownicy w Twoim systemie, w tym {admin_users} administratorzy.', 'pl', 'yum'),
('There are {profiles} profiles in your System. These consist of {profile_fields} profile fields in {profile_field_groups} profile field groups', 'Es gibt {profiles} Profile in ihren System. Diese bestehen aus {profile_fields} Profilfeldern, die sich in {profile_field_groups} Profilfeldgruppen aufteilen.', 'de', 'yum'),
('There are {profiles} profiles in your System. These consist of {profile_fields} profile fields in {profile_field_groups} profile field groups', 'Hay {profiles} perfiles en su sistema. Estos consisten de {profile_fields} campos de perfiles en {profile_field_groups} grupos de campos de perfiles', 'es', 'yum'),
('There are {profiles} profiles in your System. These consist of {profile_fields} profile fields in {profile_field_groups} profile field groups', 'Il existe {profiles} profils dans votre systeme. Ils se composent de {profile_fields} champs de profils, qui se decomposent {profile_field_groups} en grouppe de champs de profils.', 'fr', 'yum'),
('There are {profiles} profiles in your System. These consist of {profile_fields} profile fields in {profile_field_groups} profile field groups', 'Ci sono {profiles} profili nel Sistema. sono costituiti da {profile_fields} campi profili, in {profile_field_groups} campo profili gruppi.', 'it', 'yum'),
('There are {profiles} profiles in your System. These consist of {profile_fields} profile fields in {profile_field_groups} profile field groups', 'Istnieja {profiles} profile w Twoim systemie, ktore zawieraja pola {profile_fields} w grupach {profile_field_groups}', 'pl', 'yum'),
('There are {roles} roles in your System.', 'Es gibt {roles} Rollen in ihrem System', 'de', 'yum'),
('There are {roles} roles in your System.', 'Hay {roles} roles en su sistema.', 'es', 'yum'),
('There are {roles} roles in your System.', 'Il existe les {roles} roles suivant dans votre systeme', 'fr', 'yum'),
('There are {roles} roles in your System.', 'Ci sono {roles} ruoli nel Sistema', 'it', 'yum'),
('There are {roles} roles in your System.', 'Istnieje {roles} rol w Twoim systemie', 'pl', 'yum'),
('There was an error saving the password', 'Fehler beim speichern des Passwortes', 'de', 'yum'),
('There was an error saving the password', 'Hubo un error al guardar la contrase', 'es', 'yum'),
('There was an error saving the password', 'Erreur produite lors de la memorisation de votre mot de passe.', 'fr', 'yum'),
('There was an error saving the password', 'Impossibile salvare la password', 'it', 'yum'),
('These users have a ordered memberships of this role', 'Diese Benutzer haben eine Mitgliedschaft in dieser Rolle', 'de', 'yum'),
('These users have a ordered memberships of this role', 'Ces membres sont assignes a ce role', 'fr', 'yum'),
('These users have a ordered memberships of this role', 'Questi utenti hanno ordinato l''iscrizione a questo ruolo', 'it', 'yum'),
('These users have been assigned to this Role', 'Diese Nutzer gehören dieser Rolle an: ', 'de', 'yum'),
('These users have been assigned to this Role', 'A ces membres ont ete attribues ce role:', 'fr', 'yum'),
('These users have been assigned to this Role', 'Questi utenti sono assegnati al ruolo:', 'it', 'yum'),
('These users have been assigned to this Role', 'Uzytkownik zostal przypisany do rol:', 'pl', 'yum'),
('These users have been assigned to this role', 'Dieser Rolle gehören diese Benutzer an', 'de', 'yum'),
('These users have been assigned to this role', 'Ce role a bien ete attribue a ces membres', 'fr', 'yum'),
('These users have been assigned to this role', 'Questo ruolo e assegnato  a questo utente', 'it', 'yum'),
('These users have been assigned to this role', 'Uzytkownik zostal przypisany do rol', 'pl', 'yum'),
('These users have commented your profile recently', 'Diese Benutzer haben mein Profil kürzlich kommentiert', 'de', 'yum'),
('These users have commented your profile recently', 'Cet utilisateur a commente recemment votre profil', 'fr', 'yum'),
('These users have commented your profile recently', 'Questo utente ha recentemente commentato sul tuo profilo', 'it', 'yum'),
('These users have visited my profile', 'Diese Benutzer haben mein Profil besucht', 'de', 'yum'),
('These users have visited my profile', 'Les membres ayant visite mon profil.', 'fr', 'yum'),
('These users have visited my profile', 'Questi utenti hanno visitato il tuo profilo', 'it', 'yum'),
('These users have visited your profile recently', 'Diese Benutzer haben kürzlich mein Profil besucht', 'de', 'yum'),
('These users have visited your profile recently', 'Cet utilisateur a visite votre profil recemment', 'fr', 'yum'),
('These users have visited your profile recently', 'Questi utenti hanno recentemente visitato il tuo profilo', 'it', 'yum'),
('This account is blocked.', 'Ihr Konto wurde blockiert.', 'de', 'yum'),
('This account is blocked.', 'Esta cuenta está bloqueada.', 'es', 'yum'),
('This account is blocked.', 'Votre compte a ete bloque. Contactez nous.', 'fr', 'yum'),
('This account is blocked.', 'Il tuo account e stato bloccato.', 'it', 'yum'),
('This account is blocked.', 'To konto jest zablokowane.', 'pl', 'yum'),
('This account is not activated.', 'Ihr Konto wurde nicht aktiviert.', 'de', 'yum'),
('This account is not activated.', 'Esta cuenta no está activada.', 'es', 'yum'),
('This account is not activated.', 'Votre compte n a pas ete active.', 'fr', 'yum'),
('This account is not activated.', 'Il tuo account non e attivato.', 'it', 'yum'),
('This account is not activated.', 'To konto nie zostalo jeszcze aktywowane.', 'pl', 'yum'),
('This membership is still active {days} days', 'Die Mitgliedschaft ist noch {days} Tage aktiv', 'de', 'yum'),
('This membership is still {days} days active', 'Esta membres', 'es', 'yum'),
('This membership is still {days} days active', 'L''iscrizione e ancora attiva per {days} giorni', 'it', 'yum'),
('This message will be sent to {username}', 'Diese Nachricht wird an {username} versandt', 'de', 'yum'),
('This message will be sent to {username}', 'Este mensaje será enviado a {username}', 'es', 'yum'),
('This message will be sent to {username}', 'Ce message sera envoye a {username}', 'fr', 'yum'),
('This message will be sent to {username}', 'Questo messaggio verra inviato a {username}', 'it', 'yum'),
('This role can administer users of this roles', 'Este rol puede administrar usuarios de estos roles', 'es', 'yum'),
('This role can administer users of this roles', 'Membres ayant ce role peuvent administrer ces utilisateurs', 'fr', 'yum'),
('This role can administer users of this roles', 'Questo ruolo puo amministrare utenti di questo ruolo', 'it', 'yum'),
('This user belongs to these roles:', 'Benutzer gehört diesen Rollen an:', 'de', 'yum'),
('This user belongs to these roles:', 'Este usuario pertenece a estos roles:', 'es', 'yum'),
('This user belongs to these roles:', 'A ce membre a ete attribue ces roles:', 'fr', 'yum'),
('This user belongs to these roles:', 'L''Utente appartiene a questi ruoli:', 'it', 'yum'),
('This user belongs to these roles:', 'Uzytkownik posiada role:', 'pl', 'yum'),
('This user can administer this users', 'Dieser Benutzer kann diese Nutzer administrieren', 'de', 'yum'),
('This user can administer this users', 'Este usuario puede administrar estos usuarios', 'es', 'yum'),
('This user can administer this users', 'Ce membre peut gerer ces utilisateurs.', 'fr', 'yum'),
('This user can administer this users', 'Gli utenti possono gestire questi utenti', 'it', 'yum'),
('This user can administer this users:', 'Benutzer kann diese Benutzer verwalten:', 'de', 'yum'),
('This user can administer this users:', 'Este usuario puede administrar estos usuarios:', 'es', 'yum'),
('This user can administer this users:', 'Ce membre peut administrer ces membres:', 'fr', 'yum'),
('This user can administer this users:', 'Gli utenti possono gestire questi utenti:', 'it', 'yum'),
('This user can administer this users:', 'Uzytkownik moze zarzadzaj nastepujacymi uzytkownikami:', 'pl', 'yum'),
('This user can administrate this users', 'Uzytkownik moze administrowac podanymi uzytkownikami', 'pl', 'yum'),
('This user''s email address already exists.', 'Indirizzo email esistente.', 'it', 'yum'),
('This user''s email adress already exists.', 'Der Benutzer E-Mail-Adresse existiert bereits.', 'de', 'yum'),
('This user''s email adress already exists.', 'La dirección de e-mail de este usuario ya existe.', 'es', 'yum'),
('This user''s email adress already exists.', 'Cette adresse e-mail existe deja dans notre banque de donnee.', 'fr', 'yum'),
('This user''s email adress already exists.', 'Indirizzo e-mail gia esistente.', 'it', 'yum'),
('This user''s email adress already exists.', 'Podany adres melopwy jest w uzyciu', 'pl', 'yum'),
('This user''s email adress already exists.', 'Пользователь с таким электронным адресом уже существует.', 'ru', 'yum'),
('This user''s name already exists.', 'Der Benutzer Name existiert bereits.', 'de', 'yum'),
('This user''s name already exists.', 'Este nombre de usuario ya existe.', 'es', 'yum'),
('This user''s name already exists.', 'Ce nom d utilisateur existe deja dans notre banque de donnee.', 'fr', 'yum'),
('This user''s name already exists.', 'Nome esistenze', 'it', 'yum'),
('This user''s name already exists.', 'Podana nazwa uzytkownika jest w uzyciu.', 'pl', 'yum'),
('This user''s name already exists.', 'Пользователь с таким именем уже существует.', 'ru', 'yum'),
('This users have a ordered memberships of this role', 'Estos usuarios tienen una membres', 'es', 'yum'),
('This users have been assigned to this Role', 'Este usuario ha sido asignado a este Rol', 'es', 'yum'),
('This users have been assigned to this role', 'Este usuario ha sido asignado a este rol', 'es', 'yum'),
('This users have commented your profile recently', 'Estos usuarios han comentado su perfil recientemente', 'es', 'yum'),
('This users have visited my profile', 'Estos usuarios han visitado mi perfil', 'es', 'yum'),
('This users have visited your profile recently', 'Estos usuarios han visitado tu perfil recientemente', 'es', 'yum'),
('Time left', 'Zeit übrig', 'de', 'yum'),
('Time left', 'Tiempo restante', 'es', 'yum'),
('Time sent', 'Gesendet am', 'de', 'yum'),
('Time sent', 'Hora de envío', 'es', 'yum'),
('Time sent', 'Envoye le', 'fr', 'yum'),
('Time sent', 'Pubblicato su', 'it', 'yum'),
('Time sent', 'Wyslano', 'pl', 'yum'),
('Title', 'Titel', 'de', 'yum'),
('Title', 'Título', 'es', 'yum'),
('Title', 'Titre', 'fr', 'yum'),
('Title', 'Titolo', 'it', 'yum'),
('Title', 'Название', 'ru', 'yum'),
('To', 'An', 'de', 'yum'),
('To', 'Para', 'es', 'yum'),
('To', 'A', 'fr', 'yum'),
('To', 'A', 'it', 'yum'),
('Translation', 'Übersetzung', 'de', 'yum'),
('Translation', 'Traducción', 'es', 'yum'),
('Translations have been saved', 'Die Übersetzungen wurden gespeichert', 'de', 'yum'),
('Translations have been saved', 'Las traducciones han sido salvadas', 'es', 'yum'),
('Try again', 'Erneut versuchen', 'de', 'yum'),
('Try again', 'Intenta de nuevo', 'es', 'yum'),
('Try again', 'Essayer a nouveau', 'fr', 'yum'),
('Try again', 'Prova di nuovo', 'it', 'yum'),
('Try again', 'Sprobuj jeszcze raz', 'pl', 'yum'),
('Update', 'Bearbeiten', 'de', 'yum'),
('Update', 'Actualizar', 'es', 'yum'),
('Update', 'Modifier', 'fr', 'yum'),
('Update', 'Aggiorna', 'it', 'yum'),
('Update', 'Zmien', 'pl', 'yum'),
('Update Profile Field', 'Profilfeld bearbeiten', 'de', 'yum'),
('Update Profile Field', 'Actualizar Campo del Perfil', 'es', 'yum'),
('Update Profile Field', 'Modifier le champ du profil', 'fr', 'yum'),
('Update Profile Field', 'Aggiorna campo Profilo', 'it', 'yum'),
('Update Profile Field', 'Zmien pole w profilu', 'pl', 'yum'),
('Update Profile Field', 'Править', 'ru', 'yum'),
('Update User', 'Benutzer bearbeiten', 'de', 'yum'),
('Update User', 'Actualizar Usuario', 'es', 'yum'),
('Update User', 'Gerer les membres', 'fr', 'yum'),
('Update User', 'Aggiorna utenti', 'it', 'yum'),
('Update User', 'Править', 'ru', 'yum'),
('Update my profile', 'Mein Profil bearbeiten', 'de', 'yum'),
('Update my profile', 'Actualizar mi perfil', 'es', 'yum'),
('Update my profile', 'Aggiorna profilo', 'it', 'yum'),
('Update payment', 'Zahlungsart bearbeiten', 'de', 'yum'),
('Update payment', 'Actualizar el pago', 'es', 'yum'),
('Update payment', 'Aggiorna pagamento', 'it', 'yum'),
('Update role', 'Rolle bearbeiten', 'de', 'yum'),
('Update role', 'Actualizar rol', 'es', 'yum'),
('Update role', 'Modifier les roles', 'fr', 'yum'),
('Update role', 'Aggiorna ruolo', 'it', 'yum'),
('Update role', 'Edytuj role', 'pl', 'yum'),
('Update user', 'Benutzer bearbeiten', 'de', 'yum'),
('Update user', 'Actualizar usuario', 'es', 'yum'),
('Update user', 'Modifier un membre', 'fr', 'yum'),
('Update user', 'Aggiorna utente', 'it', 'yum'),
('Update user', 'Zmien uzytkownika', 'pl', 'yum'),
('Upgrade to {role}', 'Wechsle auf {role}', 'de', 'yum'),
('Upload Avatar', 'Subir un Avatar', 'es', 'yum'),
('Upload Avatar', 'Charger une image de profil', 'fr', 'yum'),
('Upload Avatar', 'Carica avatar', 'it', 'yum'),
('Upload avatar', 'Profilbild hochladen', 'de', 'yum'),
('Upload avatar', 'Subir un avatar', 'es', 'yum'),
('Upload avatar', 'Charger une image de profil maintenant', 'fr', 'yum'),
('Upload avatar', 'Carica avatar', 'it', 'yum'),
('Upload avatar Image', 'Carica avatar', 'it', 'yum'),
('Upload avatar image', 'Profilbild hochladen', 'de', 'yum'),
('Upload avatar image', 'Cargar imagen de perfil', 'es', 'yum'),
('Upload avatar image', 'Charger une image pour votre profil', 'fr', 'yum'),
('Upload avatar image', 'Carica immagine avatar', 'it', 'yum'),
('Use my Gravatar', 'Meinen Gravatar benutzen', 'de', 'yum'),
('Use my Gravatar', 'Usar mi Gravatar', 'es', 'yum'),
('User', 'Benutzer', 'de', 'yum'),
('User', 'Usuario', 'es', 'yum'),
('User', 'Utilisateur', 'fr', 'yum'),
('User', 'Utente', 'it', 'yum'),
('User Administration', 'Benutzerverwaltung', 'de', 'yum'),
('User Administration', 'Administración de usuario', 'es', 'yum'),
('User Administration', 'Gestion des membres', 'fr', 'yum'),
('User Administration', 'Gestione utente', 'it', 'yum'),
('User Administration', 'Zarzadzanie uzytkownikami', 'pl', 'yum'),
('User Management Home', 'Benutzerverwaltung Startseite', 'de', 'yum'),
('User Management Home', 'Administración de usuario', 'es', 'yum'),
('User Management Home', 'Page de gestion des membres', 'fr', 'yum'),
('User Management Home', 'Home gestione utente', 'it', 'yum'),
('User Management Home', 'Strona startowa profilu', 'pl', 'yum'),
('User Management settings configuration', 'Einstellungen', 'de', 'yum'),
('User Management settings configuration', 'Ajustes de configuración de la Administración de usuarios', 'es', 'yum'),
('User Management settings configuration', 'Options de configuration des profils', 'fr', 'yum'),
('User Management settings configuration', 'Configurazione impostazioni gestione utente', 'it', 'yum'),
('User Operations', 'Benutzeraktionen', 'de', 'yum'),
('User Operations', 'Operaciones de usuario', 'es', 'yum'),
('User Operations', 'Action de l utilisateur', 'fr', 'yum'),
('User Operations', 'Azioni utente', 'it', 'yum'),
('User Operations', 'Czynnosci uzytkownika', 'pl', 'yum'),
('User activation', 'User-Aktivierung', 'de', 'yum'),
('User activation', 'Activación de usuario', 'es', 'yum'),
('User activation', 'Activation du compte utilisateur', 'fr', 'yum'),
('User activation', 'Attivazione utente', 'it', 'yum'),
('User activation', 'User-Aktivierung', 'pl', 'yum'),
('User activation', 'Активация пользователя', 'ru', 'yum'),
('User administration Panel', 'Benutzerkontrollzentrum', 'de', 'yum'),
('User administration Panel', 'Panel de administración de usuario', 'es', 'yum'),
('User administration Panel', 'Centre de controle des membres', 'fr', 'yum'),
('User administration Panel', 'Pannello di controllo', 'it', 'yum'),
('User administration Panel', 'Panel zarzadzania uzytkownika', 'pl', 'yum'),
('User administration panel', 'Kontrollzentrum', 'de', 'yum'),
('User administration panel', 'Panel de administración de usuario', 'es', 'yum'),
('User administration panel', 'Centre de controle user', 'fr', 'yum'),
('User administration panel', 'Pannello di controllo', 'it', 'yum'),
('User administration panel', 'Panel zarzadzania uzytkownikiem', 'pl', 'yum'),
('User belongs to Roles', 'Benutzer gehört diesen Rollen an', 'de', 'yum'),
('User belongs to Roles', 'El usuario pertenece al los Roles', 'es', 'yum'),
('User belongs to Roles', 'Attribuer des roles a un membre', 'fr', 'yum'),
('User belongs to Roles', 'Utente appartiene a questi ruoli', 'it', 'yum'),
('User belongs to Roles', 'Uzytkownik posiada role', 'pl', 'yum'),
('User belongs to these roles', 'Benutzer gehört diesen Rollen an', 'de', 'yum'),
('User belongs to these roles', 'El usuario pertenece a estos roles', 'es', 'yum'),
('User belongs to these roles', 'Attribuer ce role a un membre', 'fr', 'yum'),
('User belongs to these roles', 'Utente appartiene a questi ruoli', 'it', 'yum'),
('User belongs to these roles', 'Uzytkownik posiada role', 'pl', 'yum'),
('User can not administer any users', 'Kann keine Benutzer verwalten', 'de', 'yum'),
('User can not administer any users', 'El usuario no puede administrar ningún usuario', 'es', 'yum'),
('User can not administer any users', 'Ne peut pas gerer les utilisateurs', 'fr', 'yum'),
('User can not administer any users', 'Impossibile gestire gli utenti', 'it', 'yum'),
('User can not administer any users', 'Uzytkownik nie moze zarzadzac zadnymi uzytkownikami', 'pl', 'yum'),
('User can not administer any users of any role', 'Kann keine Rollen verwalten', 'de', 'yum'),
('User can not administer any users of any role', 'El usuario no puede administrar ningún usuario o ningún rol', 'es', 'yum'),
('User can not administer any users of any role', 'Ne peut pas gerer les rolles', 'fr', 'yum'),
('User can not administer any users of any role', 'Impossibile gestire i ruoli', 'it', 'yum'),
('User can not administer any users of any role', 'Uzytkownik nie moze zarzadzac zadnymi rolami uzytkownikow', 'pl', 'yum'),
('User can not be found', 'Benutzer kann nicht gefunden werden', 'de', 'yum'),
('User is Online!', 'Benutzer ist Online!', 'de', 'yum'),
('User is Online!', 'El usuario est', 'es', 'yum'),
('User is Online!', 'Utilisateur en ligne!', 'fr', 'yum'),
('User is Online!', 'Utente online!', 'it', 'yum'),
('User is not active', 'Benutzer ist nicht aktiv', 'de', 'yum'),
('User module settings', 'Moduleinstellungen', 'de', 'yum'),
('User module settings', 'Ajustes del módulo de usuario', 'es', 'yum'),
('User module settings', 'Reglages du module user', 'fr', 'yum'),
('User module settings', 'Modulo impostazioni utente', 'it', 'yum'),
('User module settings', 'Ustawienia modulu uzytkownika', 'pl', 'yum'),
('Usergroups', 'Benutzergruppen', 'de', 'yum'),
('Usergroups', 'Grupos del usuario', 'es', 'yum'),
('Usergroups', 'Utilisateur des grouppes', 'fr', 'yum'),
('Usergroups', 'Gruppi utenti', 'it', 'yum'),
('Username', 'Benutzername', 'de', 'yum'),
('Username', 'Usuario', 'es', 'yum'),
('Username', 'Benutzername', 'fr', 'yum'),
('Username', 'Username', 'it', 'yum'),
('Username', 'Uzytkownik', 'pl', 'yum'),
('Username is incorrect.', 'Benutzername ist falsch.', 'de', 'yum'),
('Username is incorrect.', 'Nombre de usuario incorrecto', 'es', 'yum'),
('Username is incorrect.', 'Le nom d utilisateur est incorrect.', 'fr', 'yum'),
('Username is incorrect.', 'Username non corretto.', 'it', 'yum'),
('Username is incorrect.', 'Nazwa uzytkownika jest niepoprawna.', 'pl', 'yum'),
('Username is incorrect.', 'Пользователь с таким именем не зарегистрирован.', 'ru', 'yum'),
('Username or Email', 'Benutzername oder E-mail', 'de', 'yum'),
('Username or Email', 'Nombre de usuario o Email', 'es', 'yum'),
('Username or Email', 'Nom d utilisateur ou adresse e-mail.', 'fr', 'yum'),
('Username or Email', 'Username o email', 'it', 'yum'),
('Username or Password is incorrect', 'Benutzername oder Passwort ist falsch', 'de', 'yum'),
('Username or Password is incorrect', 'Usuario o contraseña incorrectos', 'es', 'yum'),
('Username or Password is incorrect', 'Nom d utilisateur ou mot passe incorrect', 'fr', 'yum'),
('Username or Password is incorrect', 'Username o password errato/a', 'it', 'yum'),
('Username or email', 'Benutzername oder E-Mail', 'de', 'yum'),
('Username or email', 'Nombre de usuario o correo electr', 'es', 'yum'),
('Username or email', 'Nom d utilisateur ou adresse e-mail', 'fr', 'yum'),
('Username or email', 'Username o email', 'it', 'yum'),
('Users', 'Usuarios', 'es', 'yum'),
('Users', 'Utilisateur', 'fr', 'yum'),
('Users', 'Utenti', 'it', 'yum'),
('Users', 'Пользователи', 'ru', 'yum'),
('Users:', 'Membres:', 'fr', 'yum'),
('Users:', 'Utenti:', 'it', 'yum'),
('Users:', 'Uzytkownicy:', 'pl', 'yum'),
('Users: ', 'Benutzer: ', 'de', 'yum'),
('Users: ', 'Usuarios:', 'es', 'yum'),
('Variable name', 'Variablen name', 'de', 'yum'),
('Variable name', 'Nombre de variable', 'es', 'yum'),
('Variable name', 'Nom de la variable', 'fr', 'yum'),
('Variable name', 'Nome variabile', 'it', 'yum'),
('Variable name', 'Имя переменной', 'ru', 'yum'),
('Verification Code', 'Codice verifica', 'it', 'yum'),
('Verification Code', 'Kod weryfikujacy', 'pl', 'yum'),
('Verification Code', 'Проверочный код', 'ru', 'yum'),
('Verification code', 'Verifizierung', 'de', 'yum'),
('Verification code', 'Código de verificación', 'es', 'yum'),
('Verification code', 'Code de verification', 'fr', 'yum'),
('Verification code', 'Codice verifica', 'it', 'yum'),
('View', 'Anzeigen', 'de', 'yum'),
('View', 'Ver', 'es', 'yum'),
('View', 'Editer', 'fr', 'yum'),
('View', 'Visualizza', 'it', 'yum'),
('View', 'Polaz', 'pl', 'yum'),
('View Details', 'Zur Gruppe', 'de', 'yum'),
('View Details', 'Ver detalles', 'es', 'yum'),
('View Details', 'Mostra dettagli', 'it', 'yum'),
('View Profile Field', 'Mostra campo Profilo', 'it', 'yum'),
('View Profile Field', 'Просмотр', 'ru', 'yum'),
('View Profile Field #', 'Mostra # campo Profilo', 'it', 'yum'),
('View Profile Field #', 'Поле профиля #', 'ru', 'yum'),
('View User', 'Benutzer anzeigen', 'de', 'yum'),
('View User', 'Ver Usuario', 'es', 'yum'),
('View User', 'Consulter le profil du membre', 'fr', 'yum'),
('View User', 'Mostra utente', 'it', 'yum'),
('View User', 'Просмотр профиля', 'ru', 'yum'),
('View admin messages', 'Administratornachrichten anzeigen', 'de', 'yum'),
('View admin messages', 'Ver mensajes de admin', 'es', 'yum'),
('View admin messages', 'Voir les messages de l administateur', 'fr', 'yum'),
('View admin messages', 'Visualizza messaggi amministratore', 'it', 'yum'),
('View admin messages', 'Pokaz wiadomosci administratora', 'pl', 'yum'),
('View my messages', 'Meine Nachrichten ansehen', 'de', 'yum'),
('View my messages', 'Ver mis mensajes', 'es', 'yum'),
('View my messages', 'Voir mes messages', 'fr', 'yum'),
('View my messages', 'Visualizza messaggi', 'it', 'yum'),
('View my messages', 'Wyswietl moje wiadomosci', 'pl', 'yum'),
('View user "{username}"', 'Benutzer "{username}"', 'de', 'yum'),
('View user "{username}"', 'Ver usuario "{username}"', 'es', 'yum'),
('View user &quot;{username}&quot;', 'Membre "{username}"', 'fr', 'yum'),
('View user &quot;{username}&quot;', 'Visualizza utente "{username}"', 'it', 'yum'),
('View user &quot;{username}&quot;', 'Uzytkownik "{username}"', 'pl', 'yum'),
('View users', 'Benutzer anzeigen', 'de', 'yum'),
('View users', 'Ver usuarios', 'es', 'yum'),
('View users', 'Montrer les utilisateurs', 'fr', 'yum'),
('View users', 'Visualizza utenti', 'it', 'yum'),
('View users', 'Pokaz uzytkownika', 'pl', 'yum'),
('Visible', 'Sichtbar', 'de', 'yum'),
('Visible', 'Visible', 'es', 'yum'),
('Visible', 'Visible', 'fr', 'yum'),
('Visible', 'Visibile', 'it', 'yum'),
('Visible', 'Видимость', 'ru', 'yum'),
('Visit profile', 'Profil besuchen', 'de', 'yum'),
('Visit profile', 'Ver el perfil', 'es', 'yum'),
('Visit profile', 'Visiter le profil', 'fr', 'yum'),
('Visit profile', 'Visita profilo', 'it', 'yum'),
('When selecting searchable, users of this role can be searched in the "user Browse" function', 'Wenn "suchbar" ausgewählt wird, kann man Nutzer dieser Rolle in der "Benutzer durchsuchen"-Funktion suchen', 'de', 'yum'),
('When selecting searchable, users of this role can be searched in the "user Browse" function', 'Al seleccionar b', 'es', 'yum'),
('When selecting searchable, users of this role can be searched in the &quot;user Browse&quot; function', 'Si le status de "visible" est choisi, un membre de ce role pourra apparaitre dans les resultats d une recherche', 'fr', 'yum'),
('When selecting searchable, users of this role can be searched in the &quot;user Browse&quot; function', 'Quando selezioni "Ricercabile", gli utenti di questo ruolo sono ricercabili nella funzione "Browser utenti"', 'it', 'yum'),
('When the membership expires', 'Wenn die Mitgliedschaft abläuft', 'de', 'yum'),
('Write a comment', 'Kommentar hinterlassen', 'de', 'yum'),
('Write a comment', 'Escribir un comentario', 'es', 'yum'),
('Write a comment', 'Laisser un commentaire', 'fr', 'yum'),
('Write a comment', 'Scrivi commento', 'it', 'yum'),
('Write a message', 'Nachricht schreiben', 'de', 'yum'),
('Write a message', 'Escribir un mensaje', 'es', 'yum'),
('Write a message', 'Ecrire un message', 'fr', 'yum'),
('Write a message', 'Scrivi messaggio', 'it', 'yum'),
('Write a message', 'Napisz wiadomosc', 'pl', 'yum'),
('Write a message to this User', 'Diesem Benutzer eine Nachricht schreiben', 'de', 'yum'),
('Write a message to this User', 'Escribir un mensaje a este Usuario', 'es', 'yum'),
('Write a message to this User', 'Ecrire un message a ce membre', 'fr', 'yum'),
('Write a message to this User', 'Scrivi messaggio a questo utente', 'it', 'yum'),
('Write a message to {username}', 'Nachricht an {username} schreiben', 'de', 'yum'),
('Write a message to {username}', 'Escribir un mensaje a {username}', 'es', 'yum'),
('Write a message to {username}', 'Message ecrire a {username}', 'fr', 'yum'),
('Write a message to {username}', 'Scrivi messaggio a {username}', 'it', 'yum'),
('Write another message', 'Eine weitere Nachricht schreiben', 'de', 'yum'),
('Write another message', 'Escribir otro mensaje', 'es', 'yum'),
('Write another message', 'Ecrire un autre message', 'fr', 'yum'),
('Write another message', 'Scrivi un''altro messaggio', 'it', 'yum'),
('Write another message', 'Eine weitere Nachricht schreiben', 'pl', 'yum'),
('Write comment', 'Kommentar schreiben', 'de', 'yum'),
('Write comment', 'Escribir comentario', 'es', 'yum'),
('Write comment', 'Ecrire un commentaire', 'fr', 'yum'),
('Write comment', 'Scrivi commento', 'it', 'yum'),
('Write message', 'Nachricht schreiben', 'de', 'yum'),
('Write message', 'Escribir un mensaje', 'es', 'yum'),
('Written at', 'Geschrieben am', 'de', 'yum'),
('Written at', 'Escrito el', 'es', 'yum'),
('Written at', 'Ecrit le', 'fr', 'yum'),
('Written at', 'Scritto a', 'it', 'yum'),
('Written from', 'Geschrieben von', 'de', 'yum'),
('Written from', 'Escrito por', 'es', 'yum'),
('Written from', 'Ecrit par', 'fr', 'yum'),
('Written from', 'Scritto da', 'it', 'yum'),
('Wrong password confirmation! Account was not deleted', 'Falsches Bestätigugspasswort! Zugang wurde nicht gelöscht', 'de', 'yum'),
('Wrong password confirmation! Account was not deleted', '¡Contraseña para confirmación incorrecta! Lacuenta no ha sido eliminada', 'es', 'yum'),
('Wrong password confirmation! Account was not deleted', 'Confirmation incorrecte! Le compte n a pas ete supprime', 'fr', 'yum'),
('Wrong password confirmation! Account was not deleted', 'Password id oconferma errata! Account non cancellato', 'it', 'yum'),
('Wrong password confirmation! Account was not deleted', 'Niepoprawne haslo! Konto nie zostalo usuniete', 'pl', 'yum'),
('Yes', 'Ja', 'de', 'yum'),
('Yes', 'Sí', 'es', 'yum'),
('Yes', 'Oui', 'fr', 'yum'),
('Yes', 'Si', 'it', 'yum'),
('Yes', 'Ja', 'pl', 'yum'),
('Yes', 'Да', 'ru', 'yum'),
('Yes and show on registration form', 'Ja, und auf Registrierungsseite anzeigen', 'de', 'yum');
INSERT INTO `translation` (`message`, `translation`, `language`, `category`) VALUES
('Yes and show on registration form', 'Si y mostrar en formulario de registro', 'es', 'yum'),
('Yes and show on registration form', 'oui et charger le formulaire d inscription', 'fr', 'yum'),
('Yes and show on registration form', 'Si e mostra nel form di registrazione', 'it', 'yum'),
('Yes and show on registration form', 'Tak i pokaz w formularzu rejestracji', 'pl', 'yum'),
('Yes and show on registration form', 'Да и показать при регистрации', 'ru', 'yum'),
('Yii-user-management is already installed. Please remove it manually to continue', 'Yii-user-management ist bereits installiert. Bitte löschen Sie es manuell, um fortzufahren', 'de', 'yum'),
('You account is activated.', 'Ihr Konto wurde aktiviert.', 'de', 'yum'),
('You account is activated.', 'Su cuenta está activada.', 'es', 'yum'),
('You account is activated.', 'Votre compte a bien ete active.', 'fr', 'yum'),
('You account is activated.', 'Account attivato', 'it', 'yum'),
('You account is activated.', 'Ihr Konto wurde aktiviert.', 'pl', 'yum'),
('You account is activated.', 'Ваша учетная запись активирована.', 'ru', 'yum'),
('You account is active.', 'Ihr Konto ist aktiv.', 'de', 'yum'),
('You account is active.', 'Su cuenta está activa.', 'es', 'yum'),
('You account is active.', 'Votre compte est actif.', 'fr', 'yum'),
('You account is active.', 'Account attivo', 'it', 'yum'),
('You account is active.', 'Ihr Konto ist aktiv.', 'pl', 'yum'),
('You account is active.', 'Ваша учетная запись уже активирована.', 'ru', 'yum'),
('You account is blocked.', 'Account bloccato', 'it', 'yum'),
('You account is blocked.', 'Ваш аккаунт заблокирован.', 'ru', 'yum'),
('You account is not activated.', 'Account non attivo', 'it', 'yum'),
('You account is not activated.', 'Ваш аккаунт не активирован.', 'ru', 'yum'),
('You already are friends', 'Ihr seid bereits Freunde', 'de', 'yum'),
('You already are friends', 'Ya son amigos', 'es', 'yum'),
('You already are friends', 'Ce membre figure deja dans votre liste de contact', 'fr', 'yum'),
('You already are friends', 'Siete gia in contatto', 'it', 'yum'),
('You are not allowed to view this profile.', 'Sie dürfen dieses Profil nicht ansehen.', 'de', 'yum'),
('You are not allowed to view this profile.', 'No tiene permiso para ver este perfil.', 'es', 'yum'),
('You are not allowed to view this profile.', 'VOus ne pouvez pas consulter ce profil.', 'fr', 'yum'),
('You are not allowed to view this profile.', 'Non puoi vedere questo profilo.', 'it', 'yum'),
('You are not allowed to view this profile.', 'Nie masz uprawnie do przegladania tego profilu', 'pl', 'yum'),
('You are running the Yii User Management Module {version} in Debug Mode!', 'Dies ist das Yii-User-Management Modul in Version {version} im Debug Modus!', 'de', 'yum'),
('You are running the Yii User Management Module {version} in Debug Mode!', '¡Está ejecutando el Módulo de Administración de Usuarios Yii {version} en modo de depuración!', 'es', 'yum'),
('You are running the Yii User Management Module {version} in Debug Mode!', 'Dies ist das Yii-User-Management Modul in Version {version} im Debug Modus!', 'fr', 'yum'),
('You are running the Yii User Management Module {version} in Debug Mode!', 'Questo e il modulo di YUM versione {version} in modalita debug!', 'it', 'yum'),
('You are running the Yii User Management Module {version} in Debug Mode!', 'Uruchamiasz modul Yii User Management Modul, wersja {version}, w trybie DEBUG!', 'pl', 'yum'),
('You can also login by', 'Anmeldung auch möglich über', 'de', 'yum'),
('You do not have any friends yet', 'Ihre Kontaktliste ist leer', 'de', 'yum'),
('You do not have any friends yet', 'No tienes ningún amigo todavía', 'es', 'yum'),
('You do not have any friends yet', 'Votre liste de contact est vide', 'fr', 'yum'),
('You do not have any friends yet', 'Lista contatti vuota', 'it', 'yum'),
('You do not have set an avatar image yet', 'Es wurde noch kein Profilbild hochgeladen', 'de', 'yum'),
('You do not have set an avatar image yet', 'Aún no has subido tu imágen de Avatar', 'es', 'yum'),
('You do not have set an avatar image yet', 'Aucune photo de votre profil disponible', 'fr', 'yum'),
('You do not have set an avatar image yet', 'Non hai settato un''avatar', 'it', 'yum'),
('You have joined this group', 'Sie sind dieser Gruppe beigetreten', 'de', 'yum'),
('You have joined this group', 'Te has unido a este grupo', 'es', 'yum'),
('You have left this group', 'Du hast diese Gruppe verlassen', 'de', 'yum'),
('You have new Messages !', 'Sie haben neue Nachrichten !', 'de', 'yum'),
('You have new Messages !', '¡Tienes Mensajes nuevos!', 'es', 'yum'),
('You have new Messages !', 'Vous avez de nouveaux messages !', 'fr', 'yum'),
('You have new Messages !', 'Hai un nuovo messaggio!', 'it', 'yum'),
('You have new messages!', 'Sie haben neue Nachrichten!', 'de', 'yum'),
('You have new messages!', '¡Tienes mensajes nuevos!', 'es', 'yum'),
('You have new messages!', 'Vous n avez pas de messages!', 'fr', 'yum'),
('You have new messages!', 'Hai un nuovo messaggio!', 'it', 'yum'),
('You have new messages!', 'Masz nowa wiadomosc!', 'pl', 'yum'),
('You have no messages yet', 'Sie haben bisher noch keine Nachrichten', 'de', 'yum'),
('You have no messages yet', 'Usted no tiene mensajes a', 'es', 'yum'),
('You have no messages yet', 'Aucun message recent', 'fr', 'yum'),
('You have no messages yet', 'Non hai messaggi', 'it', 'yum'),
('You have {count} new Messages !', 'Sie haben {count} neue Nachricht(en)!', 'de', 'yum'),
('You have {count} new Messages !', '¡Tienes {count} mensajes nuevos!', 'es', 'yum'),
('You have {count} new Messages !', 'Vous avez {count} nouveau(x) message(s)!', 'fr', 'yum'),
('You have {count} new Messages !', 'Hai {count} nuovi messaggi!', 'it', 'yum'),
('You have {count} new Messages !', 'Masz {count} nowych wiadomosci !', 'pl', 'yum'),
('You registered from {site_name}', 'Sei registrato su {site_name}', 'it', 'yum'),
('Your Account has been activated. Thank you for your registration', 'Ihr Zugang wurde aktiviert. Danke für die Registierung', 'de', 'yum'),
('Your Account has been activated. Thank you for your registration', 'Su cuenta ha sido activada. Gracias por su inscripci', 'es', 'yum'),
('Your Account has been activated. Thank you for your registration.', 'Votre compte a bien ete active. Merci pour votre inscription.', 'fr', 'yum'),
('Your Account has been activated. Thank you for your registration.', 'Il tuo account e stato attivato. Grazie per la tua registrazione', 'it', 'yum'),
('Your Avatar image', 'Ihr Avatar-Bild', 'de', 'yum'),
('Your Avatar image', 'Tu imagen de Avatar', 'es', 'yum'),
('Your Avatar image', 'Votre image de profil', 'fr', 'yum'),
('Your Avatar image', 'Il tuo avatar', 'it', 'yum'),
('Your Message has been sent.', 'El Mensaje ha sido enviado.', 'es', 'yum'),
('Your Message has been sent.', 'Votre message a ete envoye.', 'fr', 'yum'),
('Your Message has been sent.', 'Messaggio inviato.', 'it', 'yum'),
('Your account has been activated.', 'Tu cuenta ha sido activada.', 'es', 'yum'),
('Your account has been activated. Thank you for your registration', 'Ihr Zugang wurde aktiviert. Danke für ihre Registrierung', 'de', 'yum'),
('Your account has been activated. Thank you for your registration', 'Su cuenta ha sido activada. Gracias por su inscripci', 'es', 'yum'),
('Your account has been activated. Thank you for your registration', 'VOtre compte est maintenant actif. Merci de vous etre enregistre', 'fr', 'yum'),
('Your account has been activated. Thank you for your registration', 'Il tuo account e stato attivato. Grazie per esserti registrato', 'it', 'yum'),
('Your account has been activated. Thank you for your registration.', 'Tu cuenta ha sido activada. Gracias por registrarte.', 'es', 'yum'),
('Your account has been activated. Thank you for your registration.', 'Twoje konto zostalo aktywowane. Dziekujemy za rejestracje.', 'pl', 'yum'),
('Your account has been deleted.', 'Ihr Zugang wurde gelöscht', 'de', 'yum'),
('Your account has been deleted.', ' Su cuenta ha sido borrada.', 'es', 'yum'),
('Your account has been deleted.', 'Votre compte a bien ete supprime', 'fr', 'yum'),
('Your account has been deleted.', 'Il tuo account e stato cancellato.', 'it', 'yum'),
('Your activation succeeded', 'Ihre Aktivierung war erfolgreich', 'de', 'yum'),
('Your activation succeeded', '', 'es', 'yum'),
('Your activation succeeded', 'Votre compte a ete active', 'fr', 'yum'),
('Your activation succeeded', 'Attivazione riuscita', 'it', 'yum'),
('Your changes have been saved', 'Ihre Änderungen wurden gespeichert', 'de', 'yum'),
('Your changes have been saved', 'Los cambios han sido guardados', 'es', 'yum'),
('Your changes have been saved', 'Vos modification ont ete memorisees', 'fr', 'yum'),
('Your changes have been saved', 'Le modifiche sono state salvate', 'it', 'yum'),
('Your changes have been saved', 'Twoje zmiany zostaly zapisane', 'pl', 'yum'),
('Your current password', 'Ihr aktuelles Passwort', 'de', 'yum'),
('Your current password', 'Su contrase', 'es', 'yum'),
('Your current password', 'Votre mot de passe actuel', 'fr', 'yum'),
('Your current password', 'La tua password corrente', 'it', 'yum'),
('Your current password is not correct', 'Ihr aktuelles Passwort ist nicht korrekt', 'de', 'yum'),
('Your current password is not correct', 'Su contrase', 'es', 'yum'),
('Your current password is not correct', 'Votre mot de passe actuel n est pas correct', 'fr', 'yum'),
('Your current password is not correct', 'La tua password corrente non e corretta', 'it', 'yum'),
('Your friendship request has been accepted', 'Ihre Freundschaftsanfrage wurde akzeptiert', 'de', 'yum'),
('Your friendship request has been accepted', 'Su solicitud de amistad ha sido aceptada', 'es', 'yum'),
('Your friendship request has been accepted', 'Votre demande de contact a bien ete acceptee', 'fr', 'yum'),
('Your friendship request has been accepted', 'La richiesta di contatto e stata accettata', 'it', 'yum'),
('Your message has been sent', 'Ihre Nachricht wurde gesendet', 'de', 'yum'),
('Your message has been sent', 'El mensaje ha sido enviado', 'es', 'yum'),
('Your message has been sent', 'Votre message a bien ete envoye', 'fr', 'yum'),
('Your message has been sent', 'Il tuo messaggio e stato inviato.', 'it', 'yum'),
('Your message has been sent', 'Twoja wiadomosc zostala wyslana', 'pl', 'yum'),
('Your new password has been saved.', 'Ihr Passwort wurde gespeichert.', 'de', 'yum'),
('Your new password has been saved.', 'La nueva contraseña ha sido guardada.', 'es', 'yum'),
('Your new password has been saved.', 'La modification de votre mot de passe a bien ete memorise.', 'fr', 'yum'),
('Your new password has been saved.', 'La nuova password e stata salvata.', 'it', 'yum'),
('Your new password has been saved.', 'Twoje nowe haslo zostalo zapisane.', 'pl', 'yum'),
('Your password has expired. Please enter your new Password below:', 'Ihr Passwort ist abgelaufen. Bitte geben Sie ein neues Passwort an:', 'de', 'yum'),
('Your password has expired. Please enter your new Password below:', 'La contraseña ha expirado. Por favor escribe una contraseña nueva abajo:', 'es', 'yum'),
('Your password has expired. Please enter your new Password below:', 'La duree de vie de votre mot de passe est arrivee a echeance. Veuillez en definir un nouveau:', 'fr', 'yum'),
('Your password has expired. Please enter your new Password below:', 'La password e scaduta. Si prega di inserire una nuova password:', 'it', 'yum'),
('Your privacy settings have been saved', 'Ihre Privatsphären-einstellungen wurden gespeichert', 'de', 'yum'),
('Your privacy settings have been saved', 'Sus opciones de privacidad se han salvado', 'es', 'yum'),
('Your privacy settings have been saved', 'La configuration de vos donnees privees a bien ete enregistree', 'fr', 'yum'),
('Your privacy settings have been saved', 'Le tue opzioni Privacy sono state salvate', 'it', 'yum'),
('Your profile', 'Ihr Profil', 'de', 'yum'),
('Your profile', 'Tu perfil', 'es', 'yum'),
('Your profile', 'Ihr Profil', 'fr', 'yum'),
('Your profile', 'Il tuo profilo', 'it', 'yum'),
('Your profile', 'Ihr Profil', 'pl', 'yum'),
('Your profile', 'Ваш профиль', 'ru', 'yum'),
('Your registration didn''t work. Please try another E-Mail address. If this problem persists, please contact our System Administrator. ', 'Tu proceso de registro falló. Por favor intenta con otra cuenta de correo. Si el problema persiste por favor contáctanos.', 'es', 'yum'),
('Your request succeeded. Please enter below your new password:', 'Tu solicitud fué exitosa. Por favor, escribe a continuación tu nueva contraseña:', 'es', 'yum'),
('Your subscription setting has been saved', 'Ihre Einstellungen wurden gespeichert', 'de', 'yum'),
('about', 'information me concernant', 'fr', 'yum'),
('about', 'Informazioni su', 'it', 'yum'),
('activation key', 'Aktivierungsschlüssel', 'de', 'yum'),
('activation key', 'clave de activación', 'es', 'yum'),
('activation key', 'Cle d activation de votre compte', 'fr', 'yum'),
('activation key', 'chiave di attivazione', 'it', 'yum'),
('activation key', 'Aktivierungsschlussel', 'pl', 'yum'),
('activation key', 'Ключ активации', 'ru', 'yum'),
('birthdate', 'Geburtstag', 'de', 'yum'),
('birthdate', 'fecha de nacimiento', 'es', 'yum'),
('birthdate', 'anniversaire', 'fr', 'yum'),
('birthdate', 'Compleanno', 'it', 'yum'),
('birthday', 'Geburtstag', 'de', 'yum'),
('birthday', 'cumplea', 'es', 'yum'),
('birthday', 'date de naissance', 'fr', 'yum'),
('birthday', 'Compleanno', 'it', 'yum'),
('change Password', 'Passwort ändern', 'de', 'yum'),
('change Password', 'cambiar Contraseña', 'es', 'yum'),
('change Password', 'Changer le mot de passe', 'fr', 'yum'),
('change Password', 'Zmien haslo', 'pl', 'yum'),
('change password', 'Passwort ändern', 'de', 'yum'),
('change password', 'cambiar contraseña', 'es', 'yum'),
('change password', 'Modifier le mot de passe', 'fr', 'yum'),
('change password', 'Cambia password', 'it', 'yum'),
('do not make my friends public', 'Meine Kontakte nicht veröffentlichen', 'de', 'yum'),
('do not make my friends public', 'no hacer mis amigos p', 'es', 'yum'),
('do not make my friends public', 'Ne pas rendre publique la liste de mes contacts', 'fr', 'yum'),
('do not make my friends public', 'Non mostrare i miei contatti pubblicamente', 'it', 'yum'),
('email', 'E-Mail', 'de', 'yum'),
('email', 'correo', 'es', 'yum'),
('email', 'e-Mail', 'fr', 'yum'),
('email', 'email', 'it', 'yum'),
('email', 'mejl', 'pl', 'yum'),
('email address', 'correo electrónico', 'es', 'yum'),
('email address', 'Adres mejlowy', 'pl', 'yum'),
('firstname', 'Vorname', 'de', 'yum'),
('firstname', 'primer nombre', 'es', 'yum'),
('firstname', 'prenom', 'fr', 'yum'),
('firstname', 'Cognome', 'it', 'yum'),
('friends only', 'Nur Freunde', 'de', 'yum'),
('friends only', 'sólo amigos', 'es', 'yum'),
('friends only', 'A mes contacts seulement', 'fr', 'yum'),
('friends only', 'Solo contatti', 'it', 'yum'),
('lastname', 'Nachname', 'de', 'yum'),
('lastname', 'apellido', 'es', 'yum'),
('lastname', 'nom de famille', 'fr', 'yum'),
('lastname', 'Nome', 'it', 'yum'),
('make my friends public', 'Meine Kontakte veröffentlichen', 'de', 'yum'),
('make my friends public', 'hacer mi amigos p', 'es', 'yum'),
('make my friends public', 'Rendre visibles mes contacts', 'fr', 'yum'),
('make my friends public', 'Rendi pubblici i miei contatti', 'it', 'yum'),
('no', 'Nein', 'de', 'yum'),
('no', 'no', 'es', 'yum'),
('no', 'Non', 'fr', 'yum'),
('no', 'No', 'it', 'yum'),
('of user', 'von Benutzer', 'de', 'yum'),
('of user', 'de usuario', 'es', 'yum'),
('of user', 'de l utilisateur', 'fr', 'yum'),
('of user', 'dell''utente', 'it', 'yum'),
('only to my friends', 'Nur an meine Freunde veröffentlichen', 'de', 'yum'),
('only to my friends', 's', 'es', 'yum'),
('only to my friends', 'Visible seulement pour mes contacts', 'fr', 'yum'),
('only to my friends', 'solamente ai miei contatti', 'it', 'yum'),
('password', 'Passwort', 'de', 'yum'),
('password', 'contraseña', 'es', 'yum'),
('password', 'mot de passe', 'fr', 'yum'),
('password', 'password', 'it', 'yum'),
('password', 'hadlo', 'pl', 'yum'),
('password', 'Пароль', 'ru', 'yum'),
('private', 'Privat', 'de', 'yum'),
('private', 'privado', 'es', 'yum'),
('private', 'Prive', 'fr', 'yum'),
('private', 'Privato', 'it', 'yum'),
('private', 'prywatny', 'pl', 'yum'),
('protected', 'Geschützt', 'de', 'yum'),
('protected', 'protegido', 'es', 'yum'),
('protected', 'Protege', 'fr', 'yum'),
('protected', 'Protetto', 'it', 'yum'),
('protected', 'chroniony', 'pl', 'yum'),
('public', 'Öffentlich', 'de', 'yum'),
('public', 'público', 'es', 'yum'),
('public', 'Publique', 'fr', 'yum'),
('public', 'Pubblico', 'it', 'yum'),
('public', 'publiczny', 'pl', 'yum'),
('street', 'rue', 'fr', 'yum'),
('street', 'Indirizzo', 'it', 'yum'),
('timestamp', 'Zeitstempel', 'de', 'yum'),
('timestamp', 'marca de tiempo', 'es', 'yum'),
('timestamp', 'tempon de date et heure', 'fr', 'yum'),
('timestamp', 'timestamp', 'it', 'yum'),
('username', 'Benutzername', 'de', 'yum'),
('username', 'usuario', 'es', 'yum'),
('username', 'nom d utilisateur', 'fr', 'yum'),
('username', 'username', 'it', 'yum'),
('username', 'nazwa uzytkownika', 'pl', 'yum'),
('username', 'Логин', 'ru', 'yum'),
('username or email', 'Benutzername oder E-Mail Adresse', 'de', 'yum'),
('username or email', 'nombre de usuario o email', 'es', 'yum'),
('username or email', 'nom d utilisateur ou adresse e-mail', 'fr', 'yum'),
('username or email', 'username or email', 'it', 'yum'),
('username or email', 'nazwa uzytkowniak lub mejl', 'pl', 'yum'),
('username or email', 'Логин или email', 'ru', 'yum'),
('verifyPassword', 'Passwort wiederholen', 'de', 'yum'),
('verifyPassword', 'verifique su contrase', 'es', 'yum'),
('yes', 'Ja, diese Daten veröffentlichen', 'de', 'yum'),
('yes', 's', 'es', 'yum'),
('yes', 'Oui, rendre publique ces donnees', 'fr', 'yum'),
('yes', 'Si', 'it', 'yum'),
('zipcode', 'Postleitzahl', 'de', 'yum'),
('zipcode', 'c', 'es', 'yum'),
('zipcode', 'code postal', 'fr', 'yum'),
('zipcode', 'CAP', 'it', 'yum'),
('{attribute} is too long (max. {num} characters).', '{attribute} es muy larga (max. {num} caracteres).', 'es', 'yum'),
('{attribute} is too long (max. {num} characters).', '{attribute} troppo lungo (max. {num} caratteri).', 'it', 'yum'),
('{attribute} is too long (max. {num} characters).', '{attribute} jest zbyt dlugi (max. {num} znakow).', 'pl', 'yum'),
('{attribute} is too short (min. {num} characters).', '{attribute} es muy corta (min. {num} caracteres).', 'es', 'yum'),
('{attribute} is too short (min. {num} characters).', '{attribute} troppo corto (min. {num} caratteri).', 'it', 'yum'),
('{attribute} is too short (min. {num} characters).', '{attribute} jest zbyt krotki (min. {num} znakow).', 'pl', 'yum'),
('{attribute} must include at least {num} digits.', '{attribute} debe tener al menos {num} dígitos.', 'es', 'yum'),
('{attribute} must include at least {num} digits.', '{attribute}deve includere almeno {num} numeri.', 'it', 'yum'),
('{attribute} must include at least {num} digits.', '{attribute} musi zawierac co najmniej {num} cyfr.', 'pl', 'yum'),
('{attribute} must include at least {num} lower case letters.', '{attribute} debe tener al menos {num} caracteres en minúscula.', 'es', 'yum'),
('{attribute} must include at least {num} lower case letters.', '{attribute} deve includere almeno {num} lettere minuscole.', 'it', 'yum'),
('{attribute} must include at least {num} lower case letters.', '{attribute} musi zawierac co najmniej {num} malych liter.', 'pl', 'yum'),
('{attribute} must include at least {num} symbols.', '{attribute} debe tener al menos {num} símbolos.', 'es', 'yum'),
('{attribute} must include at least {num} symbols.', '{attribute} deve includere almeno {num} simboli.', 'it', 'yum'),
('{attribute} must include at least {num} symbols.', '{attribute} musi zawierac co najmniej {num} symboli.', 'pl', 'yum'),
('{attribute} must include at least {num} upper case letters.', '{attribute} debe tener al menos {num} caracteres en mayúscula.', 'es', 'yum'),
('{attribute} must include at least {num} upper case letters.', '{attribute} deve includere almeno {num} lettere maiuscole.', 'it', 'yum'),
('{attribute} must include at least {num} upper case letters.', '{attribute} musi zawierac co najmniej {num} duzych liter.', 'pl', 'yum'),
('{attribute} must not contain more than {num} sequentially repeated characters.', '{attribute} no debe tener más de {num} caracteres repetidos secuencialmente.', 'es', 'yum'),
('{attribute} must not contain more than {num} sequentially repeated characters.', '{attribute} non deve contenere {num} caratteri ripetuti sequenzialmente.', 'it', 'yum'),
('{attribute} must not contain more than {num} sequentially repeated characters.', '{attribute} nie moze zawierac wiecej niz {num} sekwencji znakow.', 'pl', 'yum'),
('{attribute} must not contain whitespace.', '{attribute} no debe contener espacios.', 'es', 'yum'),
('{attribute} must not contain whitespace.', '{attribute} non deve contenere spazi.', 'it', 'yum'),
('{attribute} must not contain whitespace.', '{attribute} nie moze zawierac bialych znakow.', 'pl', 'yum');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tree`
--

CREATE TABLE IF NOT EXISTS `tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT NULL,
  `title` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` int(2) NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_parent` (`id_parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `tree`
--

INSERT INTO `tree` (`id`, `id_parent`, `title`, `position`, `url`, `icon`, `model`) VALUES
(1, 0, 'root', 0, '', NULL, 'root'),
(2, 1, 'kontakte', 2, '/kontacts/kontakt/index', 'Dokumente24', 'kontakte'),
(3, 1, 'Dokumente', 3, '/dokumente/dokumente/index', 'Dokumente24', 'dokumente'),
(4, 3, 'Eingang', 1, '/kontacts/kontakt/index', NULL, 'dokumente'),
(5, 3, 'Postausgang', 2, '/kontacts/kontakt/index', NULL, 'dokumente'),
(6, 4, 'mp3', 1, '/dokumente/dokumente/index', NULL, 'dokumente'),
(7, 4, 'avi', 2, '/dokumente/dokumente/index', NULL, 'dokumente'),
(8, 5, 'Wohnung', 1, '/wwswohnung/index', NULL, 'dokumente'),
(9, 8, 'Mietverträge', 1, '/wwswohnung/index', NULL, 'dokumente');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(128) NOT NULL,
  `activationKey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lastvisit` int(11) NOT NULL DEFAULT '0',
  `lastaction` int(11) NOT NULL DEFAULT '0',
  `lastpasswordchange` int(11) NOT NULL DEFAULT '0',
  `failedloginattempts` int(11) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `notifyType` enum('None','Digest','Instant','Threshold') DEFAULT 'Instant',
  PRIMARY KEY (`id`)

) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `salt`, `activationKey`, `createtime`, `lastvisit`, `lastaction`, `lastpasswordchange`, `failedloginattempts`, `superuser`, `status`, `avatar`, `notifyType`) VALUES
(1, 'admin', '64200edb5b42ed2eeddc7f920f58e627add0645e5b8acbe377370b027a3d3533ec9f8fdd632f38fb7bef8b4f236b3dbf42a614ddb0f1573ae13cfc3cf3992d9e', 'XhfJ59V13n03oqz3HAKTk75K/ceLenW9HaLkc31hUBHGlYKRKAdxGhGl95u44hPEkqZF+Uq5728X18Ob6hUUUQ==', '', 1368901768, 1373132627, 1370272199, 0, 0, 1, 1, NULL, 'Instant'),
(2, 'demo', '6ff9ef1b7e8cb48dba7e028da6595206668526a116a38754e95a2671910f1eaa033a87d70f9f0aeccd76d75918ce1e4c938945c8083af7b81a4a018e55b97c95', 'UotQN6nBonywNP1QffHCgEO5PICnmkNHhk9Xli010gdr7bYrWEu3tuzC07A59K4QK2XRvWUfg7BWIG6JS31l7A==', '', 1368901768, 0, 0, 0, 0, 0, 1, NULL, 'Instant'),
(3, 'asd', 'db29560b74acccbdd543afa3fbcefddd02ab2fa7d0dbad20e7277477f01ad56642d9c0ee61a357c20b1ff714776228a39a2a28a52f05fda5d18add4e2cef391b', 'FYo/Zpo1Xv1XyKKeEPqsxaRmDWfLdqfnF4aTzRyLB0Cw7RL4QQ4YnXrXz4Kt0uJUrwr15y4B8KSm2fbkaiabuQ==', '7b7f291e90811bd3d0bd7b6cafb19a567839af3f377489e482b9f2b1c38905aff059d3eed1bcad3a0e0fc4d15ea6f3b83e3bd82a354f2bacf8c0c3958209fd58', 1369014109, 1370552994, 1370553016, 1369336536, 0, 0, 1, NULL, 'Instant'),
(4, 'towebleader', 'ef370232d19da5e298acb194f3ad07199f013063afa5a8a8aef64926a1b7cbc29ed0bb1de8a817ee0b0d32eb01862902b378ffb9ea0a93e328342c928b99a8b6', 'UY16WPGiUnTogh0AZ4kXUtTgaxIczjPWpmQovtkrkFQu7SDK5c8gu2fPvP7hzi4TZOVApOgDX6DMobFauqURvw==', '81e6ddec83ddd816bca7a56e55f8ad67b18462143ecdea5abf9d3ea6e473d509e0dbe922bab433eb3ffc9b81347cd2ad600e7b4ae780d565765e3bc8c364bafa', 1369349815, 0, 0, 1369349815, 0, 0, 1, NULL, 'Instant');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `usergroup`
--

CREATE TABLE IF NOT EXISTS `usergroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `participants` text,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `usergroup`
--

INSERT INTO `usergroup` (`id`, `owner_id`, `participants`, `title`, `description`) VALUES
(1, 3, '["3"]', 'developer', 'werer'),
(2, 3, '["3"]', 'dev_modulKontakte', 'Entwickler für modul Kontakte');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_group_message`
--

CREATE TABLE IF NOT EXISTS `user_group_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  `createtime` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `user_group_message`
--

INSERT INTO `user_group_message` (`id`, `author_id`, `group_id`, `createtime`, `title`, `message`) VALUES
(1, 3, 1, 1369349534, 'sdfdsf', 'sdfdf'),
(2, 3, 1, 1369349605, 'Re:  sdfdsf', 'eefsf');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 3),
(3, 5),
(4, 1),
(4, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_usergroup`
--

CREATE TABLE IF NOT EXISTS `user_usergroup` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `jointime` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user_usergroup`
--

INSERT INTO `user_usergroup` (`user_id`, `group_id`, `jointime`) VALUES
(2, 1, 1305281400),
(2, 2, 1305282762);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vorgang`
--

CREATE TABLE IF NOT EXISTS `vorgang` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `art_id` bigint(20) NOT NULL,
  `worklow_id` bigint(20) DEFAULT NULL,
  `art` varchar(30) NOT NULL COMMENT 'art ist tabellenname',
  `name` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  `startdatum` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `enddatum` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(10) unsigned NOT NULL,
  `bemerkung` text,
  `erfass_datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `worklow_id` (`worklow_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `vorgang`
--

INSERT INTO `vorgang` (`id`, `art_id`, `worklow_id`, `art`, `name`, `status`, `startdatum`, `enddatum`, `user_id`, `bemerkung`, `erfass_datum`) VALUES
(4, 9, NULL, 'Dokumente', ' Bericht', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '2011-10-12 00:00:00'),
(5, 7, NULL, 'Kontakte', 'Kontaktnachricht', 0, '2011-10-12 00:00:00', '2011-10-30 00:00:00', 1, '', '2011-10-12 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vorgang_mapping`
--

CREATE TABLE IF NOT EXISTS `vorgang_mapping` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vorgang_id` bigint(20) NOT NULL,
  `workflow_id` bigint(20) NOT NULL,
  `bezeichnung` varchar(30) NOT NULL,
  `objekt_name` varchar(30) NOT NULL,
  `objekt_id` bigint(20) NOT NULL,
  `colname` varchar(30) DEFAULT ' ',
  PRIMARY KEY (`id`),
  KEY `workflow_id` (`workflow_id`),
  KEY `vorgang_id` (`vorgang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `vorgang_mapping`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vorgang_mappingsetting`
--

CREATE TABLE IF NOT EXISTS `vorgang_mappingsetting` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `workflow_id` bigint(20) NOT NULL,
  `bezeichnung` varchar(30) NOT NULL,
  `objekt_name` varchar(30) NOT NULL,
  `colname` varchar(30) DEFAULT ' ',
  PRIMARY KEY (`id`),
  KEY `workflow_id` (`workflow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `vorgang_mappingsetting`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vorgang_protokoll`
--

CREATE TABLE IF NOT EXISTS `vorgang_protokoll` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vorgang_id` bigint(20) NOT NULL,
  `art_id` bigint(20) NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `worklow_id` bigint(20) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `datum` int(11) NOT NULL DEFAULT '0',
  `problem_id` bigint(20) DEFAULT NULL,
  `bemerkung` text,
  PRIMARY KEY (`id`),
  KEY `vorgang_id` (`vorgang_id`),
  KEY `problem_id` (`problem_id`),
  KEY `worklow_id` (`worklow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `vorgang_protokoll`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `workflow`
--

CREATE TABLE IF NOT EXISTS `workflow` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT ' ',
  `step` int(2) NOT NULL DEFAULT '1',
  `text` varchar(50) NOT NULL,
  `art` varchar(30) NOT NULL DEFAULT ' ' COMMENT 'ist = des Vorgangs',
  `bedingung` varchar(30) DEFAULT ' ' COMMENT 'query',
  `aktion` varchar(50) DEFAULT ' ' COMMENT 'query',
  `actionart` set('job','link') NOT NULL DEFAULT 'link',
  `relation` varchar(30) DEFAULT ' ',
  `attribut` varchar(50) DEFAULT '  ' COMMENT 'column name',
  `attributwert` varchar(30) DEFAULT ' ',
  `workflowstatus` enum('offen','gesperrt','job') NOT NULL DEFAULT 'offen',
  `wegtrue` bigint(20) NOT NULL DEFAULT '0',
  `wegfalse` bigint(20) NOT NULL DEFAULT '0',
  `tagevortermin` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Daten für Tabelle `workflow`
--

INSERT INTO `workflow` (`id`, `name`, `step`, `text`, `art`, `bedingung`, `aktion`, `actionart`, `relation`, `attribut`, `attributwert`, `workflowstatus`, `wegtrue`, `wegfalse`, `tagevortermin`) VALUES
(100, ' Kontakt erstellen', 1, 'sdfsdfsdfdf', 'kontakt.Kontakte', ' ', '/kontakt/Kontakte/create', 'link', ' ', '  ', ' ', 'offen', 0, 0, 10);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wstree`
--

CREATE TABLE IF NOT EXISTS `wstree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL DEFAULT '0',
  `dir` varchar(30) NOT NULL,
  `dir_parent` varchar(30) DEFAULT NULL,
  `path` text,
  `ws_name` varchar(40) NOT NULL,
  `content` longblob,
  `name` varchar(30) CHARACTER SET latin1 COLLATE latin1_german1_ci DEFAULT NULL,
  `filesize` decimal(10,1) DEFAULT NULL,
  `endung` varchar(6) DEFAULT 'folder',
  `erfassdatum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0=aktuell,1=not akt',
  `version` int(1) DEFAULT '1',
  `beschr` text,
  PRIMARY KEY (`id`),
  KEY `id_parent` (`dir_parent`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=212 ;

--
-- Daten für Tabelle `wstree`
--
--
-- Tabellenstruktur für Tabelle `yumtextsettings`
--

CREATE TABLE IF NOT EXISTS `yumtextsettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` enum('en_us','de','fr','pl','ru','es','ro') NOT NULL DEFAULT 'en_us',
  `text_email_registration` text,
  `subject_email_registration` text,
  `text_email_recovery` text,
  `text_email_activation` text,
  `text_friendship_new` text,
  `text_friendship_confirmed` text,
  `text_profilecomment_new` text,
  `text_message_new` text,
  `text_membership_ordered` text,
  `text_payment_arrived` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `yumtextsettings`
--

INSERT INTO `yumtextsettings` (`id`, `language`, `text_email_registration`, `subject_email_registration`, `text_email_recovery`, `text_email_activation`, `text_friendship_new`, `text_friendship_confirmed`, `text_profilecomment_new`, `text_message_new`, `text_membership_ordered`, `text_payment_arrived`) VALUES
(1, 'en_us', 'You have registered for this Application. To confirm your E-Mail address, please visit {activation_url}', 'You have registered for an application', 'You have requested a new Password. To set your new Password,\n										please go to {activation_url}', 'Your account has been activated. Thank you for your registration.', 'New friendship Request from {username}: {message}. To accept or ignore this request, go to your friendship page: {link_friends} or go to your profile: {link_profile}', 'The User {username} has accepted your friendship request', 'You have a new profile comment from {username}: {message} visit your profile: {link_profile}', 'You have received a new message from {username}: {message}', 'Your order of membership {membership} on {order_date} has been taken. Your order Number is {id}. You have choosen the payment style {payment}.', 'Your payment has been received on {payment_date} and your Membership {id} is now active'),
(2, 'de', 'Sie haben sich für unsere Applikation registriert. Bitte bestätigen Sie ihre E-Mail adresse mit diesem Link: {activation_url}', 'Sie haben sich für eine Applikation registriert.', 'Sie haben ein neues Passwort angefordert. Bitte klicken Sie diesen link: {activation_url}', 'Ihr Konto wurde freigeschaltet.', 'Der Benutzer {username} hat Ihnen eine Freundschaftsanfrage gesendet. \n\n							 Nachricht: {message}\n\n							 Klicken sie <a href="{link_friends}">hier</a>, um diese Anfrage zu bestätigen oder zu ignorieren. Alternativ können sie <a href="{link_profile}">hier</a> auf ihre Profilseite zugreifen.', 'Der Benutzer {username} hat ihre Freundschaftsanfrage bestätigt.', '\n							 Benutzer {username} hat Ihnen eine Nachricht auf Ihrer Pinnwand hinterlassen: \n\n							 {message}\n\n							 <a href="{link}">hier</a> geht es direkt zu Ihrer Pinnwand!', 'Sie haben eine neue Nachricht von {username} bekommen: {message}', 'Ihre Bestellung der Mitgliedschaft {membership} wurde am {order_date} entgegen genommen. Die gewählte Zahlungsart ist {payment}. Die Auftragsnummer lautet {id}.', 'Ihre Zahlung wurde am {payment_date} entgegen genommen. Ihre Mitgliedschaft mit der Nummer {id} ist nun Aktiv.'),
(3, 'es', 'Te has registrado en esta aplicación. Para confirmar tu dirección de correo electrónico, por favor, visita {activation_url}.', 'Te has registrado en esta aplicación.', 'Has solicitado una nueva contraseña. Para establecer una nueva contraseña, por favor ve a {activation_url}', 'Tu cuenta ha sido activada. Gracias por registrarte.', 'Has recibido una nueva solicitud de amistad de {user_from}: {message} Ve a tus contactos: {link}', 'Tienes un nuevo comentario en tu perfil de {username}: {message} visita tu perfil: {link}', 'Please translatore thisse hiere toh tha espagnola langsch {username}', 'Has recibido un mensaje de {username}: {message}', 'Tu orden de membresía {membership} de fecha {order_date} fué tomada. Tu número de orden es {id}. Escogiste como modo de pago {payment}.', 'Tu pago fué recibido en fecha {payment_date}. Ahora tu Membresía {id} ya está activa'),
(4, 'fr', '', '', '', '', '', '', '', '', '', ''),
(5, 'ro', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlungsausgang`
--

CREATE TABLE IF NOT EXISTS `zahlungsausgang` (
  `id` bigint(20) NOT NULL DEFAULT '0',
  `vorgangsnr` bigint(20) NOT NULL DEFAULT '0',
  `kontaktnr` bigint(20) NOT NULL DEFAULT '0',
  `betrag` double(5,2) NOT NULL DEFAULT '0.00',
  `datum` date DEFAULT NULL,
  `azrnr` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `zahlungsausgang`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlungseingang`
--

CREATE TABLE IF NOT EXISTS `zahlungseingang` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `vorgangsnr` bigint(20) DEFAULT '0',
  `kontaktnr` bigint(20) NOT NULL DEFAULT '0',
  `betrag` double(5,2) NOT NULL DEFAULT '0.00',
  `datum` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `zahlungseingang`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlungsvorgang`
--

CREATE TABLE IF NOT EXISTS `zahlungsvorgang` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ist vorgangsnr ',
  `kontaktnr` double NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `beschreibung` text NOT NULL,
  `art` int(11) NOT NULL DEFAULT '0',
  `faelligkeit` date NOT NULL,
  `vorderung` double(5,2) NOT NULL DEFAULT '0.00',
  `betrag` double(5,2) NOT NULL DEFAULT '0.00',
  `erfassid` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `zahlungsvorgang`
--


-- --------------------------------------------------------


--
-- Constraints der Tabelle `vorgang_mappingsetting`
--
ALTER TABLE `vorgang_mappingsetting`
  ADD CONSTRAINT `vorgang_mappingsetting_ibfk_2` FOREIGN KEY (`workflow_id`) REFERENCES `workflow` (`id`);
