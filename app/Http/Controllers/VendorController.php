<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequest;
use App\Models\Vendor;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request):Renderable
    {
        $vendor = Vendor::query();

        $fullNames = Vendor::select( DB::raw("CONCAT(vendors.first_name,' ',vendors.last_name) as full_name"))
        ->pluck('full_name');

        if (!is_null($request->input('fullNames'))) {

            $fullNames = $request->input('fullNames');

            list($firstName, $lastName) = explode(' ', $fullNames);

            $vendor = $vendor->where('first_name', $firstName)
                         ->where('last_name', $lastName);
        }

        if (!is_null($request->get('email'))) {
            $vendor = $vendor->where('email', $request->input('email'));
        }

        if (!is_null($request->get('is_active'))) {
            $vendor = $vendor->where('is_active', $request->input('is_active'));
        }


        $vendor = $vendor->get();

        return view('Vendor.index', compact('vendor' ,  'fullNames'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('Vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendorRequest $request):RedirectResponse
    {
        $vlaidaed = $request->validated();
        $vendor= Vendor::create($vlaidaed);

        //PRG
        return redirect()->route('vendors.index')->with('success' , 'vendor created');
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
    public function edit(string $id):View
    {
        $vendor= Vendor::find($id);
        return view('Vendor.edit  ')->with('vendor' , $vendor );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorRequest $request,  $id):RedirectResponse
    {

            $vendor = Vendor::find($id);
            $validated =$request->validated();
            $vendor->update($validated);
            return redirect()->route('vendors.index')->with('success' , 'vendor updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       Vendor::destroy($id);

       return redirect()->route('vendors.index')->with('success' , 'vendor deleted');

    }
}
