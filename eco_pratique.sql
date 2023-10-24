-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-ppasquier.alwaysdata.net
-- Generation Time: Oct 24, 2023 at 12:00 PM
-- Server version: 10.6.14-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppasquier_eco_pratique`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `action_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `type` varchar(15) NOT NULL,
  `element_id` int(11) NOT NULL,
  `old_firstname` varchar(15) DEFAULT NULL,
  `new_firstname` varchar(15) DEFAULT NULL,
  `old_email` varchar(320) DEFAULT NULL,
  `new_email` varchar(320) DEFAULT NULL,
  `old_picture` varchar(30) DEFAULT NULL,
  `new_picture` varchar(30) DEFAULT NULL,
  `old_title` varchar(50) DEFAULT NULL,
  `new_title` varchar(50) DEFAULT NULL,
  `old_content` text DEFAULT NULL,
  `new_content` text DEFAULT NULL,
  `action_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `picture` varchar(30) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_date` varchar(10) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `picture`, `title`, `content`, `created_date`, `user_id`) VALUES
(7, 'img/tree.webp', 'Bonne pratique 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '22/12/2022', 1),
(8, 'img/drop-of-water.webp', 'Bonne pratique 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '22/12/2022', 1),
(10, 'img/leaf.webp', 'Bonne pratique 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '22/12/2022', 2),
(11, 'img/lumber.webp', 'Bonne pratique 6', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '22/12/2022', 3),
(24, 'img/drop-of-water.webp', 'Bonne pratique', 'Fermer les robinets', '22/10/2023', 20),
(38, 'img/lightbulb.webp', 'Économie d\'energie', 'Éteindre les lumières inutiles ', '23/10/2023', 20),
(40, 'img/drop-of-water.webp', 'Article', 'coucou', '24/10/2023', 25);

--
-- Triggers `articles`
--
DELIMITER $$
CREATE TRIGGER `after delete article` AFTER DELETE ON `articles` FOR EACH ROW BEGIN
INSERT INTO actions (date, type, element_id, old_picture, old_title, old_content, action_user_id)
    VALUES (NOW(), 'delete article', OLD.article_id, OLD.picture, OLD.title, OLD.content, OLD.user_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after insert article` AFTER INSERT ON `articles` FOR EACH ROW BEGIN
INSERT INTO actions (date, type, element_id, new_picture, new_title, new_content, action_user_id)
    VALUES (NOW(), 'insert article', NEW.article_id, NEW.picture, NEW.title, NEW.content, NEW.user_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after update article` AFTER UPDATE ON `articles` FOR EACH ROW BEGIN
    -- Initialisation des variables pour stocker les valeurs modifiées
    DECLARE old_article_picture VARCHAR(255);
    DECLARE new_article_picture VARCHAR(255);
    DECLARE old_article_title VARCHAR(255);
    DECLARE new_article_title VARCHAR(255);
    DECLARE old_article_content VARCHAR(255);
    DECLARE new_article_content VARCHAR(255);

    -- Vérifier si la colonne name a été modifiée
    IF OLD.picture <> NEW.picture THEN
        SET old_article_picture = OLD.picture;
        SET new_article_picture = NEW.picture;
    ELSE
        SET old_article_picture = NULL;
        SET new_article_picture = NULL;
    END IF;
    
    IF OLD.title <> NEW.title THEN
        SET old_article_title = OLD.title;
        SET new_article_title = NEW.title;
    ELSE
        SET old_article_title = NULL;
        SET new_article_title = NULL;
    END IF;
    
    IF OLD.content <> NEW.content THEN
        SET old_article_content = OLD.content;
        SET new_article_content = NEW.content;
    ELSE
        SET old_article_content = NULL;
        SET new_article_content = NULL;
    END IF;

INSERT INTO actions
    (date, type, element_id, old_picture, new_picture, old_title, new_title, old_content, new_content, action_user_id)
VALUES
    (NOW(), 'update article', OLD.article_id, old_article_picture, new_article_picture, old_article_title, new_article_title, old_article_content, new_article_content, NEW.user_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(15) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL,
  `role` varchar(7) DEFAULT 'editeur',
  `user_created_date` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `password`, `email`, `role`, `user_created_date`) VALUES
(1, 'Admin', '$2y$10$5PfYCj3bTnXju.FNcvguBewqRa71RTiVXwYLcvbUtf5Yh9Tng.XxK', 'mail@exemple.fr', 'admin', ''),
(2, 'Bob', '$2y$10$CvGVRgf4wGTggiER0GiY7eO3QaZKDCT7gTJ8bkhYaAi3vLQM.I2Ze', 'mail@exemple.fr', 'editeur', ''),
(3, 'Pauline', '$2y$10$k56KirC1BPVYZeKr/A.qBeQcQyC8gGs4eKldMR/2LNU4YwJY5uNZi', 'mail@exemple.fr', 'editeur', ''),
(7, 'Plop', '$2y$10$GUDr5t4YLRQS/X2UPJpBOOALO0uJ5Hg/jjHMrZgBX0ai7FMzoOgS6', 'mail@exemple.fr', 'editeur', ''),
(20, 'Clément ', '$2y$10$tQ/tqcwLFzNDaD8DhOySPeEYVK7pa4l0XHAvmpoak7la8V7x3y2Ba', 'mail@exemple.fr', 'editeur', '22/10/2023'),
(25, 'Patrick', '$2y$10$5cZM/7pUvc81c8VMREneGeVC7naUZ56efuxXC2T/kgGcf0Ty4tBAi', 'mail@exemple.fr', 'editeur', '23/10/2023'),
(31, 'Pauline', '$2y$10$vBawYkBpExuhjbSzAmSyiuZCEKKmMXnmmTASKn4mNbo0EB/0jAsEm', 'mail@exemple.fr', 'editeur', '24/10/2023');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after delete user` AFTER DELETE ON `users` FOR EACH ROW BEGIN
INSERT INTO actions (date, type, element_id, old_firstname, old_email, action_user_id)
    VALUES (NOW(), 'delete user', OLD.user_id, OLD.firstname, OLD.email, OLD.user_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after update user` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
    -- Initialisation des variables pour stocker les valeurs modifiées
    DECLARE old_user_firstname VARCHAR(255);
    DECLARE new_user_firstname VARCHAR(255);
    DECLARE old_user_email VARCHAR(255);
    DECLARE new_user_email VARCHAR(255);

    -- Vérifier si la colonne name a été modifiée
    IF OLD.firstname <> NEW.firstname THEN
        SET old_user_firstname = OLD.firstname;
        SET new_user_firstname = NEW.firstname;
    ELSE
        SET old_user_firstname = NULL;
        SET new_user_firstname = NULL;
    END IF;
    
    IF OLD.email <> NEW.email THEN
        SET old_user_email = OLD.email;
        SET new_user_email = NEW.email;
    ELSE
        SET old_user_email = NULL;
        SET new_user_email = NULL;
    END IF;


INSERT INTO actions
    (date, type, element_id, old_firstname, new_firstname, old_email, new_email, action_user_id)
VALUES
    (NOW(), 'update user', OLD.user_id, old_user_firstname, new_user_firstname, old_user_email, new_user_email, NEW.user_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_user` AFTER INSERT ON `users` FOR EACH ROW BEGIN
INSERT INTO actions (date, type, element_id, new_firstname, new_email, action_user_id)
    VALUES (NOW(), 'insert user', NEW.user_id, NEW.firstname, NEW.email, NEW.user_id);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `id_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
