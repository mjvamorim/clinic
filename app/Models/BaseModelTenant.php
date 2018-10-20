<?php

namespace App\Models;
use App\Models\BaseModel;

class BaseModelTenant extends BaseModel
{
    protected $connection = 'tenant';

    public function __construct()
    {      
        $this->setConnection('tenant');
    }

}