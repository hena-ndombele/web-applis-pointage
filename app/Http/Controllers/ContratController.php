<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Direction;
use App\Models\Fonction;
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
        $horaires=Horaire::all();
        $fonctions=Fonction::all();
        $directions = Direction::all();
        return view('contrats.index', compact('contrats', 'horaires','fonctions','directions'));
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
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'type' => 'required',
            'duree' => $request->type !== 'CDI' ? 'required' : 'nullable',
            'unite_duree' => $request->type !== 'CDI' ? 'required' : 'nullable',
            'fonction_id' => 'required|exists:fonctions,id',
            'horaire_id' => 'required|exists:horaires,id',
            'direction_id' => 'required|exists:directions,id',
        ]);

        Contrat::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'duree' => $request->input('duree'),
            'unite_duree' => $request->input('unite_duree'),
            'fonction_id' => $request->input('fonction_id'),
            'horaire_id' => $request->input('horaire_id'),
            'direction_id' => $request->input('direction_id'),
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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'type' => 'required',
            'duree' => $request->type !== 'CDI' ? 'required' : 'nullable',
            'unite_duree' => $request->type !== 'CDI' ? 'required' : 'nullable',
            'fonction_id' => 'required|exists:fonctions,id',
            'horaire_id' => 'required|exists:horaires,id',
            'direction_id' => 'required|exists:directions,id',
            
        ]);

        $contrat->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'duree' => $request->input('duree'),
            'unite_duree'=> $request->input('unite_duree'),
            'fonction_id' => $request->input('fonction_id'),
            'horaire_id' => $request->input('horaire_id'),
            'direction_id' => $request->input('direction_id')
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
