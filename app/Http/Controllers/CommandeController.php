<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommandeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // Get the authenticated user's panier (cart)
        $panier = Panier::where('user_id', auth()->id())->first();  // Get the panier for the logged-in user
    
        if (!$panier) {
            return redirect()->route('home')->with('error', 'Panier not found for the given user.');
        }
    
        // Get the cart items and total amount
        $cartItems = $panier->produits;  // Assuming you have the 'produits' relationship
        $totalAmount = $panier->prix_total;
    
        // Pass the panier data and user to the view
        return view('customer.commande', compact('cartItems', 'totalAmount', 'panier'));
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'adresse' => 'required',
            'total_amount' => 'required|numeric',
            'cart_data' => 'required|json', // Ensure cart_data is a valid JSON string
        ]);
    
        // Create a new order (commande)
        $commande = new Commande();
        $commande->user_id = auth()->id();  // assuming the user is logged in
        $commande->status = 'pending';  // Default status
        $commande->montant = $request->total_amount;
        $commande->livraison_info = json_encode([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'tel' => $request->tel,
            'adresse' => $request->adresse,
        ]);
        $commande->cart_data = $request->cart_data;  // Save the cart data as JSON
        $commande->panier_id = $request->panier_id;  // Assuming panier_id is passed
        $commande->save();
    
        return redirect()->route('home')->with('success', 'Votre commande a été passée avec succès.');
    }
    public function show($id)
    {
        Log::info('Fetching order with id: ' . $id);
        
        $commande = Commande::findOrFail($id); // Find the order by ID
        
        return view('customer.commande_show', compact('commande')); // Pass the order to the view
    }
    
    
    
}
