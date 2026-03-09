<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties'; // must match your actual table name
    protected $primaryKey = 'id';    // must match your actual PK
    public $timestamps = true;

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
        'tenant_id',
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'image_url',
    ];

    public function setImagesAttribute($value): void
    {
        if (!$value) {
            $this->attributes['images'] = null;
            return;
        }

        if (is_array($value)) {
            $value = $value[0] ?? null;
            if (!$value) {
                $this->attributes['images'] = null;
                return;
            }
        }

        $path = ltrim((string) $value, '/');

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            $parsedPath = parse_url($path, PHP_URL_PATH);
            $path = $parsedPath ? ltrim($parsedPath, '/') : $path;
        }

        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, strlen('storage/'));
        }

        $this->attributes['images'] = $path;
    }

    public function getImageUrlAttribute(): ?string
    {
        $imagePath = $this->images;

        if (is_array($imagePath)) {
            $imagePath = $imagePath[0] ?? null;
        }

        if (!$imagePath) {
            return null;
        }

        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }

        return Storage::url($imagePath);
    }

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id', 'user_id');
    }
}
