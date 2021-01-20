<?php

namespace App\Models;

use App\Models\Seller;
use App\Models\Customer;
use App\Models\OrderProductSeller;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected $with = ['profile'];

    public function profile()
    {
        return $this->morphTo();
    }

    public function getIsCustomerAttribute()
    {
        return $this->profile_type == Customer::class;
    }
    public function getIsSellerAttribute()
    {
        return $this->profile_type == Seller::class;
    }

    public function orderproductSeller()
    {
        return $this->hasMany(OrderProductSeller::class);
    }
}
