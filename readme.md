# Classic Models

Classic Models est un projet qui met en œuvre une architecture MVC (Modèle-Vue-Contrôleur) pour une application de gestion de modèles de produits. L'application permet de gérer des clients, des employés, des commandes et des produits.

Structure du projet
Le projet est organisé de la manière suivante :

Le dossier "lib" contient trois fichiers utilitaires :

__"debug.php"__ : Ce fichier contient une fonction de débogage pour afficher les variables et les tableaux de manière formatée.
__"format.php"__ : Ce fichier contient une fonction pour formater les nombres en une chaîne de caractères représentant des euros.
__"route.php"__ : Ce fichier contient une fonction pour rediriger l'utilisateur vers une URL spécifique.
Le dossier "model" contient les fichiers représentant les modèles de données de l'application :

__"customers.php"__ : Gère les opérations liées aux clients.<br>
__"database.php"__ : Établit la connexion à la base de données.
__"employees.php"__ : Gère les opérations liées aux employés.
__"orderdetails.php"__ : Gère les opérations liées aux détails des commandes.
__"orders.php"__ : Gère les opérations liées aux commandes.
__"products.php"__ : Gère les opérations liées aux produits.
Le dossier "templates" contient les fichiers de modèle utilisés pour afficher les vues de l'application.

Les fichiers de contrôleurs :

__"customer.php"__ : Gère les requêtes liées aux clients.
__"employee.php"__ : Gère les requêtes liées aux employés.
__"index.php"__ : Gère les requêtes liées à la page d'accueil.
__"order.php"__ : Gère les requêtes liées aux commandes.
__"product.php"__ : Gère les requêtes liées aux produits.

Utilisation
L'application Classic Models utilise le modèle MVC pour organiser le code et séparer les responsabilités. Les modèles sont responsables de l'accès aux données et des opérations de base de données. Les contrôleurs gèrent les requêtes utilisateur et coordonnent les actions appropriées. Les vues sont responsables de l'affichage des données.

Chaque page de l'application est associée à un contrôleur qui gère les actions spécifiques pour cette page. Les contrôleurs utilisent les modèles pour interagir avec la base de données et récupérer les données nécessaires. Les vues utilisent les fichiers de modèle pour afficher les données de manière formatée.

Prérequis
Pour exécuter l'application Classic Models, les prérequis suivants sont nécessaires :

Un serveur web (par exemple, Apache) configuré avec PHP.
Un serveur de base de données (par exemple, MySQL) avec les tables nécessaires : customers, employees, orderdetails, orders, products.
Configuration
Pour configurer l'application Classic Models, suivez les étapes suivantes :

Assurez-vous que vous avez créé une base de données et configuré les tables nécessaires.
Modifiez le fichier "database.php" dans le dossier "model" pour spécifier les informations de connexion à votre base de données.
Placez les fichiers du projet dans le répertoire racine de votre serveur web.
Contribuer
Les contributions à l'amélioration de l'application Classic Models sont les bienvenues. Si vous souhaitez contribuer, veuillez suivre les étapes suivantes :

Clonez le dépôt du projet.
Effectuez les modifications souhaitées.
Soumettez une demande d'extraction en expliquant les modifications apportées.
Auteurs
Le projet Classic Models a été développé par [Guillaume Nairaince] au cours d'un exercice à la Passerelle.
