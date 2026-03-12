<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'price',
        'type',
        'status',
        'bedrooms',
        'bathrooms',
        'square_feet',
        'address',
        'features',
        'images',
        'owner_id',
        'agent_id',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function getFormattedPriceAttribute()
    {
        return '$' . number_format((float) $this->price, 2);
    }

    public function getMainImageAttribute()
    {
        $images = $this->getRawOriginal('images');

        if (!$images) {
            return null;
        }

        $decoded = json_decode($images, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded[0] ?? null;
        }

        if (str_contains($images, ',')) {
            $parts = array_values(array_filter(array_map('trim', explode(',', $images))));

            return $parts[0] ?? null;
        }

        return $images;
    }
}
