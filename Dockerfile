FROM php:8.3-alpine

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP extensions
RUN apk add --no-cache \
    git \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip

# Set working directory
WORKDIR /app

# Copy source code
COPY . .

# Install dependencies
RUN composer install
RUN php artisan key:generate
RUN php artisan vendor:publish --provider="L5Swagger\\L5SwaggerServiceProvider"

# Run the application
CMD ["/usr/local/bin/php", "index.php"]