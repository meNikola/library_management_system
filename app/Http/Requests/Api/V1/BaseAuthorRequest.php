<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BaseAuthorRequest extends FormRequest
{
    public function mappedAttributes(array $otherAttributes = []) {
        $attributeMap = array_merge([
            'data.attributes.name'            => 'name',
            'data.relationships.book.data.id' => 'book_id',
        ], $otherAttributes);

        $attributesToUpdate = [];
        foreach($attributeMap as $key => $attribute) {
            if ($this->has($key)) {
                $attributesToUpdate[$attribute] = $this->input($key);
            }
        }

        return $attributesToUpdate;
    }
}
