<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

class RestaurantController extends Controller
{

    /**
     * 焼肉店一覧を表示 (検索・絞り込み機能を追加)
     */
    public function index(Request $request){
        dd('ここまでは来てるよ！');

        $query = Restaurant::query();
    
        //平均を取得
        $query->withAvg('reviews','rating');

        //---検索機能---
        if($request->filled('search')){
            $search = $request->input('search');
            $query->where(function ($q) use ($search){
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        //---評評価による絞りこみ機能---
        if($request->has('rating')&&is_numeric($request->rating)){
            $selectRating = $request->rating;
            if($selectRating >=1 && $selectRating <= 5){
               // withAvg で計算された平均評価を使い、指定された評価以上の店舗を絞り込む
                $query->having('reviews_avg_rating', '>=', $selectRating);
            }
        }

        // --- 並び替え機能 ---
        if ($request->has('sort') && $request->sort === 'reviews_count') {
            $query->withCount('reviews')->orderByDesc('reviews_count');
        } elseif ($request->has('sort') && $request->sort === 'rating') {
            $query->orderByDesc('reviews_avg_rating');
        } else {
            $query->orderByDesc('reviews_avg_rating');
        }

        // ここに dd() を追加！
        // 構築されたSQL文と、バインドされる値を確認できます
        dd($query->toSql(), $query->getBindings());

        //クエリを実行してデータを取得
        $restaurants = $query->get();

        return view('restaurants.index',compact('restaurants'));
    }

    /**
     * 特定の焼肉店の詳細を表示
     */
    public function show(Restaurant $restaurant)
    {
        $restaurant->load('reviews.user');
        return view('restaurants.show', compact('restaurant'));
    }
}
