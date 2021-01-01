<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'guest'], function () {

    Route::get('/login', 'AdminController@loginCreate');
    Route::post('/login', 'AdminController@loginStore');

});



Route::group(['middleware' => 'authenticated'], function () {

    Route::group(['middleware' => 'role'], function () {


        Route::get('/', 'AdminController@index');
        Route::get('/logout', 'AdminController@logout');
        Route::get('/users', 'AdminController@usersCreate');
        Route::get('/users-delete/{id}', 'AdminController@usersDelete');
        Route::get('/users-reset/{id}', 'AdminController@usersResetPass');
        Route::post('/users-search', 'AdminController@usersSearch');
        Route::post('/add-users', 'AdminController@usersAdd');

        Route::get('/projects', 'AdminController@projectsCreate');
        Route::get('/project-delete/{id}', 'AdminController@projectsDelete');
        Route::get('/offers', 'AdminController@offersCreate');
        Route::get('/offer-delete/{id}', 'AdminController@offersDelete');
        Route::get('/portfolios', 'AdminController@portfoliosCreate');
        Route::get('/portfolio-delete/{id}', 'AdminController@portfoliosDelete');
        Route::get('/skills', 'AdminController@skillsCreate');
        Route::post('/skills-store', 'AdminController@skillsStore');
        Route::get('/skills-delete/{id}', 'AdminController@skillsDelete');
        Route::get('/category', 'AdminController@categoryCreate');
        Route::post('/category-store', 'AdminController@categoryStore');
        Route::get('/category-delete/{id}', 'AdminController@categoryDelete');


});

});









