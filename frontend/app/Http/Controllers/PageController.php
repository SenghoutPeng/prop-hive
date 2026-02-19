<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\UtilityRequest;
use App\Models\Payment;

class PageController extends Controller
{
    public function home()
    {
        return view('homepage');
    }

    public function about()
    {
        return view('about-us');
    }

    public function contact()
    {
        return view('contact-us');
    }

    public function listing()
    {
        $properties = Property::active()->get();
        return view('listing', compact('properties'));
    }

    public function login()
    {
        return view('login');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function meetOurTeam()
    {
        return view('meet-our-team');
    }

    public function ourClient()
    {
        return view('our-client');
    }

    public function testimonials()
    {
        return view('testimonials');
    }

    public function paymentHistory()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to view your payment history.');
        }
        $payments = \App\Models\Payment::where('user_id', $user->user_id)
            ->orderBy('payment_date', 'desc')
            ->get();
        return view('payment-history', compact('payments'));
    }

    public function storeUtilityRequest(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'property_id' => 'nullable|integer|exists:properties,id',
            'user_id' => 'nullable|integer|exists:user,user_id',
        ]);
        
        if (empty($validated['user_id']) && !auth()->check()) {
            \Log::error('Missing user_id for utility request', $validated);
            return redirect()->back()->with('error', 'Missing user information.');
        }

        UtilityRequest::create([
            'utility_request_description' => $validated['description'],
            'utility_request_status' => 'pending',
            'utility_request_created_at' => now(),
            'utility_request_responded_at' => null,
            'property_id' => $validated['property_id'] ?? null,
            'user_id' => $validated['user_id'] ?? (auth()->check() ? auth()->user()->user_id : null),
        ]);
    
        return redirect()->back()->with('success', 'Utility request submitted!');
    }
    public function editTenant()
    {
        return view('edit-tenant');
    }

public function descrip(Request $request)
{
    $validated = $request->validate([
        'description' => 'required|string|max:255',
    ]);

    // Save a new record
    $descrip = new Descrip();
    $descrip->description = $validated['description'];
    $descrip->save();

    return redirect()->back()->with('success', 'Description saved successfully');
}


    public function propertyDetails($id)
    {
        $property = Property::findOrFail($id);
        $similarProperties = Property::where('type', $property->type)
            ->where('id', '!=', $property->id)
            ->limit(4)
            ->get();
        return view('property-details', compact('property', 'similarProperties'));
    }

    public function propertyOverview()
    {
        // For demo, fetch the first property and its utility requests
        $property = \App\Models\Property::first();
        $utilityRequests = \App\Models\UtilityRequest::where('property_id', $property->id ?? null)->get();
        return view('property-overview', compact('property', 'utilityRequests'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:user,user_email,' . $user->user_id . ',user_id',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $user->user_name = $validated['first_name'];
        $user->user_email = $validated['email'];
        $user->user_phone = $validated['phone'] ?? null;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->user_profile_picture = 'storage/' . $avatarPath;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
} 