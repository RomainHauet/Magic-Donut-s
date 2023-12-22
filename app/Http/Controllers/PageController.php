<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use App\Models\MagicDonuts;

class PageController extends Controller
{  
    public function pageQuiSommesNous()
    {
        // on récupère la description de l'entreprise
        $entreprise = MagicDonuts::find(1);
        
        return view('qui-sommes-nous', [
            'entreprise' => $entreprise
        ]);
    }
    
    public function pageConfidentialite()
    {
        return view('confidentialite');  
    }

    public function pageDescriptionEntreprise()
    {
        // verifie si l'utilisateur est connecté
        if(!auth()->check() || auth()->user()->admin_U == false)
        {
            return redirect('/');
        }

        $entreprise = MagicDonuts::find(1);

        // on sépare les horaires pour les afficher dans le formulaire
        $horaires = explode('\\n', $entreprise->horaire_Md);

        return view('description-entreprise', [
            'entreprise' => $entreprise,
            'horaires' => $horaires
        ]);
    }

    public function updateDescriptionEntreprise(Request $request)
    {
        $entreprise = MagicDonuts::find(1);

        // on suprime les espaces dans le numéro de téléphone et on garde le format 06XXXXXXXX
        $request->merge(['num_tel_Md' => str_replace(' ', '', $request->input('num_tel_Md'))]);
        
        $entreprise->num_tel_Md = $request->input('num_tel_Md');
        $entreprise->adresse_Md = $request->input('adresse_Md');
        $entreprise->desc_Md = $request->input('desc_Md');
        $entreprise->horaire_Md = $request->input('lundi_Md') . '\\n' . $request->input('mardi_Md') . '\\n' . $request->input('mercredi_Md') . '\\n' . $request->input('jeudi_Md') . '\\n' . $request->input('vendredi_Md') . '\\n' . $request->input('samedi_Md') . '\\n' . $request->input('dimanche_Md');

        $entreprise->save();

        return redirect('/description-entreprise');
    }
}