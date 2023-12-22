<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Commande;

class GestionCommandesController extends Controller
{
    public function index()
    {
        // redirige vers la page de connexion si l'utilisateur n'est pas connecté ou n'est pas admin
        if( !Auth::check() || !Auth::user()->admin_U ) { return redirect( '/' ); }

        return view('gestionCommandes', [
            'Commandes' => Commande::all()
        ]);
    }
    public function changerEtat(Request $request)
    {
        $commande = Commande::find($request->id_C);

        if ($commande->etat_C == 'en cours de préparation')
        {
            $commande->etat_C = 'commande prête';
        }
        else if ($commande->etat_C == 'commande prête')
        {
            $commande->etat_C = 'commande terminée';
        }

        $commande->save();

        return redirect('/gestion-commandes')->with('success', 'La commande est terminer');

    }

    public function show($id)
    {
        $commande = Commande::findOrFail($id);

        // vérifie que l'utilisateur est bien l'utilisateur de la commande ou qu'il soit admin
        if( !Auth::check()) { return redirect( '/' ); }
        else if( Auth::user()->id_U != $commande->id_U && !Auth::user()->admin_U ) { return redirect( '/' ); }

        // récupère les produits de la commande
        $achats = DB::table('achats')
            ->join('produits', 'achats.id_P', '=', 'produits.id_P')
            ->where('achats.id_C', '=', $id)
            ->get();
        
        return view('commande', [
            'commande' => $commande,
            'achats' => $achats
        ]);
    }
}
