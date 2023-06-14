<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class TauxConfiguration extends Model
{
    use HasFactory;
    protected $fillable = ['role_id', 'montant', 'devise'];
    public function role(){
        return $this->BelongsTo(Role::class);
    }
}
