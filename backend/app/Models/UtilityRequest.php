<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UtilityRequest extends Model
{
    protected $table = 'utility_request';
    protected $primaryKey = 'utility_request_id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'property_id',
        'utility_request_description',
        'utility_request_status',
        'utility_request_created_at',
        'utility_request_responded_at',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
} 