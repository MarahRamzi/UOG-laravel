<?php

namespace App\Http\Controllers;

use App\Mail\LowQuantityNotification;
use App\Models\Item;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{
    public function makePurchase(Request $request, PurchaseOrder $purchase)
    {
        $items = $purchase->item;
        // dd($items);

        foreach ($items as $item) {
            $totalQuantity = $item->inventories->sum(function ($inventory) {
                return $inventory->pivot->quantity;
            });


            if ($totalQuantity < 50) {
                // Send an email to the vendor
                foreach ($item->vendors as $vendor) {
                    Mail::to($vendor->email)
                        ->send(new LowQuantityNotification($item));
                }
            }
        }
    }
}