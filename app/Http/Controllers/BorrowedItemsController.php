<?php

namespace App\Http\Controllers;

use App\Models\BorrowedItem;
use App\Models\Books; 
use App\Models\User;
use Illuminate\Http\Request;

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
}