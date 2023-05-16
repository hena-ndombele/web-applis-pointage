<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\User;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presences = Presence::latest()->get();
        return view('presences.index', compact('presences'));
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
        $user = User::where(['id' => $request->user_id])->first();

        #Code temporaire en attente des informations réelles
        // $url = Url::where(['id' => ['url' => $request->url]])->first();
        $url = '';

        if (($user) && ($url)) {
            Presence::create([
                'user_id'    => $request->user_id,
                'status'     => 1,
            ]);
        } else {
            return redirect()->back()->with('status', 'Informations non valides');
        }

        return redirect()->back()->with('status', 'Présence confirmée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presence $presence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presence $presence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presence $presence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presence $presence)
    {
        //
    }
}
