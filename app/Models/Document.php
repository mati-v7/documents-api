<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $table = 'documents';

    protected $fillable = [
        'number',
        'issued_at',
        'total',
        'customer_id',
        'document_type_id',
        'document_status_id',
    ];

    protected static function booted()
    {
        static::deleting(function ($document) {
            if ($document->documentStatus->code === 'FINALIZED') {
                throw new \DomainException(
                    'Finalized documents cannot be deleted.'
                );
            }
        });
    }

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
