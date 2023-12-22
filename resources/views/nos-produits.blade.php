@extends('commun/footer')

@section('title','Nos Produits')

@section('content')

@auth
    @if( Auth::user()->admin_U == true )
        <h1 class="text-primary fw-bold my-3 text-center">Ajouter un produit</h1>

        <form id="formAdmin" action="/nos-produits" method="post" class="row g-3 m-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="col-md-1">
                <label for="lib_P" class="form-label">Nom</label>
                <input class="form-control" type="text" name="lib_P" id="lib_P" required>
            </div>
   
            <div class="col-md-1">
                <label for="gout_P" class="form-label">Gout</label>
                <input class="form-control" type="text" name="gout_P" id="gout_P" required>
            </div>

            <div class="col-md-1">
                <label for="etat_P" class="form-label">Etat</label>
                <select class="form-select" aria-label="Default select example" name="etat_P" id="etat_P" required>
                    <option selected value="Tiède">Tiède</option>
                    <option          value="Froid">Froid</option>
                    <option          value="Chaud">Chaud</option>
                </select>
            </div>

            <div class="col-md-1">
                <label for="taille_P" class="form-label">Taille</label>
                <select class="form-select" aria-label="Default select example" name="taille_P" id="taille_P" required>
                    <option selected value="Moyen">Moyen</option>
                    <option          value="Grand">Grand</option>
                    <option          value="Petit">Petit</option>
                </select>
            </div>

            <div class="col-md-1">
                <label for="prix_P" class="form-label" >Prix</label>
                <input type="number" name="prix_P" id="prix_P" class="form-control" step="0.01" required>
            </div>

            <div class="col-md-2">
                <label for="allergene_P" class="form-label">Description (allergènes)</label>
                <input type="text" name="allergene_P" id="allergene_P" class="form-control" required>
            </div>

            <div class="col-md-2">
                <label for="image_P" class="form-label">Image</label>
                <input type="file" name="image_P" id="image_P" class="form-control form-control-sm" required>
            </div>

            <div class="col-md-2">
                <label for="stock_P" >Stock</label>
                <input type="checkbox" name="stock_P" id="stock_P" class="form-check-input" checked>
            </div>

            <div class="col-md-1 " class="form-label">
                <input type="submit" value="Ajouter" class="btn btn-primary">
            </div>
        </form>
    @endif
@endauth

