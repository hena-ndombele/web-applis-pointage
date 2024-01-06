<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Fonction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'postnom',
        'prenom',
        'date_n',
        'key',
        'numero',
        'email',
        'adresse',
        'imei',
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
        'grade_id',
        'fonction_id',
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
    public function grade(){
      return $this->BelongsTo(Grade::class);
   }
   public function fonction(){
      return $this->BelongsTo(Fonction::class);
   }

   public function document(){
      return $this->hasMany(DocumentModel::class);
   }
}
