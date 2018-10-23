<?php

namespace App\Models;
use \App\Tenant\Models\BaseModelTenantMain;

class Company extends BaseModelTenantMain
{

    protected $fillable = [
        'id','name', 'zipcode', 'address1','address2','district',
        'state','country','email','mobile','phone',
        'db_host', 'db_database', 'db_username', 'db_password', ];
        
    protected $rules = [
        'name' => 'required|min:5|max:50',
        'email' => 'required|email',
    ];

    protected $showable = [
        ['name'=>'id',             'title'=>'Id',             'datatable'=>'false', 'form'=>'false', 'type'=>'id',   ],
        ['name'=>'name',           'title'=>'Nome',           'datatable'=>'true',  'form'=>'true',  'type'=>'text', ],
        ['name'=>'email',          'title'=>'Email',          'datatable'=>'true',  'form'=>'true',  'type'=>'text', ],
        ['name'=>'mobile',         'title'=>'Celular',        'datatable'=>'true',  'form'=>'true',  'type'=>'text', ], 
        ['name'=>'phone',          'title'=>'phone',          'datatable'=>'true',  'form'=>'true',  'type'=>'text', ],
        ['name'=>'zipcode',        'title'=>'Cep',            'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'address1',       'title'=>'address1',       'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'address2',       'title'=>'address2',       'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'district',       'title'=>'district',       'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'state',          'title'=>'state',          'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'country',        'title'=>'country',        'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'db_host',        'title'=>'db_host',        'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'db_database',    'title'=>'db_database',    'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'db_username',    'title'=>'db_username', 'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
        ['name'=>'db_password',    'title'=>'db_password', 'datatable'=>'false', 'form'=>'true',  'type'=>'text', ],
    ];



}
