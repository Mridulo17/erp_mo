<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ticket\AssignTicket;
use Illuminate\Http\Request;

class AssignTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = AssignTicket::get();
        return view('backend.pages.ticket.assign_ticket', compact('tickets'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignTicket $assignTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssignTicket $assignTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssignTicket $assignTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignTicket $assignTicket)
    {
        //
    }
}
