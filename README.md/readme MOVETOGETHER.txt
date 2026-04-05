# 🚗 MoveTogether  
Application MVC de covoiturage interne – Projet PHP


MoveTogether est une application web permettant aux employés d’une entreprise de proposer et réserver des trajets en covoiturage.  
Le projet est développé en PHP (sans framework), en architecture MVC, avec PDO et MySQL.


---


## 📌 Fonctionnalités principales


### 👤 Authentification
- Connexion utilisateur
- Déconnexion
- Gestion des rôles : `user` et `admin`


### 🚗 Utilisateurs (role: user)
- Proposer un trajet
- Modifier un trajet
- Supprimer un trajet
- Voir les trajets disponibles


### 🛠️ Administration (role: admin)
- Tableau de bord
- Gestion des utilisateurs
- Gestion des agences
- Gestion des trajets


---


## 🏗️ Architecture MVC


movetogether/
│
├── App/
│   ├── Controllers/
│   │     ├── AuthController.php
│   │     ├── HomeController.php
│   │     ├── TrajetController.php
│   │     └── AdminController.php
│   │
│   ├── Core/
│   │     ├── Auth.php
│   │     ├── Controller.php
│   │     ├── Database.php
│   │     └── Session.php
│   │
│   ├── Models/
│   │     ├── User.php
│   │     ├── Agence.php
│   │     └── Trajet.php
│   │
│   └── Views/
│         ├── layout/
│         │     └── base.php
│         │
│         ├── home/
│         │     └── index.php
│         │
│         ├── auth/
│         │     └── login.php
│         │
│         ├── trajet/
│         │     ├── create.php
│         │     ├── edit.php
│         │     └── detailsModal.php
│         │
│         └── admin/
│               ├── dashboard.php
│               ├── users.php
│               ├── agences.php
│               ├── agenceCreate.php
│               ├── agenceEdit.php
│               └── trajets.php
│
├── config/
│     └── config.php
│
├── database/
│     └── seed.sql
│
├── public/
│     ├── css/
│     │     └── style.css
│     ├── js/
│     │     └── script.js
│     └── index.php  
│
├── .gitignore
├── README.md
└── tests        








---


## 🗄️ Base de données


Le fichier `database/seed.sql` contient :
- la création des tables
- un administrateur
- des utilisateurs
- des agences
- des trajets de démonstration


### Identifiants admin par défaut
Email : admin@movetogether.fr 
Mot de passe : password




---


## ⚙️ Installation


### 1. Cloner le projet
git clone https://github.com/BarclaisC/movetogether.git


### 2. Importer la base de données
Importer `database/seed.sql` dans phpMyAdmin.


### 3. Configurer la connexion MySQL
Modifier `config/config.php` :


```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'movetogether');
define('DB_USER', 'root');
define('DB_PASS', '');
Lancer le projet
Placer le projet dans htdocs (XAMPP)
http://localhost/movetogether/index.php


🧪 Tests
Le dossier tests/ contient des tests unitaires simples 


👩‍💻 Technologies utilisées
* PHP 8+
* MySQL / MariaDB
* PDO
* HTML / CSS
* Architecture MVC maison


📄 Licence
Projet pédagogique – libre d’utilisation dans un cadre éducatif.