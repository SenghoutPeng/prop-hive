<?php

namespace App\Models\BackendModel;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $table = 'support_ticket';
    protected $primaryKey = 'support_ticket_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'support_ticket_subject',
        'support_ticket_message',
        'support_ticket_status',
        'support_ticket_priority',
        'support_ticket_created_at',
        'support_ticket_responded_at',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
} 