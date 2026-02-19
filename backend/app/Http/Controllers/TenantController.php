<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyOwner;
use App\Models\PropertyRenting;
use App\Models\Activity;

class TenantController extends Controller
{
    public function index()
    {
        // List all properties with tenants (join with user table)
        $properties = \App\Models\Property::with('tenant')->get();
        return view('tenant.index', compact('properties'));
    }

    public function create()
    {
        $properties = \App\Models\Property::all();
        return view('tenant.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:user,user_email',
            'user_phone' => 'required|string|max:255',
            'property_id' => 'required|exists:properties,id',
            'user_password' => 'required|string|min:6',
        ]);

        // Create the User
        $user = \App\Models\User::create([
            'user_name' => $validated['user_name'],
            'user_email' => $validated['user_email'],
            'user_phone' => $validated['user_phone'],
            'user_password' => \Illuminate\Support\Facades\Hash::make($validated['user_password']),
        ]);

        // Assign the user as tenant to the property
        $property = \App\Models\Property::find($validated['property_id']);
        $property->tenant_id = $user->user_id; // or $user->id depending on your PK
        $property->save();

        // Log activity (optional)
        $activityUserId = Auth::check() ? Auth::user()->user_id : null;
        \App\Models\Activity::create([
            'user_id' => $activityUserId,
            'type' => 'tenant_create',
            'description' => 'Created tenant ' . $user->user_name . ' for property ID ' . $property->id,
            'subject_id' => $property->id,
            'subject_type' => 'Property',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('tenant.index')->with('success', 'Tenant created and assigned!');
    }

    public function edit($user_id)
    {
        $tenant = \App\Models\User::findOrFail($user_id);
        $properties = \App\Models\Property::where(function($q) use ($user_id) {
            $q->whereNull('tenant_id')->orWhere('tenant_id', $user_id);
        })->get();
        return view('tenant.edit', compact('tenant', 'properties'));
    }

    public function update(Request $request, $user_id)
    {
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:user,user_email,' . $user_id . ',user_id',
            'user_phone' => 'required|string|max:255',
            'property_id' => 'required|exists:properties,id',
            'user_password' => 'nullable|string|min:6',
        ]);

        try {
            DB::transaction(function () use ($validatedData, $user_id, $request) {
                // Update User details
                $user = User::findOrFail($user_id);
                $userUpdateData = [
                    'user_name' => $validatedData['user_name'],
                    'user_email' => $validatedData['user_email'],
                    'user_phone' => $validatedData['user_phone'],
                ];
                if (!empty($validatedData['user_password'])) {
                    $userUpdateData['user_password'] = Hash::make($validatedData['user_password']);
                }
                $user->update($userUpdateData);

                // Update Property assignment
                // Unassign this tenant from any property they are currently assigned to
                Property::where('tenant_id', $user_id)->update(['tenant_id' => null]);
                // Assign to the selected property
                $property = Property::findOrFail($validatedData['property_id']);
                $property->tenant_id = $user_id;
                $property->save();

                // Log activity
                $activityUserId = Auth::check() ? Auth::user()->user_id : null;
                Activity::create([
                    'user_id' => $activityUserId,
                    'type' => 'tenant_edit',
                    'description' => 'Edited tenant ' . $user->user_name . ' for property ID ' . $property->id,
                    'subject_id' => $property->id,
                    'subject_type' => 'Property',
                    'ip_address' => $request->ip(),
                ]);
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update tenant. Please try again.')->withInput();
        }
        
        return redirect()->route('tenant.edit', $user_id)->with('success', 'Tenant updated successfully!');
    }

    public function destroy(PropertyRenting $tenancy)
    {
        // For simplicity, we delete the lease. You might choose to delete the user too.
        $tenancy->delete();
        // Optional: Find and delete the PropertyOwner link
        PropertyOwner::where('user_id', $tenancy->user_id)->delete();

        return redirect()->route('tenant.index')->with('success', 'Tenancy record deleted successfully!');
    }
}