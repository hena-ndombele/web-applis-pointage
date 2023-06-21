<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;

class PostController extends Controller
{
    public function envoyerDonneesAuServeur()
    {
        
        $client = new Client();
        $reponse = $client->post('http://localhost:5000/reception', [
            'form_params' => [
                'nom' => 'John Doe',
                'email' => 'john.doe@example.com',
                'message' => 'Bonjour, comment allez-vous ?',
            ]
        ]);

        dd($reponse->getBody());
    }
}