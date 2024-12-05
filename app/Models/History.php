<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = 'history';
    protected $fillable = [
        'user_id',
        'cart',
        'total_amount',
        'title',
        'price',
        'email'
    ];
    protected $casts = [
        'cart' => 'array', // Cast 'cart' thành mảng
    ];
    public $timestamps = true;
}
