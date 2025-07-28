<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'telephone',
        'operating_hours',
        'image_url',
    ];

    // 必要であればリレーションなどをここに記述
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}