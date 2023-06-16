<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Horaire;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $contrats = Contrat::paginate(5);
        return view('contrats.index', compact('contrats'));
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
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required',
            'date' => 'required',
        ]);
        Contrat::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
        ]);
        return redirect()->route('contrats.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contrat $contrat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrat $contrat)
    {
        //
        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contrat $contrat)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required',
            'date' => 'required',
        ]);
        $contrat->update([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
        ]);
        return redirect()->route('contrats.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrat $contrat)
    {
        //
        $contrat->delete();
        return redirect()->route('contrats.index')->with('success','suppression de contrat reussi');
    }
}
