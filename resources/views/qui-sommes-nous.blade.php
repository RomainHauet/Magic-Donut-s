@extends('commun/footer')

@section('title','Qui sommes nous')

@section('content')

<div class="container">

    <h1 class="text-primary fw-bold my-5 text-center">Qui sommes nous ?</h1>
    <div class="d-flex justify-content-center g-3 mb-5">
        <div class="w-75">
            <h2 class="fw-bold mb-5">À propos</h2>
            <p class="mb-5" style="text-align:justify;">
                {{ $entreprise->desc_Md }}
            </p>
            <img class=" img-fluid card-img-top mb-5" height="100%" style="object-fit: cover;" src="media/boutique.jpg"
                focusable="false">
            <h2 class="fw-bold mb-5" id="faq">F.A.Q</h2>
            <div class="mb-4">
                <h3><i class="bi bi-arrow-right-circle-fill"></i> Quels donuts sont fourrés ?</h3>
                <p class="mx-5"><i class="bi bi-arrow-return-right"></i> Tous nos donuts sont fourrés !</p>
            </div>
            <div class="mb-4">
                <h3><i class="bi bi-arrow-right-circle-fill"></i> Combien coute 1 donut ?</h3>
                <p class="mx-5"><i class="bi bi-arrow-return-right"></i> Entre 2,50€ et 3,50€.</p>
            </div>
            <div class="mb-4">
                <h3><i class="bi bi-arrow-right-circle-fill"></i> Je suis allergique aux arachides, y a-t-il des donuts
                    pour moi ?</h3>
                <p class="mx-5"><i class="bi bi-arrow-return-right"></i> Nous avons pris en compte la composition de
                    notre carte pour pouvoir permettre à
                    tous de manger des donuts. Nous avons une sélection de donuts pour toi, pour en
                    savoir plus tu peux te rendre en magasin !</p>
            </div>
            <div class="mb-4">
                <h3><i class="bi bi-arrow-right-circle-fill"></i> Peut-on faire des commandes en gros pour des
                    évènements ?</h3>
                <p class="mx-5"><i class="bi bi-arrow-return-right"></i> Il est possible de commander une grande quantité
                    de Donuts, pour cela il faut
                    simplement nous envoyer un mail et nous vous recontacterons !</p>
            </div>
            <div class="mb-4">
                <h3><i class="bi bi-arrow-right-circle-fill"></i> Est-ce que vos donuts sont fait maison ?</h3>
                <p class="mx-5"><i class="bi bi-arrow-return-right"></i>
                    Tous nos donuts sont faits maison par nos soins !</p>
            </div>
        </div>









    </div>

</div>

@endsection()
@extends('commun/header')