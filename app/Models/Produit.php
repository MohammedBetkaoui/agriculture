<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['libelle', 'type_vente','id_proprietaire', 'id_categorie', 'prix', 'date_debut', 'date_fin'];

    public function proprietaire()
    {
        return $this->belongsTo(User::class, 'id_proprietaire');
    }

   
    public function offres()
    {
        return $this->hasMany(Offre::class, 'id_produit');
    }


    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }
}

