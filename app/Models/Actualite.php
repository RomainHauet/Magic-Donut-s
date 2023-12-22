<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

    protected $table = 'actualites';
    protected $primaryKey = 'id_Actu';

    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
        'titre_Actu',
        'contenu_Actu',
        'image_Actu',
    ];
}
