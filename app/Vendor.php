<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'name','address','category_id','last_usage_timestamp','CREATED_AT','UPDATED_AT'
    ];
}
