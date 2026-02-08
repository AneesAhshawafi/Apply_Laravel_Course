<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Http\Requests\CreateFlightRequest;



class ResFlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flights = Flight::withTrashed()->active()->with('destination')->orderBy('deleted_at', 'desc')->paginate(10);
        return view('Flights', compact('flights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_flight');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateFlightRequest $request)
    {
        Flight::create([
            'name' => $request->name,
            'active' => $request->active,
           'notes'=>$request->notes 
        ]);
        return redirect('flights');
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
        $flight = Flight::findOrFail($id);
        return view('edit_flight', ['flight' => $flight]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $flight = Flight::findOrFail($id);
        $flight->name = $request->name;
        $flight->active = $request->active;
        $flight->save();
        return redirect('flights');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flight = Flight::find($id);
        $flight->forceDelete();
        return redirect('flights');
    }

    public function delete($id)
    {
        $flight = Flight::find($id);
        $flight->delete();
        return redirect('flights');
    }

    public function restore($id)
    {
        $flight = Flight::withTrashed()->find($id);
        $flight->restore();
        return redirect('flights');
    }


    // public function index()
    // {
    //     // $flights = Flight::all();
    //     $flights = Flight::orderBy('id', 'desc')->paginate(10);

    //     return view('Flights', compact('flights'));
    // }

    // public function create()
    // {
    //     return view('create_flight');
    // }
    // public function store(CreateFlightRequest $request)
    // {
    //     Flight::create([
    //         'name' => $request->name,
    //         'active' => $request->active
    //     ]);
    //     return redirect('flights');
    // }
    // public function edit($Id)
    // {
    //     $flight = Flight::findOrFail($Id);
    //     return view('edit_flight', ['flight' => $flight]);
    // }
    // public function update(Request $request, $Id)
    // {
    //     $flight = Flight::findOrFail($Id);
    //     $flight->name = $request->name;
    //     $flight->active = $request->active;
    //     $flight->save();
    //     return redirect('flights');
    // }

    // public function destroy($Id)
    // {
    //     $flight = Flight::find($Id);
    //     $flight->forceDelete();
    //     return redirect('flights');
    // }
}
