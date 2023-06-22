<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class AbsenceController extends Controller
{
    public function index(){
        $absences = Absence::where('status', '=', 'active')->paginate(4);
        return view('absences.index', compact('absences'));
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
        $validateData = $request->validate(
            [
                'motif'=>'required|string',
                'date_absence'=>'required|date',
                'user_id'=>'required|integer'
            ]
        );
        if($validateData){
            $user = User::where(['id'=>$request->user_id])->first();
            if($user){
                $userAbsence = Absence::where(['user_id'=>$user->id])->latest()->first();
                if($userAbsence){
                    $lastDate = Carbon::parse($userAbsence->created_at);
                    if($lastDate->isToday()){
                        return response()->json(['message'=>"Nombre d'absence journalier deja atteint", ], 200);
                    }
                }
                
                Absence::create($request->all());
                return response()->json(['message'=>"Enregistrement effectué"], 201);
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
}
