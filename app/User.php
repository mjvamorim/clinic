<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Company;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'main';

    protected $fillable = [
        'name', 'email', 'password','image','mobile'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function getImage() {
        if($this->image) {
            return $this->image;
        } 
        return '/img/users/0000-sem-foto.jpg';
    }
}
