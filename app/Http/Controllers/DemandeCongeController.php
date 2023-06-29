<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Agent;
use App\Models\Conge;
use App\Models\JoursFerie;
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
        $demandes = DemandeConge::where('user_id', Auth::id())->paginate(10);
        $conge=new Conge();
        $enAttenteCount = $this->countEnAttente();
        session(['enAttenteCount' => $enAttenteCount]);
    
        return view('conge.demandeCongeList', compact('demandes', 'conge','enAttenteCount'));
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

        // Récupère les informations du type de congé
        $conge = Conge::findOrFail($validatedData['conge_id']);

        // Vérifie que l'utilisateur est authentifié
        if (User::where(['id' => $requestIdUser])->exists()) {
            // Vérifie si l'utilisateur a déjà une demande de congé pour la journée en cours
            $demandeConge = DemandeConge::where('user_id', $requestIdUser)->where('status', 'en attente')->first();
            if ($demandeConge) {
                return response()->json(['message' => 'Patientez'], 202);
            } else {
                // Vérifie si la durée saisie correspond à la durée définie pour le type de congé
                $dureeSaisie = intval($validatedData['duree']);
                    if ($dureeSaisie !== $conge->duree) {
                        return response()->json(['message' => 'Duree inconnue'], 400);
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
                        return response()->json(['message' => 'Vous ne pouvez pas demander un congé un jour férié.'], 400);
                    }

                    // Calculer la date de fin en ajoutant la durée du congé en comptant à partir de la date de début 
                    // et en sautant les jours fériés
                    $dateFin = $dateDebut;
                    $i = 0;
                    while ($i < $conge->duree) {
                        $dateFin = $dateFin->addDay();
                        if (!in_array($dateFin->toDateString(), $joursFeries) && $dateFin->dayOfWeek != 0) {
                            $i++;
                        }
                    }

                // Enregistre la nouvelle demande de congé pour l'utilisateur
                DemandeConge::create([
                    'user_id'       => $requestIdUser,
                    'conge_id'      => $validatedData['conge_id'],
                    'duree'         => $conge->duree,
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
            'status' => 'required|in:validée,rejetée|in:validée,rejetée',
            'motif_rejet' => 'nullable|required_if:status,rejetée'
        ]);

         if ($req->status == 'validée') {
            return response()->json(['message' => "Cette demande a déjà été validée"], 400);
        } elseif ($req->status == 'rejetée') {
            // Vérifier que la demande n'est pas déjà traitéereturn response()->json(['message' => "Cette demande a déjà été rejetée"], 400);
        } else {
            DemandeConge::where(['id' => $req->id])->update([
                'status'   => $validatedData['status'],
            ]);
    
            $message = $validatedData['status'] == 'validée' ? "Demande de congé validée" : "Demande de congé rejetée";

            if ($demande->status == 'validée' || $demande->status == 'rejetée') {
                return response()->json(['message' => "Demande déjà traitée"], 400);
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




    public function approbation(){
        // try {
        //     $userId = Auth::user()->id;
        //     $approbation = DemandeConge::select('conge_id','duree','debut','fin','status')->get();
        //     $approbation = DemandeConge::find($userId);
        //     return response()->json($approbation);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()]);
        // }


        try {
            $userId = $request->user()->id;
            $demandes = DemandeConge::select('conge_id', 'duree', 'debut', 'fin', 'status')
                ->where('user_id', '=', $userId)
                ->get();
            return response()->json($demandes);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    
    
}






