<?php
namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use COM;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $country = Country::query();

        if (!is_null($request->get('name'))) {
            $country = $country->where('name', $request->input('name'));
        }


        $country = $country->get();
        return view('Country.index' , compact('country'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $country = Country::all();
        return view('Country.create',compact('country'));
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
       $country = Country::create($request->validated());
       return redirect(route('countries.index'))->with('success' , 'country crated');
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
        $country = Country::find($id);
        return view('Country.edit' , compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, string $id)
    {
        $country = Country::findOrFail($id);
        $country->update($request->validated());
        return redirect()->route('countries.index')->with('success' , 'country updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
            $country->delete();
            return redirect(route('countries.index'))->with('success' , 'country deleted ');
    }
}