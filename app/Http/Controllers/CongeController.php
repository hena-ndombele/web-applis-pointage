<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CongeController extends Controller
{
    public function index(){
        $conge= Conge::All();
            return view('conge.congeList',compact('conge'));
      
    }

    // public function indexApi(){
    //     $conges = Conge::select('id', 'type_conge')->get();
    //     return response()->json($conges);
    // }

    public function indexApi(){
        try {
            $conges = Conge::select('id', 'type_conge','duree')->get();
            return response()->json($conges);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function store(Request $request){
        $request->validate([
            'type_conge'=>'required|string|unique:conges',
            'duree'=>'required|integer',
        ]);
        $conge=Conge::create([
            'type_conge'=>$request->type_conge,
            'duree'=>$request->duree,
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
