<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ▼ ログイン確認用など、固定ユーザーを複数投入（何度実行しても重複しない）
        $users = [
            ['name' => 'Test User', 'email' => 'test@example.com'],
            ['name' => '山田',     'email' => 'yamada@example.com'],
            ['name' => '佐藤',       'email' => 'sato@example.com'],
            ['name' => '鈴木',     'email' => 'suzuki@example.com'],
        ];

        foreach ($users as $u) {
            User::firstOrCreate(
                ['email' => $u['email']],                                 // 検索キー
                ['name' => $u['name'], 'password' => bcrypt('password')]  // 作成値
            );
        }

        // ▼ 先に店舗 → 次にレビュー（レビューでユーザー／店舗を参照するため）
        $this->call([
            RestaurantSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
