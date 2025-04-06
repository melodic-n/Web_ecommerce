<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('user')->get(); // Get all customers with user data
        return view('customer.dashboard', compact('customers')); // We'll modify this
    }
}
