<?php

namespace App\Models\Tenant;
use App\Models\Tenant\BaseModel;

class BaseModelTenant extends BaseModel
{
    protected $connection = 'tenant';

    public function __construct()
    {      
        $this->setConnection('tenant');
    }

}