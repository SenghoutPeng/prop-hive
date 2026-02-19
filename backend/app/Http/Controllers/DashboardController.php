<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;      // Import the User model
use App\Models\Payment;   // Import the Payment model
use App\Models\Property;  // Import the Property model
use App\Models\Activity;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get live data from the database
        $activeUsers = User::count();
        $totalSales = Payment::sum('payment_amount');
        $totalProperties = Property::count();

        // Fetch recent activities, filterable by type
        $query = Activity::with('user')->orderBy('created_at', 'desc');
        if ($request->has('activity_type') && $request->activity_type !== 'all') {
            $query->where('type', $request->activity_type);
        }
        $activities = $query->limit(20)->get();

        // Pass the new variables to the view
        if ($request->ajax()) {
            return view('partials.activity-table', ['activities' => $activities, 'ajaxWrapper' => true]);
        }
        return view('dashboard', compact('activeUsers', 'totalSales', 'totalProperties', 'activities'));
    }
}