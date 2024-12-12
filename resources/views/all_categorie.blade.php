<title>Admin | Tout Categories</title>

<x-app-layout>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/cate.css') }}">


  </head>
  <body>
  <style>
      
   </style>
  <section class="ftco-section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <!-- Messages de succès et d'erreur -->
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
                  <th>Libelle</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $cate)
                <tr class="alert" role="alert">
                  <td>{{$cate->libelle}}</td>
                  <td>
                    <form action="{{ route('categorie_destroy', $cate->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?');">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
                    <a href="{{ route('show_categorie', $cate->id) }}" class="btn btn-primary btn-sm" style="display:inline;">
                      <i class="fa fa-pencil"></i>
                    </a>
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

