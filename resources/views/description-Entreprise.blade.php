
@extends('commun/footer')

@section('title','Description Entreprise')

@section('content')

<!-- formulaire pour l'entreprise avec num_tel_Md | adresse_Md | desc_Md | horaire_Md | logo_Md -->
<h1 class="text-center my-4">Modifier la description de l'entreprise : </h1>
<form class=" border rounded m-4 p-4" action = "/description-entreprise" method = "POST">
    @csrf
    @method('post')
    <div class="form-group">
        <label for="num_tel_Md" class="fw-bold m-3 fs-3">Numéro de téléphone :</label>
        <input type="text" class="form-control mb-3 mx-5 w-50" id="num_tel_Md" name="num_tel_Md" placeholder="Numéro de téléphone" value="0{{ $entreprise->num_tel_Md }}" required>
    </div>
    <div class="form-group">
        <label for="adresse_Md" class="fw-bold m-3 fs-3">Adresse :</label>
        <input type="text" class="form-control mb-3 mx-5 w-50" id="adresse_Md" name="adresse_Md" placeholder="Adresse" value="{{ $entreprise->adresse_Md }}" required>
    </div>
    <div class="form-group">
        <label for="desc_Md" class="fw-bold m-3 fs-3">Description :</label>
        <textarea type="text" class="form-control mb-3 mx-5 w-50" id="desc_Md" name="desc_Md" placeholder="Description" rows="6" required>{{ $entreprise->desc_Md }}</textarea>
    </div>
    <div class="form-group">
        <!-- je crée un input pour chaque jour de la semaine -->
        <label for="horaire_Md" class="fw-bold m-3 fs-3">Horaires :</label>
        <input type="text" class="form-control mb-3 mx-5 w-auto w-sm-50 w-md-25" id="lundi_Md" name="lundi_Md" placeholder="Lundi" value="{{ $horaires[0] }}" required>
        <input type="text" class="form-control mb-3 mx-5 w-auto w-sm-50 w-md-25" id="mardi_Md" name="mardi_Md" placeholder="Mardi" value="{{ $horaires[1] }}" required>
        <input type="text" class="form-control mb-3 mx-5 w-auto w-sm-50 w-md-25" id="mercredi_Md" name="mercredi_Md" placeholder="Mercredi" value="{{ $horaires[2] }}" required>
        <input type="text" class="form-control mb-3 mx-5 w-auto w-sm-50 w-md-25" id="jeudi_Md" name="jeudi_Md" placeholder="Jeudi" value="{{ $horaires[3] }}" required>
        <input type="text" class="form-control mb-3 mx-5 w-auto w-sm-50 w-md-25" id="vendredi_Md" name="vendredi_Md" placeholder="Vendredi" value="{{ $horaires[4] }}" required>
        <input type="text" class="form-control mb-3 mx-5 w-auto w-sm-50 w-md-25" id="samedi_Md" name="samedi_Md" placeholder="Samedi" value="{{ $horaires[5] }}" required>
        <input type="text" class="form-control mb-3 mx-5 w-auto w-sm-50 w-md-25" id="dimanche_Md" name="dimanche_Md" placeholder="Dimanche" value="{{ $horaires[6] }}" required> 
    </div>
    <button type="submit" class="btn btn-primary w-100">Modifier</button>
</form>
@endsection()

@extends('commun/header')
