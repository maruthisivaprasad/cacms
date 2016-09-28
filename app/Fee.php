<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $table = 'fees';
    protected $primaryKey = 'fee_id';
    protected $fillable = [
        'client_id', 'service_name', 'type', 'fees', 'amount_receive', 'balance', 'service_deliver'
    ];
}
