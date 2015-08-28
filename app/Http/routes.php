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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::group([ 'prefix' =>  'goods', 'namespace' => 'Goods'], function () {

  Route::get('/', 'GoodsController@index');

});

Route::controllers([

  'auth' => 'Auth\AuthController',

  'user' => 'User\UserController',

	'password' => 'Auth\PasswordController',

  'profile' => 'Profile\ProfilesController',

  'order' => 'Order\OrdersController',

  'uploads' => 'Uploads\UploadsController',

  'car' => 'Cars\CarsController',

  'receiver' => 'ReceiverInfos\ReceiverInfosController',

  'bouns' => 'Bouns\BounsController',

  'admin' => 'Admin\AdminController',

  'text' => 'TextInfo\TextInfoController',

  'communitcate' => 'Communication\CommunicateController',

  'location' => 'Location\LocationController'

]);
