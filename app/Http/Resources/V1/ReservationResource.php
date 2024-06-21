<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'reservation',
            'id'   => $this->reservation_id,
            'attributes' => [
                'book_id'   => $this->book_id,
                'member_id' => $this->user_id,
            ],
            'relationships' => [
                'member' => [
                    'data' => [
                        'type' => 'member',
                        'id' => $this->user_id,
                    ],
                    'links' => [],
                ],
            ],
            'includes' => new BookResource($this->book),
            'links' => [
                'self' => route('reservations.show', ['reservation' => $this->reservation_id]),
            ],
        ];
    }
}
