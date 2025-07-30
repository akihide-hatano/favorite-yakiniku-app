<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Restaurant;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 既存のレビューを削除（重複投入防止のため、開発時のみ推奨）
        DB::table('reviews')->truncate();

        // ユーザーと店舗が存在することを確認
        $users = User::all();
        $restaurants = Restaurant::all();

        // ユーザーと店舗がいない場合はシーディングを中断
        if ($users->isEmpty() || $restaurants->isEmpty()) {
            $this->command->info('ユーザーまたは店舗が存在しないため、レビューシーダーをスキップします。');
            $this->command->info('先にUserSeederとRestaurantSeederを実行してください。');
            return;
        }

        // コメントを評価のカテゴリ別に分類
        $commentsByRating = [
            // 評価1-2 (低い評価)
            'low' => [
                '期待しすぎたのか、思ったほどではなかったです。再訪はないでしょう。',
                '煙がひどく、服に匂いがつきすぎました。改善を求めます。',
                '接客が残念でした。もう少し笑顔があっても良いのでは？',
                '肉が硬く、脂っこすぎました。二度と行きません。',
                '清潔感がなく、残念な気持ちになりました。',
                '値段の割に量が少なかったです。不満。',
            ],
            // 評価3 (普通)
            'medium' => [
                '普通に美味しいですが、特筆すべき点はありません。',
                'コスパは良いと思います。気軽に利用できます。',
                '悪くはないですが、感動はありませんでした。',
                '可もなく不可もなく、といった感じです。',
            ],
            // 評価4-5 (高い評価)
            'high' => [
                '人生で一番美味しい焼肉でした！感動しました！',
                'まさに至福のひととき。こんなお店を探していました！完璧です！',
                'とても美味しかったです！店員さんも親切でした。',
                '肉の質が最高でした。また行きたいです。',
                '雰囲気が良くて、ゆっくり食事ができました。',
                '提供が早くて助かりました。味も満足です。',
                '少々お値段は張りますが、最高の体験でした。',
                '予約が取りにくいのが難点ですが、納得の味です。'
            ],
        ];

        // 40件のレビューを生成
        for ($i = 0; $i < 40; $i++) {
            $user = null;
            $restaurant = null;
            $foundUnique = false;
            $attempts = 0;
            $maxAttempts = 100;

            // ユニークなユーザーと店舗の組み合わせが見つかるまでループ
            do {
                $user = $users->random();
                $restaurant = $restaurants->random();
                
                $exists = DB::table('reviews')
                            ->where('user_id', $user->id)
                            ->where('restaurant_id', $restaurant->id)
                            ->exists();
                
                if (!$exists) {
                    $foundUnique = true;
                }
                $attempts++;
            } while (!$foundUnique && $attempts < $maxAttempts);

            if (!$foundUnique) {
                $this->command->warn('ユニークなユーザーと店舗の組み合わせが見つかりませんでした。レビュー作成をスキップします。');
                continue;
            }

            // ランダムな評価を決定
            $rating = rand(1, 5);
            $comment = '';

            // 評価に基づいて適切なコメントを選択
            if ($rating <= 2) {
                $comment = $commentsByRating['low'][array_rand($commentsByRating['low'])];
            } elseif ($rating == 3) {
                $comment = $commentsByRating['medium'][array_rand($commentsByRating['medium'])];
            } else { // rating >= 4
                $comment = $commentsByRating['high'][array_rand($commentsByRating['high'])];
            }

            // レビューデータを挿入
            DB::table('reviews')->insert([
                'user_id' => $user->id,
                'restaurant_id' => $restaurant->id,
                'rating' => $rating,
                'comment' => $comment,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}