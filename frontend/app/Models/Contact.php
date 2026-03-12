<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{


    protected $table = 'contacts';
    protected $primaryKey = 'id';

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
