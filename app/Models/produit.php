<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $table = 'produits';  // Assurez-vous que le nom correspond bien à votre table

    // Définir les colonnes qui peuvent être assignées en masse
    protected $fillable = ['nom_prod', 'img_prod', 'description', 'prix'];
}
