<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
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

    // fillable column
    protected $fillable = [
        'name',
        'description',
        'type',
        'status',
    ];

    // satu kategori memiliki banyak produk
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    // satu kategori memiliki banyak service
    public function service()
    {
        return $this->hasMany(Service::class);
    }
}
