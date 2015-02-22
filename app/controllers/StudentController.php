<?php
/**
 * Created by PhpStorm.
 * User: yckao85
 * Date: 15/2/18
 * Time: 下午6:07
 */
class StudentController extends BaseController {
    public function login()
    {
        $settings=Setting::find(0);
        if($settings->server_state==1)
        {
            $account=Input::get('inputAccount');
            $password=Input::get('inputPassword');
            $password = sha1(sha1($password) . "place");
            $student=Student::where('account','=',$account)->count();
            if($student>0)
            {
                $student=Student::where('account','=',$account)->firstOrFail();
                if ($student->password==$password)
                {
                    Session::flush();
                    Session::regenerate();
                    Session::put('studentlogin',true);
                    Session::put('id',$student->id);
                    Session::put('account',$student->account);
                    Session::put('name', $student->name);
                    Session::put('class_id',$student->class_id);
                    Session::put('seat',$student->seat);
                    return Redirect::to('/student');
                }
                else
                {
                    return Redirect::to('/')->with('error', '#');
                }
            }
            else
            {
                return Redirect::to('/')->with('error', '#');
            }
        }
        else
        {
            return Redirect::to('/');
        }
    }

    public function logout()
    {
        Session::regenerate();
        Session::flush();
        return Redirect::to('/')->with('logout', '#');
    }
}

