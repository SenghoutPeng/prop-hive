<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UtilityRequest;
use App\Models\User;
use App\Models\Property;

class UtilityRequestController extends Controller
{
    public function index()
    {
        $utilityRequests = UtilityRequest::with(['user', 'property'])->orderByDesc('utility_request_created_at')->get();
        return view('utility_request.index', compact('utilityRequests'));
    }

    public function edit($id)
    {
        $utilityRequest = UtilityRequest::findOrFail($id);
        $users = User::all();
        $properties = Property::all();
        return view('utility_request.edit', compact('utilityRequest', 'users', 'properties'));
    }

    public function update(Request $request, $id)
    {
        $utilityRequest = UtilityRequest::findOrFail($id);
        $validated = $request->validate([
            'user_id' => 'required|exists:user,user_id',
            'property_id' => 'required|exists:properties,id',
            'utility_request_description' => 'required|string',
            'utility_request_status' => 'required|string',
        ]);
        $utilityRequest->update($validated);
        return redirect()->route('utility-request.index')->with('success', 'Utility request updated successfully!');
    }

    public function destroy($id)
    {
        $utilityRequest = UtilityRequest::findOrFail($id);
        $utilityRequest->delete();
        return redirect()->route('utility-request.index')->with('success', 'Utility request deleted successfully!');
    }
} 