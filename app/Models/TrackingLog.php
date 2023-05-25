<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingLog extends Model
{
    use HasFactory;

    protected $table = 'tracking_logs';

    protected $fillable = [
        'location',
        'note',
        'status',
        'is_complete',
        'transaction_order_id',
    ];

    public function transaction_order()
    {
        return $this->belongsTo(TransactionOrder::class, 'transaction_order_id', 'id');
    }
}
