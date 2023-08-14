<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable =[ 'name' , 'image' , 'is_active' ,'price', 'purchasing_allowed', 'brand_id' , 'total_purchases' , 'total_sales'] ;



    public function scopeByBrandId($query, $brandId)
    {
    return $query->where('brand_id', $brandId);
    }

    public function scopeByVendor($query, $vendor)
    {
    return $query->where('vendor', $vendor);
    }

    public function scopeByInventoryQuantity($query)
    {
    return $query->whereHas('inventories', function ($subquery) {
        $subquery->groupBy('item_id')
                ->havingRaw('SUM(quantity) > 50');
    });
    }


    public function brand(){
        return $this->belongsTo(Brand::class , 'brand_id' , 'id');
    }

    public function inventories()
    {
        return $this->belongsToMany(Inventory::class,
        'inventory_items',
         'item_id',
          'inventory_id',
          'id' , 'id')
          ->withPivot('quantity')
          ->orderBy('quantity', 'desc');
    }


// public function largest(){
//     $largeInventory = $this->inventories()->first();
//     return $largeInventory;

// }
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class,
         'vendor_items',
          'item_id',
           'vendor_id',
           'id' , 'id')
            ->withPivot('quantity');
    }

    public function PurchaseOrders(){
        return $this->hasMany(PurchaseOrder::class , 'item_id', 'id');
    }
}