<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'task_id';
    protected $fillable = [
        'subject', 'description', 'priority', 'duedate', 'remarks', 'assigned_to'
    ];
}
