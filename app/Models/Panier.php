<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $table = 'paniers';  // Correct table name

    protected $fillable = ['user_id', 'prix_total'];

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'panier_produit')->withPivot('quantite');
    }
    // public function order()
    // {
    //     return $this->hasOne(Order::class);
    // }


}
