@extends('commun/footer')

@section('title','Actualités')

@section('content')

<div class="m-5">
        <!-- Affichage de la dernière actualité en gros et affiche uniquement les 3 prochaines en plus petit -->
        <h1 class="text-primary fw-bold my-5 text-center" id="blog">Notre blog</h1>

        @auth
            @if( Auth::user()->admin_U == true )
                <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                    <a href="/creer-Actualite" class="btn btn-primary text-white me-2 p-3 m-3">Ajouter une actualité</a>
                </div>

                <form action="/mail" method="POST" class="d-flex flex-column flex-sm-row w-100 gap-2">
                @csrf
                @method('POST')
                    <textarea class="w-90 rounded mb-2 form-control" name="contenue" rows="15" style="display:inline;"></textarea>
                    <input class=" h-10 btn btn-secondary text-white text-center" type="submit" value="Envoyer la NewsLetter">
                </form>
            @endif

        @endauth
        @foreach($actualites as $actualite)

        @if($loop->first)
        <div class="bg-image p-5 text-center shadow-1-strong rounded mb-5 text-white"
            style="background-image: url('media/placeholder.png'); background-position: center; background-size: cover;">
            <h1 class="p-3 my-5 text-dark fw-bold">{{ $actualite->titre_Actu }}</h1>    
            <a class="btn btn-secondary p-3" href="/actualite-{{$actualite->id_Actu}}">Lire la suite</a>
            @auth @if( Auth::user()->admin_U == true )
                <form action="/actualite-{{$actualite->id_Actu}}" method="POST" class="bg-image p-5 text-center shadow-1-strong rounded mb-5 text-white">
                @csrf
                @method('DELETE')
                    <input class="btn btn-secondary p-3" type="submit" value="Supprimer">
                </form>
            @endif @endauth
        </div>
        <!-- Autres articles-->
        <div class="mx-5 row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3 mb-5">
        @elseif($loop->index < 4)
            <!-- Affichage des 3 prochaines actualités -->
            <div class="col">
                <div class="bg-image p-5 text-center shadow-1-strong rounded mb-5 text-white">  
                    <h1 class="p-3 my-3 text-dark fw-bold">{{ $actualite->titre_Actu }}</h1>
                    <a class="btn btn-secondary p-3" href="/actualite-{{$actualite->id_Actu}}">Lire la suite</a>
                    @auth @if( Auth::user()->admin_U == true )
                        <form action="/actualite-{{$actualite->id_Actu}}" method="POST" class="bg-image p-5 text-center shadow-1-strong rounded mb-5 text-white">
                        @csrf
                        @method('DELETE')
                            <input class="btn btn-secondary p-3" type="submit" value="Supprimer">
                        </form>
                    @endif @endauth
                </div>
            </div>
        @endif
        @endforeach

        </div>
</div>

@endsection()

@extends('commun/header')
