<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'total_price',
        'is_checkout',
        'product_id',
        'user_id',
    ];

    public function product_cart()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function user_cart()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
