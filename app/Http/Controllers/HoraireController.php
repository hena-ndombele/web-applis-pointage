<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use App\Models\Horaire;
use Illuminate\Http\Request;

class HoraireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $horaires = Horaire::paginate(5);
        $contrats = Contrat::all();
        return view('horaires.index', compact('horaires', 'contrats'));
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
        $horaire =$request->validate([
            'name' => 'required',
            'heuredebut' => 'required|date_format:H:i',
            'heurefin' => 'required|date_format:H:i|after:heuredebut',
            'heurepausedebut' => [
                'date_format:H:i',
                'after:heuredebut',
                'before:heurepausefin',
                'nullable',
                function ($attribute, $value, $fail) use ($request) {
                    if (!empty($value) && empty($request->input('heurepausefin'))) {
                        $fail('Le champ Heure de fin de pause est obligatoire si le champ Heure de début de pause est renseigné.');
                    }
                }
            ],
            'heurepausefin' => [
                'date_format:H:i',
                'before:heurefin',
                'after:heurepausedebut',
                'nullable',
                function ($attribute, $value, $fail) use ($request) {
                    if (!empty($value) && empty($request->input('heurepausedebut'))) {
                        $fail('Le champ Heure de début de pause est obligatoire si le champ Heure de fin de pause est renseigné.');
                    }
                }
            ],
            'jours' => 'required',
            'contrat_id' => 'required',
        ]);

        $horaire['jours'] = implode(', ', $request->jours);

        Horaire::create($horaire);

        return redirect()->route('horaires.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Horaire $horaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horaire $horaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Horaire $horaire)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'heuredebut' => 'required|date_format:H:i',
            'heurefin' => 'required|date_format:H:i|after:heuredebut',
            'heurepausedebut' => [
                'date_format:H:i',
                'after:heuredebut',
                'before:heurepausefin',
                'nullable',
                function ($attribute, $value, $fail) use ($request) {
                    if (!empty($value) && empty($request->input('heurepausefin'))) {
                        $fail('Le champ Heure de fin de pause est obligatoire si le champ Heure de début de pause est renseigné.');
                    }
                }
            ],
            'heurepausefin' => [
                'date_format:H:i',
                'before:heurefin',
                'after:heurepausedebut',
                'nullable',
                function ($attribute, $value, $fail) use ($request) {
                    if (!empty($value) && empty($request->input('heurepausedebut'))) {
                        $fail('Le champ Heure de début de pause est obligatoire si le champ Heure de fin de pause est renseigné.');
                    }
                }
            ],
            'jours' => 'required',
            'contrat_id' => 'required',
        ]);

        $validatedData['jours'] = implode(',', $request->jours);

        $horaire->update($validatedData);

        return redirect()->route('horaires.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horaire $horaire)
    {
        //
        $horaire->delete();
        return redirect()->route('horaires.index')->with('success', 'suppression horaire reussi');
    }
}
