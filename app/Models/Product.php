<?php

namespace App\Models;

use App\Models\Seller;
use App\Models\ProductSeller;
use App\Models\OrderProductSeller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'img_url',
        'category_id',
        'details'
    ];

    public function sellers()
    {
        return $this->belongsToMany(Seller::class)->using(ProductSeller::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_seller()
    {
        return $this->hasMany(ProductSeller::class);
    }

    public function minPrice()
    {
        return $this->product_seller->min('price');
    }
}
