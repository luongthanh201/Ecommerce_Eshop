<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'id_user',
        'img',
        'title',
        'price',
        'id_category',
        'id_brand',
        'status',
        'sale_price',
        'company',
        'detail'
        
    ];
    public $timestamps = true;
}
