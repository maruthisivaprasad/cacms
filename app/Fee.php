<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $table = 'fee';
    protected $primaryKey = 'fee_id';
    protected $fillable = [
        'client_id', 'service_name', 'type', 'fees', 'amount_receive', 'balance', 'service_deliver'
    ];
}
