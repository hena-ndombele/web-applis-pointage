<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Conge;
use App\Models\DemandeConge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeCongeController extends Controller
{

    public function index(){
        $demandes = DemandeConge::where('user_id', Auth::id())->get();
        $conge=new Conge();
    
        return view('conge.demandeCongeList', compact('demandes', 'conge'));
    }

     public function store(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'conge_id' => 'required',
                'duree' => 'required|integer',
                'debut' => 'required|date',
            ]);


            $requestIdUser = Auth::user()->id;
        
            // Vérifie que le type de congé demandé existe et que l'utilisateur est authentifié
            if ((Conge::where('id', $validatedData['conge_id'])->exists()) && (User::where(['id' => $requestIdUser])->exists())) {
                // Vérifie si l'utilisateur a déjà une demande de congé pour la journée en cours
                $demandeConge = DemandeConge::where('user_id', $requestIdUser)->where('status', 'en attente')->first();
                    if ($demandeConge) {
                        return response()->json(['message' => 'Une autre demande est en cours de traitement. Veuillez patienter.'], 202);
                    } else {
                        // Crée une nouvelle demande de congé pour l'utilisateur
                        DemandeConge::create([
                            'user_id'       => $requestIdUser,
                            'conge_id'      => $validatedData['conge_id'],
                            'duree'         => $validatedData['duree'],
                            'debut'         => $validatedData['debut'],
                            'status'        => 'en attente',
                            'created_at'    => date('Y-m-d H:i:s'),
                        ]);
                        $demande = DemandeConge::latest()->first();
                        return response()->json([
                            'id' => $demande->id, 
                            'message' => 'Demande de congé envoyé.' ], 200);
                    };
            } else {
                return response()->json(['message' => 'Type de congé invalide ou utilisateur non autorisé'], 403);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        
    }


    public function update(Request $request, DemandeConge $demande) {
        try {
            // Vérifier que la demande de congé existe
            $req = DemandeConge::findOrFail($demande->id);
    
            // Valider les données de la requête
            $validatedData = $request->validate([
                'status' => 'required',
            ]);
    
           
            DemandeConge::where(['id' => $req->id])->update([
                'status'   => $request->status,
            ]);
            // $demande->status::update($validatedData
            // $demande->save();
    
            // Déterminer le message à renvoyer en fonction de l'état de la demande de congé mise à jour
            $message = '';
            if ( $status == 'validée') {
                $message = 'Demande de congé validée';
            } else {
                $message = 'Demande de congé rejetée';
            }
    
            return response()->json(['message' => $message], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => "Erreur"], 500);
        }
    }


    public function destroy(Request $request, $demande) {
        try {
            $demande = DemandeConge::findOrFail($demande);
            $demande->delete();
    
            return response()->json(['message' => 'Demande de congé supprimée'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

  
    
    
}


