<?php

namespace App\Models;

use App\Models\Seller;
use App\Models\ProductSeller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function sellers()
    {
        return $this->belongsToMany(Seller::class)->using(ProductSeller::class);
    }
}
