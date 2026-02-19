<?php

namespace App\Models\BackendModel;

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
    protected $primaryKey = 'payment_id';

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
        'id',
        'payment_amount',
        'payment_date',
        'payment_status',
        'payment_type',
        'description',
    ];

    protected $casts = [
        'payment_amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'id', 'id');
    }
}