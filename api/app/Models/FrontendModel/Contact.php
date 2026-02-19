<?php

namespace App\Models\FrontendModel;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    

    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'email',
        'message',
        'status',
        'assigned_to',
        'read_at',
        'replied_at',
        'created_at',
        'updated_at',
        
    ];

    public $timestamps = false;
}
