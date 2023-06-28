<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoursFerie extends Model

{
    use HasFactory;
    protected $fillable=['titre','date','details','type'];
}
