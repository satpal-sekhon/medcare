<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Anand\LaravelPaytmWallet\Facades\PaytmWallet;

class PaymentController extends Controller
{
    public function createRazorpayOrder(Request $request)
    {
        $api = new Api(getSetting('razorpay_key_id'), getSetting('razorpay_key_secret'));

        $orderData = [
            'receipt'         => strval(rand(1000, 9999)),
            'amount'          => strval(round($request->amount * 100)), // Convert to paise
            'currency'        => 'INR',
            'payment_capture' => 1, // Auto capture
        ];

        try {
            $order = $api->order->create($orderData);
            return response()->json([
                'success' => true,
                'id' => $order['id'],
                'key_id'=> getSetting('razorpay_key_id')
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function verifyRazorpayPayment(Request $request)
    {
        $api = new Api(getSetting('razorpay_key_id'), getSetting('razorpay_key_secret'));

        $orderId = $request->input('order_id');
        $paymentId = $request->input('payment_id');

        try {
            // Verify the payment
            $api->payment->fetch($paymentId)->capture(['amount' => round($request->amount * 100)]); // Capture payment
            
            // Optionally, you can log the payment details or update your database
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }


    public function createPaytmOrder(Request $request)
    {
        $paytm = PaytmWallet::with('payment');

        $paytm->prepare([
            'order' => uniqid(), // Unique order ID
            'user' => 'test', // User identifier
            'amount' => $request->amount, // Amount to be paid
            'callback_url' => route('paytm.callback'), // Callback URL
        ]);

        return $paytm->receive();
    }

    public function paytmCallback(Request $request)
    {
        // Verify the payment response
        $response = PaytmWallet::with('response');
        $response->getResponse();

        // You can validate and handle the response here
        if ($response->isSuccessful()) {
            // Payment is successful
            // Update your order status in the database
            return response()->json(['status' => 'success']);
        } elseif ($response->isFailed()) {
            // Payment failed
            return response()->json(['status' => 'failed']);
        } else {
            // Payment status unknown
            return response()->json(['status' => 'unknown']);
        }
    }
}
