<?php

namespace App\Models\BackendModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyOwner extends Model
{
    use HasFactory;

    protected $table = 'property_owner';
    protected $primaryKey = 'property_owner_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'property_id',
    ];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Define the relationship to the Property model
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
}