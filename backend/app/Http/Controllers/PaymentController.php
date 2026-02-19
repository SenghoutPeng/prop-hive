<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use App\Models\Property;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource and the create form.
     */
    public function index()
    {
        $payments = Payment::orderBy('payment_date', 'desc')->get();
        $paymentStatuses = ['Pending', 'Completed', 'Failed', 'Refunded'];
        $paymentTypes = ['Credit Card', 'Bank Transfer', 'Cash', 'Digital Wallet'];
        $users = User::all();
        $properties = Property::all();
        $users = User::all();

        return view('payment.index', compact('payments', 'paymentStatuses', 'paymentTypes', 'users', 'properties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:user,user_id',
            'property_id' => 'required|exists:properties,id',
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
            'description' => 'Created payment of $' . $payment->payment_amount . ' for property ID ' . $payment->property_id,
            'subject_id' => $payment->payment_id,
            'subject_type' => 'Payment',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('payment.index')->with('success', 'Payment created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $users = User::all();
        $properties = Property::all();
        return view('payment.edit', compact('payment', 'users', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:user,user_id',
            'property_id' => 'required|exists:properties,id',
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
            'description' => 'Updated payment of $' . $payment->payment_amount . ' for property ID ' . $payment->property_id,
            'subject_id' => $payment->payment_id,
            'subject_type' => 'Payment',
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('payment.index')->with('success', 'Payment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payment.index')->with('success', 'Payment deleted successfully!');
    }
}