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

Route::get('/management999/admin777', 'Admin\AdminController@index');

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

  'administrator_$2y$10$m1lWH3HqB9oimrxrB3Ea7uu76y5xxUqsldjEpuiWu7H5r6uCGdNSS' => 'Admin\AdminController',

  'text' => 'TextInfo\TextInfoController',

  'communitcate' => 'Communication\CommunicateController',

  'location' => 'Location\LocationController',

  'test' => 'Test\TestController',

  'verify' => 'Verify\VerifyController',

  'userboard' => 'Admin\UserManageController',

  'orderboard' => 'Admin\OrderManageController',

  'coopboard' => 'Admin\CoopManageController',

  'adboard' => 'Admin\AdvertiseManageController',

  'download' => 'Downloads\DownloadsController',

  'news' => 'News\NewsController',

]);
