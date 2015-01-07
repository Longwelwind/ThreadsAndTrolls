-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2015 at 04:46 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `threadsandtrolls`
--

-- --------------------------------------------------------

--
-- Table structure for table `ability`
--

CREATE TABLE IF NOT EXISTS `ability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `ability_class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ability`
--

INSERT INTO `ability` (`id`, `tag`, `name`, `icon`, `ability_class`) VALUES
(1, 'fireball', 'Boule de feu', 'fireball', 'abilityfireball');

-- --------------------------------------------------------

--
-- Table structure for table `adventure`
--

CREATE TABLE IF NOT EXISTS `adventure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `master` varchar(255) NOT NULL,
  `finished` tinyint(1) NOT NULL DEFAULT '0',
  `thread_type` varchar(255) NOT NULL,
  `thread_code` varchar(255) NOT NULL,
  `last_treated_message` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `adventure`
--

INSERT INTO `adventure` (`id`, `master`, `finished`, `thread_type`, `thread_code`, `last_treated_message`) VALUES
(1, 'MsPtibiscuit', 0, 'jol', '1', 27954165);

-- --------------------------------------------------------

--
-- Table structure for table `adventure_character`
--

CREATE TABLE IF NOT EXISTS `adventure_character` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `character_id` int(11) NOT NULL,
  `adventure_id` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `adventure_character`
--

INSERT INTO `adventure_character` (`id`, `character_id`, `adventure_id`, `health`) VALUES
(1, 1, 1, 80);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adventure_id` int(11) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `adventure_id`, `event_type`) VALUES
(1, 1, 'eventmonsterspawn'),
(2, 1, 'eventjoin'),
(3, 1, 'eventcharacterattack'),
(4, 1, 'eventcharacterinflictdamage'),
(5, 1, 'eventrewardexperience'),
(6, 1, 'eventlevelup'),
(7, 1, 'eventlevelup'),
(8, 1, 'eventlevelup'),
(9, 1, 'eventlevelup'),
(10, 1, 'eventcharacterattack'),
(11, 1, 'eventcharacterinflictdamage'),
(12, 1, 'eventstatistictest'),
(13, 1, 'eventmonsterattack'),
(14, 1, 'eventcharacteruseability'),
(15, 1, 'eventcharacterinflictdamage');

-- --------------------------------------------------------

--
-- Table structure for table `event_character_attack`
--

CREATE TABLE IF NOT EXISTS `event_character_attack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monster_id` int(11) NOT NULL,
  `adventure_character_id` int(11) NOT NULL,
  `damage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `event_character_attack`
--

