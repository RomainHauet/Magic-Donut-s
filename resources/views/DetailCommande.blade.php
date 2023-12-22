@extends('commun/footer')

@section('title','Detail de commande')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Nos Produits</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="/nos-produits" method="post">
                    @csrf
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Libellé</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Visible</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Produits as $Produit)
                                <tr>
                                    <td>{{ $Produit->lib_P }}</td>
                                    <td>{{ $Produit->prix_P }}</td>
                                    <td>
                                        <input type="hidden" name="id_P[]" value="{{ $Produit->id_P }}">
                                        <input type="checkbox" name="stock_P[]" {{ $Produit->stock_P ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <a href="/nos-produits/{{ $Produit->id_P }}/edit" class="btn btn-primary">Modifier</a>
                                        <a href="/nos-produits/{{ $Produit->id_P }}/delete" class="btn btn-danger">Supprimer</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>