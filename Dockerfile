# Utilise une image PHP avec Apache
FROM php:8.2-apache

# Active le module Apache rewrite
RUN a2enmod rewrite

# Installe l'extension PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copie votre fichier PHP dans le conteneur
COPY sql_button.php /var/www/html/

# Définit le document root d'Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Expose le port 80
EXPOSE 80
