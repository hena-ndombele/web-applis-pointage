<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bssid extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'bssid', 'qr_code'];
}
