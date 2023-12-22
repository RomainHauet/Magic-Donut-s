@extends('commun/footer')

@section('title','Commande')

@section('content')

    <!-- Affiche les informations de la commande puis affiche la liste d'achats -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-5 mb-4 pb-4">Commande n°{{ $commande->id_C }}</h1>
                <h2 class="mt-5 mb-4 pb-4">Date de commande : {{ substr($commande->date_C, 0, 10) }}</h2>
                <h2 class="mt-5 mb-4 pb-4">Etat de la commande : {{ $commande->etat_C }}</h2>
                <h2 class="mt-5 mb-4 pb-4">Prix total : {{ number_format($commande->cout_C, 2, ',', ' ') }} €</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-3 g-3">
            @foreach($achats as $achat)
            <div class="col">
                <div class="card shadow-sm">
                    <img class="bd-placeholder-img card-img-top" width="auto" height="auto" style="object-fit: cover;"
                        src="media/{{ $achat->image_P }}" focusable="false">
                    <div class="card-body">
                        <h3 class="text-center text-black">{{ $achat->lib_P }}</h3>
                        <h5 class="text-center text-black"> Gout : {{ $achat->gout_P }}</h5>
                        <h5 class="text-center text-black"> Taille : {{ $achat->taille_P }}</h5>
                        <h5 class="text-center text-black"> Etat : {{ $achat->etat_P }}</h5>
                        <h5 class="text-center text-black"> Allergene : {{ $achat->allergene_P }}</h5>
                        <h5 class="text-center text-black"> Prix : {{ number_format($achat->prix_P * $achat->qte_A, 2, ',', ' ') }} €</h5>
                        <h5 class="text-center text-black"> quantité : {{ $achat->qte_A }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection()

@extends('commun/header')