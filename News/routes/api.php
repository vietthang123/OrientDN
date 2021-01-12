<?php

// use Illuminate\Routing\Route;
use App\Http\Controllers\Api\Admin\PermissionsApiController;
use App\Http\Controllers\Api\Admin\RolesApiController;
use App\Http\Controllers\Api\Admin\UsersApiController;
use App\Http\Controllers\Api\Admin\PostApiController;
use App\Http\Controllers\Api\Admin\CategoryApiController;
use App\Http\Controllers\Api\Admin\SlideApiController;
use Illuminate\Support\Facades\Route;



Route::group(['as' => 'api.', 'namespace' => 'Api\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', PermissionsApiController::class);

    // Roles
    Route::apiResource('roles', RolesApiController::class);

    // Users
    Route::apiResource('users', UsersApiController::class);

    // Posts
    Route::post('posts/media', 'PostApiController@storeMedia')->name('posts.storeMedia');
    Route::apiResource('posts', PostApiController::class);

    // Categories
    Route::apiResource('categories', CategoryApiController::class);

    // Slides
    Route::post('slides/media', 'SlideApiController@storeMedia')->name('slides.storeMedia');
    Route::apiResource('slides', SlideApiController::class);
});