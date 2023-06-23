<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'type', 'duree','unite_duree', 'fonction_id', 'horaire_id','direction_id'];
    public function horaire()
    {
        return $this->belongsTo(Horaire::class);
    }
    public function fonction()
    {
        return $this->belongsTo(Fonction::class);
    }
    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }
}
