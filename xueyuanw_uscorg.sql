-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2016 at 05:28 PM
-- Server version: 5.5.52-cll
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xueyuanw_uscorg`
--

-- --------------------------------------------------------

--
-- Table structure for table `function`
--

CREATE TABLE IF NOT EXISTS `function` (
  `function_id` int(11) NOT NULL,
  `function` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`function_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `function`
--

INSERT INTO `function` (`function_id`, `function`) VALUES
(1, 'Marshall-Business'),
(2, 'Annenberg-Communications'),
(3, 'Viterbi-Engineering'),
(4, 'Cinematic Arts'),
(5, 'Gould-Law'),
(6, 'Dornsife-Arts and Science'),
(7, 'Other'),
(8, 'Thornton-Music');

-- --------------------------------------------------------

--
-- Table structure for table `involvement`
--

CREATE TABLE IF NOT EXISTS `involvement` (
  `involvement_id` int(11) NOT NULL,
  `involvement` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`involvement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `involvement`
--

INSERT INTO `involvement` (`involvement_id`, `involvement`) VALUES
(1, 'Undergraduate'),
(2, 'Graduate'),
(3, 'All Undergraduate and Graduate');

-- --------------------------------------------------------

--
-- Table structure for table `saved_organizations`
--

CREATE TABLE IF NOT EXISTS `saved_organizations` (
  `saved_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `saved_organization_name` varchar(145) NOT NULL,
  `type_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  `involvement_id` int(11) NOT NULL,
  `email` varchar(145) NOT NULL,
  PRIMARY KEY (`saved_id`),
  KEY `fk_Orders_Users1_idx` (`username`),
  KEY `fk_Orders_Products1_idx` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `saved_organizations`
--

INSERT INTO `saved_organizations` (`saved_id`, `username`, `organization_id`, `saved_organization_name`, `type_id`, `function_id`, `involvement_id`, `email`) VALUES
(3, 'tommy', 4, 'LavaLab', 1, 3, 3, 'usclavalab@gmail.com'),
(4, 'tommy', 7, 'Marshall Business Network (MBN)', 5, 1, 3, 'uscbiznet@gmail.com'),
(8, 'xxx', 7, 'Marshall Business Network (MBN)', 5, 1, 3, 'uscbiznet@gmail.com'),
(9, 'xxx', 13, 'Vietnamese Student Association ', 2, 7, 3, 'vsa@usc.edu'),
(11, 'xueyuanwang', 5, 'Daily Trojan', 1, 2, 3, ''),
(20, 'abc', 10, 'Chaotic 3 ', 6, 7, 3, 'chaotic3@gmail.com'),
(21, 'abc', 7, 'Marshall Business Network (MBN)', 5, 1, 3, 'uscbiznet@gmail.com'),
(22, 'abc', 9, 'Graduate Student Consulting Club at USC ', 5, 1, 2, 'usc.gscc@gmail.com'),
(23, 'abc', 1, '3D4E - 3D Printing For Everyone ', 1, 3, 3, '3d4e.usc@gmail.com'),
(24, 'tommy', 11, 'InterVarsity-Trojan Christian Fellowship', 9, 7, 3, 'intervarsitytcf@gmail.com'),
(25, 'tommy', 3, 'USC Mock Trial Team', 1, 5, 1, 'info@uscmocktrial.org'),
(26, 'tommy', 1, '3D4E - 3D Printing For Everyone ', 1, 3, 3, '3d4e.usc@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `student_organizations`
--

CREATE TABLE IF NOT EXISTS `student_organizations` (
  `organization_id` int(11) NOT NULL,
  `organization_name` varchar(145) NOT NULL,
  `organization_link` varchar(145) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `involvement_id` int(11) DEFAULT NULL,
  `function_id` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `details` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`organization_id`),
  KEY `type_id_idx` (`type_id`),
  KEY `size_id_idx` (`involvement_id`),
  KEY `function_id_idx` (`function_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_organizations`
--

INSERT INTO `student_organizations` (`organization_id`, `organization_name`, `organization_link`, `type_id`, `involvement_id`, `function_id`, `email`, `details`) VALUES
(1, '3D4E - 3D Printing For Everyone ', 'http://usc3d4e.com', 1, 3, 3, '3d4e.usc@gmail.com ', 'People. Community. Culture.\r3D4E, aka ''3D For Everyone'', is a project based organization that allows students of all academic backgrounds and disciplines to get more experience with 3D printing. We aim to provide meaningful experiences for individuals looking to get more intimately involved in the 3D printing environment.'),
(2, 'Makers of Entertaining Games Associations (MEGA)', 'http://megausc.com/welcome', 8, 3, 4, 'megausc@usc.edu', 'MEGA is a student run organization which strives to promote and facilitate the art of game creation within the University of Southern California. MEGA is a community of students from many disciplines who collaborate in order to cultivate a deeper understanding of interactive development at open weekly meetings, in which members share current projects, discuss relevant news and host guest speakers from all corners of the industry.'),
(3, 'USC Mock Trial Team', 'https://www.facebook.com/uscmocktrial?fref=ts', 1, 1, 5, 'info@uscmocktrial.org', 'Mock Trial is a simulated courtroom trial where college undergraduates portray lawyers and witnesses in a full on litigation experiences. Tryouts generally take place in September of each year. '),
(4, 'LavaLab', 'http://www.usclavalab.org', 1, 3, 3, 'usclavalab@gmail.com ', 'The mission of LavaLab is to give students the know-how, resources and connections they need to successfully bring their ideas to market. LavaLab will exist as a hands-on transdisciplinary student-run organization that aims to develop practical, profitable and responsible solutions to real world problems. As a USC recognized student organization, we strive to create a community of collaboration among our membership, and seek to educate our greater USC community by promoting entrepreneurial and i'),
(5, 'Daily Trojan', 'http://dailytrojan.com', 1, 3, 2, '', 'The Daily Trojan is the student newspaper of the University of Southern California. It is a forum for student expression and is written, edited and managed by university students.'),
(6, 'Los Angeles Community Impact (LACI)', 'http://www.usclaci.org', 7, 3, 1, 'usclaci@gmail.com ', 'Los Angeles Community Impact (LACI) is a pro-bono student consulting organization at the University of Southern California that strengthens nonprofits and small businesses in the Los Angeles area by addressing their business-related challenges.'),
(7, 'Marshall Business Network (MBN)', 'https://marshallbusinessnetwork.com', 5, 3, 1, 'uscbiznet@gmail.com', 'Marshall Business Network (MBN) is a student-run organization within the University of Southern California. MBN?s purpose is to assist students in finding their career paths. In this effort, MBN collaborates with other student organizations to create co-sponsored guest speaker events and organize corporate tours. These events are meant to inform our members of the various career opportunities in the professional world, by introducing them to recruiters and executives of various industries. We se'),
(8, 'Trojan Investing Society', 'http://trojaninvestingsociety.com', 5, 3, 1, 'tis.membership@gmail.com', 'TIS provides its members with opportunities to learn more about the financial industry through workshops, panels, and networking events. We try and connect our members with alumni, professionals, and academics who have been involved in finance in a variety of roles. Furthermore, our prestigious mentorship program for juniors pairs interested candidates with seniors who have successfully completed internships in the investment banking industry in order to help prepare them for the recruiting proc'),
(9, 'Graduate Student Consulting Club at USC ', 'https://www.facebook.com/Graduate-Student-Consulting-Club-at-USC-1067383179959800/', 5, 2, 1, 'usc.gscc@gmail.com ', 'Graduate student group at USC for whom interested in consulting careers.'),
(10, 'Chaotic 3 ', 'https://www.facebook.com/chaoticthree/', 6, 3, 7, 'chaotic3@gmail.com ', 'Chaotic 3 is the premiere Hip Hop dance team based at the University of Southern California. Originally founded as an artistic outlet for members of the Chinese American Student Association, Chaotic 3 has evolved into a well known team that strives to foster the passion for dance from new and veteran dancers alike. Through exhibition and competition performances on USC''s campus and around Southern California such as Maxt Out, Prelude aka The Bridge, Urban Street Jam, All Cal, Breakthrough Show, '),
(11, 'InterVarsity-Trojan Christian Fellowship', 'http://www.ivtcf.org', 9, 3, 7, 'intervarsitytcf@gmail.com ', 'InterVarsity-Trojan Christian Fellowship is a witnessing community of Christians growing in love for God, for God?s Word, for God?s people of every ethnicity and culture, and for God?s purposes in the world. It is committed to being a multi-ethnic community, a place where diverse groups of students become spiritual family.'),
(12, 'Marshall Wine Club', 'https://clubs.marshall.usc.edu/mwc/about/', 8, 3, 1, '', 'The Marshall Wine Club offers a fun way to learn about wine and network. We take advantage of the fantastic wine bars, wineries, and vineyards in California to learn about the different types and tastes of wine. Through social events with Marshall, other USC graduate programs, and business schools across Los Angeles, the Marshall Wine Club is a great way to network with other students. The Marshall Wine Club is about learning and networking. And so is Business School.'),
(13, 'Vietnamese Student Association ', 'http://uscvsa.com', 2, 3, 7, 'vsa@usc.edu', 'The USC Vietnamese Student Association strives to serve both USC student body and the local Los Angeles community. Through the promotion of cultural projects and events, we hope to enrich campus life and become a significant part of the diverse college community.'),
(14, 'Sigma Delta Sigma ', 'https://www.facebook.com/uscsigmadeltasigma/', 3, 3, 7, 'uscsigdelts@gmail.com', 'The purpose of this sorority is to create unity through diversity and involvement in our community. This will be accomplished through the promotion of social awareness of contemporary issues concerning all facets of the public. In addition, this organization will engage in cultural activities that advocate the understanding of different customs and traditions. Through active participation in community service, the sisters of Sigma Delta Sigma will assist in giving support to all factions of soci'),
(15, 'University Chorus of USC ', 'https://music.usc.edu/university-chorus/', 4, 3, 8, 'uschoral@usc.edu', 'The University Chorus is open to any USC student, faculty, or staff member as well as the larger university community. It provides an opportunity for members of the community to sing in a mixed chorus and perform outstanding choral music.');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `type_id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type`) VALUES
(1, 'Academic'),
(2, 'Cultural'),
(3, 'Office for Fraternity and Sorority Leadership'),
(4, 'Performance'),
(5, 'Professional'),
(6, 'Recreation'),
(7, 'Service/Volunteer'),
(8, 'Social'),
(9, 'Religious');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`),
  KEY `user_id_3` (`user_id`),
  KEY `user_id_4` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'ffdsfa', 'xueyuanw@d', '123'),
