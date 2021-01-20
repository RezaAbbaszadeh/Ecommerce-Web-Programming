<?php

namespace App\Models;

use App\Models\Order;
use App\Models\ProductSeller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProductSeller extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_seller_id',
        'count'
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->hasMany(ProductSeller::class);
    }
}
