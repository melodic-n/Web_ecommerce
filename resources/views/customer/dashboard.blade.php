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

    <h2>Create Order and Proceed to Payment</h2>
    <button id="create-order-payment-btn">Create Order & Pay with PayPal</button>

    <div id="api-results"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addToPanierForm = document.getElementById('add-to-panier-form');
            const createOrderPaymentBtn = document.getElementById('create-order-payment-btn');
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
                .then(response => response.json()) // Expect JSON response for Panier creation
                .then(data => {
                    apiResultsDiv.innerText = 'Panier Created: ' + JSON.stringify(data, null, 2);
                    // Store the panier ID for the next step
                    createOrderPaymentBtn.dataset.panierId = data.id;
                })
                .catch(error => {
                    apiResultsDiv.innerText = 'Error creating Panier: ' + error;
                });
            });

            createOrderPaymentBtn.addEventListener('click', function() {
                const panierId = this.dataset.panierId;
                if (!panierId) {
                    apiResultsDiv.innerText = 'Error: No Panier ID found. Please add to Panier first.';
                    return;
                }

                fetch(`/api/commandes/create/${panierId}`, {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer {{ Auth::user()->createToken('api_token')->plainTextToken }}'
                    }
                })
                .then(response => response.json()) // Expect JSON response with order_id
                .then(data => {
                    apiResultsDiv.innerText = 'Order Created: ' + JSON.stringify(data, null, 2);
                    if (data.order_id) {
                        // Redirect to the PayPal payment form, passing the order ID
                        window.location.href = `/payment/form?order_id=${data.order_id}&amount=${document.getElementById('amount').value}&description=Payment for order #${data.order_id}`;
                    } else {
                        apiResultsDiv.innerText = 'Error: Order ID not received.';
                    }
                })
                .catch(error => {
                    apiResultsDiv.innerText = 'Error creating Order: ' + error;
                });
            });
        });
    </script>

    <h2>Manual Payment Form (for testing if direct link works)</h2>
    <form method="POST" action="{{ route('paypal.create') }}">
        @csrf
        <input type="hidden" name="order_id" id="manual-order-id">
        <div class="form-group">
            <label for="amount">Amount ($):</label>
            <input type="number" class="form-control" name="amount" id="amount" value="10.00" step="0.01" min="1" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" class="form-control" name="description" value="Test Payment" required>
        </div>
        <button type="submit" class="btn btn-primary">Pay with PayPal (Manual)</button>
    </form>

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endsection