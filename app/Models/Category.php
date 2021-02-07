<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function subcategory()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
