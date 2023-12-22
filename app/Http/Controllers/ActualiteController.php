<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Actualite;
class ActualiteController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        // prend les actualités en partant du dernier enregistrement
        $actualites = Actualite::orderBy('created_at', 'asc')->get();

        return view('actualites' , [
            'actualites' => $actualites
        ]);
    }

    public function show($id)
    {
        $actualite = Actualite::find($id);

        return view('actualite' , [
            'actualite' => $actualite
        ]);
    }

    public function store(Request $request)
    {
        $actualite = new Actualite();

        $actualite->titre_Actu = $request->titre_Actu;
        $actualite->contenu_Actu = $request->contenu_Actu;
        $actualite->save();

        return redirect('/actualites');
    }

    public function create()
    {
        // on créer une nouvelle actualité
        $actualite = new Actualite();

        // on lui donne un titre
        $actualite->titre_Actu = "Nouvelle actualité";

        // on lui donne un contenu
        $actualite->contenu_Actu = "Contenu de l'actualité";

        // on sauvegarde l'actualité
        $actualite->save();

        // on redirige vers la page liste des actualités
        return redirect('/actualite-'.$actualite->id_Actu);

    }

    public function edit(Request $request, $id)
    {
        $actualite = Actualite::find($id);

        $actualite->titre_Actu = $request->titre_Actu;
        $actualite->contenu_Actu = $request->contenu_Actu;

        $actualite->save();

        return redirect('/actualite-'.$actualite->id_Actu);
    }

    public function destroy($id)
    {
        $actualite = Actualite::find($id);

        $actualite->delete();

        return redirect('/actualites');
    }
}