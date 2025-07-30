<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ★ 追加
use App\Models\User;
use App\Models\Restaurant;

class Review extends Model
{
    // ★ 追加
    use HasFactory; 

    // ★ 追加
    // レビューがどのユーザーに属するか
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ★ 追加
    // レビューがどのレストランに属するか
    public function restaurant()
    {
        // もしDBのカラム名が 'restrauant_id' のままであれば、第二引数で指定
        // return $this->belongsTo(Restaurant::class, 'restrauant_id');
        // 通常は 'restaurant_id' なので、以下でOK
        return $this->belongsTo(Restaurant::class);
    }

    // ★ 追加 (fillableプロパティ)
    // マスアサインメントを許可するカラムを指定
    protected $fillable = [
        'user_id',
        'restaurant_id', // もしDBのカラム名が 'restrauant_id' なら、こちらを 'restrauant_id' に
        'rating',
        'comment',
    ];
}