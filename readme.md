# Brightcove Web Demo App

## Project Managements

## Environments
  - **production**

  - **development**

  - **Framework**
    + Laravel5.5 LTS

  - **Required operating environment**
    + PHP >= 7.1.0（L5.5自体はPHP7.0以上ですが、一部PHP7.1以上が必要になる構文を含んでいるため）
    + OpenSSL PHP拡張
    + PDO PHP拡張
    + Mbstring PHP拡張
    + Tokenizer PHP拡張
    + XML PHP拡張
    + BCMATH PHP拡張

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

初回`$ php artisan migrate --seed`コマンド実行前に、環境ファイルへ下記の用に追加しておくと、
任意のアドレス/パスワードで初期ログイン用アカウントを作成出来ます。
環境変数の確認は `/config/accounts.php`
個別シード実行は`$ php artisan db:seed --class=UsersSeeder`

```.env
TEST_ADMIN_NAME=your_name
TEST_ADMIN_EMAIL=your_email
TEST_ADMIN_PASSWORD=your_password
```

## Frontend assets compilation
node.jsとパッケージマネージャにnpmを使用しています。

```SSH
npm i
npm run dev [or prod]
npm run watch
```

## During development / deployment
```SSH
$ composer dump-autoload -o （オートローディング対象では無いディレクトリ以下でクラスを作成した場合等は手動で更新する必要があります 例：database/）
$ php artisan refresh [-c|--cache] [-d|--dumpautoload] [-f|--force] [-i|--info]
（各種便利コマンドをまとめた自作コマンドです。`production`環境ではCオプションでキャッシュ化すると高速化します）
```

以下のような環境変数を設定する事で、各種デバッグツールを有効化出来ます。

```.env
COLLISION_ENABLE=true
DEBUGBAR_ENABLE=true
IDEHELPER_ENABLE=true
```

## During maintenance
```SSH
$ php artisan down（メンテナンス画面に切り替わります HTTPステータス503）
$ php artisan up（メンテナンス終了後、復旧時に使用）
```
