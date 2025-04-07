<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated
    }
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'adresse' => 'required',
            'ville' => 'required',
            'code_postal' => 'required',
        ]);
    
        // Create the order
        $commande = Commande::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'montant' => $request->total_amount,
            'livraison_info' => json_encode([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'tel' => $request->tel,
                'adresse' => $request->adresse,
                'ville' => $request->ville,
                'code_postal' => $request->code_postal,
            ]),
            'payment_method' => $request->payment_method,
            'cart_data' => $request->cart_data,
        ]);
    
        // Return response
        return redirect()->route('home')->with('success', 'Commande passée avec succès!');
    }
    
    
    public function index()
{
    if (auth()->user()->role === 'admin') {
        $commandes = Commande::with(['user', 'panier'])->get();
        return view('admin.dashboard', compact('commandes')); // Will merge with other data
    }
    return view('customer.commande');

}
}
