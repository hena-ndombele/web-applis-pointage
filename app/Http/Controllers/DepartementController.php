<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Direction;
use App\Http\Requests\StoreDepartementRequest;
use App\Http\Requests\UpdateDepartementRequest;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $directions=Direction::all();
        $departements = Departement::latest()->paginate(10);
       
        return view('departements.index', compact('directions','departements'))
            ->with('i', (request()->input('page', 1) - 1) * 4);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartementRequest $request)
    {
        $request->validate(
            ['name'=>'required|unique:departements','direction_id'=>'required']
        );
        Departement::create([
            'name'=>$request->name,
            'direction_id'=>$request->direction_id
        ]);
        return redirect()->route('departements.index')->with('success','Le departement a été ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $departement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartementRequest $request, Departement $departement)
    {
        $request->validate(
            ['name'=>'required','direction_id'=>'required']

        );
        $departement->update([
            'name' =>$request->name, 
            'direction_id'=>$request->direction_id      

        ]
        );  
        return redirect()->route('departements.index')->with('success','Le departement a été modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->route('departements.index')->with('success','Le departement a été supprimée avec succès');
    }
}
