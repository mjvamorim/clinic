<?php

namespace App\Tenant\Models;

use App\Tenant\Models\BaseModel;
use App\Tenant\TenantConnector;

class BaseModelTenantMain extends BaseModel
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


}