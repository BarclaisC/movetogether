-- -----------------------------------------------------
-- Base de données : movetogether
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS movetogether CHARACTER SET utf8 COLLATE utf8_general_ci;
USE movetogether;

-- -----------------------------------------------------
-- Table : users
-- -----------------------------------------------------
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'user',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Données de test (mot de passe : test123)
INSERT INTO users (email, password, role) VALUES
('admin@mvt.com', '$2y$10$8bqY0u8rjv1u8Ygk0j8r8u8Ygk0j8r8u8Ygk0j8r8u8Ygk0j8r8u', 'admin'),
('user@mvt.com', '$2y$10$8bqY0u8rjv1u8Ygk0j8r8u8Ygk0j8r8u8Ygk0j8r8u8Ygk0j8r8u', 'user');

-- -----------------------------------------------------
-- Table : trajets
-- -----------------------------------------------------
CREATE TABLE trajets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ville_depart VARCHAR(255) NOT NULL,
    ville_arrivee VARCHAR(255) NOT NULL,
    date_trajet DATE NOT NULL,
    heure_trajet TIME NOT NULL,
    places INT NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Données de test
INSERT INTO trajets (ville_depart, ville_arrivee, date_trajet, heure_trajet, places, prix) VALUES
('Paris', 'Lyon', '2026-04-10', '08:00:00', 3, 29.90),
('Marseille', 'Nice', '2026-04-12', '14:30:00', 2, 15.00),
('Bordeaux', 'Toulouse', '2026-04-15', '09:15:00', 4, 19.50);

-- -----------------------------------------------------
-- Table : reservations (optionnelle)
-- -----------------------------------------------------
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    trajet_id INT NOT NULL,
    places INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (trajet_id) REFERENCES trajets(id) ON DELETE CASCADE
);