<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'comment',
        'rating_date',
        'product_id',
        'user_id',
    ];

    // suatu rating berpengaruh terhadap satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // suatu rating berpengaruh terhadap satu product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
