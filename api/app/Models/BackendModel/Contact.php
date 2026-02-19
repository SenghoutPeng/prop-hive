<?php

namespace App\Models\BackendModel;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
        'assigned_to',
        'read_at',
        'replied_at',
        'created_at',
        'updated_at',
    ];

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }
} 