<?php

namespace App\Models;
use App\Models\Tenant\BaseModelTenantMain;

class Company extends BaseModelTenantMain
{

    protected $fillable = [
        'id','name', 'zipcode', 'address1','address2','district',
        'state','country','email','mobile','phone',
        'mysql_host', 'mysql_database', 'mysql_username', 'mysql_password', ];
        
    protected $rules = [
        'name' => 'required|min:5|max:50',
        'email' => 'required|email',
    ];

    protected $showable = [
        ['name'=>'id',             'title'=>'Id',              'show'=>'true',  'type'=>'id',   ],
        ['name'=>'name',           'title'=>'Nome',            'show'=>'true',  'type'=>'text', ],
        ['name'=>'email',          'title'=>'Email',           'show'=>'true',  'type'=>'text', ],
        ['name'=>'mobile',         'title'=>'Celular',         'show'=>'true',  'type'=>'text', ], 
        ['name'=>'phone',          'title'=>'phone',           'show'=>'true', 'type'=>'text', ],
        ['name'=>'zipcode',        'title'=>'Cep',             'show'=>'false', 'type'=>'text', ],
        ['name'=>'address1',       'title'=>'address1',        'show'=>'false', 'type'=>'text', ],
        ['name'=>'address2',       'title'=>'address2',        'show'=>'false', 'type'=>'text', ],
        ['name'=>'district',       'title'=>'district',        'show'=>'false', 'type'=>'text', ],
        ['name'=>'state',          'title'=>'state',           'show'=>'false', 'type'=>'text', ],
        ['name'=>'country',        'title'=>'country',          'show'=>'false', 'type'=>'text', ],
        ['name'=>'mysql_host',     'title'=>'mysql_host',      'show'=>'false', 'type'=>'text', ],
        ['name'=>'mysql_database', 'title'=>'mysql_database',  'show'=>'false', 'type'=>'text', ],
        ['name'=>'mysql_username', 'title'=>'mysql_username',  'show'=>'false', 'type'=>'text', ],
        ['name'=>'mysql_password', 'title'=>'mysql_password',  'show'=>'false', 'type'=>'text', ],
    ];



}
