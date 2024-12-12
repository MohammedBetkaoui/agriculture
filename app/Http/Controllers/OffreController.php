<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offre;
use Illuminate\Support\Facades\Auth;
use App\Models\Produit;
use App\Models\enchere_onlines;


class OffreController extends Controller
{
    

    public function store(Request $request, $id_produit)
    {
        $request->validate([
            'offre' => 'required|numeric|min:0',
        ]);
    
        // Obtention de l'utilisateur connecté (client)
        $client = Auth::id();
    
        // Obtention du produit associé à l'offre
        $produit = Produit::findOrFail($id_produit);
    
        // Vérification si l'utilisateur soumettant l'offre n'est pas celui qui a ajouté le produit
        if ($produit->id_proprietaire == $client) {
            return redirect()->route('details_produit', $produit->id)->with('error', 'Vous ne pouvez pas soumettre d\'offre pour votre propre produit.');
        }
    
        // Vérification si l'utilisateur qui soumet une offre existe dans la table enchere_online
        $enchereExist = enchere_onlines::where('id_produit', $id_produit)
                                      ->where('id_user', $client)
                                      ->exists();
    
        if (!$enchereExist) {
            return redirect()->route('details_produit', $produit->id)->with('error', 'Vous devez d\'abord enchérir sur ce produit pour soumettre une offre.');
        }
    
        if ($produit->type_vente == 'enchere') {
            // Vérification si la date de début de l'enchère est dans le futur
            if ($produit->date_debut > now()) {
                return redirect()->route('details_produit', $produit->id)->with('error', 'L\'enchère n\'a pas encore démarré.');
            }
    
            // Vérification si l'offre est supérieure à l'offre actuelle pour ce produit
            $offreMax = $produit->offres()->max('offre');
    
            if ($request->offre > $offreMax) {
                // Création de la nouvelle offre
                $offre = new Offre();
                $offre->id_produit = $produit->id;
                $offre->id_client = $client;
                $offre->offre = $request->offre;
                $offre->date_offre = now(); // Date actuelle
    
                // Sauvegarde de la nouvelle offre
                $offre->save();
    
                return redirect()->route('details_produit', $produit->id)->with('success', 'Votre offre a été enregistrée avec succès');
            } else {
                return redirect()->route('details_produit', $produit->id)->with('error', 'Votre offre doit être supérieure à l\'offre actuelle');
            }
        } else {
            return redirect()->route('details_produit', $produit->id)->with('error', 'Ce produit n\'accepte pas les offres en enchères');
        }
    }
    
    
}
