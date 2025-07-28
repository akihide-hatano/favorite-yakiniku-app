<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant; // Restaurantモデルをuseする

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 開発環境用のダミーデータをここに記述
        Restaurant::create([
            'name' => '牛角 四条河原町店',
            'description' => '定番から希少部位まで楽しめる、みんな大好き牛角！',
            'address' => '京都府京都市下京区四条通河原町東入真町',
            'telephone' => '075-212-3456',
            'operating_hours' => '月～金: 17:00～23:00, 土日祝: 12:00～23:00',
            'image_url' => 'https://example.com/gyukaku.jpg', // ダミー画像URL
        ]);

        Restaurant::create([
            'name' => '焼肉きんぐ 京都駅前店',
            'description' => '食べ放題が人気の焼肉チェーン。家族連れにおすすめ。',
            'address' => '京都府京都市下京区東塩小路町721-1',
            'telephone' => '075-343-9876',
            'operating_hours' => '全日: 11:30～24:00',
            'image_url' => 'https://example.com/yakiniku-king.jpg',
        ]);

        // --- ここからリアル店舗に近い焼肉屋さんのデータ例 ---

        // 京都の有名店「京の焼肉処 弘」シリーズ
        Restaurant::create([
            'name' => '京の焼肉処 弘 千本三条本店',
            'description' => '京都の精肉店が直営する、新鮮な京丹波牛が自慢の焼肉店。コスパも抜群。',
            'address' => '京都府京都市中京区壬生馬場町37-2',
            'telephone' => '075-812-8929',
            'operating_hours' => '全日: 17:00～23:00',
            'image_url' => 'https://example.com/yakiniku-hiro-senbon.jpg',
        ]);

        Restaurant::create([
            'name' => '京の焼肉処 弘 京都駅前店',
            'description' => '京都駅から徒歩圏内。観光客にも人気の弘の支店で、上質な和牛を堪能。',
            'address' => '京都府京都市下京区東塩小路町721-1 京都タワーサンドB1F',
            'telephone' => '075-343-4129',
            'operating_hours' => '全日: 11:00～23:00',
            'image_url' => 'https://example.com/yakiniku-hiro-kyotoeki.jpg',
        ]);

        Restaurant::create([
            'name' => '京の焼肉処 弘 先斗町',
            'description' => '風情ある先斗町で京町家を改装した店舗。デートや特別な日に最適。',
            'address' => '京都府京都市中京区先斗町四条上る西側',
            'telephone' => '075-255-8929',
            'operating_hours' => '月～金: 17:00～23:00, 土日祝: 12:00～23:00',
            'image_url' => 'https://example.com/yakiniku-hiro-pontocho.jpg',
        ]);

        // 天壇（祇園本店は特に有名）
        Restaurant::create([
            'name' => '焼肉の名門 天壇 祇園本店',
            'description' => '京都を代表する老舗焼肉店。黄金色のだしでいただく焼肉は絶品。',
            'address' => '京都府京都市東山区宮川筋4-297',
            'telephone' => '075-551-4129',
            'operating_hours' => '全日: 11:30～23:00',
            'image_url' => 'https://example.com/tendan-gion.jpg',
        ]);

        // 甲（キノエ）
        Restaurant::create([
            'name' => '焼肉ダイニング 甲（キノエ） 御所南',
            'description' => '最高級和牛と17種類のユッケが楽しめる。上品な空間で大人な焼肉体験。',
            'address' => '京都府京都市中京区等持寺町34-1 ペペ御所南1F',
            'telephone' => '075-257-2929',
            'operating_hours' => '全日: 17:00～23:00',
            'image_url' => 'https://example.com/kinoe-gosho.jpg',
        ]);

        // 焼肉矢澤 京都
        Restaurant::create([
            'name' => '焼肉矢澤 京都',
            'description' => '東京の人気店が京都に進出。上質な空間で質にとことんこだわった和牛焼肉を堪能。',
            'address' => '京都府京都市下京区新町通綾小路下る神明町243 Masa Ayakojiビル1F',
            'telephone' => '075-353-2989',
            'operating_hours' => '月～金: 17:00～23:00, 土日祝: 12:00～23:00',
            'image_url' => 'https://example.com/yazawa-kyoto.jpg',
        ]);

        // 焼肉やまちゃん
        Restaurant::create([
            'name' => '焼肉やまちゃん',
            'description' => '渋谷で話題の焼肉店が京都に。厳選された和牛と新鮮なホルモンが魅力。',
            'address' => '京都府京都市中京区蛸屋町蛸薬師通麩屋町東入ル157-11',
            'telephone' => '075-212-0029',
            'operating_hours' => '全日: 18:00～24:00',
            'image_url' => 'https://example.com/yamachan.jpg',
        ]);

        // 松阪牛 WHAT'S 京都室町店
        Restaurant::create([
            'name' => '松阪牛WHAT\'S 京都室町店',
            'description' => '松阪牛一頭買いで希少部位も豊富。築80年の京町家で贅沢な焼肉を。',
            'address' => '京都府京都市中京区室町通蛸薬師下る鯉山町531',
            'telephone' => '075-257-2929',
            'operating_hours' => '全日: 17:00～23:00',
            'image_url' => 'https://example.com/matsusaka-whats.jpg',
        ]);

        // 熟成焼肉 听（ポンド） 京都駅前店
        Restaurant::create([
            'name' => '熟成焼肉 听（ポンド） 京都駅前店',
            'description' => '熟成肉専門店。独自の熟成技術で旨みを最大限に引き出したお肉を提供。',
            'address' => '京都府京都市下京区東塩小路町717-30',
            'telephone' => '075-353-8929',
            'operating_hours' => '全日: 17:00～23:00',
            'image_url' => 'https://example.com/pound-kyotoeki.jpg',
        ]);

        // 個室焼肉 萬（まん）
        Restaurant::create([
            'name' => '個室焼肉 萬',
            'description' => '全室個室でプライベートな空間で焼肉を楽しめる。会食や接待にもおすすめ。',
            'address' => '京都府京都市中京区河原町通蛸薬師下る塩屋町343-2',
            'telephone' => '075-252-8929',
            'operating_hours' => '全日: 17:00～23:00',
            'image_url' => 'https://example.com/yakiniku-man.jpg',
        ]);

        // 焼肉 侘び寂び（以前のダミーを京都のお店に修正）
        Restaurant::create([
            'name' => '焼肉 侘び寂び 京都祇園',
            'description' => '祇園の隠れ家で、日本の美意識を感じる空間で上質な和牛をじっくりと。',
            'address' => '京都府京都市東山区祇園町南側570-120',
            'telephone' => '075-XXXX-YYYY', // ダミー電話番号
            'operating_hours' => '月～土: 18:00～24:00 (日祝定休)',
            'image_url' => 'https://example.com/wabisabi-gion.jpg',
        ]);

        // 地域チェーン店など
        Restaurant::create([
            'name' => 'ワンカルビ 京都桂店',
            'description' => '高品質な食べ放題が人気の焼肉レストラン。家族連れにも大人気。',
            'address' => '京都府京都市西京区桂南巽町90',
            'telephone' => '075-394-1129',
            'operating_hours' => '全日: 17:00～24:00',
            'image_url' => 'https://example.com/onekarubi.jpg',
        ]);

        Restaurant::create([
            'name' => '焼肉酒家 伝八 京都三条店',
            'description' => 'リーズナブルな価格で焼肉とホルモンを楽しめる大衆居酒屋。',
            'address' => '京都府京都市中京区三条通河原町東入ル',
            'telephone' => '075-221-8929',
            'operating_hours' => '全日: 17:00～翌1:00',
            'image_url' => 'https://example.com/denhachi.jpg',
        ]);

        Restaurant::create([
            'name' => '焼肉 李朝園 京都河原町店',
            'description' => '本格的な韓国料理も楽しめる焼肉店。サムギョプサルも人気。',
            'address' => '京都府京都市中京区河原町通蛸薬師下る塩屋町333',
            'telephone' => '075-253-8929',
            'operating_hours' => '全日: 11:30～23:00',
            'image_url' => 'https://example.com/richoen.jpg',
        ]);

        // あと5件！
        Restaurant::create([
            'name' => '焼肉 ぎおん竹',
            'description' => '祇園の隠れ家的な焼肉店。選び抜かれた銘柄牛を贅沢に。',
            'address' => '京都府京都市東山区祇園町北側292',
            'telephone' => '075-555-2929',
            'operating_hours' => '火～日: 17:00～23:00 (月曜定休)',
            'image_url' => 'https://example.com/gion-take.jpg',
        ]);

        Restaurant::create([
            'name' => 'ホルモン 千本今出川',
            'description' => '地元の人に愛されるホルモンの名店。新鮮なホルモンを炭火で焼く。',
            'address' => '京都府京都市上京区千本今出川下る西側',
            'telephone' => '075-463-2929',
            'operating_hours' => '全日: 17:00～23:00',
            'image_url' => 'https://example.com/horumon-senbon.jpg',
        ]);

        Restaurant::create([
            'name' => '和牛焼肉と創作料理 萬樹',
            'description' => '和牛の焼肉と、季節の食材を使った創作料理が楽しめる。',
            'address' => '京都府京都市中京区三条通河原町西入ル',
            'telephone' => '075-257-2989',
            'operating_hours' => '月～金: 17:00～23:00, 土日祝: 12:00～23:00',
            'image_url' => 'https://example.com/mansyu.jpg',
        ]);

        Restaurant::create([
            'name' => '焼肉 大栄 三条店',
            'description' => '昔ながらの雰囲気が魅力の焼肉店。家族経営でアットホームな雰囲気。',
            'address' => '京都府京都市東山区三条通白川橋東入ル',
            'telephone' => '075-771-8929',
            'operating_hours' => '全日: 17:00～22:00 (火曜定休)',
            'image_url' => 'https://example.com/daiei-sanjo.jpg',
        ]);

        Restaurant::create([
            'name' => '炭火焼肉 えん 京都駅前',
            'description' => '京都駅近くでアクセス抜群。カジュアルな雰囲気で炭火焼肉を楽しめる。',
            'address' => '京都府京都市下京区烏丸通七条下る東塩小路町719',
            'telephone' => '075-365-2929',
            'operating_hours' => '全日: 17:00～23:00',
            'image_url' => 'https://example.com/en-kyotoeki.jpg',
        ]);

    }
}