<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agent;
use App\Models\Grade;
use App\Models\Service;
use App\Models\Fonction;
use App\Models\Direction;
use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;


class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agentsCount=Agent::count();
        $directions=Direction::all();
        $departements=Departement::all();
        $services=Service::all();
        $agents = Agent::paginate(12);
        return view('agents.index',compact('directions', 'departements', 'services','agents'));
    }

    /**
     * Show the form for creating a new resource.
     */



     public function getUsers()
{
    $users = User::all();
    return view('document/create', compact('users'));
}
    public function create()
    {
        $directions=Direction::all();
        $departements=Departement::all();
        $services=Service::all();
        $agents=Agent::all();
        $grades=Grade::all();
        $fonctions=Fonction::all();
        return view('agents.create',compact('directions', 'departements', 'services','agents','grades','fonctions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgentRequest $request)
    {
       
        DB::transaction(function () use ($request) {
            $validatedData = $request->validate([
                
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
                "grade_id"=>'required|integer',
                'fonction_id'=>'required',
                'sexe'=>'required',
                'conges_utilises'=>'string',
               
               

            ]);
        
            // $agent = Agent::create(
            //     $request->all(),
            //     ['key' => Str::random(12)]
            // );

           
        
            // if ($agent) {
               
            //     $password = $agent->date_e . $agent->matricule;
                
            //     $passwordSend  = '2023-06-1012345';
            //     User::create([
            //         'key' => $keyFourni,
            //         'name' => $agent->prenom,
            //         'email' => $agent->email,
            //         'password' => Hash::make($password)
            //     ]);
            // }
            $agent = new Agent();
            $agent->fill($request->all());
            $agent->key = Str::random(12);

            if ($agent) {
                $password = $agent->date_e . $agent->matricule;
                $passwordSend  = '2024-06-1012345';
                $user = User::create([
                    'name' => $agent->prenom,
                    'email' => $agent->email,
                    'password' => Hash::make($passwordSend)
                ]);
                $user->key = $agent->key; // Lier le key du nouvel utilisateur à celui de l'agent
                $user->save(); // Enregistrer les changements dans la base de données
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
    public function destroy($id){
        $agent = Agent::find($id);
        $agent->delete();
        return redirect()->route('agents.index')->with('success', 'suppression de l\'employé  avec success');
    }
    public function byDirection(StoreAgentRequest $request, $directionId)
    {
        $departements = Departement::where('direction_id', $directionId)->get();

        return response()->json($departements);
    }




    
    public function informationAgent(){

        $agents = Agent::join('directions', 'agents.direction_id', '=', 'directions.id')
                        ->join('departements', 'agents.departement_id', '=', 'departements.id')
                        ->join('services', 'agents.service_id', '=', 'services.id')
                        ->join('grades', 'agents.grade_id', '=', 'grades.id')
                        ->where(['agents.key' =>  Auth::user()->key])
                        ->select('agents.*', 'directions.name as direction', 'departements.name as departement', 'services.name as service', 'grades.name as grade')
                        ->first();
    
        return response()->json($agents);
    }



    

  
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!password_verify($request->old_password, $user->password)) {
            return response()->json(['message' => 'Le mot de passe actuel est incorrect.'], 401);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return response()->json(['message' => 'Mot de passe modifié avec succès.'], 200);
    }
    


    



      



    

   



    
    


    




    
    



      



    

   



    
    


    
}
