<?php

namespace App\Models;

use App\Helpers\Helper;
use Laravel\Passport\HasApiTokens;
use App\Notifications\CustomVerifyEmail;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_code',
        'phone_number',
        'photo',
        'role_id',
        'is_complete_profile',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    /**
     * GetPhotoUrlAttribute
     *
     * @return void
     */
    public function getPhotoUrlAttribute()
    {
        return $this->attributes['photo'] != null ? Helper::assets(config('constant.profile_image_url') . $this->attributes['photo']) : Helper::assets('app-assets/images/user.png');
    }

    public function userLoginDevices()
    {
        return $this->hasMany(UserLoginDevice::class, 'user_id', 'id');
    }

    /**
     * Send activation mail
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail());
    }

    /**
     * Reset password mail
     *
     * @param  mixed $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

    /**
     * When Verify user his account then update the is active status
     *
     * @return void
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill(
            [
                'email_verified_at' => $this->freshTimestamp(),
                'is_active' => 1,
            ]
        )->save();
    }

    // This is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            // Before delete() method call this
            if (isset($model->userLoginDevices) && !empty($model->userLoginDevices)) {
                foreach ($model->userLoginDevices as $row) {
                    $row->delete();
                }
            }
        });
    }
}
