@extends('commun/header')

@section('title','Register')

@section('content')

<div class="position-relative py-4 py-xl-5" >
    <div class="container position-relative">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-5"><div class="card mb-3">
        <div class="card-body p-sm-5">
            <div class="text-center"><i class="bi bi-person-fill-add" style="font-size: 3rem;"></i></div>
            <h2 class="text-center mb-4">S'inscrire</h2>
            <form action="{{ route('auth.register') }}" method="post">

                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input required="" type="text" class="form-control" name="prenom_U" placeholder="Prénom" @if (session('prenom_U')) value="{{ session('prenom_U') }}" @endif required>
                        <span class="text-danger small"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input required="" type="text" class="form-control" name="nom_U" placeholder="Nom" @if (session('nom_U')) value="{{ session('nom_U') }}" @endif required>
                        <span class="text-danger small"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <input required="" type="email" class="form-control" name="email_U" placeholder="Adresse email" @if (session('email_U')) value="{{ session('email_U') }}" @endif required>
                    <span class="text-danger small"></span>
                </div>
                <div class="mb-3">
                    <input required="" type="password" class="form-control" name="mdp_U" placeholder="Mot de passe">
                    <span class="text-danger small"></span>
                </div>
                <div class="mb-3">
                    <input required="" type="password" class="form-control" name="mdpConfirm" placeholder="Confirmer le mot de passe">
                    <span class="text-danger small"></span>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="mb-3">
                    <div class="row">
                        <div class="col"><button class="btn btn-primary d-block w-100" type="submit">S'inscrire</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-4 text-center">
        <p>Vous avez déjà un compte ?</p>
        <a href="login" class="btn btn-outline-primary">Se connecter</a>
</div></div></div></div></div>

@endsection()
