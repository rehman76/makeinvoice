<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['vendor_id','master_id','total','CREATED_AT','UPDATED_AT'
    ];

    public function master()
    {
        return $this->belongsTo('App\MasterInvoice');
    }
}
