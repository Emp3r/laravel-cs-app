<?php

namespace App;

use App\UserRole;
use App\Mail\VerifyEmail;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'email', 'name', 'slug', 'bio', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token',
    ];


    /**
     * Every user has one of roles.
     * @return void
     */
    public function role()
    {
        return $this->belongsTo(UserRole::class);
    }


    /**
     * Boot the model. When creating instance, add a token for email verification.
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->token = str_random(30);
        });
    }

    /**
     * Confirm the users email address.
     * @return void
     */
    public function confirmEmail()
    {
        $this->verified = true;
        $this->token = null;
        $this->save();
    }

    /**
     * Re-send the e-mail verifiacion (if not verified from welcome mail).
     * @return void
     */
    public function sendEmailVerification()
    {
        if (! $this->verified)
            Mail::to($this)->send(new VerifyEmail($this));
    }

    /**
     * Send the password reset notification.
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this)->send(new ResetPassword($token));
    }

}
