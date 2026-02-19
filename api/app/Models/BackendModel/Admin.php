<?php

namespace App\Models\BackendModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'admin_name',
        'admin_email',
        'admin_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = [
        'admin_password',
        'remember_token',
    ];

    /**
     * Override the default password column name.
     */
    public function getAuthPassword()
    {
        return $this->admin_password;
    }
}