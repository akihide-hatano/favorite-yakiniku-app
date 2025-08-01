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
        $restaurants = [
            [
                'name' => '炭火焼肉 炎庵（ほのおあん）',
                'description' => '厳選された和牛を炭火でじっくりと。落ち着いた空間で大人の焼肉体験を。',
                'address' => '京都府京都市中京区河原町通三条上る',
                'telephone' => '075-123-4567',
                'operating_hours' => '月～金: 17:00～23:00, 土日祝: 12:00～23:00',
                'image_url' => 'images/photo-1.png',
            ],
            [
                'name' => '七輪亭 牛炎（ぎゅうえん）',
                'description' => '気軽に立ち寄れる大衆焼肉店。新鮮なホルモンと特製タレが自慢。',
                'address' => '京都府京都市下京区烏丸通七条下る',
                'telephone' => '075-987-6543',
                'operating_hours' => '全日: 17:00～24:00',
                'image_url' => 'images/photo-2.png',
            ],
            [
                'name' => '京焼肉 粋月（すいげつ）',
                'description' => '京都の風情を感じる町家で、こだわり抜いた京の和牛を堪能。',
                'address' => '京都府京都市東山区祇園町南側',
                'telephone' => '075-234-5678',
                'operating_hours' => '火～日: 18:00～23:00 (月曜定休)',
                'image_url' => 'images/photo-3.png',
            ],
            [
                'name' => '焼肉 和（なごみ） 烏丸御池',
                'description' => '家族や友人とゆったり過ごせる、アットホームな雰囲気の焼肉店。',
                'address' => '京都府京都市中京区両替町通御池下る',
                'telephone' => '075-345-6789',
                'operating_hours' => '全日: 17:30～23:30',
                'image_url' => 'images/photo-4.png',
            ],
            [
                'name' => '肉匠 大志（たいし）',
                'description' => '職人の技が光る希少部位の数々。肉好きにはたまらないラインナップ。',
                'address' => '京都府京都市伏見区桃山町山ノ下',
                'telephone' => '075-876-5432',
                'operating_hours' => '月～金: 17:00～22:00, 土日祝: 12:00～22:00',
                'image_url' => 'images/photo-5.png',
            ],
            [
                'name' => '焼肉酒場 煙々（えんえん）',
                'description' => '煙もくもく、活気あふれる空間で、美味しい焼肉と美酒を。',
                'address' => '京都府京都市左京区田中里ノ内町',
                'telephone' => '075-456-7890',
                'operating_hours' => '全日: 18:00～翌1:00',
                'image_url' => 'images/photo-6.png',
            ],
            [
                'name' => 'ホルモン酒場 満腹',
                'description' => '種類豊富な新鮮ホルモンが自慢。特製ダレでご飯が進む！',
                'address' => '京都府京都市南区東九条西山町',
                'telephone' => '075-567-8901',
                'operating_hours' => '全日: 16:00～23:00',
                'image_url' => 'images/photo-7.png',
            ],
            [
                'name' => 'プレミアム焼肉 雅（みやび）',
                'description' => '特別な日を彩る、上質な空間と最高級の和牛を。',
                'address' => '京都府京都市中京区木屋町通三条下る',
                'telephone' => '075-678-9012',
                'operating_hours' => '全日: 17:00～23:00',
                'image_url' => 'images/photo-8.png',
            ],
            [
                'name' => '焼肉亭 大黒（だいこく）',
                'description' => '創業50年の老舗。秘伝のタレと変わらぬ味が人気の理由。',
                'address' => '京都府京都市北区紫野泉堂町',
                'telephone' => '075-789-0123',
                'operating_hours' => '火～日: 17:00～22:00 (月曜定休)',
                'image_url' => 'images/photo-9.png',
            ],
            [
                'name' => '焼肉ダイニング 翠（すい）',
                'description' => '選び抜かれた銘柄牛とワインのマリアージュ。洗練された大人の空間。',
                'address' => '京都府京都市上京区今出川通室町西入',
                'telephone' => '075-890-1234',
                'operating_hours' => '全日: 17:30～23:00',
                'image_url' => 'images/photo-10.png',
            ],
            [
                'name' => '炙り家 源（げん）',
                'description' => 'A5ランク和牛の炙り寿司は必食。炭火で炙る逸品揃い。',
                'address' => '京都府京都市下京区四条通高倉西入',
                'telephone' => '075-012-3456',
                'operating_hours' => '全日: 17:00～24:00',
                'image_url' => 'images/photo-11.png',
            ],
            [
                'name' => '焼肉物語 炎の舞',
                'description' => '炎が舞い上がるパフォーマンスも楽しい！エンターテイメント性あふれる焼肉店。',
                'address' => '京都府京都市中京区河原町通蛸薬師下る',
                'telephone' => '075-135-7924',
                'operating_hours' => '月～金: 17:00～23:00, 土日祝: 12:00～23:00',
                'image_url' => 'images/photo-12.png',
            ],
            [
                'name' => '黒毛和牛専門 匠（たくみ）',
                'description' => '目利きが選んだ最高級の黒毛和牛のみを使用。とろける旨みを堪能。',
                'address' => '京都府京都市東山区縄手通四条上る',
                'telephone' => '075-246-8013',
                'operating_hours' => '全日: 17:00～23:00',
                'image_url' => 'images/photo-13.png',
            ],
            [
                'name' => 'ホルモン処 よろこび',
                'description' => 'レトロな雰囲気で賑わうホルモン専門店。希少部位も豊富。',
                'address' => '京都府京都市西京区桂御所町',
                'telephone' => '075-369-1245',
                'operating_hours' => '全日: 18:00～24:00',
                'image_url' => 'images/photo-14.png',
            ],
            [
                'name' => '焼肉と釜飯 香炉（こうろ）',
                'description' => '焼肉の後に〆は釜飯で。こだわりの逸品料理も楽しめる。',
                'address' => '京都府京都市中京区新町通錦小路上る',
                'telephone' => '075-470-3698',
                'operating_hours' => '火～日: 17:00～23:00 (月曜定休)',
                'image_url' => 'images/photo-15.png',
            ],
        ];

        foreach ($restaurants as $restaurantData) {
            Restaurant::create($restaurantData);
        }
    }
}