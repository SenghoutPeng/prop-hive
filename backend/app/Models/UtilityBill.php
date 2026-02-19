<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityBill extends Model
{
    use HasFactory;

    // ... your other properties ($table, $primaryKey, etc.) ...
    protected $table = 'utility_bill';
    protected $primaryKey = 'utility_bill_id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'property_id',
        'utility_bill_type',
        'utility_bill_usage',
        'utility_bill_amount',
        'utility_bill_date',
        'utility_bill_due_date',
        'utility_bill_status',
    ];


    /**
     * Get the user that owns the utility bill.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}