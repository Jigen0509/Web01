# 和白干潟探検アプリ

福岡市東区の和白干潟を楽しく探索できるWebアプリケーションです。

![Laravel](https://img.shields.io/badge/Laravel-10.48.29-red)
![PHP](https://img.shields.io/badge/PHP-8.4.14-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange)
![Heroku](https://img.shields.io/badge/Heroku-Deployed-purple)

## 🌟 概要

和白干潟の9つの探索ポイントを訪れ、クイズに挑戦したり写真を投稿したりしながら、干潟の自然や生き物について学べるゲーミフィケーションアプリケーションです。

**本番環境**: https://wajiro-explorer-cb17817e375a.herokuapp.com/

## 🎯 主な機能

### 1. 探索ポイント管理
- 和白干潟の9箇所の探索ポイントをインタラクティブに表示
- 各ポイントの詳細情報、画像、説明文
- Google Maps連携による現地へのナビゲーション機能
- レスポンシブデザインでモバイル対応

### 2. クイズチャレンジシステム
- 各ポイントで出題される3問の多肢選択式クイズ
- 全問正解で10ポイント獲得
- リアルタイム正誤判定とアニメーション効果
- クリア日時の記録

### 3. 投稿・写真共有機能
- 探索した場所の写真や感想を投稿（10ポイント獲得）
- 全ユーザーの投稿一覧閲覧
- 自分の投稿の編集・削除機能
- ポイント別の投稿フィルタリング

### 4. ランク・ポイントシステム
獲得ポイントに応じて4段階のランクアップ：
- **フィールド調査員** 🔰（0～49P）初心者
- **エキスパート** ⭐（50～99P）中級者
- **マスター** 🏆（100～149P）上級者
- **レジェンド** 👑（150P以上）最高位

### 5. ステータス・進捗管理
- 訪問した場所の数、クリアしたミッション、獲得ポイントの可視化
- 各ポイントの達成状況を一覧表示（クイズ・写真投稿）
- ランク画像とバッジの表示
- ミッション達成日時の記録

## 🛠️ 技術スタック

### バックエンド
- **Framework**: Laravel 10.48.29
- **Language**: PHP 8.4.14
- **Database**: MySQL 8.0
- **ORM**: Eloquent
- **Authentication**: Laravel Breeze
- **Validation**: Form Request Validation

### フロントエンド
- **Build Tool**: Vite 5.4.19
- **CSS Framework**: Tailwind CSS 3.4
- **JavaScript**: Alpine.js
- **Blade Templates**: Laravel Blade Engine

### インフラ・デプロイ
- **Production**: Heroku (v142)
- **Database**: JawsDB MySQL
- **Development**: Docker Compose
- **Web Server**: Nginx/Apache
- **Version Control**: Git/GitHub

## 📦 セットアップ

### 必要な環境
- Docker & Docker Compose
- Node.js 22.x以上
- Composer 2.8以上
- PHP 8.4以上

### ローカル環境での起動

1. リポジトリのクローン
```bash
git clone https://github.com/Jigen0509/Web01.git
cd Web01
```

2. 環境変数の設定
```bash
cp .env.example .env
# .envファイルを編集してDB接続情報を設定
```

3. Dockerコンテナの起動
```bash
docker-compose up -d
```

4. 依存関係のインストール
```bash
composer install
npm install
```

5. アプリケーションキーの生成
```bash
php artisan key:generate
```

6. データベースのマイグレーション＆シーディング
```bash
php artisan migrate:fresh --seed
```

7. フロントエンドのビルド
```bash
npm run dev
```

8. アプリケーションへのアクセス
```
http://localhost
```

## 🎨 主な技術的実装

### 認証・セキュリティ
- Laravel Breezeによる認証機能
- CSRF保護
- パスワードハッシュ化
- ミドルウェアによるアクセス制御

### データベース設計
- ユーザー、ポイント、投稿、クイズ、ステータスの正規化されたテーブル設計
- 外部キー制約による整合性保証
- インデックスによるクエリ最適化

### UI/UXの工夫
- グラデーション背景とアニメーション効果（キラキラ、泡、ホタル）
- レスポンシブデザイン対応
- インタラクティブなボタンとホバーエフェクト
- ローディング状態の視覚的フィードバック

### エラーハンドリング
- Try-catchによる例外処理
- ログ記録（Laravel Log Facade）
- ユーザーフレンドリーなエラーメッセージ

## 📊 データベース構造

主要テーブル：
- `users` - ユーザー情報（ランク、ポイント含む）
- `points` - 探索ポイント情報
- `posts` - ユーザー投稿
- `quizzes` - クイズデータ
- `user_point_statuses` - ユーザーの各ポイントでの達成状況

## 🚀 デプロイ

Herokuへのデプロイ手順：
```bash
# Heroku CLIでログイン
heroku login

# アプリケーションの作成（初回のみ）
heroku create wajiro-explorer

# JawsDB MySQLアドオンの追加
heroku addons:create jawsdb:kitefin

# デプロイ
git push heroku main

# マイグレーション実行
heroku run php artisan migrate:fresh --seed
```

## 📝 今後の改善予定

- [ ] 画像アップロード機能の実装
- [ ] ソーシャルログイン対応
- [ ] 通知機能の追加
- [ ] ユーザー間のフォロー機能
- [ ] 実績バッジシステムの拡張
- [ ] PWA対応

## 👤 作成者

**Jigen0509**
- GitHub: [@Jigen0509](https://github.com/Jigen0509)

## 📄 ライセンス

このプロジェクトはMITライセンスの下で公開されています。

## 🙏 謝辞

- Laravel Framework
- Heroku Platform
- 和白干潟の自然環境保護に関わるすべての方々
