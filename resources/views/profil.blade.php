@extends('commun/footer')

@section('title','Profil')

@section('content')

<div class="container">
    <h1 class="pt-5">Mon Compte</h1>
    <form action="/profil-Identifiant" method="post">
        @csrf
        @method('post')

        <input type="hidden" id="id_U" name="id_U" class="form-control" value="{{ Auth::user()->id_U }}" required>

        <div class="row col pt-4">
            <label for="nom_U" class="">Nom</label>
            <input type="text" id="nom_U" name="nom_U" class="form-control"  value="{{ Auth::user()->nom_U }}" required>
        </div>

        <div class="row col pt-4">
            <label for="prenom_U" class="">Prénom</label>
            <input type="text" id="prenom_U" name="prenom_U" class="form-control" value="{{ Auth::user()->prenom_U }}" required>
        </div>

        <div class="row col pt-4">
            <label for="email_U" class="">Email</label>
            <input type="email" id="email_U" name="email_U" class="form-control" value="{{ Auth::user()->email_U }}" required>
        </div>

        <div class="col pt-4">
            <label for="recoit_news_U" class="">Recevoir la newsletter</label>
            <input type="checkbox" id="recoit_news_U" name="recoit_news_U" class="form-check-input" {{ Auth::user()->recoit_news_U ? 'checked' : '' }}>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
    </form>

    <h1 class="pt-5">Modifier mon mot de passe</h1>
    <form action="/profil-Mdp" method="post">
        @csrf
        @method('post')
        <input type="hidden" id="id_U" name="id_U" class="form-control" value="{{ Auth::user()->id_U }}" required>

        <div class="row col pt-3">
            <label for="ancien_mdp" class="pb-2">Ancien mot de passe</label>
            <input type="password" id="ancien_mdp" name="ancien_mdp" class="form-control" required>
        </div>

        <div class="row col pt-3">
            <label for="mdp_U" class="pb-2">Mot de passe</label>
            <input type="password" id="mdp_U" name="mdp_U" class="form-control" required>
        </div>

        <div class="row col pt-3">
            <label for="mdp_confirmation" class="pb-2">Confirmation du mot de passe</label>
            <input type="password" id="mdp_confirmation" name="mdp_confirmation" class="form-control" required>
        </div>

        @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
        @endif


        <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
    </form>
    @auth
        @if( Auth::user()->admin_U == false )
            <h1 class="mt-5 mb-4 pb-4" id="Historique">Mes commandes</h1>
            <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">ID Commandes</th>
                <th scope="col">Date de commande</th>
                <th scope="col">Etats de la commande</th>
                <th scope="col">Prix total</th>
                <th scope="col">Détails</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Commandes as $commande)
                    @if($commande->etat_C != 'en cours de décision')
                        <tr>
                            <td>{{ $commande->id_C }}</td>
                            <td>{{ substr($commande->date_C, 0, 10) }}</td>
                            <td>{{ $commande->etat_C }}</td>
                            <td>{{ number_format($commande->cout_C, 2, ',', ' ') }} €</td>
                        <td><a href="/commande-{{$commande->id_C}}" class="btn btn-primary">Détails</a></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
            </table>
        @endif
    @endauth
</div>
@endsection()

@extends('commun/header')
