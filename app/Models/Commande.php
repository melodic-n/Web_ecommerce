<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

   
    protected $fillable = [
        'user_id', 'status', 'montant', 'livraison_info', 'cart_data', 'panier_id'
    ];

    // Existing relationships
    public function panier()
    {
        return $this->belongsTo(Panier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}   