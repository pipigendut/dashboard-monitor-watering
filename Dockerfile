FROM php:8.2.3-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/project/

# Set working directory
WORKDIR /var/www

#Installing node 19.x
RUN curl -sL https://deb.nodesource.com/setup_19.x | bash -
RUN apt-get install -y nodejs

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --enable-gd --with-freetype=/usr/include/
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel applicatDion
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

RUN chown -R $USER:www-data /var/www/storage
RUN chown -R $USER:www-data /var/www/bootstrap/cache
RUN chown -R $USER:www-data /var/www/public
RUN chmod -R 777 /var/www/bootstrap/cache
RUN chmod -R 777 /var/www/storage
RUN chmod -R 777 /var/www/public

# This are production settings, I'm running with 'no-dev', adjust accordingly 
# if you need it
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install

# setup FE
RUN npm install
RUN npm rebuild node-sass
RUN npm run build
RUN npx mix

# Reset cache
RUN php artisan optimize
RUN php artisan cache:clear
RUN php artisan route:clear
RUN php artisan route:cache
RUN php artisan config:clear
RUN php artisan config:cache
RUN php artisan view:clear
RUN php artisan view:cache

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]