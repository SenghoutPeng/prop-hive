<?php

namespace App\Models\BackendModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityBill extends Model
{
    use HasFactory;

    protected $table = 'utility_bill';
    protected $primaryKey = 'utility_bill_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'property_id',
        'bill_type',
        'usage',
        'amount',
        'bill_date',
        'due_date',
        'status',
    ];

    protected $casts = [
        'usage' => 'decimal:2',
        'amount' => 'decimal:2',
        'bill_date' => 'date',
        'due_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}