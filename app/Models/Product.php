<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'user_id',
    ];


    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }
}
