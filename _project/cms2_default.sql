-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 01 Sept 2010 om 17:56
-- Serverversie: 5.1.36
-- PHP-Versie: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms2_default`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `type` enum('view','node','user') NOT NULL,
  `content_source_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `blocks`
--

INSERT INTO `blocks` (`id`, `name`, `type`, `content_source_id`) VALUES
(1, 'news', 'node', 4),
(2, 'some user', 'user', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(40) NOT NULL,
  `o` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `categories`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `nodes`
--

CREATE TABLE IF NOT EXISTS `nodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `node_type_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `use_node_template` varchar(60) NOT NULL DEFAULT '',
  `use_page_template` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `node_type_id` (`node_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Gegevens worden uitgevoerd voor tabel `nodes`
--

INSERT INTO `nodes` (`id`, `title`, `node_type_id`, `category_id`, `use_node_template`, `use_page_template`) VALUES
(1, 'Berichtje 1', 1, NULL, '', ''),
(2, 'Ultragaaf', 1, NULL, '', ''),
(3, 'Amsterdam', 2, NULL, '', ''),
(4, 'London', 2, NULL, '', ''),
(5, 'Berlin', 2, NULL, '', ''),
(6, 'Joris', 3, NULL, '', ''),
(7, 'Rudie', 3, NULL, '', ''),
(8, 'Jaap', 3, NULL, '', ''),
(9, 'Mieke', 3, NULL, '', ''),
(10, 'Tilburg', 2, NULL, '', 'intro'),
(11, 'Binnenkort!! Dingen!!', 1, NULL, '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `node_data_1`
--

CREATE TABLE IF NOT EXISTS `node_data_1` (
  `node_id` int(10) unsigned NOT NULL,
  `teaser` text NOT NULL,
  `body` text NOT NULL,
  `publicationdate` date NOT NULL,
  `ref_office` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `node_data_1`
--

INSERT INTO `node_data_1` (`node_id`, `teaser`, `body`, `publicationdate`, `ref_office`) VALUES
(1, 'Berichtje 1', '<p>Het eerste berichtje bla bla bla</p>', '2010-08-26', 4),
(2, 'Oele boele', '<p>Oeleboele<br>\r\nTralala<br>\r\nGekke japie<br>\r\nGekke jantje<br>\r\nGekke miep</p>\r\n<p>En ga zo maar door</p>', '2010-08-27', 3),
(11, 'Binnenkort ;) Nieuwe dingen in de hizzouse', '<p>Binnenkort dit en dat bla bla</p>', '2010-09-06', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `node_data_2`
--

CREATE TABLE IF NOT EXISTS `node_data_2` (
  `node_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `node_data_2`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `node_data_3`
--

CREATE TABLE IF NOT EXISTS `node_data_3` (
  `node_id` int(10) unsigned NOT NULL,
  `birthdate` date DEFAULT NULL,
  `ref_supervisor` int(10) unsigned DEFAULT NULL,
  `ref_office` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`node_id`),
  KEY `ref_office` (`ref_office`),
  KEY `ref_supervisor` (`ref_supervisor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `node_data_3`
--

INSERT INTO `node_data_3` (`node_id`, `birthdate`, `ref_supervisor`, `ref_office`) VALUES
(6, '2010-01-01', 7, 10),
(7, '2010-03-16', NULL, 10),
(8, '2010-12-29', NULL, 0),
(9, '2010-02-14', 7, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `node_types`
--

CREATE TABLE IF NOT EXISTS `node_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_type` varchar(40) NOT NULL,
  `node_type_name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `node_type` (`node_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `node_types`
--

INSERT INTO `node_types` (`id`, `node_type`, `node_type_name`) VALUES
(1, 'nieuws', 'Nieuws'),
(2, 'office', 'Office'),
(3, 'person', 'Person');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `node_type_fields`
--

CREATE TABLE IF NOT EXISTS `node_type_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `node_type_id` int(10) unsigned NOT NULL,
  `field_machine_name` varchar(40) NOT NULL,
  `field_title` varchar(60) NOT NULL,
  `field_description` text NOT NULL,
  `field_type` varchar(40) NOT NULL,
  `mandatory` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `input_format` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `node_type_id` (`node_type_id`,`field_machine_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='field types: string,text,html,date,int,float,file,image' AUTO_INCREMENT=8 ;

--
-- Gegevens worden uitgevoerd voor tabel `node_type_fields`
--

INSERT INTO `node_type_fields` (`id`, `node_type_id`, `field_machine_name`, `field_title`, `field_description`, `field_type`, `mandatory`, `input_format`) VALUES
(1, 1, 'teaser', 'Teaser', 'A few words about this post', 'string', 1, ''),
(2, 1, 'body', 'Body', 'The actual content', 'html', 1, ''),
(3, 1, 'publicationdate', 'Publicatiedatum', 'Vanaf welke datum moet deze post verschijnen?', 'date', 1, ''),
(4, 1, 'ref_office', '`Office`', 'Op welke office slaat dit bericht?', 'reference', 1, 'node_types=2'),
(5, 3, 'birthdate', 'Birthdate', 'Year + month + day of birth of this person', 'date', 0, ''),
(6, 3, 'ref_supervisor', 'Supervisor', 'Who is this person''s supervisor?', 'reference', 0, 'node_types=3'),
(7, 3, 'ref_office', 'Office', 'Where does Jantje work?', 'reference', 0, 'node_types=2');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `regioned_blocks`
--

CREATE TABLE IF NOT EXISTS `regioned_blocks` (
  `region_id` int(10) unsigned NOT NULL,
  `block_id` int(10) unsigned NOT NULL,
  `o` int(11) NOT NULL DEFAULT '0',
  `condition_type` enum('always','except_on','only_on','if_true') NOT NULL DEFAULT 'always',
  `condition_value` text NOT NULL,
  PRIMARY KEY (`region_id`,`block_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `regioned_blocks`
--

INSERT INTO `regioned_blocks` (`region_id`, `block_id`, `o`, `condition_type`, `condition_value`) VALUES
(1, 1, 0, 'always', ''),
(1, 2, 0, 'always', ''),
(2, 2, 0, 'always', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `region_name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `region_name` (`region_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `regions`
--

INSERT INTO `regions` (`id`, `region_name`) VALUES
(1, 'header'),
(2, 'footer');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_regexp` varchar(250) NOT NULL,
  `to_url_path` varchar(250) NOT NULL,
  `active` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `forward` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `routes`
--

INSERT INTO `routes` (`id`, `from_regexp`, `to_url_path`, `active`, `forward`) VALUES
(1, '#^/$#', '/node/2', 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `url_paths`
--

CREATE TABLE IF NOT EXISTS `url_paths` (
  `from_url_path` varchar(250) NOT NULL,
  `to_url_path` varchar(250) NOT NULL,
  PRIMARY KEY (`from_url_path`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `url_paths`
--

INSERT INTO `url_paths` (`from_url_path`, `to_url_path`) VALUES
('/rudie', '/node/7'),
('/joris', '/node/6'),
('404', '/node/1'),
('/nieuws', '/view/1'),
('/root', '/user/1'),
('/user/root', '/user/1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `created_on` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `created_on`, `created_by`) VALUES
(1, 'rudie', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `views`
--

CREATE TABLE IF NOT EXISTS `views` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `view_name` varchar(40) NOT NULL,
  `result_type` enum('node','user') NOT NULL DEFAULT 'node',
  `details` text NOT NULL,
  `node_type_id` int(10) unsigned NOT NULL,
  `dont_wrap` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `node_type_id` (`node_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `views`
--

INSERT INTO `views` (`id`, `view_name`, `result_type`, `details`, `node_type_id`, `dont_wrap`) VALUES
(1, 'Nieuws', 'node', 'SELECT * FROM nodes n, node_data_1 nd WHERE nd.node_id = n.id AND nd.publicationdate > DATE(NOW()) ORDER BY nd.publicationdate DESC;', 1, 0),
(2, 'Newest user', 'node', 'SELECT * FROM users ORDER BY created_on DESC LIMIT 1', 0, 1);
