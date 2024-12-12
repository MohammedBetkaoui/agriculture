
       

    
    <title> profile | Ajouter produit</title>

<x-app-layout>
<!doctype html>
    <html lang="en">
    <head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/form.css') }}">
        </head>
        <body>
       
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                   

                    <div class="formbold-main-wrapper">
                     
                        <div class="formbold-form-wrapper">
                           <!-- Messages de succès et d'erreur -->
                   
                            <form action="{{Route('ajouter_produit')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="formbold-input-flex">
                                    <div>
                                        <label for="libelle" class="formbold-form-label">Libellé</label>
                                        <input
                                            type="text"
                                            name="libelle"
                                            id="libelle"
                                            placeholder="Libellé"
                                            class="formbold-form-input @error('libelle') is-invalid @enderror"
                                            value="{{ old('libelle') }}"
                                        />
                                        @error('libelle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="prix" class="formbold-form-label">Prix</label>
                                        <input
                                            type="text"
                                            name="prix"
                                            id="prix"
                                            placeholder="Prix"
                                            class="formbold-form-input @error('prix') is-invalid @enderror"
                                            value="{{ old('prix') }}"
                                        />
                                        @error('prix')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="formbold-input-flex">
                                    <div>
                                        <label class="formbold-form-label">Catégories</label>
                                        <select class="formbold-form-input" name="id_categorie" id="id_categorie">
                                            @foreach($categories as $categorie)
                                                <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_categorie')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="formbold-form-label">Type de vente</label>
                                        <select class="formbold-form-input" name="type_vente" id="type_vente">
                                            <option value="normal" selected>Normal</option>
                                            <option value="enchere">Enchère</option>
                                        </select>
                                        @error('type_vente')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="formbold-input-flex">
                                    <div>
                                        <label id="label-datedebut" for="date_debut" class="formbold-form-label">Date de Début</label>
                                        <input
                                            type="datetime-local"
                                            name="date_debut"
                                            id="date_debut"
                                            class="formbold-form-input @error('date_debut') is-invalid @enderror"
                                            value="{{ old('date_debut') }}"
                                        />
                                        @error('date_debut')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label id="label-datefin" for="date_fin" class="formbold-form-label">Date de Fin</label>
                                        <input
                                            type="datetime-local"
                                            name="date_fin"
                                            id="date_fin"
                                            class="formbold-form-input @error('date_fin') is-invalid @enderror"
                                            value="{{ old('date_fin') }}"
                                        />
                                        @error('date_fin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="formbold-input-flex">
                                    <div>
                                        <label for="photo1" class="formbold-form-label">Photo 1</label>
                                        <input
                                            type="file"
                                            name="photo1"
                                            id="photo1"
                                            class="formbold-form-file @error('photo1') is-invalid @enderror"
                                        />
                                        @error('photo1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="photo2" class="formbold-form-label">Photo 2</label>
                                        <input
                                            type="file"
                                            name="photo2"
                                            id="photo2"
                                            class="formbold-form-file @error('photo2') is-invalid @enderror"
                                        />
                                        @error('photo2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="formbold-mb-3">
                                    <label for="description" class="formbold-form-label">Description</label>
                                    <textarea
                                        rows="6"
                                        name="description"
                                        id="description"
                                        class="formbold-form-input @error('description') is-invalid @enderror"
                                    >{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="formbold-btn">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>


<script>
    // Récupérer les éléments select et les champs de date
    document.addEventListener('DOMContentLoaded', function() {
    const selectTypeVente = document.getElementById('type_vente');
    const dateDebut = document.getElementById('date_debut');
    const dateFin = document.getElementById('date_fin');
    const labelDateDebut = document.getElementById('label-datedebut');
const labelDateFin = document.getElementById('label-datefin');
labelDateDebut.style.display = 'none';
labelDateFin.style.display = 'none';
    dateDebut.style.display = 'none';
    dateFin.style.display = 'none';

    selectTypeVente.addEventListener('change', function() {
        if (selectTypeVente.value === 'enchere') {
            dateDebut.style.display = 'block';
            dateFin.style.display = 'block';
            labelDateDebut.style.display = 'block';
labelDateFin.style.display = 'block';
        } else {
            dateDebut.style.display = 'none';
            dateFin.style.display = 'none';
           
labelDateDebut.style.display = 'none';
labelDateFin.style.display = 'none';

        }
    });
});
</script>




