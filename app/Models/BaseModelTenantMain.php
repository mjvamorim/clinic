<?php

namespace App\Models;
use App\Models\BaseModel;
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