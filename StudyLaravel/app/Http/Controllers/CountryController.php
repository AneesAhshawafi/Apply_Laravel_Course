<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::orderBy('id', 'desc')->paginate(20);
        return view("Country.countries", compact("countries"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Country.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $country = Country::create([
            'name' => $request->name,
            'active' => $request->active
        ]);
        return redirect()->route("countries.index")->with("success", "Country created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $country = Country::find($id);
        // return view('Country.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return view('Country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $country = Country::find($id);
        $country->name = $request->name;
        $country->active = $request->active;
        $country->save();
        return redirect('countries');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::find($id);
        $country->delete();
        return redirect('countries');
    }
}
