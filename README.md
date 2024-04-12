# projet symfony "Forum"
Bienvenu sur notre projet de forum. Le but de ce projet est de 
creer un forum pour une entreprise en interne.

## Sommaire
- Mise en place du projet 
- decomposition du projet
- fonctionnalite presentes et fonctionnelles
- sources utilisee 
- Chargement des donnees de la base

### Mise en place du projet
Pour ce projet, il y avais 2 developpeur front, et 1 developpeur back.
Nous nous sommes donc repartis les taches pour allez le plus vite possible toute
en permettant a chacun d'acquerir des comptetences en Symfony.

### decomposition du projet
Nous avons decider de faire, sur la premiere journee, la decomposition du projet
de facon a ce que tout soit clair pour tout le monde et qu'on ne partent pas
dans toutes les directions. Pour ce faire, on  decider de ce repartir les 
taches comme suit : 
- Mise en place des entites par tout le monde dans le projet.
- Creation de l'authentification et du user
- Mise en place des routes pour les differents roles (admin,insider,externe et collaboration)
- creations des controlleurs pour l'affichage des topics et des messages
- Creation des controller pour les affichages des categories et des tableaux
- Creation des methodes pour creer des categorie, board, topics, messages
- Mise en place du crud pour les admins
- Envoie des fichiers 
- redaction du readme

### fonctionnalite presentes et fonctionnelles
- Inscription, authentification, acces au compte
- modification des informations personnelles
- lecture des categories, board, topics et messages
- redaction de categories, boards, topics et messages
- CRUD admin, pour l'administration des admins, topics, categories et boards

### sources utilisee
- pour la partie administration : https://symfony.com/bundles/EasyAdminBundle/current/crud.html
- pour les generations de fixtures : https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html

### Chargement des donnees de la base
- Pour les chargements des donnes en base de donner, nous avons fais des donnees de test (fixtures)
pour les charger, il suffit de faire :
`php bin/console doctrine:fixtures:load` ou bien `symfony console doctrine:fixtures:load`

- Sinon a la racine du projet symfony, un fichier export-sql.sql contiens les 
- differentes tables, donnees de notre base pour une implementation rapide
