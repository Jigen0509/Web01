# Railway用本番環境Dockerfile
FROM php:8.3-fpm

# 作業ディレクトリを設定
WORKDIR /var/www/html

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Node.jsをインストール
COPY --from=node:20 /usr/local/bin /usr/local/bin
COPY --from=node:20 /usr/local/lib /usr/local/lib

# 必要なパッケージとPHP拡張機能をインストール
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# アプリケーションファイルをコピー
COPY src/. /var/www/html/

# Composer依存関係をインストール
RUN composer install --no-dev --optimize-autoloader --no-interaction

# NPM依存関係をインストールしてビルド
RUN npm install && npm run build

# ストレージとキャッシュのパーミッション設定
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Nginxの設定ファイルをコピー
COPY nginx-railway.conf /etc/nginx/sites-available/default

# ポート設定
EXPOSE 8080

# 環境変数でポートを設定
ENV PORT=8080

# 起動スクリプトを作成
RUN echo '#!/bin/bash\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan view:cache\n\
php artisan migrate --force\n\
php-fpm -D\n\
nginx -g "daemon off;"\n' > /start.sh \
    && chmod +x /start.sh

CMD ["/start.sh"]
