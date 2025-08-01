<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use function Ramsey\Uuid\v1;

class RestaurantController extends Controller
{

    /**
     * 焼肉店一覧を表示 (検索・絞り込み機能を追加)
     */
    public function index(Request $request)
    {
// まず、平均評価と口コミ数を計算するサブクエリを作成
        $subQuery = DB::table('restaurants')
            ->select(
                'restaurants.id',
                DB::raw('AVG(reviews.rating) as avg_rating'),
                DB::raw('COUNT(reviews.id) as reviews_count')
            )
            ->leftJoin('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
            ->groupBy(
                'restaurants.id' // GROUP BY は ID のみでOK。他のカラムは後で結合
            );

        // メインのクエリ
        $query = Restaurant::query()
            // サブクエリをleftJoinで結合し、エイリアス 'restaurant_stats' として使う
            ->leftJoinSub($subQuery, 'restaurant_stats', function ($join) {
                $join->on('restaurants.id', '=', 'restaurant_stats.id');
            });

        // SELECT 句で必要なカラムと、サブクエリで取得した avg_rating, reviews_count を指定
        $query->select(
            'restaurants.*',
            DB::raw('COALESCE(restaurant_stats.avg_rating, 0) as avg_rating'), // avg_rating がnullの場合に0を表示
            DB::raw('COALESCE(restaurant_stats.reviews_count, 0) as reviews_count') // reviews_count がnullの場合に0を表示
        );

        // --- 検索機能 ---
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('restaurants.name', 'like', '%' . $search . '%')
                  ->orWhere('restaurants.description', 'like', '%' . $search . '%');
            });
        }

        // --- 評価による絞り込み機能 ---
        if ($request->has('rating') && is_numeric($request->rating)) {
            $selectRating = $request->rating;
            if ($selectRating >= 1 && $selectRating <= 5) {
                // サブクエリから結合したエイリアス 'avg_rating' を直接 where で参照
                // COALESCE を使って null の場合も考慮
                $query->where(DB::raw('COALESCE(restaurant_stats.avg_rating, 0)'), '>=', $selectRating);
                // もし評価が全くない店舗を絞り込みたい場合 (例: 4以上を選んだ時に評価0の店舗を除外)
                // $query->where('restaurant_stats.reviews_count', '>', 0);
            }
        }

        // --- 場所での絞り込み機能 ---
        if ($request->filled('location')) {
            $location = $request->input('location');
            $query->where('restaurants.address', 'like', '%' . $location . '%');
        }

        // --- 並び替え機能 ---
        if ($request->has('sort')) {
            if ($request->sort === 'reviews_count') {
                $query->orderByDesc('reviews_count');
            } elseif ($request->sort === 'rating') {
                $query->orderByDesc('avg_rating');
            }
        } else {
            $query->orderByDesc('avg_rating');
            $query->orderByDesc('reviews_count');
        }

        // DDはここで一旦コメントアウト/削除
        // dd($query->toSql(), $query->getBindings());

        $restaurants = $query->paginate(15); // ここは paginate のままでOKです

        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * 特定の焼肉店の詳細を表示
     */
    public function show(Restaurant $restaurant)
    {
        $restaurant->loadAvg('reviews', 'rating')->loadCount('reviews');
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