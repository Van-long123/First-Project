<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table='products';
    public function getAllProduct($keywords=null,$perPage=null){
        $products=product::select('id','product_name','image','price','quantity');
        if(!empty($keywords)){
            $products=$products->where('product_name','like','%'.$keywords.'%');
        }
        $products=$products->paginate($perPage)->withQueryString();
        return $products;
    }

    public function comments(){
        return $this->hasMany(
            Comment::class,
            'product_id',
            'id'
        );
    }


    protected $fillable = [
        'product_name',
        'image',
        'description',
        'price',
        'quantity',
        'category_id',
    ];
}
