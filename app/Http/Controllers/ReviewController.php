<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Restaurant $restaurant)
    {

        // $restaurant に紐づくレビューを取得し、ページネーション
        // with('user') で、各レビューに紐づくユーザー情報も一緒に取得します（N+1問題対策）
        $reviews = $restaurant->reviews()->with('user')->latest()->paginate(10);

        $averageRating = $restaurant->reviews()->avg('rating');

        // dd('店舗の評価平均',$averageRating);
        return view('restaurants.reviews.index', compact('restaurant', 'reviews','averageRating'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Restaurant $restaurant)
    {
        return view('restaurants.reviews.create',compact('restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Restaurant $restaurant)
    {
        // ★ 処理の開始を確認（dumpに変更）
        // dd('storeメソッドが実行されました'); // dump() に変更

        //バリデーションのルールを定義
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // ★ バリデーションの成功を確認（dumpに変更）
        // dd('バリデーション成功:', $validatedData); // dump() に変更

        //ユーザーが既にこの店舗にレビューを投稿しているか確認
        $existReview = $restaurant->reviews()
                                    ->where('user_id',Auth::id())
                                    ->first();
        if ($existReview) {
            // ★ 既存レビューがある場合の確認（dumpに変更）
            // dd('既存レビューがあります。リダイレクトされます。'); // dump() に変更
            return back()->with('error', 'この店舗はすでにレビュー済みです。');
        }

        //レビューの保存
        $review = new Review($validatedData);
        $review->user_id = Auth::id();
        $review->restaurant_id = $restaurant->id;

        $restaurant->reviews()->save($review);

        //保存後のリダイレクト
        return redirect()->route('restaurants.reviews.index', $restaurant)
                        ->with('success', 'レビューを投稿しました！');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant, Review $review)
    {
        // ログインユーザーがこのレビューの投稿者であることを確認
        if (Auth::id() !== $review->user_id) {
            // 投稿者でなければ、不正アクセスとしてリダイレクトするか、エラーメッセージを表示
            return redirect()->route('restaurants.reviews.index', $restaurant)->with('error', '他のユーザーのレビューは編集できません。');
        }
        return view('restaurants.reviews.edit',compact('review','restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant, Review $review)
    {
        //権限の確認
        if( Auth::id() !== $review->user_id){
            return redirect()->route('restaurants.reviews.index', $restaurant)
                            ->with('error','他のユーザーのレビューは編集できません');
        }


        //バリデーション
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5', // 必須、整数、1から5の範囲
            'comment' => 'nullable|string|max:500',    // 省略可能、文字列、最大500文字
        ]);


        //レビューの更新
        $review->rating = $validatedData['rating'];
        $review->comment = $validatedData['comment'];
        $review->save();

        // 更新後のリダイレクト
        return redirect()->route('restaurants.reviews.index', $restaurant)
                        ->with('success', 'レビューを更新しました！');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Restaurant $restaurant,Review $review)
    {
        //権限の確認
        if( Auth::id() !== $review->user_id){
            return redirect()->route('restaurants.reviews.index', $restaurant)
                            ->with('error','他のユーザーのレビューは編集できません');
        }

        // dd('レストランobj:',$restaurant,'レビューobj:',$review);
        $review->delete();

        return redirect()->route('restaurants.reviews.index', $restaurant)
                        ->with('success','レビューの削除をしました');
    }
}
