<?php

namespace App\Models\BackendModel;

use Illuminate\Database\Eloquent\Model;

class UtilityRequest extends Model
{
    protected $table = 'utility_request';
    protected $primaryKey = 'utility_request_id';

    protected $fillable = [
        'user_id',
        'id',
        'utility_request_description',
        'utility_request_status',
        'utility_request_created_at',
        'utility_request_responded_at',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'id', 'id');
    }
} 