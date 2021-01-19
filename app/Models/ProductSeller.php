<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSeller extends Pivot
{
    use HasFactory;

    protected $table = 'product_seller';
}
