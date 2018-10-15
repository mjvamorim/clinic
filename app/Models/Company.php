<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\TenantConnector;

class Company extends Model
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
