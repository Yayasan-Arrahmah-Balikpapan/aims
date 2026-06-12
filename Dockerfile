# Menggunakan image PHP Apache sebagai standar yang stabil untuk Laravel
FROM php:8.3-apache

# Install dependencies yang diperlukan termasuk oniguruma
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    mbstring \
    pdo \
    pdo_mysql \
    xml \
    pcntl \
    zip \
    gd \
    exif \
    && docker-php-ext-enable exif

# Aktifkan mod_rewrite Apache untuk perutean (routing) Laravel
RUN a2enmod rewrite

# Ubah DocumentRoot Apache ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set direktori kerja
WORKDIR /var/www

# Salin file composer.json (dan composer.lock jika ada)
COPY composer.json composer.lock* ./

# Install dependensi Laravel tanpa script dan autoloader
RUN composer clear-cache
RUN composer install --no-dev --no-autoloader --no-scripts || true

# Salin sisa aplikasi
COPY . .

# Jalankan autoloader
RUN composer dump-autoload --optimize

# Berikan hak akses penuh pada proses apache di direktori penting Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public

# Expose port standar HTTP (80)
EXPOSE 80

# Jalankan Apache dalam mode foreground
CMD ["apache2-foreground"]
