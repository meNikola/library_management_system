<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'book',
            'id'   => $this->id,
            'attributes' => [
                'title'          => $this->title,
                'description'    => $this->when(!$request->routeIs(['books.index']), $this->description),
                'published_year' => $this->published_year,
                'createdAt'      => $this->created_at,
                'updatedAt'      => $this->updated_at,
            ],
            'relationships' => [],
            'includes' =>  AuthorResource::collection($this->whenLoaded('authors')),
            'links' => [
                'self' => route('books.show', ['book' => $this->id]),
            ],
        ];
    }
}
