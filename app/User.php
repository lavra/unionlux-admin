<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Lang;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'department',
        'phone',
        'photo',
        'whatsapp',
        'password',
        'active',
        'message_whatsapp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * Se o password estiver no campo aplica a criptografia automáticamente
     * Retorna email com todos os caracteres convertidos para minúsculas.
     *
     * @param array $attributes
     * @return \App\User
     */
    public function fill(array $attributes)
    {
        !isset($attributes['password']) ?: $attributes['password'] = bcrypt($attributes['password']);
        !isset($attributes['email']) ?: $attributes['email'] = strtolower($attributes['email']);
        
        return parent::fill($attributes);
    }


    /**
    * Send the password reset notification.
    *
    * @param  string  $token
    * @return void
    */
    public function sendPasswordResetNotification($token)
    {
        $url = route('password.reset', $token);
        return (new ResetPassword($this->email, $url))
            ->toMail($this->email);
    }
}
