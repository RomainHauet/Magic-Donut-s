@extends('commun/footer')

@section('title','Gestion de Commandes')

@section('content')

@if( Auth::user()->admin_U == true )
<div style="width:99%;" class="container-fluid mt-5 mb-5 pb-5">
    <h1 class="mt-5 mb-4 pb-4">Gestion de Commandes</h1>

    <!-- 3 boutons pour afficher les commandes en fonction de leur état -->
    <div class="row">
        <div class="col-2">
            <a href="#EnCours" class="btn btn-primary">En cours de préparation</a>
        </div>
        <div class="col-2">
            <a href="#Historique" class="btn btn-primary">Commandes Prêtes</a>
        </div>
        <div class="col-2">
            <a href="#Terminées" class="btn btn-primary">Commandes Terminées</a>
        </div>
    </div>

    <h2 class="mt-5 mb-4 pb-4" id="EnCours">En cours de préparation</h2>
    
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                <th scope="col">ID Commandes</th>
                <th scope="col">Date de commande</th>
                <th scope="col">Etats de la commande</th>
                <th scope="col">Prix total</th>
                <th scope="col">Détails</th>
                <th scope="col">Etape Suivante</th>

                </tr>
            </thead>
            <tbody>
                @foreach($Commandes as $commande)
                    @if( $commande->etat_C == 'en cours de préparation')
                        <!-- écrit au centre -->
                        <tr class="text-center">
                            <td>{{ $commande->id_C }}</td>
                            <td>{{ substr($commande->date_C, 0, 10) }}</td>
                            <td>{{ $commande->etat_C }}</td>
                            <td>{{ number_format($commande->cout_C, 2, ',', ' ') }} €</td>
                            <td><a href="/commande-{{$commande->id_C}}" class="btn btn-primary">Détails</a></td>

                            <td>    
                                <form action ="/changer-Etat" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="id_C" value="{{ $commande->id_C }}">
                                    <button type="submit" class="btn btn-secondary p-3 text-white text-center">Commande Prête</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                    @endforeach
            </tbody>
        </table>

    <h2 class="mt-5 mb-4 pb-4" id="Historique">Commandes Prêtes</h2>

        <table class="table table-striped text-center">
            <thead>
                <tr>
                <th scope="col">ID Commandes</th>
                <th scope="col">Date de commande</th>
                <th scope="col">Etats de la commande</th>
                <th scope="col">Prix total</th>
                <th scope="col">Détails</th>
                <th scope="col">Etape Suivante</th>

                </tr>
            </thead>
            <tbody>
                @foreach($Commandes as $commande)
                    @if( $commande->etat_C == 'commande prête')
                        <tr>
                            <td>{{ $commande->id_C }}</td>
                            <td>{{ substr($commande->date_C, 0, 10) }}</td>
                            <td>{{ $commande->etat_C }}</td>
                            <td>{{ number_format($commande->cout_C, 2, ',', ' ') }} €</td>
                            <td><a href="/commande-{{$commande->id_C}}" class="btn btn-primary">Détails</a></td>

                            <td>    
                                <form action ="/changer-Etat" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="id_C" value="{{ $commande->id_C }}">
                                    <button type="submit" class="btn btn-secondary p-3 text-white text-center">Terminer la Commande</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                    @endforeach
            </tbody>
        </table>

    <h2 class="mt-5 mb-4 pb-4" id="Terminées">Commandes Terminées</h2>   
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">ID Commandes</th>
            <th scope="col">Date de commande</th>
            <th scope="col">Prix total</th>
            <th scope="col">Détails</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Commandes as $commande)
                @if( $commande->etat_C == 'commande terminée')
                    <tr>
                        <td>{{ $commande->id_C }}</td>
                        <td>{{ substr($commande->date_C, 0, 10) }}</td>
                        <td>{{ number_format($commande->cout_C, 2, ',', ' ') }} €</td>
                        <td><a href="/commande-{{$commande->id_C}}" class="btn btn-primary">Détails</a></td>
                    </tr>
                @endif
                @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection()

@extends('commun/header')