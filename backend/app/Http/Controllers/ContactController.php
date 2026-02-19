<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;

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
        $users = User::all();
        return view('contact.edit', compact('contact', 'users'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|string',
            'assigned_to' => 'nullable|integer',
            'read_at' => 'nullable|date',
            'replied_at' => 'nullable|date',
        ]);
        $contact->update($validated);
        return redirect()->route('contact.index')->with('success', 'Request updated successfully!');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contact.index')->with('success', 'Request deleted successfully!');
    }
} 