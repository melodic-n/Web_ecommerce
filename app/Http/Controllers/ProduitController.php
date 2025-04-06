<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        return view('dashboard', compact('produits'));
    }

    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return response()->json($produit);
    }

    public function apiIndex()
    {
        $products = Produit::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_prod' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'required|string',
            'category' => 'required|string',
            'quantite' => 'required|integer|min:0',
            'img_prod' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('img_prod')) {
            $imagePath = $request->file('img_prod')->store('products', 'public');
            $validated['img_prod'] = $imagePath;
        }

        Produit::create($validated);
        return redirect()->back()->with('success', 'Product added!');
    }

    public function edit($id)
    {
        // Find the product by ID or fail if it doesn't exist
        $produit = Produit::findOrFail($id);
    
        // Return the product as JSON for AJAX (this is important for the JavaScript)
        return response()->json($produit);
    }
    public function update(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'nom_prod' => 'required|string|max:255',
        'prix' => 'required|numeric',
        'description' => 'required|string',
        'category' => 'required|string',
        'quantite' => 'required|integer',
        'img_prod' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
    ]);

    // Find the product by ID
    $produit = Produit::findOrFail($id);

    // Update the product details
    $produit->nom_prod = $request->nom_prod;
    $produit->prix = $request->prix;
    $produit->description = $request->description;
    $produit->category = $request->category;
    $produit->quantite = $request->quantite;

    // Handle the image upload if there is one
    if ($request->hasFile('img_prod')) {
        // Store the new image
        $imagePath = $request->file('img_prod')->store('products', 'public');
        $produit->img_prod = $imagePath;
    }

    // Save the updated product
    $produit->save();

    return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
}


    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return redirect()->route('admin.dashboard');
    }
}