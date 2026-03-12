<?php

namespace App\Http\Controllers\FrontEndController;

use App\Models\FrontendModel\Contact;
use App\Models\FrontendModel\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function contactAgent(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'        => 'required|string|max:191',
                'email'       => 'required|email|max:191',
                'phone'       => 'nullable|string|max:50',
                'message'     => 'required|string|max:2000',
                'property_id' => 'nullable|integer',
                'subject'     => 'nullable|string|max:191',
            ]);

            $contact = Contact::create([
                'name'    => $validated['name'],
                'email'   => $validated['email'],
                'subject' => $validated['subject'] ?? 'Property Inquiry',
                'message' => $validated['message'],
                'status'  => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully! An agent will contact you soon.',
                'data'    => ['contact_id' => $contact->id, 'status' => 'pending'],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function submit(Request $request)
    {
        try {
            Log::info('Contact form submitted', $request->all());
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required|string|max:1000',
            ]);

            $user = auth()->user();
            $name = $user ? $user->user_name : $request->name;
            $email = $user ? $user->user_email : $request->email;

            // Create contact entry
            $contact = Contact::create([
                'name' => $name,
                'email' => $email,
                'message' => $request->message,
                'status' => 'pending',
                'created_at' => now(),
            ]);

            // Also create a support ticket for better tracking
            $supportTicket = SupportTicket::create([
                'user_id' => $user ? $user->user_id : null,
                'support_ticket_subject' => 'Contact Form Submission',
                'support_ticket_message' => $request->message,
                'support_ticket_status' => 'pending',
                'support_ticket_created_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for contacting us! Your message has been submitted. Our team will get back to you soon.',
                'data' => [
                    'contact_id' => $contact->id,
                    'ticket_id' => $supportTicket->support_ticket_id,
                    'status' => 'pending',
                    'created_at' => $contact->created_at
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit contact form',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
