<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'payment_id';
    protected $fillable = [
        'client_id', 'fee_id', 'service_name', 'payment_amount', 'paid_amount', 'payment_mode', 'paymentdate',
        'check_no', 'remarks'
    ];
}
