<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $table = 'commandes';  


    protected $fillable = [
        'user_id',
        'status',
        'montant',
        'panier_id', 
        ];

    public function panier()
    {
        return $this->belongsTo(Panier::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
