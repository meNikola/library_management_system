<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BaseBookRequest extends FormRequest
{
    public function mappedAttributes(array $otherAttributes = []) {
        $attributeMap = array_merge([
            'data.attributes.title'              => 'title',
            'data.attributes.description'        => 'description',
            'data.attributes.published_year'     => 'published_year',
            'data.attributes.createdAt'          => 'created_at',
            'data.attributes.updatedAt'          => 'updated_at',
            'data.relationships.author.data.ids' => 'author_ids',
        ], $otherAttributes);

        $attributesToUpdate = [];
        foreach($attributeMap as $key => $attribute) {
            if ($this->has($key)) {
                $attributesToUpdate[$attribute] = $this->input($key);
            }
        }

        return $attributesToUpdate;
    }

    public function messages() {
        return [];
    }
}
