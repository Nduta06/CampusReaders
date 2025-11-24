<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorebooksRequest;
use App\Http\Requests\UpdatebooksRequest;
use App\Models\Books;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = \App\Models\Books::with('category')->get();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebooksRequest $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'ISBN' => 'required|string|max:255|unique:books,ISBN',
            'edition' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'total_copies' => 'required|integer|min:0',
        ]);
        // Set available_copies to total_copies on creation
        $validated['available_copies'] = $validated['total_copies'];
        $validated['manual_sync_flag'] = false;
        \App\Models\Books::create($validated);
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Books $book)
    {
        $categories = \App\Models\Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebooksRequest $request, Books $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'total_copies' => 'required|integer|min:0',
        ]);
        // If total_copies is changed, adjust available_copies accordingly
        if (isset($validated['total_copies'])) {
            $diff = $validated['total_copies'] - $book->total_copies;
            $book->available_copies += $diff;
            $book->total_copies = $validated['total_copies'];
            unset($validated['total_copies']);
        }
        $book->update($validated);
        $book->save();
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
