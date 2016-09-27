<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
    protected $primaryKey = 'contact_id';
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone',
    ];
}
