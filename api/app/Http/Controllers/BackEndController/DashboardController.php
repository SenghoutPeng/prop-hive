<?php

namespace App\Http\Controllers\BackEndController;

use Illuminate\Http\Request;
use App\Models\BackendModel\User;      // Import the User model
use App\Models\BackendModel\Payment;   // Import the Payment model
use App\Models\BackendModel\Property;  // Import the Property model
use App\Models\BackendModel\Activity;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        try {
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

            // Return JSON response
            return response()->json([
                'success' => true,
                'data' => [
                    'stats' => [
                        'active_users' => $activeUsers,
                        'total_sales' => $totalSales,
                        'total_properties' => $totalProperties
                    ],
                    'activities' => $activities->map(function ($activity) {
                        return [
                            'id' => $activity->id,
                            'type' => $activity->type,
                            'description' => $activity->description,
                            'user' => $activity->user ? [
                                'id' => $activity->user->user_id,
                                'name' => $activity->user->user_name
                            ] : null,
                            'created_at' => $activity->created_at
                        ];
                    })
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch dashboard data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}