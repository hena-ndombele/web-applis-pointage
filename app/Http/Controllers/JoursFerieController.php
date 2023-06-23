<?php

namespace App\Http\Controllers;

use App\Models\JoursFerie;
use Illuminate\Http\Request;

class JoursFerieController extends Controller
{
    public function index(){
        $feries= JoursFerie::All();
            return view('feries.ferieList',compact('feries'));

    }

    public function store(Request $request){
        $request->validate([
            'titre'=>'required|string|unique:jours_feries',
            'date'=>'required|date',
        ]);
        $feries=JoursFerie::create([
            'titre'=>$request->titre,
            'date'=>$request->date,
        ]);
        
        return redirect()->route('feries.index');

    }

    public function destroy(JoursFerie $fery){
        $fery->delete();
        return redirect()->route('feries.index');

    }
}
