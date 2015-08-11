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

//Route::get('/', function () {
//    return view('welcome');
//});

/*
 * create route for home page
 */
Route::get('/', function () {
    return redirect('/blog');
});

/*
 *   routes for the BlogController
 */
Route::get('blog', 'BlogController@index');
Route::get('blog/{slug}', 'BlogController@showPost');


/*
 *  Admin area
 *
 *  When http://l5beauty.app/admin is called it redirects to
 *  admin/post  PostController index() method
 */
get('admin', function () {
    return redirect('/admin/post');
});

/*
Route groups allow you to share route attributes,
such as middleware or namespaces, across a large number of routes
without needing to define those attributes on each individual routes.
Shared attributes are specified in an array format as the first parameter to
the Route::group method.

Middleware
**********
To assign middleware to all routes within a group,
you may use the middleware key in the group attribute array.
Middleware will be executed in the order you define this array:

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function ()    {
        // Uses Auth Middleware
    });

    Route::get('user/profile', function () {
        // Uses Auth Middleware
    });
});


Namespaces
**********
Another common use-case for route groups is assigning the same PHP
namespace to a group of controllers.
You may use the namespace parameter in your group attribute
array to specify the namespace for all controllers within the group:

*/
Route::group([
    'namespace' => 'Admin',         // App\Http\Controllers\Admin
    'middleware' => 'auth',         // force auth middleware to be active
], function () {
    // assign routes for PostController, TagController and UploadController
    // the routes use the Admin namespace and auth middleware
    Route::resource('admin/post', 'PostController');
    // tells the router to set up all the resource routes except for the show route.
    Route::resource('admin/tag', 'TagController', ['except' => 'show']);
    Route::get('admin/upload', 'UploadController@index');
});

// Logging in and out routes
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');
