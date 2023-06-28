<?php

namespace App\Models;

use App\Models\User;
use App\Models\Conge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DemandeConge extends Model
{
    use HasFactory;
    protected $fillable=[
        'conge_id',
        'user_id',
        'duree',
        'debut',
        'fin',
        'status',
        'motif_rejet'
    ];

        public function conges(){
            return  $this->belongsTo(Conge::class);
        }
         
        public function user(){
            return  $this->belongsTo(User::class);
        }
}
