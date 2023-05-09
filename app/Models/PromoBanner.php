<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'photo',
        'status',
        'product_id',
        'service_id',
    ];

    // suatu promo berpengaruh terhadap satu produk
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // suatu promo berpengaruh terhadap satu service
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
