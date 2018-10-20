<?php

namespace App\Models;
use App\Models\BaseModelTenant;

class Doctor extends BaseModelTenant
{
    protected $fillable = [
        'name', 'zipcode', 'address1','address2','district',
        'state','country','email','mobile','phone',
    ];

    protected $showable = [
        ['name'=>'id',             'title'=>'Id',              'show'=>'true',  'type'=>'id',   ],
        ['name'=>'name',           'title'=>'Nome',            'show'=>'true',  'type'=>'text', ],
        ['name'=>'email',          'title'=>'Email',           'show'=>'true',  'type'=>'text', ],
        ['name'=>'mobile',         'title'=>'Celular',         'show'=>'true',  'type'=>'text', ], 
        ['name'=>'phone',          'title'=>'phone',           'show'=>'false', 'type'=>'text', ],
        ['name'=>'zipcode',        'title'=>'ZipCode',         'show'=>'false', 'type'=>'text', ],
        ['name'=>'address1',       'title'=>'address1',        'show'=>'false', 'type'=>'text', ],
        ['name'=>'address2',       'title'=>'address2',        'show'=>'false', 'type'=>'text', ],
        ['name'=>'district',       'title'=>'district',        'show'=>'false', 'type'=>'text', ],
        ['name'=>'state',          'title'=>'state',           'show'=>'false', 'type'=>'text', ],
        ['name'=>'country',        'title'=>'country',          'show'=>'false', 'type'=>'text', ],
    ];
}
