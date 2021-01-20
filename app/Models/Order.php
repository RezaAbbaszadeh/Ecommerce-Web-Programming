<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\OrderProductSeller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function order_product_sellers()
    {
        return $this->hasMany(OrderProductSeller::class);
    }

    public function product_seller()
    {
        return $this->hasManyThrough(ProductSeller::class, OrderProductSeller::class);
    }
}
