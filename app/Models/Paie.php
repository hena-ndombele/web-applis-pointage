<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paie extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'taux_id', 'jours_presents'];

    public function taux_configuration(){
        return $this->belongsTo(TauxConfiguration::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function presence(){
        return $this->belongsTo(Presence::class);
    }

}
