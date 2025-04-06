<?php

namespace App\Http\Controllers;

use App\Models\Produit;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{

    // In your Controller
public function index() {
    $produits = Produit::all(); // Make sure this matches your blade variable name
    return view('dashboard', compact('produits'));
}
    
    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return response()->json($produit); 
    }

    public function apiIndex()
{
    $products = Produit::all(); // Use French name if your model is 'Produit'
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

public function edit($id) {
    return response()->json(Produit::find($id));
  }
  
  public function update(Request $request, $id) {
    $produit = Produit::findOrFail($id);
    $produit->update($request->all());
    return response()->json(['success' => true]);
  }

// public function update(Request $request, $id)
// {
//     $produit = Produit::findOrFail($id);
    
//     $validated = $request->validate([
//         'nom_prod' => 'required|string|max:255',
//         'prix' => 'required|numeric|min:0',
//         'description' => 'required|string',
//         'category' => 'required|string',
//         'quantite' => 'required|integer|min:0',
//         'img_prod' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//     ]);

//     if ($request->hasFile('img_prod')) {
//         if ($produit->img_prod) {
//             Storage::disk('public')->delete($produit->img_prod);
//         }
//         $validated['img_prod'] = $request->file('img_prod')->store('products', 'public');
//     }

//     $produit->update($validated);
//     return redirect()->back()->with('success', 'Product updated!');
// }

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
        // return response()->json(['message' => 'Product deleted successfully']); 
        return redirect()->route('admin.dashboard');
    }
}

