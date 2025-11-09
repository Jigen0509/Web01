# 公開レポジトリからベースイメージをインポート（Laravel10はphp8.2以上が必須）
FROM php:8.2-fpm

# COPY php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# Composer install（マルチステージビルド）
# マルチステージビルドを使用すると、composerのバージョン管理が楽（今回は常に最新版を指定）
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# install Node.js（マルチステージビルド）
# Breezeにも必要
# node:latestにするとバージョン依存のエラーが発生するのでLTSバージョンを指定（esbuildのエラー）
COPY --from=node:20.16 /usr/local/bin /usr/local/bin
COPY --from=node:20.16 /usr/local/lib /usr/local/lib

# パッケージ管理ツール（apt-get）の更新＆必要パッケージのインストール
RUN apt-get update \
    && apt-get -y install \
    git \
    zip \
    unzip \
    vim \
    && docker-php-ext-install pdo_mysql bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN git config --global user.name "Jigen0509" \
    && git config --global user.email "509jigen@gmail.com" \
    && git config --global --add safe.directory /var/www/html 
    # PHP拡張モジュール（Laravelに必要で不足しているものをインストール）：pdo_mysql（PHPからMySQLへのアクセスを可能にする）、bcmath

# コンテナに入ったとき（docker-compose exec app bash）の作業ディレクトリを指定
WORKDIR /var/www/html