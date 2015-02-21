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

Route::get('/', function()
{
    $post=Post::all();
    $setting=Setting::find(0);
    return View::make('start.index')->with('posts',$post)->with('settings',$setting);
});
Route::post('/', 'StudentController@login');

Route::get('/hash/{auth}', function($auth)
{
    $auth = sha1(sha1($auth) . "place");
    return $auth;
});
Route::get('/admin/hash/{auth}', function($auth)
{
    $auth = Hash::make($auth);
    return $auth;
});

Route::get('/admin', function()
{
    if (Auth::check())
    {
        return "ya!";
    }
    else
    {
        return View::make('start.login');
    }
});


Route::post('/admin', 'AdminController@login');
