<?php

namespace App\Subsystems\Tenant\Models;

use App\Subsystems\Tenant\Models\BaseModel;
use App\Subsystems\Tenant\TenantConnector;

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