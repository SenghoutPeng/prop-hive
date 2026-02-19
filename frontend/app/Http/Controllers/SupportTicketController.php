<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::where('user_id', Auth::check() ? Auth::user()->user_id : null)
            ->orderBy('support_ticket_created_at', 'desc')
            ->get();
        
        return view('support-tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('support-tickets.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'message' => 'required|string|max:1000',
        ];
        if (!Auth::check()) {
            $rules['name'] = 'required|string|max:255';
            $rules['user_email'] = 'required|email|max:255';
        }
        $request->validate($rules);

        $ticketData = [
            'user_id' => Auth::check() ? Auth::user()->user_id : null,
            'name' => Auth::user() ? Auth::user()->user_name : $request->name,
            'user_email' => Auth::user() ? Auth::user()->user_email : $request->user_email,
            'support_ticket_message' => $request->message,
            'support_ticket_status' => 'pending',
            'support_ticket_created_at' => now(),
        ];
        \Log::info('Support ticket data', $ticketData);
        SupportTicket::create($ticketData);

        return redirect()->route('support-tickets.index')
            ->with('success', 'Support ticket submitted successfully!');
    }

    public function show($id)
    {
        $ticket = SupportTicket::where('support_ticket_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        return view('support-tickets.show', compact('ticket'));
    }

    public function adminIndex()
    {
        $tickets = SupportTicket::orderBy('support_ticket_created_at', 'desc')->get();
        return view('admin.support-tickets.index', compact('tickets'));
    }

    public function adminShow($id)
    {
        $ticket = SupportTicket::findOrFail($id);
        return view('admin.support-tickets.show', compact('ticket'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,closed',
            'response' => 'nullable|string|max:1000',
        ]);

        $ticket = SupportTicket::findOrFail($id);
        $ticket->support_ticket_status = $request->status;
        
        if ($request->response) {
            $ticket->support_ticket_message .= "\n\n--- Admin Response ---\n" . $request->response;
        }
        
        $ticket->support_ticket_responded_at = now();
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket status updated successfully!');
    }
}
