<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TransactionOrder extends Model
{
    use HasFactory;

    protected $table = 'transaction_orders';

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
        'snap_token',
        'order_date',
        'order_address',
        'order_note',
        'type_transaction_order',
        'prof_order_payment',
        'order_confirmed',
        'delivery_price',
        'track_delivery_location',
        'status_delivery',
        'delivery_complete',
        'user_id',
    ];

    // satu Transaction Order memiliki banyak Transaction Log
    public function tracking_logs()
    {
        return $this->hasMany(TrackingLog::class);
    }

    // satu Transaction Order memiliki banyak order detail Log
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // satu Transaction Order memiliki banyak transaction detail Log
    public function transaction_details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
