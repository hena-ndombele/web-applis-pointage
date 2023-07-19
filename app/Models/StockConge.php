<?php

namespace App\Models;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockConge extends Model
{
    use HasFactory;
    protected $fillable = ['grade_id', 'totalConge'];
    public function grade(){
        return $this->BelongsTo(Grade::class);
    }
}
