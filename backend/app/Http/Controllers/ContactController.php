<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderByDesc('created_at')->get();
        return view('contact.index', compact('contacts'));
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contact.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|string',
            'response' => 'nullable|string|max:2000',
        ]);

        $baseMessage = (string) $contact->message;
        if (str_contains($baseMessage, '--- Admin Response ---')) {
            $parts = explode('--- Admin Response ---', $baseMessage, 2);
            $baseMessage = trim($parts[0]);
        }

        if (!empty($validated['response'])) {
            $contact->message = $baseMessage . "\n\n--- Admin Response ---\n" . trim($validated['response']);
        }

        $contact->status = $validated['status'];
        $contact->assigned_to = null;
        $contact->read_at = now();
        $contact->replied_at = now();
        $contact->save();

        return redirect()->route('contact.index')->with('success', 'Request updated successfully!');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contact.index')->with('success', 'Request deleted successfully!');
    }
}
