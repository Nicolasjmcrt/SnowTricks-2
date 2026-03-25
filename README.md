# SnowTricks - Communauté de Snowboard

![Symfony](https://img.shields.io/badge/Symfony-7.x-000000?style=for-the-badge&logo=symfony)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap)

## 🏂 Présentation du projet
**SnowTricks** est une plateforme collaborative dédiée aux passionnés de snowboard. Ce projet est réalisé dans le cadre du parcours **Développeur d'Application PHP / Symfony** d'OpenClassrooms.

L'objectif est de créer un site communautaire permettant de :
* Consulter une liste de figures de snowboard (Tricks).
* Visualiser les détails d'une figure (Description, groupe, images et vidéos).
* Participer à la vie de la communauté via un espace de discussion (Commentaires).
* Gérer le catalogue de figures (Création, Modification, Suppression) pour les membres inscrits.

## 🚀 Fonctionnalités principales
* **Gestion des figures :** CRUD complet avec gestion multi-médias (Images & Vidéos Embed).
* **Espace membre :** Inscription, connexion et réinitialisation de mot de passe.
* **Commentaires :** Système de discussion avec pagination (Load More).
* **Responsive Design :** Interface optimisée pour Mobile et Desktop selon les wireframes officiels.

## 🛠️ Installation & Configuration

### Pré-requis
* PHP 8.2 ou supérieur
* Composer
* Symfony CLI
* MySQL / MariaDB

### Étapes d'installation
1.  **Cloner le dépôt :**
    ```bash
    git clone https://github.com/Nicolasjmcrt/SnowTricks-2.git
    cd snowtricks-2
    ```

2.  **Installer les dépendances :**
    ```bash
    composer install
    ```

3.  **Configurer l'environnement :**
    Copiez le fichier `.env` en `.env.local` et modifiez la ligne `DATABASE_URL` avec vos identifiants :
    ```text
    DATABASE_URL="mysql://root:password@127.0.0.1:3306/snowtricks-2?serverVersion=8.0"
    ```

4.  **Créer la base de données et les tables :**
    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

5.  **Lancer le serveur :**
    ```bash
    symfony serve
    ```

## 📂 Architecture du projet
Le projet suit l'architecture standard de **Symfony 7** :
* `src/Entity` : Modèles de données (Tricks, Users, Comments, Media).
* `src/Controller` : Logique de routage et rendu des pages.
* `src/Form` : Définition des formulaires (TrickType, CommentType, etc.).
* `templates/` : Vues Twig organisées par modules.
* `public/uploads/` : Dossier de stockage des médias uploadés.

## 🎨 Design
Le projet respecte scrupuleusement les wireframes fournis. L'interface utilise **Bootstrap 5** pour le styling et **FontAwesome** pour les icônes.

## 👨‍💻 Auteur
* **Jumeaucourt / Nicolas** - *Développeur PHP Symfony*