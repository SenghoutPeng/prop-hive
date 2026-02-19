<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRenting extends Model
{
    use HasFactory;

    protected $table = 'property_renting';
    protected $primaryKey = 'property_renting_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'property_owner_id',
        'property_renting_amount',
        'property_renting_start_date',
        'property_renting_end_date',
        'rental_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function propertyOwner()
    {
        return $this->belongsTo(PropertyOwner::class, 'property_owner_id', 'property_owner_id');
    }
}