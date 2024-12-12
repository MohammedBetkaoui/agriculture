<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>recherche : {{ request()->input('query') }}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Include the Navbar -->
    @include('navbar')
    <style>
        .featured__item {
            border: 1px solid #ddd; /* Couleur de la bordure */
            border-radius: 5px; /* Arrondir les coins */
            overflow: hidden; /* Assurez-vous que le contenu reste dans les bordures */
            margin-bottom: 30px; /* Espace en bas du cadre */
            transition: all 0.3s ease; /* Transition pour les effets de survol */
        }

        .featured__item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre au survol */
        }
    </style>

    <!-- Featured Section Begin -->
    <section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Résultats de recherche</h2>
                </div>
                @if($products->isEmpty())
                    <h6>Aucun produit trouvé pour "{{ request()->input('query') }}"</h6>
                @else
                    <div class="row featured__filter">
                        @foreach ($products as $produit)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix {{ strtolower(str_replace(' ', '-', $produit->categorie->libelle)) }}">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="images/produits/{{$produit->photo1}}">
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="{{route('details_produit', $produit->id)}}"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h5><a href="#">{{$produit->libelle}}</a></h5>
                                    <h6>{{$produit->prix}}</h6>
                                    <span><b>Categorie : </b>{{$produit->categorie->libelle}}</span><br>
                                    <div style="display: flex; align-items: center;">
                                        <span><b>Type de vente :</b> {{$produit->type_vente}}</span>
                                        @if($produit->type_vente == 'enchere')
                                        @php
                                            $now = \Carbon\Carbon::now();
                                            $isEnchereStarted = $now->between($produit->date_debut, $produit->date_fin);
                                            $isEnchereEnded = $now->gt($produit->date_fin);
                                        @endphp
                                        @if($isEnchereStarted)
                                        <button style="background-color: green; color: white; border: none; padding: 2px 5px; border-radius: 3px; font-size: 10px; margin-left: 10px;">Enchère démarrée</button>
                                        @elseif($isEnchereEnded)
                                        <button style="background-color: red; color: white; border: none; padding: 2px 5px; border-radius: 3px; font-size: 10px; margin-left: 10px;">Enchère terminée</button>
                                        @else
                                        <button style="background-color: yellow; color: black; border: none; padding: 2px 5px; border-radius: 3px; font-size: 10px; margin-left: 10px;"> Non démarrée</button>
                                        @endif
                                        @endif
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

    <!-- Featured Section End -->

   @include('section1_')
   @include('section2')
   @include('blog')
   @include('footer')
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>
