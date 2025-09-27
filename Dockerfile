# Utilise PHP avec Apache, plus simple pour ton app
FROM php:8.2-apache

# Installe les extensions nécessaires (mysqli et pdo_mysql)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copie ton projet dans le container
COPY . /var/www/html/

# Expose le port utilisé par Railway
EXPOSE 8080

# Démarre Apache au foreground
CMD ["apache2-foreground"]p", "-b"]