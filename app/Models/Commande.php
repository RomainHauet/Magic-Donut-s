<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'commandes';

    protected $primaryKey = 'id_C';

    protected $fillable = [
        'id_U',
        'cout_C',
        'etat_C',
        'date_C',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'cout_C' => 'float',
        'etat_C' => 'string',
        'date_C' => 'date',
    ];

    // Ici doivent être inséré les commandes pour récupérer les classes liées à celle-ci
    
}
