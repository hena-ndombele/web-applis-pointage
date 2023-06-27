<?php

namespace App\Http\Controllers;

use App\Models\Fonction;
use Illuminate\Http\Request;

class FonctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $fonctions = Fonction::paginate(10);
        return view('fonctions.index', compact('fonctions'));
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
        $request->validate(
            ['name' => 'required|unique:fonctions']
        );
        Fonction::create([
            'name' => $request->name
        ]);
        return redirect()->route('fonctions.index')->with('success', 'La fonction a été ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fonction $fonction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fonction $fonction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fonction $fonction)
    {
        //
        $request->validate(
            [
                "name" => "required"
            ]
        );
        $fonction->update(
            [
                'name' => $request->name,

            ]
        );
        return redirect()->route('fonctions.index')->with('success', 'La fonction a été modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fonction $fonction)
    {
        //
        $fonction->delete();
        return redirect()->route('fonctions.index')->with('success', 'La fonction a été supprimée avec succès');
    }
}
