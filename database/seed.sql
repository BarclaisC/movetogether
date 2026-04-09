-- ============================================
-- RESET DES TABLES
-- ============================================

DROP TABLE IF EXISTS trajets;
DROP TABLE IF EXISTS agences;
DROP TABLE IF EXISTS users;

-- ============================================
-- TABLE USERS
-- ============================================

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telephone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user'
);

-- ============================================
-- TABLE AGENCES
-- ============================================

CREATE TABLE agences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL
);

-- ============================================
-- TABLE TRAJETS
-- ============================================

CREATE TABLE trajets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    agence_depart_id INT NOT NULL,
    agence_arrivee_id INT NOT NULL,
    date_depart DATETIME NOT NULL,
    date_arrivee DATETIME NOT NULL,
    places_total INT NOT NULL,
    places_disponibles INT NOT NULL,
    user_id INT NOT NULL,

    FOREIGN KEY (agence_depart_id) REFERENCES agences(id),
    FOREIGN KEY (agence_arrivee_id) REFERENCES agences(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- ============================================
-- INSERTION DES UTILISATEURS
-- ============================================

INSERT INTO users (nom, prenom, email, telephone, password, role) VALUES
('Admin', 'Super', 'admin@movetogether.fr', '0600000000', 
 '$2y$10$Qe0X9Q0pVxX3n0uY1Zp7UuYtYp8E9Q0pVxX3n0uY1Zp7UuYtYp8E', 'admin'),
('Dupont', 'Marie', 'marie.dupont@example.com', '0612345678',
 '$2y$10$Qe0X9Q0pVxX3n0uY1Zp7UuYtYp8E9Q0pVxX3n0uY1Zp7UuYtYp8E', 'user'),
('Martin', 'Lucas', 'lucas.martin@example.com', '0698765432',
 '$2y$10$Qe0X9Q0pVxX3n0uY1Zp7UuYtYp8E9Q0pVxX3n0uY1Zp7UuYtYp8E', 'user');

-- Le mot de passe hashé correspond à : "Admin12"

-- ============================================
-- INSERTION DES AGENCES
-- ============================================

INSERT INTO agences (nom) VALUES
('Paris Gare de Lyon'),
('Paris Montparnasse'),
('Lyon Part-Dieu'),
('Marseille Saint-Charles'),
('Bordeaux Saint-Jean');

-- ============================================
-- INSERTION DES TRAJETS
-- ============================================

INSERT INTO trajets (
    agence_depart_id, agence_arrivee_id, date_depart, date_arrivee,
    places_total, places_disponibles, user_id
) VALUES
(1, 3, '2026-04-10 08:00:00', '2026-04-10 12:00:00', 4, 4, 2),
(2, 4, '2026-04-12 09:30:00', '2026-04-12 15:00:00', 3, 2, 3),
(5, 1, '2026-04-15 14:00:00', '2026-04-15 18:00:00', 5, 5, 2);