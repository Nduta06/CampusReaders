<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorefinesRequest;
use App\Http\Requests\UpdatefinesRequest;
use App\Models\Fine;

class FinesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fines = \App\Models\Fine::with(['User', 'borrowed_items'])->get();
        return view('fines.index', compact('fines'));
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
    public function store(StorefinesRequest $request)
    {
        //
    }

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
