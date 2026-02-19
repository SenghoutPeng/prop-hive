<?php

namespace App\Models\BackendModel;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'user_id', 'type', 'description', 'subject_id', 'subject_type', 'ip_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
