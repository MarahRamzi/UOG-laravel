<?php

namespace App\Http\Controllers;

use App\Mail\LowQuantityNotification;
use App\Models\Item;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{
    public function makePurchase(Request $request , PurchaseOrder $purchase)
    {
        $items = $purchase->item;
        dd($purchase->item);
        foreach ($items as $item) {
            foreach ($item->inventories as $inventory) {
                if ($inventory->pivot->quantity < 50) {
                    // Send an email to the vendor
                    Mail::to($item->vendor->email)
                        ->send(new LowQuantityNotification($item));
                }
            }
        }
    }
}