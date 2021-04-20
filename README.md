# kalitics
Test solution NB : la version utilisés sur mon oridnateur était sur du PHP8 vu les annotation des routes 
-test fonctionnel en local à mon niveau
Développement de la solution test sur un environement symfony 4 /5.2  , environement PHP 8

A) installer le projet symfony avec composer composer create-project symfony/skeleton , le clone avec git clone
2) Mise en place de la base de données dans le fichier .env  creation de la base de données avec php/bin/console doctrine:database:created
3) génération des migrations dans le migrations des 3 tables Mysql =>php bin/console migration:migrate.

-B) Création des differentes entités dans le dossier src/Entity

-1) Entity User,Chantier , Pointage (class et setters et getters) en place

-2) développemnts de 3 controller dans le dossiers src/controller
- UserController
- templates twig dossier templates/user
- afficher dans la vue sur l'url suivant http://127.0.0.1:8000/user/
fonctionnalités CRUD
 différentes routes
lister findAll=>http://127.0.0.1:8000/user/ voir des boutons pour le crud(create,edith, delete)
create User =>http://127.0.0.1:8000/user/new
edit User =>http://127.0.0.1:8000/user/{id}/edit

