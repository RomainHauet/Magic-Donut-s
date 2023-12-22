<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Authenticatable
{
    // Table pour les utilisateurs
    // id_U : identifiant de l'objet (clé primaire auto incrémenté)
    // nom_U : nom de l'objet
    // prenom_U : prenom de l'objet
    // email_U : email de l'objet
    // mdp_U : mot de passe de l'objet
    // admin_U : si l'utilisateur est admin ou non
    // recoit_news_U : si l'utilisateur recoit les news ou non

    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
    
    protected $table = 'utilisateurs';

    protected $primaryKey = 'id_U';

    protected $fillable = [
        'nom_U',
        'prenom_U',
        'email_U',
        'mdp_U',
        'admin_U',
        'recoit_news_U',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['mdp_U'] = $password;
    }

    public function getEmailAttribute()
    {
        return $this->attributes['email_U'];
    }
}