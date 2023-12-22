<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Produit;
use App\Models\Achat;

class NosProduitsController extends Controller
{
    public function __construct()
    {
        $produit = new Produit();
    }

    public function index()
    {
        // récupère toutes les catégories de produits en triant par ordre alphabétique
        $categories = DB::table('produits')->where('visible_P', true)->select('lib_P')->distinct()->orderBy('lib_P')->get();
        
        $produits = DB::table('produits')->where('visible_P', true)->orderBy('lib_P')->get();
        
        // Je prends tous les produits visible et en stock
        $produitsTendance = Produit::where('visible_P', true)->where('stock_P', '>', 0)->get();

        // j'additionne la quantité de chaque qui sont lié à leur produit
        foreach ($produitsTendance as $produitTendance) {
            $produitTendance->achats = Achat::where('id_P', $produitTendance->id_P)->sum('qte_A');
        }

        // je trie les produits par quantité d'achat
        $produitsTendance = $produitsTendance->sortByDesc('achats');

        // je prends les 3 premiers produits
        $produitsTendance = $produitsTendance->take(3);

        return view( "/nos-produits",
        [
            'Categories' => $categories,
            'Produits' => $produits,
            'ProduitsTendance' => $produitsTendance
        ]);
    }

    public function store(Request $request)
    {
        $produit = new Produit();

        $produit->lib_P = $request->lib_P;
        $produit->gout_P = $request->gout_P;
        $produit->prix_P = $request->prix_P;
        $produit->stock_P = $request->stock_P;
        $produit->etat_P = $request->etat_P;
        $produit->taille_P = $request->taille_P;

        // je récupère l'image du formulaire
        $image = $request->file('image_P');

        // je récupère le nom de l'image
        $nomImage = $image->getClientOriginalName();

        // je déplace l'image dans le dossier public/images
        $image->move(public_path('media'), $nomImage);

        // je stocke le nom de l'image dans la base de données
        $produit->image_P = $nomImage;

        $produit->allergene_P = $request->allergene_P;

        $produit->visible_P = true;

        $produit->save();

        return back();
    }
    public function updateAllProduits(Request $request)
    {
        // prends toutes les données du formulaire
        $produits = $request->all();

        // pour chaque produit
        foreach ($produits['id_P'] as $key => $id_P)
        {
            // on récupère le produit
            $produit = Produit::find($id_P);

            // on met à jour le stock
            $produit->gout_P = $request->gout_P[$key];
            $produit->etat_P = $request->etat_P[$key];
            $produit->taille_P = $request->taille_P[$key];
            // transforme le prix en float
            $produit->prix_P = floatval($request->prix_P[$key]);
            $produit->allergene_P = $request->allergene_P[$key];

            // on met à jour le stock
            $produit->stock_P = $request->stock_P[$id_P];
            
            // je récupère l'image du formulaire

            // verifie si l'image à été modifié
            /*if ($produits->hasFile('image_P')[$key])
            {é
                $image = $produits->file('image_P')[$key];

                // je récupère le nom de l'image
                $nomImage = $image->getClientOriginalName();

                // je déplace l'image dans le dossier public/images
                $image->move(public_path('media'), $nomImage);

                // je stocke le nom de l'image dans la base de données
                $produit->image_P = $nomImage;
            }*/

            // on sauvegarde
            $produit->save();
        }

        return back();
    }

    public function destroy($id_P)
    {
        $produit = Produit::find($id_P);

        $produit->visible_P = false;
        $produit->save();

        return back();
    }
}
