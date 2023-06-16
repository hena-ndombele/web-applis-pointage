<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horaire extends Model
{
    use HasFactory;
    protected $fillable = ['name','heuredebut', 'heurefin', 'heurepausedebut', 'heurepausefin', 'jours', 'contrat_id'];
    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }
}
