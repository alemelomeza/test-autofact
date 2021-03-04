FROM composer:2.0.11
WORKDIR /app
COPY ./autofact .
RUN composer install --no-dev --optimize-autoloader

FROM node:14.15.4-slim
WORKDIR /app
COPY --from=0 /app .
RUN npm install && npm run production

FROM php:7.4.14-apache-buster
WORKDIR /var/www/app
RUN a2enmod rewrite headers \
	&& apt-get update \
    && docker-php-ext-install pdo_mysql gd \
	&& rm -rf /var/lib/apt/lists/*
COPY --from=1 /app .
RUN echo "\
<Virtualhost *:80>\n\
	DocumentRoot /var/www/app/public\n\
	<Directory /var/www/app/public>\n\
		Options -Indexes +FollowSymlinks +MultiViews\n\
		AllowOverride All\n\
		Require all granted\n\
	</Directory>\n\
	ErrorLog ${APACHE_LOG_DIR}/error.log\n\
	CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
	LogLevel warn\n\
</Virtualhost>\n\
" > /etc/apache2/sites-available/000-default.conf
EXPOSE 80