<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        //
        $grades = Grade::paginate(10);
        return view('grades.index', compact('grades'));
    }

    public function store(Request $request)
    {
        //
        $request->validate(
            ['name' => 'required|unique:grades']
        );
        Grade::create([
            'name' => $request->name
        ]);
        return redirect()->route('grades.index')->with('success', 'Le grade a été ajouté avec succès');
    }

    public function update(Request $request, Grade $grade)
    {
        //
        $request->validate(
            [
                "name" => "required"
            ]
        );
        $grade->update(
            [
                'name' => $request->name,

            ]
        );
        return redirect()->route('grades.index')->with('success', 'Le grade a été modifié avec succès');
    }

    public function destroy(Grade $grade)
    {
        //
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Le grade a été supprimé avec succès');
    }
}
