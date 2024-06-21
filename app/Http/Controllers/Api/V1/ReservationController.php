<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\UserFilter;
use App\Http\Requests\Api\V1\StoreReservationRequest;
use App\Models\User;
use App\Http\Requests\Api\V1\StoreUserRequest;
use App\Http\Requests\Api\V1\UpdateUserRequest;
use App\Http\Resources\V1\ReservationResource;
use App\Http\Resources\V1\UserResource;
use App\Models\Book;
use App\Models\Reservation;
use App\Models\Role;
use App\Policies\V1\ReservationPolicy;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReservationController extends ApiController
{
    protected $policyClass = ReservationPolicy::class;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if ($this->isAble('index', Reservation::class)) {
            return ReservationResource::collection(
                Reservation::with(['book', 'user'])->get()
            );
        }

        return $this->notAuthorized('You are not authorized to listing resource.');
    }

    public function store(StoreReservationRequest $request)
    {
        // Policy.
        if ($this->isAble('store', Reservation::class)) {
            // Request params.
            $params = $request->mappedAttributes();

            $lastReservation = Reservation::orderBy('reservation_id', 'desc')->first();
            $reservationId = $lastReservation ? $lastReservation->reservation_id + 1 : 1;

            $reservations = [];
            foreach ($params['book_ids'] as $value) {
                $reservations[] = Reservation::create([
                    'reservation_id' => $reservationId,
                    'book_id'        => $value,
                    'user_id'        => (int)$params['member_id'],
                ]);
            }

            $newReservation = Reservation::where('reservation_id', $reservationId)
                ->with(['book', 'user'])
                ->get()
            ;

            return ReservationResource::collection($newReservation);
        }

        return $this->notAuthorized('You are not authorized to create that resource');
    }

    /**
     * Display the specified resource.
     */
    public function show($reservation_id)
    {
        $reservation = Reservation::where('reservation_id', $reservation_id)
            ->with(['book', 'user'])
            ->get()
        ;

        // Policy.
        if ($this->isAble('show', Reservation::class)) {
            return ReservationResource::collection($reservation);
        }

        return $this->notAuthorized('You are not authorized to view reservation resource');
    }
}
