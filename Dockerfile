FROM php:8.2-apache

# ติดตั้งโมดูลที่จำเป็น
RUN docker-php-ext-install mysqli pdo pdo_mysql

# เปิดการใช้งาน mod_rewrite สำหรับ URL rewriting
RUN a2enmod rewrite

# ตั้งค่า DocumentRoot ไปที่ public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# เปลี่ยน VirtualHost configuration ให้ใช้ public เป็น root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# คัดลอกไฟล์ทั้งหมดไปที่ container
COPY . /var/www/html

# เปลี่ยน owner และ permission
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html
