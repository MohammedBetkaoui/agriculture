<title>profile | edit product</title>
<x-app-layout>
<div class="formbold-main-wrapper">
  <div class="formbold-form-wrapper">
    <form action="{{ route('update', $produit->id) }}" method="POST" enctype="multipart/form-data">
       @csrf

      <div class="formbold-input-flex">
        <div>
          <label for="firstname" class="formbold-form-label">Libelle </label>
          <input
            type="text"
            name="libelle"
            id="firstname"
            placeholder="Libelle"
            value="{{ $produit->libelle }}"
            class="formbold-form-input"
          />
          @error('libelle')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="lastname" class="formbold-form-label"> Prix </label>
          <input
            type="text"
            name="prix"
            id="lastname"
            placeholder="Prix"
            value="{{ $produit->prix }}"
            class="formbold-form-input"
          />
          @error('prix')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="formbold-input-flex">
        <div>
          <label class="formbold-form-label">Catégories</label>
          <select class="formbold-form-input" name="id_categorie" id="occupation">
            @foreach($categories as $categorie)
              @if($categorie->id == $produit->id_categorie)
                <option value="{{ $categorie->id }}" selected>{{ $categorie->libelle }}</option>
              @else
                <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
              @endif
            @endforeach
          </select>
          @error('id_categorie')
            <span class="text-danger">{{ $message }}</span>
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
          <label class="formbold-form-label">Photo 1</label>
          <input
            type="file"
            name="photo1"
            id="upload"
            value="{{ $produit->photo1 }}"
            class="formbold-form-file"
          />
          @error('photo1')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label class="formbold-form-label">Photo 2</label>
          <input
            type="file"
            name="photo2"
            id="upload"
            value="{{ $produit->photo2 }}"
            class="formbold-form-file"
          />
          @error('photo2')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="formbold-mb-3">
        <label for="message" class="formbold-form-label">Description</label>
        <textarea
          rows="6"
          name="description"
          id="message"
          class="formbold-form-input"
        >{{ $produit->description }}</textarea>
        @error('description')
          <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit" class="formbold-btn">Appliquer</button>
    </form>
  </div>
</div>
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





























<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  body {
    font-family: 'Inter', sans-serif;
  }
  .formbold-mb-3 {
    margin-bottom: 15px;
  }

  .formbold-main-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px;
  }

  .formbold-form-wrapper {
    margin: 0 auto;
    max-width: 570px;
    width: 100%;
    background: white;
    padding: 40px;
  }

  .formbold-img {
    display: block;
    margin: 0 auto 45px;
  }

  .formbold-input-wrapp > div {
    display: flex;
    gap: 20px;
  }

  .formbold-input-flex {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
  }
  .formbold-input-flex > div {
    width: 50%;
  }
  .formbold-form-input {
    width: 100%;
    padding: 13px 22px;
    border-radius: 5px;
    border: 1px solid #dde3ec;
    background: #ffffff;
    font-weight: 500;
    font-size: 16px;
    color: #536387;
    outline: none;
    resize: none;
  }
  .formbold-form-input::placeholder,
  select.formbold-form-input,
  .formbold-form-input[type='date']::-webkit-datetime-edit-text,
  .formbold-form-input[type='date']::-webkit-datetime-edit-month-field,
  .formbold-form-input[type='date']::-webkit-datetime-edit-day-field,
  .formbold-form-input[type='date']::-webkit-datetime-edit-year-field {
    color: rgba(83, 99, 135, 0.5);
  }

  .formbold-form-input:focus {
    border-color: #6a64f1;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }
  .formbold-form-label {
    color: #07074D;
    font-weight: 500;
    font-size: 14px;
    line-height: 24px;
    display: block;
    margin-bottom: 10px;
  }

  .formbold-form-file-flex {
    
    align-items: center;
    gap: 20px;
  }
  .formbold-form-file-flex .formbold-form-label {
    margin-bottom: 0;
  }
  .formbold-form-file {
    font-size: 10px;
    line-height: 24px;
    color: #536387;
  }
  .formbold-form-file::-webkit-file-upload-button {
    display: none;
  }
  .formbold-form-file:before {
    content: 'Upload file';
    display: inline-block;
    background: #EEEEEE;
    border: 0.5px solid #FBFBFB;
    box-shadow: inset 0px 0px 2px rgba(0, 0, 0, 0.25);
    border-radius: 3px;
    padding: 3px 12px;
    outline: none;
    white-space: nowrap;
    cursor: pointer;
    color: #637381;
    font-weight: 500;
    font-size: 12px;
    line-height: 16px;
    margin-right: 10px;
  }

  .formbold-btn {
    text-align: center;
    width: 100%;
    font-size: 16px;
    border-radius: 5px;
    padding: 14px 25px;
    border: none;
    font-weight: 500;
    background-color: #6a64f1;
    color: white;
    cursor: pointer;
    margin-top: 25px;
  }
  .formbold-btn:hover {
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .formbold-w-45 {
    width: 45%;
  }
</style>

