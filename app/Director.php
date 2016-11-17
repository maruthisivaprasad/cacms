<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $table = 'director';
    protected $primaryKey = 'director_id';
    protected $fillable = [
        'client_id', 'name', 'din', 'phone', 'email', 'digital_sig', 'expiry_date', 'designation', 'pcontact'
    ];
}
