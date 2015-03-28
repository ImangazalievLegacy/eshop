<?php

/**
 * Паттерны параметров роутов
 */
Route::pattern('id', '[0-9]+');
Route::pattern('hash', '[a-z0-9]+');
Route::pattern('hex', '[a-f0-9]+');
Route::pattern('string', '[a-zA-Z0-9]+');
Route::pattern('username', '[a-f0-9]+');

Route::when('*', 'opened', ['get', 'post', 'put', 'patch', 'delete']);

/*
* Обработчик ошибки 404
*/

App::missing(function($exception)
{
    return Response::view('themes.default.404', array(), 404);
});

Route::get('/', array(

	'as' => 'home',
	'uses' => 'HomeController@home'

));

Route::group(array('prefix' => 'account'), function()
{

	/*
	* Для неавторизованных пользователей
	*/

	Route::group(array('before' => 'guest'), function(){

		Route::get('create', array(

			'as' => 'account.create',
			'uses' => 'AccountController@getCreate'

		));

		Route::get('login', array(

			'as' => 'account.login',
			'uses' => 'AccountController@getLogin'

		));

		Route::get('activate/{code}', array(

			'as' => 'account.activate',
			'uses' => 'AccountController@getActivate'

		))->where('code', '[a-zA-Z0-9]+');

		Route::group(array('before' => 'csrf'), function(){

			Route::post('create', array(

				'as' => 'account.create-post',
				'uses' => 'AccountController@postCreate'

			));

			Route::post('login', array(

				'as' => 'account.login-post',
				'uses' => 'AccountController@postLogin'

			));

		});

	});

	/*
	* Для авторизованных пользователей
	*/

	Route::group(array('before' => 'auth'), function(){

		Route::get('logout', array(

			'as' => 'account.logout',
			'uses' => 'AccountController@getLogOut'

		));

	});

});

Route::group(array('prefix' => 'admin', 'before' => 'admin.auth'), function()
{

	Route::get('/', array(

		'as' => 'admin.index',
		'uses' => 'AdminController@getIndex'

	));

});