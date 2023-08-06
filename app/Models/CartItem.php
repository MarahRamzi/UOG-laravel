<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'order_id', 'item_name', 'quantity' , 'item_id' , 'inventory_id'];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class, 'order_id' , 'id');
    }
}