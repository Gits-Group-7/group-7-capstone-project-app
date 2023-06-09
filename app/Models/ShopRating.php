<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'comment',
        'rating_date',
        'user_id',
    ];

    // suatu rating berpengaruh terhadap satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
