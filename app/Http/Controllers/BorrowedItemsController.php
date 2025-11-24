<?php

namespace App\Http\Controllers;

use App\Models\BorrowedItem;
use App\Models\Books; 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowedItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowedItems = BorrowedItem::with(['book', 'user'])->latest()->get();
        return view('borrowed-items.index', compact('borrowedItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all users
        $users = User::all();
        
        // Fetch only books that have copies available
        $books = Books::where('available_copies', '>', 0)->get();

        return view('borrowed-items.create', compact('users', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date|after:today',
        ]);

        // 2. Double check availability
        $book = Books::findOrFail($request->book_id);
        if ($book->available_copies < 1) {
            return back()->withErrors(['book_id' => 'This book is no longer available.']);
        }

        // 3. Create Borrow Record
        BorrowedItem::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrowed_at' => now(),
            'due_date' => $request->due_date,
        ]);

        // 4. Decrease Book Stock
        $book->decrement('available_copies');

        return redirect()->route('borrowed-items.index')->with('success', 'Book issued successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BorrowedItem $borrowed_item)
    {
        // Handle "Mark Returned"
        if ($request->has('mark_returned')) {
            $borrowed_item->update([
                'returned_at' => now(),
            ]);
            
            // Increase stock back
            $borrowed_item->book->increment('available_copies');
            
            return back()->with('success', 'Item marked as returned.');
        }

        // Handle Due Date Update
        if ($request->has('due_date')) {
            $borrowed_item->update([
                'due_date' => $request->due_date
            ]);
            return back()->with('success', 'Due date updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BorrowedItem $borrowed_item)
    {
        $borrowed_item->delete();
        return back()->with('success', 'Record deleted.');
    }

    public function borrow(Request $request, $bookId)
    {
        // 1. Find the book
        $book = Books::findOrFail($bookId);

        // 2. Check if copies are available
        if ($book->available_copies < 1) {
            return back()->withErrors(['error' => 'Sorry, this book is currently out of stock.']);
        }

        // 3. Check if user already has this book (Optional safety check)
        $existingLoan = BorrowedItem::where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->exists();

        if ($existingLoan) {
            return back()->withErrors(['error' => 'You already have an active loan for this book.']);
        }

        // 4. Create the Borrow Record
        BorrowedItem::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'due_date' => now()->addDays(14), 
        ]);

        // 5. Decrease Stock
        $book->decrement('available_copies');

        return redirect()->route('catalogue')->with('success', 'You have successfully borrowed: ' . $book->title);
    }
}