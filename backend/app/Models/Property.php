<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id', 'user_id');
    }
}