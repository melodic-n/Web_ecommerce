<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function createPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string'
        ]);
        
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment.success'),
                "cancel_url" => route('payment.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->amount
                    ],
                    "description" => $request->description
                ]
            ]
        ]);
        
        if (isset($response['id']) && $response['id'] != null) {
            // For PayPal checkout, save order ID in session
            session(['paypal_order_id' => $response['id']]);
            
            // Redirect to PayPal
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }
        
        return redirect()->route('payment.error')
            ->with('error', 'Something went wrong with PayPal: ' . json_encode($response));
    }
    
    public function paymentSuccess(Request $request)
    {
        $paypalOrderId = session('paypal_order_id');
        $appOrderId = session('app_order_id'); // This will hold your Commande ID

        if (empty($paypalOrderId) || empty($appOrderId)) {
            return redirect()->route('payment.error')
                ->with('error', 'Order IDs not found in session');
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        // Capture the order
        $response = $provider->capturePaymentOrder($paypalOrderId);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // Payment successful, clear session
            session()->forget('paypal_order_id');
            session()->forget('app_order_id');

            // Get transaction details
            $captureId = $response['purchase_units'][0]['payments']['captures'][0]['id'];

            // Find the corresponding Commande in your database
            $commande = Commande::findOrFail($appOrderId); // Use Commande model

            // Update the commande status to "paid"
            $commande->status = 'paid'; // Or 'payed' as you mentioned
            $commande->paypal_order_id = $paypalOrderId; // Optional
            $commande->paypal_transaction_id = $captureId; // Optional
            $commande->save();

            return redirect()->route('payment.success.page', ['commande' => $commande]) // Pass the updated commande
                ->with('success', 'Payment completed successfully! Your order status has been updated to paid. Transaction ID: ' . $captureId);
        }

        return redirect()->route('payment.error')
            ->with('error', 'Payment failed: ' . json_encode($response));
    }

    public function paymentCancel(Request $request)
    {
        $appOrderId = $request->query('order_id');

        // Clear session
        session()->forget('paypal_order_id');
        session()->forget('app_order_id');

        return redirect()->route('payment.cancel.page', ['order_id' => $appOrderId ?? null])
            ->with('error', 'Payment was cancelled.');
    }
}