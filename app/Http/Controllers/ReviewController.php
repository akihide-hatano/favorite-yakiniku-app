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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
