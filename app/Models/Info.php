<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $table='user_information';
    protected $fillable=[
            'username',
            'user_id',
            'address',
            'phonenumber',
            'payment',
    ];
}
