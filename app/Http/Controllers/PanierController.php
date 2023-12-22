<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Achat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PanierController extends Controller
{
    public function index()
    {
        if( !Auth::check() || Auth::user()->admin_U ) { return redirect( '/' ); }
        return view('panier');
    }
    public function store(Request $request)
    {

        $produit = Produit::find($request->id_P);
        // Une vérification si l'utilisateur à une commande en cours de décision je le met dedans sinon j'en crée 1
        $commande = Commande::where('id_U', Auth::user()->id_U)->where('etat_C', 'en cours de décision')->first();

        if(!$commande)
        {
            $commande = new Commande();

            $commande->id_U   = Auth::user()->id_U;
            $commande->cout_C = $request->qte_P * $produit->prix_P;
            $commande->etat_C = 'en cours de décision';
            $commande->date_C = Carbon::now();  
            $commande->save();
        }
        else
        {
            $commande->cout_C = $commande->cout_C + $request->qte_P * $produit->prix_P;
            $commande->save();
        }

        // Je vérifie si l'id du produit est déjà dans le panier
        $duplicata = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id == $request->id_P;
        });

        // Si il est dans le panier je rajoute la quantité du produit dans le Cart sinon je crée le produit dans le panier
        if($duplicata->isNotEmpty())
        {
            $item = Cart::get($duplicata->first()->rowId);
            $options = $item->options->merge(['qte_P' => $request->qte_P + $duplicata->first()->options->qte_P]);
            // Je rajoute la quantité du produit dans le panier qui est déjà dans le panier
            Cart::update($duplicata->first()->rowId,
                ['options' => $options]);
            //Cart::update($duplicata->first()->rowId, ['options.qte_P' => $request->qte_P + $duplicata->first()->options->qte_P]);
        }
        else
        {
            Cart::add(['id' => $produit->id_P, 'name'=> $produit->lib_P, 
                    'price'=> $produit->prix_P,'qty'=> 1,'options' => ['etat_P'=>$produit->etat_P,
                    'taille_P'=> $produit->taille_P,'gout_P' => $produit->gout_P,'image_P'=> $produit->image_P , 
                    'allergene_P'=> $produit->allergene_P,'qte_P'=> $request->qte_P,'id_C'=>$commande->id_C]]);
        }

        return redirect('/nos-produits')->with('success', 'Le produit a bien été ajouté au panier');
    }

    public function viderPanier(Request $request)
    {
        // Je vide cart
        // Je retire la commande lié à l'utilisateur si il existe

        Cart::destroy();

        $commande = Commande::where('id_U', Auth::user()->id_U)->where('etat_C', 'en cours de décision')->first();

        if($commande)
        {
            $commande->delete();
        }

        return redirect('/panier')->with('success', 'Le panier a bien été supprimé');
    }

    public function suprimerPanier($rowId)
    {
        // Je prends le produit et je le suprime du Cart et de la commande

        $items = Cart::content();

        foreach ($items as $item) 
        {
            $id_C = $item->options->id_C ?? null; // Récupérer l'ID de la commande
            if ($id_C) 
            {
                $commande = Commande::find($id_C);
                if ($commande) 
                {
                    $commande->delete(); // Supprimer la commande associée à cet ID
                }
            }
        }
        
        Cart::remove($rowId);

        return redirect('/panier')->with('success', 'Le Produit du panier a bien été supprimer');
    }
    public function commander(Request $request)
    {
        // Je récupère tout le cart (plus besoin du form)
        // Et je déclare achats à chaque produit

        $items = Cart::content();

        foreach ($items as $item) 
        {
            $achat = new Achat();

            $achat->id_C = $item->options->id_C;
            $achat->id_P = $item->id;
            $achat->qte_A = $item->options->qte_P;

            $achat->save();
        }
        
        // je met à jour la commande
        Cart::destroy();

        $commande = Commande::find($item->options->id_C);
        $commande->etat_C = 'en cours de préparation';
        $commande->save();

        return redirect('/panier')->with('success', 'La commande a bien été effectuée');
        /*
        // prends toutes les données du formulaire
        $commande = $request->all();

        // pour chaque produit
        foreach ($commande['id_C'] as $key => $id_C)
        {
            // pour chaque produits dans le panier on déclare un achat
            $achat = new Achat();

            // on récupère l'id de la commande
            $achat->id_C = $id_C;

            // on récupère l'id du produit
            $achat->id_P = $commande['id_P'][$key];
            $achat->qte_A = $commande['qte_a'][$key];

            $achat->save();
        }

        Cart::destroy();*/

    }
}