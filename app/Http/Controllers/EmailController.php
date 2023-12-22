<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\NewsMail;
use Illuminate\Support\Facades\DB;


use App\Models\Utilisateur;

class EmailController extends Controller
{


    public function envoieMail(Request $request)
    {
        $utilisateurs = DB::table('utilisateurs')->where('recoit_news_U', true)->get('email_U');
        $variableContenu = $request->input('contenue');

        foreach ($utilisateurs as $utilisateur) {
            Mail::to($utilisateur->email_U)->send(new NewsMail($variableContenu));
        }
        
        return back();
    }


}