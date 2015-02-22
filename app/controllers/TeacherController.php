<?php
/**
 * Created by PhpStorm.
 * User: yckao85
 * Date: 15/2/18
 * Time: 下午6:07
 */
class TeacherController extends BaseController {





    public function login()
    {
        $account=Input::get('inputAccount');
        $password=Input::get('inputPassword');
        $password = sha1(sha1($password) . "place");
        $teacher=Teacher::where('account','=',$account)->count();
        if($teacher>0)
        {
            $teacher=Teacher::where('account','=',$account)->firstOrFail();
            if ($teacher->password==$password)
            {
                Session::flush();
                Session::regenerate();
                Session::put('teacherlogin',true);
                Session::put('id',$teacher->id);
                Session::put('account',$teacher->account);
                Session::put('name', $teacher->name);
                Session::put('class_id',$teacher->class_id);
                yslog($account,"teacher","login","success");
                return View::make('teacher.index');
            }
            else
            {
                yslog($account,"teacher","login","failed");
                return Redirect::to('/teacher')->with('error', '#');
            }
        }
        else
        {
            yslog($account,"teacher","login","failed");
            return Redirect::to('/teacher')->with('error', '#');
        }
    }

    public function logout()
    {
        yslog(Session::get('account'),"teacher","logout","success");
        Session::regenerate();
        Session::flush();
        return Redirect::to('/teacher')->with('logout', '#');
    }

}

