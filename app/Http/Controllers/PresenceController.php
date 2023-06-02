<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Bssid;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

use function PHPUnit\Framework\isEmpty;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presences = Presence::orderBy('id', 'desc')->paginate(10);

        $presenceJournaliere = Presence::orderBy('id', 'desc')->whereDate('created_at', Carbon::today())->paginate(10);
        $presenceHebdo = Presence::orderBy('id', 'desc')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(10);
        $presenceMensuel = Presence::orderBy('id', 'desc')->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->paginate(10);
        $presenceAnnuel = Presence::orderBy('id', 'desc')->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->paginate(10);
    
        $jour = Carbon::now()->day;
        $mois = Carbon::now()->month;
        $annee = Carbon::now()->year;
        $debutSemaine = Carbon::now()->startOfWeek();
        $finSemaine = Carbon::now()->endOfWeek();
        $semaineDeAnnee =  Carbon::now()->week();
            
        return view('presences.index', compact('presences', 'semaineDeAnnee', 'presenceJournaliere', 'presenceHebdo', 'presenceMensuel', 'presenceAnnuel' ,'jour', 'mois', 'annee', 'debutSemaine', 'finSemaine'));
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

    // Presence arrivée
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'bssid' => 'required|string',
            ]);
            $requestIdUser = Auth::user()->id;

            if ((Bssid::where('bssid', $validatedData['bssid'])->exists()) && (User::where(['id' => $requestIdUser])->exists())) {
                $presenceDay = Presence::where('user_id', $requestIdUser)->whereDate('created_at', Carbon::today())->first();

                if (($presenceDay)) {
                    return response()->json(['message' => 'Presence deja enregistre'], 202);
                } else {
                    Presence::create([
                        'user_id'       => $requestIdUser,
                        'status'        => 1,
                        'heureArrive'   => date('Y-m-d H:i:s'),
                        'created_at'    => date('Y-m-d H:i:s'),
                    ]);
                    return response()->json(['message' => 'Presence enregistre'], 200);
                };
            } else {
                return response()->json(['message' => 'Reseau non autorise'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
       
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    
        $user = User::where(["id" => $id])->first();
        $presences = Presence::orderBy('id', 'desc')->where(["user_id" => $id])->paginate(10);

        #Variables des dates
        $presenceJournaliere = Presence::orderBy('id', 'desc')->where(["user_id" => $id])->whereDate('created_at', Carbon::today())->paginate(10);
        $presenceHebdo = Presence::orderBy('id', 'desc')->where(["user_id" => $id])->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->paginate(10);
        $presenceMensuel = Presence::orderBy('id', 'desc')->where(["user_id" => $id])->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->paginate(10);
        $presenceAnnuel = Presence::orderBy('id', 'desc')->where(["user_id" => $id])->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->paginate(10);
    
        $jour = Carbon::now()->day;
        $mois = Carbon::now()->month;
        $annee = Carbon::now()->year;
        $debutSemaine = Carbon::now()->startOfWeek();
        $finSemaine = Carbon::now()->endOfWeek();
        $semaineDeAnnee =  Carbon::now()->week();

   
        return view('presences.show', compact('user','presences', 'semaineDeAnnee', 'presenceJournaliere', 'presenceHebdo', 'presenceMensuel', 'presenceAnnuel' ,'jour', 'mois', 'annee', 'debutSemaine', 'finSemaine'));
   
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
    //Presence depart  
    public function update(Request $request, Presence $presence)
    {
            try {
            $validatedData = $request->validate([
                'bssid'     => 'required|string',
                'id'        => 'required|integer', 
            ]);
            $requestIdUser = Auth::user()->id;
            // $requestIdUser = $validatedData['user_id'];


            if ((Bssid::where('bssid', $validatedData['bssid'])->exists()) && (User::where(['id' => $requestIdUser])->exists())) {
                $presenceDay = Presence::where('id', $validatedData['id'])->whereDate('heureDepart', Carbon::today())->first();
                if (($presenceDay)) {
                    return response()->json(['message' => 'Depart deja enregistre'], 202);
                } else {
                    Presence::where(['id' => $validatedData['id']])->update([
                        'heureDepart'   => date('Y-m-d H:i:s'),
                        'updated_at'    => date('Y-m-d H:i:s'),
                    ]);
                    return response()->json(['message' => 'Depart enregistre'], 200);
                };
            } else {
                return response()->json(['message' => 'Reseau non autorise'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presence $presence)
    {
        //
    }
}
