
<title>Profile | All_product</title>

<x-app-layout>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="{{ asset('table/css/style.css') }}">
  </head>
  <body>
    
  <section class="ftco-section">
    <div class="container">
      
      <!-- Affichage des messages d'erreur -->
      @if(session('error'))
      <div class="alert alert-danger" role="alert">
        {{ session('error') }}
      </div>
      @endif
      @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif
      
      <div class="row">
        <div class="col-md-12">
          <div class="table-wrap">
            <table class="table">
              <thead class="thead-primary">
                <tr>
                  <th>Images</th>
                  <th>Libelle</th>
                  <th>Description</th>
                  <th>Prix</th>
                  <th>Type de vente</th>
                  <th>Categorie</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($produits as $product)
               
                <tr class="alert" role="alert">
                  <td>
                    <div class="img" style="background-image: url(images/produits/{{$product->photo1}});"></div>
                  </td>
                  <td>{{$product->libelle}}</td>
                  <td>{{$product->description}}</td>
                  <td>{{$product->prix}}</td>
                  <td>{{$product->type_vente}} <br>
                  @if($product->type_vente =='enchere')
                  @if(now() > $product->date_debut && now() < $product->date_fin)
                                            <button style="background-color: green; color: white; border: none; padding: 2px 5px; border-radius: 3px; font-size: 10px; margin-left: 10px;">Enchère démarrée</button>
                                            @elseif(now() < $product->date_debut)
                                            <button style="background-color: yellow; color: black; border: none; padding: 2px 5px; border-radius: 3px; font-size: 10px; margin-left: 10px;">Non démarrée</button>
                                            @elseif(now() > $product->date_fin)
                                            <button style="background-color: red; color: white; border: none; padding: 2px 5px; border-radius: 3px; font-size: 10px; margin-left: 10px;">Enchère terminée</button>
                                            @endif
                                            @endif
                </td>
                
                  <td>{{$product->categorie->libelle}}</td>
                  <td>
                    <form action="{{ route('destroy', $product->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{$product->libelle}}?');">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
                          @if($product->type_vente == 'enchere' && $product->date_debut > now() || $product->type_vente == 'normal') 
                    <a href="{{ route('edit', $product->id) }}" class="btn btn-primary btn-sm" style="display:inline;">
                      <i class="fa fa-pencil"></i>
                    </a>
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

  <script src="table/js/jquery.min.js"></script>
  <script src="table/js/popper.js"></script>
  <script src="table/js/bootstrap.min.js"></script>
  <script src="table/js/main.js"></script>

  </body>
</html>
</x-app-layout>
