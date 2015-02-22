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

Route::get('/teacher', function()
{
    if (Session::get('teacherlogin')==true)
    {
        return View::make('teacher.index');
    }
    else
    {
        return View::make('teacher.login');
    }
});
Route::post('/teacher', 'TeacherController@login');
Route::get('/teacher/logout', 'TeacherController@logout');

Route::get('/student', function()
{
    if (Session::get('studentlogin')==true)
    {
        return View::make('student.index');
    }
    else
    {
        return View::make('student.login');
    }
});
Route::post('/student', 'StudentController@login');
Route::get('/student/logout', 'StudentController@logout');

Route::get('/admin', function()
{
    if (Auth::check())
    {
        return View::make('admin.index');
    }
    else
    {
        return View::make('admin.login');
    }
});
Route::post('/admin', 'AdminController@login');
Route::get('/admin/logout', 'AdminController@logout');



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

