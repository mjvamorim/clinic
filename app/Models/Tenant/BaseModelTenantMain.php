<?php

namespace App\Models\Tenant;
use App\Models\Tenant\BaseModel;
use App\Support\TenantConnector;

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