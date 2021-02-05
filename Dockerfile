From php:7.3-apache
Copy SES-HR-Department/ /var/www/html/
RUN echo "serverName localhost" >> /etc/apache2/apache2.conf
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli
ExPOSE 8181