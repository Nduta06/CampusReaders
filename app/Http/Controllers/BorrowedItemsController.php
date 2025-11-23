<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storeborrowed_itemsRequest;
use App\Http\Requests\Updateborrowed_itemsRequest;
use App\Models\borrowed_items;

class BorrowedItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowedItems = \App\Models\BorrowedItem::with(['books', 'user'])->get();
        return view('borrowed-items.index', compact('borrowedItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeborrowed_itemsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(borrowed_items $borrowed_items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(borrowed_items $borrowed_items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateborrowed_itemsRequest $request, borrowed_items $borrowed_items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(borrowed_items $borrowed_items)
    {
        //
    }
}
