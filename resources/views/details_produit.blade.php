<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>détails | {{$produit->libelle}}</title>
@include('navbar')

<section class="product-details spad">
    <div class="container">
        @if($errors->any())
            @foreach ($errors->all() as $item)
                <div class="alert alert-danger">
                    {{ $item }}
                </div>
            @endforeach
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{asset('images/produits/'.$produit->photo1)}}" style="height: 500px; width: 370px;" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="{{asset('images/produits/'.$produit->photo1)}}" 
                            src="{{asset('images/produits/'.$produit->photo2)}}" style="height: 95px; width: 130px;" alt="">
                        <img data-imgbigurl="{{asset('images/produits/'.$produit->photo1)}}"style="height: 95px; width: 130px;"
                            src="{{asset('images/produits/'.$produit->photo1)}}" alt="">
                        <img data-imgbigurl="{{asset('images/produits/'.$produit->photo2)}}"style="height: 95px; width: 130px;"
                            src="{{asset('images/produits/'.$produit->photo2)}}" alt="">
                        <img data-imgbigurl="{{asset('images/produits/'.$produit->photo1)}}"style="height: 95px; width: 130px;"
                            src="{{asset('images/produits/'.$produit->photo1)}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{$produit->libelle}}</h3>
                    @php
                        $maxOffre = $produit->offres()->orderBy('offre', 'desc')->first();
                        $now = now();
                        $dateFin = \Carbon\Carbon::parse($produit->date_fin);
                    @endphp

                    @if($produit->type_vente == 'enchere' && $maxOffre)
                        <div class="product__details__price">Offre maximale : {{ $maxOffre->offre }} </div>
                    @elseif($produit->type_vente == 'enchere' && !$maxOffre)
                        <div class="no-offer">
                            <div class="product__details__price">Aucune offre</div>
                        </div>
                    @endif
                    @if($produit->type_vente == 'normal')
                        <div class="product__details__price"> {{ $produit->prix }}</div>
                    @endif
                    <p>{{$produit->description}}</p>
                    
                    @if($produit->type_vente == 'enchere')
                        
                            @if($produit->date_debut < $now && $produit->date_fin > $now ) 
                                <div id="countdown" class="countdown-timer">
                                    <div class="countdown-header">
                                        <span>Jours</span>
                                        <span>Heures</span>
                                        <span>Minutes</span>
                                        <span>Secondes</span>
                                    </div>
                                    <table class="countdown-table">
                                        <tr>
                                            <td id="days"></td>
                                            <td id="hours"></td>
                                            <td id="minutes"></td>
                                            <td id="seconds"></td>
                                        </tr>
                                    </table>
                                </div>
                                <form action="{{route('offre', $produit->id)}}" method="post">
                                    @csrf
                                    <div class="product__details__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                @if($maxOffre)
                                                    <input type="text" name="offre" value="{{ $maxOffre->offre }}">
                                                @else
                                                    <input type="text" name="offre" value="{{ $produit->prix }}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;">
                                        <button type="submit" class="primary-btn">Soumettre votre offre</button>
                                    </div>
                                </form>
                                @endif
                               @if($produit->date_fin < $now )
                                <div style="text-align: center;">
                                <button class="primary-btn" style="background-color: red;" disabled>Enchère terminée</button>
                            </div> 
                            @endif
                           
                                     @if($produit->date_debut > $now )
                                <form action="{{ route('joinAuction', $produit->id) }}" method="post">
                                    @csrf
                                    <div style="text-align: center;">
                                        <button type="submit" class="primary-btn" style="background-color: red;">Participation à l'enchère</button>
                                    </div>
                                </form>
                               @endif
                               @endif
                           
                      
                      
                    
                          
                    <ul>
                        @if($produit->type_vente == 'enchere')
                            <li><b>Prix ​​de départ</b> <span>{{ $produit->prix }}</span></li>
                            <li><b>Date de debut</b> <span>{{ $produit->date_debut }}</span></li>
                            <li><b>Date de fin</b> <span>{{ $produit->date_fin }}</span></li>
                            <li><b>Contact</b> <span>{{$proprietaire->num_tlf}}</span></li>
                        @else
                            <li><b>Contact</b> <span>{{$proprietaire->num_tlf}}</span></li>
                            <li><b>Réseaux sociaux</b>
                                <div class="share">
                                    <a href="https://fr-fr.facebook.com/"><i class="fa fa-facebook"></i></a>
                                    <a href="https://x.com/?lang=fr&mx=2"><i class="fa fa-twitter"></i></a>
                                    <a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .countdown-timer {
        text-align: center;
        margin-bottom: 20px;
    }
    .countdown-header {
        display: flex;
        justify-content: space-around;
        margin-bottom: 10px;
    }
    .countdown-header span {
        font-weight: bold;
        font-size: 14px;
    }
    .countdown-table {
        width: 100%;
        border-collapse: collapse;
    }
    .countdown-table td {
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 20px;
        text-align: center;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Set the date we're counting down to
        var countDownDate = new Date("{{ $dateFin }}").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="countdown"
            document.getElementById("days").innerHTML = days;
            document.getElementById("hours").innerHTML = hours;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("seconds").innerHTML = seconds;

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "EXPIRED";
            }
        }, 1000);
    });
</script>






   @include('footer')

    <!-- Js Plugins -->
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('js/mixitup.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>


</body>

</html>