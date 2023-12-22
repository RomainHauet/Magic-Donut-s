<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'produits';

    protected $primaryKey = 'id_P';

    protected $fillable = [
        'lib_P',
        'gout_P',
        'etat_P',
        'taille_P',
        'prix_P',
        'image_P',
        'stock_P',
    ];

    protected $hidden = [
        'remember_token',
        'visible_P',
    ];

    protected $casts = [
        'stock_P' => 'boolean',
    ];

    // Ici doivent être inséré les commandes pour récupérer les classes liées à celle-ci
}