@if(!$Produits->isEmpty())
    <div class="d-flex flex-nowrap z-index-4 "  style="width:99%;">
        <div id="sidebar" class="d-flex flex-column flex-shrink-0 p-sm-2 p-md-3 text-bg-dark pt-2" style=" width: 22%; position:fixed">
            <ul id="menuList" class="nav nav-pills flex-column mb-auto">
                <li class="nav-item fs-4 fs-md-3 "> 
                    <a href="#Tendance" class="nav-link active mb-2 mb-md-4" aria-current="page">
                        <!--<svg class="bi pe-none me-4" width="25" height="25">
                            <use xlink:href="#home"></use>
                        </svg>-->
                        Tendances
                    </a>
                </li>

                @foreach( $Categories as $categorie )
                    <li class="nav-item fs-4 fs-md-4"> 
                        <a href="#{{ $categorie->lib_P }}" class="nav-link mb-2 mb-md-4" aria-current="page">
                            <!--<svg class="bi pe-none me-4" width="25" height="25">
                                <use xlink:href="#home"></use>
                            </svg>-->
                            {{ $categorie->lib_P }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        @auth
            @if( Auth::user()->admin_U == true )
                <form class="w-100" action = "/nos-produits" method = "post" style="padding-left:25%;">
                @csrf
                @method('POST')
            
            @else
                <div class="w-100" style="padding-left:25%;">
            @endif
        @endauth
        @guest
            <div class="w-100" style="padding-left:25%;">
        @endguest

            <div id="Tendance">
                <br/>
                <h2 class="text-center text-md-start">Tendance du moment</h2>
                <br/>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach( $ProduitsTendance as $produitTendance )
                    <div class="col">
                        <div class="card shadow-sm m-3">
                            <img class="bd-placeholder-img card-img-top" width="auto" height="auto" style="object-fit: cover;" src="media/{{ $produitTendance->image_P }}" focusable="false">
                            <div class="card-body text-center">
                                <h3 class="text-center text-black">                                         {{ $produitTendance->lib_P }}</h3>
                                <h4 class="text-center text-black">                                         {{ $produitTendance->gout_P }}</h4>
                                @auth
                                    @if ($produitTendance->stock_P && !(Auth::user()->admin_U))
                                        <!-- s'il est connecté et que le produit est en stock, il peut aller le voir en cliquant sur le bouton -->
                                        <a class="btn btn-secondary text-white text-center" href="#{{ $produitTendance->id_P }}">Voir le produit</a>

                                    @elseif (!($produitTendance->stock_P) && !(Auth::user()->admin_U))
                                        <!-- s'il est connecté et que le produit est en stock il peut l'ajouter au panier -->
                                        <a class="btn btn-secondary text-white text-center">Indisponible</a>
                                    @endif
                                @endauth

                                @guest
                                    @if ($produitTendance->stock_P > 0)
                                        <!-- s'il est connecté et que le produit est en stock il peut l'ajouter au panier -->
                                        <a class="btn btn-secondary text-white text-center">Disponible</a>
                                    @else
                                        <!-- s'il est connecté et que le produit n'est pas en stock il ne peut pas l'ajouter au panier -->
                                        <checkbox class="btn btn-secondary text-white text-center">Hors stock</checkbox>
                                    @endif
                                @endguest

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $produitTendance->id_P }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Informations produits</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p> Allergene : <b>{{ $produitTendance->allergene_P }}</b></p>
                                                <p> Etat :<b>{{ $produitTendance->etat_P }}</b></p>
                                                <p> Taille : <b>{{ $produitTendance->taille_P }}</b></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

            </div>

            @php
                $i = 0;
                $temp = $Produits[$i]->lib_P;
            @endphp

            <div id="@php echo $temp; @endphp">
                <br/>
                <h2 class="text-center text-md-start">Nos @php echo $temp; @endphps</h2>
                <br/>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($Produits as $produit)

                    @if( strcmp($Produits[$i]->lib_P, $temp) )
                        @php
                            $temp = $Produits[$i]->lib_P;
                        @endphp
                            </div>
                        </div>
                        <div id="@php echo $temp; @endphp">
                            <br/>
                            <h2 class="text-center text-md-start">Nos @php echo $temp; @endphps</h2>
                            <br/>
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @endif
                    
                    @php $i++; @endphp    
                    <div class="col" id="{{ $produit->id_P }}">
                        <div class="card shadow-sm m-3">
                            
                            <img class="bd-placeholder-img card-img-top" width="auto" height="auto" style="object-fit: cover;"
                                src="media/{{ $produit->image_P}}" focusable="false">
                            <div class="card-body text-center">
                                @auth
                                    @if( Auth::user()->admin_U == true )
                                        <input type="hidden" name="id_P[]"        value="{{ $produit->id_P }}">
                                        <input type="text"   name="gout_P[]"      value="{{ $produit->gout_P }}"      class="form-control form-control-sm" required>
                                        <select class="form-select" aria-label="Default select example" name="taille_P[]" required>
                                            <option @if($produit->taille_P == "Moyen") selected @endif value="Moyen">Moyen</option>
                                            <option @if($produit->taille_P == "Grand") selected @endif value="Grand">Grand</option>
                                            <option @if($produit->taille_P == "Petit") selected @endif value="Petit">Petit</option>
                                        </select>
                                        <select class="form-select" aria-label="Default select example" name="etat_P[]" value="{{ $produit->etat_P }}" required>
                                            <option @if($produit->etat_P == "Tiède") selected @endif value="Tiède">Tiède</option>
                                            <option @if($produit->etat_P == "Froid") selected @endif value="Froid">Froid</option>
                                            <option @if($produit->etat_P == "Chaud") selected @endif value="Chaud">Chaud</option>
                                        </select>
                                        <input type="number" name="prix_P[]"      value="{{ $produit->prix_P }}"             class="form-control form-control-sm" step="0.01" required>
                                        <input type="text"   name="allergene_P[]" value="{{ $produit->allergene_P }}"        class="form-control form-control-sm"             required>
                                        <input type="file"   name="image_P[]"                                                class="form-control form-control-sm"                     >

                                        <!-- bouton radio pour le stock -->
                                        <label>En stock</label>
                                        <input type="radio" name="stock_P[{{ $produit->id_P }}]" id ="stock_P_yes" value="1" @if($produit->stock_P) checked @endif>
                                        <label >Hors stock</label>
                                        <input type="radio" name="stock_P[{{ $produit->id_P }}]" id ="stock_P_no" value="0" @if(!($produit->stock_P)) checked @endif>


                                        <!-- bouton suprimer le produits -->
                                        <a class="btn btn-secondary text-white text-center" href="/suprimer-Produit-{{ $produit->id_P }}">Supprimer</a>

                                    <!-- Connecté mais pas en mode admin  -->
                                    @elseif ($produit->stock_P)
                                        <input type="hidden" name="id_P" value="{{ $produit->id_P }}">
                                        <h3 class="text-center text-black">{{ $produit->lib_P }}</h3>
                                        <h4 class="text-center text-black">{{ $produit->gout_P }}</h4>
                                        <h3 class="text-center text-black" id="prix_{{ $produit->id_P }}">{{ $produit->prix_P }}€</h3>

                                        <!-- s'il est connecté et que le produit est en stock il peut l'ajouter au panier -->

                                        
                                        <form action ="/ajouter-Panier-{{ $produit->id_P}}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input name="id_P" type="hidden" value="{{ $produit->id_P }}">
                                            <input class="btn w-25 input-produit" name="qte_P" id="input_{{$produit->id_P}}" type="number" value="1" min="1" max="30" data-produit-id="{{$produit->id_P}}">
                                            <button type="submit" class="btn btn-secondary text-white text-center">Ajouter au panier</button>
                                            <i class="bi bi-info-circle-fill" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $produit->id_P }}" width="50px" height="50px"></i>

                                        </form>
                
                                        <!-- <a class="btn btn-secondary text-white text-center">Ajouter au panier</a> -->
                                    
                                    @elseif (!($produit->stock_P))
                                        <h3 class="text-center text-black">{{ $produit->lib_P }}</h3>
                                        <h4 class="text-center text-black">{{ $produit->gout_P }}</h4>
                                        <h3 class="text-center text-black" id="prix_{{ $produit->id_P }}">{{ $produit->prix_P }}€</h3>

                                        <!-- s'il est connecté et que le produit est en stock il peut l'ajouter au panier -->
                                        <a class="btn btn-secondary text-white text-center">Indisponible</a>

                                    @endif
                                @endauth

                                @guest
                                        <h3 class="text-center text-black">{{ $produit->lib_P }}</h3>
                                        <h4 class="text-center text-black">{{ $produit->gout_P }}</h4>
                                        <h3 class="text-center text-black" id="prix_{{ $produit->id_P }}">{{ $produit->prix_P }}€</h3>

                                    @if ($produit->stock_P > 0)
                                        <!-- s'il est connecté et que le produit est en stock il peut l'ajouter au panier -->
                                        <a class="btn btn-secondary text-white text-center">Disponible</a>
                                    @else
                                        <!-- s'il est connecté et que le produit n'est pas en stock il ne peut pas l'ajouter au panier -->
                                        <checkbox class="btn btn-secondary text-white text-center">Hors stock</checkbox>
                                    @endif
                                    
                                @endguest
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $produit->id_P }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Informations produits</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p> Allergene : <b>{{ $produit->allergene_P }}</b></p>
                                                <p> Etat :<b>{{ $produit->etat_P }}</b></p>
                                                <p> Taille : <b>{{ $produit->taille_P }}</b></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        @auth
            @if( Auth::user()->admin_U == true )
                <div class="col-md-1">
                    <input class="btn btn-secondary text-white text-center" type="submit" value="Mettre à jour tout les produits">
                </div>
                </form>
            @else
                </div>
            @endif
        @endauth
        @guest
            </div>
        @endguest
