<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\TauxConfiguration;

class TauxConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('taux.index', ['taux'=>TauxConfiguration::paginate(3), 'roles'=>Role::all(), 'exist'=>new TauxConfiguration()]);
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
        $validateData = $request->validate(
            [
                "role_id"=>'required|integer',
                'montant'=>'required|integer',
                'devise'=>'required|string',
            ]
        );
        TauxConfiguration::create($request->all());
        return redirect()->route('taux.index')->with('success', "Le taux a été configuré avec succès");
    }

    /**
     * Display the specified resource.
     */
    public function show(TauxConfiguration $tauxConfiguration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TauxConfiguration $tauxConfiguration)
    {
        $taux = TauxConfiguration::findOrFail($tauxConfiguration);
        return view('taux.index', ['exist'=>$taux]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TauxConfiguration $tauxConfiguration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TauxConfiguration $tauxConfiguration)
    {
        $tauxConfiguration->delete();
        return redirect()->route('taux.index')->with('success', "Suppression effectuée avec succès");
    }
}
