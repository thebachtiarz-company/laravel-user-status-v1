<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use TheBachtiarz\UserStatus\Http\Controllers\StatusUserController;
use TheBachtiarz\UserStatus\Http\Controllers\UserController;

/**
 * Group    : status
 * URI      : {{base_url}}/{{app_prefix}}/status/---
 */
Route::prefix('status')->middleware('api')->controller(StatusUserController::class)->group(static function (): void {
    /**
     * Name     : Status create
     * Method   : POST
     * Url      : {{base_url}}/{{app_prefix}}/status/create
     */
    Route::post('create', 'createOrUpdateStatus')->middleware('auth:sanctum');

    /**
     * Name     : Status user  assign
     * Method   : POST
     * Url      : {{base_url}}/{{app_prefix}}/status/user-assign
     */
    Route::post('user-assign', 'userStatusAssign')->middleware('auth:sanctum');
});

/**
 * Group    : user
 * URI      : {{base_url}}/{{app_prefix}}/user/---
 */
Route::prefix('user')->middleware('api')->controller(UserController::class)->group(static function (): void {
    /**
     * Name     : User create
     * Method   : POST
     * Url      : {{base_url}}/{{app_prefix}}/user/create
     *
     * @override
     */
    Route::post('create', 'createUser');
});
