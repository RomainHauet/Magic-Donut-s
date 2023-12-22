@extends('commun/footer')

@section('title','Panier')

@section('content')
@guest

@endguest
<style>
    /* Style pour rendre l'input en lecture seule semblable à du texte */
    input[readonly] {
        border: none;
        background-color: transparent;
        outline: none;
        /* Ajoutez d'autres styles pour ressembler à du texte si nécessaire */
    }


</style>

    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    <h1 class="p-4">Mon Panier</h1>

    @if(Cart::count()>0)
    <section class="m-1 m-sm-3 m-md-5">
        <form action="/envoyerCommande" method="POST">
            @csrf
            @method('POST')
                @foreach(Cart::content() as $produit)
                
                <div class="border rounded align-items-center">
                    <div class="m-3 row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 g-3  ">
                        <div class="col">
                            <img class="rounded" width="105%" height="94%" style="object-fit: cover;" src="media/{{$produit->options->image_P}}"
                                alt="Image du donut">
                        </div>
                        
                        <div class="col m-3">

                            <input type="hidden" name="id_C[]" value="{{$produit->options->id_C}}" readonly>
                            <input type="hidden" name="id_P[]" value="{{$produit->id}}" readonly>

                    
                            <input type="hidden" name="gout_P[]" id="gout_P" readonly >           <p class="fs-1" >{{$produit->name}}</p></input>

                            <div class="m-3">
                            <input type="hidden" name="gout_P[]" id="gout_P" readonly>            <p class="fs-5" > Gout : {{$produit->options->gout_P}}</p></input>
                            <input type="hidden" name="taille_P[]" id="taille_P" readonly>        <p class="fs-5" > Taille : {{$produit->options->taille_P}} </p></input>
                            <input type="hidden" name="etat_P[]" id="etat_P" readonly>            <p class="fs-5" > État : {{$produit->options->etat_P}} </p></input>
                            <input type="hidden" name="allergene_P[]" id="allergene_P" readonly>  <p class="fs-5" > Allergenes :{{$produit->options->allergene_P}} </p></input>
                            <input type="hidden" name="prix_P[]" id="prix_P" readonly>            <p class="fs-5" > Prix : {{ number_format($produit->price * $produit->options->qte_P,2) }} € </p></input>

                            <input type="hidden" name="qte_a[]" id="qte_a" readonly>              <p class="fs-5" > Quantité : {{$produit->options->qte_P}} </p></input>
                            </div>
                            <button class="btn btn-primary" type="submit" formaction="/suprimer-Panier-{{$produit->rowId}}">
                                <i class="bi bi-trash"></i>
                            </button>


                        </div>
                    </div>
                </div>
            @endforeach


            <section class="text-center m-2">

                <!-- calcul le total de la commande avec des multiplication sans Cart -->
                <?php $total = 0; ?>
                @foreach(Cart::content() as $produit)
                <?php $total += $produit->price * $produit->options->qte_P; ?>
                @endforeach
                <h2 class="my-5">Total de la commande : {{ number_format($total, 2) }} €</h2>


                <a class="btn btn-secondary p-3 text-white text-center" href="/vider-Panier">Vider le panier</a>
                <button type="submit" class="btn btn-secondary p-3 text-white text-center">Commander</button>

                
                
            </section>

        </form>
    </section>
    @else
    <section class="m-1 m-sm-3 m-md-5">
        
        <div class="border rounded r">
            <div style="height:473px">
        
            </div>
        </div>

    </section>

    @endif
@endsection()

@extends('commun/header')