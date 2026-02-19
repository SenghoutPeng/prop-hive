<?php

namespace App\Models\BackendModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    use HasFactory;
    protected $table = 'property_image';
    protected $primaryKey = 'image_id';
    public $timestamps = false;

    protected $fillable = ['property_id', 'image_url'];
}