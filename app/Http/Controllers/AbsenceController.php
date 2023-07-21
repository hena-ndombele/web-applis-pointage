<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Agent;
use App\Models\Absence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\String_;

class AbsenceController extends Controller
{
    public function index(){
        $absences = Absence::where('status', '=', 'active')->paginate(4);

        foreach ($absences as $absence) {
            $agent =Agent::where('key', $absence->user->key)->first();
            $absence->agent = $agent; 
        }


        return view('absences.index', compact('absences'));
    }

    public function getAbsenceByDate(){
        try {
            $requestIdUser = Auth::user()->id;
            $absent = Absence::select('date_absence')
                                ->where('user_id', $requestIdUser)
                                ->whereYear('date_absence', date('Y'))
                                ->get();
            $formattedDates = $absent->map(function($item){
                return ['date_absence' => date_format(new DateTime($item->date_absence), 'Y-m-d')];
            });
            return response()->json($formattedDates);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * @OA\Post(
     *     path="/absences",
     *     summary="Create a new absence message",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="motif", type="string"),
     *             @OA\Property(property="date_absence", type="date"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function store(Request $request){
        $requestIdUser = Auth::user()->id;
        $validateData = $request->validate(
            [
                'motif'=>'required|string',
                'date_absence'=>'required|date',
            ]
        );
        if($validateData){
            $user = User::where(['id' => $requestIdUser])->first();
            if($user){
                $userAbsence = Absence::where('user_id', $requestIdUser)->latest()->first();
                if($userAbsence){
                    $lastDate = Carbon::parse($userAbsence->created_at);
                    if($lastDate->isToday()){
                        return response()->json(['message'=>"atteint", ], 200);
                    }
                }
                
                Absence::create([
                    'user_id'=> $requestIdUser,
                    'motif'=> $validateData['motif'],
                    'date_absence'=> $validateData['date_absence'],
                ]);
                return response()->json(['message'=>"effectué"], 201);
            }else{
                return response()->json(['Echec'=>"User not found", ], 400);
            }
        }
        return response()->json([], 400);
       
    }
    
    public function show(){
        $absences = Absence::where('status', '=', 'active')->get();
    
        if($absences){
            return response()->json($absences);
        }
        return response()->json([], 400);
    }
    public function findForUser(String $user_id){
        $absences = Absence::where('status','active')->where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        if($absences){
            return response()->json($absences);
        }
        return response()->json([], 400);
    }
    /**
     * @OA\Post(
     *     path="/absences/cancel",
     *     summary="Cancel an existing absence message before the required date",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function cancel(Request $request){
        $validateData = $request->validate(
            [
                'id'=>'required|integer',
            ]
        );
        $absence = Absence::find($validateData['id']);
        $absenceId = $absence;
        if(($absenceId)){
            $test = Absence::where(['id'=>$absenceId->id])->update(['status'=>'offline']);
            if($test){
                return response()->json(["message"=>"Absence annulée"], 201);
            }
            return response()->json([], 400);
        }
        return response()->json([], 400);
    }



    public function absence(){
        $userId = Auth::id();
        $absences = Absence::where('user_id', $userId)->get(); // Récupère les absences de l'utilisateur connecté
        return response()->json($absences);
    }

}
