<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'is_active',
         'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
