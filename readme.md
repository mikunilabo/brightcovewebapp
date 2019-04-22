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
$ cp .env.example .env（環境ファイル雛形からコピーする）
$ php artisan key:generate（各種暗号化用アプリケーションキー生成）
$ php artisan serve（ビルトインサーバ起動）
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

以下いくつかの便利なマイグレーションコマンドがあります。

```SSH
$ php artisan migrate（マイグレーションを実行します）
$ php artisan migrate --seed（マイグレーションを実行し、同時にシードデータも挿入します）
$ php artisan migrate:fresh --seed（DB内全てのテーブルを破棄し、再度マイグレーションを実行し、同時にシードデータも挿入します）
$ php artisan migrate:rollback（実行済みのマイグレーションをバッチ番号逆順で順にロールバックします）
$ php artisan db:seed（シーディングを順に実行します）
$ php artisan db:seed --class=[class name]（シーディングを個別に実行します）
```

以下はフロントエンドビルドに必要です。
node.jsとパッケージマネージャにnpmを使用しています。

```SSH
npm install
npm run dev [or prod]
```

以下は主に開発時/デプロイ時に使用します。

```SSH
$ composer dump-autoload -o （オートローディング対象では無いディレクトリ以下でクラスを作成した場合等は手動で更新する必要があります）
$ php artisan refresh [-c|--cache]（各種便利コマンドをまとめた自作コマンドです。production環境ではオプションでキャッシュ化すると高速化します）
```

以下はサーバ/アプリケーションのメンテナンス時に使用可能です。

```SSH
$ php artisan down（メンテナンス画面に切り替わります HTTPステータス503）
$ php artisan up（メンテナンス終了後、復旧時に使用）
```
