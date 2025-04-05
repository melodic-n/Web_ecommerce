<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Customer;
use App\Models\Commande;

class AdminController extends Controller
{
    // app/Http/Controllers/AdminController.php
public function index()
{
    $produits = Produit::all();
    $customers = Customer::with('user')->get(); // Add this new query
    $commandes = Commande::with(['user', 'panier'])->get(); // Add this line
    
    return view('admin.dashboard', compact('produits', 'customers', 'commandes'));
    
    
}
}
