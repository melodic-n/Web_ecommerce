<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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

        // Get the authenticated user's customer data
        $customer = Auth::user()->customer; // Assuming the 'customer' relation on User

        // If the customer relation is missing, fallback to the user data
        if (!$customer) {
            $customer = Auth::user(); // Use the user data directly if customer relation is missing
        }

        // Pass the user and customer data to the view
        return view('customer.commande', compact('cartItems', 'totalAmount', 'panier', 'customer'));
    }
    
    public function store(Request $request)
{
    // Enable query log
    DB::enableQueryLog();

    // Log incoming request data
    Log::info('Commande data:', $request->all());

    // Validate incoming data
    $validated = $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'required|email',
        'tel' => 'required',
        'adresse' => 'required',
        'total_amount' => 'required|numeric',
        'cart_data' => 'required|json',
        'panier_id' => 'required|exists:paniers,id',  // Ensure panier exists in the database
    ]);

    // Create a new command
    $commande = new Commande();
    $commande->user_id = auth()->id();
    $commande->status = 'pending';
    $commande->montant = $request->total_amount;
    $commande->livraison_info = json_encode([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'tel' => $request->tel,
        'adresse' => $request->adresse,
    ]);
    $commande->cart_data = $request->cart_data;
    $commande->panier_id = $request->panier_id;

    // Attempt to save the order
    $isSaved = $commande->save();

    // Log if saving the order was successful
    Log::info('Commande saved:', ['success' => $isSaved, 'orderId' => $commande->id]);

    // Log any database queries
    Log::info('SQL Queries: ' . json_encode(DB::getQueryLog()));

    if ($isSaved) {
        return response()->json([
            'success' => true,
            'orderId' => $commande->id,
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Failed to create order.',
        ]);
    }
}

    public function show($id)
    {
        Log::info('Fetching order with id: ' . $id);

        $commande = Commande::findOrFail($id); // Find the order by ID

        return view('customer.commande_show', compact('commande')); // Pass the order to the view
    }
}