(2, 'erwer', 'xueyuanw@dsf', '123'),
(3, 'erwerwer', 'xueyuanw@dsfewr', 'erwe'),
(4, '2324', 'xueyuanw@gm', '123343'),
(6, 'sdfsf', 'xueyuanw@e', '123'),
(7, 'sdfsf2', 'xueyuanw@e', 'dfs'),
(8, 'sdfsf22', 'xueyuanw@e', 'dfd'),
(9, 'sdfsf222', 'xueyuanw@e', '33'),
(10, '3RE', 'xueyuanw@FD', '123'),
(12, '3REdf', 'xueyuanw@FD', 'sdfs'),
(13, 'xueyuanw', 'xueyuanw@dfd', '123'),
(15, 'xxx', 'xueyuanw@gmail.com', '123'),
(16, 'abc', 'abc@gmail.com', 'abc'),
(17, 'woshishi', 'yingtonglei@gmail.com', '123456'),
(18, 'www', 'www@gmail.com', '123'),
(19, 'xueyuanwang07', 'xueyuanwang07@gmail.com', 'nxe-DFF-x7G-EQe'),
(20, 'tommy', 'tommy@usc.edu', '123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_organizations`
--
ALTER TABLE `student_organizations`
  ADD CONSTRAINT `function_id` FOREIGN KEY (`function_id`) REFERENCES `function` (`function_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `involvement_id` FOREIGN KEY (`involvement_id`) REFERENCES `involvement` (`involvement_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `type_id` FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
