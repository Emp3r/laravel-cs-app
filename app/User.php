<?php

namespace App;

use App\Mail\VerifyEmail;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The user attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'email', 'name', 'slug', 'bio', 'password',
    ];

    /**
     * The user attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'token',
    ];

    /**
     * Every user has one of the roles (instance of UserRole).
     * @return void
     */
    public function role()
    {
        return $this->belongsTo('App\UserRole');
    }

    /**
     * Verify the user's email address.
     * @return void
     */
    public function confirmEmail()
    {
        $this->verified = true;
        $this->token = null;
        $this->save();
    }

    /**
     * Unverify the user's email address.
     * @return void
     */
    public function unconfirmEmail()
    {
        $this->verified = false;
        $this->token = str_random(30);
        $this->save();
    }

    /**
     * Boot the model. When creating an instance, add a token for email verification.
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

    public function avatarPath()
    {
        return '/img/avatars/'.$this->avatar;
        // return public_path('img/avatars/'.$this->avatar);
    }

}
