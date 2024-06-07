<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePacientRequest;
use App\Models\Pacient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PacientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacients = Pacient::all();
        return Inertia::render('Dashboard/Pacients/Index',['pacients' => $pacients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePacientRequest $request)
    {
       
        Pacient::create($request->validated());
        return redirect()->route('pacients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pacient = Pacient::findOrFail($id);
        return redirect()->route('pacients.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pacient = Pacient::findOrFail($id);
        return Inertia::render('Dashboard/Pacients/Edit', ['pacient' => $pacient]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePacientRequest $request, $id)
    {
        // Pacient::find($id)->update($request->all());
        Pacient::findOrFail($id)->update(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'phone' => $request->phone,
            ]
        );
        
        return redirect()->route('pacients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pacient = Pacient::findOrFail($id);
        $pacient->delete();

        return redirect()->back();
    }
}
