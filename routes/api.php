<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::middleware('api.token')->group(function () {
    Route::apiResource('users', UserController::class);
});
