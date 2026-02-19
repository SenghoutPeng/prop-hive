<?php

namespace App\Http\Controllers\BackEndController;

use Illuminate\Http\Request;
use App\Models\BackendModel\UtilityBill;
use App\Models\BackendModel\User;
use App\Models\BackendModel\Property;
use App\Models\BackendModel\Activity;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UtilityController extends Controller
{
    public function index()
    {
        try {
            $utilityBills = UtilityBill::with(['user', 'property'])->get();
            
            return response()->json([
                'success' => true,
                'data' => $utilityBills->map(function ($utilityBill) {
                    return [
                        'id' => $utilityBill->utility_bill_id,
                        'user' => [
                            'id' => $utilityBill->user->user_id,
                            'name' => $utilityBill->user->user_name
                        ],
                        'property' => [
                            'id' => $utilityBill->property->id,
                            'title' => $utilityBill->property->property_title
                        ],
                        'type' => $utilityBill->utility_bill_type,
                        'amount' => $utilityBill->utility_bill_amount,
                        'usage' => $utilityBill->utility_bill_usage,
                        'date' => $utilityBill->utility_bill_date,
                        'due_date' => $utilityBill->utility_bill_due_date,
                        'status' => $utilityBill->utility_bill_status,
                        'created_at' => $utilityBill->created_at,
                        'updated_at' => $utilityBill->updated_at
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch utility bills',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:user,user_id',
                'property_id' => 'required|exists:properties,id',
                'utility_bill_type' => 'required',
                'utility_bill_amount' => 'required|numeric',
                'utility_bill_usage' => 'required|numeric',
                'utility_bill_date' => 'required|date',
                'utility_bill_due_date' => 'required|date',
                'utility_bill_status' => 'required',
            ]);

            $utilityBill = UtilityBill::create($validatedData);

            // Log activity
            $activityUserId = Auth::check() ? Auth::user()->user_id : null;
            Activity::create([
                'user_id' => $activityUserId,
                'type' => 'utility_payment',
                'description' => 'Created utility bill of $' . $utilityBill->utility_bill_amount . ' for property ID ' . $utilityBill->property_id,
                'subject_id' => $utilityBill->utility_bill_id,
                'subject_type' => 'UtilityBill',
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Utility bill created successfully',
                'data' => $utilityBill
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create utility bill',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $utilityBill = UtilityBill::with(['user', 'property'])->find($id);
            
            if (!$utilityBill) {
                return response()->json([
                    'success' => false,
                    'message' => 'Utility bill not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $utilityBill->utility_bill_id,
                    'user' => [
                        'id' => $utilityBill->user->user_id,
                        'name' => $utilityBill->user->user_name
                    ],
                    'property' => [
                        'id' => $utilityBill->property->id
                    ],
                    'type' => $utilityBill->utility_bill_type,
                    'amount' => $utilityBill->utility_bill_amount,
                    'usage' => $utilityBill->utility_bill_usage,
                    'date' => $utilityBill->utility_bill_date,
                    'due_date' => $utilityBill->utility_bill_due_date,
                    'status' => $utilityBill->utility_bill_status,
                    'created_at' => $utilityBill->created_at,
                    'updated_at' => $utilityBill->updated_at
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch utility bill',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $utilityBill = UtilityBill::find($id);
            
            if (!$utilityBill) {
                return response()->json([
                    'success' => false,
                    'message' => 'Utility bill not found'
                ], 404);
            }
            
            $validatedData = $request->validate([
                'user_id' => 'required|exists:user,user_id',
                'property_id' => 'required|exists:properties,id',
                'utility_bill_type' => 'required',
                'utility_bill_amount' => 'required|numeric',
                'utility_bill_usage' => 'required|numeric',
                'utility_bill_date' => 'required|date',
                'utility_bill_due_date' => 'required|date',
                'utility_bill_status' => 'required',
            ]);

            $utilityBill->update($validatedData);

            // Log activity
            $activityUserId = Auth::check() ? Auth::user()->user_id : null;
            Activity::create([
                'user_id' => $activityUserId,
                'type' => 'utility_payment',
                'description' => 'Updated utility bill of $' . $utilityBill->utility_bill_amount . ' for property ID ' . $utilityBill->property_id,
                'subject_id' => $utilityBill->utility_bill_id,
                'subject_type' => 'UtilityBill',
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Utility bill updated successfully',
                'data' => $utilityBill
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update utility bill',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $utilityBill = UtilityBill::find($id);
            
            if (!$utilityBill) {
                return response()->json([
                    'success' => false,
                    'message' => 'Utility bill not found'
                ], 404);
            }
            
            $utilityBill->delete();

            return response()->json([
                'success' => true,
                'message' => 'Utility bill deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete utility bill',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}