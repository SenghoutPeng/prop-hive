<?php

namespace App\Http\Controllers\BackEndController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\BackendModel\Property;
use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function index()
    {
        try {
            $properties = Property::orderBy('id', 'desc')->take(4)->get();
            
            return response()->json([
                'success' => true,
                'data' => $properties->map(function ($property) {
                    return [
                        'id' => $property->id,
                        'title' => $property->title,
                        'price' => $property->price,
                        'type' => $property->type,
                        'status' => $property->status,
                        'bedrooms' => $property->bedrooms,
                        'bathrooms' => $property->bathrooms,
                        'square_feet' => $property->square_feet,
                        'address' => $property->address,
                        'features' => $property->features,
                        'description' => $property->description,
                        'images' => $property->images,
                        'created_at' => $property->created_at,
                        'updated_at' => $property->updated_at
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

    public function listAll()
    {
        try {
            $properties = Property::orderBy('id', 'desc')->get();
            
            return response()->json([
                'success' => true,
                'data' => $properties->map(function ($property) {
                    return [
                        'id' => $property->id,
                        'title' => $property->title,
                        'price' => $property->price,
                        'type' => $property->type,
                        'status' => $property->status,
                        'bedrooms' => $property->bedrooms,
                        'bathrooms' => $property->bathrooms,
                        'square_feet' => $property->square_feet,
                        'address' => $property->address,
                        'features' => $property->features,
                        'description' => $property->description,
                        'images' => $property->images,
                        'created_at' => $property->created_at,
                        'updated_at' => $property->updated_at
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

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:191',
                'price' => 'required|numeric',
                'type' => 'required|string|max:20',
                'status' => 'nullable|string|max:20',
                'bedrooms' => 'nullable|integer',
                'bathrooms' => 'nullable|integer',
                'square_feet' => 'nullable|integer',
                'address' => 'required|string|max:191',
                'features' => 'nullable|string|max:255',
                'description' => 'required|string',
                'images' => 'nullable|string|max:255',
            ]);

            $property = Property::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Property created successfully',
                'data' => $property
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create property',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $property = Property::find($id);
            
            if (!$property) {
                return response()->json([
                    'success' => false,
                    'message' => 'Property not found'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $property->id,
                    'title' => $property->title,
                    'price' => $property->price,
                    'type' => $property->type,
                    'status' => $property->status,
                    'bedrooms' => $property->bedrooms,
                    'bathrooms' => $property->bathrooms,
                    'square_feet' => $property->square_feet,
                    'address' => $property->address,
                    'features' => $property->features,
                    'description' => $property->description,
                    'images' => $property->images,
                    'created_at' => $property->created_at,
                    'updated_at' => $property->updated_at
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch property',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $property = Property::find($id);
            
            if (!$property) {
                return response()->json([
                    'success' => false,
                    'message' => 'Property not found'
                ], 404);
            }
            
            $validated = $request->validate([
                'title' => 'required|string|max:191',
                'price' => 'required|numeric',
                'type' => 'required|string|max:20',
                'status' => 'nullable|string|max:20',
                'bedrooms' => 'nullable|integer',
                'bathrooms' => 'nullable|integer',
                'square_feet' => 'nullable|integer',
                'address' => 'required|string|max:191',
                'features' => 'nullable|string|max:255',
                'description' => 'required|string',
                'images' => 'nullable|string|max:255',
            ]);

            $property->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Property updated successfully',
                'data' => $property
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update property',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $property = Property::find($id);
            
            if (!$property) {
                return response()->json([
                    'success' => false,
                    'message' => 'Property not found'
                ], 404);
            }
            
            $property->delete();

            return response()->json([
                'success' => true,
                'message' => 'Property deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete property',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}