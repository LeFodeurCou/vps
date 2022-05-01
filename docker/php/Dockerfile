# Building from official php image
FROM php:8.1-fpm-alpine AS php

# Install php extensions
RUN docker-php-ext-install pdo pdo_mysql \
  && rm -rf /var/lib/apt/lists/*
 
# Run php in foreground and as root
CMD ["php-fpm", "-F", "-R"]
# CMD ["bash"]