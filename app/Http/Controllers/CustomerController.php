<?php

namespace App\Http\Controllers;
use App\Models\Produit;
use App\Models\Customer;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        return view('customer.dashboard', compact('produits'));
    }


    public function indexProduct()
    {
        $produits = Produit::all(); // Get all products
        return view('customer.dashboard', compact('produits')); // Pass the products to the view
    }
    
}
