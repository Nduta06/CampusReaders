<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\BorrowedItem; // Import BorrowedItem
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Carbon\Carbon; // Import Carbon

class FinesController extends Controller
{
    /**
     * Display a list of fines.
     */
    public function index()
    {
        // 1. Calculate fines for any currently overdue items before showing the list
        $this->calculateFinesForOverdueItems();

        // 2. Fetch all fines to display
        $fines = Fine::with(['user', 'book'])->orderBy('created_at', 'desc')->get();
        
        return view('fines.index', compact('fines'));
    }

    /**
     * Helper to generate fines for overdue books on the fly
     */
    private function calculateFinesForOverdueItems()
    {
        $dailyRate = 1.00; // $1.00 per day

        // Find all active loans (not returned) that are past their due date
        $overdueItems = BorrowedItem::whereNull('return_date')
            ->where('due_date', '<', now())
            ->get();

        foreach ($overdueItems as $item) {
            $dueDate = Carbon::parse($item->due_date);
            $daysOverdue = now()->diffInDays($dueDate);

            // Only charge if at least 1 day overdue
            if ($daysOverdue < 1) continue;

            $fineAmount = $daysOverdue * $dailyRate;

            // Check if a fine record already exists for this transaction
            $existingFine = Fine::where('borrowed_item_id', $item->id)->first();

            if ($existingFine) {
                // Update existing fine if the amount has increased (more days passed)
                if ($existingFine->amount_due < $fineAmount && $existingFine->status !== 'Paid') {
                    $existingFine->update([
                        'amount_due' => $fineAmount,
                    ]);
                }
            } else {
                // Create new fine record
                Fine::create([
                    'user_id' => $item->user_id,
                    'borrowed_item_id' => $item->id,
                    'amount_due' => $fineAmount,
                    'amount_paid' => 0,
                    'incurred_on' => now(),
                    'status' => 'Unpaid'
                ]);
            }
        }
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

    public function create() { }
    public function store(Request $request) { }
    public function show(Fine $fine) { }
    public function edit(Fine $fine) { }

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

    public function destroy(Fine $fine)
    {
        $fine->delete();
        return redirect()->back()->with('success', 'Fine deleted successfully.');
    }
}