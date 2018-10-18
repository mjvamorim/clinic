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
        'state','contry','email','mobile','phone',
        'mysql_host', 'mysql_database', 'mysql_username', 'mysql_password', ];

}
