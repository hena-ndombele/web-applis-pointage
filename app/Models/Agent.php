<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'postnom',
        'prenom',
        'date_n',
        'token',
        'numero',
        'email',
        'adresse',
        'direction_id',
        'departement_id',
        'service_id',
        'matricule',
        'superviseur',
        'date_e',
        'etat_civil',
        'nombre_e',
        'niveau_etude',
        'image',
        'sexe',
        'grade',
        'fonction',
        'conge_utilises'
    ];
    public function departement()
    {
       return $this->belongsTo(Departement::class);
    }
    public function direction()
    {
       return $this->belongsTo(Direction::class);
    }
    public function service()
    {
       return $this->belongsTo(Service::class);
    }
}
