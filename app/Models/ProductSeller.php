<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSeller extends Pivot
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'product_seller';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }

}
