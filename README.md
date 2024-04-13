# Projet Symfony "Forum"

Bienvenue sur notre projet de forum. Le but de ce projet est de créer un forum pour une entreprise en interne.

## Sommaire
- Mise en place du projet
- Découpage du projet
- Fonctionnalités présentes et opérationnelles
- Sources utilisées
- Chargement des données de la base

### Mise en place du projet
Pour ce projet, nous étions composés de 2 développeurs front, et 1 développeur back. Nous nous sommes repartis les tâches afin de travailler le plus efficacement possible tout en permettant à chacun d'acquérir des compétences en Symfony.

### Découpage du projet
Nous avons décidé de décomposer le projet sur la première journée, de sorte à ce que tout soit clair pour tout le monde et que nous ne partions pas dans toutes les directions. Pour ce faire, nous avons décidé de nous répartir les tâches comme suit :
- Mise en place des entités par tout le monde dans le projet.
- Création de l'authentification et du user.
- Mise en place des routes pour les différents rôles (admin, insider, externe et collaboration).
- Création des contrôleurs pour l'affichage des topics et des messages.
- Création des contrôleurs pour les affichages des catégories et des tableaux.
- Création des méthodes pour créer des catégories, boards, topics, messages.
- Mise en place du CRUD pour les admins.
- Envoi des fichiers.
- Rédaction du Readme.

### Fonctionnalités présentes et opérationnelles
- Inscription, authentification, accès au compte.
- Modification des informations personnelles.
- Consultation des catégories, boards, topics et messages.
- Rédaction de catégories, boards, topics et messages.
- CRUD pour les admins, pour l'administration des admins, topics, catégories et boards.

### Sources utilisées
- Pour la partie administration : [EasyAdminBundle](https://symfony.com/bundles/EasyAdminBundle/current/crud.html)
- Pour la génération de fixtures : [DoctrineFixturesBundle](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html)

### Chargement des données de la base
- Pour le chargement des données en base de données, nous avons créé des données de test (fixtures). Pour les charger, il suffit d'exécuter :
  `php bin/console doctrine:fixtures:load` ou bien `symfony console doctrine:fixtures:load`
- Un fichier `export-sql.sql` à la racine du projet Symfony contient les différentes tables et données de notre base pour une implémentation rapide.

### Auteurs
- Maël Badet
- Killian Vincent
- Léon Gallet