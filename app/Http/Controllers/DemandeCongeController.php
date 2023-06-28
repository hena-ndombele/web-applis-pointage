<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Agent;
use App\Models\Conge;
use App\Models\JoursFerie;
use App\Models\StockConge;
use App\Models\DemandeConge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeCongeController extends Controller
{


    public function countEnAttente() {
        return DemandeConge::where('status', 'en attente')->count();
    }


    public function index(){ 

        if (Auth::user()->hasRole('admin')) {
            $demandes = DemandeConge::paginate(10);
            $conge=new Conge();
            $enAttenteCount = $this->countEnAttente();
            session(['enAttenteCount' => $enAttenteCount]);
            return view('conge.demandeCongeList', compact('demandes', 'conge','enAttenteCount'));
        }
        else{
            $demandes = DemandeConge::where('user_id', Auth::id())->paginate(10);
            $conge=new Conge();
            $enAttenteCount = $this->countEnAttente();
            session(['enAttenteCount' => $enAttenteCount]);
            return view('conge.demandeCongeList', compact('demandes', 'conge','enAttenteCount'));
        }    
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
        $userAgent=Agent::where(['token'=> Auth::user()->token])->first();
        $userGrade =  $userAgent->grade; 
        $dateEmbauchement =  $userAgent->date_e;
       
        
        // Récupère les informations du type de congé
        $conge = Conge::findOrFail($validatedData['conge_id']);
        $typeConge = $conge->type_conge;
        $dateActuelle = Carbon::now();
        $dateEmbauche = Carbon::parse($dateEmbauchement);
        $anciennete= $dateActuelle->diffInMonths($dateEmbauche);
      
        // Vérifie que l'utilisateur est authentifié
        if (User::where(['id' => $requestIdUser])->exists()) {
            // Vérifie si l'utilisateur a déjà une demande de congé pour la journée en cours
            $demandeConge = DemandeConge::where('user_id', $requestIdUser)->where('status', 'en attente')->first();
            if ($demandeConge) {
                return response()->json(['message' => 'Patientez'], 202);
            } else {
                // Vérifie si la durée saisie correspond à la durée définie pour le type de congé
                $dureeSaisie = intval($validatedData['duree']);
                    
                if ($typeConge !== 'Congé annuel') {
                    if ($dureeSaisie !== $conge->duree) {
                        return response()->json(['message' => 'Duree inconnue'], 400);
                    }
                }

                    $dateDebut = Carbon::parse($validatedData['debut']);
                    $dateActuelle = Carbon::now();
                        if ($dateDebut->isBefore($dateActuelle)) {
                            return response()->json(['message' => 'date anterieure'], 400);
                        }

                       // Prendre en compte les jours fériés
                    $joursFeries = JoursFerie::all();
                    $joursFeries = $joursFeries->pluck('date')->toArray();

                    if (in_array($dateDebut->toDateString(), $joursFeries)) {
                        return response()->json(['message' => 'jourFerie'], 400);
                    }

                    if ($typeConge === 'Congé annuel') {
                        if ($anciennete < 6) {
                            $totalLeaveDays = StockConge::where('grade', $userGrade)->first()->totalConge / 12;
                                if ($dureeSaisie > $totalLeaveDays) {
                                    return response()->json(['message' => "pas droit"], 403);
                                }
                        } 
                        
                        $stockConge = StockConge::where('grade', $userGrade)->first();
                        $totalLeaveDays = $stockConge->totalConge;
                        $usedLeaveDays =  $userAgent->conge_utilises;
                        $congeRestant = $totalLeaveDays - $usedLeaveDays;
            
                        if ($dureeSaisie > $congeRestant) {
                            return response()->json([
                                'difference'=>$congeRestant,
                                'message' => "insuffisant"], 403); 
                        } 
                    } 
                    

                    if ($typeConge === 'Congé annuel') {
                        $dureeADemander = $dureeSaisie; 
                    } else {
                        $dureeADemander = $conge->duree;
                    }

                    // Calculer la date de fin en ajoutant la durée du congé en comptant à partir de la date de début 
                    // et en sautant les jours fériés
                    $dateFin = $dateDebut;
                    $i = 0;
                    while ($i < $dureeADemander) {
                        $dateFin = $dateFin->addDay();
                        if (!in_array($dateFin->toDateString(), $joursFeries) && $dateFin->dayOfWeek != 0) {
                            $i++;
                        }
                    }

                // Enregistre la nouvelle demande de congé pour l'utilisateur
                DemandeConge::create([
                    'user_id'       => $requestIdUser,
                    'conge_id'      => $validatedData['conge_id'],
                    'duree'         => $dureeADemander,
                    'debut'         => $validatedData['debut'],
                    'fin'           => $dateFin->format('Y-m-d H:i:s'),
                    'status'        => 'en attente',
                    'created_at'    => date('Y-m-d H:i:s'),
                ]);
            
                $demande = DemandeConge::latest()->first();
                return response()->json([
                    'id' => $demande->id, 
                    'message' => 'Envoye' 
                ], 200);
            };
        } else {
            return response()->json(['message' => 'Utilisateur non autorisé'], 403);
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


public function update(Request $request, DemandeConge $demande, Agent $agent) {
    try {
        // Vérifier que la demande de congé existe
        $req = DemandeConge::findOrFail($demande->id);
        $conge = Conge::findOrFail($req->conge_id);
        $user=User::join('agents', 'users.token', '=', 'agents.token')
            ->where('users.id', $req->user_id)
            ->select('users.*', 'agents.conge_utilises')
            ->firstOrFail();
        

        // Valider les données de la requête
        $validatedData = $request->validate([
            'status' => 'required|in:validée,rejetée',
            'motif_rejet' => 'nullable|required_if:status,rejetée'
        ]);

        if ($req->status == 'validée') {
            return response()->json(['message' => "Cette demande a déjà été validée"], 400);
        } elseif ($req->status == 'rejetée') {
            return response()->json(['message' => "Cette demande a déjà été rejetée"], 400);
        } else {
            DemandeConge::where(['id' => $req->id])->update([
                'status' => $validatedData['status'],
                'motif_rejet' => $validatedData['motif_rejet']
            ]);

            $message = $validatedData['status'] == 'validée' ? "Demande de congé validée" :  "Demande de congé rejetée"; 
            $agent = Agent::where('token', $user->token)->firstOrFail();
            $conge_utilises=$agent->conge_utilises;
            $conge_utilises+=$req->duree;
            
           
            if ($validatedData['status'] == 'validée' && $conge->type_conge == 'Congé annuel') {
   
                $agent->update(['conge_utilises' => $conge_utilises]);  
            }       
            return response()->json([
                'message' => $message, 
                'motif_rejet' => $validatedData['motif_rejet']  
            ], 200);
        } 
    } catch (\Exception $e) {
        return response()->json(['message' => "erreur"], 500);
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


