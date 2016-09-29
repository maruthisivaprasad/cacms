<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'client_id';
    protected $fillable = [
        'client_type', 'client_status', 'name', 'fname', 'dob', 'address', 'mobile', 'email', 'pan', 'uidai', 
        'photo', 'business_name','office_address', 'office_landline', 'website', 'business_nature', 'company_type', 
        'assigned_user'
    ];
}
