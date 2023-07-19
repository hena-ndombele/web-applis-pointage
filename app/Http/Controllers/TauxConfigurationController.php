<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Models\TauxConfiguration;

class TauxConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('taux.index', ['taux'=>TauxConfiguration::where('status', 'active')->paginate(2), 'grades'=>Grade::all(), 'exist'=>new TauxConfiguration()]);
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
                "grade_id"=>'required|integer',
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
    public function edit($tauxConfiguration)
    {
    
        $taux = TauxConfiguration::findOrFail($tauxConfiguration);
        return view('taux.edit', ['exist'=>$taux, 'roles'=>Role::all()]);
        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $tauxConfiguration)
    {
        
        $validateData = $request->validate(
            [
                "role_id"=>'required|integer',
                'montant'=>'required|integer',
                'devise'=>'required|string',
            ]
            );
        TauxConfiguration::where('id', $tauxConfiguration)->update(
            [
                'role_id'=>$validateData['role_id'],
                'montant'=>$validateData['montant'],
                'devise'=>$validateData['devise']

            ]
        );
        return redirect()->route('taux.index')->with('success', "Modification avec succès");
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tauxConfiguration)
    {
        $taux = TauxConfiguration::findOrFail($tauxConfiguration);
        if($taux){
            $taux->where('id', $tauxConfiguration)->update(['status'=>'desactive']);
            return redirect()->route('taux.index')->with('success', "Suppression effectuée avec succès");
        }
        return redirect()->route('taux.index')->with('error', 'Erreur de suppression');
        
        
    }
}
