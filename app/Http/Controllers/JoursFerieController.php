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

    public function indexApi(){
        try {
            $feries = JoursFerie::select('titre','date','details','type')->get();
            return response()->json($feries);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function store(Request $request){
        $request->validate([
            'titre'=>'required|string|unique:jours_feries',
            'date'=>'required|date',
            'details'=>'required|string|unique:jours_feries',
            'type'=>'required|string',
        ]);
        $feries=JoursFerie::create([
            'titre'=>$request->titre,
            'date'=>$request->date,
            'details'=>$request->details,
            'type'=>$request->type,
        ]);
        
        return redirect()->route('feries.index');

    }

    public function destroy(JoursFerie $fery){
        $fery->delete();
        return redirect()->route('feries.index');

    }
}
