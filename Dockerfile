# Utilise PHP avec Apache
FROM php:8.2-apache

# Installe les extensions nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Active mod_rewrite pour Apache (utile pour les apps e-commerce)
RUN a2enmod rewrite

# Configure Apache pour Railway
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copie ton projet dans le container
COPY . /var/www/html/

# Configure les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configure Apache pour écouter sur le port Railway
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Expose le port (Railway l'assigne dynamiquement)
EXPOSE ${PORT}

# Démarre Apache
CMD ["apache2-foreground"]