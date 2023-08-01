<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory ,SoftDeletes;

    protected  $fillable =['name' , 'country_id' , 'deleted_at'];

    public function country(){
        return $this->belongsTo(Country::class , 'country_id' , 'id');
    }

    public function inventories(){
        return $this->hasMany(Inventory::class , 'city_id', 'id');
    }
}