<?php

namespace App\Http\Controllers;

use App\Models\Paie;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paies = DB::table('role_user')->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->join('users', 'users.id', '=', 'role_user.user_id')
        ->join('taux_configurations', 'taux_configurations.role_id', '=', 'roles.id')
        ->select('users.id as user_id', 'users.*', 'roles.name as role_name', 'taux_configurations.*',)
        ->where('taux_configurations.status', 'active')->paginate(10);
        return view('paie.index', ['paies'=>$paies]);
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
        $validateData = [
            'user_id'=>'required|integer',
            'taux_id'=>'required|integer',
        ];
        $currentMonth = now()->month;
        $valid=false;
        $lastEntry = Paie::latest()->where('user_id', $request->user_id)->first();
        if($lastEntry != null){
            $valid = true;
        }
        if($valid){
            if($currentMonth == $lastEntry->created_at->month){
                return redirect()->route('paie.index')->with('error', 'Agent déjà enrégisté pour ce mois');
            }
        }
        $presence = Presence::where('user_id', '=', $request->user_id)->count();
        Paie::create(
            [
                'user_id'=>$request->user_id,
                'taux_id'=>$request->taux_id,
                'jours_presents'=>$presence
            ]
        );
        return redirect()->route('paie.index')->with('success', 'Ajout à la liste de paie avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show($query)
    {
        $paies = Paie::where('paie_status', $query)->paginate(10);
        return redirect()->route('paie.show', ['paie'=>$paies]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paie $paie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paie $paie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paie $paie)
    {
        //
    }
}
