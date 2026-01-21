<?php

use App\Http\Controllers\Api\V1\DocumentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


JsonApiRoute::server('v1')
    ->prefix('v1')
    ->middleware('auth:sanctum')
    ->resources(function (ResourceRegistrar $server) {
        $server->resource('documents', DocumentController::class)->only('index', 'show', 'store', 'update', 'destroy');
    });
