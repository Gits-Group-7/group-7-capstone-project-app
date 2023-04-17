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
        'category_id',
        'name',
        'photo',
        'price',
        'stock',
        'description',
        'warranty',
        'condition',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
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
