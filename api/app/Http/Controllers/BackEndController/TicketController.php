<?php

namespace App\Http\Controllers\BackEndController;

use Illuminate\Http\Request;
use App\Models\BackendModel\SupportTicket;
use App\Models\BackendModel\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

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
                'user_id' => 'nullable|exists:user,user_id',
                'user_email' => 'nullable|email|max:255',
                'name' => 'nullable|string|max:255',
                'support_ticket_subject' => 'nullable|string|max:255|required_without:subject',
                'subject' => 'nullable|string|max:255|required_without:support_ticket_subject',
                'support_ticket_message' => 'nullable|string|required_without:message',
                'message' => 'nullable|string|required_without:support_ticket_message',
                'support_ticket_priority' => 'nullable|in:low,medium,high',
                'priority' => 'nullable|in:low,medium,high',
                'support_ticket_status' => 'nullable|in:open,in_progress,resolved,closed,pending',
            ]);

            $resolvedUserId = $validated['user_id'] ?? null;

            // If request carries a valid Sanctum token, prefer authenticated user's user_id.
            if (!$resolvedUserId && Auth::guard('sanctum')->check()) {
                $resolvedUserId = Auth::guard('sanctum')->user()->user_id;
            }

            // Allow public ticket creation with user_email without requiring user_id.
            if (!$resolvedUserId && !empty($validated['user_email'])) {
                $matchedUser = User::where('user_email', $validated['user_email'])->first();
                $resolvedUserId = $matchedUser ? $matchedUser->user_id : null;
            }

            $resolvedSubject = $validated['support_ticket_subject'] ?? $validated['subject'] ?? null;
            $resolvedMessage = $validated['support_ticket_message'] ?? $validated['message'] ?? null;
            $resolvedPriority = $validated['support_ticket_priority'] ?? $validated['priority'] ?? 'medium';
            $resolvedStatus = $validated['support_ticket_status'] ?? 'open';

            $ticketData = [
                'user_id' => $resolvedUserId,
                'user_email' => $validated['user_email'] ?? null,
                'name' => $validated['name'] ?? null,
                'support_ticket_message' => $resolvedMessage,
                'support_ticket_status' => $resolvedStatus,
                'support_ticket_created_at' => now(),
            ];

            // Keep compatibility with databases that don't have these optional columns yet.
            if (Schema::hasColumn('support_ticket', 'support_ticket_subject')) {
                $ticketData['support_ticket_subject'] = $resolvedSubject;
            } elseif ($resolvedSubject) {
                $ticketData['support_ticket_message'] = '[Subject] ' . $resolvedSubject . "\n\n" . $resolvedMessage;
            }

            if (Schema::hasColumn('support_ticket', 'support_ticket_priority')) {
                $ticketData['support_ticket_priority'] = $resolvedPriority;
            }

            $ticket = SupportTicket::create($ticketData);

            return response()->json([
                'success' => true,
                'message' => 'Ticket created successfully',
                'data' => [
                    'id' => $ticket->support_ticket_id,
                    'user_id' => $ticket->user_id,
                    'user_email' => $ticket->user_email,
                    'name' => $ticket->name,
                    'subject' => $ticket->support_ticket_subject ?? $resolvedSubject,
                    'message' => $ticket->support_ticket_message,
                    'priority' => $ticket->support_ticket_priority ?? $resolvedPriority,
                    'status' => $ticket->support_ticket_status,
                    'created_at' => $ticket->support_ticket_created_at,
                ]
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
