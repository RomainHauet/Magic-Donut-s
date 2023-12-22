<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NosProduitsController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\GestionCommandesController;
use App\Http\Controllers\PanierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get( '/', [ AccueilController::class, 'index' ] );

Route::get( '/login', [ AuthController::class, 'login' ])->name('auth.login');
Route::post( '/login', [ AuthController::class, 'doLogin' ]);
Route::get( '/logout', [ AuthController::class, 'logout' ]);

Route::get( '/register', [ AuthController::class, 'register' ])->name('auth.register');
Route::post( '/register', [ AuthController::class, 'doRegister' ]);

Route::get('/actualites', [ ActualiteController::class, 'index' ]);
Route::get('/creer-Actualite', [ ActualiteController::class, 'create' ]);
Route::get('/actualite-{id}', [ ActualiteController::class, 'show' ]);
Route::post('/actualite-{id}', [ ActualiteController::class, 'edit' ]);
Route::delete('/actualite-{id}', [ ActualiteController::class, 'destroy' ]);





Route::get('/mail', [ EmailController::class, 'envoieMail' ]);
Route::post('/mail', [ EmailController::class, 'envoieMail' ]);




Route::get('/qui-sommes-nous', [ PageController::class, 'pageQuiSommesNous' ] );
Route::get('/politiques-de-confidentialité', [ PageController::class, 'pageConfidentialite' ] );

Route::get('/description-entreprise', [ PageController::class, 'pageDescriptionEntreprise' ] );
Route::post('/description-entreprise', [ PageController::class, 'updateDescriptionEntreprise' ] );

Route::get( '/nos-produits', [ NosProduitsController::class,'index'] );
Route::post( '/nos-produits', [ NosProduitsController::class,'updateAllProduits'] );
Route::put( '/nos-produits', [ NosProduitsController::class,'store'] );
Route::get( '/nos-produit/{id_P}', [ NosProduitsController::class,'show'] );
Route::post( '/nos-produit/{id_P}', [ NosProduitsController::class,'edit'] );
Route::get( '/suprimer-Produit-{id_P}', [ NosProduitsController::class,'destroy'] );

Route::get( '/profil', [ ProfilController::class,'index']);
Route::post( '/profil-Identifiant', [ ProfilController::class,'storeIdentifiant']);
Route::post( '/profil-Mdp', [ ProfilController::class,'storeMdp']);

Route::get( '/gestion-commandes', [ GestionCommandesController::class,'index']);
Route::post( '/changer-Etat', [ GestionCommandesController::class,'changerEtat']);
Route::get( '/commande-{id_C}', [ GestionCommandesController::class,'show']);

Route::get( '/panier', [ PanierController::class,'index']);
Route::post( '/ajouter-Panier-{id_P}', [ PanierController::class,'store']);
Route::get('/vider-Panier',[ PanierController::class,'viderPanier']);
Route::post('/suprimer-Panier-{id_P}',[ PanierController::class,'suprimerPanier']);
Route::post('/envoyerCommande',[ PanierController::class,'commander']);