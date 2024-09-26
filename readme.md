
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

- **Swagger**
    - Le swagger est disponible sur la route /swaggerv1.

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
1. **Installation Debian 12**
    - Prérequis :
        - Avoir un logiciel de virtualisation ( par exemple : VMware, VirtualBox )
        - Avoir téléchargé un fichier ISO de Debian 12 ( https://www.debian.org/download )
    - Étapes :
        - Ouvrir votre logiciel de virtualisation.
        - Créer une nouvelle machine virtuelle et charger l'ISO Debian 12 pour démarrer.
        - Configurer les spécifications de la machine virtuelle (RAM, stockage, CPU) en fonction de vos besoins.
        - Démarrer la VM et sélectionner Graphical Install pour une installation plus simple.
2. **Configuration de Debian 12**
    2.1 Configuration de base
        - Sélectionner la langue souhaitée (par exemple : Français).
        - Choisir votre situation géographique (par exemple : France).
        - Configurer le clavier (par exemple : Français).
        - Patienter jusqu'à la fin de cette première configuration.
    2.2 **Configuration réseau**
        - Entrer un nom pour votre système.
        - Si aucun domaine n'est disponible, utiliser "lan" comme nom de domaine.
    2.3 **Configuration des utilisateurs**
        - Définir un mot de passe pour l'utilisateur root (exemple : "root").
        - Indiquer le nom et le login de l'utilisateur courant (par exemple : "cesi").
        - Définir le mot de passe de cet utilisateur courant.
    2.4 **Configuration des disques**
        - Sélectionner « assisté – utiliser un disque entier ».
        - Choisir votre disque.
        - Sélectionner « tous dans une seule partition ».
        - Appliquer les modifications.
    2.5 **Gestion des paquets**
        - Choisissir la région et le miroir de dépôt (par défaut : deb.debian.org).
        - Si nécessaire, configurer un proxy.
    2.6 **Configuration du bureau**
        - Désélectionner "environnement de bureau Debian" et "GNOME".
        - Sélectionner "serveur web" et "serveur SSH".
        - Finaliser l'installation.
3. **Ajouter les droits sudo à l’utilisateur CESI**
    - Installer sudo avec la commande :
        sudo apt install sudo
    - Donner les droits sudo à l’utilisateur CESI :
        sudo usermod -aG sudo cesi
4. **Configuration de l'IP fixe**
    - Modifier la configuration réseau :
        sudo nano /etc/network/interfaces
    - Ajouter la configuration de l'IP fixe
        Dans notre cas :
            iface ens33 inet static
                address 192.168.229/24
                netmask 255.255.255.0
                gateway 192.168.229.2
                dns-nameservers 8.8.8.8 1.1.1.1
    - Redémarrer le service réseau :
        sudo systemctl restart networking
5. **Connexion SSH**
    - Se connecter via SSH :
    - ssh cesi@192.168.229.129
6. **Installation de Docker**
    - Mettre à jour la liste des paquets :
        sudo apt update
    - Installer les dépendances nécessaires :
        sudo apt install apt-transport-https ca-certificates gnupg2 software-properties-common
    - Ajouter la clé GPG pour Docker :
        curl -fsSL https://download.docker.com/linux/debian/gpg | sudo apt-key add -
    - Ajouter le référentiel Docker :
        sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/debian $(lsb_release -cs) stable"
    - Mettre à jour la liste des paquets :
        sudo apt update
    - Installer Docker :
        sudo apt install docker-ce
    - Vérifier l'état de Docker :
        sudo systemctl status docker
7. **Lancement du projet Docker**
    - Cloner votre projet en utilisant git :
        git clone votreprojet
    - Naviguer dans le répertoire du projet :
        cd CESI-DOCKER-CUBE-4/
    - Supprimer le dossier www si présent : 
        sudo rm -rf www
    - Lancer le build avec Docker :
        sudo docker-compose -f docker-compose.dev.yaml build
8. **Configuration d'un nom pour l'URL**
    - Ouvrir le fichier « host » dans Windows Explorer via le chemin d’accès :
        C:\Windows\System32\drivers\etc\hosts.
    - Ajouter l'IP de la machine Debian avec un nom personnalisé (ex : videgrenierenligne.com).
**Procédure : Connexion FTP à une machine Debian**
1. **Prérequis**
- Avoir installé un client FTP sur la machine locale (exemple : FileZilla, WinSCP, etc.).
2. **Installation et configuration du serveur FTP sur Debian**
    2.1 **Mise à jour de Debian**
        - Mettre à jour les paquets de la machine Debian avant d'installer le serveur FTP :
            sudo apt update && sudo apt upgrade -y
    2.2 **Installation du serveur FTP (vsftpd)**
        - Installer le serveur FTP "vsftpd" :
            sudo apt install vsftpd -y
    2.3 **Configuration du serveur FTP**
        - Ouvrir le fichier de configuration de vsftpd pour le modifier :
            sudo nano /etc/vsftpd.conf
        - Paramètre à renseigner dans le fichier de configuration :
            anonymous_enable=NO
            local_enable=YES
            write_enable=YES
            chroot_local_user=YES
        - Sauvegarder et fermer le fichier (Ctrl+O, Enter, puis Ctrl+X).
    2.4 **Redémarrage du service FTP**
        - Après modification du fichier de configuration, redémarrer le service vsftpd :
            sudo systemctl restart vsftpd
        - Vérifier que le service FTP est actif et en cours d’exécution :
            sudo systemctl status vsftpd
3. **Création d'un utilisateur pour le FTP**
    3.1 **Ajouter un nouvel utilisateur**
        - Créer un nouvel utilisateur qui aura accès au serveur FTP :
            sudo adduser nom_utilisateur
        - Suivre les instructions pour définir le mot de passe et les informations de l'utilisateur.
    3.2 **Définir les droits d'accès pour l'utilisateur**
        - S'assurer que l'utilisateur a les permissions nécessaires pour accéder à son répertoire personnel :
            sudo chown -R nom_utilisateur:nom_utilisateur /home/nom_utilisateur
