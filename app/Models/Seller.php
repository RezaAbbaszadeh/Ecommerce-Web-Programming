<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_name'
    ];
    protected $guarded = [];
  
    public function user() 
    { 
        return $this->morphOne(User::class, 'profile');
    }
}
