-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2015 at 06:44 PM
-- Server version: 5.5.41-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

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
  `id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `ability_class` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ability`
--

INSERT INTO `ability` (`id`, `tag`, `name`, `icon`, `ability_class`) VALUES
(1, 'fireball', 'Boule de feu', 'fireball', 'abilityfireball'),
(2, 'heal', 'Heal', 'heal', 'abilityheal'),
(3, 'execution', 'Execution', 'execution', 'abilityexecution');

-- --------------------------------------------------------

--
-- Table structure for table `adventure`
--

CREATE TABLE IF NOT EXISTS `adventure` (
  `id` int(11) NOT NULL,
  `master` varchar(255) NOT NULL,
  `finished` tinyint(1) NOT NULL DEFAULT '0',
  `thread_type` varchar(255) NOT NULL,
  `thread_code` varchar(255) NOT NULL,
  `last_treated_message` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `adventure_character`
--

CREATE TABLE IF NOT EXISTS `adventure_character` (
  `id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL,
  `adventure_id` int(11) NOT NULL,
  `health` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `character_ability`
--

CREATE TABLE IF NOT EXISTS `character_ability` (
  `character_id` int(11) NOT NULL,
  `ability_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `effect`
--

CREATE TABLE IF NOT EXISTS `effect` (
  `id` int(11) NOT NULL,
  `effect_model_id` int(11) NOT NULL,
  `bearer_living_entity_id` int(11) NOT NULL,
  `origin_living_entity_id` int(11) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `effect_model`
--

CREATE TABLE IF NOT EXISTS `effect_model` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `effect_type` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `effect_model`
--

INSERT INTO `effect_model` (`id`, `name`, `icon`, `effect_type`, `description`) VALUES
(1, 'Brulure', 'fireball', 'effectburn', 'Inflige 5 points de dégats chaque fois que la cible fait une action');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL,
  `adventure_id` int(11) NOT NULL,
  `event_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_character_use_ability`
--

CREATE TABLE IF NOT EXISTS `event_character_use_ability` (
  `id` int(11) NOT NULL,
  `adventure_character_id` int(11) NOT NULL,
  `ability_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_entity_attack`
--

CREATE TABLE IF NOT EXISTS `event_entity_attack` (
  `id` int(11) NOT NULL,
  `target_living_entity_id` int(11) NOT NULL,
  `attacker_living_entity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_entity_heal_damage`
--

CREATE TABLE IF NOT EXISTS `event_entity_heal_damage` (
  `id` int(11) NOT NULL,
  `healer_living_entity_id` int(11) NOT NULL,
  `target_living_entity_id` int(11) NOT NULL,
  `damage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_entity_inflict_damage`
--

CREATE TABLE IF NOT EXISTS `event_entity_inflict_damage` (
  `id` int(11) NOT NULL,
  `attacker_living_entity_id` int(11) NOT NULL,
  `target_living_entity_id` int(11) NOT NULL,
  `damage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_join`
--

CREATE TABLE IF NOT EXISTS `event_join` (
  `id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_level_up`
--

CREATE TABLE IF NOT EXISTS `event_level_up` (
  `id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_monster_spawn`
--

CREATE TABLE IF NOT EXISTS `event_monster_spawn` (
  `id` int(11) NOT NULL,
  `monster_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_reward_experience`
--

CREATE TABLE IF NOT EXISTS `event_reward_experience` (
  `id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL,
  `experience` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_statistic_test`
--

CREATE TABLE IF NOT EXISTS `event_statistic_test` (
  `id` int(11) NOT NULL,
  `adventure_character_id` int(11) NOT NULL,
  `statistic_id` int(11) NOT NULL,
  `statistic_amount` int(11) NOT NULL,
  `count_dice` int(11) NOT NULL,
  `count_dice_side` int(11) NOT NULL,
  `roll_dice_result` int(11) NOT NULL,
  `required_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `living_entity`
--

CREATE TABLE IF NOT EXISTS `living_entity` (
  `id` int(11) NOT NULL,
  `adventure_id` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `living_entity_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `monster`
--

CREATE TABLE IF NOT EXISTS `monster` (
  `id` int(11) NOT NULL,
  `monster_model_id` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `adventure_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monster_model`
--

CREATE TABLE IF NOT EXISTS `monster_model` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `max_health` int(11) NOT NULL,
  `attack_damage` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `race_id` int(11) NOT NULL,
  `profession_id` int(11) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  `statistic_points` int(11) NOT NULL,
  `ability_points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `persona_statistic`
--

CREATE TABLE IF NOT EXISTS `persona_statistic` (
  `id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL,
  `statistic_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profession`
--

CREATE TABLE IF NOT EXISTS `profession` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profession`
--

INSERT INTO `profession` (`id`, `name`, `tag`) VALUES
(1, 'Guerrier', 'warrior'),
(2, 'Sorcier', 'wizard'),
(3, 'Clerc', 'clerc'),
(4, 'Voleur', 'rogue');

-- --------------------------------------------------------

--
-- Table structure for table `profession_ability`
--

CREATE TABLE IF NOT EXISTS `profession_ability` (
  `profession_id` int(11) NOT NULL,
  `ability_id` int(11) NOT NULL,
  `required_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profession_ability`
--

INSERT INTO `profession_ability` (`profession_id`, `ability_id`, `required_level`) VALUES
(1, 1, 0),
(1, 2, 0),
(1, 3, 3),
(2, 1, 0),
(2, 2, 0),
(2, 3, 3),
(3, 1, 0),
(3, 2, 3),
(3, 3, 0),
(4, 1, 3),
(4, 2, 0),
(4, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `race`
--

CREATE TABLE IF NOT EXISTS `race` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `max_health` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
  `id` int(11) NOT NULL,
  `race_id` int(11) NOT NULL,
  `statistic_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `race_statistic`
--

INSERT INTO `race_statistic` (`id`, `race_id`, `statistic_id`, `amount`) VALUES
(1, 1, 1, 7),
(2, 1, 2, 4),
(3, 1, 3, 3),
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
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statistic`
--

INSERT INTO `statistic` (`id`, `name`, `tag`) VALUES
(1, 'Force', 'str'),
(2, 'Intelligence', 'int'),
(3, 'Dextérité', 'dex');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ability`
--
ALTER TABLE `ability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adventure`
--
ALTER TABLE `adventure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adventure_character`
--
ALTER TABLE `adventure_character`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `character_ability`
--
ALTER TABLE `character_ability`
  ADD PRIMARY KEY (`character_id`,`ability_id`);

--
-- Indexes for table `effect`
--
ALTER TABLE `effect`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `effect_model`
--
ALTER TABLE `effect_model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_character_use_ability`
--
ALTER TABLE `event_character_use_ability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_entity_heal_damage`
--
ALTER TABLE `event_entity_heal_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_entity_inflict_damage`
--
ALTER TABLE `event_entity_inflict_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_join`
--
ALTER TABLE `event_join`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_level_up`
--
ALTER TABLE `event_level_up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_monster_spawn`
--
ALTER TABLE `event_monster_spawn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_reward_experience`
--
ALTER TABLE `event_reward_experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_statistic_test`
--
ALTER TABLE `event_statistic_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `living_entity`
--
ALTER TABLE `living_entity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monster`
--
ALTER TABLE `monster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monster_model`
--
ALTER TABLE `monster_model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persona_statistic`
--
ALTER TABLE `persona_statistic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profession`
--
ALTER TABLE `profession`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profession_ability`
--
ALTER TABLE `profession_ability`
  ADD PRIMARY KEY (`profession_id`,`ability_id`);

--
-- Indexes for table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `race_statistic`
--
ALTER TABLE `race_statistic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistic`
--
ALTER TABLE `statistic`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ability`
--
ALTER TABLE `ability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `adventure`
--
ALTER TABLE `adventure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `adventure_character`
--
ALTER TABLE `adventure_character`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `effect`
--
ALTER TABLE `effect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `effect_model`
--
ALTER TABLE `effect_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_character_use_ability`
--
ALTER TABLE `event_character_use_ability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_entity_heal_damage`
--
ALTER TABLE `event_entity_heal_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_entity_inflict_damage`
--
ALTER TABLE `event_entity_inflict_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_join`
--
ALTER TABLE `event_join`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_level_up`
--
ALTER TABLE `event_level_up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_monster_spawn`
--
ALTER TABLE `event_monster_spawn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_reward_experience`
--
ALTER TABLE `event_reward_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_statistic_test`
--
ALTER TABLE `event_statistic_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `living_entity`
--
ALTER TABLE `living_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monster`
--
ALTER TABLE `monster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monster_model`
--
ALTER TABLE `monster_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `persona_statistic`
--
ALTER TABLE `persona_statistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `profession`
--
ALTER TABLE `profession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `race`
--
ALTER TABLE `race`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `race_statistic`
--
ALTER TABLE `race_statistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `statistic`
--
ALTER TABLE `statistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;