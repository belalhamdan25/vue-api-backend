<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::patch('update', 'AuthController@update');
    Route::get('roles', 'RolesController@roles');

});


Route::group([

    'middleware' => 'api',
    'prefix' => 'portfolio'

], function ($router) {

    Route::get('portfolios', 'PortfolioController@all');
    Route::get('portfolios/search', 'PortfolioController@search');
    Route::post('portfolios/categories-filter', 'CategoryController@categoriesFilter');
    Route::get('portfolios/categories-filter-values', 'CategoryController@categoriesFilterValues');
    Route::post('portfolios/skills-filter/', 'TagController@skillsFilter');
    Route::get('portfolios/skills-filter-names/', 'TagController@skillsFilterNames');
});

