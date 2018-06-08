-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2016 at 08:29 PM
-- Server version: 5.6.30
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `conference_master`
--

CREATE TABLE IF NOT EXISTS `conference_master` (
  `conf_id` int(7) NOT NULL,
  `uid` int(7) NOT NULL,
  `conf_name` varchar(100) NOT NULL,
  `conf_slug` varchar(10) NOT NULL,
  `conf_start_date` date NOT NULL,
  `conf_end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_modification` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_master`
--

CREATE TABLE IF NOT EXISTS `login_master` (
  `id` int(4) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `user_type` tinyint(2) DEFAULT '0' COMMENT '0-author, 1-(admin), 2-(track-admin), 3-reviewer',
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paper_assignment`
--

CREATE TABLE IF NOT EXISTS `paper_assignment` (
  `assignment_id` int(11) NOT NULL,
  `uid` int(7) DEFAULT NULL COMMENT 'uid=reviewer''s id',
  `assigned_by` int(5) NOT NULL,
  `pid` int(6) DEFAULT NULL,
  `is_reviewed` tinyint(1) NOT NULL DEFAULT '0',
  `assign_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paper_master`
--

CREATE TABLE IF NOT EXISTS `paper_master` (
  `pid` int(7) NOT NULL,
  `uid` int(7) DEFAULT NULL,
  `paper_id` varchar(5) DEFAULT NULL,
  `paper_title` varchar(75) NOT NULL,
  `author_names` varchar(60) NOT NULL,
  `original_paper` text,
  `blind_paper` text,
  `title_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_accepted` tinyint(1) DEFAULT '0' COMMENT '1:accepted, 2:accepted with modification, 3:rejected',
  `is_assigned` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:pending, 1:assigned'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paper_tracks`
--

CREATE TABLE IF NOT EXISTS `paper_tracks` (
  `track_id` int(5) NOT NULL,
  `conf_id` int(5) NOT NULL,
  `track_short_name` varchar(10) NOT NULL,
  `track_name` text
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paper_track_title`
--

CREATE TABLE IF NOT EXISTS `paper_track_title` (
  `title_id` int(11) NOT NULL,
  `track_id` int(5) DEFAULT NULL,
  `title_name` text
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE IF NOT EXISTS `password_reset` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `sent_time` varchar(20) DEFAULT NULL,
  `exp_time` varchar(20) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '0' COMMENT '(0:not reset, 1:reset)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_master`
--

CREATE TABLE IF NOT EXISTS `payment_master` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `paytype` varchar(10) DEFAULT NULL,
  `paynum` int(11) DEFAULT NULL,
  `paydate` datetime DEFAULT NULL,
  `amount` varchar(8) DEFAULT NULL,
  `bankname` varchar(50) DEFAULT NULL,
  `bankbranch` varchar(50) NOT NULL,
  `utform` varchar(50) DEFAULT NULL,
  `scopy` varchar(50) DEFAULT NULL,
  `crcopy` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profile_master`
--

CREATE TABLE IF NOT EXISTS `profile_master` (
  `uid` int(7) NOT NULL,
  `full_name` varchar(35) NOT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `address` text,
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prof_conf_relation`
--

CREATE TABLE IF NOT EXISTS `prof_conf_relation` (
  `id` int(7) NOT NULL,
  `uid` int(7) NOT NULL,
  `conf_id` int(7) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prof_track_relation`
--

CREATE TABLE IF NOT EXISTS `prof_track_relation` (
  `id` smallint(5) NOT NULL,
  `uid` int(7) NOT NULL,
  `track_id` int(5) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review_master`
--

CREATE TABLE IF NOT EXISTS `review_master` (
  `rid` int(5) NOT NULL,
  `assignment_id` int(5) NOT NULL,
  `innovative_concept` tinyint(4) NOT NULL,
  `content_origionality` tinyint(4) NOT NULL,
  `technicality` tinyint(4) NOT NULL,
  `structure` tinyint(4) NOT NULL,
  `reference` tinyint(4) NOT NULL,
  `lang_grammer` tinyint(4) NOT NULL,
  `gen_remarks` text NOT NULL,
  `author_remarks` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1:accepted, 2:accept_with_mod,3:rejected',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conference_master`
--
ALTER TABLE `conference_master`
  ADD PRIMARY KEY (`conf_id`),
  ADD KEY `fk_cm` (`uid`);

--
-- Indexes for table `login_master`
--
ALTER TABLE `login_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `paper_assignment`
--
ALTER TABLE `paper_assignment`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `fk_pa2` (`assigned_by`);

--
-- Indexes for table `paper_master`
--
ALTER TABLE `paper_master`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `title_id` (`title_id`);

--
-- Indexes for table `paper_tracks`
--
ALTER TABLE `paper_tracks`
  ADD PRIMARY KEY (`track_id`),
  ADD KEY `fk_pt` (`conf_id`);

--
-- Indexes for table `paper_track_title`
--
ALTER TABLE `paper_track_title`
  ADD PRIMARY KEY (`title_id`),
  ADD KEY `track_id` (`track_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `payment_master`
--
ALTER TABLE `payment_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `profile_master`
--
ALTER TABLE `profile_master`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `prof_conf_relation`
--
ALTER TABLE `prof_conf_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pcm1` (`uid`),
  ADD KEY `fk_pcm2` (`conf_id`);

--
-- Indexes for table `prof_track_relation`
--
ALTER TABLE `prof_track_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ptr1` (`uid`),
  ADD KEY `fk_ptr2` (`track_id`);

--
-- Indexes for table `review_master`
--
ALTER TABLE `review_master`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `fk_rm` (`assignment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conference_master`
--
ALTER TABLE `conference_master`
  MODIFY `conf_id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `login_master`
--
ALTER TABLE `login_master`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `paper_assignment`
--
ALTER TABLE `paper_assignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `paper_master`
--
ALTER TABLE `paper_master`
  MODIFY `pid` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `paper_tracks`
--
ALTER TABLE `paper_tracks`
  MODIFY `track_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `paper_track_title`
--
ALTER TABLE `paper_track_title`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_master`
--
ALTER TABLE `payment_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `profile_master`
--
ALTER TABLE `profile_master`
  MODIFY `uid` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `prof_conf_relation`
--
ALTER TABLE `prof_conf_relation`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `prof_track_relation`
--
ALTER TABLE `prof_track_relation`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `review_master`
--
ALTER TABLE `review_master`
  MODIFY `rid` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `conference_master`
--
ALTER TABLE `conference_master`
  ADD CONSTRAINT `fk_cm` FOREIGN KEY (`uid`) REFERENCES `profile_master` (`uid`);

--
-- Constraints for table `login_master`
--
ALTER TABLE `login_master`
  ADD CONSTRAINT `login_master_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `profile_master` (`uid`);

--
-- Constraints for table `paper_assignment`
--
ALTER TABLE `paper_assignment`
  ADD CONSTRAINT `fk_pa2` FOREIGN KEY (`assigned_by`) REFERENCES `profile_master` (`uid`),
  ADD CONSTRAINT `fk_pa_pid` FOREIGN KEY (`pid`) REFERENCES `paper_master` (`pid`),
  ADD CONSTRAINT `fk_pa_uid` FOREIGN KEY (`uid`) REFERENCES `profile_master` (`uid`),
  ADD CONSTRAINT `paper_assignment_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `profile_master` (`uid`),
  ADD CONSTRAINT `paper_assignment_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `paper_master` (`pid`);

--
-- Constraints for table `paper_master`
--
ALTER TABLE `paper_master`
  ADD CONSTRAINT `fk_pm_pid` FOREIGN KEY (`uid`) REFERENCES `profile_master` (`uid`),
  ADD CONSTRAINT `paper_master_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `profile_master` (`uid`),
  ADD CONSTRAINT `paper_master_ibfk_2` FOREIGN KEY (`title_id`) REFERENCES `paper_track_title` (`title_id`);

--
-- Constraints for table `paper_tracks`
--
ALTER TABLE `paper_tracks`
  ADD CONSTRAINT `fk_pt` FOREIGN KEY (`conf_id`) REFERENCES `conference_master` (`conf_id`);

--
-- Constraints for table `paper_track_title`
--
ALTER TABLE `paper_track_title`
  ADD CONSTRAINT `paper_track_title_ibfk_1` FOREIGN KEY (`track_id`) REFERENCES `paper_tracks` (`track_id`);

--
-- Constraints for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD CONSTRAINT `password_reset_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `profile_master` (`uid`);

--
-- Constraints for table `payment_master`
--
ALTER TABLE `payment_master`
  ADD CONSTRAINT `payment_master_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `profile_master` (`uid`),
  ADD CONSTRAINT `payment_master_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `paper_master` (`pid`);

--
-- Constraints for table `prof_conf_relation`
--
ALTER TABLE `prof_conf_relation`
  ADD CONSTRAINT `fk_pcm1` FOREIGN KEY (`uid`) REFERENCES `profile_master` (`uid`),
  ADD CONSTRAINT `fk_pcm2` FOREIGN KEY (`conf_id`) REFERENCES `conference_master` (`conf_id`);

--
-- Constraints for table `prof_track_relation`
--
ALTER TABLE `prof_track_relation`
  ADD CONSTRAINT `fk_ptr1` FOREIGN KEY (`uid`) REFERENCES `profile_master` (`uid`),
  ADD CONSTRAINT `fk_ptr2` FOREIGN KEY (`track_id`) REFERENCES `paper_tracks` (`track_id`);

--
-- Constraints for table `review_master`
--
ALTER TABLE `review_master`
  ADD CONSTRAINT `fk_rm` FOREIGN KEY (`assignment_id`) REFERENCES `paper_assignment` (`assignment_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
