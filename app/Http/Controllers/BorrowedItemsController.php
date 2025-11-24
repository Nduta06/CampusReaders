<?php

namespace App\Http\Controllers;

use App\Models\BorrowedItem;
use App\Models\Books; 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowedItemsController extends Controller
{
    public function index()
    {
        // FIXED: Only get items where 'return_date' is NULL (Active Loans)
        // This ensures marked items disappear from the list immediately.
        $borrowedItems = BorrowedItem::with(['book', 'user'])
            ->whereNull('return_date')
            ->latest()
            ->get();

        return view('borrowed-items.index', compact('borrowedItems'));
    }

    public function create()
    {
        $users = User::all();
        $books = Books::where('available_copies', '>', 0)->get();
        return view('borrowed-items.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'due_date' => 'required|date|after:today',
        ]);

        $book = Books::findOrFail($request->book_id);
        if ($book->available_copies < 1) {
            return back()->withErrors(['book_id' => 'This book is no longer available.']);
        }

        BorrowedItem::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => now(), // Correct column
            'due_date' => $request->due_date,
            'status' => 'Borrowed',
        ]);

        $book->decrement('available_copies');

        return redirect()->route('borrowed-items.index')->with('success', 'Book issued successfully!');
    }

    public function update(Request $request, BorrowedItem $borrowed_item)
    {
        // Handle "Mark Returned"
        if ($request->has('mark_returned')) {
            $borrowed_item->update([
                'return_date' => now(), // FIXED: Matches DB column 'return_date'
                'status' => 'Returned'
            ]);
            
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

    public function destroy(BorrowedItem $borrowed_item)
    {
        $borrowed_item->delete();
        return back()->with('success', 'Record deleted.');
    }

    public function borrow(Request $request, $bookId)
    {
        $book = Books::findOrFail($bookId);

        if ($book->available_copies < 1) {
            return back()->withErrors(['error' => 'Sorry, this book is out of stock.']);
        }

        $existingLoan = BorrowedItem::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereNull('return_date')
            ->exists();

        if ($existingLoan) {
            return back()->withErrors(['error' => 'You already have an active loan for this book.']);
        }

        BorrowedItem::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrow_date' => now(), // Correct column
            'due_date' => now()->addDays(14), 
            'status' => 'Borrowed',
        ]);

        $book->decrement('available_copies');

        return redirect()->route('catalogue')->with('success', 'You have successfully borrowed: ' . $book->title);
    }
}