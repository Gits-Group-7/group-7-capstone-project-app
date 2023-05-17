<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;

    // mengaktifkan fitur uuid
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        // action
        static::creating(function ($model) {
            // meelakukan pengecekan
            if ($model->getKey() == null) {
                $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
            }
        });
    }

    protected $fillable = [
        'name',
        'photo',
        'price',
        'stock',
        'condition',
        'status',
        'description',
        'category_id',
    ];

    // suatu produk berpengaruh terhadap satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // satu produk memiliki banyak promo banner
    public function promo_banners()
    {
        return $this->hasMany(PromoBanner::class);
    }

    // satu produk memiliki banyak rating (produk)
    public function product_rating()
    {
        return $this->hasMany(ProductRating::class);
    }

    // satu produk memiliki banyak cart (produk)
    public function cart_products()
    {
        return $this->hasMany(CartProduct::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function transaction_detail()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
