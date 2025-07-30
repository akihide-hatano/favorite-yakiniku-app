<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


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

public function store(Request $request)
{
    Log::info('Store method called.');
    Log::info('Request has file: ' . ($request->hasFile('image') ? 'Yes' : 'No'));
    Log::info('Uploaded file info: ' . json_encode($request->file('image')));
    Log::info('All request data: ' . json_encode($request->all()));

    // バリデーション
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'address' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'operating_hours' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $uploadedFile = $request->file('image');
        $fileName = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        try {
            // storeAs の呼び出し
            $imagePath = $uploadedFile->storeAs('restaurants', $fileName, 'public');
            Log::info('画像が保存されました: ' . $imagePath);
        } catch (\Exception $e) {
            // 保存に失敗した場合のログを追加
            Log::error('画像の保存に失敗しました: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return back()->with('error', '画像のアップロード中にエラーが発生しました。' . $e->getMessage());
        }
    }

    $restaurant = new Restaurant();
    $restaurant->name = $validatedData['name'];
    $restaurant->description = $validatedData['description'];
    $restaurant->address = $validatedData['address'];
    $restaurant->telephone = $validatedData['telephone'];
    $restaurant->operating_hours = $validatedData['operating_hours'];
    $restaurant->image_url = $imagePath ? 'storage/' . $imagePath : null;
    $restaurant->save();

    return redirect()->route('restaurants.index')->with('success', '新しい焼肉店を登録しました。');
}

    public function edit(Restaurant $restaurant){
            return view('restaurants.edit',compact('restaurant'));
    }


    /**
     * 焼肉店情報を更新
     */
    public function update(Request $request, Restaurant $restaurant)
    {
    //     dd([
    // 'リクエストデータ' => $request->all(),
    // '店舗モデル' => $restaurant,
    // ]);

        Log::info('Update method called.');
        Log::info('Request has file: ' . ($request->hasFile('image') ? 'Yes' : 'No'));
        Log::info('Uploaded file info: ' . json_encode($request->file('image')));
        Log::info('All request data: ' . json_encode($request->all()));

        // バリデーション
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'operating_hours' => 'required|string|max:255',
            // 画像はnullableに。更新時も新しい画像がなければ既存のものを維持
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // 画像の処理
        if ($request->hasFile('image')) {
            // 新しい画像がアップロードされた場合
            $uploadedFile = $request->file('image');
            $fileName = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            
            try {
                // 古い画像があれば削除
                if ($restaurant->image_url) {
                    $oldFilePath = str_replace('storage/', '', $restaurant->image_url);
                    if (Storage::disk('public')->exists($oldFilePath)) {
                        Storage::disk('public')->delete($oldFilePath);
                        Log::info('古い画像ファイルを削除しました: ' . $oldFilePath);
                    } else {
                        Log::warning('古い画像ファイルが見つかりません（削除スキップ）: ' . $oldFilePath);
                    }
                }

                // 新しい画像を保存
                $imagePath = $uploadedFile->storeAs('restaurants', $fileName, 'public');
                $restaurant->image_url = 'storage/' . $imagePath; // DBパスを更新
                Log::info('新しい画像が保存されました: ' . $restaurant->image_url);

            } catch (\Exception $e) {
                Log::error('画像の保存または削除に失敗しました: ' . $e->getMessage());
                Log::error($e->getTraceAsString());
                return back()->with('error', '画像のアップロード中にエラーが発生しました。' . $e->getMessage());
            }
        }

        // 店舗情報の更新
        $restaurant->name = $validatedData['name'];
        $restaurant->description = $validatedData['description'];
        $restaurant->address = $validatedData['address'];
        $restaurant->telephone = $validatedData['telephone'];
        $restaurant->operating_hours = $validatedData['operating_hours'];
        
        $restaurant->save();

        return redirect()->route('restaurants.show', $restaurant)->with('success', '店舗情報を更新しました。');
    }



    public function destroy( Restaurant $restaurant) {
        // 1. 画像ファイルがデータベースに保存されているか確認し、あれば削除する
            if ($restaurant->image_url) {
                // image_url は 'storage/restaurants/ファイル名.png' の形式なので
                // 'storage/' 部分を削除して、storage/app/public/restaurants/ファイル名.png にアクセスできるようにする
                $filePath = str_replace('storage/', '', $restaurant->image_url);

                // Storage::disk('public') を使ってファイルを削除
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                    Log::info('画像ファイルを削除しました: ' . $filePath);
                } else {
                    Log::warning('削除しようとした画像ファイルが見つかりません: ' . $filePath);
                }
            }

            // 2. データベースのレコードを削除
            $restaurant->delete();
            Log::info('焼肉店レコードを削除しました: ID=' . $restaurant->id);


            return redirect()->route('restaurants.index')->with('success', '焼肉店を削除しました。');
        
        }
    }