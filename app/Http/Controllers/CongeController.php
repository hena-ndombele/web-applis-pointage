<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CongeController extends Controller
{
    public function index(){
        $conge= Conge::All();
            return view('conge.congeList',compact('conge'));
      
    }

    public function indexApi(){
        $conge= Conge::all();
 
        return response()->json(['message' => $conge], 200);
    }


    public function store(Request $request){  
        $request->validate([
            'type_conge' => 'required|string|unique:conges',
            'duree' => 'required_unless:type_conge,Congé annuel,congé annuel|integer', 
        ]);

        $typeConge = strtolower($request->type_conge);
        if ($typeConge === 'congé annuel' || $typeConge === 'conge annuel') {
            $typeConge = 'Congé annuel'; 
        } 

        if ($typeConge === 'Congé annuel') {
            $totalConge = DB::table('stock_conges')->pluck('totalConge')->first();
            $duree = $totalConge;
        } else {
            $duree = $request->duree;
        }

        $conge = Conge::create([
            'type_conge' => $typeConge,
            'duree' => $duree,
        ]);
        
        return redirect()->route('conge.index');
    }

    public function edit(Conge $conge){
        return view('conge.modalUpdate',compact('conge'));
    }

    public function update(Request $request, Conge $conge){
        $request->validate([
            'type_conge'=>'required|string|unique:conges',
            'duree'=>'required|integer',
        ]);

        $conge->update($request->all());

        $conge->save();

        return redirect()->route('conge.index');
    }

    public function destroy(Conge $conge){
        $conge->delete();
        return redirect()->route('conge.index');

    }
}
