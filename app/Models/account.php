<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    use HasFactory;
    protected $table = 'account';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    public $timestamps = true;
}

