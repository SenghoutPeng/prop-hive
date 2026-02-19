<?php

namespace App\Models\FrontendModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityRequest extends Model
{
    use HasFactory;

    protected $table = 'utility_request';
    protected $primaryKey = 'utility_request_id';

    protected $fillable = [
        'user_id',
        'id',
        'description',
        'status',
        'priority',
        'category',
        'admin_response',
        'resolved_at',
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