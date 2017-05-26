<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

//RESFUL API
/*Route::group(['prefix' => '/api/v1/'],function($api){
    Route::resource('weathers',"WeathersController");
});*/

$api = app('Dingo\Api\Routing\Router');



$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers'],function($api){
        //登录路由
        $api->post('/login',"AuthenticateController@authenticate");

        //注册路由
        $api->post('/register',"AuthenticateController@register");

        $api->group(['middleware' => 'jwt.auth'],function($api){
            $api->resource('weathers',"WeathersController");
        });


    });
});




