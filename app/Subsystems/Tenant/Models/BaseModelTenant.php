<?php

namespace App\Subsystems\Tenant\Models;

use App\Subsystems\Tenant\Models\BaseModel;

class BaseModelTenant extends BaseModel
{
    protected $connection = 'tenant';

    public function __construct()
    {      
        $this->setConnection('tenant');
    }

}