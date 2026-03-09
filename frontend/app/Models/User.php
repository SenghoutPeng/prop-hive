<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'user_email',
        'user_password',
        'user_phone',
        'user_profile_picture',
        'is_admin',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    protected $appends = [
        'profile_picture_url',
    ];

    public function setUserProfilePictureAttribute($value): void
    {
        if (!$value) {
            $this->attributes['user_profile_picture'] = null;
            return;
        }

        $path = ltrim((string) $value, '/');

        if (filter_var($path, FILTER_VALIDATE_URL)) {
            $parsedPath = parse_url($path, PHP_URL_PATH);
            $path = $parsedPath ? ltrim($parsedPath, '/') : $path;
        }

        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, strlen('storage/'));
        }

        $this->attributes['user_profile_picture'] = $path;
    }

    public function getProfilePictureUrlAttribute(): ?string
    {
        if (!$this->user_profile_picture) {
            return null;
        }

        if (filter_var($this->user_profile_picture, FILTER_VALIDATE_URL)) {
            return $this->user_profile_picture;
        }

        return Storage::url($this->user_profile_picture);
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->user_password;
    }

    /**
     * Get the email address for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'user_email';
    }

    public function username()
    {
        return 'user_email';
    }
}
