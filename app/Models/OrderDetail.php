<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table='orders_detail';
    protected $fillable=[
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];
    public $timestamps = true;
    public function product(){
        return $this->belongsTo(
            product::class,
            'product_id',
            'id'
        );
    }
}
