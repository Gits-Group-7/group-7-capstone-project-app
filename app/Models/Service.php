<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
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
        'price_per_pcs',
        'price_per_dozen',
        'estimation',
        'description',
        'category_id',
    ];

    // suatu service berpengaruh terhadap satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
