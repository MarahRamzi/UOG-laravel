<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'vendor_id',
        'quantity',
    ];
}