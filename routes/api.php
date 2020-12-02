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
    Route::get('portfolios/portfolios-show/{id}', 'PortfolioController@portfolioShow');
    Route::get('portfolios/portfolios-show-skills/{id}', 'PortfolioController@portfolioShowSkills');
    Route::get('portfolios/portfolios-show-images', 'PortfolioController@portfolioShowImages');
    Route::get('portfolios/search', 'PortfolioController@search');
    Route::post('portfolios/categories-filter', 'PortfolioController@categoriesFilter');
    Route::get('portfolios/categories-filter-values', 'CategoryController@categoriesFilterValues');
    Route::post('portfolios/skills-filter/', 'PortfolioController@skillsFilter');
    Route::get('portfolios/skill-filter/', 'PortfolioController@skillFilter');
    Route::get('portfolios/skills-filter-names/', 'TagController@skillsFilterNames');
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'project'

], function ($router) {

    Route::get('projects', 'ProjectController@all');
    Route::get('search', 'ProjectController@search');
    Route::post('categories-filter', 'ProjectController@categoriesFilter');
    Route::post('skills-filter', 'ProjectController@skillsFilter');
    Route::get('skill-filter', 'ProjectController@skillFilter');
    Route::post('budget-filter', 'ProjectController@budgetFilter');
    Route::get('project-show/{id}', 'ProjectController@projectShow');
    Route::post('project-show-offers', 'ProjectController@projectShowOffers');


});


Route::group([

    'middleware' => 'api',
    'prefix' => 'freelancer'

], function ($router) {

    Route::get('freelancers', 'FreelancerController@all');
    Route::get('search', 'FreelancerController@search');
    Route::post('categories-filter', 'FreelancerController@categoriesFilter');
    Route::post('skills-filter', 'FreelancerController@skillsFilter');
    Route::post('rate-filter', 'FreelancerController@rateFilter');

});

Route::group([

    'middleware' => 'api',
    'prefix' => 'user'

], function ($router) {

    Route::get('user/{id}', 'UserController@userShow');
    Route::get('user-dashboard/{id}', 'UserController@userDataDashboard');


});

