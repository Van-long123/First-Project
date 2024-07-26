<?php

namespace App\Models;

use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use HasFactory;
    protected $table='categories';    
    public function getAllCategory(){
        $category = category::all();
        return $category;
    }
    public function products(){
        return $this->hasMany(
            product::class,
            'category_id',
            'id'
        );
    }

    protected $fillable=[
        'category_name',
        'image',
    ];
}
