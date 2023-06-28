<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','direction_id','departement_id'
    ];
    public function departements()
    {
       return $this->belongsTo(Departement::class,'departement_id','id');
    }
    public function directions()
    {
       return $this->belongsTo(Direction::class,'direction_id','id');
    }
}
