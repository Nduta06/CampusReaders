<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorewaitlistsRequest;
use App\Http\Requests\UpdatewaitlistsRequest;
use App\Models\Waitlist;

class WaitlistsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $waitlists = \App\Models\Waitlist::with(['book', 'user'])->get();
        return view('waitlists.index', compact('waitlists'));
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
    public function store(StorewaitlistsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Waitlist $waitlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Waitlist $waitlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatewaitlistsRequest $request, Waitlist $waitlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Waitlist $waitlist)
    {
        //
    }
}
