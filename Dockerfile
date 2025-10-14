FROM php:8.2-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
  git \
  curl \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  libpq-dev \
  zip \
  unzip

# Очистка кеша
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка PHP расширений
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создание пользователя для Laravel
RUN groupadd -g 1000 www && \
  useradd -u 1000 -ms /bin/bash -g www www

# Копирование прав на приложение
COPY --chown=www:www . /var/www

# Переключение на пользователя www
USER www

EXPOSE 8000
CMD ["php-fpm"]