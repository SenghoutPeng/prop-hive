<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'payment';

    /**
     * The primary key associated with the table.
     * @var string
     */
    protected $primaryKey = 'payment_id'; // <-- ADD THIS LINE

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id',
        'property_id',
        'payment_amount',
        'payment_date',
        'payment_status',
        'payment_type',
    ];
}