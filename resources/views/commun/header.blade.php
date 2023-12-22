<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Découvrez des donuts gourmands, fourrés et nappés. Notre donut shop vous propose des recettes originales et savoureuses.">
    <title>@yield('title')</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- Je l'ai mis dans le head donc celui qui était tout en bas je l'ai enlevé -->
    <script src="../js/bootstrap.bundle.min.js"></script>

    <style>
        @media screen and (min-width: 1400px)
        {
            .horizontal.dropdown-menu.show
            {
                display: flex;
            }
        }
        .lien-noir
        {
            color: black; /* Définit la couleur du texte des liens en noir */
        }
    </style>
</head>

<body>
<header id="header" class="p-2 bg-light">
        <div class="mx-5">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start mx-5">
                
                <a href="./" class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none">
                    <img class="bi me-5" width="224" height="140" src="media/logo.webp" alt="logo Magic Donuts">
                </a>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle m-2 text-white fs-4 rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Nos Produits
                    </button>
                    <ul class="dropdown-menu horizontal">
                        <li>
                            <a class="dropdown-item" href="nos-produits#Donut">
                                <div class="d-flex flex-column text-center">
                                    <img class="bi me-2" width="200" height="120" src="./media/donut_framboise.jpeg"alt="Donuts">
                                    Donuts
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item justify-content-center" href="nos-produits#Bubble Tea">
                                <div class="d-flex flex-column text-center">
                                    <img class="bi me-2" width="200" height="120" src="./media/BubbleTea_Vert.jpeg"alt="Bubble Tea">
                                    Bubble Tea
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="nos-produits#Boisson">
                                <div class="d-flex flex-column text-center">
                                    <img class="bi me-2" width="200" height="120" src="./media/Caprisun.jpeg"alt="Boissons">
                                    Boissons
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="nos-produits#Milkshake">
                                <div class="d-flex flex-column text-center">
                                    <img class="bi me-2" width="200" height="120" src="./media/Milkshake.jpeg" alt="Milkshake">
                                    Milkshake
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="nos-produits#Magic Box">
                                <div class="d-flex flex-column text-center">
                                    <img class="bi me-2" width="200" height="120" src="./media/magic box.jpeg"
                                        alt="Magic Box">
                                    Magic Box
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
                
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0" >
                    <li><a href="actualites" class="btn btn-primary text-white me-2 fs-4 rounded-pill">Actualités</a></li>
                    <li><a href="qui-sommes-nous" class="btn btn-primary text-white me-2 fs-4 rounded-pill">Qui sommes nous ?</a></li>
                </ul>

                <ul class="nav col-12 col-lg-auto my-2 justify-content-center justify-content-xl-end my-md-0 text-small">
                @auth
                @if(!Auth::user()->admin_U == true)
                    
                        <li>
                            <a href="panier" class="nav-link text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                    class="bi bi-cart" viewBox="0 0 16 16">
                                    <path
                                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                </svg>
                                {{Cart::count()}}
                            </a>
                        <li>
            
                @endif
                @endauth
                <li>
                <a href="login" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd"
                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0
                            8m8-7a7 7 0 0 0-5.468
                            11.37C3.242 11.226 4.805 10 8
                            10s4.757 1.225 5.468
                            2.37A7 7 0 0 0 8
                            1" />
                    </svg>
                    @auth
                    {{Auth::user()->prenom_U}} {{Auth::user()->nom_U}}
                    @endauth

                </a>
                <ul class="dropdown-menu text-small" style="">
                @auth
                    <li><a class="dropdown-item" href="/profil">Mon Profil</a></li>
                    @if( Auth::user()->admin_U == false )
                        <li><a class="dropdown-item" href="/profil#Historique">Mes Commandes</a></li>
                    @endif
                    @if( Auth::user()->admin_U == true )
                        <li><a class="dropdown-item" href="/gestion-commandes">Gestion de Commandes</a></li>
                        <li><a class="dropdown-item" href="/description-entreprise">Description Entreprise</a></li>
                    @endif

                    <li><hr class="dropdown-divider"></li>

                    <li class="d-flex align-items-center">
                        <a class="dropdown-item" href="/logout"><i class="bi bi-box-arrow-left me-2"></i>Se Déconnecter</a>
                    </li>  
                    @endauth  
                    
                    @guest
                        <li class="d-flex align-items-center">
                            <a class="dropdown-item" href="/login"><i class="bi bi-box-arrow-in-right"></i>  Se Connecter</a>
                        </li> 
                    @endguest            
                </ul>
    </li>
                </ul>
                
                </ul>
            </div>
        </div>
    </header>
    @yield('content')