<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\TenantConnector;

class Company extends BaseModel
{
    use TenantConnector;
       
    protected $connection = 'main';
    /**
     * @return $this
     */
    public function connect() {
        $this->reconnect($this);
        return $this;
    }

    protected $fillable = [
        'id','name', 'zipcode', 'address1','address2','district',
        'state','country','email','mobile','phone',
        'mysql_host', 'mysql_database', 'mysql_username', 'mysql_password', ];

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
        ['name'=>'mysql_host',     'title'=>'mysql_host',      'show'=>'false', 'type'=>'text', ],
        ['name'=>'mysql_database', 'title'=>'mysql_database',  'show'=>'false', 'type'=>'text', ],
        ['name'=>'mysql_username', 'title'=>'mysql_username',  'show'=>'false', 'type'=>'text', ],
        ['name'=>'mysql_password', 'title'=>'mysql_password',  'show'=>'false', 'type'=>'text', ],
    ];



}
