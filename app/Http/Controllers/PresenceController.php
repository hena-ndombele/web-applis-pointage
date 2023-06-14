<?php

namespace App\Http\Controllers;

use DateTime;
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
    public function index(Request $request)
    {
        $month = $request->input('month');
        $date = strtotime($month); // Convertir la chaîne de caractères en objet de date PHP
        $monthNum = date('m', $date); // Extraire le numéro du mois (ex: "06")
        $year = date('Y', $date); // Extraire l'année (ex: "2023")



        // Déterminer le nombre de jours dans le mois
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthNum, $year);

        // Générer une grille de dates pour chaque jour du mois
        $dates = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            // Créer un objet de date correspondant à la date actuelle
            $dateObj = DateTime::createFromFormat('Y-m-d', "$year-$monthNum-$day");

            // Ajouter la date à la grille de dates
            $dates[] = [
                'day' => $day,
                'date' => $dateObj->format('Y-m-d'),
                'weekday' => $dateObj->format('D')
            ];
        }


        // Passer les données du calendrier à la vue Blade correspondante

        return view('presences.index', compact(
            'month',
            'year',
            'monthNum',
            'dates',
            'date'
        ));
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
    public function show($date, Request $request, Presence $presence)
    {
    
         // L'heure renvoyé par l'url
         $dateUrl = $request->input('date');


         // On convertis la date en format DateTime()
         $dateConvertis = Carbon::createFromFormat('Y-m-d', $date);
 
         // Récupérer les informations de présence en fonction de la date sélectionnée
         $presences =  Presence::whereDate('created_at', $date)->paginate(10); //Avec whereDate on reccupere la date uniquement pas l'heure
 
 
 
         // Définir la plage de dates du mois sélectionné
         $month_start = Carbon::parse($date)->startOfMonth();
         $month_end = Carbon::parse($date)->endOfMonth();
 
         // Compter le nombre total des présences pour le mois sélectionné
         $count = Presence::where('user_id', $presence->user_id)
             ->whereBetween('created_at', [$month_start, $month_end])
             ->count();
 
 
         // Récupérer le mois à partir de la date
          $toDay = Carbon::parse($date)->format('d-M-Y');
 
         // Afficher la vue avec les informations de présence
         return view('presences.show', compact('presences', 'dateUrl', 'count', 'date', 'toDay'));
   
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
