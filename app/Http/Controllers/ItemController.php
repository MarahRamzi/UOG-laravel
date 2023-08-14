<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Brand;
use App\Models\CartItem;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\PurchaseOrder;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request , Item $item)
    {
        // $item = Item::all();
        $brand = Brand::all();
        $inventories = Inventory::all();
        $vendors = Vendor::all();

    //  dd($vendors);

        if (!is_null($request->get('name'))) {
            $item = $item->where('name', $request->input('name'));
        }

        //  if (!is_null($inventories->pivot->quantity)) {
        //     $item = $item->wherepivot('quantity','>=' , '50');
        // }

        if (!is_null($request->get('brand_id'))) {
            $item = $item->where('brand_id', $request->input( 'brand_id' ));
        }
        // dd($request->all());

        if (!is_null($request->get('vendor_id'))) {
            $item = $item->where('vendor_id', $request->input( 'vendor_id' ));
        }

        if (!is_null($request->get('inventory_id'))) {
            $item = $item->where('inventory_id', $request->input( 'inventory_id' ));
        }


        if (!is_null($request->get('is_active'))) {
            $item = $item->where('is_active', $request->input('is_active'));
        }

        $item = $item->get();
        // dd($item);


        return view('Item.index', compact('item' , 'brand' , 'inventories' ,'vendors' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brand = Brand::all();

        return view('Item.create', compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request, Brand $brand)
    {


        if ($request->hasFile('image')) {
            $file = $request->file('image'); //uplodedFile object
            $imageName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('storage/covers'), $imageName);

            $request = collect($request)->merge([
                'image' => $imageName
            ]);
        }

        // dd($request->all());


        $item = Item::create($request->all());
        return redirect(route('items.index'))
            ->with('success', 'item created');
    }

    public function cart()
    {
        return view('cart');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart(Request $request , $id ){
        // $data = $request->validate([
        //     'user_id' => 'required',
        //     'item_name' => 'required',
        //     'quantity' => 'required|integer|min:1',
        // ]);
        $item = Item::findOrFail($id);

    $cart = session()->get('cart', []);

    $cartItemId = 'item_' . $item->id;

    if (isset($cart[$cartItemId])) {
        $cart[$cartItemId]['quantity'] += 1;
    } else {
        $cart[$cartItemId] = [
            'item_name' => $item->name,
            'price' => $item->price,
            'quantity' => 1,
            // 'status' => $item->status, // Add the status of the item
        ];
    }

    // Store the updated cart data in the session
    session()->put('cart', $cart);

        $inventoriesWithItems = Inventory::with('items')->get();


        foreach ($inventoriesWithItems as $inventory) {
            $items = $inventory->items;

        }


        $item_name = $item->name;
        $inventory_id = $inventory->id;
        $quantity = '1';

        if (!$item->purchasing_allowed) {
            return redirect()->back()->with('error', 'This item is not available for purchase.');
        }



        // Check if there is an existing "inprogress" purchase order for the user
        $order = PurchaseOrder::where('status', 'inprogress')->first();

        if (!$order) {
            // If no existing order, create a new one
            $order = PurchaseOrder::create([
                'item_id' => $item->id,
                'inventory_id' => $inventory_id,
                'status' => '1',
            ]);
        }

        // if( $order->status == '1'){
        //     $order->status = 'inprogress';
        //    }else{
        //     $order->status = 'dilevered';
        //    }

        // Associate the cart item with the purchase order
        $cart_item = CartItem::create([
            'order_id' => $order->id,
            'item_id' => $item->id,
            'inventory_id' => $inventory_id,
            'item_name' => $item_name,
            'quantity' => $quantity,
        ]);

        // Update the "inprogress" status of the purchase order
        $order->status = '1';
        $order->save();

        return redirect()->route('cart')->with('success', 'Item added to cart successfully!');
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'item removed successfully');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::all();
        $item = Item::find($id);
        return view('Item.edit', compact('item', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, string $id)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image'); //uplodedFile object
            $imageName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('storage/covers'), $imageName);

            $request = collect($request)->merge([
                'image' => $imageName
            ]);

        }


        $item = Item::find($id);

        $old = $item->image;

        $item->update($request->all());

        if($old &&  $old != $item->image ){
            Storage::disk('public')->delete($old);
        }
        return redirect()->route('items.index')->with('success' , 'item updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success' , 'item deleted');
    }

//     public function filterItems()
// {
//     $brandId = request('brand_id');


//     $items = Item::byBrandId($brandId)
//     ->byInventoryQuantity()
//     ->get();

//     $vendors = Vendor::all();


//     return view('Item.index', ['items' => $items, 'vendors' => $vendors]);
// }

public function Largestquantity(Item $item)
{
    $largeInventory = $item->inventories()->first();

    return view('Item.largeQuantity' , compact('item' ,'largeInventory'));
}
}