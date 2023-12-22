@extends('commun/header')


@section('title','Login')

@section('content')

<div class="position-relative py-4 py-xl-5" >
    <div class="container position-relative">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4"><div class="card mb-3">
    <div class="card-body p-sm-5">
        <div class="text-center"><i class="bi bi-person-fill-check" style="font-size: 3rem;"></i></div>
        <h2 class="text-center mb-4">Se connecter</h2>
        <form action="{{ route('auth.login') }}" method="post">
            @csrf
            @method('post')
            <div class="mb-3">
                <label class="form-label" for="email_U">Adresse email</label>
                <input class="form-control" type="email" id="email_U" name="email_U" @if (session('email')) value="{{ session('email') }}" @endif required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="mdp_U">Mot de passe</label>
                <input class="form-control" type="password" id="mdp_U" name="mdp_U" required>
            </div>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="mb-3">
                <div class="row">
                    <div class="col"><button class="btn btn-primary d-block w-100" type="submit">Se connecter</button></div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="mt-4 text-center">
    <p>Vous n'avez pas de compte ?</p>
    <a href="register" class="btn btn-outline-primary">S'inscrire</a>
</div></div></div></div></div>
<script src="../styles/js/bootstrap.bundle.min.js"></script>

@endsection()
