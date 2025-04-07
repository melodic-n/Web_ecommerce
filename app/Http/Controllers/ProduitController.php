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
        return view('customer.produits', compact('produits'));
    }
    
    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return response()->json($produit);
    }
    public function apiIndex()
    {
        $products = Produit::all();
        return response()->json($products); // This converts the collection into JSON format
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
        $produit = Produit::findOrFail($id);
    
        return response()->json($produit);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_prod' => 'nullable|string|max:255',
            'prix' => 'nullable|numeric',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'quantite' => 'nullable|integer',
            'img_prod' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $produit = Produit::findOrFail($id);

        // Update product fields
        $produit->nom_prod = $request->nom_prod ?? $produit->nom_prod;
        $produit->prix = $request->prix ?? $produit->prix;
        $produit->description = $request->description ?? $produit->description;
        $produit->category = $request->category ?? $produit->category;
        $produit->quantite = $request->quantite ?? $produit->quantite;
    
        // Handle image upload
        if ($request->hasFile('img_prod')) {
            $imagePath = $request->file('img_prod')->store('products', 'public');
            $produit->img_prod = $imagePath;
        }
    
        $produit->save();
    
        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully');
        }
    


    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return redirect()->route('admin.dashboard');
    }
}