<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentStatus extends Model
{
    protected $table = 'document_statuses';

    protected $fillable = ['code', 'description'];
}
