<?php

namespace App\Models;

use App\Models\DemandeConge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conge extends Model
{
    use HasFactory;
        protected $fillable=['type_conge','duree'];

        public function demandeConges(){
            return $this->hasMany(DemandeConge::class);
    }
}
