<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterInvoiceLine extends Model
{
    protected $fillable = [
        'item','quantity','unit_price','sub_total','master_id','CREATED_AT','UPDATED_AT'
    ];


}
