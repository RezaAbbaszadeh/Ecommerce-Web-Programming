<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parentCategory(){
        return $this->belongsTo(self::class, 'parent_id');
    }
    public function subcategory() {
        return $this->hasMany(self::class, 'parent_id');
    }
}
