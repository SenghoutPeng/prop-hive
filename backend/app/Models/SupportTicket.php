<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $table = 'support_ticket';
    protected $primaryKey = 'support_ticket_id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'user_email',
        'support_ticket_subject',
        'support_ticket_message',
        'support_ticket_status',
        'support_ticket_created_at',
        'support_ticket_responded_at',
    ];

    // Optionally, add relationships here (e.g., user)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
} 