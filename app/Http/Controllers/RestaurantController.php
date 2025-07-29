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

        // --- 場所での絞り込み機能 ---
        if ($request->filled('location')) {
            $location = $request->input('location');
            $query->where('address', 'like', '%' . $location . '%');
        }

        // --- 並び替え機能 ---
        if ($request->has('sort') && $request->sort === 'reviews_count') {
            $query->withCount('reviews')->orderByDesc('reviews_count');
        } elseif ($request->has('sort') && $request->sort === 'rating') {
            $query->orderByDesc('reviews_avg_rating');
        } else {
            $query->orderByDesc('reviews_avg_rating');
        }

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

    public function create(){
        return view('restaurants.create');
    }

    public function store(Request $request){
        //バリーデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'operating_hours' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // 画像ファイルはオプション、最大2MB
        ]);

        //画像に関する設定
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/restaurants'); // 例: "public/restaurants/xxxx.png"
            $imagePath = str_replace('public/', 'storage/', $imagePath); // 例: "storage/restaurants/xxxx.png"
        }

        // データベースへの保存
        Restaurant::create([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'telephone' => $request->telephone,
            'operating_hours' => $request->operating_hours,
            'image_url' => $imagePath, // アップロードした画像のパスを設定
            // 他の必要なフィールドも設定
        ]);

        //保存後のリダイレクト
        return redirect()->route('restaurants.index')
                        ->with('success','焼肉店情報が正常に登録されました！');
    }
}
