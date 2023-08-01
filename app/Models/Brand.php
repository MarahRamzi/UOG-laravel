<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = [
        'name',
        'note',
        'icon',
        'deleted_at'
    ];

    public function items(){
        return $this->hasMany(Item::class , 'brand_id', 'id');
    }
}