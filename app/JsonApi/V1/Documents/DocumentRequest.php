<?php

namespace App\JsonApi\V1\Documents;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class DocumentRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'number' => [
                'required',
                'string',
                'max:255',
                'unique:documents,number',
            ],
            'issued_at' => [
                'nullable',
                'date',
            ],
            'total' => [
                'required',
                'numeric',
                'min:0',
            ],
            'customer' => [
                'required',
                JsonApiRule::toOne(),
            ],
            'documentType' => [
                'required',
                JsonApiRule::toOne(),
            ],
            'documentStatus' => [
                'required',
                JsonApiRule::toOne(),
            ],
        ];
    }
}
