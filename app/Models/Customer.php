<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'birthday',
        'national_id'
    ];
    protected $guarded = [];
  
    public function user() 
    { 
        return $this->morphOne(User::class, 'profile');
    }
}
