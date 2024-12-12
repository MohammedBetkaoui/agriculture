<title>Admin | All product</title>

<x-app-layout>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="table/css/style.css">
  </head>
  <body>
  <section class="ftco-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!-- Messages de session -->
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
                  <td>{{$product->type_vente}}</td>
                  <td>{{$product->categorie->libelle}}</td>
                  <td>
                    <form action="{{ route('destroy', $product->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?');">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
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
