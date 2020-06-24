<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterInvoice extends Model
{
    protected $fillable = [
        'name','date','total','CREATED_AT','UPDATED_AT'
    ];


    public function lines()
    {
        return $this->hasMany('App\MasterInvoiceLine');
    }
}
