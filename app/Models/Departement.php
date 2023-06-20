<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $fillable=['name','direction_id'];

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    public function services(){
      return  $this->hasMany(Service::class);
    }
    public function agents(){
      return  $this->hasMany(Agent::class);
    }
}
