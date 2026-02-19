<?php

namespace App\Http\Controllers\BackEndController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\BackendModel\User;
use App\Models\BackendModel\Property;
use App\Models\BackendModel\PropertyOwner;
use App\Models\BackendModel\PropertyRenting;
use App\Models\BackendModel\Activity;
use App\Http\Controllers\Controller;

class TenantController extends Controller
{
    public function index()
    {
        try {
            // List all properties with tenants (join with user table)
            $properties = Property::with('tenant')->get();
            
            return response()->json([
                'success' => true,
                'data' => $properties->map(function ($property) {
                    return [
                        'id' => $property->id,
                        'tenant' => $property->tenant ? [
                            'id' => $property->tenant->user_id,
                            'name' => $property->tenant->user_name,
                            'email' => $property->tenant->user_email,
                            'phone' => $property->tenant->user_phone
                        ] : null
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch tenants',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        $properties = \App\Models\Property::all();
        return view('tenant.create', compact('properties'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_name' => 'required|string|max:255',
                'user_email' => 'required|email|unique:user,user_email',
                'user_phone' => 'required|string|max:255',
                'property_id' => 'required|exists:properties,id',
                'user_password' => 'required|string|min:6',
            ]);

            // Create the User
            $user = User::create([
                'user_name' => $validated['user_name'],
                'user_email' => $validated['user_email'],
                'user_phone' => $validated['user_phone'],
                'user_password' => Hash::make($validated['user_password']),
            ]);

            // Assign the user as tenant to the property
            $property = Property::find($validated['property_id']);
            $property->tenant_id = $user->user_id;
            $property->save();

            // Log activity
            $activityUserId = Auth::check() ? Auth::user()->user_id : null;
            Activity::create([
                'user_id' => $activityUserId,
                'type' => 'tenant_create',
                'description' => 'Created tenant ' . $user->user_name . ' for property ID ' . $property->id,
                'subject_id' => $property->id,
                'subject_type' => 'Property',
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tenant created and assigned successfully',
                'data' => [
                    'user' => $user,
                    'property' => $property
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create tenant',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($user_id)
    {
        $tenant = \App\Models\User::findOrFail($user_id);
        $properties = \App\Models\Property::where(function($q) use ($user_id) {
            $q->whereNull('tenant_id')->orWhere('tenant_id', $user_id);
        })->get();
        return view('tenant.edit', compact('tenant', 'properties'));
    }

    public function show($id)
    {
        try {
            $user = User::find($id);
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tenant not found'
                ], 404);
            }
            
            $properties = Property::where(function($q) use ($user) {
                $q->whereNull('tenant_id')->orWhere('tenant_id', $user->user_id);
            })->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => $user->user_id,
                        'name' => $user->user_name,
                        'email' => $user->user_email,
                        'phone' => $user->user_phone,
                        'created_at' => $user->created_at
                    ],
                    'available_properties' => $properties->map(function ($property) {
                        return [
                            'id' => $property->id
                        ];
                    })
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch tenant',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tenant not found'
                ], 404);
            }
            
            $validatedData = $request->validate([
                'user_name' => 'required|string|max:255',
                'user_email' => 'required|email|unique:user,user_email,' . $user->user_id . ',user_id',
                'user_phone' => 'required|string|max:255',
                'property_id' => 'required|exists:properties,id',
                'user_password' => 'nullable|string|min:6',
            ]);

            DB::transaction(function () use ($validatedData, $user, $request) {
                // Update User details
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
                Property::where('tenant_id', $user->user_id)->update(['tenant_id' => null]);
                // Assign to the selected property
                $property = Property::findOrFail($validatedData['property_id']);
                $property->tenant_id = $user->user_id;
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

            return response()->json([
                'success' => true,
                'message' => 'Tenant updated successfully',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update tenant',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tenant not found'
                ], 404);
            }
            
            // Remove tenant assignment from properties
            Property::where('tenant_id', $user->user_id)->update(['tenant_id' => null]);
            
            // Delete the user
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tenant deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete tenant',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}