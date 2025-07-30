<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Review; // これも忘れずにインポート
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // これも忘れずにインポート

class DashboardController extends Controller
{
    public function index()
    {
        // --- ここからhighlyRatedRestaurantsの取得ロジック ---
        $highlyRatedRestaurants = Restaurant::with('reviews')
            ->select('restaurants.*', DB::raw('AVG(reviews.rating) as avg_rating'))
            ->leftJoin('reviews', 'restaurants.id', '=', 'reviews.restaurant_id')
            ->groupBy('restaurants.id')
            ->havingRaw('AVG(reviews.rating) >= 3')
            ->orHavingRaw('COUNT(reviews.id) = 0')
            ->get();
        // --- ここまでhighlyRatedRestaurantsの取得ロジック ---

        // --- ここからuserReviewsの取得ロジック ---
        $userReviews = collect(); // デフォルトで空のコレクションを初期化しておく
        if (Auth::check()) { // ログインしているか確認
            $userReviews = Auth::user()->reviews()->with('restaurant')->latest()->take(5)->get();
        }
        // --- ここまでuserReviewsの取得ロジック ---

        // ビューに両方の変数を渡す
        return view('dashboard', [
            'highlyRatedRestaurants' => $highlyRatedRestaurants,
            'userReviews' => $userReviews,
        ]);
    }
}