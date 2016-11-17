<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'task_id';
    protected $fillable = [
        'client_id', 'subject', 'description', 'priority', 'duedate', 'remarks', 'assigned_to'
    ];
}
