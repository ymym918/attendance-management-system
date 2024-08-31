# Atte(勤怠管理システム)
Atteは社員ごとに勤怠管理ができるアプリケーションです。</br>
![ホーム画面](https://github.com/user-attachments/assets/a707735c-a000-46f2-9924-ab83d24a37de)
## 作成した目的
実践に近い開発経験をつむため作成しました。
## アプリケーションURL
作成中です。
## 機能一覧
ログイン機能、メール認証、勤務状態によるボタン制御、勤務時間/休憩時間管理、</br>
（作成中：日付別勤怠管理、ユーザー別勤怠管理）
## 使用技術(実行環境)
- PHP 8.3.7
- Laravel 8.83.27
- MySQL 8.3.0
## テーブル設計
![Atte   ユースケース図  - テーブル設計](https://github.com/user-attachments/assets/9cb12eb2-7d2c-404b-b5fc-60fa36e79e1d)
## ER図
<img width="841" alt="Atte  ER図" src="https://github.com/user-attachments/assets/e6c3aba4-0c41-4df3-b193-ae9eb15db827"></br>

## 環境構築</br>
**Dockerビルド**
1. `git clone git@github.com:estra-inc/confirmation-test-contact-form.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

> *MacのM1・M2チップのPCの場合、`no matching manifest for linux/arm64/v8 in the manifest list entries`のメッセージが表示されビルドができないことがあります。
エラーが発生する場合は、docker-compose.ymlファイルの「mysql」内に「platform」の項目を追加で記載してください*
``` bash
mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:
```
**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
``` bash
php artisan key:generate
```

6. マイグレーションの実行
``` bash
php artisan migrate
```

7. シーディングの実行
``` bash
php artisan db:seed
```
## URL
- 開発環境　　：http://localhost/
- phpMyAdmin：http://localhost:8080/
