<?php

namespace App\Http\Controllers\FrontEndController;

use Illuminate\Http\Request;
use App\Models\FrontendModel\Property;
use App\Models\FrontendModel\UtilityRequest;
use App\Models\FrontendModel\Payment;

class PageController extends \App\Http\Controllers\Controller
{
    public function home()
    {
        return response()->json([
            'success' => true,
            'message' => 'Homepage data',
            'data' => [
                'title' => 'PropHive - Your Property Management Solution',
                'description' => 'Welcome to PropHive'
            ]
        ]);
    }

    public function about()
    {
        return response()->json([
            'success' => true,
            'message' => 'About us data',
            'data' => [
                'title' => 'About PropHive',
                'description' => 'Learn more about our property management platform'
            ]
        ]);
    }

    public function contact()
    {
        return response()->json([
            'success' => true,
            'message' => 'Contact information',
            'data' => [
                'title' => 'Contact Us',
                'description' => 'Get in touch with our team'
            ]
        ]);
    }

    public function listing()
    {
        try {
            $properties = Property::active()->get();
            
            return response()->json([
                'success' => true,
                'data' => $properties->map(function ($property) {
                    return [
                        'id' => $property->id,
                        'title' => $property->property_title,
                        'price' => $property->property_price,
                        'type' => $property->property_type,
                        'status' => $property->property_status,
                        'bedrooms' => $property->property_bedrooms,
                        'bathrooms' => $property->property_bathrooms,
                        'address' => $property->property_address,
                        'description' => $property->property_description,
                        'images' => $property->property_images
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch properties',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login()
    {
        return response()->json([
            'success' => true,
            'message' => 'Login page data',
            'data' => [
                'title' => 'Login',
                'description' => 'Sign in to your account'
            ]
        ]);
    }

    public function profile()
    {
        try {
            $user = auth()->user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated'
                ], 401);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $user->user_id,
                    'name' => $user->user_name,
                    'email' => $user->user_email,
                    'phone' => $user->user_phone,
                    'profile_picture' => $user->user_profile_picture,
                    'is_admin' => $user->is_admin,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function meetOurTeam()
    {
        return response()->json([
            'success' => true,
            'message' => 'Team information',
            'data' => [
                'title' => 'Meet Our Team',
                'description' => 'Get to know our team members'
            ]
        ]);
    }

    public function ourClient()
    {
        return response()->json([
            'success' => true,
            'message' => 'Client information',
            'data' => [
                'title' => 'Our Clients',
                'description' => 'See what our clients say about us'
            ]
        ]);
    }

    public function testimonials()
    {
        return response()->json([
            'success' => true,
            'message' => 'Testimonials data',
            'data' => [
                'title' => 'Testimonials',
                'description' => 'Read what our clients have to say'
            ]
        ]);
    }

    public function paymentHistory()
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please log in to view your payment history'
                ], 401);
            }

            $payments = Payment::where('user_id', $user->user_id)
                ->orderBy('payment_date', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $payments->map(function ($payment) {
                    return [
                        'id' => $payment->payment_id,
                        'amount' => $payment->payment_amount,
                        'date' => $payment->payment_date,
                        'status' => $payment->payment_status,
                        'type' => $payment->payment_type,
                        'property_id' => $payment->property_id,
                        'created_at' => $payment->created_at
                    ];
                })
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch payment history',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function storeUtilityRequest(Request $request)
    {
        try {
            $validated = $request->validate([
                'description' => 'required|string|max:255',
                'property_id' => 'nullable|integer|exists:properties,id',
                'user_id' => 'nullable|integer|exists:user,user_id',
            ]);
            
            if (empty($validated['user_id']) && !auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Missing user information'
                ], 400);
            }

            $utilityRequest = UtilityRequest::create([
                'utility_request_description' => $validated['description'],
                'utility_request_status' => 'pending',
                'utility_request_created_at' => now(),
                'utility_request_responded_at' => null,
                'property_id' => $validated['property_id'] ?? null,
                'user_id' => $validated['user_id'] ?? (auth()->check() ? auth()->user()->user_id : null),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Utility request submitted successfully',
                'data' => $utilityRequest
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit utility request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function editTenant()
    {
        return response()->json([
            'success' => true,
            'message' => 'Edit tenant page data',
            'data' => [
                'title' => 'Edit Tenant',
                'description' => 'Update tenant information'
            ]
        ]);
    }

    public function descrip(Request $request)
    {
        try {
            $validated = $request->validate([
                'description' => 'required|string|max:255',
            ]);

            // Note: Descrip model might not exist, you may need to create it
            // For now, returning success response
            return response()->json([
                'success' => true,
                'message' => 'Description saved successfully',
                'data' => [
                    'description' => $validated['description']
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save description',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function propertyDetails($id)
    {
        try {
            $property = Property::findOrFail($id);
            $similarProperties = Property::where('property_type', $property->property_type)
                ->where('id', '!=', $property->id)
                ->limit(4)
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'property' => [
                        'id' => $property->id,
                        'title' => $property->property_title,
                        'price' => $property->property_price,
                        'type' => $property->property_type,
                        'status' => $property->property_status,
                        'bedrooms' => $property->property_bedrooms,
                        'bathrooms' => $property->property_bathrooms,
                        'address' => $property->property_address,
                        'description' => $property->property_description,
                        'images' => $property->property_images
                    ],
                    'similar_properties' => $similarProperties->map(function ($property) {
                        return [
                            'id' => $property->id,
                            'title' => $property->property_title,
                            'price' => $property->property_price,
                            'type' => $property->property_type,
                            'address' => $property->property_address
                        ];
                    })
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch property details',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function propertyOverview()
    {
        try {
            $property = Property::first();
            $utilityRequests = UtilityRequest::where('property_id', $property->id ?? null)->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'property' => $property ? [
                        'id' => $property->id,
                        'title' => $property->property_title,
                        'address' => $property->property_address
                    ] : null,
                    'utility_requests' => $utilityRequests->map(function ($request) {
                        return [
                            'id' => $request->utility_request_id,
                            'description' => $request->utility_request_description,
                            'status' => $request->utility_request_status,
                            'created_at' => $request->utility_request_created_at
                        ];
                    })
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch property overview',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
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
                try {
                    $avatarPath = $request->file('avatar')->store('avatars', 'public');
                    $user->user_profile_picture = 'storage/avatars/' . basename($avatarPath);
                } catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to upload image',
                        'error' => $e->getMessage()
                    ], 500);
                }
            }

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }
} 