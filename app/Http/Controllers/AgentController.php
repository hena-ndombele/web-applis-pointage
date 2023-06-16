<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;
use App\Models\Departement;
use App\Models\Direction;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directions=Direction::all();
        $departements=Departement::all();
        $services=Service::all();
        $agents = Agent::paginate(12);
        return view('agents.index',compact('directions', 'departements', 'services','agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $directions=Direction::all();
        $departements=Departement::all();
        $services=Service::all();
        $agents=Agent::all();
        return view('agents.create',compact('directions', 'departements', 'services','agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgentRequest $request)
    {
       
        DB::transaction(function () use ($request) {
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255',
                'postnom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'date_n' => 'required|date',
                'numero' => 'required|string|max:255',
                'email' => 'nullable|string|email|max:255',
                'adresse' => 'required|string|max:255',
                'direction_id' => 'required|exists:directions,id',
                'departement_id' => 'required|exists:departements,id',
                'service_id' => 'required|exists:services,id',
                'matricule' => 'nullable|string|max:255',
                'superviseur' => 'required|string|max:255',
                'date_e' => 'required|date',
                'etat_civil' => 'required|string|max:255',
                'nombre_e' => 'required|integer',
                'niveau_etude' => 'required|string|max:255',
                'image' => 'required',
                'grade'=>'required',
                'fonction'=>'required',
                'sexe'=>'required',

            ]);
        
            $agent = Agent::create($validatedData);
        
            if ($agent) {
                $email = substr($agent->nom, 0, 2) . substr($agent->postnom, -2) . $agent->prenom . '@timekeeper.com';
                $password = Hash::make($agent->date_e . $agent->matricule);
                User::create([
                    'name' => $agent->prenom,
                    'email' => $email,
                    'password' => $password
                ]);
            }
        
            if ($request->hasFile('image') && $agent) {
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '.' . $ext;
                $file->move('assets/uploads/agents/', $filename);
                $agent->image = $filename;
                $agent->save();
            }
        });
        return redirect()->route('agents.index')->with('success', 'L\'agent a été enregisté avec succes.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $agents = Agent::findOrFail($id);
        //dd($agents->nom);
        $directions=Direction::all();
        $departements=Departement::all();
        $services=Service::all();
       
        return view('agents.show',compact('directions', 'departements', 'services','agents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $directions=Direction::all();
        $departements=Departement::all();
        $services=Service::all();
        $agents = Agent::findOrFail($id);
        
        return view('agents.edit',compact('directions', 'departements', 'services','agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgentRequest $request, Agent $agent)
    {
        
             
            $validatedData = $request->validate([
                'nom' => 'required|string|max:255',
                'postnom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'date_n' => 'required|date',
                'numero' => 'required|string|max:255',
                'email' => 'nullable|string|email|max:255',
                'adresse' => 'required|string|max:255',
                'direction_id' => 'required|exists:directions,id',
                'departement_id' => 'required|exists:departements,id',
                'service_id' => 'required|exists:services,id',
                'matricule' => 'nullable|string|max:255',
                'superviseur' => 'required|string|max:255',
                'date_e' => 'required|date',
                'etat_civil' => 'required|string|max:255',
                'nombre_e' => 'required|integer',
                'niveau_etude' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $agent->update($validatedData);
    
            
    
          
        
    
        return redirect()->route('agents.index')->with('success', 'L\'agent a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        //
    }
    public function byDirection(StoreAgentRequest $request, $directionId)
    {
        $departements = Departement::where('direction_id', $directionId)->get();

        return response()->json($departements);
    }
}
