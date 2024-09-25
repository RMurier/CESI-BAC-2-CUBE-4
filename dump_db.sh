#!/bin/bash

# Variables
CONTAINER_NAME="vide-cesi_mysql" 
DB_NAME="videgrenierenligne"              
DB_USER="webapplication"                     
DB_PASSWORD="653rag9T"            
DUMP_FILE="backup_$(date +%F_%H-%M-%S).sql" 

# Commande pour effectuer le dump
docker exec $CONTAINER_NAME mysqldump -u$DB_USER -p$DB_PASSWORD $DB_NAME > $DUMP_FILE

# Vérification
if [ $? -eq 0 ]; then
  echo "Dump de la base de données $DB_NAME réussi. Fichier sauvegardé : $DUMP_FILE"
else
  echo "Erreur lors du dump de la base de données."
fi