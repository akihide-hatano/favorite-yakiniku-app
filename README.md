<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# みんなで作る焼肉店レビューアプリ

このプロジェクトは、Laravelフレームワークを用いて開発されたWebアプリケーションです。
**ユーザー全員が参加して情報を共有し合うコミュニティベースの焼肉店レビュープラットフォーム**を提供します。
基本的なCRUD操作に加え、ユーザー認証や画像投稿といった機能を備え、協力して焼肉店の情報を育てていくことを目指します。

## 主な機能

* **焼肉店の情報共有・管理機能（CRUD）**:
    * **焼肉店の登録・更新・削除**: ログインユーザーは、新しい焼肉店の情報を追加したり、既存の情報を編集・削除したりできます。これにより、コミュニティ全体で最新の焼肉店情報を維持することが可能です。
    * **焼肉店の詳細表示**: 各焼肉店の具体的な情報（名称、説明、場所など）を表示し、ユーザーが店舗を理解するための基盤を提供します。
    * **焼肉店の画像投稿**: 各焼肉店には視覚的な情報を伝えるための画像をアップロードできます。これにより、店舗の魅力をより効果的にアピールします。
* **ユーザーレビュー機能（CRUD）**:
    * **レビューの投稿**: ログインユーザーは、訪問した焼肉店に対して**評価（1～5段階の星）とコメント**を投稿できます。これにより、ユーザーの生の声を集約し、他のユーザーの店舗選びに役立てます。
        * **重複投稿防止**: 一人のユーザーが同じ焼肉店に複数回レビューを投稿できないよう、システム的な制限を設けています。
    * **店舗ごとのレビュー一覧と平均評価**: 各焼肉店の詳細ページでは、その店舗に寄せられたすべてのレビューを一覧表示し、**全体の平均評価を自動で計算して表示**します。これにより、焼肉店の客観的な評判が一目でわかります。
    * **レビューの編集・削除**: ユーザーは**自分が投稿したレビューのみ**を後から編集・削除できます。これにより、誤った情報や古い情報を修正し、レビュー内容の正確性を保つことができます。
* **ユーザー認証機能**:
    * Laravel Breezeを導入し、**ユーザー登録、ログイン、パスワードリセット**といった基本的な認証機能をセキュアに提供します。これにより、ユーザーは安心してサービスを利用できます。
* **共通UI/UX部品の導入**:
    * アプリケーション全体で**共通のヘッダーとフッター**を導入し、一貫性のあるユーザーインターフェースを提供します。これにより、ユーザーは直感的にアプリケーションを操作できます。
* **（オプション）全レビュー表示**:
    * （※実装済みの場合に記述）アプリケーション内の**すべての焼肉店、すべてのユーザーによるレビューを一元的に閲覧できるページ**を提供します。これにより、ユーザーは幅広い焼肉店の評判を横断的に比較検討することが可能になります。
* **（オプション）検索フォーム**:
    * （※実装済みの場合に記述）焼肉店名やレビュー内容で**情報を検索できるフォーム**を提供します。これにより、目的の情報を素早く見つけ出すことができます。

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
* 各「（オプション）」機能は、実際に実装が完了している場合のみ残してください。実装していない場合は、その行を削除してください。

---

これで、**「管理者」という言葉を排し、「みんなで作る焼肉店レビューアプリ」というコンセプトを前面に出した、より適切でアピール力の高いREADME**になったかと思います。

ご指摘いただき、本当に感謝申し上げます。これで完璧です！