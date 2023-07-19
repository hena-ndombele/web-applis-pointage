<?php

namespace App\Models;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TauxConfiguration extends Model
{
    use HasFactory;
    protected $fillable = ['grade_id', 'montant', 'devise'];
    public function grade(){
        return $this->BelongsTo(Grade::class);
    }
    public function paies(){
        return $this->hasMany(Paie::class);
    }
}
