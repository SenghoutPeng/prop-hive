<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\SupportTicket;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        \Log::info('Support ticket form submitted', $request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $user = auth()->user();
        $name = $user ? $user->name : $request->name;
        $email = $user ? $user->email : $request->email;

        SupportTicket::create([
            'user_id' => $user ? $user->id : null,
            'name' => $name,
            'user_email' => $email,
            'support_ticket_message' => $request->message,
            'support_ticket_status' => 'pending',
            'support_ticket_created_at' => now(),
            'support_ticket_responded_at' => null,
        ]);

        return redirect()->back()->with('success', 'Thank you for contacting us! Your support ticket has been submitted. Our team will get back to you soon.');
    }

    public function contactAgent(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:191',
            'email'       => 'required|email|max:191',
            'phone'       => 'nullable|string|max:50',
            'message'     => 'required|string|max:2000',
            'property_id' => 'nullable|integer',
            'subject'     => 'nullable|string|max:191',
        ]);

        Contact::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'subject' => $validated['subject'] ?? 'Property Inquiry',
            'message' => $validated['message'],
            'status'  => 'pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Message sent successfully! An agent will contact you soon.']);
    }
}
