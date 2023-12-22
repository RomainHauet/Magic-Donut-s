<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;

    protected $table = 'achats';

    protected $primaryKey = ['id_P', 'id_C'];
    
    protected $fillable = ['id_P', 'id_C', 'qte_A'];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'qte_A' => 'integer',
    ];
}
