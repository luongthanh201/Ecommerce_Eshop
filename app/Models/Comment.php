<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = [
        'cmt',
        'id_blog',
        'id_user',
        'avatar_user',
        'name_user',
        'level',
    ];
    public $timestamps = true;
}
