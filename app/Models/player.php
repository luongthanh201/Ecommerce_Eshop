<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class player extends Model
{
    use HasFactory;
    protected $table = 'player';
    protected $fillable = [
        'tenCT', 
        'tuoi', 
        'quoctich', 
        'vitri', 
        'luong'
    ];
    public $timestampps = true;
}
