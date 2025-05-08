-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 08 mai 2025 à 13:14
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cabinet_medical`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`name`, `email`, `subject`, `message`) VALUES
('', '', '', ''),
('', '', '', ''),
('', '', '', ''),
('', '', '', ''),
('LAOUY SALMA', 'salmalaouy83@gmail.com', 'demande de certificat medical', 'dkkks'),
('hind', 'salmalaouy83@gmail.com', 'demande de certificat medical', 'demande de certificat medical'),
('LAOUY SALMA', 'salmalaouy83@gmail.com', 'demande de certificat medical', 'ssasasaajjjjjaa'),
('lwalida', 'salmalaouy83@gmail.com', 'demande de certificat medical', 'ajjaja'),
('LAOUY SALMA', 'salmalaouy83@gmail.com', 'demande de certificat medical', 'jcdjsJ');

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE `rdv` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `rdv_date` date NOT NULL,
  `rdv_time` time NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rdv`
--

INSERT INTO `rdv` (`id`, `full_name`, `email`, `phone`, `rdv_date`, `rdv_time`, `doctor`, `created_at`, `status`) VALUES
(1, 'LAOUY SALMA', 'salmalaouy83@gmail.com', '0645362198', '0000-00-00', '00:00:00', 'Dr Nadia Ben Salah (Pédiatre)', '0000-00-00 00:00:00', 'pending'),
(2, 'LAOUY SALMA', 'salmalaouy83@gmail.com', '0645362198', '0000-00-00', '00:00:00', 'Dr Nadia Ben Salah (Pédiatre)', '0000-00-00 00:00:00', 'pending'),
(3, 'saluuu', 'salmalaouy83@gmail.com', '0645362198', '0000-00-00', '00:00:00', 'Dr Nadia Ben Salah (Pédiatre)', '0000-00-00 00:00:00', 'pending'),
(4, 'sali ', 'aishaasma2004@gmail.com', '0712415668', '0000-00-00', '00:00:00', 'Dr Youssef Mahdi (Généraliste)', '0000-00-00 00:00:00', 'pending'),
(5, 'sali ', 'aishaasma2004@gmail.com', '0712415668', '0000-00-00', '00:00:00', 'Dr Youssef Mahdi (Généraliste)', '0000-00-00 00:00:00', 'pending'),
(6, 'sali ', 'aishaasma2004@gmail.com', '0712415668', '0000-00-00', '00:00:00', 'Dr Youssef Mahdi (Généraliste)', '0000-00-00 00:00:00', 'pending'),
(7, 'sali ', 'aishaasma2004@gmail.com', '0712415668', '0000-00-00', '00:00:00', 'Dr Youssef Mahdi (Généraliste)', '0000-00-00 00:00:00', 'pending'),
(8, 'LAOUY ASMA', 'aishaasma2004@gmail.com', '0712415668', '0000-00-00', '00:00:00', 'Dr Youssef Mahdi (Généraliste)', '0000-00-00 00:00:00', 'pending'),
(9, 'LAOUY ASMA', 'aishaasma2004@gmail.com', '0712415668', '0000-00-00', '00:00:00', 'Dr Youssef Mahdi (Généraliste)', '0000-00-00 00:00:00', 'pending'),
(10, 'sali ', 'aishaasma2004@gmail.com', '0712415668', '0000-00-00', '00:00:00', 'Dr Youssef Mahdi (Généraliste)', '0000-00-00 00:00:00', 'pending'),
(11, 'sali ', 'aishaasma2004@gmail.com', '0712415668', '0000-00-00', '00:00:00', 'Dr Youssef Mahdi (Généraliste)', '0000-00-00 00:00:00', 'pending'),
(12, 'hiba ouiraouane', 'hibaouiraouane@gmail.com', '0600000000', '0033-02-12', '16:00:00', 'Dr Nadia Ben Salah (Pédiatre)', '0000-00-00 00:00:00', 'pending'),
(13, 'fatima_ezzahra', 'fatima_ezzahra@gmail.com', '06000000000000', '0000-00-00', '14:00:00', 'Dr Youssef Mahdi (Généraliste)', '0000-00-00 00:00:00', 'pending'),
(14, 'hafsa ', 'hafsa@gmail.com', '0606070707', '2026-01-11', '15:00:00', 'Dr Youssef Mahdi (Généraliste)', '0000-00-00 00:00:00', 'pending'),
(15, 'LAOUY SALMA', 'salmalaouy83@gmail.com', '0645362198', '0577-04-04', '15:00:00', 'Dr Youssef Mahdi (Généraliste)', '0000-00-00 00:00:00', 'pending'),
(16, 'LAOUY SALMA', 'salmalaouy83@gmail.com', '0645362198', '0577-04-04', '15:00:00', 'Dr Youssef Mahdi (Généraliste)', '0000-00-00 00:00:00', 'pending'),
(17, 'LAOUY SALMA', 'salmalaouy83@gmail.com', '0645362198', '2025-05-22', '16:00:00', 'Dr Youssef Mahdi (Généraliste)', '0000-00-00 00:00:00', 'pending');

-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

CREATE TABLE `rendezvous` (
  `id` int(11) NOT NULL,
  `id_patient` int(11) DEFAULT NULL,
  `id_medecin` int(11) DEFAULT NULL,
  `date_rdv` datetime DEFAULT NULL,
  `sujet` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `role` enum('patient','medecin','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_patient` (`id_patient`),
  ADD KEY `id_medecin` (`id_medecin`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD CONSTRAINT `rendezvous_ibfk_1` FOREIGN KEY (`id_patient`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rendezvous_ibfk_2` FOREIGN KEY (`id_medecin`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
