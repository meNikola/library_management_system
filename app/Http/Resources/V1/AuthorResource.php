<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'author',
            'id'   => $this->id,
            'attributes' => [
                'name'      => $this->name,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            'includes' => BookResource::collection($this->whenLoaded('books')),
            'links' => [
                'self' => route('authors.show', ['author' => $this->id]),
            ],
        ];
    }
}
