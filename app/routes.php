<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/login', 'AuthController@login');
Route::post('/login', array('before' => 'csrf','uses' => 'AuthController@doLogin'));
Route::get('/logout', 'AuthController@logout');

# Nexmo Callback URL
Route::get('messages/nexmo-receipt', 'MessageController@nexmoReceipt');
 
//Check if logged in
Route::group(array('before' => 'auth'), function()
{
   	Route::get('/', 'DashboardController@index');

   	Route::get('messages', 'MessageController@index');

	Route::get('messages/group/{group_name}', 'MessageController@groupMessage');

	Route::post('messages/group/{group_name}', 'MessageController@sendGroupMessage');
	Route::post('messages/send-test', 'MessageController@sendTestMessage');

	Route::get('messages/sent', 'MessageController@sentMessages');
	Route::get('messages/sent/{id}', 'MessageController@show');
});