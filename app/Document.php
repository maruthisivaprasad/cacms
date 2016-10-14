<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';
    protected $primaryKey = 'document_id';
    protected $fillable = [
        'client_id', 'title', 'path','is_active'
    ];
}
