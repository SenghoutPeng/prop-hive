<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Property;

class PropertyController extends Controller
{
    private function imageDisk(): string
    {
        $disk = config('filesystems.default', 'public');

        // In local dev, /storage URLs are served from the public disk target.
        return $disk === 'local' ? 'public' : $disk;
    }

    private function normalizeStoredPath($path): ?string
    {
        if (!$path) {
            return null;
        }

        if (is_array($path)) {
            $path = $path[0] ?? null;
            if (!$path) {
                return null;
            }
        }

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            $parsedPath = parse_url($path, PHP_URL_PATH);
            $path = $parsedPath ?: $path;
        }

        $path = ltrim($path, '/');

        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, strlen('storage/'));
        }

        return $path;
    }

    public function index()
    {
        $properties = Property::orderBy('id', 'desc')->get();
        return view('property.index', compact('properties'));
    }

    public function listAll()
    {
        $properties = Property::orderBy('id', 'desc')->get();
        return view('property.list', compact('properties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'type' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'square_feet' => 'nullable|integer',
            'address' => 'required|string|max:255',
            'features' => 'nullable|string',
            'description' => 'required|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $propertyData = $validated;
        if ($request->hasFile('images')) {
            $path = $request->file('images')->store('properties', $this->imageDisk());
            $propertyData['images'] = $path;
        } else {
            $propertyData['images'] = null;
        }
        $propertyData['owner_id'] = null;
        Property::create($propertyData);
        return redirect()->route('property.index')->with('success', 'Property added successfully!');
    }

    public function edit(Property $property)
    {
        return view('property.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'type' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'square_feet' => 'nullable|integer',
            'address' => 'required|string|max:255',
            'features' => 'nullable|string',
            'description' => 'required|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $propertyData = $validated;
        if ($request->hasFile('images')) {
            if ($property->images) {
                $oldPath = $this->normalizeStoredPath($property->images);
                if ($oldPath) {
                    Storage::disk($this->imageDisk())->delete($oldPath);
                }
            }
            $path = $request->file('images')->store('properties', $this->imageDisk());
            $propertyData['images'] = $path;
        } else {
            // If no new image uploaded, keep the old one
            $propertyData['images'] = $property->images;
        }
        $property->update($propertyData);
        return redirect()->route('property.index')->with('success', 'Property updated successfully!');
    }

    public function destroy(Property $property)
    {
        if ($property->images) {
            $storedPath = $this->normalizeStoredPath($property->images);
            if ($storedPath) {
                Storage::disk($this->imageDisk())->delete($storedPath);
            }
        }
        $property->delete();
        return redirect()->route('property.index')->with('success', 'Property deleted successfully!');
    }
}
