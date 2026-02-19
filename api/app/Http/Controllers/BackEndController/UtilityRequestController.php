<?php

namespace App\Http\Controllers\BackEndController;

use Illuminate\Http\Request;
use App\Models\BackendModel\UtilityRequest;
use App\Models\BackendModel\User;
use App\Models\BackendModel\Property;
use App\Http\Controllers\Controller;

class UtilityRequestController extends Controller
{
    public function index()
    {
        try {
            $utilityRequests = UtilityRequest::with(['user', 'property'])->orderByDesc('utility_request_created_at')->get();
            
            return response()->json([
                'success' => true,
                'data' => $utilityRequests->map(function ($utilityRequest) {
                    return [
                        'id' => $utilityRequest->utility_request_id,
                        'user' => $utilityRequest->user ? [
                            'id' => $utilityRequest->user->user_id,
                            'name' => $utilityRequest->user->user_name
                        ] : null,
                        'property' => $utilityRequest->property ? [
                            'id' => $utilityRequest->property->id,
                            'title' => $utilityRequest->property->property_title
                        ] : null,
                        'description' => $utilityRequest->utility_request_description,
                        'status' => $utilityRequest->utility_request_status,
                        'created_at' => $utilityRequest->utility_request_created_at,
                        'responded_at' => $utilityRequest->utility_request_responded_at,
                        'updated_at' => $utilityRequest->updated_at
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch utility requests',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(UtilityRequest $utilityRequest)
    {
        try {
            $utilityRequest->load(['user', 'property']);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $utilityRequest->utility_request_id,
                    'user' => $utilityRequest->user ? [
                        'id' => $utilityRequest->user->user_id,
                        'name' => $utilityRequest->user->user_name
                    ] : null,
                    'property' => $utilityRequest->property ? [
                        'id' => $utilityRequest->property->id,
                        'title' => $utilityRequest->property->property_title
                    ] : null,
                    'description' => $utilityRequest->utility_request_description,
                    'status' => $utilityRequest->utility_request_status,
                    'created_at' => $utilityRequest->utility_request_created_at,
                    'responded_at' => $utilityRequest->utility_request_responded_at,
                    'updated_at' => $utilityRequest->updated_at
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch utility request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:user,user_id',
                'id' => 'required|exists:properties,id',
                'utility_request_description' => 'required|string',
                'utility_request_status' => 'required|in:pending,in_progress,completed,cancelled'
            ]);

            $utilityRequest = UtilityRequest::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Utility request created successfully',
                'data' => $utilityRequest
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create utility request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, UtilityRequest $utilityRequest)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|exists:user,user_id',
                'id' => 'required|exists:properties,id',
                'utility_request_description' => 'required|string',
                'utility_request_status' => 'required|string',
            ]);
            
            $utilityRequest->update($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Utility request updated successfully',
                'data' => $utilityRequest
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update utility request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(UtilityRequest $utilityRequest)
    {
        try {
            $utilityRequest->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Utility request deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete utility request',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 