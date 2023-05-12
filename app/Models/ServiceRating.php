<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'comment',
        'rating_date',
        'service_id',
        'user_id',
    ];

    // suatu rating berpengaruh terhadap satu user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // suatu rating berpengaruh terhadap satu service
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
