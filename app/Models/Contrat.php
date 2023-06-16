<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'date'];
    public function horaire()
    {
        return $this->hasOne(Horaire::class);
    }
}
