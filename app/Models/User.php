<?php


namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'phone','district','address'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function profile(){
        return $this->hasOne('App\Profile');
    }
}
