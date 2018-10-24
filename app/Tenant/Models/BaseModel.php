<?php

namespace App\Tenant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use App\Tenant\TenantModel;


class BaseModel extends Model
{
    use TenantModel;
   
}
