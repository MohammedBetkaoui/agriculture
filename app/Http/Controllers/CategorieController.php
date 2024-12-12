<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('ajouter_produit', compact('categories'));
    }

   public function ajouter_categorie(){

    return view('ajouter_categorie');

   }


   public function all_categorie(){

     $categories= Categorie::all();

    return view('all_categorie',compact('categories'));
   }

   public function store(Request $request)
{
    // Vérifier si l'utilisateur est administrateur
    $admin = Auth::user();
    if (!$admin || $admin->role !== 'admin') {
        return redirect()->back()->with('error', 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.');
    }

    // Personnalisation des messages d'erreur de validation
    $messages = [
        'libelle.required' => 'Le champ Libellé est requis.',
        'libelle.string' => 'Le champ Libellé doit être une chaîne de caractères.',
        'libelle.unique' => 'Ce Libellé existe déjà.',
        'icon.required' => 'Le champ Image est requis.',
        'icon.image' => 'Le fichier doit être une image.',
        'icon.mimes' => 'Le fichier doit être au format jpeg, png, jpg ou gif.',
        'icon.max' => 'La taille maximale du fichier est de 2048 Ko.',
    ];

    // Validation des données du formulaire
    $validator = Validator::make($request->all(), [
        'libelle' => 'required|string|unique:categories',
        'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], $messages);

    // En cas d'échec de la validation, redirection avec les erreurs
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Enregistrement de la catégorie
    $categorie = new Categorie();

    $categorie->libelle = $request->libelle;
    $imageName = time() . '.' . $request->icon->extension();
    $request->icon->move(public_path('images/categories'), $imageName);
    $categorie->photo = $imageName;
    $categorie->save();

    return redirect()->route('all_categorie')->with('success', 'Catégorie ajoutée avec succès.');
}


   public function edit(Categorie $categorie){
        
    return  view('edit_categorie',compact('categorie'));

   }

   public function update(Request $request, Categorie $categorie)
{
    // Vérifier si l'utilisateur est administrateur
    $admin = Auth::user();
    if (!$admin || $admin->role !== 'admin') {
        return response()->json(['error' => 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.'], 403);
    }

    // Validation des données
    $request->validate([
        'libelle' => 'required|string|unique:categories,libelle,' . $categorie->id,
        'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'libelle.required' => 'Le libellé est requis.',
        'libelle.string' => 'Le libellé doit être une chaîne de caractères.',
        'libelle.unique' => 'Ce libellé est déjà utilisé pour une autre catégorie.',
        'icon.image' => 'Le fichier doit être une image.',
        'icon.mimes' => 'Le fichier doit être de type jpeg, png, jpg ou gif.',
        'icon.max' => 'La taille maximale du fichier est de 2048 kilo-octets.',
    ]);

    // Mise à jour de la catégorie
    $categorie->libelle = $request->libelle;
    
    if ($request->hasFile('icon')) {
        $imageName = time() . '.' . $request->icon->extension();
        $request->icon->move(public_path('images/categories'), $imageName);
        $categorie->photo = $imageName;
    }
    $categorie->save();

    // Envoyer un message de confirmation à la session
    session()->flash('success', 'La catégorie a été mise à jour avec succès.');

    // Rediriger vers la page des catégories
    return redirect('categories');
}

   

    public function destroy(Categorie $categorie)
{
    // Vérifier si l'utilisateur est administrateur
    $admin = Auth::user();
    if (!$admin || $admin->role !== 'admin') {
        return response()->json(['error' => 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.'], 403);
    }

    // Suppression de la catégorie
    $categorie->delete();

    // Redirection avec message de succès
    return redirect()->route('all_categorie')->with('success', 'Catégorie supprimée avec succès.');
}
}
