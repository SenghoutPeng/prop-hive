<?php

namespace App\Http\Controllers\FrontEndController;

use Illuminate\Http\Request;
use App\Models\FrontendModel\SupportTicket;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SupportTicketController extends Controller
{
    public function index()
    {
        try {
            $tickets = SupportTicket::where('user_id', Auth::check() ? Auth::user()->user_id : null)
                ->orderBy('support_ticket_created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $tickets->map(function ($ticket) {
                    return [
                        'id' => $ticket->support_ticket_id,
                        'subject' => $ticket->support_ticket_subject ?? 'Support Request',
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
                'message' => 'Failed to fetch support tickets',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        return response()->json([
            'success' => true,
            'message' => 'Create support ticket form data',
            'data' => [
                'title' => 'Create Support Ticket',
                'description' => 'Submit a new support ticket'
            ]
        ]);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'subject' => 'required|string|max:255',
                'message' => 'required|string|max:1000',
            ];

            if (!Auth::check()) {
                $rules['name'] = 'required|string|max:255';
                $rules['user_email'] = 'required|email|max:255';
            }

            $validated = $request->validate($rules);
            $authUser = Auth::user();

            $ticketData = [
                // Important: custom user PK is user_id, not id.
                'user_id' => $authUser ? $authUser->user_id : null,
                'name' => $validated['name'] ?? ($authUser->user_name ?? null),
                'user_email' => $validated['user_email'] ?? ($authUser->user_email ?? null),
                // support_ticket table has no dedicated subject column in current schema.
                'support_ticket_message' => '[Subject] ' . $validated['subject'] . "\n\n" . $validated['message'],
                'support_ticket_status' => 'pending',
                'support_ticket_created_at' => now(),
            ];

            $ticket = SupportTicket::create($ticketData);

            return response()->json([
                'success' => true,
                'message' => 'Support ticket created successfully',
                'data' => [
                    'id' => $ticket->support_ticket_id,
                    'user_id' => $ticket->user_id,
                    'name' => $ticket->name,
                    'user_email' => $ticket->user_email,
                    'status' => $ticket->support_ticket_status,
                    'created_at' => $ticket->support_ticket_created_at,
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create support ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $ticket = SupportTicket::where('support_ticket_id', $id)
                ->where('user_id', Auth::check() ? Auth::user()->user_id : null)
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $ticket->support_ticket_id,
                    'subject' => $ticket->support_ticket_subject ?? 'Support Request',
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
                'message' => 'Failed to fetch support ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function adminIndex()
    {
        try {
            $tickets = SupportTicket::orderBy('support_ticket_created_at', 'desc')->get();

            return response()->json([
                'success' => true,
                'data' => $tickets->map(function ($ticket) {
                    return [
                        'id' => $ticket->support_ticket_id,
                        'subject' => $ticket->support_ticket_subject ?? 'Support Request',
                        'message' => $ticket->support_ticket_message,
                        'status' => $ticket->support_ticket_status,
                        'priority' => $ticket->support_ticket_priority ?? 'medium',
                        'user_id' => $ticket->user_id,
                        'created_at' => $ticket->support_ticket_created_at,
                        'updated_at' => $ticket->support_ticket_updated_at ?? $ticket->support_ticket_created_at
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch admin support tickets',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function adminShow($id)
    {
        try {
            $ticket = SupportTicket::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $ticket->support_ticket_id,
                    'subject' => $ticket->support_ticket_subject ?? 'Support Request',
                    'message' => $ticket->support_ticket_message,
                    'status' => $ticket->support_ticket_status,
                    'priority' => $ticket->support_ticket_priority ?? 'medium',
                    'user_id' => $ticket->user_id,
                    'created_at' => $ticket->support_ticket_created_at,
                    'updated_at' => $ticket->support_ticket_updated_at ?? $ticket->support_ticket_created_at
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch admin support ticket',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,in_progress,resolved,closed',
                'response' => 'nullable|string|max:1000',
            ]);

            $ticket = SupportTicket::findOrFail($id);
            $ticket->support_ticket_status = $request->status;

            if ($request->response) {
                $ticket->support_ticket_message .= "\n\n--- Admin Response ---\n" . $request->response;
            }

            $ticket->support_ticket_updated_at = now();
            $ticket->save();

            return response()->json([
                'success' => true,
                'message' => 'Ticket status updated successfully!',
                'data' => [
                    'id' => $ticket->support_ticket_id,
                    'status' => $ticket->support_ticket_status,
                    'updated_at' => $ticket->support_ticket_updated_at
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update ticket status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
