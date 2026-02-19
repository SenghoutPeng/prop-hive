<?php

namespace App\Http\Controllers\BackEndController;

use Illuminate\Http\Request;
use App\Models\BackendModel\Payment;
use App\Models\BackendModel\User;
use App\Models\BackendModel\Property;
use App\Models\BackendModel\Activity;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $payments = Payment::with(['user', 'property'])->orderBy('payment_date', 'desc')->get();
            
            return response()->json([
                'success' => true,
                'data' => $payments->map(function ($payment) {
                    return [
                        'id' => $payment->payment_id,
                        'user' => [
                            'id' => $payment->user->user_id,
                            'name' => $payment->user->user_name
                        ],
                        'property' => [
                            'id' => $payment->property->id
                        ],
                        'amount' => $payment->payment_amount,
                        'date' => $payment->payment_date,
                        'status' => $payment->payment_status,
                        'type' => $payment->payment_type,
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch payments',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:user,user_id',
                'id' => 'required|exists:properties,id',
                'payment_amount' => 'required|numeric',
                'payment_date' => 'required|date',
                'payment_status' => 'required',
                'payment_type' => 'required',
            ]);

            $payment = Payment::create($validatedData);

            // Log activity
            $activityUserId = Auth::check() ? Auth::user()->user_id : null;
            Activity::create([
                'user_id' => $activityUserId,
                'type' => 'payment',
                'description' => 'Created payment of $' . $payment->payment_amount . ' for property ID ' . $payment->id,
                'subject_id' => $payment->payment_id,
                'subject_type' => 'Payment',
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment created successfully',
                'data' => $payment
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $payment = Payment::with(['user', 'property'])->find($id);
            
            if (!$payment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $payment->payment_id,
                    'user' => [
                        'id' => $payment->user->user_id,
                        'name' => $payment->user->user_name
                    ],
                    'property' => [
                        'id' => $payment->property->id
                    ],
                    'amount' => $payment->payment_amount,
                    'date' => $payment->payment_date,
                    'status' => $payment->payment_status,
                    'type' => $payment->payment_type,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch payment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $payment = Payment::find($id);
            
            if (!$payment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment not found'
                ], 404);
            }
            
            $validatedData = $request->validate([
                'user_id' => 'required|exists:user,user_id',
                'id' => 'required|exists:properties,id',
                'payment_amount' => 'required|numeric',
                'payment_date' => 'required|date',
                'payment_status' => 'required',
                'payment_type' => 'required',
            ]);

            $payment->update($validatedData);

            // Log activity
            $activityUserId = Auth::check() ? Auth::user()->user_id : null;
            Activity::create([
                'user_id' => $activityUserId,
                'type' => 'payment',
                'description' => 'Updated payment of $' . $payment->payment_amount . ' for property ID ' . $payment->id,
                'subject_id' => $payment->payment_id,
                'subject_type' => 'Payment',
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment updated successfully',
                'data' => $payment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update payment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $payment = Payment::find($id);
            
            if (!$payment) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment not found'
                ], 404);
            }
            
            $payment->delete();

            return response()->json([
                'success' => true,
                'message' => 'Payment deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete payment',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}