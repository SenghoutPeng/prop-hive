<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UtilityBill;
use App\Models\User;
use App\Models\Property;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class UtilityController extends Controller
{
    public function index()
    {
        $utilityBills = UtilityBill::all();
        $users = User::all();
        $properties = Property::all();
        $statuses = ['Pending', 'Paid', 'Overdue'];
        $types = ['Electricity', 'Water'];

        return view('utility.index', compact('utilityBills', 'users', 'properties', 'statuses', 'types'));
    }

    public function store(Request $request)
    {
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

        return redirect()->route('utility.index')->with('success', 'Utility bill created successfully!');
    }

    public function edit(UtilityBill $utilityBill)
    {
        $users = User::all();
        $properties = Property::all();
        $statuses = ['Pending', 'Paid', 'Overdue'];
        $types = ['Electricity', 'Water'];

        return view('utility.edit', compact('utilityBill', 'users', 'properties', 'statuses', 'types'));
    }

    public function update(Request $request, UtilityBill $utilityBill)
    {
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

        return redirect()->route('utility.index')->with('success', 'Utility bill updated successfully!');
    }

    public function destroy(UtilityBill $utilityBill)
    {
        $utilityBill->delete();

        return redirect()->route('utility.index')->with('success', 'Utility bill deleted successfully!');
    }
}