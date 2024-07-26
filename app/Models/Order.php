<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable=[
        'user_id',
        'address',
        'phonenumber',
        'payment',
        'total',
    ];
    public $timestamps = true;
    public function orderDetail(){
        return $this->hasMany(
            OrderDetail::class,
            'order_id',
            'id'
        );
    }
}
