<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Bssid;
use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presences = Presence::orderBy('id', 'desc')->paginate(10);
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
        $validatedData = $request->validate([
            'bssid' => 'required|string',
            'user_id' => 'required|integer',
        ]);

        if ((Bssid::where('bssid', $validatedData['bssid'])->exists()) && (User::where(['id' => $validatedData['user_id']])->exists())) {
            $presenceDay = Presence::whereDate('created_at', Carbon::today())->exists();
            $presenceTime1 = '08:00:00'; //En attendants les infos de l'horaire stockées dans la bd
            $presenceTime2 = '16:00:00'; //En attendants les infos de l'horaire stockées dans la bd
            if (($presenceDay) && ($presenceTime2 <= $presenceTime1)) {
                return response()->json(['message' => 'Présence deja enregistré'], 202);
            } else {
                Presence::create([
                    'user_id'       => $validatedData['user_id'],
                    'status'        => 1,
                    'heureArrive'   => date('H:i:s'),
                    'heureDepart'   => date('H:i:s'),
                    'created_at'    => date('Y-m-d H:i:s'),
                ]);
                return response()->json(['message' => 'Présence enregistré'], 200);
            };
        } else {
            return response()->json(['message' => 'Réseau non autorisé'], 403);
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
