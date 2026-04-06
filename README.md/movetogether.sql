-- Base de données : movetogether

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- TABLE : agences
-- --------------------------------------------------------

DROP TABLE IF EXISTS `agences`;
CREATE TABLE `agences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `agences` (`id`, `nom`) VALUES
(1, 'Paris Gare de Lyon'),
(2, 'Paris Montparnasse'),
(3, 'Lyon Part-Dieu'),
(4, 'Marseille Saint-Charles'),
(5, 'Bordeaux Saint-Jean');

-- --------------------------------------------------------
-- TABLE : users
-- --------------------------------------------------------

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `telephone`, `password`, `role`) VALUES
(1, 'Admin', 'Super', 'admin@movetogether.fr', '0600000000', '$2y$10$8PA2.b5UT0w59vRtbPTXsuA0cKiQVGLO3UTrCBKysEuk07mcrQSC.', 'admin'),
(2, 'Dupont', 'Marie', 'marie.dupont@example.com', '0612345678', '$2y$10$EPsXOQSYSCAdy7ZE7mHPr.MWbo2JwJpuietseKpqMRRZTyQdUBIna', 'user'),
(3, 'Martin', 'Lucas', 'lucas.martin@example.com', '0698765432', '$2y$10$pneeQDLh2xsV98AB.35K2e5hpUz9kLvSFL8v7V7UgOZp5mgZjYd/y', 'user');

-- --------------------------------------------------------
-- TABLE : trajets
-- --------------------------------------------------------

DROP TABLE IF EXISTS `trajets`;
CREATE TABLE `trajets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agence_depart_id` int(11) NOT NULL,
  `agence_arrivee_id` int(11) NOT NULL,
  `date_depart` datetime NOT NULL,
  `date_arrivee` datetime NOT NULL,
  `places_total` int(11) NOT NULL,
  `places_disponibles` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_trajets_user` (`user_id`),
  KEY `fk_trajets_agence_depart` (`agence_depart_id`),
  KEY `fk_trajets_agence_arrivee` (`agence_arrivee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `trajets` (`id`, `agence_depart_id`, `agence_arrivee_id`, `date_depart`, `date_arrivee`, `places_total`, `places_disponibles`, `user_id`) VALUES
(1, 1, 3, '2026-04-10 08:00:00', '2026-04-10 12:00:00', 4, 4, 2),
(2, 2, 4, '2026-04-12 09:30:00', '2026-04-12 15:00:00', 3, 2, 3),
(3, 5, 1, '2026-04-15 14:00:00', '2026-04-15 18:00:00', 5, 5, 2);

-- --------------------------------------------------------
-- FOREIGN KEYS
-- --------------------------------------------------------

ALTER TABLE `trajets`
  ADD CONSTRAINT `fk_trajets_agence_arrivee` FOREIGN KEY (`agence_arrivee_id`) REFERENCES `agences` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_trajets_agence_depart` FOREIGN KEY (`agence_depart_id`) REFERENCES `agences` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_trajets_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

COMMIT;