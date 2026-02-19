<?php

namespace App\Models\FrontendModel;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $table = 'support_ticket';
    protected $primaryKey = 'support_ticket_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'user_email',
        'support_ticket_message',
        'support_ticket_status',
        'support_ticket_created_at',
        'support_ticket_responded_at',
    ];

    protected $casts = [
        'support_ticket_created_at' => 'datetime',
        'support_ticket_responded_at' => 'datetime',
    ];
} 