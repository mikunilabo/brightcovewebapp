# UNIVAS_Contents_Platform

## Project Management

## Environment
  - **production**

  - **development**

  - **Framework**
    + Laravel5.5 LTS

  - **Required operating environment**
    + PHP >= 7.0.0
    + OpenSSL PHP拡張
    + PDO PHP拡張
    + Mbstring PHP拡張
    + Tokenizer PHP拡張
    + XML PHP拡張

## Installation
```SSH
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan serve
```
ここまででログイン画面は表示されると思います。
以下環境ファイルにDB情報を設定してください。

```.env
DB_CONNECTION=mysql
DB_HOST=your_host
DB_PORT=3306
DB_DATABASE=your_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

以下はフロントエンドビルドに必要です。
node.jsとパッケージマネージャにnpmを使用しています。
```
npm install
npm run dev [or prod]
```
