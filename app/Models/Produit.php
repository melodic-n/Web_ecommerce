<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $table = 'produits';  

    protected $fillable = ['nom_prod', 'img_prod', 'description','category' ,'quantite','prix'];
    
    public function paniers()
    {
        return $this->belongsToMany(Panier::class, 'panier_produit')->withPivot('quantite');
    }
    
}
