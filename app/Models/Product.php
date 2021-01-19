<?php

namespace App\Models;

use App\Models\Seller;
use App\Models\ProductSeller;
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
        'category_id'
    ];

    public function sellers()
    {
        return $this->belongsToMany(Seller::class)->using(ProductSeller::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
