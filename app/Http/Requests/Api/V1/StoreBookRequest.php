<?php

namespace App\Http\Requests\Api\V1;

use App\Permissions\V1\Abilities;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends BaseBookRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'data.attributes.title'              => 'required|string',
            'data.attributes.description'        => 'required|string',
            'data.attributes.published_year'     => 'required|date_format:Y',
            'data.relationships.author.data.ids' => 'required|array',
        ];

        return $rules;
    }
}
