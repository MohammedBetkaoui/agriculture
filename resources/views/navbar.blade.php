<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <header class="header">
        <header class="header">
            <div class="header__top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="header__top__left">
                                <ul>
                                    <li><i class="fa fa-envelope"></i> Agriculteur@email.com</li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="header__top__right">
                                <div class="header__top__right__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-pinterest-p"></i></a>
                                </div>
                                
                                
                                
                                @if(!Auth::user())
                                <div class="header__top__right__language">
                                     
                                    <div class="header__top__right__auth">
                                      
                                    <a href="{{route('register')}}"><i class="fa fa-user"></i> S'inscrire</a>
                                </div>
                                   
                                   
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="{{route('login')}}"><i class="fa fa-user"></i> Connexion</a>
                                </div>

                                @elseif(Auth::user())
                                <div class="header__top__right__language">
                                <i class="fa fa-user"></i>
                                    <div>{{Auth::user()->name}}</div>
                                    <span class="arrow_carrot-down"></span>
                                    <ul>
                                        
                                        <li>  <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link></li>
                                       
                                        


                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="header__logo">
                        <a href="{{ route('home') }}"><img style="height: 70px; width: 100px" src="{{ asset('img/logo.png') }}" alt="Logo"></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <nav class="header__menu">
                            <ul>

                                <li class="active"><a href="{{Route('home')}}">Accueil</a></li>

                               @if(!Auth::user() || Auth::user()->role=='client')
                                <li><a href="{{route('contact')}}">Contact</a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                   
                </div>
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>
        

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Toute Catégorie</span>
                        </div>
                        <ul>
                            @foreach ($categories as $categorie)
                                <li><a href="{{Route('produitcat',$categorie->id)}}">{{$categorie->libelle}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                    <div class="hero__search__form">
                               <form action="{{ route('search') }}" method="GET">
                                   <div class="hero__search__categories">
                                   </div>
                                   <input type="text" name="query" placeholder="De quoi avez-vous besoin ?">
                                   <button type="submit" class="site-btn">RECHERCHE</button>
                               </form>
                           </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>035742265</h5>
                                <span>support 24/7</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" style="width: 899px; height: 500px" data-setbg="{{ asset('img/hero/banner.jpg') }}">

                    <div class="hero__text">
    <h2 style="color: green;">Bienvenue dans votre monde <br /><h2>100% agricole</h2></h2>
</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->