<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'photo',
        'role',
        'birthdate',
        'gender',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // satu user dapat melakukan banyak rating shop
    public function user_shop_rating()
    {
        return $this->hasMany(ShopRating::class);
    }

    // satu user dapat melakukan banyak rating product
    public function user_product_rating()
    {
        return $this->hasMany(ProductRating::class);
    }

    // satu user dapat melakukan banyak rating service
    public function user_service_rating()
    {
        return $this->hasMany(ServiceRating::class);
    }

    // satu user dapat melakukan banyak cart product
    public function user_cart_product()
    {
        return $this->hasMany(CartProduct::class);
    }

    // satu user dapat melakukan banyak order service
    public function user_order_service()
    {
        return $this->hasMany(OrderService::class);
    }

    // satu user dapat melakukan banyak order service
    public function transaction_orders()
    {
        return $this->hasMany(TransactionOrder::class);
    }
}
