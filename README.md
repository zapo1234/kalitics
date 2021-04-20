# kalitics
  Test solution
- test fonctionnel en local 
- Développement de la solution test sur un environement 
 -  Symfony 4 ou 5.2(test réalisé sur 5.2)  , 
 - environement PHP version PHP 8.0.2 , serveur wampserver localhost
-  Utilisation des commande php/bin console 

A) installer le projet symfony avec composer  composer create-project symfony/skeleton , le clone avec git clone
1) Mise en place de la base de données dans le fichier .env  creation de la base de données avec =>
-php/bin/console doctrine:database:created
2) génération des migrations dans les migrations des 3 tables Mysql => 
- php bin/console migration:migrate.
3) Démarrage du server avec => symfony serve = 
 -  taper  http://127.0.0.1:8000/user

-B) Création des differentes entités dans le dossier src/Entity

-1) Entity User,Chantier , Pointage (class et setters et getters) mise en place

 Relation  ManyToOne sur User => Chantier 

-2) développemnts de 3 controller et 3 forms dans le dossiers src/controller dans le dossier src/Form
- UserController/userType
- templates twig dossier templates/user
- Afficher dans la vue sur l'url suivant http://127.0.0.1:8000/user/
  fonctionnalités CRUD
 différentes routes
 lister findAll=>http://127.0.0.1:8000/user/ voir des boutons pour le crud(create,edith, delete)
 create User =>http://127.0.0.1:8000/user/new (forulaire create User)
 edit User =>http://127.0.0.1:8000/user/{id}/edit

-ChantierController/chantierType

-  Vue templates twig dossier templates/chantier
-  afficher dans la vue sur l'url suivant http://127.0.0.1:8000/chantier/
fonctionnalités CRUD
 différentes routes
lister findAll=>http://127.0.0.1:8000/chantier/ voir des boutons pour le crud(create,edith, delete)
create chantier =>http://127.0.0.1:8000/chantier/new (formulaire Create chantier)

view Chantier  =>http://127.0.0.1:8000/chantier/1 => voir tous les utilisateurs qui ont pointé sur ce chantier
edit User =>http://127.0.0.1:8000/user/{id}/edit 

 -PointageController /pointage type
- développement du formulaire depointage et affichage de la liste des pointage existant
- Vue  templates twig dossier templates/Pointage
- Afficher dans la vue sur l'url suivant http://127.0.0.1:8000/pointage (formulaire + liste).
- développement d'une fonction SommeTime dans le PointageRepository qui appelle la fonction qui calcule la somme des durées d'un user
- 



