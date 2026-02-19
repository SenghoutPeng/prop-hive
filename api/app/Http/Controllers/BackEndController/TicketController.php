<?php

namespace App\Http\Controllers\BackEndController;

use Illuminate\Http\Request;
use App\Models\BackendModel\SupportTicket;
use App\Models\BackendModel\User;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index()
    {
        try {
            $tickets = SupportTicket::with('user')->orderByDesc('support_ticket_created_at')->get();
            
            return response()->json([
                'success' => true,
                'data' => $tickets->map(function ($ticket) {
                    return [
                        'id' => $ticket->support_ticket_id,
                        'user' => $ticket->user ? [
                            'id' => $ticket->user->user_id,
                            'name' => $ticket->user->user_name
                        ] : null,
                        'subject' => $ticket->support_ticket_subject,
                        'message' => $ticket->support_ticket_message,
                        'status' => $ticket->support_ticket_status,
                        'priority' => $ticket->support_ticket_priority ?? 'medium',
                        'created_at' => $ticket->support_ticket_created_at,
                        'updated_at' => $ticket->support_ticket_updated_at ?? $ticket->support_ticket_created_at
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch tickets',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(SupportTicket $ticket)
    {
        try {
            $ticket->load('user');
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $ticket->support_ticket_id,
                    'user' => $ticket->user ? [
                        'id' => $ticket->user->user_id,
                        'name' => $ticket->user->user_name
                    ] : null,
                    'subject' => $ticket->support_ticket_subject,
                    'message' => $ticket->support_ticket_message,
                    'status' => $ticket->support_ticket_status,
                    'priority' => $ticket->support_ticket_priority ?? 'medium',
                    'created_at' => $ticket->support_ticket_created_at,
                    'updated_at' => $ticket->support_ticket_updated_at ?? $ticket->support_ticket_created_at
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:user,user_id',
                'support_ticket_subject' => 'required|string|max:255',
                'support_ticket_message' => 'required|string',
                'support_ticket_priority' => 'required|in:low,medium,high',
                'support_ticket_status' => 'required|in:open,in_progress,resolved,closed'
            ]);

            $ticket = SupportTicket::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Ticket created successfully',
                'data' => $ticket
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, SupportTicket $ticket)
    {
        try {
            $validated = $request->validate([
                'support_ticket_status' => 'required|string',
                'support_ticket_message' => 'required|string',
            ]);
            
            $ticket->update($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Ticket updated successfully',
                'data' => $ticket
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(SupportTicket $ticket)
    {
        try {
            $ticket->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Ticket deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 