<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name', 'zipcode', 'address1','address2','district',
        'state','contry','email','mobile','phone',
    ];
}
