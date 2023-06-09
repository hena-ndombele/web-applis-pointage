<?php

namespace App\Http\Controllers;

use App\Models\Paie;
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
        ->join('presences', 'presences.user_id', '=', 'users.id')
        ->select('users.*', 'roles.name as role_name', 'taux_configurations.montant as taux_montant',)->get();
        return view('paie.index', ['paies'=>Paie::with('taux_configuration')->paginate(3), 'test'=>$paies]);
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Paie $paie)
    {
        //
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
