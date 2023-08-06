<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['name' , 'city_id', 'phone' , 'is_active','deleted_at'];


    public function city(){
        return $this->belongsTo(city::class , 'city_id' , 'id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class,
         'inventory_items',
          'inventory_id',
          'item_id',
          'id' , 'id')
           ->withPivot('quantity');
    }

    public function PurchaseOrders(){
        return $this->hasMany(PurchaseOrder::class , 'inventory_id', 'id');
    }
}
