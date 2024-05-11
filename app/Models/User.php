<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'login',
        'password'
    ];

    protected $casts = [
        'favorites' => 'array',
    ];
}
