<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';

    protected $fillable = [
        'number',
        'issued_at',
        'total',
        'customer_id',
        'document_type_id',
        'document_status_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function documentStatus()
    {
        return $this->belongsTo(DocumentStatus::class);
    }
}
