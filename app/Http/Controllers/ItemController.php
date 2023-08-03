<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = Item::query();
        $brand = Brand::all();
        $vendor = Vendor::all();


        if (!is_null($request->get('name'))) {
            $item = $item->where('name', $request->input('name'));
        }

        if (!is_null($request->get('brand_id'))) {
            $item = $item->where('brand_id', $request->input( 'brand_id' ));
        }
        // dd($request->all());
        // $vendorName = $request->input($vendor->name);


        if (!is_null($request->get('is_active'))) {
            $item = $item->where('is_active', $request->input('is_active'));
        }

        $item = $item->get();
        // $items = $query->get();


        return view('Item.index', compact('item' , 'brand'  , 'vendor'));
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

        dd($request->all());


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
    public function addToCart($id)
    {
        $item = Item::findOrFail($id);

        $cart = session()->get('cart', []);

        if (!$item->purchasing_allowed) {
            return redirect()->back()->with('error', 'This item is not available for purchase.');
        }

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $item->name,
                "quantity" => 1,
                "price" => $item->price,
                "image" => $item->image,
                "time"  => now(),
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart')->with('success', 'item added to cart successfully!');
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

    public function filterItems()
{
    $brandId = request('brand_id');


    $items = Item::byBrandId($brandId)
    ->byInventoryQuantity()
    ->get();

    $vendors = Vendor::all();


    return view('Item.index', ['items' => $items, 'vendors' => $vendors]);
}
}