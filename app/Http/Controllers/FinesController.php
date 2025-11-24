<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class FinesController extends Controller
{
    /**
     * Display a list of fines.
     */
    public function index()
    {
        $fines = Fine::with(['user', 'book'])->orderBy('created_at', 'desc')->get();
        return view('fines.index', compact('fines'));
    }

    /**
     * Initiate the Stripe Payment
     */
    public function pay(Fine $fine)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $amountToPay = ($fine->amount_due - $fine->amount_paid) * 100; // amount in cents

        if ($amountToPay <= 0) {
            return redirect()->route('profile')->with('error', 'This fine is already fully paid.');
        }

        $session = StripeSession::create([
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
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            return redirect()->route('profile')->with('error', 'No Stripe session found.');
        }

        // Verify the session with Stripe
        Stripe::setApiKey(config('services.stripe.secret'));
        $session = StripeSession::retrieve($sessionId);

        if ($session->payment_status !== 'paid') {
            return redirect()->route('profile')->with('error', 'Payment not completed.');
        }

        // Update the fine
        $fine->update([
            'amount_paid' => $fine->amount_due,
            'amount_due' => 0,
            'status' => 'Paid',
        ]);

        return redirect()->route('profile')->with('success', 'Fine paid successfully!');
    }

    /**
     * Show the form for creating a new resource (not needed, leave empty).
     */
    public function create() { }

    /**
     * Store a newly created resource (not needed, leave empty).
     */
    public function store(Request $request) { }

    /**
     * Display the specified resource (optional).
     */
    public function show(Fine $fine) { }

    /**
     * Show the form for editing the specified resource (optional).
     */
    public function edit(Fine $fine) { }

    /**
     * Update the specified resource (optional, e.g., mark paid manually).
     */
    public function update(Request $request, Fine $fine)
    {
        if ($request->has('mark_paid')) {
            $fine->update([
                'amount_paid' => $fine->amount_due,
                'amount_due' => 0,
                'status' => 'Paid',
            ]);
            return redirect()->back()->with('success', 'Fine marked as paid.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fine $fine)
    {
        $fine->delete();
        return redirect()->back()->with('success', 'Fine deleted successfully.');
    }
}
