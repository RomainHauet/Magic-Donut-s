<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagicDonuts extends Model
{
    use HasFactory;

    protected $table = 'magic_donuts';
    protected $primaryKey = 'id';

    public $incrementing = true;
    
    public $timestamps = false;

    protected $fillable = [
        'num_tel_Md',
        'adresse_Md',
        'desc_Md',
        'horaire_Md',
        'logo_Md',
    ];

    protected $hidden = [
        'id_Md',
    ];
}
