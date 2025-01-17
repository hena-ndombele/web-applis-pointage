<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\AuthManager;



class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "email" => "required|email",
                "password" => "required",
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Erreur de validation",
                    "errors" => $validator->errors(),
                ], 422);
            }
    
            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    "status" => false,
                    "message" => "email ou mot de passe incorrect",
                ], 421);
            }
    
            $user = User::where('email', $request->input('email'))->first();
    
            return response()->json([
                "status" => 200,
                "data" => [
                    "user" => $user,
                    "token" => $user->createToken('auth_user')->plainTextToken,
                    "token_type" => "Bearer",
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
            ], 500);
        }
    }


    public function register(Request $request){
 try {
            //code...
            $input=$request->all();
            $validator=Validator::make($input,[
                "name"=>"required",
                "email"=>"required|email|unique:users,email",
                "password"=>"required",
               
            ]);
            if($validator->fails()){
                return response()->json(
                    [
                        "status" => false,
                        "message" => "Erreur de validation",
                        "errors"=>$validator->errors(),
                    ],422
                );
            }

            $input['password']=Hash::make($request->password);
            $user=User::create($input);
            return response()->json(
                [
                    "status"=>true,
                    "message"=> "Utilisateur créer avec succes",
                    "data"=>[
                        "token"=>$user->createToken('auth_user')->plainTextToken,
                        "token_type"=>"Bearer",
                    ]
                    ]
                );

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(
                [
                    "status" => false,
                    "message" =>$th->getMessage(),
                ],500,
            );
        }
        
    }



    public function profile(Request $request){
      $user=Auth::user();
       return response()->json(['utilisateur'=>$user],200);


    }


    public function updatePassword(Request $request){
        try {
            $input = $request->all();
            $validator = Validator::make($input, [
                "old_password" => "required",
                "new_password" => "required|confirmed"
            ]);
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "les mots de passe ne correspondent pas",
                    "errors" => $validator->errors(),
                ], 422);
            }
    
            // Comparer le mot de passe que l'utilisateur a entré avec ce qui se trouve dans la BDD
            if (!Hash::check($input['old_password'], $request->user()->password)) {
                return response()->json([
                    "status" => false,
                    "message" => "L'ancien mot de passe est incorrect",
                ], 401);
            }
    
            $input['password'] = Hash::make($input['new_password']);
            $request->user()->update($input);
    
            return response()->json([
                "status" => true,
                "message" => "Le mot de passe a été modifié avec success",
                "data" => $request->user(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
            ], 500);
        }
    }



    public function recu(Request $request){

        //recuperer les donnees
        try{

            return response()->json([
                'status_code' =>200,
                'status_message'=>'utilisateur recuperer avec success',
                'data' => User::all()
            ]); 
            

        }catch(Exception $e){
            return response()->json($e);

             
        }
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => "Deconnexion avec success"
        ], 200);
    }



    
}
