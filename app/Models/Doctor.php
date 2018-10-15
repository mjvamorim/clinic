<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class Doctor extends Model
{
    protected $connection = 'tenant';

    public function __construct()
    {      
        //echo 'Conection: '.Schema::connection('tenant')->getConnection();
        echo '</br>Config: '.Config::get('database.connections.tenant.database');
        
        $this->setConnection('tenant');
    }

    protected $fillable = [
        'name', 'zipcode', 'address1','address2','district',
        'state','contry','email','mobile','phone',
    ];
}
