<?php

namespace App\Models\FrontendModel;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{


    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
        'assigned_to',
        'read_at',
        'replied_at',
    ];

    public $timestamps = true;
}
