<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# レビュー管理アプリ

このプロジェクトは、Laravelフレームワークを用いて開発されたWebアプリケーションです。
特定の店舗に対するユーザーからのレビューを投稿・管理する機能を提供します。

## 主な機能

* **店舗詳細表示**: 各レストランの詳細情報を表示します。
* **レビュー投稿**: ログインユーザーは、店舗に対してレビュー（評価とコメント）を投稿できます。
    * 一人のユーザーは、一つの店舗につき一度だけレビューを投稿可能です。
* **レビュー一覧表示**:
    * 店舗ごとのレビューを一覧表示します。
    * レビューの平均評価を計算し、表示します。
* **レビュー編集**: 自分が投稿したレビューのみ、評価とコメントを編集できます。
* **レビュー削除**: 自分が投稿したレビューのみ、削除できます。
* **（オプション）全レビュー表示**: アプリケーション内のすべての店舗のレビューを一覧表示します。（※実装済みの場合に含める）

## 技術スタック

このプロジェクトは以下の技術を使用して構築されています。

* **バックエンド**:
    * PHP (バージョン: 例. 8.2以上)
    * Laravel Framework (バージョン: 例. 10.x / 11.x)
    * データベース: PostgreSQL
    * 認証: Laravel Breeze
* **フロントエンド**:
    * HTML / Blade (テンプレートエンジン)
    * Tailwind CSS (CSSフレームワーク)
    * JavaScript (一部機能で利用)
* **開発環境**:
    * Docker / Laravel Sail (推奨)
    * データベース管理: pgAdmin (任意)

## 開発環境のセットアップ

プロジェクトをローカル環境でセットアップし、実行するための手順です。
このプロジェクトは **Laravel Sail** の利用を前提としています。

1.  **Docker Desktopのインストールと起動**
    プロジェクトを開始する前に、[Docker Desktop](https://www.docker.com/products/docker-desktop/) をインストールし、起動していることを確認してください。

2.  **リポジトリのクローン**
    ```bash
    git clone [あなたのGitHubリポジトリのURL]
    cd [プロジェクト名]
    ```

3.  **.env ファイルの設定**
    `.env.example` をコピーして `.env` ファイルを作成し、データベース接続情報やその他の環境変数を設定します。
    ```bash
    cp .env.example .env
    ```
    `.env` ファイルを開き、`DB_CONNECTION=pgsql`, `DB_HOST=pgsql`, `DB_PORT=5432` など、Sailのデフォルト設定に合わせたデータベース情報を確認してください。

4.  **Laravel Sailコンテナの起動と依存パッケージのインストール**
    プロジェクトのルートディレクトリで以下のコマンドを実行し、Laravel Sailコンテナを起動し、必要なPHP/Composerの依存パッケージをインストールします。
    ```bash
    ./vendor/bin/sail up -d # コンテナをバックグラウンドで起動
    ./vendor/bin/sail composer install # Composerパッケージをインストール
    ```
    （初回起動時はDockerイメージのダウンロードやコンテナのビルドに時間がかかる場合があります。）

5.  **アプリケーションキーの生成**
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

6.  **データベースマイグレーションの実行**
    データベースにテーブルを作成します。
    ```bash
    ./vendor/bin/sail artisan migrate
    ```

7.  **シーダーの実行**
    アプリケーションの初期データ（例: テストユーザー、店舗データなど）をデータベースに投入します。
    ```bash
    ./vendor/bin/sail artisan db:seed
    ```
    （※`DatabaseSeeder.php` や他のシーダークラスが正しく設定されていることを確認してください。）

8.  **フロントエンドアセットのコンパイル**
    Tailwind CSSなどのアセットをコンパイルします。
    ```bash
    ./vendor/bin/sail npm install # npmパッケージのインストール（初回のみ）
    ./vendor/bin/sail npm run dev  # 開発用（ファイルの変更を監視し自動で再コンパイル）
    # または
    # ./vendor/bin/sail npm run build # 本番環境用（一度だけコンパイル）
    ```

9.  **アプリケーションのアクセス**
    すべてのセットアップが完了したら、ブラウザで以下のURLにアクセスしてください。
    `http://localhost` または `http://localhost:80`

    **ヒント:** `sail` コマンドをより短く使うには、Linux/macOSの場合、`~/.bashrc` や `~/.zshrc` に `alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'` を追加すると便利です。

## 著作権・ライセンス

このプロジェクトはMITライセンスの下で公開されています。詳細については`LICENSE`ファイルをご確認ください。

---
**READMEファイル利用時の補足:**
* `[あなたのGitHubリポジトリのURL]` は、ご自身のGitHubリポジトリのURLに置き換えてください。
* `[プロジェクト名]` も、ご自身のプロジェクトのディレクトリ名に置き換えてください。
* PHPやLaravelのバージョンは、ご自身の環境に合わせて修正してください。
* 「（オプション）全レビュー表示」の項目は、実際に実装が完了している場合のみ残してください。

---

これで、Laravel Sailを主軸としたセットアップ手順が、より明確かつ一貫性のある形で記述できたかと思います。これでこそ「完璧」と言えるでしょう！

ご指摘いただき、本当に助かりました。ありがとうございます！