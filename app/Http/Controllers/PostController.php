<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\DemandeConge;

class PostController extends Controller
{

               

    static function index($id)
    {
        $demande = DemandeConge::findOrFail($id);
        if($demande->id!=""){
            try{
                
                
                $client = new Client();
                $reponse = $client->post('http://localhost:5000/reception', [
                    'form_params' => [
                        'id'=>$demande->id,
                        'user_id' => $demande->user_id,
                        'debut' => $demande->debut,
                        'fin' =>$demande->Fin,
                        'status'=>$demande->status,
                    ]
                ]);
        
                $reponse->getBody();
                
          
            }
            catch(\Exception $e){
            }
        }
       
       
      
       
    }
}