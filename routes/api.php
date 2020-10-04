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
    $api->group(['prefix' => 'v1', 'middleware' => ['bindings'], 'namespace' => 'App\Http\Controllers\API\V1'], function ($api) {

    });

    $api->group(['prefix' => 'v1', 'middleware' => ['auth:api'], 'namespace' => 'App\Http\Controllers\API\V1'], function ($api) {
        $api->resource('currency', 'CurrencyController');
        $api->resource('role', 'RoleController');
        $api->resource('permission', 'PermissionController');
        $api->post('roleFilter', 'RoleController@filter');
        $api->post('checkIsRollAssignedToUser', 'RoleController@userHasRole');
        $api->get('rolePermissions/{role}', 'RoleController@hisPermissions');
        $api->get('users', 'Auth\AuthController@index');
        $api->post('findUsers', 'Auth\AuthController@find');
        $api->get('users/{user}', 'Auth\AuthController@single');
        $api->post('user', 'Auth\AuthController@store');
        $api->put('user/{user}', 'Auth\AuthController@update');
        $api->delete('user', 'Auth\AuthController@destroy');

        /*Transactions money*/
        $api->post('sendMoney', 'TransactionController@doTransfert');
        $api->post('requestMoney', 'TransactionController@requestPayement');
        $api->post('depositMoney', 'TransactionController@doDeposite');
        $api->post('withDrawtMoney', 'TransactionController@doWithDraw');

    });


    $api->group(['prefix' => 'v1/auth', 'namespace' => 'App\Http\Controllers\API\V1\Auth'], function ($api) {
        $api->post('register', 'AuthController@register');
        $api->post('login', 'AuthController@login');
        $api->post('forgot', 'AuthController@login');

        $api->group(['middleware' => ['auth:api', 'bindings']], function ($api) {
            $api->get('logout', 'AuthController@logout');
            $api->put('update', 'AuthController@setting');
            $api->get('user', 'AuthController@details');
            $api->delete('delete', 'AuthController@destroy');
        });
    });
});


