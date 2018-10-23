<?php

namespace App\Tenant\Models;

use App\Tenant\Models\BaseModel;

class BaseModelTenant extends BaseModel
{
    protected $connection = 'tenant';

    public function __construct()
    {      
        $this->setConnection('tenant');
    }

}