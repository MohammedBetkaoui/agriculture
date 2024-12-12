<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enchere_onlines extends Model
{
    
    use HasFactory;

    protected $fillable = ['id_produit','id_user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_client'); // Assurez-vous de remplacer 'id_client' par la clé étrangère correcte dans votre modèle
    }
        public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit'); }
}


