<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    use HasFactory;

    protected $table = 'order_services';

    protected $fillable = [
        'quantity',
        'total_price',
        'is_checkout',
        'material',
        'custom_design',
        'deadline',
        'service_id',
        'user_id',
    ];

    public function service_order()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function user_order()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
