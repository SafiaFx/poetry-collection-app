# ************************************************************
# Sequel Ace SQL dump
# Version 20062
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 11.2.2-MariaDB-1:11.2.2+maria~ubu2204)
# Database: collector-app
# Generation Time: 2024-02-26 12:06:46 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table artist-works
# ------------------------------------------------------------

DROP TABLE IF EXISTS `artist-works`;

CREATE TABLE `artist-works` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `verses` text DEFAULT NULL,
  `date` year(4) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `artist-works` WRITE;
/*!40000 ALTER TABLE `artist-works` DISABLE KEYS */;

INSERT INTO `artist-works` (`id`, `name`, `image`, `type`, `about`, `verses`, `date`)
VALUES
	(1,'Take me home','https://ramseyvoice.com/wp-content/uploads/2020/06/African-American-Man-Singing-in-Microphone.jpg','poetry','Poem about home\n','Oh give me a home\nwith a big landscaped lawn\nfour cars, a boat and a kitty.\nFor my heart yearns to be\nany place that is free\nof the urban decay of this city.\nI’ll do my shopping at Gucci’s and Sak’s,\nspend all of my days at the malls.\nCharge my Armani’s and Klein’s—\nI’ll look so divine\nnibbling caviar at charity balls.\nI’ll have two children—\nCarson and Dawn—\nnot lil’ Counts, Sinbads or Foxies.\nThey won’t sell no dope.\nThey’ll know how to cope\nand grow up to be good little Nazis.\nI’ll take a lover\nwho’ll look like Val Kilmer\nand he’ll give me all I desire.\nWe won’t bicker or fight.\nWe’ll make love every night\nand join swing clubs\nto light up his fire.\nWe’ll own a Bugatti, a Fiat, a Porche,\ndriving with class all the way.\nWe’ll buy Dawn a Viper\nand Carson a Vette\nand to hell with the damned R.T.A.!\nI’ll spend my hours playing\ntennis and bridge,\ncroquette and maybe some cricket.\nI’ll join posh country clubs\nwhile my maids clean and scrub\nand I’ll vote the Republican ticket.\nGourmet food, vintage wine,\noh, life will be fine.\nThe Reagans will move in next door.\nThere’ll be no welfare cases,\nthey’ll say we are racists\nbut we won’t live in fear\nfor our lives anymore.\nOh please give me a home\nwith a huge landscaped lawn,\na yacht and a pedigreed kitty.\nFor my heart yearns to be\nanywhere that is free\nfrom the rot and the dirt\nof this city.','2016'),
	(2,'Vispera verse','http://dummyimage.com/148x100.png/cc0000/ffffff','music','Music created by E',NULL,'2022'),
	(3,'Lone Pine','http://dummyimage.com/148x100.png/cc0000/ffffff','music','Music created by V',NULL,'2022'),
	(4,'Japanese Pieris and their link to poetry','https://cdn-images-1.medium.com/max/853/1*0AnV-ZVBwaa57yomRnmJpg.jpeg','other','Collaboration podcast with XYZ',NULL,'2024'),
	(5,'Creative Youth piece','https://www.york.psu.edu/sites/york/files/styles/top_feature_area/public/freequency.jpg?itok=tvn3-4aS','poetry','Works done with Creative Youth ','Pretty women wonder where my secret lies.\nI\'m not cute or built to suit a fashion model\'s size\nBut when I start to tell them,\nThey think I\'m telling lies.\nI say,\nIt\'s in the reach of my arms\nThe span of my hips,\nThe stride of my step,\nThe curl of my lips.\nI\'m a woman\nPhenomenally.\nPhenomenal woman,\nThat\'s me.\n\nI walk into a room\nJust as cool as you please,\nAnd to a man,\nThe fellows stand or\nFall down on their knees.\nThen they swarm around me,\nA hive of honey bees.\nI say,\nIt\'s the fire in my eyes,\nAnd the flash of my teeth,\nThe swing in my waist,\nAnd the joy in my feet.\nI\'m a woman\nPhenomenally.\nPhenomenal woman,\nThat\'s me.\n\nMen themselves have wondered\nWhat they see in me.\nThey try so much\nBut they can\'t touch\nMy inner mystery.\nWhen I try to show them\nThey say they still can\'t see.\nI say,\nIt\'s in the arch of my back,\nThe sun of my smile,\nThe ride of my breasts,\nThe grace of my style.\nI\'m a woman\n\nPhenomenally.\nPhenomenal woman,\nThat\'s me.\n\nNow you understand\nJust why my head\'s not bowed.\nI don\'t shout or jump about\nOr have to talk real loud.\nWhen you see me passing\nIt ought to make you proud.\nI say,\nIt\'s in the click of my heels,\nThe bend of my hair,\nthe palm of my hand,\nThe need of my care,\n\'Cause I\'m a woman\nPhenomenally.\nPhenomenal woman','2014'),
	(6,'Creatures','https://images.unsplash.com/photo-1607301614848-2341363f5f48?q=80&w=1587&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D','poetry','Poem written with ABC','This is the last complete poem composed by ABC',NULL);

/*!40000 ALTER TABLE `artist-works` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
