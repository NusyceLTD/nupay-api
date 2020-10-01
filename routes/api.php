<?php

$api = app('Dingo\Api\Routing\Router');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


$api->version('v1', function ($api) {
    $api->group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\API\V1'], function ($api) {
        $api->post('register', 'Auth\AuthController@register');
        $api->post('login', 'Auth\AuthController@login');
    });

    $api->group(['prefix' => 'v1/admin', 'namespace' => 'App\Http\Controllers\API\V1'], function ($api) {
        $api->post('register', 'Auth\AuthController@register');
        $api->post('login', 'Auth\AuthController@login');
        $api->resource('currency', 'CurrencyController');
        $api->resource('role', 'RoleController');
        $api->resource('permission', 'PermissionController');
    });

});


