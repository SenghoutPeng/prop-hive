<?php

namespace App\Models\FrontendModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityRequest extends Model
{
    use HasFactory;

    protected $table = 'utility_request';
    protected $primaryKey = 'utility_request_id';
public $timestamps = false;
   protected $fillable = [
    'utility_request_description',
    'utility_request_status',
    'utility_request_created_at',
    'utility_request_responded_at',
    'property_id',
    'user_id'
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
        return $this->belongsTo(Property::class);
    }
}
