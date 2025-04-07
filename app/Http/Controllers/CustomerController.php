<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Produit;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('user')->get(); // Get all customers with user data
        return view('customer.dashboard', compact('customers')); // We'll modify this
    }


    public function indexProduct()
    {
        $produits = Produit::all(); // Get all products
        return view('customer.dashboard', compact('produits')); // Pass the products to the view
    }
    
}
