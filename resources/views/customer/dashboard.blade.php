@extends('layouts.app')

@section('content')
    <h1>Welcome Customer</h1>

    <h2>Add Product to Panier</h2>
    <form id="add-to-panier-form">
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <label for="product_id">Product ID:</label>
        <input type="number" name="product_id" id="product_id"><br>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity"><br>
        <button type="submit">Add to Panier</button>
    </form>

    <h2>Create Order</h2>
    <button id="create-order-btn">Create Order</button>

    <div id="api-results"></div>

    <script>
       document.addEventListener('DOMContentLoaded', function() {
    const addToPanierForm = document.getElementById('add-to-panier-form');
    const createOrderBtn = document.getElementById('create-order-btn');
    const apiResultsDiv = document.getElementById('api-results');

    addToPanierForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const userId = document.querySelector('input[name="user_id"]').value;
        const productId = document.getElementById('product_id').value;
        const quantity = document.getElementById('quantity').value;

        fetch('/api/panier', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer {{ Auth::user()->createToken('api_token')->plainTextToken }}'
            },
            body: JSON.stringify({
                user_id: userId,
                produits: [{ id: productId, quantite: quantity }]
            })
        })
        .then(response => response.text()) // Get response as text first
        .then(data => {
            try {
                const json = JSON.parse(data); // Try to parse as JSON
                apiResultsDiv.innerText = JSON.stringify(json, null, 2);
            } catch (error) {
                apiResultsDiv.innerText = 'Error parsing JSON: ' + error;
            }
        })
        .catch(error => {
            apiResultsDiv.innerText = 'Error: ' + error;
        });
    });

    createOrderBtn.addEventListener('click', function() {
        fetch('/api/commandes/create', {
        method: 'POST',
        headers: {
            'Authorization': 'Bearer {{ Auth::user()->createToken('api_token')->plainTextToken }}'
        }
    })

        .then(response => response.text()) // Get response as text first
        .then(data => {
            try {
                const json = JSON.parse(data); // Try to parse as JSON
                apiResultsDiv.innerText = JSON.stringify(json, null, 2);
            } catch (error) {
                apiResultsDiv.innerText = 'Error parsing JSON: ' + error;
            }
        })
        .catch(error => {
            apiResultsDiv.innerText = 'Error: ' + error;
        });
    });
});

    </script>

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection