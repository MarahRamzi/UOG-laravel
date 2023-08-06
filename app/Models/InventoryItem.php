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


}