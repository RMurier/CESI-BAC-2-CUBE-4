#!/bin/bash

# Variables
CONTAINER_NAME="vide-cesi_mysql" 
DB_NAME="videgrenierenligne"              
DB_USER="webapplication"                     
DB_PASSWORD="653rag9T"   
DUMP_FILE="$1"

# Vérification du fichier de dump
if [ -z "$DUMP_FILE" ]; then
  echo "Erreur : aucun fichier de sauvegarde fourni."
  echo "Utilisation : ./restore_db.sh nom_du_dump.sql"
  exit 1
fi

if [ ! -f "$DUMP_FILE" ]; then
  echo "Erreur : fichier de sauvegarde introuvable."
  exit 1
fi

# Commande pour restaurer la base de données
docker exec -i $CONTAINER_NAME mysql -u$DB_USER -p$DB_PASSWORD $DB_NAME < $DUMP_FILE

# Vérification
if [ $? -eq 0 ]; then
  echo "Restauration de la base de données $DB_NAME depuis $DUMP_FILE réussie."
else
  echo "Erreur lors de la restauration de la base de données."
fi
