<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vetement extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'prix_lavage',
        'prix_repassage',
        'prix_retouche'        
    ];
}
