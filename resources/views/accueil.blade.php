@extends('commun/footer')


@section('title','MagicDonut’s')

@section('content')

<style>
    .text-outline {
    color: white;
    /* text-shadow: 0 0 10px #01cbfe; Modifier la valeur pour changer l'épaisseur et la couleur du contour */


    text-shadow: 
      -1px -1px 8px #01cbfe, /* Contour haut-gauche */
      1px -1px 8px #01cbfe, /* Contour haut-droite */
      -1px 1px 8px #01cbfe, /* Contour bas-gauche */
      1px 1px 8px #01cbfe; /* Contour bas-droite */
    font-size:300%;
  }
    </style>

    <div class="img-fluid bg-image p-5 text-center shadow-1-strong rounded mb-5 text-white"
        style="background-image: url('media/localDegoulinant.png'); background-position: center; background-size: cover; height:800px;">
        <div class="p-5">
        <h1 class="p-5 my-5 fw-bold text-outline">Bienvenue chez Magic Donut's !</h1>
        <h2 class="fw-bold text-outline">Découvrez nos donuts fourrés au différentes saveurs</h2>
        </div>

    </div>

    <!-- <img src="media/Design_sans_titre.png" style="width:100%; height:5%"> </img> -->

    <h2 class="text-center text-primary fw-bold mb-5">Nos produits tendances du moment</h2>
    <div class="mx-5 row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-5">
    
        @foreach ($ProduitsTendance as $produitTendance)
        <div class="col">
            <div class="card shadow-sm">
                <img class="bd-placeholder-img card-img-top" width="auto" height="auto" style="object-fit: cover;"
                    src="media/{{ $produitTendance->image_P }}" focusable="false">
                <div class="card-body">
                    <h3 class="text-center text-black">{{ $produitTendance->lib_P }}</h3>
                    <h4 class="text-center text-black">{{ $produitTendance->gout_P }}</h4>
                    <h3 class="text-center text-black">{{ $produitTendance->prix_P }}€</h3>
                </div>
                <!-- voir produit -->
                <div class="d-flex justify-content-center">
                    <a href="/nos-produits#Tendance" class="btn btn-primary text-white me-2 p-3 m-3">Voir le produit</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <h2 class="text-center text-primary fw-bold mb-5">Ils nous ont laissé un avis 😍</h2>
    <div class="p-3 bg-secondary">
        <div class="container">
            <div
                class="p-5 d-flex flex-wrap align-items-center justify-content-center justify-content-lg-center text-center">
                <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
                <div class="elfsight-app-7201d217-0698-40ec-9eaa-edcb88a2966c" data-elfsight-app-lazy></div>
            </div>
        </div>
    </div>

    <div class="bg-image p-5 text-center shadow-1-strong rounded mb-5 text-white"
        style="background-image: url('media/livraison.jpg'); background-position: center; background-size: cover;">
        <div style="background-color: #ee8bb5cc;">
            <h1 class="p-3 text-white fw-bold ">Faites vous livrer !</h1>
            <h2 class="p-3 mb-1 text-white  ">Profitez de la livraison rapide avec UberEATS et Deliveroo pour déguster
                nos donuts chez vous en un instant ! </h2>
        </div>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="https://www.ubereats.com/store/magic-donuts/HXwkG6wZXLWn8YhP0xBiCA?diningMode=DELIVERY" class="btn btn-primary text-white me-2 p-3 m-3">Découvrir UberEATS</a></li>
            <li><a href="https://deliveroo.fr/fr/menu/le-havre/le-havre-saint-vincent-thiers-gobelins/magic-donuts?geohash=u0b1dv84qy3q" class="btn btn-primary text-white me-2 p-3 m-3">Découvrir Deliveroo</a></li>
        </ul>
    </div>

    <div class="mx-5 row row-cols-1 row-cols-lg-2 g-3 mb-5">
        <div class="col">
            <h3 class="text-secondary fw-bold mb-5">Retrouvez nous à l'adresse suivante</h3>
            <div class="row row-cols-1 row-cols-sm-2 g-3">
                <div class="col">
                    <img class="bd-placeholder-img card-img-top" height="auto" style="object-fit: cover;"
                    src="media/boutique.jpg" focusable="false">
                </div>
                <div class="col">
                    <p> <i class="bi bi-geo-alt-fill"></i> {{ $entreprise->adresse_Md }}</p>
                    <p> <i class="bi bi-clock"></i> Horaires d'ouverture</p>
                    @foreach ($horaires as $horaire)
                        <p>{{ $horaire }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col">
                <iframe class="border border-primary" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d10365.107012525823!2d0.1159624!3d49.4981675!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e02fc206cf5b79%3A0xc1b4c5dd683105d1!2sMagic%20Donut%E2%80%99s%20Le%20Havre!5e0!3m2!1sen!2sfr!4v1701851998856!5m2!1sen!2sfr" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" ></iframe>
        </div>
    </div>
    @endsection()

    @extends('commun/header')