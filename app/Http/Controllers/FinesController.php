<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorefinesRequest;
use App\Http\Requests\UpdatefinesRequest;
use App\Models\Fine;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class FinesController extends Controller
{
    /**
     * Initiate the Stripe Payment
     */
    public function pay(Fine $fine)
    {
        // 1. Set API Key from .env
        Stripe::setApiKey(config('services.stripe.secret'));

        // 2. Calculate remaining balance (Stripe expects amount in cents)
        $amountToPay = ($fine->amount_due - $fine->amount_paid) * 100;

        // 3. Create Checkout Session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Library Fine Payment',
                        'description' => 'Fine for borrowed item #' . $fine->borrowed_item_id,
                    ],
                    'unit_amount' => $amountToPay,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            // These routes must be defined in web.php
            'success_url' => route('fines.success', ['fine' => $fine->id]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('profile'),
        ]);

        return redirect($session->url);
    }

    /**
     * Handle Successful Payment
     */
    public function paymentSuccess(Request $request, Fine $fine)
    {
        // In a production app, you would verify the session_id with Stripe here.
        
        // Update the fine status in the database
        $fine->update([
            'amount_paid' => $fine->amount_due, // Mark as fully paid
            'status' => 'Paid',
            'amount_due' => 0
        ]);

        return redirect()->route('profile')->with('success', 'Fine paid successfully!');
    }

    // --- Existing Resource Methods (Left empty as placeholders) ---

    /**
     * Display the specified resource.
     */
    public function show(Fine $fine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fine $fine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefinesRequest $request, Fine $fine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fine $fine)
    {
        //
    }
}
