<?php

namespace App\Models\BackendModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';
    protected $primaryKey = 'id';
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
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
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
        if (!$this->images) {
            return null;
        }

        if (filter_var($this->images, FILTER_VALIDATE_URL)) {
            return $this->images;
        }

        return Storage::url($this->images);
    }

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id', 'user_id');
    }
}
