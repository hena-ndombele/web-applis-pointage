<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Paie;
use App\Models\Agent;
use App\Models\Fiche;
use App\Models\Presence;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\View\Factory as ViewFactory;

class PaieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $paies = DB::table('users')
        ->join('agents', 'agents.key', '=', 'users.key')
        ->join('grades', 'grades.id', '=', 'agents.grade_id')
        ->join('directions', 'directions.id', '=', 'agents.direction_id')
        ->join('taux_configurations', function ($join) {
           $join->on('taux_configurations.grade_id', '=', 'agents.grade_id')
                ->where('taux_configurations.status', 'active');
        })
        ->select('users.name', 
                  'users.id as user_id',   
                'agents.nom as agent_name',
                'agents.direction_id as agent_direction',
                'agents.grade_id as agent_grade_id',
                'grades.name as agent_grade_name',
                'directions.name as agent_direction_name',
                'taux_configurations.montant',
                'taux_configurations.devise',
                'taux_configurations.id')
        ->paginate(10);
      
      
        return view('paie.index', ['paies'=>$paies]);
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
        $validateData = [
            'user_id'=>'required|integer',
            'taux_id'=>'required|integer',
        ];
        $currentMonth = now()->month;
        $valid=false;
        $lastEntry = Paie::latest()->where('user_id', $request->user_id)->where('status', 'ACTIVE')->first();
        if($lastEntry != null){
            $valid = true;
        }
        if($valid){
            if($currentMonth == $lastEntry->created_at->month){
                return redirect()->route('paie.index')->with('error', 'Agent déjà enrégisté pour ce mois');
            }
        }

        $presence = Presence::where('user_id', '=', $request->user_id)->count();
        if($presence == 0){
            return redirect()->route('paie.index')->with('error', 'L\'agent ne peut être ajouté dans la liste de paie car il n\'a effectué aucun jour de travail');
        }

        $totalHours = 0;
        $presences = Presence::where('user_id', $request->user_id)->get();

        foreach($presences as $present) {

            $startTime = strtotime($present->heureArrive);
            $endTime = strtotime($present->heureDepart);
    
            if($endTime < $startTime) {
                // Chevauchement sur deux jours
                $midnight = strtotime('midnight', $startTime);
                $hoursToday = ($midnight - $startTime) / 3600; 
                $hoursTomorrow = ($endTime - strtotime('midnight', $endTime)) / 3600;
                $totalHours += $hoursToday + $hoursTomorrow;
    
            } else {
                // Horaires sur une seule journée
                $hours = ($endTime - $startTime) / 3600;
                $totalHours += $hours;  
            }
        }
        Paie::create(
            [
                'user_id'=>$request->user_id,
                'taux_id'=>$request->taux_id,
                'jours_presents'=>$presence,
                'heures_travails'=>$totalHours
            ]
        );
        return redirect()->route('paie.index')->with('success', 'Ajout à la liste de paie avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show($status)
    {
        $fiches = Fiche::all();
        $paies = Paie::where('paie_status', $status)->where('status', 'ACTIVE')->get();

        foreach ($paies as $paie) {
            $agent =Agent::where('key', $paie->user->key)->first();
            $paie->agent = $agent; 
        }
        return view('paie.show', compact('paies', 'status','fiches'));
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
    public function update(Request $request, $paie)
    {
        $paieExist = Paie::findOrFail($paie);
        $test = Paie::where('id', $paie)->update([
            'paie_status'=>'PAYE'
        ]);
        return redirect()->route('paie.show', 'PAYE')->with('success', 'Confirmation pour la paie avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($paie)
    {
        $paieExist = Paie::findOrfail($paie);
        if($paieExist->paie_status == 'PAYE'){
            Paie::where('id', $paieExist->id)->update([
                'paie_status'=>"EN ATTENTE"
            ]);
        }else{
            Paie::where('id', $paieExist->id)->update([
                'status'=>"DESACTIVE"
            ]);
        }
    
        return redirect()->route('paie.index')->with('success', 'Agent rétiré de la liste avec succès');
    }
    public function generate_pdf($status){
        
        $data = Paie::where('status', 'ACTIVE')->where('paie_status', $status)->get();
        $paie = Paie::where('status', 'ACTIVE')->where('paie_status', $status)->get();

        foreach ($data as $paie) {
            $agent =Agent::where('key', $paie->user->key)->first();
            $paie->agent = $agent; 
        }

        if($data->count() == 0){
            return redirect()->route('paie.show', compact('paie', 'status'))->with('error', 'Nous ne pouvons générer le PDF car la liste est vide');
        }
        $html = view('paie.pdf', ['paies'=>$data, 'status'=>$status])->render();
        $dompdf= new Dompdf();
        $dompdf->loadHtml($html);
        $config = app(Config::class);
        $filesystem = app(Filesystem::class);
        $view = app(ViewFactory::class);
        $pdf = new PDF($dompdf,$config, $filesystem, $view);
        $paies = $paie;
        return $pdf->download(time().'.pdf');

        return view('paie.pdf', compact('paie', 'status'));
    }

    public function fiche_paie($paie_id){
        $fiches = Fiche::all();
        $data = Paie::findOrFail($paie_id);
        $paie = Paie::where('status', 'ACTIVE')->where('paie_status', $paie_id)->get();
        
        foreach ($data as $paie) {
            $agent =Agent::where('key', $paie->user->key)->first();
            $paie->agent = $agent; 
        }
       
        if($data->count() == 0){
            return redirect()->route('paie.show', compact('paie', 'status'))->with('error', 'Nous ne pouvons générer le PDF car le fichier de cet agent est indisponible');
        }
        $html = view('paie.fiche_paie', ['paies'=>$data, 'status'=>$paie_id, 'fiches'=>$fiches])->render();
        $dompdf= new Dompdf();
        $dompdf->loadHtml($html);
        $config = app(Config::class);
        $filesystem = app(Filesystem::class);
        $view = app(ViewFactory::class);
        $pdf = new PDF($dompdf,$config, $filesystem, $view);
        $paies = $paie;
        return $pdf->download(time().'.pdf');

        return view('paie.pdf', compact('paie', 'status'));
    }
}
