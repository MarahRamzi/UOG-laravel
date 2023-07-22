<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request ):Renderable
    {

        $brand = Brand::query();

        if (!is_null($request->get('name'))) {
            $brand = $brand->where('name', $request->input('name'));
        }

        $brand = $brand->get();

        return view('Brand.index', compact('brand' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Brand.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4|unique:brands',
            'note' => ' min:20 | max:300',
            'icon' => 'required|string'
        ]);

        $brand = Brand::create($request->all());

        return redirect()->route('brands.index');


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
        $brand = Brand::find($id);
        return view('Brand.edit', [
            'brand' => $brand,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|min:4',
            'note' => 'min:20 | max:300',
            'icon' => 'required|string'
        ]);
//    dd($request->all());
        $brand = Brand::find($id);
        $brand->update($request->all());
        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Brand::destroy($id);
        return redirect(route('brands.index'));
    }
}