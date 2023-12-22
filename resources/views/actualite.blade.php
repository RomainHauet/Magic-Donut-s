@extends('commun/footer')

@section('title',$actualite->titre_Actu)

@section('content')

@auth
@if( Auth::user()->admin_U == true )
<h3 class="text-center my-4">Modifier l'article</h3>
<form action="/actualite-{{$actualite->id_Actu}}" method="POST" class="d-flex flex-column flex-sm-row w-100 gap-2">
    @csrf
    @method('POST')
        
        <div class="text-center w-100">
            <input  type="hidden" name="id_Actu" value="{{$actualite->id_Actu}}"><br>
            <input class="w-50 rounded mb-2 form-control" style="display:inline;" type="text" name="titre_Actu" value="{{$actualite->titre_Actu}}"><br>
            <textarea class="w-50 rounded mb-2 form-control" type="text" name="contenu_Actu" rows="25" style="display:inline;">{{$actualite->contenu_Actu}}</textarea><br>

            <input class=" w-25 btn btn-secondary text-white text-center" type="submit" value="Modifier">
        </div>
</form>
@endif
@endauth

<div class="col">
    <div class="img-fluid my-5 py-5" style="background-image: url('media/bg.png'); background-position: center; background-size: cover;">
        <h1 class="py-5 my-5 fw-bold text-primary text-center">{{ $actualite->titre_Actu }}</h1>
    </div>
    


    <p class="text-black fs-4 m-5 px-5" style="text-align: justify;">{!! nl2br($actualite->contenu_Actu) !!}</p>
</div>

@endsection()

@extends('commun/header')