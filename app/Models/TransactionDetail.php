<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_details';

    protected $fillable = [
        'quantity',
        'total_price',
        'product_id',
        'transaction_order_id',
    ];

    // suatu transaction detail berpengaruh terhadap satu product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // suatu transaction detail berpengaruh terhadap satu transaction
    public function transaction_orders()
    {
        return $this->belongsTo(TransactionOrder::class, 'transaction_order_id', 'id');
    }
}
