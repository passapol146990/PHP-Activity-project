FROM php:8.2-apache

# ติดตั้งส่วนขยาย GD และ MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql

# เปิดใช้งาน mod_rewrite
RUN a2enmod rewrite

# กำหนด Document Root ของ Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# คัดลอกโค้ดเข้าสู่ Container
COPY . /var/www/html

# ตั้งค่าการอนุญาตไฟล์
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html
