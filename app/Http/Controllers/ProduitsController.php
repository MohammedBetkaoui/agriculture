<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\offre;
use App\Models\user;
use App\Models\enchere_onlines;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProduitsController extends Controller
{
    
    
    public function index()
    {
        $produits = Produit::with(['categorie','proprietaire'])->get();

        $categories = Categorie::all();

        $latestProducts = Produit::orderBy('created_at', 'desc')->get()->chunk(3);
        $auctionProducts = Produit::where('type_vente', 'enchere')->orderBy('created_at', 'desc')->get()->chunk(3);
        $normalProducts = Produit::where('type_vente', 'normal')->orderBy('created_at', 'desc')->get()->chunk(3);
       
        
    
        return view('welcome', compact(['categories', 'produits','latestProducts','auctionProducts','normalProducts']));
    }
    
public function ajouter_produit(){

    $categories= Categorie::all();
    return view('ajouter_produit',['categories'=>$categories]);
}
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'libelle' => 'required|string|max:255',
        'type_vente' => 'required|string',
        'description' => 'required|string',
        'id_categorie' => 'required|exists:categories,id',
        'prix' => 'required|numeric',
        'date_debut' => $request->type_vente == 'normal' ? 'nullable|date' : 'required|date',
        'date_fin' => $request->type_vente == 'normal' ? 'nullable|date|after:date_debut' : 'required|date|after:date_debut',
        'photo1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'photo2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'required' => 'Le champ :attribute est requis.',
        'string' => 'Le champ :attribute doit être une chaîne de caractères.',
        'numeric' => 'Le champ :attribute doit être un nombre.',
        'date' => 'Le champ :attribute n\'est pas une date valide.',
        'after' => 'Le champ :attribute doit être postérieur à :date.',
        'exists' => 'Le champ :attribute sélectionné est invalide.',
        'max' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
        'image' => 'Le champ :attribute doit être une image.',
        'mimes' => 'Le champ :attribute doit être de type :values.',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $client = Auth::user();
    if (!$client || $client->role !== 'client') {
        return response()->json(['error' => 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.'], 403);
    }

    $produit = new Produit();
    $produit->libelle = $request->libelle;
    $produit->type_vente = $request->type_vente;
    $produit->id_categorie = $request->id_categorie;
    $produit->prix = $request->prix;
    $produit->description = $request->description;
    $produit->date_debut = $request->date_debut;
    $produit->date_fin = $request->date_fin;

    if ($request->hasFile('photo1') && $request->hasFile('photo2')) {
        $photo1Path = time() . '1.' . $request->file('photo1')->extension();
        $request->file('photo1')->move(public_path('images/produits'), $photo1Path);
    
        $photo2Path = time() . '2.' . $request->file('photo2')->extension();
        $request->file('photo2')->move(public_path('images/produits'), $photo2Path);
    
        $produit->photo1 = $photo1Path;
        $produit->photo2 = $photo2Path;
    } else {
        return back()->with('error', 'Les photos sont manquantes dans la demande');
    }

    $produit->id_proprietaire = Auth::id();
    $produit->save();

    return redirect()->route('all_product_user')->with('success', 'Le produit a été ajouté avec succès.');
}

    
    
    
    
    
    public function joinAuction(Request $request, $id_produit)
{
    // Vérifier si l'utilisateur est authentifié
    $user = Auth::user();
    if (!$user) {
        return redirect()->back()->with('error', 'Vous devez être connecté pour participer à une enchère.');
    }

    // Vérifier si le produit existe et est de type enchère
    $produit = Produit::findOrFail($id_produit);
    if (!$produit || $produit->type_vente !== 'enchere') {
        return redirect()->back()->with('error', 'Ce produit n\'est pas une enchère.');
    }

    // Vérifier si l'enchère est déjà terminée
    if (now() > $produit->date_fin) {
        return redirect()->back()->with('error', 'Cette enchère est déjà terminée.');
    }

    // Vérifier si l'utilisateur a déjà rejoint l'enchère
    $existingEntry = enchere_onlines::where('id_produit', $id_produit)
                                  ->where('id_user', $user->id)
                                  ->first();
    if ($existingEntry) {
        return redirect()->back()->with('error', 'Vous avez déjà rejoint cette enchère.');
    }

    // Enregistrer la participation de l'utilisateur à l'enchère
    $enchere = new enchere_onlines();
    $enchere->id_produit = $id_produit;
    $enchere->id_user = $user->id;
    $enchere->save();

    return redirect()->back()->with('success', 'Vous avez rejoint avec succès cette enchère.');
}

    
public function all_product(){
   
    if(Auth::user()->role=='admin'){

        $produits = Produit::with('categorie')->get();
   
        return view('all_product',compact('produits'));
    }
 
}
public function produits_user(){

        $user = Auth::user();

        if (!$user) {
            return view('welcome');
        }
        
        if ($user->role == 'client') {
            $profile = User::find($user->id);
        
            if (!$profile) {
                return response()->json(['error' => 'Utilisateur introuvable.'], 404);
            }
        
            $produits = Produit::where('id_proprietaire', $user->id)->get();
        
            foreach ($produits as $produit) {
                $produit->offres = Offre::where('id_produit', $produit->id)
                    ->join('users', 'offres.id_client', '=', 'users.id')
                    ->select('offres.*')
                    ->get();
            }
        
            return view('user_produits',compact('produits'));
        }

}
    public function show($id)
    {

        $categories=Categorie::all();
        $produit = Produit::findOrFail($id);
        if (!$produit) {
            return response()->json('Produit non trouvé', 404);
        }
    
        $categorie = Categorie::findOrFail($produit->id_categorie);
    
        if ($produit->type_vente == 'enchere') {
            $proprietaire = User::find($produit->id_proprietaire);
    
            $enchere_onlines = enchere_onlines::where('id_produit', $id)
                                             ->with('user')
                                             ->get();
    
            $users = [];
            foreach ($enchere_onlines as $enchere) {
                $user = User::find($enchere->id_user);
                $offre = Offre::where('id_produit', $id)
                              ->where('id_client', $enchere->id_user)
                              ->orderBy('offre', 'desc')
                              ->first();
    
                if ($user && $offre) {
                    $users[] = [
                        'user' => [
                            'nom' => $user->nom,
                            'prenom' => $user->prenom,
                            'offre' => $offre->offre
                        ]
                    ];
                } elseif ($user) {
                    $users[] = [
                        'user' => [
                            'nom' => $user->nom,
                            'prenom' => $user->prenom
                        ]
                    ];
                }
            }
    
            if (empty($users)) {
                return view('details_produit', compact('produit', 'categorie', 'proprietaire','categories'));
            } else {
                $offreMax = Offre::where('id_produit', $id)->orderBy('offre', 'desc')->first();
                $userWinner = $offreMax ? User::find($offreMax->id_client) : null;
    
                return view('details_produit', compact('produit', 'categorie', 'proprietaire', 'userWinner', 'users', 'offreMax','categories'));
            }
        } elseif ($produit->type_vente == 'normal') {
            $proprietaire = User::find($produit->id_proprietaire);
    
            return view('details_produit', compact('produit', 'categorie', 'proprietaire','categories'));
        }
    }
    
    public function produitCat( $id_categorie)
{
    // Recherche de la catégorie
    $categorie = Categorie::where('id',$id_categorie)->first();
    $categories = Categorie::all();
   
    // Récupération des produits de la catégorie
    $produits = Produit::where('id_categorie', $id_categorie)->get();

    return view('produit_cat', compact('produits', 'categories', 'categorie'));
}

    public function edit(Produit $produit)
    {
        $categories= Categorie::all();
        return view('edit_produit', compact(['produit','categories']));
    }

    
    public function update(Request $request, Produit $produit)
{
    $validator = Validator::make($request->all(), [
        'libelle' => 'required|string',
        'type_vente' => 'required|string',
        'description' => 'required|string',
        'id_categorie' => 'required|exists:categories,id',
        'prix' => 'required|numeric',
        'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        // Messages d'erreur personnalisés
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = Auth::user();
    if (!$user || $user->role !== 'client') {
        return redirect()->back()->with('error', 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.');
    }

    if ($request->type_vente == 'normal') {
        // Si le type de vente est "normal", mettre à jour le produit sans vérification supplémentaire
        $produit->update($request->all());
        return redirect()->route('all_product_user')->with('success', 'Produit mis à jour avec succès.');
    } elseif ($request->type_vente == 'enchere') {
        // Si le type de vente est "enchere"
        if ($request->date_debut > now()) {
            // Si la date de début est supérieure à la date actuelle, mettre à jour le produit
            $produit->update($request->all());
            return redirect()->route('all_product_user')->with('success', 'Produit mis à jour avec succès.');
        } else {
            // Sinon, ne pas mettre à jour le produit
            return redirect()->back()->with('error', 'La date de début doit être ultérieure à la date actuelle pour les enchères.');
        }
    }
}

    public function destroy(Produit $produit)
    {
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->back()->with('error', 'Vous n\'avez pas les autorisations nécessaires pour accéder à cette page.');
        }
    
        if (!$produit) {
            return redirect()->back()->with('error', 'Produit non trouvé.');
        }
    
        // Vérifier le type de vente du produit
        if ($produit->type_vente == 'normal') {
            // Supprimer les photos du produit du dossier public/images/produits
            $photoPaths = [
                public_path('images/produits/' . $produit->photo1),
                public_path('images/produits/' . $produit->photo2),
            ];
    
            foreach ($photoPaths as $photoPath) {
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }
    
            // Supprimer le produit de la base de données
            $produit->delete();
    
            // Rediriger en fonction du rôle de l'utilisateur
            $route = $user->role == 'admin' ? 'all_product' : 'all_product_user';
            return redirect()->route($route)->with('success', 'Produit supprimé avec succès.');
        }
    
        // Vérifier si le produit est en cours d'enchères ou si la date de début des enchères est passée mais non terminé
        if ($produit->type_vente == 'enchere' && $produit->date_debut <= now() && $produit->date_fin >= now()) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer ce produit car il est en cours d\'enchères ou la date de début des enchères est passée.');
        }
    
        // Supprimer les photos du produit du dossier public/images/produits
        $photoPaths = [
            public_path('images/produits/' . $produit->photo1),
            public_path('images/produits/' . $produit->photo2),
        ];
    
        foreach ($photoPaths as $photoPath) {
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }
    
        // Supprimer le produit de la base de données
        $produit->delete();
    
        // Rediriger en fonction du rôle de l'utilisateur
        $route = $user->role == 'admin' ? 'all_product' : 'all_product_user';
        return redirect()->route($route)->with('success', 'Produit supprimé avec succès.');
    }
    





public function produits_enchere()
{
    // Récupérer tous les produits de type enchère
    $user=Auth::user();

    $produits = Produit::where('type_vente', 'enchere')->where('id_proprietaire',$user->id) ->get();
   

    // Parcourir chaque produit pour récupérer les détails des participants et l'offre maximale
    foreach ($produits as $produit) {
             
        // Récupérer les participants à cette enchère
        $participants = DB::table('enchere_onlines')
            ->where('id_produit', $produit->id)
            ->join('users', 'enchere_onlines.id_user', '=', 'users.id')
            ->select('users.*')
            ->get();

        // Récupérer l'offre maximale pour ce produit
        $offreMax = Offre::where('id_produit', $produit->id)
            ->orderBy('offre', 'desc')
            ->first();

        // Récupérer les détails de l'utilisateur ayant fait l'offre maximale
        $userOffreMax = null;
        $offreMaxValue = null;
        if ($offreMax) {
            $userOffreMax = User::find($offreMax->id_client);
            $offreMaxValue = $offreMax->offre;
        }

        // Stocker les détails des participants et l'offre maximale dans le produit
        $produit->participants = $participants;
        $produit->offreMax = $offreMaxValue;
        $produit->userOffreMax = $userOffreMax;
    }

    return view('produits_enchere', compact('produits'));
}


public function search(Request $request)
    {
        $categories = Categorie::all();
        $query = $request->input('query');
        $products = Produit::where('libelle', 'LIKE', "%{$query}%")
                            ->orWhere('description', 'LIKE', "%{$query}%")
                            ->get();

           
        $latestProducts = Produit::orderBy('created_at', 'desc')->get()->chunk(3);
        $auctionProducts = Produit::where('type_vente', 'enchere')->orderBy('created_at', 'desc')->get()->chunk(3);
        $normalProducts = Produit::where('type_vente', 'normal')->orderBy('created_at', 'desc')->get()->chunk(3);


        return view('search_results', compact(['products','categories','latestProducts','auctionProducts','normalProducts']));
    }

}
