<?php

namespace App\Http\Controllers\BackEndController;

use Illuminate\Http\Request;
use App\Models\BackendModel\Contact;
use App\Http\Controllers\Controller;
use App\Models\BackendModel\User;

class ContactController extends Controller
{
    public function index()
    {
        try {
            $contacts = Contact::orderByDesc('created_at')->get();
            
            return response()->json([
                'success' => true,
                'data' => $contacts->map(function ($contact) {
                    return [
                        'id' => $contact->id,
                        'name' => $contact->name,
                        'email' => $contact->email,
                        'phone' => $contact->phone ?? null,
                        'subject' => $contact->subject,
                        'message' => $contact->message,
                        'status' => $contact->status,
                        'assigned_to' => $contact->assigned_to,
                        'read_at' => $contact->read_at,
                        'replied_at' => $contact->replied_at,
                        'created_at' => $contact->created_at,
                        'updated_at' => $contact->updated_at
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch contacts',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Contact $contact)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $contact->id,
                    'name' => $contact->name,
                    'email' => $contact->email,
                    'phone' => $contact->phone ?? null,
                    'subject' => $contact->subject,
                    'message' => $contact->message,
                    'status' => $contact->status,
                    'assigned_to' => $contact->assigned_to,
                    'read_at' => $contact->read_at,
                    'replied_at' => $contact->replied_at,
                    'created_at' => $contact->created_at,
                    'updated_at' => $contact->updated_at
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch contact',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            $contact = Contact::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Contact request submitted successfully',
                'data' => $contact
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit contact request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Contact $contact)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|string',
                'assigned_to' => 'nullable|integer',
                'read_at' => 'nullable|date',
                'replied_at' => 'nullable|date',
            ]);
            
            $contact->update($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Contact request updated successfully',
                'data' => $contact
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update contact request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Contact request deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete contact request',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 