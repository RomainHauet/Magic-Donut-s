<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Commande;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->utilisateur = new Utilisateur();
    }
    public function index()
    {
        // redirige vers la page de connexion si l'utilisateur n'est pas connecté
        if( !Auth::check() ) { return redirect( '/login' ); }
        
        // trie les commandes
        $commandes = Commande::where('id_U', Auth::user()->id_U)->orderBy('date_C', 'desc')->get();
        return view('profil', ['Commandes' => $commandes]);
    }

    public function storeIdentifiant(Request $request)
    {
        $this->utilisateur = Utilisateur::find($request->input('id_U'));

        $this->utilisateur->nom_U = $request->input('nom_U');
        $this->utilisateur->prenom_U = $request->input('prenom_U');
        $this->utilisateur->email_U = $request->input('email_U');
        if($request->input('recoit_news_U') == null) { $this->utilisateur->recoit_news_U = false; }
        else                                         { $this->utilisateur->recoit_news_U = true; }

        $this->utilisateur->save();

        return redirect( '/profil' );
    }

    public function storeMdp(Request $request)
    {
        $this->utilisateur = Utilisateur::find($request->input('id_U'));

        // compre le mot de passe qui doit devenir hashé avec le mot de passe hashé
        if( !password_verify($request->input('ancien_mdp'), $this->utilisateur->mdp_U) )
        { return redirect( '/profil' )->with('error', 'L\'ancien mot de passe est incorrect');}


        if( $request->input('mdp_U') != $request->input('mdp_confirmation') )
        { return redirect( '/profil' )->with('error', 'Les mots de passe ne correspondent pas');}
        
        // Le mot de passe doit contenir au moins 12 caractères et 4 types différents : des minuscules, des majuscules, des chiffres et des caractères spéciaux.
        if( !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{12,}$/', $request->input('mdp_U')) )
        { return redirect( '/profil' )->with('error', 'Le mot de passe doit contenir au moins 12 caractères et 4 types différents : des minuscules, des majuscules, des chiffres et des caractères spéciaux.');}

        $this->utilisateur->mdp_U = password_hash($request->input('mdp_U'), PASSWORD_DEFAULT);

        $this->utilisateur->save();

        return redirect( '/profil' )->with('success', 'Le mot de passe a bien été modifié');
    }
}