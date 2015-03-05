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

function yslog($account,$ldentity,$doing,$commit)
{
    $log=new Syslog;
    $log->account=$account;
    $log->ldentity=$ldentity;
    $log->doing=$doing;
    $log->commit=$commit;
    @$log->HTTP_CLIENT_IP=$_SERVER['HTTP_CLIENT_IP'];
    @$log->HTTP_X_FORWARDED_FOR=$_SERVER['HTTP_X_FORWARDED_FOR'];
    @$log->HTTP_X_FORWARDED=$_SERVER['HTTP_X_FORWARDED'];
    @$log->HTTP_X_CLUSTER_CLIENT_IP=$_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    @$log->HTTP_FORWARDED_FOR=$_SERVER['HTTP_FORWARDED_FOR'];
    @$log->HTTP_FORWARDED=$_SERVER['HTTP_FORWARDED'];
    @$log->REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];
    @$log->HTTP_VIA=$_SERVER['HTTP_VIA'];
    $log->save();
}

Route::get('/', function()
{
        $post=Post::all();
        $setting=Setting::find(0);
        yslog("guest","guest","goin","");
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


Route::post('/student', 'StudentController@login');
Route::get('/student/logout', 'StudentController@logout');
Route::get('/student','StudentController@timetable');

Route::get('/admin', function () {
    if (Auth::check())
    {
        return View::make('admin.index');
    } else
    {
        return View::make('admin.login');
    }
});
Route::post('/admin', 'AdminController@login');
Route::group(array('before' => 'auth'), function() {
    Route::get('/admin.post', 'AdminController@postall');
    Route::get('/admin.post.add', 'AdminController@postadd');
    Route::get('/admin.post.{action}.{id}', 'AdminController@postaction');
    Route::post('/admin.post.{action}', 'AdminController@postwrite');
    Route::post('/admin.post.{action}.{id}', 'AdminController@postwrite');
    Route::get('/admin.class', 'AdminController@classall');
    Route::post('/admin.class.add', 'AdminController@classadd');
    Route::get('/admin.class.{action}.{id}', 'AdminController@classaction');
    Route::post('/admin.class.{action}', 'AdminController@classwrite');
    Route::post('/admin.class.{action}.{id}', 'AdminController@classwrite');
    Route::get('/admin.subject', 'AdminController@subjectall');
    Route::post('/admin.subject.add', 'AdminController@subjectadd');
    Route::get('/admin.subject.{action}.{id}', 'AdminController@subjectaction');
    Route::post('/admin.subject.{action}.{id}', 'AdminController@subjectwrite');
    Route::post('/admin.subject.{action}', 'AdminController@subjectwrite');
    Route::get('/admin.student', 'AdminController@studentall');
    Route::get('/admin.student.{action}.{id}', 'AdminController@studentaction');
    Route::get('/admin.student.add', 'AdminController@studentadd');
    Route::post('/admin.student.{action}.{id}', 'AdminController@studentwrite');
    Route::post('/admin.student.{action}', 'AdminController@studentwrite');
    Route::get('/admin.teacher','AdminController@teacherall');
    Route::get('/admin.teacher.{action}.{id}', 'AdminController@teacheraction');
    Route::get('/admin.teacher.add', 'AdminController@teacheradd');
    Route::post('/admin.teacher.{action}.{id}', 'AdminController@teacherwrite');
    Route::post('/admin.teacher.{action}', 'AdminController@teacherwrite');
    Route::get('/admin.admin','AdminController@adminall');
    Route::get('/admin.admin.add', 'AdminController@adminadd');
    Route::get('/admin.admin.{action}.{id}', 'AdminController@adminaction');
    Route::get('/admin.admin.add', 'AdminController@adminadd');
    Route::post('/admin.admin.{action}.{id}', 'AdminController@adminwrite');
    Route::post('/admin.admin.{action}', 'AdminController@adminwrite');
    Route::get('/admin.log','AdminController@logall');
    Route::get('/admin.log.clear','AdminController@logclear');
    Route::get('/admin.setting','AdminController@setting');
    Route::get('/admin.setting.{action}','AdminController@status');

    Route::get('/admin.logout', 'AdminController@logout');
});


Route::get('/login',function()
{
    return Redirect::to('/');
});
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

