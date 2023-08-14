<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Inventory;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $inventory = Inventory::query();

        if (!is_null($request->get('name'))) {
            $inventory = $inventory->where('name', $request->input('name'));
        }

        $inventory = $inventory->get();

        return view('Inventory.index' , compact('inventory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $city= City::all();
       return view('Inventory.create' , compact('city'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inventory = Inventory::create($request->all());
        return redirect(route('inventories.index'))->with('success', 'inventory created' );
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
    public function edit(Inventory $inventory)
    {
        $city = City::all();
        return view('Inventory.edit' , compact('city' , 'inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $inventory->update($request->all());
        return redirect()->route('inventories.index')->with('success' , 'Inventory updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventories.index')->with('success' , 'inventory deleted');
    }

    public function updateInventory(Request $request, Inventory $inventory)
    {
        $newQuantity = $request->input('quantity');
        $inventory->quantity = $newQuantity;
        $inventory->save();

        // Update total_purchases
        $inventory->increment('total_purchases', $newQuantity);

        return redirect()->back()->with('success', 'Inventory updated successfully.');
    }

}