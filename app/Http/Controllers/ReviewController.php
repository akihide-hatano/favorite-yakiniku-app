<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request,Restaurant $restaurant)
    {
        //バリデーションのルールを定義
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        //ユーザーが既にこの店舗にレビューを投稿しているか確認
        $existReview = $restaurant->reviews()
                                    ->where('user_id',Auth::id())
                                    ->first();
        if ($existReview) {
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
