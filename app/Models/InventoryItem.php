<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'inventory_id',
        'quantity',
    ];

    public function city(){
        return $this->belongsTo(City::class , 'city_id' , 'id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'inventory_items', 'item_id', 'inventory_id')
                    ->withPivot('quantity');
    }

    public function purchaseorders()
    {
        return $this->hasMany(PurchaseOrder::class , 'inventory_id' , 'id');
    }
}
