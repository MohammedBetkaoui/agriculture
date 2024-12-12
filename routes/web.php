<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\contactController;

use Illuminate\Support\Facades\Route;




    
    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::get('/notification', function () {
        return view('notification');
    })->name('notification');

    
    Route::post('/send-message', [contactController::class,'sendMessage'])->name('send_message');
    Route::get('/all-message', [contactController::class,'index'])->name('all-message');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contact_destroy');


    Route::get('/', [ProduitsController::class, 'index'])->name("home");
    Route::get('/dashboard', [ProduitsController::class, 'index'])->name("home");

    Route::get('/profile/ajouter_produit', [ProduitsController::class, 'ajouter_produit'])->name("ajouter_produit");
    Route::post('/profile/ajouter_produit', [ProduitsController::class, 'store'])->name("ajouter_produit");
    Route::get('/all_product', [ProduitsController::class, 'all_product'])->name("all_product");
    Route::get('/all_product_user', [ProduitsController::class, 'produits_user'])->name("all_product_user");

    Route::get('/categories', [CategorieController::class, 'all_categorie'])->name("all_categorie");

    Route::get('/categories_edit/{categorie}', [CategorieController::class, 'edit'])->name("show_categorie");
    Route::post('/categories_edit/{categorie}', [CategorieController::class, 'update'])->name("edit_categorie");
    Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categorie_destroy');

    Route::get('/produits/enchere',[ProduitsController::class,'produits_enchere'] )->name('produits.enchere');



    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user_destroy');

    Route::get('/tout_user',[UserController::class,'index'])->name('all_user');

    Route::delete('/destroy/{produit}', [ProduitsController::class, 'destroy'])->name("destroy");
    Route::get('/edit/{produit}', [ProduitsController::class, 'edit'])->name("edit");

    Route::POST('/update/{produit}', [ProduitsController::class, 'update'])->name("update");

    Route::get('/details_produit/{produit}', [ProduitsController::class, 'show'])->name("details_produit");

    Route::post('/offre/{id_produit}', [OffreController::class, 'store'])->name("offre");

    Route::post('/produit/{id}/joinAuction', [ProduitsController::class, 'joinAuction'])->name('joinAuction');

    Route::get('/produit_cat/{id_categorie}',[ProduitsController::class,'produitCat'])->name('produitcat');

    


Route::get('/profile-admin/ajouter_categorie', [CategorieController::class, 'ajouter_categorie'])->name("ajouter_categorie");
Route::post('/profile-admin/ajouter_categorie', [CategorieController::class, 'store'])->name("ajouter_categorie");



Route::get('/search', [ProduitsController::class, 'search'])->name('search');


