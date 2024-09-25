
### Explication des sections :
- **Nom du projet**
    - Le projet s'appelle videfrenierenligne.

- **Description du projet**
    - Le projet Vide Grenier En Ligne consiste à créer et maintenir une plateforme web où les utilisateurs peuvent donner gratuitement des objets qu'ils entreposent dans leur grenier ou garage. L'application permet aux résidents de France métropolitaine de publier des annonces pour offrir ces objets sans contrepartie financière.
    
- **Reformulation du besoin**
    - L’objectif principal est de corriger et améliorer l’application livrée par un prestataire précédent. Le site doit être stable, sans erreurs pour garantir une bonne expérience utilisateur, avant une présentation imminente à des investisseurs.

- **Liste des logiciels installés**
    Nom  | Version
    ------------- | -------------
    twig/twig  | ~3.0
    ext-pdo  | *
    ext-json  | *
    phpmailer/phpmailer  | ^6.9
    phpunit/phpunit  | ^10.0

- **Sauvegarde / réstauration de la base de données**
    - Pour sauvegarder la base de données, vous avez un fichier dump_db.sh.
    il suffit d'executer la commande `./dump_db.sh` et un fichier de backup sera créer.

    - Pour réstaurer ce fichier, vous pouvez utiliser le fichier restaure_db.sh avec la commande `./restaure_db.sh <Nom du fichier de sauvegarde>`.

- **Compte administrateur**
    - Un compte administrateur est créer par défaut lors du lancement de l'application.
        - email: admin@gmail.com
        - nom: admin
        - mot de passe: admin

- **Lancer un environnement de test / qualification / production**
    - Voici la commande à exécuter pour chaque environnement : 
    - **Dev**:
        - Commande à executer
            - docker-compose -f docker-compose.dev.yaml -p cesi-docker-cube-4-dev up --build
        - IP / ports
            - mysql : 172.20.0.10:3308
            - nginx : 172.20.0.10:8080
    - **Qualif**:
        - Commande à exécuter
            - docker-compose -f docker-compose.qua.yaml -p cesi-docker-cube-4-qua up --build
        - IP / ports
            - mysql : 172.30.0.20:3307
            - nginx : 172.30.0.20:9090
    - **Prod**
        - Commande à exécuter
            - docker-compose -f docker-compose.yaml -p cesi-docker-cube-4 up --build
        - IP / ports
            - mysql : 172.10.0.10:3306
            - nginx : 172.10.0.10:80 (port HTTP)