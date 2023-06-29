<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use FFI;
use Illuminate\Http\Request;

class FicheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structures = Fiche::where('status', 'ACTIVE')->paginate(10);
        return view('structure_salariale.index', compact('structures'));
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
        $validated = $request->validate([
            'rubrique'=>['required', 'min:3', 'string'],
            'type'=>['required', 'string'],
            'mouvement'=>['required', 'string'],
            'valeur'=>['required', 'numeric'],
            'unite'=>['required', 'string']
        ]);
        Fiche::create($request->all());
        return redirect()->route('structure.index')->with('success', "La structure salariale configurée avec succès");
    }

    /**
     * Display the specified resource.
     */
    public function show(Fiche $fiche)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($fiche)
    {
        $structure = Fiche::findOrFail($fiche);
        return view('structure_salariale.edit', compact('structure'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $fiche)
    {
        $validateData = $request->validate(
            [
                'rubrique'=>['required', 'min:3', 'string'],
                'type'=>['required', 'string'],
                'mouvement'=>['required', 'string'],
                'valeur'=>['required', 'numeric'],
                'unite'=>['required', 'string']
            ]
            );
        Fiche::where('id', $fiche)->update(
            [
                'rubrique'=>$validateData['rubrique'],
                'type'=>$validateData['type'],
                'mouvement'=>$validateData['mouvement'],
                'valeur'=>$validateData['valeur'],
                'unite'=>$validateData['unite'],
            ]
        );
        return redirect()->route('structure.index')->with('success', "Modification avec succès");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($fiche)
    {
        $taux = Fiche::findOrFail($fiche);
        if($taux){
            $taux->where('id', $fiche)->update(['status'=>'desactive']);
            return redirect()->route('structure.index')->with('success', "Suppression effectuée avec succès");
        }
        return redirect()->route('structure.index')->with('error', 'Erreur de suppression');
    }
}
