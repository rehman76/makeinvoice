<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceLine extends Model
{
    protected $fillable = ['invoice_id','unit_price','sub_total','quantity','item','CREATED_AT','UPDATED_AT'
    ];
}
