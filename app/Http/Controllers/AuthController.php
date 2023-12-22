<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Utilisateur;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        // Récupération des données du formulaire
        $credentials = $request->only('email_U', 'mdp_U');

        $utilisateur = Utilisateur::where('email_U', $credentials['email_U'])->first();

        if (!$utilisateur || !password_verify($credentials['mdp_U'], $utilisateur->mdp_U))
        {
            // je récupère l'adresse email inséré dans le formulaire
            $email = $credentials['email_U'];

            // je redirige vers la page de login avec un message d'erreur et l'adresse email inséré dans le formulaire
            return redirect()->route('auth.login')->with('error', 'Adresse email ou mot de passe incorrect.')->with('email', $email);
        }

        Auth::login($utilisateur);

        return redirect()->intended('/');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        // Récupération des données du formulaire
        $data = $request->only('prenom_U', 'nom_U', 'email_U', 'mdp_U', 'mdpConfirm');

        // Le mot de passe doit contenir au moins 12 caractères et 4 types différents : des minuscules, des majuscules, des chiffres et des caractères spéciaux.
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{12,}$/', $data['mdp_U']))
        {
            // je redirige vers la page de login avec un message d'erreur et l'adresse email, le prénom et le nom insérés dans le formulaire
            return redirect()->route('auth.register')->with('error', 'Le mot de passe doit contenir au moins 12 caractères et 4 types différents : des minuscules, des majuscules, des chiffres et des caractères spéciaux.')->with('prenom_U', $data['prenom_U'])->with('nom_U', $data['nom_U'])->with('email_U', $data['email_U']);
        }

        // Vérification de la confirmation du mot de passe
        if ($data['mdp_U'] != $data['mdpConfirm'])
        {
            // je redirige vers la page de login avec un message d'erreur et l'adresse email, le prénom et le nom insérés dans le formulaire
            return redirect()->route('auth.register')->with('error', 'Les mots de passe ne correspondent pas.')->with('prenom_U', $data['prenom_U'])->with('nom_U', $data['nom_U'])->with('email_U', $data['email_U']);
        }

        // Vérification de l'unicité de l'adresse email
        $utilisateur = Utilisateur::where('email_U', $data['email_U'])->first();

        if ($utilisateur)
        {
            // je redirige vers la page de login avec un message d'erreur et l'adresse email, le prénom et le nom insérés dans le formulaire
            return redirect()->route('auth.register')->with('error', 'Cette adresse email est déjà utilisée.')->with('prenom_U', $data['prenom_U'])->with('nom_U', $data['nom_U'])->with('email_U', $data['email_U']);
        }

        // Création de l'utilisateur
        $utilisateur = new Utilisateur();
        $utilisateur->prenom_U = $data['prenom_U'];
        $utilisateur->nom_U = $data['nom_U'];
        $utilisateur->email_U = $data['email_U'];
        $utilisateur->mdp_U = bcrypt($data['mdp_U']);
        $utilisateur->save();

        // Authentification de l'utilisateur
        Auth::login($utilisateur);

        // Redirection vers la page d'accueil
        return redirect()->intended('/');
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }
}
