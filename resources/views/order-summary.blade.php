@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Order Summary</h1>
    <div class="order-details">
        <h3>Products</h3>
        <ul>
            @foreach ($cart as $product)
                <li>
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" width="100">
                    <p>{{ $product['nom_prod'] }} - {{ $product['prix'] }}</p>
                </li>
            @endforeach
        </ul>

        <h3>Total: {{ number_format($total, 2) }} MAD</h3>
    </div>

    <!-- PayPal Button (you will need to integrate PayPal here) -->
    <div id="paypal-button-container"></div>

    <form action="{{ route('order.process') }}" method="POST" style="display: none;" id="order-form">
        @csrf
        <input type="hidden" name="total" value="{{ $total }}">
        <input type="hidden" name="cart" value="{{ json_encode($cart) }}">
        <button type="submit" id="pay-now-btn">Pay Now</button>
    </form>
</div>
<!-- 
<script src="https://www.paypal.com/sdk/js?client-id=YOUR_PAYPAL_CLIENT_ID"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: "{{ $total }}"
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Payment completed successfully
                document.getElementById('order-form').submit();
            });
        }
    }).render('#paypal-button-container');
</script> -->
@endsection
