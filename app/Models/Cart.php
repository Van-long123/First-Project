<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table='carts';
    protected $fillable = [
        'quantity',
        'product_id',
        'product_name',
        'price',
        'image',
        'user_id',
    ];
}
