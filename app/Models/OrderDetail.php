<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'quantity',
        'total_price',
        'material',
        'deadline',
        'service_id',
        'transaction_order_id',
    ];

    // suatu order detail berpengaruh terhadap satu service
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    // suatu order detail berpengaruh terhadap satu transaction
    public function transaction_orders()
    {
        return $this->belongsTo(TransactionOrder::class, 'transaction_order_id', 'id');
    }
}
