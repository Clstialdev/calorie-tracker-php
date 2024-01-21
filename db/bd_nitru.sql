-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : mer. 17 jan. 2024 à 15:15
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2


SET sql_mode = 'NO_ZERO_DATE,NO_ZERO_IN_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_nitru`
--

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `calorie_per_serving` float DEFAULT NULL,
  `serving_size` float DEFAULT NULL,
  `unity_of_measure` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `nutritionist_client`
--

CREATE TABLE `nutritionist_client` (
  `client_id` int(11) NOT NULL,
  `nutritionist_id` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `period` int(11) DEFAULT NULL,
  `total_length` int(11) DEFAULT NULL,
  `median_caloric_value` float DEFAULT NULL,
  `creator` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `plan_recipes`
--

CREATE TABLE `plan_recipes` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(5, 'ahfqfqfg@gmail.com', 'd32637585e2a89fb', '$2y$10$ancCpDAVRIHXZTBUGr87.eRVl7fwyEkdiQwHkmZoxz7I1rdIMTJQu', '1705419153');

-- --------------------------------------------------------

--
-- Structure de la table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `calories` float DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `visibility` tinyint(1) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `creator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `recipe_ingredient`
--

CREATE TABLE `recipe_ingredient` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `ingredient_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `active` int(10) NOT NULL,
  `creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP, ---- a posé problème
  `age` int(11) DEFAULT NULL,
  `role` varchar(250) NOT NULL DEFAULT 'Regular',
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `daily_caloriegoal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `fullname`, `password`, `email`, `active`, `creation_date`, `age`, `role`, `height`, `weight`, `daily_caloriegoal`) VALUES
(14, 'Ahmed', '$2y$10$mbyoMTM2H/gs/LAWfzmKrepZ46W0TXZAhINCe4r5YJPgJBcbEdfKi', 'Fateh@gmail.com', 1, '2024-01-15', NULL, 'Regular', NULL, NULL, NULL),
(15, 'Ahmed', '$2y$10$mycVkeV2SdjNWTwufSYBtODnd8kEcIo1aJDBl/2S7xrACZ7oe6KuW', 'ahmed.boulaabi0306@gmail.com', 1, '2024-01-15', NULL, 'Regular', NULL, NULL, NULL),
(16, 'dddd', '$2y$10$Hnl0hFojty8biPvG.mQyCeJkdequvRSr93oPvn6gJMfRvVztFK2fm', 'ahmelaabi0306@gmail.com', 1, '2024-01-15', NULL, 'Regular', NULL, NULL, NULL),
(17, 'ahmed.boulaabi0306@gmail.com', '$2y$10$GQNLknuIjwYsmLSGxUW9DezfncGJ3V9Fa2nZ1zcdQjFYn2VwpqrHe', 'aoulaabi0306@gmail.com', 1, '2024-01-15', NULL, 'Regular', NULL, NULL, NULL),
(18, 'ahm0306@gmail.com', '$2y$10$MqcnnyBW8EpsaLAd6VOBCO9aq3rzna1bTngVo1UhMPIjFNGAJAqtu', 'ahmedbi0306@gmail.com', 1, '2024-01-15', NULL, 'Regular', NULL, NULL, NULL),
(19, 'fergz', '$2y$10$7TVg.lLIyqq77DYcy6bi.OrHvIrLPfkodfwZvlUgQArtayqKASIKq', 'fathhh306@gmail.com', 1, '2024-01-15', NULL, 'Regular', NULL, NULL, NULL),
(20, 'Fateh', '$2y$10$CrY.JpmeV98E8q.L/xZigOwR4myofRXIswX9cOhCeT/gDJBcsAXGe', 'Fatehddd@gmail.com', 1, '2024-01-15', NULL, 'Regular', NULL, NULL, NULL),
(21, 'azd', '$2y$10$S8O0dMyESYeCOChU9DVSNO9JpEYB.hA5vdVMMtb/mrqZSOItb8o1C', 'ah@gmail.com', 1, '2024-01-15', NULL, 'Regular', NULL, NULL, NULL),
(22, 'sqxc', '$2y$10$vyQuHSxobqCkEoO.mFbE3.pn7EfN3x6ums1XH0Tv7.5.UU.Ff6Cai', '', 1, '2024-01-15', NULL, 'Regular', NULL, NULL, NULL),
(23, 'fggtr', '$2y$10$tkg3qooMnCgvQsMBXuSFm.Md6CcalNcZlJ0oVkFb6y67SqHxATw/i', 'ad@gmail.com', 1, '2024-01-15', NULL, 'Regular', NULL, NULL, NULL),
(24, 'dsqd', '$2y$10$JVMTuJ7EuPgsc/fKlDIuieC2m4AjT7TKzu05mDDvuC.Mvq563sTie', 'ahmed.bou6@gmail.com', 1, '2024-01-15', NULL, 'Regular', NULL, NULL, NULL),
(25, 'achraf', '$2y$10$VOPbQr6XAM4qNCrMRBGDmOACaYEeCMbkkOyb/T905/CHV36fx2Bte', 'achraf@gmail.com', 1, '2024-01-16', NULL, 'Regular', NULL, NULL, NULL),
(26, 'Ahmed Boulaabi', '$2y$10$VlgcfsEJII4Kjfnukydsa.46dmY40mg7DUzE2hNHl2ZYxyAm1lz4O', 'ahmed@gmail.com', 1, '2024-01-16', NULL, 'Regular', NULL, NULL, NULL),
(27, 'Elias', '$2y$10$Ub3J0R85f3cHkvQoGhjIn.WsesmZhXzsHCo/ztObUTwMKYEf6f5Q2', 'elias@gmail.com', 1, '2024-01-17', NULL, 'Regular', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_plan`
--

CREATE TABLE `user_plan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `managed_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nutritionist_client`
--
ALTER TABLE `nutritionist_client`
  ADD PRIMARY KEY (`client_id`,`nutritionist_id`);

--
-- Index pour la table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator` (`creator`);

--
-- Index pour la table `plan_recipes`
--
ALTER TABLE `plan_recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Index pour la table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Index pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator` (`creator`);

--
-- Index pour la table `recipe_ingredient`
--
ALTER TABLE `recipe_ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_plan`
--
ALTER TABLE `user_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `managed_by` (`managed_by`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `nutritionist_client`
--
ALTER TABLE `nutritionist_client`
  ADD CONSTRAINT `nutritionist_client_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `plan_recipes`
--
ALTER TABLE `plan_recipes`
  ADD CONSTRAINT `plan_recipes_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`),
  ADD CONSTRAINT `plan_recipes_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);

--
-- Contraintes pour la table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `recipe_ingredient`
--
ALTER TABLE `recipe_ingredient`
  ADD CONSTRAINT `recipe_ingredient_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  ADD CONSTRAINT `recipe_ingredient_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`);

--
-- Contraintes pour la table `user_plan`
--
ALTER TABLE `user_plan`
  ADD CONSTRAINT `user_plan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_plan_ibfk_2` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`),
  ADD CONSTRAINT `user_plan_ibfk_3` FOREIGN KEY (`managed_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
