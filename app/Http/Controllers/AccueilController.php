<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Achat;
use App\Models\Produit;
use App\Models\MagicDonuts;

class AccueilController extends Controller
{
    public function index()
    {
        // Je prends tous les produitsTendance visible et en stock
        $produitsTendance = Produit::where('visible_P', 1)->where('stock_P', '>', 0)->get();

        // j'additionne la quantité de chaque qui sont lié à leur produit
        foreach ($produitsTendance as $produit) {
            $produit->achats = Achat::where('id_P', $produit->id_P)->sum('qte_A');
        }

        // je trie les produitsTendance par quantité d'achat
        $produitsTendance = $produitsTendance->sortByDesc('achats');

        // je prends les 3 premiers produitsTendanceTendance
        $produitsTendanceTendance = $produitsTendance->take(3);

        $entreprise = MagicDonuts::find(1);

        // on sépare les horaires pour les afficher dans le formulaire
        $horaires = explode('\\n', $entreprise->horaire_Md);


        return view('accueil', [
            'ProduitsTendance' => $produitsTendanceTendance,
            'horaires' => $horaires,
            'entreprise' => $entreprise,
        ]);
    }
}
