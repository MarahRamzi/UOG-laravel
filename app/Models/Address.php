<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['addressable_type' , 'addressable_id' , 'district' , 'street' , 'phone' , 'city_id'];

    public function addressable()
    {
        return $this->morphTo();
    }

    public function city()
    {
        return $this->belongsTo(City::class , 'city_id' , 'id');
    }
}