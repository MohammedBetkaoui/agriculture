
<title>produit_enchere</title>

<x-app-layout>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('table-09/css/style.css') }}">
    </head>
    <body>
        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-wrap">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Libelle</th>
                                        <th>Utilisateurs participants</th>
                                        <th>Celui avec la meilleure offre</th>
                                        <th>Offre</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produits as $produit)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('images/produits/' . $produit->photo1) }}" alt="Produit Image" style="width: 100px; height: auto;">
                                        </td>
                                        <td>{{ $produit->libelle }}</td>
                                        <td>
                                            @if($produit->participants->isEmpty())
                                                Aucun participant
                                            @else
                                                <ul>
                                                    @foreach($produit->participants as $participant)
                                                    <li>{{ $participant->name }}</li>
                                                    <li><b>Contact :</b> {{ $participant->num_tlf }}</li>
                                                    @if(!$loop->last)
                                                        <hr>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>
                                            @if($produit->userOffreMax)
                                            {{ $produit->userOffreMax->name }} <br>
                                            <span><b>Contact :</b></span> {{ $produit->userOffreMax->num_tlf }}
                                            @else
                                            Aucune offre
                                            @endif
                                        </td>
                                        <td>
                                            @if($produit->userOffreMax)
                                            {{ $produit->offreMax }}
                                            @else
                                            Aucune offre
                                            @endif
                                        </td>
                                        <td>
                                            @if(now() > $produit->date_debut && now() < $produit->date_fin)
                                            <button style="background-color: green; color: white; border: none; padding: 2px 5px; border-radius: 3px; font-size: 10px; margin-left: 10px;">Enchère démarrée</button>
                                            @elseif(now() < $produit->date_debut)
                                            <button style="background-color: yellow; color: black; border: none; padding: 2px 5px; border-radius: 3px; font-size: 10px; margin-left: 10px;">Enchère Non démarrée</button>
                                            @elseif(now() > $produit->date_fin)
                                            <button style="background-color: red; color: white; border: none; padding: 2px 5px; border-radius: 3px; font-size: 10px; margin-left: 10px;">Enchère terminée</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="{{ asset('tab/js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
    </html>
</x-app-layout>
