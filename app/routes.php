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
    return View::make('index')->with('posts',$post)->with('settings',$setting);
});
Route::post('/', 'StudentController@login');

Route::get('/login', function()
{
    return View::make('login');
});
Route::post('/login', 'AdminController@login');
