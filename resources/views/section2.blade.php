<section class="latest-product spad">
        <style>
            .product-image {
    width: 100%;
    height: 200px; /* Ajustez la hauteur selon vos besoins */
    object-fit: cover; /* Cette propriété permet de garder le ratio et de remplir l'espace */
}

        </style>
    <div class="container">
        <div class="row">
            <!-- Derniers Produits -->
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Derniers Produits</h4>
                    <div class="latest-product__slider owl-carousel">
                        @foreach ($latestProducts as $chunkedProducts)
        
                            <div class="latest-prdouct__slider__item">
                                @foreach ($chunkedProducts as $produit)
                                    <a href="{{route('details_produit', $produit->id)}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="height: 100px; width:100px" class="product-image" src="{{ asset('images/produits/' . $produit->photo2) }}">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $produit->libelle }}</h6>
                                            <span>{{ $produit->prix }} </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Produits de type enchère -->
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Produits de type enchère</h4>
                    <div class="latest-product__slider owl-carousel">
                        @foreach ($auctionProducts as $chunkedProducts)
                            <div class="latest-prdouct__slider__item">
                                @foreach ($chunkedProducts as $produit)
                                    <a href="{{route('details_produit', $produit->id)}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="height: 100px; width:100px" class="product-image" src="{{ asset('images/produits/' . $produit->photo2) }}">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $produit->libelle }}</h6>
                                            <span>{{ $produit->prix }} </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Produits de type normal -->
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Produits de type normal</h4>
                    <div class="latest-product__slider owl-carousel">
                        @foreach ($normalProducts as $chunkedProducts)
                            <div class="latest-prdouct__slider__item">
                                @foreach ($chunkedProducts as $produit)
                                    <a href="{{route('details_produit', $produit->id)}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="height: 100px; width:100px" class="product-image" src="{{ asset('images/produits/' . $produit->photo2) }}">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $produit->libelle }}</h6>
                                            <span>{{ $produit->prix }} </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>