</div>
    </div>
@endif

<script>
    // Récupérer tous les liens de la liste
    const menuItems = document.querySelectorAll('#menuList .nav-link');

    // Ajouter un gestionnaire d'événements pour chaque lien
    menuItems.forEach(item => 
    {
        item.addEventListener('click', function (e) 
        {

            // Supprimer la classe 'active' de tous les liens
            menuItems.forEach(link => link.classList.remove('active'));

            // Ajouter la classe 'active' uniquement sur le lien clique
            this.classList.add('active');
        });
        
    });

    const inputs = document.querySelectorAll('.input-produit');
    inputs.forEach(function(input) 
    {
        const produitId    = input.dataset.produitId;
        const prixElement  = document.getElementById(`prix_${produitId}`);
        const prixInitial  = parseFloat(prixElement.textContent.replace('€', ''));

        input.addEventListener('input', function() 
        {
            const nouvelleQuantite  = parseFloat(input.value);
            const nouveauPrix       = prixInitial * nouvelleQuantite;
            prixElement.textContent = nouveauPrix.toFixed(2) + '€';
        });
    });
    


    window.addEventListener('scroll', function()
    {
        var sidebar = document.getElementById('sidebar');
        var header = document.getElementById('formAdmin');
        var footer  = document.querySelector ('footer');

        

        if (header == undefined) {
            header  = document.querySelector ('header');
        }

        var headerPosition = header.getBoundingClientRect().bottom;
        var footerPosition = footer.getBoundingClientRect().top;

        if (headerPosition > 0)
        {
            sidebar.style.top = (headerPosition) + 'px';
        }
        else if (footerPosition > window.innerHeight)
        {
            sidebar.style.top = '0';
        }
        else
        {
            sidebar.style.top = (- (window.innerHeight - footerPosition)) + 'px';
        }
    });

</script>
@endsection()

@extends('commun/header')
