<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityRequest extends Model
{
    use HasFactory;

    protected $table = 'utility_request';
    protected $primaryKey = 'utility_request_id';

    protected $fillable = [
        'user_id',
        'property_id',
        'utility_request_description',
        'utility_request_status',
        'utility_request_created_at',
        'utility_request_responded_at',
    ];

    public $timestamps = false;
} 