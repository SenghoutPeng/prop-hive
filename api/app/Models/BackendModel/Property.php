<?php

namespace App\Models\BackendModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id', 'user_id');
    }
}