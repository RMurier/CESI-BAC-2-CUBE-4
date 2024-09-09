# Utilise une image de base officielle PHP avec Apache
FROM php:7.4-apache

# Copier les fichiers de l'application dans le répertoire de travail du conteneur
COPY . /var/www/html/

# Donner les permissions nécessaires au répertoire
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

# Exposer le port 80 pour Apache
EXPOSE 80

# Commande pour démarrer Apache
CMD ["apache2-foreground"]