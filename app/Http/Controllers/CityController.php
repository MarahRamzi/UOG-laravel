<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $city = City::query();

        if (!is_null($request->get('name'))) {
            $city = $city->where('name', $request->input('name'));
        }

        $city = $city->get();

        return view('City.index' , compact('city'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $country = Country::all();
        return view('City.create' , compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        // dd($request->all());

            $city = City::create($request->validated());

            return redirect()->route('cities.index' )
            ->with('success' , 'city created');

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
        $country = Country::all();
        $city = City::find($id);
        return view('City.edit' , compact('city' , 'country'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, string $id)
    {
            $city = City::find($id);
            $city->update($request->all());
            return redirect()->route('cities.index')->with('success' , 'city updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city )
    {
        $city->delete();
        return redirect()->route('cities.index')->with('success' , 'city deleted');
    }
}
