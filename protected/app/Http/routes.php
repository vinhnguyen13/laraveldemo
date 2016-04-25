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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');


/**
 * url with multi languages
 */
if (in_array(Request::segment(1), Config::get('app.alt_langs'))) {

    App::setLocale(Request::segment(1));
    Config::set('app.locale_prefix', Request::segment(1));
}


Route::group(array('prefix' => Config::get('app.locale_prefix')), function()
{
    Route::get('/', function () {
        return view('welcome', ['content'=> PHP_EOL.\Illuminate\Foundation\Inspiring::quote().PHP_EOL]);
    });
    Route::get(Lang::get('routes.home'), ['uses' => 'HomeController@index']);

    Route::get('/language/{locale}', ['uses' => 'LanguageController@choose']);

    Route::get('api/users/{user}', function (App\User $user) {
        return $user;
    });
});


Route::get('/generate/models', ['uses' => '\\Jimbolino\\Laravel\\ModelBuilder\\ModelGenerator5@start', 'namespace' => 'Jimbolino\Laravel\ModelBuilder']);


