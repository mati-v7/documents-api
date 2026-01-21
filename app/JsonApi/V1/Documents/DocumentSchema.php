<?php

namespace App\JsonApi\V1\Documents;

use App\Models\Document;
use LaravelJsonApi\Eloquent\Contracts\Paginator;
use LaravelJsonApi\Eloquent\Fields;
use LaravelJsonApi\Eloquent\Fields\Relations\BelongsTo;
use LaravelJsonApi\Eloquent\Fields\Relations\HasMany;
use LaravelJsonApi\Eloquent\Filters\Where;
use LaravelJsonApi\Eloquent\Filters\WhereHas;
use LaravelJsonApi\Eloquent\Filters\WhereIdIn;
use LaravelJsonApi\Eloquent\Pagination\PagePagination;
use LaravelJsonApi\Eloquent\Schema;
use LaravelJsonApi\Eloquent\SoftDeletes;

class DocumentSchema extends Schema
{
    use SoftDeletes;

    /**
     * The model the schema corresponds to.
     *
     * @var string
     */
    public static string $model = Document::class;

    /**
     * Get the resource fields.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Fields\ID::make(),
            Fields\Str::make('number')->sortable(),
            Fields\DateTime::make('issued_at')->sortable(),
            Fields\Number::make('total')->sortable(),
            Fields\DateTime::make('createdAt')->sortable()->readOnly(),
            Fields\DateTime::make('updatedAt')->sortable()->readOnly(),
            Fields\SoftDelete::make('deletedAt'),

            BelongsTo::make('customer'),
            BelongsTo::make('documentType'),
            BelongsTo::make('documentStatus'),
        ];
    }

    /**
     * Get the resource filters.
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            // Field filters
            WhereIdIn::make($this),
            Where::make('number'),
            Where::make('customer_id'),
            Where::make('document_type_id'),
            Where::make('document_status_id'),

            // Relation filters
            WhereHas::make($this, 'customer', 'with-customer'),
            WhereHas::make($this, 'documentType', 'with-type'),
            WhereHas::make($this, 'documentStatus', 'with-status'),
        ];
    }

    /**
     * Get the resource paginator.
     *
     * @return Paginator|null
     */
    public function pagination(): ?Paginator
    {
        return PagePagination::make();
    }

    /**
     * Determine if the resource is authorizable.
     *
     * @return bool
     */
    public function authorizable(): bool
    {
        return false;
    }
}
