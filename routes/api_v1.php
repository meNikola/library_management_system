<?php

use App\Http\Controllers\Api\V1\AuthorController;
use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\MemberController;
use App\Http\Controllers\Api\V1\ReservationController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);

    Route::apiResource('members', MemberController::class)->only('index', 'store', 'show');

    Route::apiResource('books', BookController::class);

    Route::apiResource('authors', AuthorController::class);

    Route::apiResource('reservations', ReservationController::class)->only('index', 'store', 'show');
});
