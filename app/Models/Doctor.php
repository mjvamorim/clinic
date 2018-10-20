<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use App\Models\BaseModelTenant;

class Doctor extends BaseModelTenant
{
      
    protected $fillable = [
        'name', 'zipcode', 'address1','address2','district',
        'state','country','email','mobile','phone',
    ];
}
