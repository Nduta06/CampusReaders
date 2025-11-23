<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storemessaging_logsRequest;
use App\Http\Requests\Updatemessaging_logsRequest;
use App\Models\MessagingLog;

class MessagingLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messagingLogs = \App\Models\MessagingLog::with('User')->get();
        return view('messaging-logs.index', compact('messagingLogs'));
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
    public function store(Storemessaging_logsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MessagingLog $messaging_log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MessagingLog $messaging_log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatemessaging_logsRequest $request, MessagingLog $messaging_log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MessagingLog $messaging_log)
    {
        //
    }
}
