<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;


class BaseModel extends Model
{
    protected $showable = [];

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public static function getColumns() {
        return Schema::getColumnListing(self::getTableName()); 

    }

    public static function getFillableFields() {
        return with(new static)->getFillable();
    }

    public static function getShowableFields() {
        return with(new static)->showable;
    }

    public static function blank() {
        $blank=[];
        foreach(self::getShowableFields() as $item) {
            $blank+=[$item['name']=>''];
        }
        return $blank;
    }
   
}
