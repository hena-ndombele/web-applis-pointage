<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
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
                $userAbsence = Absence::where(['user_id'=>$user->id])->first();
                if($userAbsence){
                    $lastDate = Carbon::parse($userAbsence->created_at);
                    if($lastDate->isToday()){
                        return response()->json(['message'=>"Nombre d'absence journalier déjà atteint", ], 200);
                    }
                }
                
                Absence::create($request->all());
                return response()->json([], 201);
            }else{
                return response()->json([], 400);
            }
        }
        return response()->json([], 400);
       
    }
    
    public function show(){
        $absences = Absence::all()->where('status', '=', 'active');
        if($absences){
            return response()->json(['data'=>$absences], 200);
        }
        return response()->json([], 400);
    }

    public function cancel(String $id){
        $absence = Absence::find($id);
        $absenceId = $absence;
        if(($absenceId)){
            $test = Absence::where(['id'=>$absenceId->id])->update(['status'=>'offline']);
            if($test){
                return response()->json([], 201);
            }
            return response()->json([], 400);
        }
        return response()->json([], 400);
    }
}
