
<title>Admin | All users</title>


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
                  <th>id</th>
                  <th>name</th>
                  <th>num_tlf</th>
                  <th>created_at</th>
                  <th>role</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr class="alert" role="alert">
                  <td>
                    {{$user->id}}
                  </td>
                 
                  <td>{{$user->name}}</td>
                  <td>{{$user->num_tlf}}</td>
                  <td>{{$user->created_at}}</td>
                  <td>{{$user->role}}</td>
                  <td>
                    <form action="{{ route('user_destroy', $user->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette Utilisateur?');">
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