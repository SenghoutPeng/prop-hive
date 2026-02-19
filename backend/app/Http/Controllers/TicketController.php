<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\User;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::orderByDesc('support_ticket_created_at')->get();
        return view('ticket.index', compact('tickets'));
    }

    public function edit($id)
    {
        $ticket = SupportTicket::findOrFail($id);
        return view('ticket.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $validated = $request->validate([
            'support_ticket_status' => 'required|string',
            'support_ticket_message' => 'required|string',
        ]);
        $ticket->update($validated);
        return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully!');
    }

    public function destroy($id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('ticket.index')->with('success', 'Ticket deleted successfully!');
    }
} 