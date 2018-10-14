<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','image'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getImage() {
        if($this->image) {
            return $this->image;
        } 
        return 'img/users/0000-sem-foto.jpg';
    }
}
