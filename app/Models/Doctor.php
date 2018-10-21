<?php

namespace App\Models;
use App\Models\Tenant\BaseModelTenant;

class Doctor extends BaseModelTenant
{
    protected $fillable = [ 
        'name', 'email','mobile','phone', 'zipcode', 'address1','address2','district', 'city', 'state','country', 
    ];

    protected $rules = [
        'name' => 'required|min:5|max:50',
        'email' => 'required|email',
    ];

    protected $showable = [
        ['name'=>'id',       'title'=>'Id',       'datatable'=>'false',  'form'=>'true', 'type'=>'id',   ],
        ['name'=>'name',     'title'=>'Nome',     'datatable'=>'true',  'form'=>'true', 'type'=>'text', ],
        ['name'=>'email',    'title'=>'Email',    'datatable'=>'true',  'form'=>'true', 'type'=>'text', ],
        ['name'=>'mobile',   'title'=>'Celular',  'datatable'=>'true',  'form'=>'true', 'type'=>'text', ], 
        ['name'=>'phone',    'title'=>'Phone',    'datatable'=>'false', 'form'=>'true', 'type'=>'text', ],
        ['name'=>'zipcode',  'title'=>'ZipCode',  'datatable'=>'false', 'form'=>'true', 'type'=>'text', ],
        ['name'=>'address1', 'title'=>'Address1', 'datatable'=>'false', 'form'=>'true', 'type'=>'text', ],
        ['name'=>'address2', 'title'=>'Address2', 'datatable'=>'false', 'form'=>'true', 'type'=>'text', ],
        ['name'=>'district', 'title'=>'District', 'datatable'=>'false', 'form'=>'true', 'type'=>'text', ],
        ['name'=>'citi',     'title'=>'City',     'datatable'=>'false', 'form'=>'true', 'type'=>'text', ],
        ['name'=>'state',    'title'=>'State',    'datatable'=>'false', 'form'=>'true', 'type'=>'text', ],
        ['name'=>'country',  'title'=>'Country',  'datatable'=>'false', 'form'=>'true', 'type'=>'text', ],
    ];


}