INSERT INTO `event_character_attack` (`id`, `monster_id`, `adventure_character_id`, `damage`) VALUES
(3, 1, 1, 0),
(10, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_character_inflict_damage`
--

CREATE TABLE IF NOT EXISTS `event_character_inflict_damage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adventure_character_id` int(11) NOT NULL,
  `monster_id` int(11) NOT NULL,
  `damage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `event_character_inflict_damage`
--

INSERT INTO `event_character_inflict_damage` (`id`, `adventure_character_id`, `monster_id`, `damage`) VALUES
(4, 1, 1, 21),
(11, 1, 1, 21),
(15, 1, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `event_character_use_ability`
--

CREATE TABLE IF NOT EXISTS `event_character_use_ability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adventure_character_id` int(11) NOT NULL,
  `ability_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `event_character_use_ability`
--

INSERT INTO `event_character_use_ability` (`id`, `adventure_character_id`, `ability_id`) VALUES
(14, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_join`
--

CREATE TABLE IF NOT EXISTS `event_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `character_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `event_join`
--

INSERT INTO `event_join` (`id`, `character_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_level_up`
--

CREATE TABLE IF NOT EXISTS `event_level_up` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `character_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `event_level_up`
--

INSERT INTO `event_level_up` (`id`, `character_id`, `level`) VALUES
(6, 1, 2),
(7, 1, 3),
(8, 1, 4),
(9, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `event_monster_attack`
--

CREATE TABLE IF NOT EXISTS `event_monster_attack` (
  `id` int(11) NOT NULL,
  `monster_id` int(11) NOT NULL,
  `adventure_character_id` int(11) NOT NULL,
  `damage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_monster_attack`
--

INSERT INTO `event_monster_attack` (`id`, `monster_id`, `adventure_character_id`, `damage`) VALUES
(16, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(18, 1, 2, 40),
(33, 1, 4, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(11, 1, 1, 40),
(13, 1, 1, 40),
(13, 1, 1, 40);

-- --------------------------------------------------------

--
-- Table structure for table `event_monster_spawn`
--

CREATE TABLE IF NOT EXISTS `event_monster_spawn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monster_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `event_monster_spawn`
--

INSERT INTO `event_monster_spawn` (`id`, `monster_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_reward_experience`
--

CREATE TABLE IF NOT EXISTS `event_reward_experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `character_id` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `event_reward_experience`
--

INSERT INTO `event_reward_experience` (`id`, `character_id`, `experience`) VALUES
(5, 1, 225);

-- --------------------------------------------------------

--
-- Table structure for table `event_statistic_test`
--

CREATE TABLE IF NOT EXISTS `event_statistic_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adventure_character_id` int(11) NOT NULL,
  `statistic_id` int(11) NOT NULL,
  `statistic_amount` int(11) NOT NULL,
  `count_dice` int(11) NOT NULL,
  `count_dice_side` int(11) NOT NULL,
  `roll_dice_result` int(11) NOT NULL,
  `required_amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `event_statistic_test`
--

INSERT INTO `event_statistic_test` (`id`, `adventure_character_id`, `statistic_id`, `statistic_amount`, `count_dice`, `count_dice_side`, `roll_dice_result`, `required_amount`) VALUES
(12, 1, 3, 4, 2, 6, 9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `monster`
--

CREATE TABLE IF NOT EXISTS `monster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monster_model_id` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `adventure_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `monster`
--

INSERT INTO `monster` (`id`, `monster_model_id`, `health`, `adventure_id`) VALUES
(1, 1, 150, 1);

-- --------------------------------------------------------

--
-- Table structure for table `monster_model`
--

CREATE TABLE IF NOT EXISTS `monster_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `max_health` int(11) NOT NULL,
  `attack_damage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `monster_model`
--

INSERT INTO `monster_model` (`id`, `name`, `max_health`, `attack_damage`) VALUES
(1, 'Gobelin de l''ouest', 200, 40);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `race_id` int(11) NOT NULL,
  `profession_id` int(11) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  `statistic_points` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`id`, `name`, `race_id`, `profession_id`, `owner`, `level`, `experience`, `statistic_points`) VALUES
(1, 'Joueur1', 1, 3, 'Player1', 5, 25, 8);

-- --------------------------------------------------------

--
-- Table structure for table `persona_statistic`
--

CREATE TABLE IF NOT EXISTS `persona_statistic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `character_id` int(11) NOT NULL,
  `statistic_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profession`
--

CREATE TABLE IF NOT EXISTS `profession` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `profession`
--

INSERT INTO `profession` (`id`, `name`, `tag`, `icon`) VALUES
(1, 'Guerrier', 'warrior', ''),
(2, 'Sorcier', 'wizard', ''),
(3, 'Clerc', 'clerc', ''),
(4, 'Voleur', 'rogue', '');

-- --------------------------------------------------------

--
-- Table structure for table `race`
--

CREATE TABLE IF NOT EXISTS `race` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `max_health` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `race`
--

INSERT INTO `race` (`id`, `name`, `tag`, `max_health`) VALUES
(1, 'Nain', 'dwarf', 120),
(2, 'Elfe', 'elf', 80),
(3, 'Humain', 'human', 100),
(4, 'Kender', 'kender', 70);

-- --------------------------------------------------------

--
-- Table structure for table `race_statistic`
--

CREATE TABLE IF NOT EXISTS `race_statistic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `race_id` int(11) NOT NULL,
  `statistic_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `race_statistic`
--

INSERT INTO `race_statistic` (`id`, `race_id`, `statistic_id`, `amount`) VALUES
(1, 1, 1, 7),
(2, 1, 2, 4),
(3, 1, 3, 4),
(4, 2, 1, 5),
(5, 2, 2, 8),
(6, 2, 3, 5),
(7, 3, 1, 6),
(8, 3, 2, 6),
(9, 3, 3, 5),
(10, 4, 1, 3),
(11, 4, 2, 5),
(12, 4, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `statistic`
--

CREATE TABLE IF NOT EXISTS `statistic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `statistic`
--

INSERT INTO `statistic` (`id`, `name`, `tag`) VALUES
(1, 'Force', 'str'),
(2, 'Intelligence', 'int'),
(3, 'Dextérité', 'dex');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
